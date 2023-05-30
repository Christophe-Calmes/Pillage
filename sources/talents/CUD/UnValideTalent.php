<?php
// Check statut
$parametre = new Preparation();
$param = $parametre->creationPrep($_POST);
$select = "SELECT  `valide` FROM `Talents` WHERE `idTalent`=:idTalent";
$read = new RCUD($select, $param);
$statut = $read->READ();

if($statut[0]['valide'] == 1) {
    $valide = 0;
    $message = "Votre talent est invalide";
} else {
  $valide = 1;
  $message = "Votre talent est valide";
}
  $update = "UPDATE `Talents` SET `valide`= {$valide} WHERE `idTalent` = :idTalent";
  $action = new RCUD($update, $param);
  $action->CUD();
  header('location:../index.php?idNav='.$idNav.'&message='.$message);
