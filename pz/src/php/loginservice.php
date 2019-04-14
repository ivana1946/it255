<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: POST');
include("functions.php");
if(isset($_POST['username']) && isset($_POST['sifra'])){
  $username = $_POST['username'];
  $sifra = $_POST['sifra'];
  echo login($username,$sifra);
}
?>