<?php
require 'classes.inc';
new form_user(777);

mysql_select_db('test');
$obj = json_decode('{
	"Global": {
		"NewConfirmed": 257886,
		"TotalConfirmed": 17849120,
		"NewDeaths": 5615,
		"TotalDeaths": 685038,
		"NewRecovered": 222627,
		"TotalRecovered": 10552934
	},
	"Countries": [
		{
			"Country": "Afghanistan",
			"CountryCode": "AF",
			"Slug": "afghanistan",
			"NewConfirmed": 35,
			"TotalConfirmed": 36710,
			"NewDeaths": 11,
			"TotalDeaths": 1283,
			"NewRecovered": 0,
			"TotalRecovered": 25509,
			"Date": "2020-08-02T07:46:58Z",
			"Premium": {}
		},
		{
			"Country": "Albania",
			"CountryCode": "AL",
			"Slug": "albania",
			"NewConfirmed": 120,
			"TotalConfirmed": 5396,
			"NewDeaths": 4,
			"TotalDeaths": 161,
			"NewRecovered": 9,
			"TotalRecovered": 2961,
			"Date": "2020-08-02T07:46:58Z",
			"Premium": {}
		}
	]
}');
echo'<pre>';
print_r($obj);
VarDumper::dump($obj);

function generator($arr): Generator {
	foreach ($arr as $key => $val) {
		yield $key => $val;
	}
}

VarDumper::dump(0, 'int');
VarDumper::dump(0.0, 'float');
VarDumper::dump('', 'string1');
VarDumper::dump('0', 'string2');
VarDumper::dump('0.0', 'string3');
VarDumper::dump(true, 'bool1');
VarDumper::dump(false, 'bool2');
VarDumper::dump(null, 'null');
VarDumper::dump(fn () => 0, 'Closure');
VarDumper::dump(fopen('test.php', 'r'), 'resource (stream)');
VarDumper::dump((object) [], 'stdClass1');
VarDumper::dump((object) ['A', 'B', 'C'], 'stdClass2');
VarDumper::dump(generator([]), 'generator1');
VarDumper::dump(generator(['A', 'B', 'C']), 'generator2');
VarDumper::dump([], 'array1');
VarDumper::dump([
    0,
    0.0,
    '',
    '0',
    '0.0',
    true,
    false,
    null,
    fn () => 0,
    fopen('test.php', 'r'),
    (object) [],
    (object) ['A', 'B', 'C'],
    generator([]),
    generator(['A', 'B', 'C']),
], 'array2');
echo '<hr>';
VarDumper::dump(MySqlQuery::findById(0, 'spr_site_services'), 'findById1');
VarDumper::dump(MySqlQuery::findById(2, 'spr_site_services'), 'findById2');
VarDumper::dump(MySqlQuery::getAll('SELECT * FROM spr_site_services LIMIT 0'), 'getAll1');
VarDumper::dump(MySqlQuery::getAll('SELECT * FROM spr_site_services'), 'getAll2');
VarDumper::dump(MySqlQuery::getRow('SELECT * FROM spr_site_services LIMIT 0'), 'getRow1');
VarDumper::dump(MySqlQuery::getRow('SELECT * FROM spr_site_services LIMIT 1'), 'getRow2');
VarDumper::dump(MySqlQuery::getCol('SELECT id FROM spr_site_services LIMIT 0'), 'getCol1');
VarDumper::dump(MySqlQuery::getCol('SELECT id FROM spr_site_services'), 'getCol2');
VarDumper::dump(MySqlQuery::getMap('SELECT id, name FROM spr_site_services LIMIT 0'), 'getMap1');
VarDumper::dump(MySqlQuery::getMap('SELECT id, name FROM spr_site_services'), 'getMap2');
VarDumper::dump(MySqlQuery::getScalar('SELECT * FROM spr_site_services', 2, 2), 'getScalar1');
VarDumper::dump(MySqlQuery::getScalar('SELECT * FROM spr_site_services', 1, 1), 'getScalar2');
VarDumper::dump(MySqlQuery::isExist('SELECT * FROM spr_site_services LIMIT 0'), 'isExist1');
VarDumper::dump(MySqlQuery::isExist('SELECT * FROM spr_site_services'), 'isExist2');
