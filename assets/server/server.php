<?php
$job = $_POST["job"];
try
{
	$db = new PDO("mysql:host=localhost;dbname=kanbulucu","root","root");
} 
catch(PDOException $e) 
{
	echo $e->getMessage();
}
$db->exec("SET NAMES 'UTF8'");

switch($job)
{
// ilani database'e yazdir
	case "ilankaydet":
		$adsoyad 		= stripcslashes($_POST["adsoyad"]);
		$il 			= stripcslashes($_POST["il"]);
		$ilce			= stripcslashes($_POST["ilce"]);
		$tarih          = date("d-m-Y");
		$kangrubu   	= stripcslashes($_POST["kangrubu"]);
		$eposta			= stripcslashes($_POST["eposta"]);
		$telefon		= stripcslashes($_POST["telefon"]);
		$kullanicinotu	= stripcslashes($_POST["kullanicinotu"]);

		if ($db->exec("INSERT INTO ilanlar SET adsoyad='$adsoyad', il='$il', ilce='$ilce', tarih='$tarih', kangrubu='$kangrubu', telefon='$telefon',eposta='$eposta',kullanicinotu='$kullanicinotu'")):
			echo $db->lastInsertId();
		else:
			echo 0;
		endif;

	break;
// bagisi database'e yazdir//
	case "bagiskaydet":
		$adsoyad 		= stripcslashes($_POST["adsoyad"]);
		$il 			= stripcslashes($_POST["il"]);
		$ilce			= stripcslashes($_POST["ilce"]);
		$kangrubu   	= stripcslashes($_POST["kangrubu"]);
		$eposta			= stripcslashes($_POST["eposta"]);
		$telefon		= stripcslashes($_POST["telefon"]);
		$sifre  		= stripcslashes($_POST["sifre"]);
		$tgoster 		= stripcslashes($_POST["tgoster"]);

		if ($db->exec("INSERT INTO donorler SET adsoyad='$adsoyad', sehir='$il', ilce='$ilce', kangrubu='$kangrubu', telefon='$telefon',eposta='$eposta',sifre='$sifre',telefonumugoster='$tgoster'")):
			echo $db->lastInsertId();
		else:
			echo 0;
		endif;

	break;
// illere gore ilceleri database'den al
	case "ileGoreIlceleriGetir":
		$il_id = $_POST['il_id'];
		$ileGoreIlceler = array();
		
		foreach($db->query("SELECT * FROM ilceler WHERE il_id='$il_id'") as $ilce):
			$ilcebilgileri = array(
					id => $ilce['id'],
					baslik => $ilce['baslik']
				);

			$ileGoreIlceler[]=$ilcebilgileri;
		endforeach;

		echo json_encode($ileGoreIlceler);
		
	break;
// uygun ildeki donorleri databse'den al
	case "uygunIleGoreDonorler":
		$il_id = $_POST['il_id'];

		$ilanaGoreDonorler = array();
		foreach($db->query("SELECT * FROM donorler WHERE sehir='$il_id'") as $donor):
			$ilcebilgileri = array(
					adsoyad => $donor['adsoyad'],
					ilce    => $donor['ilce'],
					eposta  => $donor['eposta'],
					telefon => $donor['telefon']
				);

			$ilanaGoreDonorler[]=$ilcebilgileri;
		endforeach;
//		print_r($ilanaGoreDonorler);
		echo json_encode($ilanaGoreDonorler);
		
	break;
} // switch ends here






	










