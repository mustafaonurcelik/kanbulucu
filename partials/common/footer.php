<div class="row">
	<div class="col-sm-12">
		<script>
			$(function(){
				$('#navigasyon li.active').removeClass("active");
				var activePage = "<?php echo $activePage; ?>";
				if (activePage){
					//$('#navigasyon li#'+activePage).addClass('active');	
				}
			});
		</script>
	</div>
</div>