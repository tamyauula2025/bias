<?php
class SqliteEngine implements DbEngineInterface
{

	/**
	 * @param SQLite3Result $dbEngineResult
	*/
	public function fetchRow($dbEngineResult): ?array
	{
		$res = sqlite_fetch_row($dbEngineResult);

		return $res;
	}

	/**
	 * @param SQLite3Result $dbEngineResult
	*/
	public function fetchArray($dbEngineResult, int $mode = SQLITE3_ASSOC): ?array
	{
		$res = sqlite_fetch_array($dbEngineResult, $mode);

		return $res;
	}

	/**
	 * @param SQLite3Result $dbEngineResult
	*/
	public function fetchAssoc($dbEngineResult): ?array
	{
		$res = sqlite_fetch_assoc($dbEngineResult);

		return $res;
	}

	/**
	 * @param SQLite3Result $dbEngineResult
	*/
	public function numRows($dbEngineResult): int
	{
		$counter = 0;
		while ($dbEngineResult->fetchArray()) {
			++$counter;
		}
		$res = $counter;

		return $res;		
	}

	public function query(string $queryText): SQLite3Result
	{
		$res = sqlite_query($queryText);

		return $res;
	}

	/**
	 * @param SQLite3Result $dbEngineResult
	*/
	public function result($dbEngineResult, int $col_ind = 0, int $row_ind = 0): ?string
	{
		$res = sqlite_result($dbEngineResult, $col_ind, $row_ind);

		return $res;
	}
}
