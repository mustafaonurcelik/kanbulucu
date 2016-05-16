<?php
	$urunid = stripcslashes($_GET['id']);

	$getInfo = mysqli_query($con, "SELECT * FROM urunler WHERE id='$urunid'");
	$urun = mysqli_fetch_object($getInfo);

	$stok = mysqli_fetch_object(mysqli_query($con, "SELECT adet FROM stok WHERE urunid='$urun->id'"));
?>

<div class="row">
	<div class="col-sm-6 text-center">		
		<img class="img-responsive" src="assets/images/urunler/<?php echo $urun->foto; ?>.jpg" style=" max-height:400px; margin:0px auto;">
		<br />
		<a class="btn btn-default" href="assets/images/urunler/<?php echo $urun->foto; ?>.jpg" target="_blank">
			<i class="fa fa-fw fa-search"></i> Resmi büyüt
		</a>
	</div>
	<div class="col-sm-6">
		<table class="table table-striped">
			<tr>
				<td>
					<strong>Adı :</strong>			
				</td>
				<td>
					<?php echo $urun->adi; ?>
				</td>
			</tr>
			<tr>
				<td>
					<strong>Sanat :</strong>
				</td>
				<td>
					<?php idToName($con, "sanat", $urun->sanat); ?>
				</td>
			</tr>
			<tr>
				<td>
					<strong>Türü :</strong>
				</td>
				<td>
					<?php idToName($con, "turler", $urun->turu); ?>
				</td>
			</tr>
			<tr>
				<td>
					<strong>Sanatçı :</strong>
				</td>
				<td>
			<?php idToName($con, "sanatcilar", $urun->sanatci); ?>
				</td>
			</tr>
			<tr>
				<td>
					<strong>Yılı :</strong>
				</td>
				<td>
					<?php echo $urun->yili; ?>
				</td>
			</tr>
			<tr>
				<td>
					<strong>Boyutları : </strong>
				</td>
				<td>
					<strong><?php echo $urun->en; ?></strong>cm X <strong><?php echo $urun->boy; ?></strong>cm
				</td>
			</tr>
			<tr>
				<td>
					<strong>Açıklama :</strong>
				</td>
				<td>
					<?php echo $urun->aciklama; ?>
				</td>
			</tr>
			<tr>
				<td>
					<strong>Fiyat :</strong>
				</td>
				<td>
					<?php echo $urun->fiyat; ?> TL
				</td>
			</tr>
			<tr>
				<td>
					<strong>Stok adeti :</strong>
				</td>
				<td>
					<?php echo $stok->adet; ?>
				</td>
			</tr>
			<?php if (isset($_SESSION['admin'])): ?>
			<tr>
				<td>
					<strong>Satış :</strong>
				</td>
				<td>
					<?php if ($stok->adet > 0): ?>
					<!-- <button class="btn btn-default btn-success" onclick="urunler.stoktanDus(<?php echo $urun->id; ?>);">
						<i class="fa fa-shopping-cart"></i>
						Satış Yap
					</button> -->
					<button type="button" class="btn btn-info" data-toggle="modal" data-target="#satisModal">
						<i class="fa fa-fw fa-money"></i> Satış Yap
					</button>

					<?php else : ?>
						<button class="btn btn-danger">
							Ürün stokta yok!
						</button>
					<?php endif; ?>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<button class="btn btn-default" onclick="urunler.barkodOlustur(<?php echo $urun->id; ?>);">
						<i class="fa fa-qrcode"></i>
						Barkod oluştur
					</button>
					<a class="btn btn-primary" href="?page=urunler&subpage=duzenle&urunid=<?php echo $urun->id; ?>">
						<i class="fa fa-edit"></i>
						Ürünü Düzenle
					</a>
					<button class="btn btn-danger" onclick="urunler.sil(<?php echo $urun->id; ?>);">
						<i class="fa fa-remove"></i>
						Ürünü sil
					</button>
				</td>
			</tr>
			<?php endif; ?>
		</table>
	</div>
</div>

<!-- Modal -->
<div id="satisModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <table class="table table-bordered table-striped">
			<tr>
    			<td>
    				<img src="assets/images/urunler/lr/<?php echo $urun->foto ?>.jpg" alt="">
    			</td>
    			<td>
    				<h4><?php echo $urun->adi ?></h4>
    			</td>
			</tr>
          	<tr>
            	<td><strong>Adet :</strong></td>
            	<td>
              		<input type="number" id="satisadeti" class="form-control" value="1">
            	</td>
          	</tr>
          	<tr>
            	<td><strong>Lokasyon : </strong></td>
            	<td>
	              	<select name="" id="satislokasyonu" class="form-control">
	                <?php
	                  $lokasyonlarQ = mysqli_query($con, "SELECT * FROM lokasyonlar");
	                  while ($lokasyon = mysqli_fetch_object($lokasyonlarQ)):
	                    echo "<option value='$lokasyon->id'>$lokasyon->adi</option>";
	                  endwhile;
	                ?>
	              	</select>
            	</td>
          	</tr>
          	<tr>
            	<td><strong>Not :</strong></td>
            	<td>
              		<textarea name="" id="not" cols="30" rows="3" class="form-control"></textarea>
            	</td>
          	</tr>
          	<tr>
            	<td colspan="2" align="center">
            		<input type="hidden" id="tutar" value="<?php echo $urun->fiyat; ?>" hidden="hidden">
              		<button class="btn btn-success" onclick="satis.tamamla(<?php echo $urun->id; ?>);">
                		<i class="fa fa-fw fa-check"></i> Satışı tamamla
              		</button>
            	</td>
          	</tr>
        </table>
      </div>
    </div>
  </div>
</div>