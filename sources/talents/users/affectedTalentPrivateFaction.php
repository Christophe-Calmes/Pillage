<?php
require 'sources/talents/headTalent.php';
//$talents->affectTalentPrivateFaction();
$idTalent = filter($_GET['idTalent']);
$check = new Controles();
$idUser = $check->idUser($_SESSION['tokenConnexion']);
//print_r($idTalent);
$talents->affecterTalentFactionPrivate($idTalent, $idNav, $idUser);