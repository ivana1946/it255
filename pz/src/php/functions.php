<?php
include("config.php");
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    die();
}
function checkIfLoggedIn()
{
    global $conn;
    if (isset($_SERVER['HTTP_TOKEN'])) {
        $token = $_SERVER['HTTP_TOKEN'];
        $result = $conn->prepare("SELECT * FROM korisnik WHERE token=?");
        $result->bind_param("s", $token);
        $result->execute();
        $result->store_result();
        $num_rows = $result->num_rows;
        if ($num_rows > 0) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
function login($username, $sifra)
{
    global $conn;
    $rarray = array();
    if (checkLogin($username, $sifra)) {
        $id = sha1(uniqid());
        $result2 = $conn->prepare("UPDATE korisnik SET token=? WHERE username=?");
        $result2->bind_param("ss", $id, $username);
        $result2->execute();
        $rarray['token'] = $id;
    } else {
        header('HTTP/1.1 401 Unauthorized');
        $rarray['error'] = "Invalid username/sifra";
    }
    return json_encode($rarray);
}
function checkLogin($username, $sifra)
{
    global $conn;
    $sifra = md5($sifra);
    $result = $conn->prepare("SELECT * FROM korisnik WHERE username=? AND sifra=?");
    $result->bind_param("ss", $username, $sifra);
    $result->execute();
    $result->store_result();
    $num_rows = $result->num_rows;
    if ($num_rows > 0) {
        return true;
    } else {
        return false;
    }
}
function register($username, $sifra, $ime, $prezime)
{
    global $conn;
    $rarray = array();
    $errors = "";
    if (checkIfUserExists($username)) {
        $errors .= "Username already exists\r\n";
    }
    if (strlen($username) < 5) {
        $errors .= "Username must have at least 5 characters\r\n";
    }
    if (strlen($sifra) < 5) {
        $errors .= "Password must have at least 5 characters\r\n";
    }
    if (strlen($ime) < 3) {
        $errors .= "First name must have at least 3 characters\r\n";
    }
    if (strlen($prezime) < 3) {
        $errors .= "Last name must have at least 3 characters\r\n";
    }
    if ($errors == "") {
        $stmt = $conn->prepare("INSERT INTO korisnik (id, ime, prezime, username, sifra, token) VALUES (NULL, ?, ?, ?, ?, '');");
        $pass = md5($sifra);
        $stmt->bind_param("ssss", $ime, $prezime, $username, $sifra);
        if ($stmt->execute()) {
            $token = sha1(uniqid());
            $result2 = $conn->prepare("UPDATE korisnik SET token=? WHERE username=?");
            $result2->bind_param("ss", $token, $username);
            $result2->execute();
            $rarray['token'] = $token;
        } else {
            header('HTTP/1.1 400 Bad request');
            $rarray['error'] = "Database connection error";
        }
    } else {
        header('HTTP/1.1 400 Bad request');
        $rarray['error'] = json_encode($errors);
    }
    return json_encode($rarray);
}
function checkIfUserExists($username)
{
    global $conn;
    $result = $conn->prepare("SELECT * FROM korisnik WHERE username=?");
    $result->bind_param("s", $username);
    $result->execute();
    $result->store_result();
    $num_rows = $result->num_rows;
    if ($num_rows > 0) {
        return true;
    } else {
        return false;
    }
}
function getId()
{
    global $conn;
    $token = $_SERVER['HTTP_TOKEN'];
    $result = $conn->prepare("SELECT id FROM korisnik where token = ?");
    $result->bind_param("s", $token);
    $result->execute();
    $result->bind_result($id);
    while ($row = $result->fetch()) {
        return $id;
    }
}
function dokumentacija($kategorijaDokumentacija, $imeDokumentacija, $vremeDatumUnosa)
{
    global $conn;
    $rarray = array();
    if (checkIfLoggedIn()) {
        $userId = getId();
        $tip_unosa = "Dokumentacija";
        $result2 = $conn->prepare("INSERT INTO dokumentcija_is (id_dokumentacija, DATUM, IME_DOKUMENTACIJA, KATEGORIJA_DOKUMENTACIJA) values (?, ?, ?, ?, ?)");
        $result2->bind_param("isiss", $id, $vremeDatumUnosa, $imeDokumentacija, $kategorijaDokumentacija);
        if ($result2->execute()) {
            $rarray['success'] = 'ok';
        } else {
            $rarray['error'] = "Database connection error" . $result2->error;
            //$result2->error
        }
    } else {
        $rarray['error'] = "Please log in";
        header('HTTP/1.1 401 Unauthorized');
    }
    return json_encode($rarray);
}
function ugovor($imePaketa, $vremeDatumUnosa)
{
    global $conn;
    $rarray = array();
    if (checkIfLoggedIn()) {
        $userId = getId();
        $tip_unosa = "Ugovor";
        $result2 = $conn->prepare("INSERT INTO dokumentacija_is (id, DATUM, IME, PREZIME, IME_PAKETA) VALUES (?, ?, ?, 'null', ?);");
        $result2->bind_param("isis", $id, $vremeDatumUnosa, $imePaketa);
        if ($result2->execute()) {
            $rarray['success'] = 'ok';
        } else {
            $rarray['error'] = "Database connection error" . $result2->error;
            //$result2->error
        }
    } else {
        $rarray['error'] = "Please log in";
        header('HTTP/1.1 401 Unauthorized');
    }
    return json_encode($rarray);
}
function getPaket()
{
    global $conn;
    $rarray = array();
    $user_id = getId();
    $zapisi = array();
    $zapis = array();
    if (checkIfLoggedIn()) {
        $stmt = $conn->prepare('SELECT  
                                        paket.ID_PAKET,                                       
                                        paket.IME_PAKETA, 
                                        paket.KATEGORIJA, 
                                        paket.OPIS, 
                                        paket.CENA 
                                        FROM  paket
                                          where id=?');
        $stmt->bind_param('i', $user_id);
        $stmt->bind_result($v1, $v2, $v3, $v4, $v5);
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            $zapis['ID_PAKET'] = $v1;
            $zapis['IME_PAKETA'] = $v2;
            $zapis['KATEGORIJA'] = $v3;
            $zapis['OPIS'] = $v4;
            $zapis['CENA'] = $v5;
            array_push($zapisi, $zapis);
        }
        $rarray['zapisi'] = $zapisi;
        return json_encode($rarray);
    } else {
       $rarray['error'] = "Please log in";
        header('HTTP/1.1 401 Unauthorized');
        return json_encode($rarray);
    }
}
function obirsi_unos($id)
{
    global $conn;
    $rarray = array();
    if (checkIfLoggedIn()) {
        $result = $conn->prepare("DELETE FROM istorija_merenja WHERE ISTORIJA_MERENJA_ID=?");
        $result->bind_param("i", $id);
        $result->execute();
        $rarray['success'] = "Deleted successfully";
    } else {
        $rarray['error'] = "Please log in";
        header('HTTP/1.1 401 Unauthorized');
    }
    return json_encode($rarray);
}


function obirsi_korisnika($id)
{
    global $conn;
    $rarray = array();
    if (checkIfLoggedIn()) {
        $result = $conn->prepare("DELETE FROM korisnik WHERE id=?");
        $result->bind_param("i", $id);
        $result->execute();
        $rarray['success'] = "Deleted successfully";
    } else {
        $rarray['error'] = "Please log in";
        header('HTTP/1.1 401 Unauthorized');
    }
    return json_encode($rarray);
}
function getUsers()
{
    global $conn;
    $rarray = array();
    $korisnici = array();
    $korisnik = array();
    if (checkIfLoggedIn()) {
        $stmt = $conn->prepare('SELECT  
                                        *
                                        FROM  korisnik');
        $stmt->bind_result($v1, $v2, $v3, $v4, $v5, $v6);
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            $korisnik['id'] = $v1;
            $korisnik['ime'] = $v2;
            $korisnik['prezime'] = $v3;
            $korisnik['username'] = $v4;
            $korisnik['sifra'] = $v5;
            $korisnik['token'] = $v6;
            array_push($korisnici, $korisnik);
        }
        $rarray['korisnici'] = $korisnici;
        return json_encode($rarray);
    } else {
        $rarray['error'] = "Please log in";
        header('HTTP/1.1 401 Unauthorized');
        return json_encode($rarray);
    }
}
function pronadji_korisnika($username)
{
    global $conn;
    $rarray = array();
    //$korisnici = array();
    $korisnik = array();
    if (checkIfLoggedIn()) {
        $stmt = $conn->prepare('SELECT  
                                        *
                                        FROM  korisnik
                                        WHERE username = ?');
        $stmt->bind_param('s', $username);
        $stmt->bind_result($v1, $v2, $v3, $v4, $v5, $v6);
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            $korisnik['id'] = $v1;
            $korisnik['ime'] = $v2;
            $korisnik['prezime'] = $v3;
            $korisnik['username'] = $v4;
            $korisnik['sifra'] = $v5;
            $korisnik['token'] = $v6;
            //array_push($korisnici, $korisnik);
        }
        //$rarray['korisnik'] = $korisnik;
        return json_encode($korisnik);
    } else {
        $rarray['error'] = "Please log in";
        header('HTTP/1.1 401 Unauthorized');
        return json_encode($rarray);
    }
}
function izmeniKorisnika($stariUsername, $noviUsername, $sifra, $ime, $prezime)
{
    global $conn;
    $rarray = array();
    $errors = "nema err";
    if (checkIfLoggedIn()) {
        $stmt = $conn->prepare("UPDATE korisnik SET ime = ?, prezime = ?, username = ?, sifra = ? WHERE username = ?");
        $pass = md5($password);
        $stmt->bind_param("sssss", $ime, $prezime, $noviUsername, $sifra, $stariUsername);
        if ($stmt->execute()) {
            $rarray['success'] = "Korisnik je uspesno azuriran";
        } else {
            header('HTTP/1.1 400 Bad request');
            $rarray['error'] = json_encode($errors);
        }
    } else {
        $rarray['error'] = "Please log in";
        header('HTTP/1.1 401 Unauthorized');
        return json_encode($rarray);
    }
    return json_encode($rarray);
}