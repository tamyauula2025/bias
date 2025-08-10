<?php
class AbstractQuery
{
	private static function getDbEngine(): DbEngineInterface
	{
		$dbEngineName = self::getDbEngineName();

		return new $dbEngineName;
	}

	private static function getDbEngineName(): string
	{
		return str_replace('Query', 'Engine', get_called_class());
	}

	public static function __callStatic(string $name, array $args): string|stdClass|Generator|null
	{
		return (new SelectableQuery(self::getDbEngine()))->$name(...$args);
	}
}
