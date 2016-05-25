<?php

    $ilanid = $_GET[ilanid];

    $ilan = $db->query("SELECT * FROM ilanlar WHERE id='$ilanid'")->fetch();

    print_r($ilan);

?>

<table class="table table-bordered">
    <tr>
        <td>Ad Soyad</td>
        <td><?php echo $ilan[adsoyad]; ?></td>
    </tr>
    <tr>
        <td>Kan Grubu</td>
        <td><?php slugToName($db, $ilan[kangrubu]); ?></td>
    </tr>
</table>