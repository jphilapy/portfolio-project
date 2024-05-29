<?php

namespace PortfolioApp;

use ReflectionClass;

class Router {
	protected $routes = [];

	public function addRoute($method, $route, $controller, $action, $params = []) {
		$this->routes[$route] = [
			'method' => $method,
			'controller' => $controller,
			'action' => $action,
			'params' => $params
		];
	}

	public function dispatch($uri, $container) {
		// Remove the /mvc base path from the URI
		$uri = str_replace('/mvc', '', $uri);

		$method = $_SERVER['REQUEST_METHOD']; // Get the HTTP method from the request

		foreach ($this->routes as $route => $routeInfo) {
			if ($routeInfo['method'] === $method && preg_match($this->getRouteRegex($route), $uri, $matches)) {
				$controllerName = $routeInfo['controller'];
				$action = $routeInfo['action'];

				$reflector = new ReflectionClass($controllerName);
				$constructor = $reflector->getConstructor();

				$dependencies = [];
				if ($constructor !== null) {
					foreach ($constructor->getParameters() as $param) {
						$type = (string)$param->getType();
						// Check if the dependency exists in the container
						if ($container->has($type)) {
							$dependencies[] = $container->get($type);
						} else {
							throw new \Exception("Dependency '$type' not found in the container.");
						}
					}
				}

				$controller = new $controllerName(...$dependencies);

				if ($method === 'GET') {
					$controller->$action(...array_values(array_slice($matches, 1)));
				} else {
					// For POST requests, retrieve POST data and pass it to the action method
					$postData = $_POST;
					$controller->$action($postData);
				}
				return;
			}
		}

		throw new \Exception("No route found for $method $uri");
	}

	private function getRouteRegex($route) {
		// Convert route parameters to regex placeholders
		$regex = preg_replace('/{(\w+)}/', '(?P<$1>\w+)', $route);
		// Add start and end delimiters to match the entire URI
		return '/^' . str_replace('/', '\/', $regex) . '$/';
	}
}
