<?php
	include '../secusql/exec.php';
	$infoclub[E_id_comites] = 0;
	$infoclub[E_id_niveau] = 0;
	$infoclub[E_id_club] = 0;
	$id = intval($_GET['id']);
	$fede = $sql->lire('pays', "id=$id");
?>

<?php echo $fede['texte1']; ?>
<div style="clear:both"></div>

<div onClick="document.getElementById('details').style.display='none';setTimeout('carte.panTo(new google.maps.LatLng(<?php echo $fede['lat'].','.$fede['lng'];?>))', 500);setTimeout('carte.setZoom(5)', 1000);" style="margin: 10px;margin-right:30px;font-size:0.8em;margin:0 auto;" class="boutton">Voir en détail</div>
</div>
