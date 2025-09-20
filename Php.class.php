<?php
class Php
{

	public static function getLen(string|array|stdClass $var): int
	{
		$varDebugType = get_debug_type($var);
		switch ($varDebugType) {
			case 'string':
				$res = strlen($var);
				break;
			case 'array':
				$res = count($var);
				break;
			case 'stdClass':
				$arr = (array) $var;
				$res = count($arr);
				break;
		}

		return $res;
	}

	public static function isEmpty(mixed $var): bool
	{
		$varDebugType = get_debug_type($var);
		switch ($varDebugType) {
			case 'string':
			case 'stdClass':
				$res = self::getLen($var) == 0;
				break;
			case 'Generator':
				$currentEl = $var->current();
				$res       = is_null($currentEl);

				break;
			default:
				$res = empty($var);
				break;
		}

		return $res;
	}
}
