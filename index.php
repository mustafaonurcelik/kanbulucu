<?php session_start(); ob_start(); ?>
<!DOCTYPE html>
<html lang="tr_TR">
	<head>
		<?php include("partials/common/header.php"); ?>
		<?php include("assets/server/functions.php"); ?>
	</head>
	<body>
		<?php if (isset($_SESSION['admin'])): ?>
			<nav class="navbar navbar-inverse navbar-fixed-top col-sm-12">
			    <!-- Brand and toggle get grouped for better mobile display -->
			    <div class="container">
			    <div class="navbar-header">
			      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			      <a class="navbar-brand" href="?page=home">Atölye Stok</a>
			    </div>

			    <!-- Collect the nav links, forms, and other content for toggling -->
			    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			      <ul class="nav navbar-nav" id="navigasyon">
			        <li id="home"><a href="?page=home">Rapor</a></li>
			        <li id="urunListesi"><a href="?page=urunler&subpage=liste">Ürünler</a></li>
			        <li id="stok"><a href="?page=urunler&subpage=stok">Stok</a></li>
			        <li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">Ayarlar <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li id="urunTurleri"><a href="?page=urunler&subpage=turler"><i class="fa fa-fw fa-list"></i> Ürün Türleri</a></li>
							<li id="sanatciListesi"><a href="?page=sanatcilar&subpage=liste"><i class="fa fa-fw fa-users"></i> Sanatçılar</a></li>
							<li id="sanatDallari"><a href="?page=urunler&subpage=sanatlar"><i class="fa fa-fw fa-paint-brush"></i> Sanat Dalları</a></li>
							<li id="lokasyonlarListesi"><a href="?page=lokasyonlar&subpage=liste"><i class="fa fa-fw fa-map-marker"></i> Lokasyonlar</a></li>
							<!-- <li class="divider"></li> -->
						</ul>
			        </li>
			        <li><a href="?page=common&subpage=logout">Çıkış</a></li>
			      </ul>
			      <form class="navbar-form navbar-right" role="search" action="?page=urunler&subpage=liste" method="get">
			        <div class="form-group">
			          <input type="text" class="form-control" name="search" placeholder="Ürün adı" value="<?php if($searchTyped){ echo $searchQuery;} ?>">
			        </div>
			        <button type="submit" class="btn btn-default">Ara</button>
			      </form>
			    </div><!-- /.navbar-collapse -->
			</nav>
		</div>
	<?php endif; ?>
		<div class="container">
			<?php include("partials/".$page."/".$subpage.".php"); ?>

			<?php include("partials/common/footer.php"); ?>
		</div>
	</body>
</html>