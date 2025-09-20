<?php
class VarDumper
{

	private static function getExprType(mixed $expr): string
	{
		$exprType = get_debug_type($expr);
		switch ($exprType) {
			case 'string':
			case 'array':
			case 'stdClass':
				$exprLen = Php::getLen($expr);
				$res     = "$exprType($exprLen)";

				break;
			default:
				$res = $exprType;
				break;
		}

		return $res;
	}

	private static function getHtmlTable(iterable|object $attr): string
	{
		$html = '<table border cellspacing="0" style="display: none">';
		foreach ($attr as $key => $val) {
			$align   = self::getHtmlTdAlign($val);
			$content = self::getHtmlTdContent($val);
			$html    .= <<<_
					<tr>
						<td align="center"><b>$key</b></td>
						<td align="$align">$content</td>
					</tr>
			_;
		}
		$html .= '</table>';
		$res = $html;

		return $res;
	}

	private static function getHtmlTdAlign(mixed $expr): string
	{
		$exprType = get_debug_type($expr);
		switch ($exprType) {
			case 'int':
			case 'float':
				$res = 'right';
				break;
			case 'string':
				$res = (Php::isEmpty($expr)) ? 'center' : 'left';
				break;
			default:
				$res = 'center';
				break;
		}

		return $res;
	}

	private static function getHtmlTdContent(mixed $expr): string
	{
		$exprDebugType = get_debug_type($expr);
		switch ($exprDebugType) {
			case 'int':
				$res = $expr;
				break;
			case 'float':
				$res = ($expr == 0.0) ? '0.0' : $expr;
				break;
			case 'string':
				$res = (Php::isEmpty($expr)) ? 'empty string' : "'$expr'";
				break;
			case 'bool':
				$res = ($expr) ? 'true' : 'false';
				break;
			case 'array':
			case 'Generator':
			case 'stdClass':
				if (Php::isEmpty($expr)) {
					$res = "empty $exprDebugType";
					if ($exprDebugType == 'stdClass') {
						$res .= ' object';
					}
				} else {
					$exprType = self::getExprType($expr);
					$res      = <<<_
						<span style="cursor: pointer" onclick="this.nextElementSibling.click()">&plusb;</span>
						<span style="cursor: pointer" onclick="if (this.nextElementSibling.style.display == 'none') { this.previousElementSibling.textContent = '&minusb;'; this.nextElementSibling.style.display = '' } else { this.previousElementSibling.textContent = '&plusb;'; this.nextElementSibling.style.display = 'none' }">$exprType</span>
					_;
					$res     .= self::getHtmlTable($expr);	
				}
				break;
			default:
				$res = $exprDebugType;
				break;
		}

		return $res;
	}

	public static function dd(mixed $expr, ?string $hint = null): void
	{
		self::dump($expr, $hint);
		die;
	}

	public static function dump(mixed $expr, ?string $hint = 'выражение'): void
	{
		$content = self::getHtmlTdContent($expr);
		$res     = <<<_
			<table border cellspacing="0">
				<tr>
					<td>$hint</td>
					<td align="center">$content</td>
				</tr>
			</table>
		_;

		echo $res;
	}
}
