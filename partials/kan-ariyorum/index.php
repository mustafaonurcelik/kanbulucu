<div class="row">
  <div class="col-sm-12">
    <div class="row">
      <div class="col-sm-6">
        <!-- ad soyad yaz -->
        <strong>Adınız Soyadınız :</strong>
        <br />
        <input type="text" name="" id="adsoyad" class="form-control">      
      </div>
      <div class="col-sm-6">
        <!-- kan grubu sec -->
         <strong>Kan Grubu :</strong>
         <select name="kangrubu" id="kangrubu" class="form-control">
             <?php kangruplari($db); ?> <!-- functions.php tarafindan dolduruluyor -->
         </select>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
         <strong>Şehir :</strong>
         <select name="sehir" id="iller" onchange="ileGoreIlceleriGetir()" class="form-control">
             <?php iller($db); ?> <!-- functions.php tarafindan dolduruluyor -->
         </select>
         <br>
      </div>
      <div class="col-sm-6">
        <strong>İlçe :</strong>
        <select name="ilce" id="ilceler" class="form-control">
            <!-- buranin ici js tarafindan dolduruluyor -->
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <strong>Telefon :</strong>
        <br />
        <input type="text" name="" id="telefon" class="form-control">
        <br>     
      </div>
      <div class="col-sm-6">
         <strong>Email :</strong>
         <br />
         <input type="text" name="" id="eposta" class="form-control">
         <br>     
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <strong>Not Bırak :</strong>
         <br />
         <textarea class="form-control" name="" id="kullanicinotu" placeholder="Örn : XXX Hastanesinde yatmakta olan yakınım için kan veren donörler ödüllendirilecektir." rows="6"></textarea>
      </div>
    </div>
  </div>
</div>
   <hr>
   <button class="btn btn-danger btn-block" onclick="kan_ariyorum.ilan.save()">Kan Arıyorum</button>




