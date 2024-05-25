<?php
namespace PortfolioApp;

use Closure;

class Container
{
	private array $registry = [];

	public function set(string $name, Closure $value): void
	{
		$this->registry[$name] = $value;
	}

	public function get(string $class_name): object
	{
		if (array_key_exists($class_name, $this->registry)) {

			return $this->registry[$class_name]();

		}

		$reflector = new ReflectionClass($class_name);

		$constructor = $reflector->getConstructor();

		if ($constructor === null) {

			return new $class_name;

		}

		$dependencies = [];

		foreach ($constructor->getParameters() as $parameter) {

			$type = $parameter->getType();

			$dependencies[] = $this->get((string) $type);
		}

		return new $class_name(...$dependencies);
	}
}
