<?php

	include 'secusql/exec.php';

	header("Content-type: image/gif");

	$id = intval($_GET['id']);

	$photo = $sql->lire('users_joueur', "`id`='$id'");

	echo $photo['photo'];

?>
