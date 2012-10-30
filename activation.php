<?php
	include('secusql/exec.php');

	$id = addslashes($_GET['id']);

	$pass_sql = $sql->requete("SELECT password,id FROM `users_joueur` WHERE `valide`='$id'", FALSE);
	$type="joueur";
	if (mysql_num_rows($pass_sql) == 0)
	{
		$pass_sql = $sql->requete("SELECT password,id FROM `users_club` WHERE `valide`='$id'", FALSE);
		$type = "club";
	}
	if (mysql_num_rows($pass_sql) == 0)
	{
		$pass_sql = $sql->requete("SELECT password,id FROM `users_sup` WHERE `valide`='$id'", FALSE);
		$type = "sup";
	}
	/*
	if (mysql_num_rows($pass_sql) == 0)
	{
		$pass_sql = $sql->requete("SELECT password,id FROM `users_kine` WHERE `mail`='$login'", FALSE);
		$type="kine";
	}
	if (mysql_num_rows($pass_sql) == 0)
	{
		$pass_sql = $sql->requete("SELECT password,id FROM `users_osteo` WHERE `mail`='$login'", FALSE);
		$type="osteo";
	}
	if (mysql_num_rows($pass_sql) == 0)
	{
		$pass_sql = $sql->requete("SELECT password,id FROM `users_nutri` WHERE `mail`='$login'", FALSE);
		$type="nutri";
	}
*/
	if (mysql_num_rows($pass_sql) > 0)
	{
		$req = "UPDATE `users_$type` SET `valide`='oui' WHERE `id`='$pass_sql[id]'";
		mysql_query($req)or die(mysql_error());
	}
	else
		header("Location: index.php?p=wrongpassword");
?>

