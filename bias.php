<?php
$mysqli = new mysqli('localhost', 'root');
$sqlite = new SQLite();

class SQLite extends SQLite3
{
	public function __construct()
	{
	}
}

function mysql_fetch_object(mysqli_result $mysqli_result): ?stdClass
{
	return $mysqli_result->fetch_object();
}

function sqlite_fetch_object(SQLite3Result $sqlite_3_result): ?stdClass
{
	$fetchingResult = $sqlite_3_result->fetchArray(SQLITE3_ASSOC);
	if (!$fetchingResult) {
		return null;
	}

	return (object) $fetchingResult;
}

function mysql_fetch_row(mysqli_result $mysqli_result): ?array
{
	return $mysqli_result->fetch_row();
}

function sqlite_fetch_row(SQLite3Result $sqlite_3_result): ?array
{
	$tmp = $sqlite_3_result->fetchArray(SQLITE3_NUM);

	return (!$tmp) ? null : $tmp;
}

function mysql_result(mysqli_result $mysqli_result, int $col_ind = 0, int $row_ind = 0): ?string
{
	$mysqli_result->data_seek($row_ind);

	return $mysqli_result->fetch_row()[$col_ind] ?? null;
}

function sqlite_result(SQLite3Result $sqlite_3_result, int $col_ind = 0, int $row_ind = 0): ?string
{
	$curr_row_ind = 0;
	while ($row = $sqlite_3_result->fetchArray(SQLITE3_NUM)) {
		if ($curr_row_ind == $row_ind) {
			return $row[$col_ind];
		}
		++$curr_row_ind;
	}
	return null;
}

function mysql_select_db(string $name): void
{
	global $mysqli;
	$mysqli->select_db($name);
}

function sqlite_select_db(string $name): void
{
	global $sqlite;
	$sqlite->open($name);
}

function mysql_query(string $query_text)
{
	global $mysqli;

	return $mysqli->query($query_text);
}

function sqlite_query(string $query_text)
{
	global $sqlite;

	return $sqlite->query($query_text);
}
