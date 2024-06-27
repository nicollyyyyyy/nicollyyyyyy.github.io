<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Google Maps</title>
	<style>
		#DIV_MAPA
		{
			width:100%;
			height:99vh;
		}


		.menu{
			width: 400px;
			height: 50px;
			position: absolute;
			top:50px;
			right:100px;
			z-index:10;
			color:white;
		}
	</style>
</head>
<body>
		<div class="menu">	
			<form action="index.php" method="get">
				LOCAL: <input type="text" name="local"> <button type="submit"> ok </button>
			</form>
		</div>	
	
		<div id="DIV_MAPA">  </div>

</body>

<script>

LAT = 0
LON = 0

function showPosition(position) 
{
    LAT = position.coords.latitude;
    LON = position.coords.longitude;
      
}

function CRIAR_MAPA() {

	if (navigator.geolocation) 
      {
        navigator.geolocation.watchPosition(showPosition);
		try{
			LAT = position.coords.latitude;
      		LON = position.coords.longitude;
		}
		catch(erro)
		{
			// CEDUP: -26.33371484850089, -48.83094202294906

			LAT = -26.33371484850089   // Caso não tenha GPS escolha um local padrão
			LON = -48.83094202294906
		}
      } 
      else 
      { 
        document.write("Seu navegador não suporta Geolocalização.");
      }


	var PROPRIEDADES= {
	center:new google.maps.LatLng(LAT,LON),
	zoom:20,
	mapTypeId: google.maps.MapTypeId.HYBRID};	
	var map = new google.maps.Map(document.getElementById("DIV_MAPA"),PROPRIEDADES);
	
		<?php
			include("conecta.php");

			$local = $_GET["local"];

		$comando = $pdo->prepare("SELECT * FROM locais WHERE `LOCAL` LIKE '%$local%' ");
			$resultado = $comando->execute(); 
			$n = 0;
			while($linha = $comando->fetch())
			{ 
				$LAT = $linha["LATITUDE"];     
				$LON = $linha["LONGITUDE"];
				
				$n = $n + 1;
				echo("
					var MARCADOR$n = {lat:$LAT,lng:$LON};
					var icone_marcador$n = new google.maps.Marker({position: MARCADOR$n,
					animation:google.maps.Animation.BOUNCE,
					icon:{url:'seta.png',scaledSize: new google.maps.Size(30, 30)},});
					icone_marcador$n.setMap(map);
				");
			}
		?>


}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCXlg-UheeFvXNuGdat0w-R5L0cVxoTr34&callback=CRIAR_MAPA">
</script>

</html>