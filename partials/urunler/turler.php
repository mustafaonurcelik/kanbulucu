<?php
	$activePage = "urunTurleri";
	$turlerQ = mysqli_query($con, "SELECT * FROM turler");
?>
<table class='table table-striped table-bordered table-hover'>
	<thead>
		<tr>
			<th>İsim</th>
			<th>İşlem</th>
		</tr>
	</thead>
	<tbody>
	<?php
	while ($tur = mysqli_fetch_object($turlerQ)){
		echo "<tr><td>".$tur->ad."</td><td><button class='btn btn-danger btn-sm' onclick='urunler.tursil(".$tur->id.");'>Sil</button></td></tr>";
	}
	?>
	</tbody>
	<tfoot>
		<tr>
			<td>
				<input type="text" placeholder="Yeni tür adı..." id="yenituradi" class="form-control">
			</td>
			<td>
				<button class='btn bnt-sm btn-success' onclick="urunler.yeniturekle()">+ Yeni Tür Ekle</button>
			</td>
		</tr>
	</tfoot>
</table>