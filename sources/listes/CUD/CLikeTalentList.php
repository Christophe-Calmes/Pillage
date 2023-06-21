<?php
// encodeRoutage(51)
//print_r($_POST);

// Recherche si le Talent existe déjà ?
$select = "SELECT `idLTL` FROM `lienTalentListe` WHERE `idListe` = :idListe AND`idTalent` = :idTalent";
$parametre  = new Preparation();
$param = $parametre->creationPrep($_POST);
$checkDoublon = new RCUD($select, $param);
$result = $checkDoublon->READ();
if(empty($result)) {
  //Record
  $insert = "INSERT INTO `lienTalentListe`(`idListe`, `idTalent`) VALUES (:idListe, :idTalent)";
  $action = new RCUD($insert, $param);
  $action->CUD();
  header('location:../index.php?idNav='.$idNav.'&idListe='.filter($_POST['idListe']).'&message=Talent enregistré.');
} else {
  // Redirection
    header('location:../index.php?idNav='.$idNav.'&idListe='.filter($_POST['idListe']).'&message=Talent déjà affecté.');
}
