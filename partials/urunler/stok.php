<?php
	$activePage = "stok";
	$stoklarQ = mysqli_query($con, "SELECT * FROM stok");
	
	$tipler 	= array();
	$sanatcilar = array();
	$sanatlar 	= array();
	
	while ($stok = mysqli_fetch_object($stoklarQ))
	{
		$urun = mysqli_fetch_object(mysqli_query($con, "SELECT * FROM urunler WHERE id='$stok->urunid'"));
		if (!in_array($urun->turu, $tipler)):
			$tipler[] = $urun->turu;
		endif;
		
		if (!in_array($urun->sanatci, $sanatcilar)):
			$sanatcilar[] = $urun->sanatci;
		endif;
		
		if (!in_array($urun->sanat, $sanatlar)):
			$sanatlar[] = $urun->sanat;
		endif;
	}
?>

<div class="row">	
	
	<div class="col-sm-4">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h4 class="panel-title">Sanatçılara göre</h4>
			</div>
			<div class="panel-body">
				<?php
					echo "<table class='table table-bordered table-striped'>";
					echo "<thead><tr><th>Sanatçı</th><th>Toplam Adet</th></tr></thead>";
					echo "<tbody>";
					for ($i=0; $i<count($sanatcilar); $i++)
					{
						$getSanatciCount = mysqli_num_rows(mysqli_query($con, "SELECT * FROM urunler WHERE sanatci='$sanatcilar[$i]'"));
						echo "<tr>";
						echo "<td><a href='?sanatciId=".$sanatcilar[$i]."&turId=&sanatId=&page=urunler&subpage=liste'>";
							idToName($con, "sanatcilar", $sanatcilar[$i]);
						echo "</a></td>";
						echo "<td>$getSanatciCount</td>";
						echo "</tr>";
					}
					echo "</tbody></table>";
				?>
			</div>
		</div>		
	</div>
	
	<div class="col-sm-4">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h4 class="panel-title">Ürün tiplerine göre</h4>
			</div>
			<div class="panel-body">
				<?php
					echo "<table class='table table-bordered table-striped'>";
					echo "<thead><tr><th>Ürün Türü</th><th>Toplam Adet</th></tr></thead>";
					echo "<tbody>";
					for ($i=0; $i<count($tipler); $i++)
					{
						$getTipCount = mysqli_num_rows(mysqli_query($con, "SELECT * FROM urunler WHERE turu='$tipler[$i]'"));
						echo "<tr>";
						echo "<td><a href='?sanatciId=&turId=".$tipler[$i]."&sanatId=&page=urunler&subpage=liste'>";
							idToName($con, "turler", $tipler[$i]);
						echo "</a></td>";
						echo "<td>$getTipCount</td>";
						echo "</tr>";
					}
					echo "</tbody></table>";
				?>
			</div>
		</div>
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h4 class="panel-title">Sanat dalına göre</h4>
			</div>
			<div class="panel-body">
				<?php
					echo "<table class='table table-bordered table-striped'>";
					echo "<thead><tr><th>Sanatçı</th><th>Toplam Adet</th></tr></thead>";
					echo "<tbody>";
					for ($i=0; $i<count($sanatlar); $i++)
					{
						$getSanatCount = mysqli_num_rows(mysqli_query($con, "SELECT * FROM urunler WHERE sanat='$sanatlar[$i]'"));
						echo "<tr>";
						echo "<td><a href='?sanatciId=&turId=&sanatId=".$sanatlar[$i]."&page=urunler&subpage=liste'>";
							idToName($con, "sanat", $sanatlar[$i]);
						echo "</a></td>";
						echo "<td>$getSanatCount</td>";
						echo "</tr>";
					}
					echo "</tbody></table>";
				?>
			</div>
		</div>		
	</div>
	
	
	<div class="col-sm-4">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h4 class="panel-title">Toplam Ürün Sayısı</h4>
			</div>
			<div class="panel-body">
				<?php
					$hepsi = mysqli_num_rows(mysqli_query($con, "SELECT * FROM urunler"));
					echo "<h1 class='text-center'>$hepsi</h1>";
				?>
			</div>
		</div>		
	</div>
</div>


