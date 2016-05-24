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
	case "ilankaydet":
		$adsoyad 	= stripcslashes($_POST["adsoyad"]);
		$il 		= stripcslashes($_POST["il"]);
		$ilce		= stripcslashes($_POST["ilce"]);
		$tarih      = $timestamp = date(‘d-m-Y’);

		if ($db->exec("INSERT INTO ilanlar SET adsoyad='$adsoyad', il='$il'")):
			echo 1;
		else:
			echo 0;
		endif;

	break;

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