<?php
	$activePage = "sanatDallari";
	$sanatlarQ = mysqli_query($con, "SELECT * FROM sanat");
?>
<table class='table table-striped table-bordered'>
	<thead>
		<tr>
			<th>İsim</th>
			<th>İşlem</th>
		</tr>
	</thead>
	<tbody>
	<?php
	while ($sanat = mysqli_fetch_object($sanatlarQ)){
		echo "<tr><td>".$sanat->ad."</td><td><button class='btn btn-danger btn-sm' onclick='urunler.sanatsil(".$sanat->id.");'>Sil</button></td></tr>";
	}
	?>
	</tbody>
	<tfoot>
		<tr>
			<td>
				<input type="text" placeholder="Yeni sanat dalı..." id="yenisanatadi" class="form-control">
			</td>
			<td>
				<button class='btn bnt-sm btn-success' onclick="urunler.yenisanatekle()">+ Yeni Sanat Ekle</button>
			</td>
		</tr>
	</tfoot>
</table>