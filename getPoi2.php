<?php

  include 'secusql/exec.php';
  include 'fonctions.php';

	$req = $sql->lire('pays', "nomfede != ''", FALSE);

  $dom = new DomDocument('1.0', 'utf-8');
  $node = $dom->createElement("markers");
  $parnode = $dom->appendChild($node);

  while ($result = mysql_fetch_array($req)){
    $node = $dom->createElement("marker");
    $newnode = $parnode->appendChild($node);
    $newnode->setAttribute("titre", $result['nomfede']);
    $newnode->setAttribute("lat", $result['lat']);
    $newnode->setAttribute("lng", $result['lng']);
    $newnode->setAttribute("zoomAff", '3');
    $newnode->setAttribute("idd", $result['id']);
  }

  $xmlfile = $dom->saveXML();
  echo $xmlfile;
?>
