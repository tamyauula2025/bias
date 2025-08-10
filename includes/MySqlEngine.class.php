<?php
class MySqlEngine implements DbEngineInterface
{
	public function fetchRow($dbEngineResult): ?array
	{
		return mysql_fetch_row($dbEngineResult);
	}

	/**
	 * @param mysqli_result $dbEngineResult
	*/
	public function fetchObject($dbEngineResult): ?stdClass
	{
		return mysql_fetch_object($dbEngineResult);
	}

	public function numRows($dbEngineResult): int
	{
		return $dbEngineResult->num_rows;
	}

	public function query(string $queryText): mysqli_result
	{
		return mysql_query($queryText);
	}

	public function result($dbEngineResult, int $col_ind = 0, int $row_ind = 0): ?string
	{
		return mysql_result($dbEngineResult, $col_ind, $row_ind);
	}
}
