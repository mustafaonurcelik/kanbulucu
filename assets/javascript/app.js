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
				job 	: "ilankaydet",
				adsoyad : $('#adsoyad').val(),
				il 		: $('#il').val(),
				ilce 	: $('#ilce').val(),
				kangrubu: $('#kangrubu').val(),
				telefon : $('#telefon').val(),
				eposta  : $('#eposta').val()
			};

			$.post('assets/server/server.php', params, function(resp){
				if (resp == 1)
				{
					//location.reload();
				}
				else
				{
					alert("HATA : ilan kaydı gerçekleştirilemedi!");
				}
			});

		}
	}
}