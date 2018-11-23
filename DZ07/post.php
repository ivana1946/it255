<?php
//Kupljenje parametara za izračunavanje obima trougla

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$tip = $_GET['type'];
	$param1 = $_POST['param1'];
	$param2 = $_POST['param2'];
	$param3 = $_POST['param3'];
}
if ($tip == "json") {
	header("Content-type: application/json");
	$rez = array (
		
		'obim' => izracunajObim($param1, $param2, $param3)
	);
	echo json_encode($rez);
} else {
	header("Content-type: text/xml");
	$rez = array (
		
		izracunajObim($param1, $param2,$param3 ) => 'obim'
	);
	$xml = new SimpleXMLElement('<root/>');
	array_walk_recursive($rez, array ($xml, 'addChild'));
	print $xml->asXML();
}

function izracunajObim($a, $b,$c ) {
	return $obim = $a + $b + $c ;
}
?>