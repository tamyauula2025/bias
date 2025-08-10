<?php
class Php
{
	public static function empty(mixed $var)
	{
		switch (get_debug_type($var)) {
			case 'string':
			case 'stdClass':
				return self::len($var) == 0;
			case 'Generator':
				return is_null($var->current());
			default:
				return empty($var);
		}
	}

	public static function len(string|array|stdClass $var)
	{
		switch (get_debug_type($var)) {
			case 'string':
				return strlen($var);
			case 'array':
				return count($var);
			case 'stdClass':
				return count((array) $var);
		}
	}
}
