<?php
// encodeRoutage(53)
require '../sources/talents/objets/CUDtalent.php';
//print_r($_POST);
$idTalent = filter($_POST['idTalent']);
$cud = new CUDTalent($_POST);
$ok = $cud->verificationAffectationRecord();

/*$ok = $cud->addAllFaction ();
//print_r($test);
*/
if ($ok) {
  header('location:../index.php?idNav='.$idNav.'&idTalent='.$idTalent.'&messagae=Talent affecté.');
} else {
  header('location:../index.php?idNav='.$idNav.'&idTalent='.$idTalent.'&messagae=Erreur.');
}
