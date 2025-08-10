<?php
require_once 'boot.php';
require_once 'bias.php';
mysql_select_db('test');
sqlite_select_db('test.sqlite');
// $obj = json_decode('{
// 	"Global": {
// 		"NewConfirmed": 257886,
// 		"TotalConfirmed": 17849120,
// 		"NewDeaths": 5615,
// 		"TotalDeaths": 685038,
// 		"NewRecovered": 222627,
// 		"TotalRecovered": 10552934
// 	},
// 	"Countries": [
// 		{
// 			"Country": "Afghanistan",
// 			"CountryCode": "AF",
// 			"Slug": "afghanistan",
// 			"NewConfirmed": 35,
// 			"TotalConfirmed": 36710,
// 			"NewDeaths": 11,
// 			"TotalDeaths": 1283,
// 			"NewRecovered": 0,
// 			"TotalRecovered": 25509,
// 			"Date": "2020-08-02T07:46:58Z",
// 			"Premium": {}
// 		},
// 		{
// 			"Country": "Albania",
// 			"CountryCode": "AL",
// 			"Slug": "albania",
// 			"NewConfirmed": 120,
// 			"TotalConfirmed": 5396,
// 			"NewDeaths": 4,
// 			"TotalDeaths": 161,
// 			"NewRecovered": 9,
// 			"TotalRecovered": 2961,
// 			"Date": "2020-08-02T07:46:58Z",
// 			"Premium": {}
// 		}
// 	]
// }');
// echo'<pre>';
// print_r($obj);
// VarDumper::dump($obj, 'obj');
// $int = 0;
// $float = 0.0;
// $string1 = '';
// $string2 = '0';
// $string3 = '0.0';
// $bool1 = true;
// $bool2 = false;
// $null = null;
// $closure = fn () => 0;
// $resourceStream = fopen('TODO.txt', 'r');
// $abc = ['A', 'B', 'C'];
// $stdClass1 = (object) [];
// $stdClass2 = (object) $abc;
// $generator1 = generator([]);
// $generator2 = generator($abc);
// function generator($arr): Generator {
// 	foreach ($arr as $keyName => $val) {
// 		yield $keyName => $val;
// 	}
// }
// VarDumper::dump($int, 'int');
// VarDumper::dump($float, 'float');
// VarDumper::dump($string1, 'string1');
// VarDumper::dump($string2, 'string2');
// VarDumper::dump($string3, 'string3');
// VarDumper::dump($bool1, 'bool1');
// VarDumper::dump($bool2, 'bool2');
// VarDumper::dump($null, 'null');
// VarDumper::dump($closure, 'closure');
// VarDumper::dump($resourceStream, 'resourceStream');
// VarDumper::dump($stdClass1, 'stdClass1');
// VarDumper::dump($stdClass2, 'stdClass2');
// VarDumper::dump($generator1, 'generator1');
// VarDumper::dump($generator2, 'generator2');
// VarDumper::dump([], 'array1');
// VarDumper::dump([
// 	$int,
// 	$float,
// 	$string1,
// 	$string2,
// 	$string3,
// 	$bool1,
// 	$bool2,
// 	$null,
// 	$closure,
// 	$resourceStream,
// 	$stdClass1,
// 	$stdClass2,
// 	[]
// ], 'array2');
// echo '<hr>';
VarDumper::dump(MySqlQuery::findById('spr_site_services', 0), 'findById1');
VarDumper::dump(MySqlQuery::findById('spr_site_services', 2), 'findById2');
VarDumper::dump(SqliteQuery::findById('spr_site_services', 0), 'findById3');
VarDumper::dump(SqliteQuery::findById('spr_site_services', 2), 'findById4');
VarDumper::dump(MySqlQuery::getAll('SELECT * FROM spr_site_services LIMIT 0'), 'getAll1');
VarDumper::dump(MySqlQuery::getAll('SELECT * FROM spr_site_services'), 'getAll2');
VarDumper::dump(SqliteQuery::getAll('SELECT * FROM spr_site_services LIMIT 0'), 'getAll3');
VarDumper::dump(SqliteQuery::getAll('SELECT * FROM spr_site_services'), 'getAll4');
VarDumper::dump(MySqlQuery::getRow('SELECT * FROM spr_site_services LIMIT 0'), 'getRow1');
VarDumper::dump(MySqlQuery::getRow('SELECT * FROM spr_site_services LIMIT 1'), 'getRow2');
VarDumper::dump(SqliteQuery::getRow('SELECT * FROM spr_site_services LIMIT 0'), 'getRow3');
VarDumper::dump(SqliteQuery::getRow('SELECT * FROM spr_site_services LIMIT 1'), 'getRow4');
VarDumper::dump(MySqlQuery::getCol('SELECT id FROM spr_site_services LIMIT 0'), 'getCol1');
VarDumper::dump(MySqlQuery::getCol('SELECT id FROM spr_site_services'), 'getCol2');
VarDumper::dump(SqliteQuery::getCol('SELECT id FROM spr_site_services LIMIT 0'), 'getCol3');
VarDumper::dump(SqliteQuery::getCol('SELECT id FROM spr_site_services'), 'getCol4');
VarDumper::dump(MySqlQuery::getMap('SELECT id, name FROM spr_site_services LIMIT 0'), 'getMap1');
VarDumper::dump(MySqlQuery::getMap('SELECT id, name FROM spr_site_services'), 'getMap2');
VarDumper::dump(SqliteQuery::getMap('SELECT id, name FROM spr_site_services LIMIT 0'), 'getMap3');
VarDumper::dump(SqliteQuery::getMap('SELECT id, name FROM spr_site_services'), 'getMap4');
VarDumper::dump(MySqlQuery::getScalar('SELECT * FROM spr_site_services', 2, 2), 'getScalar1');
VarDumper::dump(MySqlQuery::getScalar('SELECT * FROM spr_site_services', 1, 1), 'getScalar2');
VarDumper::dump(SqliteQuery::getScalar('SELECT * FROM spr_site_services', 2, 2), 'getScalar3');
VarDumper::dump(SqliteQuery::getScalar('SELECT * FROM spr_site_services', 1, 1), 'getScalar4');
VarDumper::dump(MySqlQuery::isExist('SELECT * FROM spr_site_services LIMIT 0'), 'isExist1');
VarDumper::dump(MySqlQuery::isExist('SELECT * FROM spr_site_services'), 'isExist2');
VarDumper::dump(SqliteQuery::isExist('SELECT * FROM spr_site_services LIMIT 0'), 'isExist3');
VarDumper::dump(SqliteQuery::isExist('SELECT * FROM spr_site_services'), 'isExist4');
VarDumper::dump(SqliteQuery::select('SELECT * FROM spr_site_services'), 'isExist4');
