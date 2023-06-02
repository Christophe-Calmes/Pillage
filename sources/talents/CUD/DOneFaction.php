<?php
// route form 43
require '../sources/talents/objets/CUDtalent.php';
$idTalent = filter($_POST['idTalent']);
//print_r($_POST);

$cud = new CUDTalent($_POST);
//$cud->deleteOneFaction();

if($cud->deleteOneFaction()) {
  header('location:../index.php?idNav='.$idNav.'&idTalent='.$idTalent.'&messagae=Fation effacé.');
}
