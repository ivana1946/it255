<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization, Token, token, TOKEN');
include("functions.php");
if (isset($_POST['ime']) && isset($_POST['prezime']) && isset($_POST['stariUsername']) && isset
($_POST['noviUsername']) && isset($_POST['sifra'])) {
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $stariUsername = $_POST['stariUsername'];
    $noviUsername = $_POST['noviUsername'];
    $sifra = $_POST['sifra'];
    echo izmeniKorisnika($stariUsername, $noviUsername, $sifra, $ime, $prezime);
}
?>