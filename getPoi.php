<?php

  include 'secusql/exec.php';
  include 'fonctions.php';

	$req = $sql->lire('clubs', "1", FALSE);

  $dom = new DomDocument('1.0', 'utf-8');
  $node = $dom->createElement("markers");
  $parnode = $dom->appendChild($node);

  while ($result = mysql_fetch_array($req)){
    $node = $dom->createElement("marker");
    $newnode = $parnode->appendChild($node);
    $newnode->setAttribute("titre", $result['nom']);
    $newnode->setAttribute("lat", $result['lat']);
    $newnode->setAttribute("lng", $result['lng']);
    $data = $sql->requete("SELECT blason FROM guide WHERE E_id_club=$result[id]", FALSE);
    if (mysql_num_rows($data) > 0)
    {
		$temp = mysql_fetch_array($data);
		$newnode->setAttribute("couleur", $temp['blason']);
	}
	else
	{
		$data = $sql->requete("SELECT couleurs FROM guide WHERE E_id_club=$result[id]", FALSE);
		if (mysql_num_rows($data) > 0)
		{
			$temp = mysql_fetch_array($data);
			$temp = majuscule($temp['couleurs']);
			$temp = ereg_replace('-', '%20', $temp);
			$newnode->setAttribute("couleur", $temp);
		}
		else
			$newnode->setAttribute("couleur", 'gris');
	}
    $newnode->setAttribute("ville", $result['ville']);
    $newnode->setAttribute("zoomAff", $result['importance']);
    $newnode->setAttribute("idd", $result['id']);
  }

  $xmlfile = $dom->saveXML();
  echo $xmlfile;
?>
