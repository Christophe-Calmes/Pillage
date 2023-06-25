<?php
// Route encodeRoutage(48)
// Vérification
$idListe = filter($_POST['idListe']);
$parametre = new Preparation();
$param = $parametre->creationPrep($_POST);
// Modification de $_POST pour créer le test de sécurité
array_shift($_POST);
array_pop($_POST);
$paramTest = $parametre->creationPrepIdUser ($_POST);
$select = "SELECT COUNT(`idTroupe`) AS `ok`, `typeTroupe` FROM `Troupes` WHERE `idTroupe` = :idTroupe AND `auteur` = :idUser AND `valide`= 1";
$read = new RCUD($select, $paramTest);
$ok = $read->READ();
if($ok[0]['ok'] == 1) {
  //print_r($param);
  $insert = "INSERT INTO `CompositionListe`(`idListe`, `idTroupe`, `nombreTroupe`)
  VALUES
  (:idListe, :idTroupe, :nombreTroupe)";
  $action = new RCUD($insert, $param);
  $action->CUD();
    if($ok[0]['typeTroupe'] == 1) {
      // Record chef valide
      $update = "UPDATE `Listes` SET `chefValide`= 1 WHERE `idListe` = :idListe";
      $param = [['prep'=>':idListe', 'variable'=>$idListe]];
      $action = new RCUD($update, $param);
      $action->CUD();
    }
  header('location:../index.php?idNav='.$idNav.'&idListe='.$idListe.'&message=Troupe enregistré dans la liste.');
} else {
  header('location:../index.php?idNav='.$idNav.'&idListe='.$idListe.'&message=Erreur, troupe inconnus.');
}
