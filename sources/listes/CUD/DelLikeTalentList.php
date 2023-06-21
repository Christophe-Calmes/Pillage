<?php
// encodeRoutage(52)
//print_r($_POST);

// Recherche si le Talent existe déjà ?
$select = "SELECT `idLTL` FROM `lienTalentListe` WHERE `idListe` = :idListe AND`idTalent` = :idTalent";
$parametre  = new Preparation();
$param = $parametre->creationPrep($_POST);
$checkDoublon = new RCUD($select, $param);
$result = $checkDoublon->READ();
if(!empty($result)) {
  //delette
  $delete = "DELETE FROM `lienTalentListe` WHERE `idListe` = :idListe AND `idTalent` = :idTalent";
  $action = new RCUD($delete, $param);
  $action->CUD();
  header('location:../index.php?idNav='.$idNav.'&idListe='.filter($_POST['idListe']).'&message=Talent effacé.');
} else {
  // Redirection
    header('location:../index.php?idNav='.$idNav.'&idListe='.filter($_POST['idListe']).'&message=Error.');
}
