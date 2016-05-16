<?php
	$urunid = stripslashes($_GET["urunid"]);
	$q 		= mysqli_query($con, "SELECT * FROM urunler WHERE id='$urunid'");
	$urun  	= mysqli_fetch_object($q);
	$stok 	= mysqli_fetch_object(mysqli_query($con, "SELECT adet FROM stok WHERE urunid='$urunid'"));
	$stokadeti = (!$stok->adet) ? 0 : $stok->adet;
?>
<input type="hidden" id="urunid" value="<?php echo $urunid; ?>" />
<div class="row">
	<div class="col-sm-12">
		<h2>Ürün Güncelle</h2>

		<table class="table table-striped table-bordered">
			<tr>
				<td>
					<div class="row">
						<div class="col-sm-6">
							<h4>Adı :</h4>
							<input type="text" id="adi" class="form-control" value="<?php echo $urun->adi; ?>">
						</div>
						<div class="col-sm-6">
							<h4>Türü :</h4>
							<select name="turu" id="turu" class="form-control">
								<?php
									$turlerQ = mysqli_query($con, "SELECT * FROM turler");
									while($tur = mysqli_fetch_object($turlerQ))
									{
										if ($tur->id == $urun->turu):
											echo "<option value='".$tur->id."' selected='selected'>".$tur->ad."</option>";
										else:
											echo "<option value='".$tur->id."'>".$tur->ad."</option>";
										endif;
										
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
							<select name="" id="sanatci" class="form-control">
								<?php
									$sanatcilarQ = mysqli_query($con, "SELECT * FROM sanatcilar");
									while($sanatci = mysqli_fetch_object($sanatcilarQ))
									{
										if ($sanatci->id == $urun->sanatci):
											echo "<option value='".$sanatci->id."' selected='selected'>".$sanatci->ad."</option>";
										else:
											echo "<option value='".$sanatci->id."'>".$sanatci->ad."</option>";
										endif;
									}
								?>
							</select>
						</div>
						<div class="col-sm-6">
							<h4>Yılı :</h4>
							<input type="number" class="form-control" id="yili" value="<?php echo $urun->yili; ?>">
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="row">
						<div class="col-sm-6">
							<h4>Genişlik : (cm)</h4>
							<input type="number" class="form-control" id="en"  value="<?php echo $urun->en; ?>">
						</div>
						<div class="col-sm-6">
							<h4>Yükseklik : (cm)</h4>
							<input type="number" class="form-control" id="boy" value="<?php echo $urun->boy; ?>">
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div class="row">
						<div class="col-sm-6">
							<h4>Sanat :</h4>
							<select name="" id="sanat" class="form-control">
								<?php
									$sanatQ = mysqli_query($con, "SELECT * FROM sanat");
									while($sanat = mysqli_fetch_object($sanatQ))
									{
										if ($urun->sanat == $sanat->id):
											echo "<option value='".$sanat->id."' selected='selected'>".$sanat->ad."</option>";
										else:
											echo "<option value='".$sanat->id."'>".$sanat->ad."</option>";
										endif;
									}
								?>
							</select>
						</div>
						<div class="col-sm-6">
							<h4>Fiyat : (TL)</h4>
							<input type="number" class="form-control" id="fiyat" value="<?php echo $urun->fiyat; ?>">
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<h4>Açıklama : </h4>
					<textarea name="" id="aciklama" cols="30" rows="10" class="form-control"><?php echo $urun->aciklama; ?></textarea>
				</td>
			</tr>
			<tr>
				<td>
					<h4>Stok Adeti :</h4>
					<input type="number" id="adet" class="form-control" value="<?php echo $stokadeti;?>">
				</td>
			</tr>
			<tr>
				<td>
					<div class="row">
						<div class="col-sm-6">
							<h4>Resim :</h4>
							<img src="assets/images/urunler/<?php echo $urun->foto; ?>.jpg" style="max-height:300px;"/>
						</div>
						<div class="col-sm-3">
							<img src="" style="max-width:200px; display: none;" id="imgPlaceholder">
						</div>
						<div class="col-sm-3">
							<button class="btn btn-lg btn-success pull-right" onclick="urunler.guncelle();">
								Güncelle
							</button>
						</div>
					</div>
				</td>
			</tr>
		</table>


	</div>
</div>