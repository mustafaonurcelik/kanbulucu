<div class="row">
	<?php if($_POST): ?>
	<div class="col-sm-12">	
		<?php			
			include("assets/server/upload/lang/class.upload.tr_TR.php");
  			include("assets/server/upload/class.upload.php");

  			$adi 	 = $_POST["adi"];
			$turu 	 = $_POST["turu"];
			$sanatci = $_POST["sanatci"];
			$yili 	 = $_POST["yili"];
			$en 	 = $_POST["en"];
			$boy 	 = $_POST["boy"];
			$adet	 = $_POST["adet"];
			$foto 	 = $_FILES["foto"];
			$sanat 	 = $_POST['sanat'];
			$aciklama= $_POST["aciklama"];
			$fiyat	 = $_POST["fiyat"];
			$fotoName= rand(10,9999999999999);

			$ekleQ = "INSERT INTO urunler SET adi='$adi', turu='$turu', sanatci='$sanatci', yili='$yili', en='$en', boy='$boy', foto='$fotoName', aciklama='$aciklama', fiyat='$fiyat', sanat='$sanat'";
			$ekleQrun = mysqli_query($con, $ekleQ);

			if ($ekleQrun)
			{
				// last id'yi al...
				$last_id = mysqli_insert_id($con);
				$stokEkleQ = mysqli_query($con, "INSERT INTO stok SET urunid='$last_id', adet='$adet'");

				$uploader = new Upload($_FILES['foto']);
				if ($uploader->uploaded)
			    {
			      // ismi degistirilmis dosyayi upload etme..
			      $uploader->file_new_name_body = $fotoName;
			      $uploader->image_max_pixels = 999999999999999999999;
			      $uploader->image_convert  = jpg;
			      $uploader->Process('assets/images/urunler/');
			      if($uploader->processed)
			      {
			        $hata = false;
			      }
			      else
			      {
			        $hata = true;
			        //echo "<h2 style='color:red;'>(1)" . $uploader->error . "</h2>";
			      }
			    
			      // boyutu degistirilmis dosyayi upload etme..
			      $uploader->file_new_name_body = $fotoName;
			      $uploader->image_max_pixels = 999999999999999999999;
			      $uploader->image_resize   = true;
			      $uploader->image_convert  = jpg;
			      $uploader->image_x        = 100;
			      $uploader->image_ratio_y  = true;
			      $uploader->Process('assets/images/urunler/lr/');
			      if ($uploader->processed)
			      {
			        $hata = false;
			      }
			      else
			      {
			        $hata = true;
			        //echo "<h2 style='color:red;'>(2)" . $uploader->error . "</h2>";
			      }
			    }

			    if (!$hata):
			    	echo "<script>window.location.href=window.location.href=document.location.origin + document.location.pathname + '?page=urunler&subpage=liste';;</script>";
			    endif;

			}
		?>
	</div>	
	<?php endif; ?>	
	<div class="col-sm-12">
		<h2>Yeni Ürün Ekle</h2>
<form action="" method="POST" enctype="multipart/form-data">
		<table class="table table-striped table-bordered">
			<tr>
				<td>
					<div class="row">
						<div class="col-sm-6">
							<h4>Adı :</h4>
							<input type="text" id="adi" class="form-control" name="adi">
						</div>
						<div class="col-sm-6">
							<h4>Türü :</h4>
							<select name="turu" id="turu" class="form-control">
								<?php
									$turlerQ = mysqli_query($con, "SELECT * FROM turler");
									while($tur = mysqli_fetch_object($turlerQ))
									{
										echo "<option value='".$tur->id."'>".$tur->ad."</option>";
									}

								?>
							</select>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="row">
						<div class="col-sm-6">
							<h4>Sanatçı :</h4>
							<select name="sanatci" id="sanatci" class="form-control">
								<?php
									$sanatcilarQ = mysqli_query($con, "SELECT * FROM sanatcilar");
									while($sanatci = mysqli_fetch_object($sanatcilarQ))
									{
										echo "<option value='".$sanatci->id."'>".$sanatci->ad."</option>";
									}
								?>
							</select>
						</div>
						<div class="col-sm-6">
							<h4>Yılı :</h4>
							<input type="number" class="form-control" id="yili" name="yili">
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="row">
						<div class="col-sm-6">
							<h4>Genişlik : (cm)</h4>
							<input type="number" class="form-control" id="en" name="en">
						</div>
						<div class="col-sm-6">
							<h4>Yükseklik : (cm)</h4>
							<input type="number" class="form-control" id="boy" name="boy">
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="row">
						<div class="col-sm-6">
							<h4>Sanat :</h4>
							<select name="sanat" id="sanat" class="form-control">
								<?php
									$sanatQ = mysqli_query($con, "SELECT * FROM sanat");
									while($sanat = mysqli_fetch_object($sanatQ))
									{
										echo "<option value='".$sanat->id."'>".$sanat->ad."</option>";
									}
								?>
							</select>
						</div>
						<div class="col-sm-6">
							<h4>Fiyat : (TL)</h4>
							<input type="number" class="form-control" id="fiyat" name="fiyat">
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<h4>Açıklama : </h4>
					<textarea name="aciklama" id="aciklama" cols="30" rows="10" class="form-control"></textarea>
				</td>
			</tr>
			<tr>
				<td>
					<h4>Stok Adeti :</h4>
					<input type="number" id="adet" class="form-control" name="adet">
				</td>
			</tr>
			<tr>
				<td>
					<div class="row">
						<div class="col-sm-6">
							<h4>Resim :</h4>
							<input type="file" id="foto" name="foto">
						</div>
						<div class="col-sm-6">
							<h4 style="display:none;" id="fotoUploadMesaj"><i class='fa fa-fw fa-check'></i> Resim yükleme OK</h4>
							<h4 style="display:none;" id="fotoUploadLoading"><i class='fa fa-fw fa-spin fa-cog'></i> Resim yükleniyor...</h4>
							<h4 style="display:none;" id="fotoUploadHataMesaj"><i class='fa fa-fw fa-warning'></i> Resim yüklenemedi...</h4>
							<img src="" style="max-width:250px; display: none;" class="img-responsive" id="imgPlaceholder">
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="row">
						<div class="col-sm-12">
							<!-- <button class="btn btn-lg btn-success pull-right" onclick="urunler.yeni.kaydet();" id="yeniUrunKaydetButonu">
								Kaydet
							</button> -->
							<button class="btn btn-lg btn-success pull-right" type='submit' id="yeniUrunKaydetButonu">
								Kaydet
							</button>
						</div>
					</div>
				</td>
			</tr>
		</table>
</form>

	</div>
</div>