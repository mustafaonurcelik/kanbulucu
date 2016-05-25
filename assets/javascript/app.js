var projectRoot = document.location.origin + document.location.pathname;
$(function(){
	
});
////////////////////////////////////////////////////////////// 
// ornek post
////////////////////////////////////////////////////////////// 
/*
var params = {
	job : "server.php deki switch için case...",
	key : "value"
}
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
*/

var kan_ariyorum = {
	ilan : {
		save : function(){
			var params = {
				job 		  : "ilankaydet",
				adsoyad 	  : $('#adsoyad').val(),
				il 			  : $('#iller').val(),
				ilce 		  : $('#ilceler').val(),
				kangrubu	  : $('#kangrubu').val(),
				telefon 	  : $('#telefon').val(),
				eposta  	  : $('#eposta').val(),
				kullanicinotu : $('#kullanicinotu').val()
			};

			var isFormOk = validateForm(params);
			console.log("ok? : " + isFormOk);

			if (isFormOk)
			{
				$.post('assets/server/server.php', params, function(resp){
					if (resp == 1)
					{
						$('#kanAraModal').modal('show');
					}
					else
					{
						alert("HATA : ilan kaydı gerçekleştirilemedi!");
					}
				});
			}
			else
			{
				alert("Lütfen tüm alanları doldurunuz!");
			}
		}
	}
}


function validateForm(params)
{
	var isFilled = true;
	if (Object.keys(params).length > 0)
	{
		var lngt = Object.keys(params).length;
	}
	else
	{
		return false;
	}

	for (var i = 0; i < lngt; i++)
	{
		isFilled = (params[Object.keys(params)[i]] == "") ? false : true;
	}

	return (isFilled) ? true : false;
}


function ileGoreIlceleriGetir(){
		var params = 
		{
			job 	: "ileGoreIlceleriGetir",
			il_id	: $('#iller').val()
		}

		$.post('assets/server/server.php', params, function(resp){
			setSelectOptions(JSON.parse(resp), 'ilceler');
		});

}

function setSelectOptions(data, inputId)
{
	var toplam = data.length;
	$('#'+inputId+" option").remove();
	for(var i =0; i<toplam; i++)
	{
		var html  = "<option value='"+data[i].id+"'>";
			html += data[i].baslik;
			html += "</option>";

		$("#"+inputId).append(html);
	}
}

// home page:   display ilce









