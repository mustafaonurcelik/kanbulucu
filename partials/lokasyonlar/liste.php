<?php
    $activePage = "lokasyonlarListesi";
    $lokasyonlarQ = mysqli_query($con, "SELECT * FROM lokasyonlar");
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
    while ($lokasyon = mysqli_fetch_object($lokasyonlarQ)){
        echo "<tr><td>".$lokasyon->adi."</td><td><button class='btn btn-danger btn-sm' onclick='lokasyon.sil(".$lokasyon->id.");'>Sil</button></td></tr>";
    }
    ?>
    </tbody>
    <tfoot>
        <tr>
            <td>
                <input type="text" placeholder="Yeni Lokasyon adı..." id="yenilokasyonadi" class="form-control">
            </td>
            <td>
                <button class='btn bnt-sm btn-success' onclick="lokasyon.ekle()">+ Yeni Lokasyon Ekle</button>
            </td>
        </tr>
    </tfoot>
</table>