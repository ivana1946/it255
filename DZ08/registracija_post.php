<?php


if (!empty($_POST['ime'])
 && !empty($_POST['prezime']) && !empty($_POST['email']) && !empty($_POST['sifra']))
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
			echo "Email vec postoji!";
		}
		else
		{
			$sql = "INSERT INTO korisnik (ime, prezime, email, sifra, o_sebi, datum_registracije) VALUES (:ime, :prezime, :email, :sifra, :o_sebi, NOW())";
			$stmt = $dsn->prepare($sql);
			$stmt->bindParam(':ime', $_POST['ime']);
			$stmt->bindParam(':prezime', $_POST['prezime']);
			$stmt->bindParam(':email', $_POST['email']);
			$stmt->bindParam(':sifra', $_POST['sifra']);
			$stmt->bindParam(':o_sebi', $_POST['o_sebi']);
			
			$stmt->execute();

			session_start();
			$_SESSION['prijavljen'] = true;
			$_SESSION['administrator'] = false;
			$_SESSION['id'] = $dsn->lastInsertId();
			$_SESSION['ime'] = $_POST['ime'];

			header('Location: index.php');
			exit;
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