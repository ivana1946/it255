<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: POST');
include("functions.php");
if(isset($_POST['ime']) && isset($_POST['prezime']) && isset($_POST['username']) && isset($_POST['sifra'])){
  $ime = $_POST['ime'];
  $prezime = $_POST['prezime'];
  $username = $_POST['username'];
  $sifra = $_POST['sifra'];
  echo register($username,$sifra,$ime,$prezime);
}
?>