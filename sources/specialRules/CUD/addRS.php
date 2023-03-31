<?php
// Préparation
$preparation = new Preparation();
$param = $preparation->creationPrep($_POST);
// INSERT
$insert = "INSERT INTO `ReglesSpeciales`(`nomRS`, `descriptionRS`, `prixRS`) VALUES (:nomRS, :descriptionRS, :prixRS)";
$record = new RCUD($insert, $param);
$recordClasse = $record->CUD();
header('location:../index.php?idNav='.$idNav.'&message=Votre nouvelle règle spéciale a été enregistré.');
