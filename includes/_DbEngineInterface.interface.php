<?php
interface DbEngineInterface
{

	function fetchRow($dbEngineResult): ?array;

	function fetchArray($dbEngineResult, int $mode): ?array;

	function fetchAssoc($dbEngineResult): ?array;

	function numRows($dbEngineResult): int;

	function query(string $queryText);

	function result($dbEngineResult, int $col_ind = 0, int $row_ind = 0): ?string;
}