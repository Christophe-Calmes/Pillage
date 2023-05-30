<?php
// Check statut
$parametre = new Preparation();
$param = $parametre->creationPrep($_POST);
$select = "SELECT  `valide` FROM `Talents` WHERE `idTalent`=:idTalent";
$read = new RCUD($select, $param);
$statut = $read->READ();

if ($statut[0]['valide'] == 1) {
    header('location:../index.php?idNav='.$idNav.'&message=Soucis d\'enregistrement');
  }
  $delete = "DELETE FROM `Talents` WHERE `idTalent`=:idTalent AND valide = 0";
  $action = new RCUD($delete, $param);
  $action->CUD();
  header('location:../index.php?idNav='.$idNav.'&message=Le talent est correctement effacé');
