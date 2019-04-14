<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization, Token, token, TOKEN');
include("functions.php");

if (isset($_POST['kategorijaDokumentacija']) && isset($_POST['imeDokumentacija']) && isset($_POST['vremeDatumUnosa'])) {
//    && isset($_POST['token'])
    $kategorijaDokumentacija = htmlspecialchars($_POST['kategorijaDokumentacija']);
    $imeDokumentacija = htmlspecialchars($_POST['imeDokumentacija']);
    $vremeDatumUnosa = htmlspecialchars($_POST['vremeDatumUnosa']);
    echo dokumentacija($kategorijaDokumentacija, $imeDokumentacija, $vremeDatumUnosa);
}
?>