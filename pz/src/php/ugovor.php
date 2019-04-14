<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization, Token, token, TOKEN');
include("functions.php");
if (isset($_POST['imePaketa']) && isset($_POST['vremeDatumUnosa'])) {
    $imePaketa = htmlspecialchars($_POST['imePaketa']);
    $vremeDatumUnosa = htmlspecialchars($_POST['vremeDatumUnosa']);
    echo ugovor($imePaketa, $vremeDatumUnosa);
}
?>