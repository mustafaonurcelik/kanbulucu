<br><br>
<div class="row">
    <?php if ($_POST): ?>
        <div class="col-sm-12">
        <?php
            $checkQ = mysqli_query($con, "SELECT * FROM kullanicilar WHERE kullaniciadi='$_POST[username]' AND sifre='$_POST[password]'");
            if (mysqli_num_rows($checkQ)):
                $user = mysqli_fetch_object($checkQ);
                $_SESSION['admin']                  = array();
                $_SESSION['admin']['ad']            = $user->ad;
                $_SESSION['admin']['soyad']         = $user->soyad;
                $_SESSION['admin']['email']         = $user->email;
                $_SESSION['admin']['kullaniciadi']  = $user->kullaniciadi;
                echo "<script>window.location.href=window.location.href=document.location.origin + document.location.pathname + '?page=home';</script>";
            else: ?>
            <div class="col-sm-4 col-sm-offset-4">
                <div class="alert alert-dismissible alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>HATA!</strong>Kullanıcı adı veya şifreniz yanlış. Lütfen tekrar deneyiniz.
                </div>    
            </div>
            <?php
            endif;
        ?>
        </div>
    <?php endif; ?>
	<div class="col-sm-4 col-sm-offset-4">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h4 class="panel-title">Lütfen giriş yapınız</h4>
            </div>
            <div class="panel-body">
        		<form action="" method="POST">
                    <input type="text" name="username" placeholder="Kullanıcı Adı" class="form-control">
                    <input type="password" name="password" placeholder="Şifre" class="form-control">
                    <br>
                    <button type="submit" class="btn btn-success">Giriş</button>
                </form>
            </div>
        </div>
	</div>
</div>