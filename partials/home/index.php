<?php $activePage = "home"; ?>
<?php
	function hex2rgb($hex) {
	   $hex = str_replace("#", "", $hex);

	   if(strlen($hex) == 3) {
	      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
	      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
	      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
	      $r = hexdec(substr($hex,0,2));
	      $g = hexdec(substr($hex,2,2));
	      $b = hexdec(substr($hex,4,2));
	   }
	   $rgb = array($r, $g, $b);
	   //return implode(",", $rgb); // returns the rgb values separated by commas
	   return $rgb; // returns an array with the rgb values
	}
	$yil = ($_GET['yil']) ? $_GET['yil'] : date("Y");
	echo $yil;

	$lokasyonlarQ = mysqli_query($con, "SELECT * FROM lokasyonlar");
	$dataSets = array();
	$i = 0;

	$colors = ["#fe5621","#9b26af","#02a8f3","#4bae4f","#3f7faf","#3e50b4","#5f7c8a","#9d9d9d","#6639b6","#e81d62","#f34235","#fe5621","#fe9700","#fec006","#ccdb38","#8ac249","#785447"];
	while($lokasyon = mysqli_fetch_object($lokasyonlarQ)):
		$dataSets[$i]['label'] 				= $lokasyon->adi;
		$dataSets[$i]['fill'] 				= true;
		$dataSets[$i]['backgroundColor'] 	= "rgba(".hex2rgb($colors[$i])[0].",".hex2rgb($colors[$i])[1].",".hex2rgb($colors[$i])[2].",0.1)";
		$dataSets[$i]['borderColor'] 		= "rgba(".hex2rgb($colors[$i])[0].",".hex2rgb($colors[$i])[1].",".hex2rgb($colors[$i])[2].",1)";
		$dataSets[$i]['borderJoinStyle'] 	= "miter";
		$dataSets[$i]['pointRadius'] 		= 7;
		$dataSets[$i]['pointBorderWidth'] 	= 1;
		$dataSets[$i]['pointHoverRadius'] 	= 5;
		$dataSets[$i]['pointHitRadius'] 	= 10;
		$dataSets[$i]['pointHoverBorderWidth']= 2;
		$data = [0,0,0,0,0,0,0,0,0,0,0,0];
		$lokasyonDataQ = mysqli_query($con, "SELECT * FROM satislar WHERE lokasyon='$lokasyon->id' AND yil='$yil'");
		while ($lokasyonData = mysqli_fetch_object($lokasyonDataQ)):
			$inndex = $lokasyonData->ay - 1;
			$data[$inndex] += $lokasyonData->tutar * $lokasyonData->adet; 
		endwhile;
		$dataSets[$i]['data'] 	= $data;
		$i++;
		unset($data);
	endwhile;
	$dataSets = json_encode($dataSets);
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.0.1/Chart.bundle.min.js"></script>
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Aylara göre satışlar</h4>
			</div>
			<div class="panel-body">
				<form action="" method="GET" class="well">
					<div class="row">
						<div class="col-sm-6">
							<select name="yil" id="" class="form-control">
								<?php
									for ($ix=0; $ix < 10; $ix++)
									{
										echo ((int)date("Y")-$ix == $yil) ? "<option selected>" : "<option>";
										echo ((int)date("Y")-$ix)."</option>";
									}
								?>
							</select>
						</div>
						<div class="col-sm-6">
							<button class="btn btn-default btn-block">Değiştir</button>
						</div>
					</div>
				</form>
				<canvas id="myChart" width="1140" height="250"></canvas>
			</div>
		</div>
		
		<!-- <div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Ürünlere göre satışlar</h4>
			</div>
			<div class="panel-body">
				<canvas id="myChart2" width="1140" height="250"></canvas>
			</div>
		</div> -->

		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">Son Satışlar</h4>
			</div>
			<div class="panel-body">
				<ul>
					<?php
						$satislarQ = mysqli_query($con, "SELECT * FROM satislar");
						while ($satis = mysqli_fetch_object($satislarQ)):
							echo "<li>";
								echo "<strong>$satis->gun/$satis->ay/$satis->yil</strong> tarihinde <strong>";
								idToName2($con, "lokasyonlar", $satis->lokasyon);
								echo "</strong> lokasyonundan <strong>".$satis->tutar * $satis->adet."TL</strong> tutarında satış yapıldı.";
							echo "</li>";
						endwhile;
					?>
				</ul>
			</div>
		</div>

		<script>
			//labels: ["Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"],
			var ctx = document.getElementById("myChart");
			var ctx = document.getElementById("myChart").getContext("2d");
			var ctx = $("#myChart");
			var data = {
			    labels: ["Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"],
			    datasets : <?php echo $dataSets; ?>
			    // datasets: [
			    //     {
			    //         label: "Kariye Atölye",
			    //         fill: true,
			    //         lineTension: 0.1,
			    //         backgroundColor: "rgba(75,192,192,0.4)",
			    //         borderColor: "rgba(75,192,192,1)",
			    //         borderCapStyle: 'butt',
			    //         borderDash: [],
			    //         borderDashOffset: 0.0,
			    //         borderJoinStyle: 'miter',
			    //         pointBorderColor: "rgba(75,192,192,1)",
			    //         pointBackgroundColor: "#fff",
			    //         pointBorderWidth: 1,
			    //         pointHoverRadius: 7,
			    //         pointHoverBackgroundColor: "rgba(75,192,192,1)",
			    //         pointHoverBorderColor: "rgba(220,220,220,1)",
			    //         pointHoverBorderWidth: 2,
			    //         pointRadius: 5,
			    //         pointHitRadius: 10,
			    //         data: [65, 59, 80, 81],
			    //         //yAxisID: "y-axis-0",
			    //     }
			    // ]
			};
		
			var myLineChart = new Chart(ctx, {
			    type: 'line',
			    data: data,
			    options: {}
			});
			
			
			// // urunlere gore satislar
			// var ctx2 = document.getElementById("myChart2");
			// var ctx2 = document.getElementById("myChart2").getContext("2d");
			// var ctx2 = $("#myChart2");
			// var data2 = {
			//     labels: ["Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"],
			//     datasets: [
			//         {
			//             label: "Tablo",
			//             fill: true,
			//             lineTension: 0.1,
			//             backgroundColor: "rgba(75,192,192,0.8)",
			//             borderColor: "rgba(75,192,192,1)",
			//             borderCapStyle: 'butt',
			//             borderDash: [],
			//             borderDashOffset: 0.0,
			//             borderJoinStyle: 'miter',
			//             pointBorderColor: "rgba(75,192,192,1)",
			//             pointBackgroundColor: "#fff",
			//             pointBorderWidth: 1,
			//             pointHoverRadius: 5,
			//             pointHoverBackgroundColor: "rgba(75,192,192,1)",
			//             pointHoverBorderColor: "rgba(220,220,220,1)",
			//             pointHoverBorderWidth: 2,
			//             pointRadius: 1,
			//             pointHitRadius: 10,
			//             data: [65, 59, 80, 81],
			//             yAxisID: "y-axis-0",
			//         },
			//         {
			//             label: "T-shirt",
			//             fill: true,
			//             backgroundColor: "rgba(255,205,86,0.8)",
			//             borderColor: "rgba(255,205,86,1)",
			//             pointBorderColor: "rgba(255,205,86,1)",
			//             pointBackgroundColor: "#fff",
			//             pointBorderWidth: 1,
			//             pointHoverRadius: 5,
			//             pointHoverBackgroundColor: "rgba(255,205,86,1)",
			//             pointHoverBorderColor: "rgba(255,205,86,1)",
			//             pointHoverBorderWidth: 2,
			//             data: [28, 48, 40, 19]
			//         },
			//         {
			//             label: "Kitap",
			//             fill: true,
			//             backgroundColor: "rgba(0,153,243,0.8)",
			//             borderColor: "rgba(0,153,243,0.1)",
			//             pointBorderColor: "rgba(255,205,86,1)",
			//             pointBackgroundColor: "#fff",
			//             pointBorderWidth: 1,
			//             pointHoverRadius: 5,
			//             pointHoverBackgroundColor: "rgba(255,205,86,1)",
			//             pointHoverBorderColor: "rgba(255,205,86,1)",
			//             pointHoverBorderWidth: 2,
			//             data: [12, 4, 29, 129]
			//         }
			//     ]
			// };
		
			// var myLineChart = new Chart(ctx2, {
			//     type: 'bar',
			//     data: data2,
			//     options: {}
			// });
		</script>

	</div>
</div>