<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>
	Taner Alakuş Atölyesi
</title>
<!-- JQUERY -->
<script type="text/javascript" src="assets/javascript/jquery.min.js"></script>
<!-- FONT : ROBOTO -->
<link rel="stylesheet" href="assets/css/roboto.css">
<!-- BOOTSTRAP -->
<link rel="stylesheet" href="assets/css/bootstrap.paper.css"/>
<script src="assets/javascript/bootstrap.min.js"></script>
<!-- FONT AWESOME -->
<link rel="stylesheet" href="assets/css/font-awesome.min.css">
<!-- SCRIPTS -->
<script src="assets/javascript/app.js"></script>

<?php
error_reporting(0);

$page    		= addslashes($_GET["page"]);
$subpage 		= addslashes($_GET["subpage"]);
$search  		= $_GET["search"];
$searchTyped 	= false;
$isFilterable	= true;
if (!$page) $page = "home";
if (!$subpage) $subpage = "index";
if ($search) 
{
	$page 			= "urunler"; 
	$subpage 		= "liste"; 
	$searchTyped 	= true; 
	$searchQuery 	= stripslashes($_GET["search"]);
	$isFilterable 	= false;
}
$user 		= 'root';
$password 	= 'onur1896';
$db 		= 'kariye';
$host 		= 'localhost';
$port 		= 3306;
$con 		= mysqli_connect($host,$user,$password,$db,$port);
			  mysqli_set_charset($con,"utf8");

if (!isset($_SESSION['admin'])):
    if ($subpage != 'login' && $subpage != 'detay'):
        echo "<script>window.location.href=window.location.href=document.location.origin + document.location.pathname + '?page=common&subpage=login';</script>";
    endif;
endif;
?>
<style>
	.table > tbody > tr > td {
	     vertical-align: middle;
	}
  body { padding-top: 80px; }
</style>
<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <h2><i class="fa fa-cog fa-spin fa-fw margin-bottom"></i> Lütfen bekleyiniz...</h2>
      </div>
    </div>
  </div>
</div>