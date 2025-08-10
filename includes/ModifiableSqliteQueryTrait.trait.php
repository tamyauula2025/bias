<?php
trait ModifiableSqliteQueryTrait
{
	private static function addQuotesIfStr(number|string $val): string
	{
		return (is_string($val)) ? "'$val'" : $val;
	}

	private static function getAssignmentList(array $assoc): string
	{
		$result = '';
		foreach ($assoc as $colName => $val) {
			$result .= "$colName = " . self::addQuotesIfStr($val) . ',';
		}
		$result = rtrim($result, ',');

		return $result;
	}

	private static function getAssignmentListWhenDuplicateKeyUpdate(array $colNames): string
	{
		$result = '';
		foreach ($colNames as $name) {
			$result .= "$name = VALUE($name),";
		}
		$result = rtrim($result, ',');

		return $result;
	}

	private static function getBracketColNameList(array $colNames): string
	{
		return '(' . implode(',', $colNames) . ')';
	}

	private static function getBracketValList(array $vals): string
	{
		$result = '';
		foreach ($vals as $val) {
			$result .= self::addQuotesIfStr($val) . ',';
		}
		$result = '(' . rtrim($result, ',') . ')';

		return $result;
	}

	private static function getBracketValLists(array $vals): string
	{
		$result = '';
		foreach ($vals as $row) {
			$result .= self::getBracketValList($row) . ',';
		}
		$result = rtrim($result, ',');

		return $result;
	}

	public static function delete(string $tableName, ?string $condition = null): void
	{
		mysql_query("DELETE FROM $tableName" . ((isset($condition)) ? " WHERE $condition" : ''));
	}

	public static function deleteById(string $tableName, int $id, string $idColName = 'id'): void
	{
		mysql_query("DELETE FROM $tableName WHERE $idColName = $id");
	}

	public static function insertSet(string $tableName, array $assoc, bool $whenDuplicateKeyUpdate = true): void
	{
		$assignmentList = self::getAssignmentList($assoc);
		mysql_query("INSERT $tableName SET $assignmentList" . (($whenDuplicateKeyUpdate) ? " ON DUPLICATE KEY UPDATE $assignmentList" : ''));
	}

	public static function insertVals(string $tableName, array $colNames, array $vals, bool $whenDuplicateKeyUpdate = true): void
	{
		mysql_query("INSERT $tableName " . self::getBracketColNameList($colNames) . " VALUES " . self::getBracketValLists($vals) . (($whenDuplicateKeyUpdate) ? ' ON DUPLICATE KEY UPDATE ' . self::getAssignmentListWhenDuplicateKeyUpdate($colNames) : ''));
	}

	public static function update(string $tableName, array $assoc, ?string $condition = null): void
	{
		mysql_query("UPDATE $tableName SET " . self::getAssignmentList($assoc) . ((isset($condition)) ? " WHERE $condition" : ''));
	}

	public static function updateById(string $tableName, array $assoc, int $id, string $idColName = 'id'): void
	{
		mysql_query("UPDATE $tableName SET " . self::getAssignmentList($assoc) . " WHERE $idColName = $id");
	}
}
