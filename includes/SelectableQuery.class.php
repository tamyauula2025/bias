<?php
class SelectableQuery
{
	private $dbEngine;

	public function __construct(DbEngineInterface $dbEngine)
	{
		$this->dbEngine = $dbEngine;
	}

	public function findById(string $tableName, int $id, string $idColName = 'id'): ?stdClass
	{
		return $this->getRow("SELECT * FROM $tableName WHERE $idColName = $id");
	}
	
	public function getAll(string $queryText): Generator
	{
		$queryResult = $this->dbEngine->query($queryText);
		while ($obj = $this->dbEngine->fetchObject($queryResult)) {
			yield $obj;
		}
	}

	public function getCol(string $queryText): Generator
	{
		$queryResult = $this->dbEngine->query($queryText);
		while ($row = $this->dbEngine->fetchRow($queryResult)) {
			yield $row[0];
		}
	}

	public function getMap(string $queryText): Generator
	{
		$queryResult = $this->dbEngine->query($queryText);
		while ($obj = $this->dbEngine->fetchObject($queryResult)) {
			yield $obj->id => $obj->name;
		}
	}
	
	public function getRow(string $queryText): ?stdClass
	{
		return $this->dbEngine->fetchObject($this->dbEngine->query($queryText));
	}

	public function getScalar(string $queryText, $col_ind = 0, $row_ind = 0): ?string
	{
		$queryResult = $this->dbEngine->query($queryText);

		return $this->dbEngine->numRows($queryResult) > 0 ? $this->dbEngine->result($queryResult, $col_ind, $row_ind) : null;
	}

	public function isExist(string $queryText): bool
	{
		return (bool) $this->getScalar($queryText);
	}

	public function select(string $queryText, string $type = QueryType::ALL): string|stdClass|Generator|null
	{
		return $this->{"get$type"}($queryText);
	}
}
