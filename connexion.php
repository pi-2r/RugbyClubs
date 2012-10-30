<?php
	session_start();
	include 'secusql/exec.php';

	$login = $_POST['login'];
	$mdp = $_POST['password'];

	$pass_sql = $sql->requete("SELECT password,id FROM `users_joueur` WHERE `mail_jou`='$login' AND valide='oui'", FALSE);
	$type="joueur";
	if (mysql_num_rows($pass_sql) == 0)
	{
		$pass_sql = $sql->requete("SELECT password,id FROM `users_club` WHERE `mail`='$login' AND valide='oui'", FALSE);
		$type = "club";
	}
	if (mysql_num_rows($pass_sql) == 0)
	{
		$pass_sql = $sql->requete("SELECT password,id FROM `users_sup` WHERE `mail`='$login' AND valide='oui'", FALSE);
		$type = "sup";
	}
	/*
	if (mysql_num_rows($pass_sql) == 0)
	{
		$pass_sql = $sql->requete("SELECT password,id FROM `users_kine` WHERE `mail`='$login' AND valide='oui'", FALSE);
		$type="kine";
	}
	if (mysql_num_rows($pass_sql) == 0)
	{
		$pass_sql = $sql->requete("SELECT password,id FROM `users_osteo` WHERE `mail`='$login' AND valide='oui'", FALSE);
		$type="osteo";
	}
	if (mysql_num_rows($pass_sql) == 0)
	{
		$pass_sql = $sql->requete("SELECT password,id FROM `users_nutri` WHERE `mail`='$login' AND valide='oui'", FALSE);
		$type="nutri";
	}
*/
	if (mysql_num_rows($pass_sql) > 0)
	{
		$pass_sql = mysql_fetch_array($pass_sql);
		if ($pass_sql['password'] == $mdp)
		{
			$_SESSION['auth'] = TRUE;
			$_SESSION['type'] = $type;
			$_SESSION['id'] = $pass_sql['id'];
			if ($_POST['joinfb'])
			{
				$req = "UPDATE `users_$type` SET `facebook_id`='$_SESSION[id_fb]' WHERE `id`='$pass_sql[id]'";
				mysql_query($req)or die(mysql_error());
			}
			header("Location: index.php?p=panel");
		}
		else
			header("Location: index.php?p=wrongpassword");
	}
	else
		header("Location: index.php?p=wrongpassword");
?>
