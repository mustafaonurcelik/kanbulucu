<?php $activePage = "home"; ?>
<?php if (!$_POST): ?>
<div class="row">
	<div class="col-sm-6 text-center">
        <br><br><br><br><br>
        <div style="width:300px;" class="pull-center">
            
                
                <strong>Kan Grubu :</strong>
                <select name="kangrubu" id="" class="form-control">
                    <?php kangruplari($db); ?>
                </select>
                <br>

                <strong>Şehir :</strong>
                <select name="sehir" id="iller" onchange="ileGoreIlceleriGetir()" class="form-control">
                    <?php iller($db); ?>
                </select>

                <strong>İlçe :</strong>
                <select name="ilce" id="ilceler" class="form-control">
                    
                </select>

                <input type="hidden" name='tip' value='kanariyorum'>
                <hr>
                <button class="btn btn-danger btn-block" onclick="kan_ariyorum.ilan.save()">Kan Arıyorum</button>
            
        </div>
	</div>
    <div class="col-sm-6 text-center">
        <br><br><br><br><br>
        <div style="width:300px;" class="pull-center">
            <form method="POST">
                <strong>Kan Grubu :</strong>
                <select name="kangrubu" id="" class="form-control">
                    <option value="arhp">A RH +</option>
                    <option value="arhn">A RH -</option>
                </select>
                <br>
                <strong>Şehir :</strong>
                <select name="sehir" id="" class="form-control">
                    <option value="14">Bolu</option>
                    <option value="34">İstanbul</option>
                </select>
                <input type="hidden" name='tip' value='kanveriyorum'>
                <hr>
                <button class="btn btn-primary btn-block">
                    Kan Vermek İstiyorum
                </button>
            </form>
        </div>
    </div>
</div>
<?php  else: ?>
<?php
    switch($_POST['tip'])
    {
        case "kanariyorum": print_r($_POST);
        /////////////////////////////////////////
        // KAN ARIYORUM
        /////////////////////////////////////////
        ?>

            <form method="POST">
                <select name="kangrubu" id="" class="form-control" value="<?php echo $_POST['kangrubu']; ?>">
                    <option value="arhp">A RH +</option>
                    <option value="arhn">A RH -</option>
                </select>
                <br>
                <select name="sehir" id="" class="form-control" value="<?php echo $_POST['sehir']; ?>">
                    <option value="14">Bolu</option>
                    <option value="34">İstanbul</option>
                </select>
                <input type="hidden" name='tip' value='kanariyorum'>
                <hr>
                <button class="btn btn-danger btn-block">Kan Arıyorum</button>
            </form>
        <?php     
        break;

        case "kanveriyorum": 
        /////////////////////////////////////////
        // KAN VERIYORUM
        /////////////////////////////////////////
        ?>
            kan veriyoreeee

        <?php
        break;
    }
?>

<?php endif; ?>
