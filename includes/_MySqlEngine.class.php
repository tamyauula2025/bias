<?php
class MySqlEngine implements DbEngineInterface
{

	/**
	 * @param mysqli_result $dbEngineResult
	*/
	public function fetchRow($dbEngineResult): ?array
	{
		$res = mysql_fetch_row($dbEngineResult);

		return $res;
	}

	/**
	 * @param mysqli_result $dbEngineResult
	*/
	public function fetchArray($dbEngineResult, int $mode = MYSQLI_ASSOC): ?array
	{
		$res = mysql_fetch_array($dbEngineResult, $mode);

		return $res;
	}

	/**
	 * @param mysqli_result $dbEngineResult
	*/
	public function fetchAssoc($dbEngineResult): ?array
	{
		$res = mysql_fetch_assoc($dbEngineResult);

		return $res;
	}

	/**
	 * @param mysqli_result $dbEngineResult
	*/
	public function numRows($dbEngineResult): int
	{
	}

	public function query(string $queryText): mysqli_result
	{
		$res = mysql_query($queryText);

		return $res;
	}

	/**
	 * @param mysqli_result $dbEngineResult
	*/
	public function result($dbEngineResult, int $col_ind = 0, int $row_ind = 0): ?string
	{
		$res = mysql_result($dbEngineResult, $col_ind, $row_ind);

		return $res;
	}
}
