<?php

namespace PortfolioApp;

use ReflectionClass;

class Router {
	protected $routes = [];

	public function addRoute($method, $route, $controller, $action) {
		$this->routes[$route] = [
			'method' => $method,
			'controller' => $controller,
			'action' => $action
		];
	}

	public function dispatch($uri, $container) {

		$method = $_SERVER['REQUEST_METHOD'];
		$uriPath = parse_url($uri, PHP_URL_PATH);

		foreach ($this->routes as $route => $routeInfo) {
			if ($routeInfo['method'] === $method && preg_match($this->getRouteRegex($route), $uriPath, $matches)) {
				$controllerName = $routeInfo['controller'];
				$action = $routeInfo['action'];

				$reflector = new ReflectionClass($controllerName);
				$constructor = $reflector->getConstructor();

				$dependencies = [];
				if ($constructor !== null) {
					foreach ($constructor->getParameters() as $param) {
						$type = (string)$param->getType();

						if ($container->has($type)) {
							$dependencies[] = $container->get($type);
						} else {
							throw new \Exception("Dependency '$type' not found in the container.");
						}
					}
				}

				$controller = new $controllerName(...$dependencies);

				if ($method === 'GET') {
					$routeParams = array_slice($matches, 1);
					$getParams = $_GET;
					$allParams = array_merge($routeParams, $getParams);
					$controller->$action(...array_values($allParams));
				} else {
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
