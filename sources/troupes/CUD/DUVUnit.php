<?php
// encodeRoutage(38)
$user = new Controles ();
$idUser = $user->idUser($_SESSION['tokenConnexion']);
$parametre =  new Preparation();
$param = $parametre->creationPrep($_POST);
// Vérification que l'unité appartient à son auteur
$select = "SELECT `auteur`, `valide` FROM `Troupes` WHERE `idTroupe` = :idTroupe";
$check = new RCUD($select, $param);
$dataCheck = $check->READ();  $action = new RCUD($select, $param);
  $action->CUD();
if($dataCheck[0]['valide'] == 0 &&  $dataCheck[0]['auteur'] == $idUser) {
  $delete = "DELETE FROM `Troupes` WHERE `idTroupe` = :idTroupe";
  $action = new RCUD($delete, $param);
  $action->CUD();
  header('location:../index.php?idNav='.$idNav.'&messagae=Troupe effacée.');
} else {
  // Ejection
  header('location:../index.php?idNav='.$idNav.'&message=Erreurs.');

}
