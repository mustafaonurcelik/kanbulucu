<?php
	$activePage = "sanatciListesi";
	$sanatcilarQ = mysqli_query($con, "SELECT * FROM sanatcilar");
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
	while ($sanatci = mysqli_fetch_object($sanatcilarQ)){
		echo "<tr><td>".$sanatci->ad."</td><td><button class='btn btn-danger btn-sm' onclick='sanatcilar.sil(".$sanatci->id.");'>Sil</button></td></tr>";
	}
	?>
	</tbody>
	<tfoot>
		<tr>
			<td>
				<input type="text" placeholder="Yeni Sanatçı adı..." id="yenisanatciadi" class="form-control">
			</td>
			<td>
				<button class='btn bnt-sm btn-success' onclick="sanatcilar.ekle()">+ Yeni Sanatçı Ekle</button>
			</td>
		</tr>
	</tfoot>
</table>