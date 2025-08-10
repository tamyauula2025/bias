<?php
class VarDumper
{
	private static function getEmptyTypeStr(string $type): string
	{
		$result = 'empty ';
		switch ($type) {
			case 'string':
				$result .= 'string';
				break;
			case 'array':
				$result .= 'array';
				break;
			default:
				$result .= "$type object";
				break;
		}

		return $result;
	}

	private static function getHtmlTable(iterable|object $attr): string
	{
		$result = '<table border cellspacing="0">';
		foreach ($attr as $keyName => $val) {
			$result .= '<tr>';
			$result .= "<td align=\"center\"><b>$keyName</b></td>";
			$result .= '<td align="' . self::getHtmlTdAlign($val) . '">' . self::getResult($val) . '</td>';
			$result .= '</tr>';
		}
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
				return (Php::empty($expr)) ? 'center' : 'left';
			default:
				return 'center';
		}
	}

	private static function getResult(mixed $expr): string
	{
		$exprDebugType = get_debug_type($expr);
		switch ($exprDebugType) {
			case 'int':
				return $expr;
			case 'float':
				return ($expr == 0.0) ? '0.0' : $expr;
			case 'string':
				return (!Php::empty($expr)) ? $expr : '<i>' . self::getEmptyTypeStr($exprDebugType) . '</i>';
			case 'bool':
				return '<i>' . (($expr) ? 'true' : 'false') . '</i>';
			default:
				$exprType = gettype($expr);
				switch ($exprType) {
					case 'array':
					case 'object':
						if ($exprDebugType == 'Closure') {
							goto default2;
						}
						if (!Php::empty($expr)) {
							$result = '<span style="cursor: pointer" onclick="(this.nextElementSibling.style.display != \'none\') ? this.nextElementSibling.style.display = \'none\': this.nextElementSibling.style.display = \'\'">' . self::getVarType($expr) . '</span>';
							$result .= self::getHtmlTable($expr);
							return $result;
						}
		
						return '<i>' . self::getEmptyTypeStr($exprDebugType) . '</i>';
					default:
						default2:
						return "<i>$exprDebugType</i>";
				}
		}
	}

	private static function getVarType(mixed $expr): string
	{
		$exprType = get_debug_type($expr);
		switch ($exprType) {
			case 'string':
			case 'array':
			case 'stdClass':
				return "$exprType(" . Php::len($expr) . ')';
			default:
				return $exprType;
		}
	}

	public static function dd(mixed $expr, ?string $hint = null): void
	{
		self::dump($expr, $hint);
		die;
	}

	public static function dump(mixed $expr, ?string $hint = null): void
	{
		$result = '<table border cellspacing="0">';
		$result .= '<tr>';
		if (isset($hint)) {
			$result .= "<td>$hint</td>";
		}
		$result .= '<td align="center">' . self::getResult($expr) . '</td>';
		$result .= '</tr>';
		$result .= '</table>';
		echo($result);
	}
}
