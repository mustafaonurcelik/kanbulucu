<?php
  include("assets/server/upload/lang/class.upload.tr_TR.php");
  include("assets/server/upload/class.upload.php");
  
  $dir = "assets/server/upload/depo/urunler/kalanlar/";
  $files = scandir($dir);

  foreach ($files as $index => $filename) {
    if ($filename != '.' && $filename != '..' && $filename != 'lr'):
      $uploader = new Upload($dir.$filename);
      if ($uploader->uploaded)
      {
        $uploader->image_resize   = true;
        $uploader->image_convert  = jpg;
        $uploader->image_x        = 100;
        $uploader->image_ratio_y  = true;
        $uploader->Process('assets/server/upload/depo/urunler/lr/');
        if ($uploader->processed)
        {
          echo "<h4>$index - $filename kucultuldu.. </h4>";
        }
        else
        {
          echo "<h2 style='color:red;'>$index - hata : $filename : " . $uploader->error . "</h2>";
        }
      }
    endif;
  }

  //$uploader = new Upload($_FILES['resim']);
  /*
  $uploader = new Upload('assets/server/upload/depo/');
    if ($uploader->uploaded)
    {
      
      // dosyayi oldugu gibi boyutlandirmadan ve
      // isimlendirmeden upload etme..
      $uploader->Process('assets/server/upload/depo/');
      if($uploader->processed)
      {
        echo "orjinal imaj yuklendi";
      }
      else
      {
        echo "hata : " . $uploader->error;
      }
      
      // ismi degistirilmis dosyayi upload etme..
      $uploader->file_new_name_body = "testt";
      $uploader->Process('assets/server/upload/depo/');
      if($uploader->processed)
      {
        echo "<br/> ismi degistirilmis imaj yuklendi";
      }
      else
      {
        echo "<br/> hata : " . $uploader->error;
      }
    
      // boyutu degistirilmis dosyayi upload etme..
      $uploader->image_resize   = true;
      $uploader->image_convert  = jpg;
      $uploader->image_x        = 100;
      $uploader->image_ratio_y  = true;
      $uploader->Process('assets/server/upload/depo/');
      if ($uploader->processed)
      {
        echo "<br/> boyutu degistirilmis imaj yuklendi";
      }
      else
      {
        echo "<br/> hata : " . $uploader->error;
      }
    }
      */
?>
<form action="" method="POST" enctype="multipart/form-data">
  <input type="file" name="resim">
  <input type="text" name="hede" value="test" />
  <button type="submit">yukle</button>
</form>

