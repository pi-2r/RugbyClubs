<?php
include 'classes/phpmailer/class.phpmailer.php';
// Gauche
$civilite = mysql_real_escape_string($_POST['civilite']);
$nom = mysql_real_escape_string($_POST['nompre']);
$prenom = mysql_real_escape_string($_POST['prenompre']);
$adresse = mysql_real_escape_string($_POST['adresse']);
$idville = intval($_POST['idville']);

$pseudo = mysql_real_escape_string($_POST['pseudo']);
$pass = mysql_real_escape_string($_POST['password']);




// Droite

$tel = intval($_POST['tel']);
$mail = mysql_real_escape_string($_POST['mail']);
$ddn = mysql_real_escape_string($_POST['ddn']);
$nation = mysql_real_escape_string($_POST['nation']);
$clubfavtop = mysql_real_escape_string($_POST['clubfavtop']);
$clubfav = mysql_real_escape_string($_POST['clubfav']);
$photo = $_FILES['photo'];





if (isset($_POST['offreco']))
	$offreco = 'o';
else
	$offreco = 'n';

// On récupère l'id du clubfavtop
$idclubfavtop = mysql_query("SELECT id FROM `clubs` WHERE `nom`='$clubfavtop'")or die(mysql_error());
$idclubfavtop = mysql_fetch_array($idclubfavtop);
$idclubfavtop = intval($idclubfavtop['id']);
// On récupère l'id du clubfav
$idclubfav = mysql_query("SELECT id FROM `clubs` WHERE `nom`='$clubfav'")or die(mysql_error());
$idclubfav = mysql_fetch_array($idclubfav);
$idclubfav = intval($idclubfav['id']);

// On vérifie que le mail n'est pas déjà inscrit
$presence = mysql_query("SELECT `id` FROM `users_sup` WHERE `mail`='$mail'")or die(mysql_error());
if (mysql_num_rows($presence) == 0) // Le club n'est pas inscrit, on continue
{
	// On génére le pass de validation par mail
	$valide = "";
	$chaine = "abcdefghijklmnpqrstuvwxy123456789";
	srand((double)microtime()*1000000);
	for($i=0; $i<32; $i++)
		$valide .= $chaine[rand()%strlen($chaine)];

	// On insert le joueur dans la base
	$requete = "INSERT INTO `users_sup`(civilite,nom,prenom,adresse,E_id_ville,password,mail,tel,ddn,pseudo,photo,offreco,valide) VALUES('$civilite','$nom','$prenom','$adresse','$idville','$pass','$mail','$tel','$ddn','$pseudo','$photo','$offreco','$valide')";
	mysql_query($requete)or die(mysql_error());
	$idusersclub = mysql_insert_id(); // Id du club inscrit

	// On stoque son adresse IP
	$ip = $_SERVER["REMOTE_ADDR"];
	$requete = "INSERT INTO `ips_sup`(E_id_club, ip) VALUES('$idusersclub', '$ip')";
	mysql_query($requete)or die(mysql_error());

	// On envoi le mail avec le code de validation
	$message = 'Vous venez de créer un compte sur le site www.kaapstad.fr<br /><br />Vous devez valider votre adresse électronique en cliquant sur le lien ci-dessous afin d\'activer votre compte.<br /><br /><a href="http://www.kaapstad.fr/activation.php?id='.$valide.'">http://www.kaapstad.fr/activation.php?id='.$valide.'</a>';
	//Envoi mail
		$mailp = new PHPMailer();
		$mailp->IsHTML(true);
		$mailp->Host = "localhost";
		$mailp->AddReplyTo("contact@kaapstad.fr","Kaapstad");
		$mailp->SetFrom('contact@kaapstad.fr', 'Kaapstad');
		$mailp->AddAddress($mail, $pseudo);
		$mailp->Subject = "Kaapstad.fr - Activation de votre compte";
		$mailp->MsgHTML($message);
		$mailp->Send();
		unset($mailp);

	// On renseigne l'utilisateur
	?>
	<center>
		<img src="images/valide.png" alt="" /> Votre inscription est terminée !
		<br /><br />
		Vous allez recevoir un e-mail contenant le lien d'activation de votre compte. Vous pourrez utiliser votre compte immédiatement après confirmation de votre adresse électronique.
		<br /><br />
		<a href="index.php">Retour</a>
	</center>
	<?php
}
else
{
	?>
	<center>
		<img src="images/erreur.png" alt="" /> Désolé, ce joueur est déjà inscrit dans notre base de données !
		<br /><br />
		<a href="index.php?p=inscription">Retour</a>
	</center>
	<?php
}
