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


		if ($db->exec("INSERT INTO ilanlar SET adsoyad='$adsoyad', il='$il'")):
			echo 1;
		else:
			echo 0;
		endif;

	break;
} // switch ends here