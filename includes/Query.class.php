<?php
class Query
{
	public static function getAll(string $queryText): Generator
	{
		return (new SelectableQuery(new MySqlEngine))->getAll($queryText);
	}

	public static function getRow(string $queryText): ?stdClass
	{
		return (new SelectableQuery(new MySqlEngine))->getRow($queryText);
	}
}
