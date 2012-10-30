<?php
include '../secusql/exec.php';

if (isset($_GET['club']))
{
	$club = $_GET['club'];

	$data = $sql->lire('clubs', "`nom` = '$club'", FALSE);
	if (mysql_num_rows($data) == 1)
		echo 'ok';
	else
		echo 'no';
}

?>
