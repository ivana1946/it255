<?php
session_start();

$prijavljen=false;

if(isset($_SESSION['prijavljen']) && $_SESSION['prijavljen']===true){
$prijavljen=true;
}

if(isset($_GET['id']) && !empty($_GET['id'])){
try
	{
		$dsn = new PDO('mysql:host=localhost;dbname=pz_volonteri',"root","");
		$dsn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT );

		$sql = "SELECT * FROM korisnik WHERE id = :id";
		$stmt = $dsn->prepare($sql);
		$stmt->bindParam(':id', $_GET['id']);
		
		$result = $stmt->execute();
		
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		if(count($rows) > 0)
			{
			?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $rows[0]['ime']; ?></title>
<link rel="stylesheet" href="stil.css">
</head>
<body>
<table align="center" width="900" border="1">
<tr>
<td colspan="2" align="center">
<ul class="meni"> 
<li><a href="index.html">Početna</a></li>
<li><a href="registracija.html">Registracija</a></li>

</ul>
</td>
</tr>
<tr>
<td width="200" valign="top">
<?php

if(!$prijavljen){
echo '
<p class="prijava">Prijava</p>
<form method="POST" action="prijava.php">
<label for="email">E-mail:</label>
<input type="text" name="email" id="email">
<br>
<label for="sifra">Šifra:</label>
<input type="password" name="sifra" id="sifra">
<br>
<div style="text-align:right;margin-right: 8px;"><input type="submit" name="prijava" value="Prijava"></div>
</form>';
}else{
echo 'Zdravo <strong>' . $_SESSION['ime'] . '</strong>!<br>';
if(isset($_SESSION['administrator']) && $_SESSION['administrator']===true){
	echo '<a href="nova_akcija.php">Upiši akciju</a><br>';
}
echo '<form action="odjava.php" method="post"><input type="submit" value="Odjavi me"></form>';
}
?>
</td>
<td valign="top">
<p>Ime: <?php echo $rows[0]['ime']; ?></p>
<p>Prezime: <?php echo $rows[0]['prezime']; ?></p>
<p>E-mail: <?php echo $rows[0]['email']; ?></p>
<p>Datum registracije: <?php echo $rows[0]['datum_registracije']; ?></p>
<p>O volonteru: <?php echo $rows[0]['o_sebi']; ?> </p>
</td>
</tr>
<tr>
<td colspan="2" align="center" style ="color:red">Ivana Stanković, 1946. </td>
</tr>
</table>
</body>
</html>		
			<?php
		}
		else
		{
			echo 'Korisnik ne postoji!';
		}
	}
	catch(Exception $ex)
	{
		echo "Nesto nece $ex";
	}
}else{
echo 'Korisnik ne postoji!';
}

?>