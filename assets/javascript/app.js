
function readImage(inputElement) {
    var deferred = $.Deferred();

    var files = inputElement.get(0).files;
    if (files && files[0]) {
        var fr= new FileReader();
        fr.onload = function(e) {
            deferred.resolve(e.target.result);
        };
        fr.readAsDataURL( files[0] );
    } else {
        deferred.resolve(undefined);
    }

    return deferred.promise();
}

function filtreToggle()
{
	$('#filtreToggleButton').hide();
	$('#filtreBody').slideDown();
}

var fotoBase64 		= "",
	fotoBase64Clean = "",
	guncelFotoUrl 	= "";
	
$(function(){
	$('#foto').on('change', function(){
		readImage($(this))
			.done(function(base64Data){ 
				if (base64Data != "")
				{
					fotoBase64 = base64Data;
					fotoBase64Clean = base64Data.replace(/.*,/, '');
					$('#imgPlaceholder').attr("src", fotoBase64).fadeIn();
				}
			});
	})
});

var urunler = 
{
	yeni : 
	{
		kaydet : function()
		{
			var params = 
			{
				job     : "yeniurunkaydet",
				adi 	: $('#adi').val(),
				turu 	: $('#turu').val(),
				sanatci : $('#sanatci').val(),
				yili 	: $('#yili').val(),
				en		: $('#en').val(),
				boy		: $('#boy').val(),
				adet	: $('#adet').val(),
				foto	: fotoBase64,
				aciklama: $('#aciklama').val(),
				sanat   : $('#sanat').val(),
				fiyat	: $('#fiyat').val(),
			};			
			
			$("#myModal").modal({show:true, backdrop:'static'});
			$.post('assets/server/server.php', params, function(resp){
				if (resp == 1)
				{
					window.location.href=document.location.origin + document.location.pathname + "?page=urunler&subpage=liste";
				}
				else
				{
					alert("HATA : ürün eklenemedi!");
				}
			});
		}
	},
	
	guncelle : function()
	{
		var params = 
		{
			job     : "urunguncelle",
			id		: $('#urunid').val(),
			adi 	: $('#adi').val(),
			turu 	: $('#turu').val(),
			sanatci : $('#sanatci').val(),
			yili 	: $('#yili').val(),
			en		: $('#en').val(),
			boy		: $('#boy').val(),
			adet	: $('#adet').val(),
			aciklama: $('#aciklama').val(),
			sanat   : $('#sanat').val(),
			fiyat	: $('#fiyat').val()
		};
		$("#myModal").modal({show:true, backdrop:'static'});
		
		$.post('assets/server/server.php', params, function(resp){
			console.log(resp);
			if (resp == 1)
			{
				window.location.href=document.location.origin + document.location.pathname + "?page=urunler&subpage=detay&id="+params.id;
			}
			else
			{
				alert("HATA : ürün güncellenemedi!");
			}
		});
	},


	yeniturekle : function()
	{
		var params = {
			job 		: "yeniturekle",
			yenituradi  : $('#yenituradi').val()
		}

		$.post('assets/server/server.php', params, function(resp){
				if (resp == 1)
				{
					location.reload();
				}
				else
				{
					alert("HATA : tür eklenemedi!");
				}
			});
	},

	tursil : function(turid)
	{
		var params = {
			job 	: "tursil",
			turid  	: turid
		}

		$.post('assets/server/server.php', params, function(resp){
				if (resp == 1)
				{
					location.reload();
				}
				else
				{
					alert("HATA : tür silinemedi!");
				}
			});
	},
	
	yenisanatekle : function()
	{
		var params = {
			job 		: "yenisanatekle",
			yenisanatadi: $('#yenisanatadi').val()
		}

		$.post('assets/server/server.php', params, function(resp){
				if (resp == 1)
				{
					location.reload();
				}
				else
				{
					alert("HATA : sanat eklenemedi!");
				}
			});
	},

	sanatsil : function(sanatid)
	{
		var params = {
			job 	: "sanatsil",
			sanatid : sanatid
		}

		$.post('assets/server/server.php', params, function(resp){
				if (resp == 1)
				{
					location.reload();
				}
				else
				{
					alert("HATA : sanat silinemedi!");
				}
			});
	},

	barkodOlustur : function(urunid)
	{
		var headingTo = document.location.origin + document.location.pathname + "?page=urunler&subpage=qrcode&urunid="+urunid;
		window.location.href=headingTo;
	},

	stoktanDus : function(urunid)
	{
		var params = {
			job 	: "stoktandus",
			urunid  : urunid
		}

		$.post('assets/server/server.php', params, function(resp){
				if (resp == 1)
				{
					alert("1 adet ürün stoktan düşüldü!.");
					location.reload();
				}
				else
				{
					alert("HATA : stoktan düşülürken bir problem oluştu!");
				}
			});
	},
	
	sil : function(urunId)
	{
		var params = {
			job 	: "urunsil",
			urunid  : urunId,
			mesaj 	: "Ürün sistemden silinecek, onaylıyor musunuz?"
		}
		
		if (confirm(params.mesaj))
		{
			$.post('assets/server/server.php', params, function(resp){
				console.log(resp);
				if (resp == 1)
				{
					alert("Ürün başarıyla silindi!.");
					var headingTo = document.location.origin + document.location.pathname + "?page=urunler&subpage=liste";
					window.location.href=headingTo;
				}
				else
				{
					alert("HATA : ürün silinirken bir problem oluştu!");
				}
			});	
		}
	}
}

var sanatcilar = {
	ekle : function(){
		var params = {
			job 		: "yenisanatciekle",
			yenisanatciadi  : $('#yenisanatciadi').val()
		}

		$.post('assets/server/server.php', params, function(resp){
				if (resp == 1)
				{
					location.reload();
				}
				else
				{
					alert("HATA : sanatçı eklenemedi!");
				}
			});
	},
	sil : function(sanatciid){
		var params = {
			job 	: "sanatcisil",
			sanatciid  	: sanatciid
		}

		$.post('assets/server/server.php', params, function(resp){
				if (resp == 1)
				{
					location.reload();
				}
				else
				{
					alert("HATA : Sanatçı silinemedi!");
				}
			});
	}
}

var lokasyon = {
	ekle : function(){
		var params = {
			job 			 : "yenilokasyonekle",
			yenilokasyonadi  : $('#yenilokasyonadi').val()
		}

		$.post('assets/server/server.php', params, function(resp){
				if (resp == 1)
				{
					location.reload();
				}
				else
				{
					alert("HATA : lokasyon eklenemedi!");
				}
			});
	},
	sil : function(lokasyonid){
		var params = {
			job 		: "lokasyonsil",
			lokasyonid  : lokasyonid
		}

		$.post('assets/server/server.php', params, function(resp){
				if (resp == 1)
				{
					location.reload();
				}
				else
				{
					alert("HATA : lokasyon silinemedi!");
				}
			});
	}
}

var satis = {
	tamamla : function(urunid){
		var params = {
			job 	: "satistamamla",
			urunid 	: urunid,
			adet 	: $('#satisadeti').val(),
			lokasyon: $('#satislokasyonu').val(),
			not		: $('#not').val(),
			tutar	: $('#tutar').val()
		}
		console.log(params);
		$.post('assets/server/server.php', params, function(resp){
				if (resp == 1)
				{
					location.reload();
				}
				else
				{
					alert("HATA : satış gerçekleştirilemedi!");
				}
			});
	}
}