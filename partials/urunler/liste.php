<?php $activePage = "urunListesi"; ?>
<style>
.tableImg
{
	min-height:100px;
	min-width:100px; 
	height:100px; 
	width:100px; 
	border:1px solid black; 
	background-position:center center;
}

#filtreBody {display: none;}
</style>
<?php
	$sanatciId  = $_GET["sanatciId"] || "";
	$turId		= $_GET["turId"] || "";
	$sanatId	= $_GET["sanatId"] || "";
?>
<?php if($isFilterable):?>
<div class="row">
	<div class="col-sm-12">
		
	</div>
</div>
<?php endif; ?>
<div class="row">
	<div class="col-sm-10 col-xs-12">
		<?php
			if ($_GET['search']):
				echo "<h4 style='margin-top:0px;'>Arama Sonuçları : </h4>";
			elseif ($_GET['sanatciId']):
				echo "<h4 style='margin-top:0px;'>";
				idToName($con, "sanatcilar", $_GET['sanatciId']);
				echo " Ürünleri</h4>";
			elseif ($_GET['listall']):
				echo "<h4 style='margin-top:0px;'>Bütün Ürünler</h4>";	
			else:
				echo "<h4 style='margin-top:0px;'>Son Eklenen Ürünler</h4>";
			endif;
		?>
	</div>
	<div class="col-sm-2 col-xs-12 text-right">
		<a href="?page=urunler&subpage=ekle" class="btn btn-success btn-block">
			<i class="fa fa-fw fa-plus"></i>
			Ürün Ekle
		</a>
	</div>
</div>
<div class="row">
	<div class="col-xs-12"><br/></div>
</div>
<div class="row">
	<div class="col-sm-3">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h4 class="panel-title">Filtre</h4>
			</div>
			<div class="panel-body">
				<div class="row" id="filtreToggleButton">
					<div class="col-xs-12">
						<button class="btn btn-default btn-block" onclick="filtreToggle();">
							Filtreyi göster <i class="fa fa-fw fa-arrow-down"></i>
						</button>
					</div>
				</div>
				<div class="row" id="filtreBody">
					<div class="col-sm-12">
						<form action="?page=urunler">
						<h5>Sanatçı : </h5>
						<select class="form-control" name='sanatciId'>
							<option value=''>Hepsi</option>
							<?php
								$sanatcilarQ = mysqli_query($con, "SELECT * FROM sanatcilar");
								while ($sanatci = mysqli_fetch_object($sanatcilarQ))
								{
									if ($_GET['sanatciId'] == $sanatci->id):
										echo "<option value='$sanatci->id' selected>";								
									else:
										echo "<option value='$sanatci->id'>";								
									endif;
	
									echo $sanatci->ad;
									echo "</option>";
								}
							?>
						</select>
					</div>
					<div class="col-sm-12">
						<h5>Tür : </h5>
						<select class="form-control" name='turId'>
							<option value=''>Hepsi</option>
							<?php
								$turlerQ = mysqli_query($con, "SELECT * FROM turler");
								while ($tur = mysqli_fetch_object($turlerQ))
								{
									
									if ($_GET['turId'] == $tur->id):
										echo "<option value='$tur->id' selected>";
									else:
										echo "<option value='$tur->id'>";
									endif;
									echo $tur->ad;
									echo "</option>";
								}
							?>
						</select>
					</div>
					<div class="col-sm-12">
						<h5>Sanat : </h5>
						<select class="form-control" name='sanatId'>
							<option value=''>Hepsi</option>
							<?php
								$sanatlarQ = mysqli_query($con, "SELECT * FROM sanat");
								while ($sanat = mysqli_fetch_object($sanatlarQ))
								{
									if ($_GET['sanatId'] == $sanat->id):
										echo "<option value='$sanat->id' selected>";								
									else:
										echo "<option value='$sanat->id'>";
									endif;
									echo $sanat->ad;
									echo "</option>";
								}
							?>
						</select>
					</div>
					<div class="col-sm-12">
						<h5>&nbsp;</h5>
						<input name='page' value='urunler' type="hidden"/>
						<input name='subpage' value='liste' type="hidden"/>
						<button class="btn btn-success btn-block"><i class='fa fa-fw fa-filter'></i> Filtrele</button>
						</form>
					</div>
				</div>

			</div>
		</div>
	</div>
	<div class="col-sm-9">
		<div class="bricklayer table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th width="100">Resim</th>
						<th>İsim, Özellikler</th>
						<th>Fiyat</th>
					</tr>
				</thead>
			<?php
				$filter 	= array();
				$isFilter 	= false;
				$isSearch 	= false;
				$isAll 		= false;
				if ($_GET["search"] != '')
				{ $searchQuery = stripslashes($_GET["search"]); $isSearch = true;}
				if ($_GET['sanatciId'] != '')
				{ $filter[] = 'sanatci = '.$_GET['sanatciId']; $isFilter = true;}
				if ($_GET['turId'] != '')
				{ $filter[] = 'turu = '.$_GET['turId']; $isFilter = true;}
				if ($_GET['sanatId'] != '')
				{ $filter[] = 'sanat  = '.$_GET['sanatId']; $isFilter = true;}
				if ($_GET['listall'] == 'true') { $isAll = true; }
				
				if($isSearch)
				{
					$getUrunler = mysqli_query($con, "SELECT * FROM urunler WHERE adi LIKE '%$searchQuery%'");
				}
				else if ($isFilter)
				{
					echo "<script>filtreToggle();</script>";
					$getUrunler = mysqli_query($con, 'SELECT * FROM urunler WHERE '.implode(' AND ', $filter) . ' ORDER BY id DESC');
				}
				else if ($isAll)
				{
					$getUrunler = mysqli_query($con, 'SELECT * FROM urunler ORDER BY id DESC');
				}
				else
				{
					$getUrunler = mysqli_query($con, 'SELECT * FROM urunler ORDER BY id DESC LIMIT 15');
				}
				
				while($urun = mysqli_fetch_object($getUrunler))
				{	
					echo "<tr>";
						echo "<td>";
							echo "<a href='?page=urunler&subpage=detay&id=".$urun->id."'>";
								echo "<div class='tableImg' style='background-image:url(assets/images/urunler/lr/".$urun->foto.".jpg); background-size:cover;'></div>";
							echo "</a>";
						echo "</td>";
						echo "<td valign='middle'>";
							echo "<h5 style='margin-bottom:0px;'>" . $urun->adi . "</h5>";
							echo "<p>";
								echo "<strong>";
								idToName($con, "sanatcilar", $urun->sanatci);
								echo "</strong>";
								echo ",<br/> ";
								idToName($con, "sanat", $urun->sanat);
								echo " ";
								idToName($con, "turler", $urun->turu);	
							echo "</p>";
						echo "</td>";
						echo "<td valign='right'>";
							echo "<h3>" + $urun->fiyat + "</h3>";
						echo "</td>";
					echo "</tr>";
				}
			?>
			</table>
			<br />
			<?php if(!$isAll):?>
				<a class="btn btn-success btn-block" href="?page=urunler&subpage=liste&listall=true">
					Tüm ürünleri göster
				</a>
				<br/><br/>
			<?php endif; ?>
		</div>
	</div>
</div>

<script>
	//$(function(){
		//var bricklayer = new Bricklayer(document.querySelector('.bricklayer'));
	//});
</script>