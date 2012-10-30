<?php

// Gauche
$comite = intval($_POST['comite']);
$nomclub = mysql_real_escape_string($_POST['nomclub']);
$adresse = mysql_real_escape_string($_POST['adresse']);
$idville = intval($_POST['idville']);

if (isset($_POST['numero']))
	$numero = mysql_real_escape_string($_POST['numero']);
else
	$numero = '';

$password = mysql_real_escape_string($_POST['password']);


// Droite
if (isset($_POST['fax']))
	$fax = intval($_POST['fax']);
else
	$fax = '';

$tel = intval($_POST['tel']);
$site = mysql_real_escape_string($_POST['site']);
$mail = mysql_real_escape_string($_POST['mail']);
$couleur1 = mysql_real_escape_string($_POST['couleur1']);
$couleur2 = mysql_real_escape_string($_POST['couleur2']);
$niveau = intval($_POST['niveau']);
$logo = $_FILES['logo'];

// Président
$nompre =  mysql_real_escape_string($_POST['nompre']);
$prenompre =  mysql_real_escape_string($_POST['prenompre']);
$telpre = intval($_POST['telpre']);
$mailpre = mysql_real_escape_string($_POST['mailpre']);

// Contact
if (isset($_POST['nomcon']))
{
	$nomcon =  mysql_real_escape_string($_POST['nomcon']);
	$prenomcon =  mysql_real_escape_string($_POST['prenomcon']);
	$telcon = intval($_POST['telcon']);
	$mailcon = mysql_real_escape_string($_POST['mailcon']);
	$contact = true;
}
else
	$contact = false;

// Coach
if (isset($_POST['nomcoa']))
{
	$nomcoa =  mysql_real_escape_string($_POST['nomcoa']);
	$prenomcoa =  mysql_real_escape_string($_POST['prenomcoa']);
	$telcoa = intval($_POST['telcoa']);
	$mailcoa = mysql_real_escape_string($_POST['mailcoa']);
	$coach = true;
}
else
	$coach = false;

if (isset($_POST['offreco']))
	$offreco = 'o';
else
	$offreco = 'n';

// On récupère l'id du club
$idclub = mysql_query("SELECT id FROM `clubs` WHERE `nom`='$nomclub'")or die(mysql_error());
$idclub = mysql_fetch_array($idclub);
$idclub = intval($idclub['id']);

// On vérifie que le club n'est pas déjà inscrit
$presence = mysql_query("SELECT `id` FROM `users_club` WHERE `E_id_club`='$idclub'")or die(mysql_error());
if (mysql_num_rows($presence) == 0) // Le club n'est pas inscrit, on continue
{
	// On insere le président
	$requete = "INSERT INTO `liste_president`(E_id_users_club, nom, prenom, telephone, mail) VALUES('$idclub', '$nompre', '$prenompre', '$telpre', '$mailpre')";
	mysql_query($requete)or die(mysql_error());
	$idpresident = mysql_insert_id(); // Id du président

	// On insere le contact
	if ($contact)
	{
		$requete = "INSERT INTO `liste_contact`(E_id_users_club, nom, prenom, telephone, mail) VALUES('$idclub', '$nomcon', '$prenomcon', '$telcon', '$mailcon')";
		mysql_query($requete)or die(mysql_error());
		$idcontact = mysql_insert_id(); // Id du contact
	}
	else
		$idcontact = '';

	// On insere le coach
	if ($coach)
	{
		$requete = "INSERT INTO `liste_coach`(E_id_users_club, nom, prenom, telephone, mail) VALUES('$idclub', '$nomcoa', '$prenomcoa', '$telcoa', '$mailcoa')";
		mysql_query($requete)or die(mysql_error());
		$idcoach = mysql_insert_id(); // Id du coach
	}
	else
		$idcoach = '';

	// Mise en forme couleur
	$couleurs = $couleur1.'/'.$couleur2;

	// On génére le pass de validation par mail
	$valide = "";
	$chaine = "abcdefghijklmnpqrstuvwxy123456789";
	srand((double)microtime()*1000000);
	for($i=0; $i<32; $i++)
		$valide .= $chaine[rand()%strlen($chaine)];

	// On insert le club dans la base
	$requete = "INSERT INTO `users_club`(E_id_club, E_id_comites, E_id_ville, E_id_niveau, adresse, mail, telephone, fax, E_id_president, E_id_contact, E_id_coach, couleurs, urlsiteweb, numeroaffilie, password, offreco, valide, logo) VALUES('$idclub', '$comite', '$idville', '$niveau', '$adresse', '$mail', '$tel', '$fax', '$idpresident', '$idcontact', '$idcoach', '$couleurs', '$site', '$numero', '$password', '$offreco', '$valide', '$logo')";
	mysql_query($requete)or die(mysql_error());
	$idusersclub = mysql_insert_id(); // Id du club inscrit

	// On stoque son adresse IP
	$ip = $_SERVER["REMOTE_ADDR"];
	$requete = "INSERT INTO `ips_club`(E_id_club, ip) VALUES('$idusersclub', '$ip')";
	mysql_query($requete)or die(mysql_error());

	// On envoi le mail avec le code de validation
	$message = 'Vous venez de créer un compte sur le site www.kaapstad.fr<br /><br />Vous devez valider votre adresse électronique en cliquant sur le lien ci-dessous afin d\'activer votre compte.<br /><br /><a href="http://www.kaapstad.fr/activation.php?id='.$valide.'">http://www.kaapstad.fr/activation.php?id='.$valide.'</a>';
	$ksmail->send($mail, $message);

	// On renseigne l'utilisateur
	?>
	<center>
		<img src="images/valide.png" alt="" /> Votre inscription est terminée !
		<br /><br />
		Vous allez recevoir un e-mail contenant le lien d'activation de votre compte. Vous pourrez utiliser votre compte imméadiatement après confirmation de votre adresse électronique.
		<br /><br />
		<a href="index.php">Retour</a>
	</center>
	<?php
}
else
{
	?>
	<center>
		<img src="images/erreur.png" alt="" /> Désolé, ce club est déjà inscrit dans notre base de données !
		<br /><br />
		<a href="index.php?p=inscription">Retour</a>
	</center>
	<?php
}
