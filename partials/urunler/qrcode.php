<script src="assets/javascript/jquery.qrcode-0.12.0.min.js"></script>
<?php
	$urunid = $_GET["urunid"];
?>
<div id="qr"></div>
<script>

	$(function(){
		var urunid = "<?php echo $urunid; ?>";
		var fullurl = document.location.origin + document.location.pathname + "?page=urunler&subpage=detay&id="+urunid;
		$('#qr').qrcode({
			render : 'image',
			size : 100,
			text : fullurl
		});
	});
</script>