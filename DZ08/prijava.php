<?php
header('Content-Type: text/html; charset=utf-8');

if (!empty($_POST['email'])
 && !empty($_POST['sifra']))
{
	try
	{
		$dsn = new PDO('mysql:host=localhost;dbname=pz_volonteri',"root","");
		$dsn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT );

		$sql = "SELECT * FROM korisnik WHERE email = :email";
		$stmt = $dsn->prepare($sql);
		$stmt->bindParam(':email', $_POST['email']);
		
		$result = $stmt->execute();
		
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		if(count($rows) > 0)
		{
			if($_POST['sifra']==$rows[0]['sifra']){
			session_start();
			$_SESSION['prijavljen'] = true;
			$_SESSION['administrator'] = ($rows[0]['administrator'] == 1) ? true : false;
			$_SESSION['id'] = $rows[0]['id'];
			$_SESSION['ime'] = $rows[0]['ime'];

			header('Location: index.html');
			exit;
			} else {
				echo 'Pogrešna šifra!';
			}
		}
		else
		{
			echo 'Korisnik sa unetim e-mailom ne postoji!';

		}
	}
	catch(Exception $ex)
	{
		echo "Nesto nece $ex";
	}
}else{
echo "Morate popuniti sva polja!";
}
?>