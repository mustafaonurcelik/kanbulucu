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
// bagisi database'e yazdir
	case "bagiskaydet":
		$adsoyad 		= stripcslashes($_POST["adsoyad"]);
		$il 			= stripcslashes($_POST["il"]);
		$ilce			= stripcslashes($_POST["ilce"]);
		$kangrubu   	= stripcslashes($_POST["kangrubu"]);
		$eposta			= stripcslashes($_POST["eposta"]);
		$telefon		= stripcslashes($_POST["telefon"]);

		if ($db->exec("INSERT INTO donorler SET adsoyad='$adsoyad', sehir='$il', ilce='$ilce', kangrubu='$kangrubu', telefon='$telefon',eposta='$eposta'")):
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
} // switch ends here