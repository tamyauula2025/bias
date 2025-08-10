<?php
class SqliteEngine implements DbEngineInterface
{
	public function fetchRow($dbEngineResult): ?array
	{
		return sqlite_fetch_row($dbEngineResult);
	}

	/**
	 * @param SQLite3Result $dbEngineResult
	*/
	public function fetchObject($dbEngineResult): ?stdClass
	{
		return sqlite_fetch_object($dbEngineResult);
	}

	public function numRows($dbEngineResult): int
	{
		return is_string($dbEngineResult->columnName(0));
	}

	public function query(string $queryText): SQLite3Result
	{
		return sqlite_query($queryText);
	}

	public function result($dbEngineResult, int $col_ind = 0, int $row_ind = 0): ?string
	{
		return sqlite_result($dbEngineResult, $col_ind, $row_ind);
	}
}
