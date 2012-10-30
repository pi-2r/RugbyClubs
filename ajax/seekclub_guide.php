<?php
include '../secusql/exec.php';
echo '<b><font color="white">Choississez votre club</font></b><br/><table class="designed">
		<thead><th>Nom</th><th>Ville</th></thead>';
$club = mysql_real_escape_string($_GET['nom']);
$res = mysql_query("SELECT * FROM `clubs` WHERE `nom` LIKE '%$club%' LIMIT 0,10");
while ($data = mysql_fetch_array($res))
	echo '<tr style="cursor:pointer" onClick="ToogleBox(\'seekclub\');carte.setZoom(4);setTimeout(\'carte.panTo(new google.maps.LatLng('.$data['lat'].','.$data['lng'].'))\', 500);setTimeout(\'carte.setZoom(5)\', 1000);setTimeout(\'carte.setZoom(6)\', 1500);setTimeout(\'carte.setZoom(7)\', 2000);setTimeout(\'carte.setZoom(8)\', 2500);setTimeout(\'carte.setZoom(9)\', 3000);infowindow = new google.maps.InfoWindow();infowindow.setPosition(new google.maps.LatLng('.$data['lat'].','.$data['lng'].'));infowindow.setContent(\''.$data['nom'].'<br /><br /><center><font color=gray size=1.1em><i>Cliquez pour consulter le profil du club</i></font></center>\');infowindow.open(carte);"><td>'.$data['nom'].'</td><td>'.$data['ville'].'</td></tr>';
echo '</table>';
