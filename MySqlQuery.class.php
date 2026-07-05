<?php
class MySqlQuery
{

	/**
	 * Осуществить пакетную вставку
	 * @param array $entities Сущности
	 * @param string $tableName Наименование таблицы
	 * @param string $dbName Наименование БД (м. б. пустой строкой)
	 * @param bool $onDuplicateKeyUpdate Флаг обновления записи при дубликате ключа
	 * @param array $updatedColNames Наименования колонок значения которых будут обновлены
	 * @param bool $returnLastInsertId Вернуть ли ИД крайней вставленной записи?
	*/
	public static function batchInsert($entities, $tableName, $dbName = '', $onDuplicateKeyUpdate = false, $updatedColNames = [], $returnLastInsertId = false)
	{
		// INSERT `reorgs` (`unp_posl`, `tip`, `dat`, `unp_do`, `kod_xml_otch`) VALUES
		// 	('000000001', '1', '1970-01-01', '000000011', 'AISKB0000000001_______'),
		// 	('000000002', '2', '1970-01-02', '000000012', 'AISKB0000000002_______'),
		// 	('000000001', '1', '1970-01-01', '000000011', 'AISKB0000000003_______')
		// ON DUPLICATE KEY UPDATE `kod_xml_otch` = VALUES(`kod_xml_otch`)
	}
	
	public static function findById(int $id, string $tableName, ?string $dbName = null, int $fetchMode = MYSQLI_ASSOC, string $idColName = 'id'): ?array
	{
		$var = (isset($dbName)) ? "`$dbName`." : "";
		$res = self::getAll("SELECT * FROM $var`$tableName` WHERE `$idColName` = $id", $fetchMode);

		return $res;
	}
	
	public static function getAll(string $queryText, int $fetchMode = MYSQLI_ASSOC): array
	{
		$res  = [];
		$stmt = mysql_query($queryText);

		while ($arr = mysql_fetch_array($stmt, $fetchMode)) {
			$res[] = $arr;
		}

		return $res;
	}

	public static function getCol(string $queryText): array
	{
		$res  = [];
		$stmt = mysql_query($queryText);

		while ($row = mysql_fetch_row($stmt)) {
			$res[] = $row[0];
		}

		return $res;
	}

	public static function getMap(string $queryText): array
	{
		$res  = [];
		$stmt = mysql_query($queryText);

		while ($assoc = mysql_fetch_assoc($stmt)) {
			$res[$assoc['id']] = $assoc['name'];
		}

		return $res;
	}
	
	public static function getRow(string $queryText): ?array
	{
		$stmt = mysql_query($queryText);
		$res  = mysql_fetch_row($stmt);

		return $res; 
	}

	public static function getScalar(string $queryText, $col_ind = 0, $row_ind = 0): ?string
	{
		$stmt        = mysql_query($queryText);
		$stmtNumRows = mysql_num_rows($stmt);
		$stmtResult  = mysql_result($stmt, $col_ind, $row_ind);
		$res         = ($stmtNumRows > 0) ? $stmtResult : null;

		return $res;
	}

	public static function isExist(string $queryText): bool
	{
		$scalar = self::getScalar($queryText);
		$res    = (bool) $scalar;

		return $res;
	}
}
