<?php
session_start();
require_once 'secusql/exec.php';
require_once 'fonctions.php';

// Chargement des pages
ob_start();

if (isset($_GET['p']))
	$page = $_GET['p'];

if (isset($_SESSION['auth']) && $_SESSION['auth'] === TRUE)
{
	$user = $sql->lire('users_'.$_SESSION['type'], "`id`='$_SESSION[id]'");
	if ($_SESSION['type'] == 'club')
	{
		$pseudo = $sql->lire('clubs', "id='$user[E_id_club]'");
		$pseudo = $pseudo['nom'];
	}
	else
		$pseudo = $user['pseudo'];
}


if (!empty($page))
	if(file_exists('includes/' . $page . '.php') AND !preg_match("/\./iU", $page))
		include('includes/' . $page . '.php');
	else
		include('includes/erreur.php');
else
{
	include('includes/accueil.php');
	die();
}
$contenu = ob_get_clean();


// Chargement du skin
	ob_start();
	include('skin.html');
	$skin = ob_get_clean();

// Chargement Login Box
	ob_start();
	include('includes/loginbox.php');
	$lbox = ob_get_clean();

// Chargement réseaux sociaux
	ob_start();
	include('includes/rsocial.php');
	$rsocial = ob_get_clean();


// Fusion
	$affichage = preg_replace("#\[CONTENU\]#", $contenu, $skin);
	$affichage = preg_replace("#\[LOGINBOX\]#", $lbox, $affichage);
	$affichage = preg_replace("#\[RSOCIAL\]#", $rsocial, $affichage);

// Affichage du site

echo $affichage;
