<?php
$mysqli = new mysqli('localhost', 'root');

function mysql_error(): string
{
	global $mysqli;

	var_dump($mysqli->errno);die;

	return $res;
}

function mysql_fetch_array(mysqli_result $mysqli_result, int $mode = MYSQLI_ASSOC): ?array
{
	$res = $mysqli_result->fetch_array($mode);

	return $res;
}

function mysql_fetch_assoc(mysqli_result $mysqli_result): ?array
{
	$res = $mysqli_result->fetch_assoc();

	return $res;
}

function mysql_fetch_row(mysqli_result $mysqli_result): ?array
{
	$res = $mysqli_result->fetch_row();

	return $res;
}

function mysql_num_rows(mysqli_result $mysqli_result): int
{
	$res = $mysqli_result->num_rows;

	return $res;
}

function mysql_result(mysqli_result $mysqli_result, int $col_ind = 0, int $row_ind = 0): ?string
{
	$mysqli_result->data_seek($row_ind);

	$row = $mysqli_result->fetch_row();
	$res = $row[$col_ind] ?? null;

	return $res;
}

function mysql_select_db(string $name): void
{
	global $mysqli;

	$mysqli->select_db($name);
}

function mysql_query(string $query_text): mysqli_result|bool
{
	global $mysqli;

	try {
		$res = $mysqli->query($query_text);
	} catch (mysqli_sql_exception $ex) {
		exit($ex->getMessage());
	}

	return $res;
}
