<?php
class SelectableQuery
{

	private $dbEngine;

	public function __construct(DbEngineInterface $dbEngine)
	{
		$this->dbEngine = $dbEngine;
	}

}
