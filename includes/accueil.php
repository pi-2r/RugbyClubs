<!DOCTYPE html>
<html lang="fr-fr" >
	<head>

		<!--[if lt IE 7]>
			<style type="text/css">
			html
			{
				display:none;
			}
			html .jqueryslidemenu{height: 1%;} /*Holly Hack for IE7 and below*/
			</style>
		<![endif]-->

		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<meta name="robots" content="index, follow" />
		<meta name="keywords" content="" />
		<meta name="title" content="Bienvenue sur KaapStad" />
		<meta name="author" content="Chauffaille Sylvain" />
		<meta name="description" content="KaapStad" />

		<title>KaapStad.fr</title>

		<script type="text/javascript" src="js/html5.js"></script>
		<script type="text/javascript" src="js/font.js"></script>
		<script type="text/javascript" src="js/edwardian.js"></script>
		<script src="js/prototype.js" type="text/javascript"></script>
		<script src="js/scriptaculous.js" type="text/javascript"></script>
		<script src="js/function.js" type="text/javascript"></script>

		<link rel="shortcut icon" href="css/favicon.ico" type="image/x-icon" />
		<link rel="stylesheet" href="css/template_accueil.css" media="screen" type="text/css"/>
		<link rel="stylesheet" href="css/main.css" media="screen" type="text/css"/>
	</head>

<!--[if IE 7 ]>    <body class="ie7 ie"> <![endif]-->
<!--[if IE 8 ]>    <body class="ie8 ie"> <![endif]-->
<!--[if !IE]><!-->
	<body> <!--<![endif]-->
		<header id="header">
			<div id="haut-noir">
				<br/>
				<div id="connexion" style="padding-left:125px;" >
					<?php
						if($_SESSION['auth']):
							?>
							<a href="index.php?p=deconnexion" title="Déconnexion">Déconnexion</a> - <a href="index.php?p=panel" title="Rendez vous sur votre panel utilisateur">Votre panel</a>
							<?php
						else:
							?>
							<a onClick="window.location.assign('connect.php')" href="#" title="Connectez vous grâce à votre compte Facebook !"><img src="images/fbconnect.png" alt="Connectez vous grâce à votre compte Facebook !" /></a> <a href="index.php?p=inscription" title="Créer votre compte en quelques clics">Créer un compte</a> | <a href="index.php?p=login" title="Indentifier vous grâce à votre compte">S'identifier</a>
							<?php
						endif;
						?>
				</div>
				<div style="padding-left:70%">
					<?php include 'includes/rsocial.php'; ?>
				</div>
			</div>
			</div>
		</header>
		<div id="main-container">
			<div style="border: 2px solid #9E2426; background: black url('images/slider/stade.jpg') no-repeat; margin: 0px auto; width:1024px; height: 468px"></div>
		</div>

		<center>
		<table cellspacing="0" cellpadding="0" width="1000px;">
			<tr>
				<td width="380px"><div id="logo"><a href="index.php"><img width="350px" src="images/kaapstad2.png" alt="" /></a></div></td>
				<td>
					<nav id="nav">
						<ul>
							<li><a href="index.php"><span><strong>Accueil</strong></span></a></li>
							<li><a href="#"><span><strong>Pronostics</strong></span></a></li>
							<li><a href="index.php?p=guide"><span><strong>Guide Rugby</strong></span></a></li>
							<li><a href="#"><span><strong>Les offres</strong></span></a></li>
							<li><a href="boutique.php"><span><strong>Boutique </strong></span></a></li>
							<li><a href="index.php?p=partners"><span><strong>Partenaires</strong></span></a></li>
							<li><a href="index.php?p=contact"><span><strong>Contact</strong></span></a></li>
						</ul>
					</nav>
				</td>
			</tr>
		</table>
		<img src="images/slogan.png" alt="Le plus important n'est pas de seulement participer... mais de gagner !!!'" /></center>
	</body>
</html>

