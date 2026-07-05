<?php
class VarDumper
{
	private static function getEmptyTypeString(string $type): string
	{
		switch ($type) {
			case 'string':
				return 'empty<br>string';
			case 'array':
				return 'empty<br>array';
			default:
				return "empty<br>$type<br>object";
		}
	}

	private static function getHtmlTable(iterable|stdClass $iterable): string
	{
		$ths = '';
		$tds = '';
		foreach ($iterable as $keyName => $value) {
			$ths .= "<th>$keyName</th>";
			$tds .= '<td align="' . self::getHtmlTdAlign($value) . '" title="' . self::getVarTypeTitle($value) . '">' . self::getResult($value) . '</td>';
		}
		$result = '<table border cellspacing="0">';
		$result .= '<tr>';
		$result .= $ths;
		$result .= '</tr>';
		$result .= '<tr>';
		$result .= $tds;
		$result .= '</tr>';
		$result .= '</table>';
		return $result;
	}

	private static function getHtmlTdAlign(mixed $expr): string
	{
		switch (get_debug_type($expr)) {
			case 'int':
			case 'float':
				return 'right';
			case 'string':
				if (!Php::empty($expr)) {
					return (is_numeric($expr)) ? 'right' : 'left';
				}
			default:
				return 'center';
		}
	}

	private static function getResult(mixed $expr): string
	{
		$exprType = get_debug_type($expr);
		switch ($exprType) {
			case 'int':
			case 'float':
				return $expr;
			case 'string':
				return (!Php::empty($expr)) ? $expr : '<i>' . self::getEmptyTypeString($exprType) . '</i>';
			case 'bool':
				return '<i>' . (($expr) ? 'true' : 'false') . '</i>';
			case 'array':
			case 'stdClass':
			case 'mysqli_result':
			case 'Generator':
				return (!Php::empty($expr)) ? self::getHtmlTable($expr) : '<i>' . self::getEmptyTypeString($exprType) . '</i>';
			default:
				return "<i>$exprType</i>";
		}
	}

	private static function getVarTypeTitle(mixed $expr): string
	{
		$exprType = get_debug_type($expr);
		switch ($exprType) {
			case 'string':
			case 'array':
			case 'mysqli_result':
			case 'stdClass':
				return "$exprType(" . Php::len($expr) . ')';
			default:
				return $exprType;
		}
	}

	public static function dump(mixed $expr, ?string $hint = null): void
	{
		$result = '<table border cellspacing="0">';
		$result .= '<tr>';
		if (isset($hint)) {
			$result .= "<td>$hint</td>";
		}
		$result .= '<td align="center" title="' . self::getVarTypeTitle($expr) . '">' . self::getResult($expr) . '</td>';
		$result .= '</tr>';
		$result .= '</table>';
		echo($result);
	}
}
