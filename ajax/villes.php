<?php
include '../secusql/exec.php';

$ville = (string)($_GET['ville']);

$res = $sql->lire('ville', "`id` LIKE '$ville%' AND `valide` = 'o'", FALSE);

echo ('<select class="required validate-selection" onchange="var ville = this.value; ville = ville.split(\'-\'); document.getElementById(\'cp\').value=ville[0]; document.getElementById(\'idville\').value=ville[1];" name="ville">');

echo '<option>Choississez</option>';

while ($data = mysql_fetch_array($res))
	echo ('<option value="'.$data['id'].'-'.$data['id_ville'].'">'.$data['libvil'].'</option>');

echo ('</select>');
?>


