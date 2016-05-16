<script>
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
	
	var base64Dirty,
		base64Clean,
		newBase64Clean,
		imgW, imgH;
	
	$(function(){
		$('#theImg').on("change", function(elm){
			readImage($(this))
				.done(function(base64Data){
					//imhW = $(this).width();
					//imgH = $(this).height();
					//console.log(imgW, imgH);
					base64Dirty = base64Data;
					base64Clean = base64Data.replace(/.*,/, '');
					
					
					$("body").append("<img id='ilkYuklenenResim' src=data:image/gif;base64,"+base64Clean+"></img>");
					var ilkW = $('#ilkYuklenenResim').width();
					var ilkH = $('#ilkYuklenenResim').height();
					
					resizeBase64Img(base64Clean, ilkW/2, ilkH/2).then(function(newImg){
					    $("body").append("<br/>").append(newImg);
					    newBase64Clean = $(newImg[0]).attr('src').replace(/.*,/, '');
					});
					
					console.log(newBase64Clean);
				});
		});
	});
	
	
	function resizeBase64Img(base64, width, height) {
	    var canvas = document.createElement("canvas");
	    canvas.width = width;
	    canvas.height = height;
	    var context = canvas.getContext("2d");
	    var deferred = $.Deferred();
	    $("<img/>").attr("src", "data:image/gif;base64," + base64).load(function() {
	        context.scale(width/this.width,  height/this.height);
	        context.drawImage(this, 0, 0); 
	        deferred.resolve($("<img/>").attr("src", canvas.toDataURL()));
	     });
	     return deferred.promise();    
	}
	
</script>



<input type="file" id="theImg" />