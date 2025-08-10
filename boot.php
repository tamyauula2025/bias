<?php
spl_autoload_register('autoload');

function autoload(string $className): void
{
	$preparedFileNameWithPath = "includes/$className.?.php";
	foreach (['class', 'interface', 'trait'] as $type) {
		$fileNameWithPath = str_replace('?', $type, $preparedFileNameWithPath);
		if (file_exists($fileNameWithPath)) {
			include_once $fileNameWithPath;
			break;
		}
	}
}
