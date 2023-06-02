<?php
// route form 43
// Nettoyage ancienne affectation
require '../sources/talents/objets/CUDtalent.php';
$cud = new CUDTalent($_POST);
$idTalent = filter($_POST['idTalent']);
//print_r($_POST);
array_pop($_POST);
//print_r($_POST);
$ok = array();
array_push($ok, $cud->deleteFactions());
array_push($ok,$cud->addAllFaction());
// Boucle de création de talent
if ($ok == [true, true]) {
  header('location:../index.php?idNav='.$idNav.'&idTalent='.$idTalent.'&messagae=Talent affecté.');
} else {
  header('location:../index.php?idNav='.$idNav.'&idTalent='.$idTalent.'&messagae=Erreur.');
}
