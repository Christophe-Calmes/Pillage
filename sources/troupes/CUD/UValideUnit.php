<?php
// encodeRoutage(37)
//print_r($_POST);
$user = new Controles ();
$idUser = $user->idUser($_SESSION['tokenConnexion']);
$parametre =  new Preparation();
$param = $parametre->creationPrep($_POST);
// Vérification que l'unité appartient à son auteur
$select = "SELECT `auteur`, `valide` FROM `Troupes` WHERE `idTroupe` = :idTroupe";
$check = new RCUD($select, $param);
$dataCheck = $check->READ();
if($dataCheck[0]['valide'] == 1 &&  $dataCheck[0]['auteur'] == $idUser) {
  // Invalide
  $update = "UPDATE `Troupes` SET `valide` = 0 WHERE `idTroupe` = :idTroupe";
} elseif ($dataCheck[0]['valide'] == 0 &&  $dataCheck[0]['auteur'] == $idUser) {
  // valide
  $update = "UPDATE `Troupes` SET `valide` = 1 WHERE `idTroupe` = :idTroupe";
} else {
  // Ejection
  header('location:../index.php?idNav='.$idNav.'&message=Vous n\'êtes pas propriétaire de cette troupe.');


}
if(isset($update)) {
  $action = new RCUD($update, $param);
  $action->CUD();
  // Nav
    header('location:../index.php?idNav='.$idNav.'&message=Troupe modifié.');
}
