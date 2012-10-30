<?php
	session_start();
	include('secusql/exec.php');

	$app_id = '115351141876390';
	$app_secret = '192482a2cfe893cfdedaf6cac81bb5de';
	$my_url = "http://www.kaapstad.fr/sylvain/connect.php";
	$scope = "email,user_birthday,publish_stream";

    $code = $_REQUEST["code"];

    if(empty($code)) {
        $dialog_url = "http://www.facebook.com/dialog/oauth?client_id="
            . $app_id . "&redirect_uri=" . urlencode($my_url)."&scope=".$scope;

        echo("<script> top.location.href='" . $dialog_url . "'</script>");
    }

	 $token_url = "https://graph.facebook.com/oauth/access_token?client_id="
        . $app_id . "&redirect_uri=" . urlencode($my_url) . "&client_secret="
        . $app_secret . "&code=" . $code;

    $access_token = @file_get_contents($token_url);

    $graph_url = "https://graph.facebook.com/me?" . $access_token;

    $user = json_decode(@file_get_contents($graph_url));

	$pass_sql = $sql->requete("SELECT password,id FROM `users_joueur` WHERE `facebook_id`='$user->id'", FALSE);
	$type="joueur";
	if (mysql_num_rows($pass_sql) == 0)
	{
		$pass_sql = $sql->requete("SELECT password,id FROM `users_club` WHERE `facebook_id`='$user->id'", FALSE);
		$type = "club";
	}
	if (mysql_num_rows($pass_sql) == 0)
	{
		$pass_sql = $sql->requete("SELECT password,id FROM `users_sup` WHERE `facebook_id`='$user->id'", FALSE);
		$type = "sup";
	}
	/*
	if (mysql_num_rows($pass_sql) == 0)
	{
		$pass_sql = $sql->requete("SELECT password,id FROM `users_kine` WHERE `facebook_id`='$user->id'", FALSE);
		$type="kine";
	}
	if (mysql_num_rows($pass_sql) == 0)
	{
		$pass_sql = $sql->requete("SELECT password,id FROM `users_osteo` WHERE `facebook_id`='$user->id'", FALSE);
		$type="osteo";
	}
	if (mysql_num_rows($pass_sql) == 0)
	{
		$pass_sql = $sql->requete("SELECT password,id FROM `users_nutri` WHERE `facebook_id`='$user->id'", FALSE);
		$type="nutri";
	}
*/
	if (mysql_num_rows($pass_sql) > 0)
	{
			$pass_sql = mysql_fetch_array($pass_sql);
			$_SESSION['auth'] = TRUE;
			$_SESSION['type'] = $type;
			$_SESSION['id'] = $pass_sql['id'];
			header("Location: index.php?p=panel");
	}
	else
	{
		$_SESSION['auth'] = FALSE;
		$_SESSION['id_fb'] = $user->id;
		header("Location: index.php?p=join_fb_site");
	}

?>
