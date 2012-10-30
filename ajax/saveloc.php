<?php

include '../secusql/exec.php';

$titre = $_GET['titre'];
$lat = $_GET['lat'];
$lng = $_GET['lng'];

$sql->update('clubs', "`lat`='$lat', `lng`='$lng'", "`nom`='$titre'");


