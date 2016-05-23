<?php session_start(); ob_start(); ?>
<!DOCTYPE html>
<html lang="tr_TR">
	<head>
		<?php include("partials/common/header.php"); ?>
		<?php include("assets/server/functions.php"); ?>
	</head>
	<body>
		<?php
			try
			{
				$db = new PDO("mysql:host=localhost;dbname=kanbulucu","root","root");
			} 
			catch(PDOException $e) 
			{
				echo $e->getMessage();
			}
			//$db->exec("SET NAMES utf-8");

			// if ($db->exec("INSERT INTO donorler SET adsoyad='Mustafa Onur Çelik', eposta='onurcelik@me.com'")):
			// 	echo $db->lastInsertId() . "basarili";
			// else:
			// 	echo "Hata : " . $db->errorInfo()[2];
			// endif;
		?>
		<div class="container">
			<?php include("partials/".$page."/".$subpage.".php"); ?>
			<?php include("partials/common/footer.php"); ?>
		</div>
	</body>
</html>