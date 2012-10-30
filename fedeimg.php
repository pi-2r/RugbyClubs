<?php
if(isset($_GET['id']))
{
$id = intval($_GET['id']);
include ("secusql/exec.php");
$req = $sql->requete("SELECT logo FROM pays WHERE id=$id");

header ("Content-type: image/png");
echo $req[logo];
}
?>
