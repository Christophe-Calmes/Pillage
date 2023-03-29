<?php
$parametre = new Preparation();
$param = $parametre->creationPrep ($_POST);
// Vérification si la classe est non-valide
$select = "SELECT `valide` FROM `classes` WHERE `idClasse` = :idClasse";

$verif = new RCUD($select, $param);
$readValide = $verif->READ();
if($readValide[0]['valide'] != 0) {
    // Invalider la classe
    $request = "UPDATE `classes` SET `valide` = 0 WHERE `idClasse` = :idClasse";
  } else {
    // Delete une classe
      $request = "DELETE FROM `classes` WHERE `idClasse` = :idClasse";
  }
  $action = new RCUD($request, $param);
  $action->CUD();
  if($readValide[0]['valide'] != 0) {
    header('location:../index.php?idNav='.$idNav.'&message=Votre classe est invalide.');
  } else {
    header('location:../index.php?idNav='.$idNav.'&message=Votre classe est effacé.');
  }
