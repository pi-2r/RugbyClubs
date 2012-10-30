<?php
$req = $sql->lire('partners', "1", FALSE);
if (mysql_num_rows($req) > 0)
	while ($data = mysql_fetch_array($req))
	{
		$nom = stripslashes($data['nom']);
		$url = $data['url'];
		$logo = $data['logo'];
		$texte= stripslashes($data['texte']);
		if (!empty($url))
			$site = '<span style="font-size:11px;position:relative;top:10px;float:right"><a target="_blank" href="'.$url.'" title="'.$nom.'">Visiter le site internet</a></span>';
		else
			$site = '';
		echo("
		<table style=\"border: 1px dashed gray;\" width=\"100%\">
			<tr><td colspan=\"2\"><h3>$nom $site</h3></td>
			<tr>
				<td width=\"250px\"><img src=\"$logo\" alt=\"$nom\" /></td>
				<td>$texte</td>
			</tr>
		</table>");
	}
else
	echo '<center>Il n\'y a aucun partenaire pour le moment.';
?>
