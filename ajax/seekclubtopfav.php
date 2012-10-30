<?php
include '../secusql/exec.php';
echo 'Choississez votre club dans la liste suivante:<br/><table class="designed">
		<thead><th>Nom</th><th>Ville</th></thead>';
$club = mysql_real_escape_string($_GET['nom']);
$res = mysql_query("SELECT * FROM `clubs` WHERE `nom` LIKE '%$club%' LIMIT 0,10");
while ($data = mysql_fetch_array($res))
	echo '<tr onClick="ToogleBox(\'seekclub2\');document.getElementById(\'clubfavtop\').value=\''.addslashes($data['nom']).'\';document.getElementById(\'clubfavtop\').focus();document.getElementById(\'adresse\').focus();setTimeout(function(){document.getElementById(\'advice-validate-clubfavtop-clubfavtop\').style.display=\'none\';},200)" style="cursor:pointer;"><td>'.$data['nom'].'</td><td>'.$data['ville'].'</td></tr>';
echo '</table>';
