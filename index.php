<?php session_start(); ob_start(); ?>
<!DOCTYPE html>
<html lang="tr_TR">
	<head>
		<?php include("partials/common/header.php"); ?>
		<?php include("assets/server/functions.php"); ?>
	</head>
	<body>
		<div class="container">
			<?php include("partials/".$page."/".$subpage.".php"); ?>

			<?php include("partials/common/footer.php"); ?>
		</div>
	</body>
</html>