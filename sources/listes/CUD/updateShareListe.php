<?php
//encodeRoutage(55)
print_r($_POST);
$parametre = new Preparation ();
$param = $parametre->creationPrepIdUser ($_POST);
$select = "SELECT `partager` FROM `Listes` WHERE `idListe` = :idListe AND `valide` = 1 AND `auteurListe` = :idUser;";
$check = new RCUD($select, $param);
$data = $check->READ();
$update = NULL;
//print_r($data);
if(!empty($data)) {
  if ($data[0]['partager'] == 1) {
    $update = "UPDATE `Listes` SET `partager` = 0 WHERE `idListe` = :idListe AND `auteurListe` = :idUser;";
  } else {
    $update = "UPDATE `Listes` SET `partager` = 1 WHERE `idListe` = :idListe AND `auteurListe` = :idUser;";
  }
} else {
  header('location:../index.php?message=Erreur d\'enregistrement.');
}
print_r($update);
$action = new RCUD($update, $param);
$action->CUD();
header('location:../index.php?idNav='.$idNav.'&idListe='.filter($_POST['idListe']).'&message=Liste modifier.');
