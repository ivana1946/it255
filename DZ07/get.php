<?php
$tip = $_GET['type'];
$param1 = $_GET['param1'];
$param2 = $_GET['param2'];
$param3 = $_GET['param3'];

if ($tip == "json") {
	header("Content-type: application/json");
	$rez = array (
		
		'obim' => izracunajObim($param1, $param2)
	);
	echo json_encode($rez);
} else {
	header("Content-type: text/xml");
	$rez = array (
		
		izracunajObim($param1, $param2, $param3) => 'obim'
	);
	$xml = new SimpleXMLElement('<root/>');
	array_walk_recursive($rez, array ($xml, 'addChild'));
	print $xml->asXML();
}

function izracunajObim($a, $b, $c) {
	return $obim = $a + $b + $c;
}
?>