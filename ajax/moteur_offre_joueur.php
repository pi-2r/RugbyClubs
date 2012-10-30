<?php
include '../secusql/exec.php';
include '../fonctions.php';

$reduction = '';
$tri = '';
$crit = false;
if (isset($_GET['dispo']))
{
	$crit = true;
	switch ($_GET['dispo']) {
		case 'i':
			$dispo = 'i';
		break;
		case 'm':
			$dispo = 'm';
		break;
		case 's':
			$dispo = 's';
		break;

		default :
			$dispo = '%';
		break;
	}
	$reduction .= " AND `disponibilite` LIKE '$dispo'";
}
if (isset($_GET['poste']) && $_GET['poste'] != 'Tous')
{
	$crit = true;
	$id = intval($_GET['poste']);
	$reduction .= " AND `E_id_poste_pref`='$id'";
}
if (isset($_GET['sexe']))
{
	$crit = true;
	switch ($_GET['sexe'])
	{
		case 'm':
			$reduction .= "AND civilite_jou = 'm'";
			break;
		case 'f':
			$reduction .= "AND civilite_jou != 'm'";
			break;
	}
}
if (isset($_GET['mobi']))
{
	$crit = true;
	if ($_GET['mobi'] == 'n')
		$reduction .= " AND `mobilite` LIKE 'n'";
	elseif ($_GET['mobi'] == 'c')
		if ($_GET['comite'] != 'Choisissez')
			$reduction .= " AND `mobilite` LIKE 'c' AND c.`id`=$_GET[comite]";
		else
			$reduction .= " AND `mobilite` LIKE 'c'";
	elseif ($_GET['mobi'] == 'd')
		if ($_GET['departement'] != 'Choisissez')
			$reduction .= " AND `mobilite` LIKE 'd' AND d.`id_dep`=$_GET[departement]";
		else
			$reduction .= " AND `mobilite` LIKE 'd'";
	else
		$reduction .= " AND `mobilite` LIKE '%'";
}
if (isset($_GET['niveau']) && $_GET['niveau'] != 'Tous')
{
	$crit = true;
	$id = intval($_GET['niveau']);
	$reduction .= " AND `E_id_niveau_actuel`='$id'";
}
if (isset($_GET['date']))
{
	switch ($_GET['date']) {
		case 'ASC':
			$tri = ' ORDER BY date_offj ASC';
		break;
		case 'DESC':
			$tri = ' ORDER BY date_offj DESC';
		break;
	}
}

	$req = "SELECT *
	FROM offrejoueurs as o
	LEFT JOIN users_joueur as j ON o.E_id_users_joueur=j.id
	LEFT JOIN ville as v ON j.E_id_ville=v.id
	LEFT JOIN pays as p ON j.E_id_pays=p.id
	LEFT JOIN comites as c ON o.E_id_comites=c.id
	LEFT JOIN departements as d ON d.id_dep=o.E_id_departements
	WHERE 1
	$reduction
	$tri
	";
	$res = $sql->requete($req, FALSE);

?>
Liste des demandes d'emploi des joueurs
<br />

<?php
if (mysql_num_rows($res) > 0)
	while ($data = mysql_fetch_array($res))
	{
		$meilleurniveau = $sql->lire('niveau', "`id_niv`='$data[E_id_niveau_meilleur]'");
		$niveau = $sql->lire('niveau', "`id_niv`='$data[E_id_niveau_actuel]'");
		$postepref = $sql->lire('poste', "`id`='$data[E_id_poste_pref]'");
		$date = tofr($data['date_offj']);
		$img = strtolower($data['code_pays']);
		$img = "<img src=\"images/pays/$img.gif\" alt=\"$data[nation]\" />";
		switch ($data['mobilite'])
		{
			case 'n':
				$mobilite = "Nationale";
				break;
			case 'd':
				$mobilite = "Départementale";
				break;
			case 'c':
				$mobilite = "Comité";
				break;
		}
		switch ($data['disponibilite'])
		{
			case 'i':
				$disponibilite = "Immédiate";
				break;
			case 'm':
				$disponibilite = "Moins de 3 mois";
				break;
			case 's':
				$disponibilite = "Saison prochaine";
				break;
		}
		switch($data['civilite_jou'])
		{
			case 'm':
				$sexe = '<img src="images/male.png" alt="Homme" /> Masculin';
				break;
			case 'v':
			case 'f':
				$sexe = '<img src="images/femelle.png" alt="Femme" /> Feminin';
				break;
		}

		echo('<hr />');
		echo('<table width="100%"><tr>');
		echo("<td width=\"110px\"><img width=\"100px\" src=\"imgjoueur.php?id=$data[E_id_users_joueur]\" alt=\"$data[nom] $data[prenom]\" /></td>");
		echo('<td width="150px"><b><a title="Voir le profil du joueur" href="index.php?p=profil&id='.$data['id'].'">'.$data['pseudo'].' <img width="10" src="images/zoom.png" alt="Voir le profil du joueur" /></a></b><br />'.$sexe.'<br /><br />'.$img.' <i>'.$data[nation].'</i></td>');
		echo('<td width="200px">Meilleur niveau : <font color="black">'.$meilleurniveau['lib_niv'].'</font><br />Niveau actuel : <font color="black">'.$niveau['lib_niv'].'</font>');
		echo('<br />Mobilité : <font color="black">'.$mobilite.'</font><br />Disponibilité : <font color="black">'.$disponibilite.'</font></td>');
		echo('<td width="350px">Comité recherché : <font color="black">'.$data[nom].'</font><br /><br />Poste préféré : <font color="black">'.$postepref[poste].'</font></td>');
		echo('<td align="right"><a href="#"><img src="images/mail.png" alt="Contacter ce joueur !"/><br />Contacter</a></td>');
		echo('</tr></table>');
		echo('<hr />');
	}
else
	if ($crit)
		echo '<center>Il n\'y a aucune annonce correspondante à vos critères de recherches</center>';
	else
		echo '<center>Il n\'y a aucune annonce pour le moment</center>';

