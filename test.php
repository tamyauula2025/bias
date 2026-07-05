<?php
require 'Php.class.php';
require 'VarDumper.class.php';
require 'bias.php';
mysql_select_db('test');
$reorgs = [
	[
		'unp_posl'     => '000000001',
		'tip'          => '1',
		'dat'          => '1970-01-01',
		'unp_do'       => '000000011',
		'kod_xml_otch' => 'AISKB0000000001_______'
	],
	[
		'unp_posl'     => '000000002',
		'tip'          => '2',
		'dat'          => '1970-01-02',
		'unp_do'       => '000000012',
		'kod_xml_otch' => 'AISKB0000000002_______'
	],
	[
		'unp_posl'     => '000000001',
		'tip'          => '1',
		'dat'          => '1970-01-01',
		'unp_do'       => '000000011',
		'kod_xml_otch' => 'AISKB0000000003_______'
	]
];
VarDumper::dump($reorgs);
MySqlQuery::batchInsert('reorgs', $reorgs, true, ['unp_posl', 'tip', 'dat', 'unp_do']);
