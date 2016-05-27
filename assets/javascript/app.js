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
	/////////// kan arama formu \\\\\\\\\\\\
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

			if (isFormOk)
			{
				$.post('assets/server/server.php', params, function(resp){
					if (resp == 0)
					{
						alert("HATA : ilan kaydı gerçekleştirilemedi!");
					}
					else
					{
						window.location.href="?page=kan-ariyorum&subpage=ilan-detay&ilanid="+resp;

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

	/////////// kan bagislama formu \\\\\\\\\\\\
var kan_bagisla = {
	ilan : {
		save : function(){
			var params = {
				job 		  : "bagiskaydet",
				adsoyad 	  : $('#adsoyad').val(),
				il 			  : $('#iller').val(),
				ilce 		  : $('#ilceler').val(),
				kangrubu	  : $('#kangrubu').val(),
				telefon 	  : $('#telefon').val(),
				eposta  	  : $('#eposta').val(),
				sifre		  : $('#sifre').val(),
				sifreTekrar   : $('#sifreTekrar').val(),
				tgoster		  : (document.getElementById("telefonugoster").checked)?"1":"0",
			};
//			var x = document.getElementById("telefonugoster").checked;
//			console.log(x);
			var isFormOk = validateForm(params);
			if (isFormOk)
			{
				if (params.sifre == params.sifreTekrar){
					$.post('assets/server/server.php', params, function(resp){
						if (resp == 0)
						{
							alert("HATA : ilan kaydı gerçekleştirilemedi!");
						}
						else
						{
							window.location.href="?page=kan-bagisla&subpage=profil&profilid="+resp;
						}
					});
				}
				else
				{
					alert("sifre eslesmelidir");
				}
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
		console.log(params[Object.keys(params)[i]]);
		if (params[Object.keys(params)[i]] == "" || params[Object.keys(params)[i]] == null)
		{			
			return false;
		}
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
/////////////////////////////////////////////////////////////
// ilimdeki donorler ajax
function ilimdeki_donorler( ilid )
{
	var params = 
	{
		job 	: "uygunIleGoreDonorler",
		il_id	: ilid
	}

	$.post('assets/server/server.php', params, function(resp){
		uygunIlanlariBas(JSON.parse(resp),'ilce');
	});
}
// ilimdeki donorleri ekrana bas
function uygunIlanlariBas(resp)
{
	$('#illereGoreDonorAlani tr').remove();
	var keys = Object.keys(resp[0]);
	for (var i = 0; i<resp.length; i++)
	{	
		var html = "<tr>";
		for (var ix = 0; ix < keys.length; ix++)
		{
			if (keys[ix] != 'telefongoster')
			{
				html += "<td>";
				html += resp[i][keys[ix]];
				html += "</td>";
			}
			else
			{
				html += "<td>";
				html += (resp[i].telefongoster == 0) ? "<small>Numarası gizli</small>" : resp[i].telefon;
				html += "</td>";
			}
		}
		html += "</tr>";
		$('#illereGoreDonorAlani').append(html);
	}
}







