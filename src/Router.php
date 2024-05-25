<?php

namespace MVC;

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

	public function dispatch($uri) {
		$method = $_SERVER['REQUEST_METHOD']; // Get the HTTP method from the request

		foreach ($this->routes as $route => $routeInfo) {
			if ($routeInfo['method'] === $method && preg_match($this->getRouteRegex($route), $uri, $matches)) {
				$controllerName = $routeInfo['controller'];
				$action = $routeInfo['action'];

				$controller = new $controllerName();

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

