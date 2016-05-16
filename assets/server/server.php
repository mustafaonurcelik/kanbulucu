<?php
$job = $_POST["job"];

$imgbase = "/var/www/html/kariye/assets/images/urunler/";
$user 		= 'root';
$password 	= 'onur1896';
$db 		= 'kariye';
$host 		= 'localhost';
$port 		= 3306;
$con 		= mysqli_connect($host,$user,$password,$db,$port);
			  mysqli_set_charset($con,"utf8");

switch($job)
{
	case "yeniurunkaydet":
		$adi 	 = $_POST["adi"];
		$turu 	 = $_POST["turu"];
		$sanatci = $_POST["sanatci"];
		$yili 	 = $_POST["yili"];
		$en 	 = $_POST["en"];
		$boy 	 = $_POST["boy"];
		$adet	 = $_POST["adet"];
		$foto 	 = $_POST["foto"];
		$sanat 	 = $_POST['sanat'];
		$aciklama= $_POST["aciklama"];
		$fiyat	 = $_POST["fiyat"];
		
		$foto 	 = explode(',', $foto)[1];
		$foto	 = base64_decode($foto);
		$fotoName= rand(10,9999999999999);

		if (file_put_contents($imgbase.$fotoName.'.jpg', $foto)):
			$ekleQ = "INSERT INTO urunler SET adi='$adi', turu='$turu', sanatci='$sanatci', yili='$yili', en='$en', boy='$boy', foto='$fotoName', aciklama='$aciklama', fiyat='$fiyat', sanat='$sanat'";
			$ekleQrun = mysqli_query($con, $ekleQ);
			$last_id = mysqli_insert_id($con);

			if ($ekleQrun)
			{
				$stokEkleQ = mysqli_query($con, "INSERT INTO stok SET urunid='$last_id', adet='$adet'");
				echo 1;
			}
			else
			{
				echo 2;
			}
		else:
			echo 0;
		endif;

	break;
	
	case "urunguncelle":
		$id		 = $_POST["id"];
		$adi 	 = $_POST["adi"];
		$turu 	 = $_POST["turu"];
		$sanatci = $_POST["sanatci"];
		$yili 	 = $_POST["yili"];
		$en 	 = $_POST["en"];
		$boy 	 = $_POST["boy"];
		$adet	 = $_POST["adet"];
		$foto 	 = $_POST["foto"];
		$sanat 	 = $_POST['sanat'];
		$aciklama= $_POST["aciklama"];
		$fiyat	 = $_POST["fiyat"];
		
		$q = "UPDATE urunler SET adi='$adi', turu='$turu', sanatci='$sanatci', yili='$yili', en='$en', boy='$boy', aciklama='$aciklama', fiyat='$fiyat', sanat='$sanat' WHERE id='$id'";
		if (mysqli_query($con, $q))
		{
			$checkStokQ = mysqli_num_rows(mysqli_query($con, "SELECT * FROM stok WHERE urunid='$id'"));
			if ($checkStokQ < 1):
				$stokEkleQ = mysqli_query($con, "INSERT INTO stok SET urunid='$id', adet='$adet'");
			else:
				$stokGuncelle = mysqli_query($con, "UPDATE stok SET adet='$adet' WHERE urunid='$id'");
			endif;
			echo 1;
		}
		else
		{
			echo 0;
		}
	break;

	case "yeniturekle":

		$yenituradi = $_POST["yenituradi"];

		if (mysqli_query($con, "INSERT INTO turler SET ad='$yenituradi'"))
		{
			echo 1;
		}
		else
		{
			echo 0;
		}

	break;

	case "tursil":
		$turid = $_POST["turid"];
		if (mysqli_query($con, "DELETE FROM turler WHERE id='$turid'"))
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	break;
	
	case "yenisanatekle":

		$yenisanatadi = $_POST["yenisanatadi"];

		if (mysqli_query($con, "INSERT INTO sanat SET ad='$yenisanatadi'"))
		{
			echo 1;
		}
		else
		{
			echo 0;
		}

	break;

	case "sanatsil":
		$sanatid = $_POST["sanatid"];
		if (mysqli_query($con, "DELETE FROM sanat WHERE id='$sanatid'"))
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	break;

	case "yenisanatciekle":

		$yenisanatciadi = $_POST["yenisanatciadi"];

		if (mysqli_query($con, "INSERT INTO sanatcilar SET ad='$yenisanatciadi'"))
		{
			echo 1;
		}
		else
		{
			echo 0;
		}

	break;

	case "sanatcisil":
		$sanatciid = $_POST["sanatciid"];
		if (mysqli_query($con, "DELETE FROM sanatcilar WHERE id='$sanatciid'"))
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	break;

	case "yenilokasyonekle":

		$yenilokasyonadi = $_POST["yenilokasyonadi"];

		if (mysqli_query($con, "INSERT INTO lokasyonlar SET adi='$yenilokasyonadi'"))
		{
			echo 1;
		}
		else
		{
			echo 0;
		}

	break;

	case "lokasyonsil":
		$lokasyonid = $_POST["lokasyonid"];
		if (mysqli_query($con, "DELETE FROM lokasyonlar WHERE id='$lokasyonid'"))
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	break;


	case "stoktandus":
		$urunid = $_POST["urunid"];
		$urun = mysqli_fetch_object(mysqli_query($con, "SELECT * FROM stok WHERE urunid='$urunid'"));
		if ($urun->adet > 0):
			$yenirakam = ($urun->adet - 1);
		else:
			echo 2;
			die();
		endif;

		if (mysqli_query($con, "UPDATE stok SET adet='$yenirakam' WHERE urunid='$urunid'"))
		{
			echo 1;
		}
		else
		{
			echo 0;
		}
	break;
	
	case "urunsil":
		$urunid = $_POST["urunid"];
		$urunResmi = mysqli_fetch_object(mysqli_query($con, "SELECT foto FROM urunler WHERE id='$urunid'"));
		//echo $urunResmi->foto;
		if (mysqli_query($con, "DELETE FROM urunler WHERE id='$urunid'"))
		{	
			unlink($imgbase."".$urunResmi->foto.".jpg");
			unlink($imgbase."lr/".$urunResmi->foto.".jpg");
			mysqli_query($con, "DELETE FROM stok WHERE urunid='$urunid'");
			echo 1;
		}
		else
		{
			echo 0;
		}
	break;

	case "satistamamla":
		$gun 		= date("d");
		$ay 		= date("m");
		$yil 		= date("Y");
		$hafta		= date("W");
		$adet		= $_POST['adet'];
		$urunid		= $_POST['urunid'];
		$satisnot 	= $_POST['not'];
		$lokasyon 	= $_POST['lokasyon'];
		$tutar		= $_POST['tutar'];
		//echo "gun : $gun | ay : $ay | yil : $yil | hafta: $hafta | adet : $adet | urunid : $urunid | not : $not | lokasyon : $lokasyon | tutar : $tutar "; die();
		if (mysqli_query($con, "INSERT INTO satislar SET tutar='$tutar', gun='$gun', ay='$ay', yil='$yil', hafta='$hafta', urunid='$urunid', lokasyon='$lokasyon', satisnot='$satisnot', adet='$adet'")):
			$urunStok = mysqli_fetch_object(mysqli_query($con, "SELECT * FROM stok WHERE urunid='$urunid'"));
			$yenirakam = $urunStok->adet - $adet;
			if (mysqli_query($con, "UPDATE stok SET adet='$yenirakam' WHERE urunid='$urunid'")):
				echo 1;
			else:
				echo 0;
			endif;
		else:
			echo 2;
		endif;
	break;
} // switch ends here