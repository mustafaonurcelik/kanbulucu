
  <!-- ad soyad yaz -->
   <strong>Adınız Soyadınız :</strong>
   <br />
   <input type="text" name="" id="adsoyad" class="form-control">
  <!-- kan grubu sec -->
   <strong>Kan Grubu :</strong>
   <select name="kangrubu" id="kangrubu" class="form-control">
       <?php kangruplari($db); ?> <!-- functions.php tarafindan dolduruluyor -->
   </select>
  <!-- il sec -->
   <strong>Şehir :</strong>
   <select name="sehir" id="iller" onchange="ileGoreIlceleriGetir()" class="form-control">
       <?php iller($db); ?> <!-- functions.php tarafindan dolduruluyor -->
   </select>
  <!-- ilce sec -->
   <strong>İlçe :</strong>
   <select name="ilce" id="ilceler" class="form-control">
       <!-- buranin ici js tarafindan dolduruluyor -->
   </select>
  <!-- telefon numarasi -->
   <strong>Telefon :</strong>
   <br />
   <input type="text" name="" id="telefon" class="form-control">
  <!-- email adresi yaz -->
   <strong>Email :</strong>
   <br />
   <input type="text" name="" id="eposta" class="form-control">
  <!-- kullanici notu -->
   <strong>Not Bırak :</strong>
   <br />
   <textarea class="form-control" name="" id="kullanicinotu" placeholder="Örn : Yakınım için kan veren donörler ödüllendirilecektir."></textarea>
  <!-- submit -->	
   <hr>
   <button class="btn btn-danger btn-block" onclick="kan_ariyorum.ilan.save()">Kan Arıyorum</button>




  <!-- Modal -->
  <div class="modal fade" id="kanAraModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Kan Bulucu</h4>
        </div>
        <div class="modal-body">
          <p>İlanınız Başarıyla Alınmıştır</p>
        </div>
        <div class="modal-footer">
<!--          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>    -->
          <a href="?page=ilan-detay" class="btn btn-success">Tamam</a>
        </div>
      </div>
      
    </div>
  </div>