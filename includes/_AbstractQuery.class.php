<?php
class AbstractQuery
{

	private static function getDbEngine(): DbEngineInterface
	{
		$dbEngineName = self::getDbEngineName();
		$res          = new $dbEngineName;

		return $res;
	}

	private static function getDbEngineName(): string
	{
		$className = get_called_class();
		$res       = str_replace('Query', 'Engine', $className);

		return $res;
	}

	public static function __callStatic(string $name, array $args): string|array|null
	{
		$dbEngine = self::getDbEngine();
		$selectableQuery = new SelectableQuery($dbEngine);
		$res = $selectableQuery->$name(...$args);

		return $res;
	}
}
