<br /><br />
<?php
include '../secusql/exec.php';
include '../fonctions.php';

$id = intval($_GET['id']);

$infoclub = $sql->requete("SELECT * FROM guide as g LEFT JOIN clubs as c on g.E_id_club=c.id WHERE g.E_id_club=$id", FALSE);
if (mysql_num_rows($infoclub) == 0)
	die("Désolé, ce club n'est pas encore inscrit dans notre base de données ! <br /><br /><center><a  href=\"index.php?p=inscription_club\">Inscrire ce club</a></center>");
else
	$infoclub = mysql_fetch_array($infoclub);
$couleurs = explode('-', $infoclub['couleurs']);
$couleur1 = getcouleur($couleurs[0]);
$couleur2 = getcouleur($couleurs[1]);
	if (empty($infoclub['stade']) && empty($infoclub['jumele']) && empty($infoclub['couleurs']) && empty($infoclub['annee']) && empty($infoclub['imgstade']))
	die("Désolé, ce club n'est pas encore inscrit dans notre base de données ! <br /><br /><center><a  href=\"index.php?p=inscription_club\">Inscrire ce club</a></center>");

?>
<div style="clear:both;"></div>
<div style="width: 100%; position:relative; top: -135px; font-size: 16px; font-weight: bold; background: <?php echo $couleur1; ?>">
<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td width="80%"><font size="16px" color="<?php echo $couleur2; ?>"><b><?php echo $infoclub['nom']; ?></b></font></td>
	<?php if(strlen($infoclub['code']) > 2)
	{
		?><td align="right"><img style="float:left;" height="59px" width="80px" src="images/niveaux/<?php echo $infoclub['E_id_niveau']; ?>.jpg" alt="Niveau du club" /> <img width="80px" height="59px" style="float:right;margin-right: 10px;" src="images/comites/<?php echo $infoclub['E_id_comites']; ?>.png" alt="Comite" /></td>
		<?php
	}
	?>
	</tr>
</table>
</div>
<table style="width:100%; position:relative; top: -150px;">
	<tr>
		<td align="center"><div style="font-size:0.7em;color:pink;" class="boutton"><div style="position:relative; bottom:3px">Site du club</div></div></td>
		<td align="center"><div style="font-size:0.7em;color:pink;" class="boutton"><div style="position:relative; bottom:3px">Billeterie</div></div></td>
		<td align="center"><div style="font-size:0.7em;color:pink;" class="boutton"><div style="position:relative; bottom:3px">Calendrier</div></div></td>
		<td align="center"><div style="font-size:0.7em;color:pink;" class="boutton"><div style="position:relative; bottom:3px">Contactez le club</div></div></td>
		<td width="310px" align="center"><div style="font-size:1em;" class="boutton2">Pronostics !</div></td>
	</tr>
</table>
<div style="clear:both;"></div>
<table style="position:relative; top: -160px;" width="100%" cellspacing="5px" cellpadding="5px">
	<tr valign="top">
		<td id="saison">
			<div style="padding: 3px;border-radius: 5px; background: rgba(0,0,0,0.8); width:98%">
	<h3 style="font-size: 1em;">Les saisons</h3>
	<?php
		$data = $sql->lire('guide_saisons', "E_id_club=$infoclub[E_id_club] ORDER BY anneestart DESC LIMIT 0,4", FALSE);
		while ($data2 = mysql_fetch_array($data))
			echo "<li style=\"padding: 10px;\"><b>$data2[anneestart]/$data2[anneeend]:</b> $data2[texte]</li>";
	?></div>
		</td>
		<td id="infos">
		<div style="padding: 3px;border-radius: 5px; background: rgba(0,0,0,0.8);">
	<h3 style="font-size: 1em;">Informations</h3>
	<u><font color="gray">Les couleurs :</font></u> <?php echo $couleurs[0].' et '.$couleurs[1]; ?><br />
	<u><font color="gray">Année de fondation :</font></u> <?php echo $infoclub['annee']; ?><br />
	<u><font color="gray">Stade :</font></u> <?php echo $infoclub['stade']; ?><br />
	<?php
		$president = $sql->lire('liste_president', "E_id_users_club=$infoclub[E_id_club]");
	?>
	<u><font color="gray">Président :</font></u> <?php echo $president['prenom'].' '.$president['nom']; ?><br />
	<?php
		$coach = $sql->lire('liste_coach', "E_id_users_club=$infoclub[E_id_club]");
	?>
	<u><font color="gray">Entraîneur :</font></u> <?php echo $coach['prenom'].' '.$coach['nom']; ?><br />
	<?php
	if ($infoclub['E_id_niveau'] > 2)
	{
	$jumele = $sql->requete("SELECT nom FROM clubs WHERE id=$infoclub[jumele]");
	if (!empty($jumele['nom']))
	{
	?>
	<u><font color="gray">Jumelé à :</font></u><?php echo $jumele['nom']; ?><br />
	<?php
	}
	}
	?>
	<u><font color="gray">Le palmares et le parcours sportif :</font></u>
	</div>
	</td>
	<td id="stade">
		<div style="padding: 3px;border-radius: 5px; background: rgba(0,0,0,0.8);">
			<center><img src="data:image/gif;base64,<?php echo base64_encode($infoclub['imgstade']); ?>" width="311px" height="153px" alt="Stade en image" /></center>
		</div>
	</td>
</tr>
<tr valign="top">
	<td><?php
	if ($infoclub['E_id_niveau'] < 6)
	{
		?>
		<div id="supporter" style="padding:3px;border-radius: 5px; background: rgba(0,0,0,0.8); width: 98%;">
			<h3 style="font-size: 1em;">Les supporters</h3>
			<?php
			$sup = $sql->lire('guide_supporters', "E_id_club=$infoclub[E_id_club]", FALSE);

			if (mysql_num_rows($sup) > 0)
			{
				while ($sup2 = mysql_fetch_array($sup))
					if (!empty($sup2["linksup"]))
						echo '- '.$sup2['nomsup']." (<a href=\"$sup2[linksup]\" target=\"_blank\">Lien</a>)<br />";
					else
						echo '- '.$sup2['nomsup'].'<br />';
			}
			else
				echo "<br /><center>Cette équipe n'a aucun club de supporters renseigné.</center>";
			?>
		</div>
		<?php
	}
	else
	{
		?>
		<div id="besoin" style="padding:3px;border-radius: 5px;background: rgba(0,0,0,0.8); width: 98%;">
			<h3 style="font-size: 1em;">Les besoins</h3>
			<?php
			$besoins = $sql->requete("SELECT * FROM guide_besoins as G, besoins as B WHERE G.E_id_club=$infoclub[E_id_club] AND G.E_id_besoins=B.id", FALSE);
			if (mysql_num_rows($besoins) > 0)
			{
				while ($besoins2 = mysql_fetch_array($besoins))
					if ($besoins2['id'] == 8)
						echo '- '.$besoins2['comment'].'<br />';
					else
						echo '- '.$besoins2['lib'].'<br />';
			}
			else
				echo "<br /><center>Cette équipe n'a aucun besoin particulier.</center>";
			?>
		</div>
		<?php
	}
	?></td>
	<td>
<div id="itineraire" style="padding:3px; border-radius: 5px; background: rgba(0,0,0,0.8); width: 98%;">
<h3 style="font-size: 1em;">Itinéraire</h3>
<center>Vous souhaitez un itinéraire vers ce stade ?<br />
<?php if(strlen($infoclub['code']) > 2)
	{
		?><a target="_blank" href="http://maps.google.fr/maps?f=d&amp;source=embed&amp;saddr=&amp;daddr=<?php echo $infoclub['lat'];?>,<?php echo $infoclub['lng'];?>&amp;hl=fr&amp;geocode=&amp;mra=prev&amp;sll=46.285683,1.933964&amp;sspn=0.002091,0.004823&amp;ie=UTF8&amp;ll=<?php echo $infoclub['lat'];?>,<?php echo $infoclub['lng'];?>&amp;spn=0.00519,0.00912&amp;z=16">Cliquez ici</a>
		<?php
	}
	else
	{
		?>
		<a href="http://www.google.com/maps?ie=UTF8&f=d&dirflg=r&hl=fr&saddr=&daddr=<?php echo $infoclub['lat'];?>,<?php echo $infoclub['lng'];?>&ttype=dep" target="_blank">Cliquez ici</a>
		<?php
		}
		?></center>
</div>
</td>
<td>
<div id="parteners" style="border-radius: 5px; background: rgba(0,0,0,0.8); width: 98%;">
	<center><?php include('pub.php'); ?></center>
</div>
</td>
</tr>
<tr valign="top">
	<td>
		<div id="bars" style="border-radius: 5px; background: rgba(0,0,0,0.8); width: 98%;">
			<h3 style="font-size: 1em;">Bars</h3>
			<ul>
			<?php
				$sql = mysql_query("SELECT * FROM guide_bars WHERE E_id_club='$id' AND type='bar'")or die(mysql_error());
				while ($data = mysql_fetch_array($sql))
					echo "<li>$data[nom_bar] - <a href=\"$data[lien_bar]\" title=\"$data[nom_bar]\">Lien</a></li>";
			?>
			</ul>

			<h3 style="font-size: 1em;">Hotels</h3>
			<ul>
			<?php
				$sql = mysql_query("SELECT * FROM guide_bars WHERE E_id_club='$id' AND type='hotel'")or die(mysql_error());
				while ($data = mysql_fetch_array($sql))
					echo "<li>$data[nom_bar] - <a href=\"$data[lien_bar]\" title=\"$data[nom_bar]\">Lien</a></li>";
			?>
			</ul>
			<br />
			<h3 style="font-size: 1em;">Restaurants</h3>
			<ul>
			<?php
				$sql = mysql_query("SELECT * FROM guide_bars WHERE E_id_club='$id' AND type='resto'")or die(mysql_error());
				while ($data = mysql_fetch_array($sql))
					echo "<li>$data[nom_bar] - <a href=\"$data[lien_bar]\" title=\"$data[nom_bar]\">Lien</a></li>";
			?>
			</ul>
		</div>
	</td>
</tr>
</table>
<div style="position: absolute; bottom: 1px; right: 1px;"><a style="color:white" href="#"><img width="10px" src="images/erreur.png" alt="Erreur?" /> <b>Une erreur s'est glissée dans le profil? Signalez le nous.</b></a></div>
