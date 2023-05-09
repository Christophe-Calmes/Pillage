<?php
//encodeRoutage(36)
//print_r($_POST);
$check = NULL;
// Vérification
$idUser = $checkId->idUser($valeur);
// Vérification faction privé
$idFaction = filter($_POST['factionTroupe']);
$param = [['prep'=>':idFaction', 'variable'=>filter($_POST['factionTroupe'])],
          ['prep'=>':auteur', 'variable'=>$idUser]];
$select = "SELECT `idFaction` FROM `Factions` WHERE `idFaction` = :idFaction AND `auteur`=:auteur AND `valide` = 1 AND `factionPrivate` = 1";
$readIdFactionPrivate = new RCUD($select, $param);
$data = $readIdFactionPrivate->READ();

if($data != []){

  if($data[0]['idFaction'] == filter($_POST['factionTroupe'])) {
    // Faction privé, auteur identifié et propriétaire de sa faction
    $check = true;

  } else {
    // tentative de hacking

    $check = false;
  }
} else {
  // Controle si faction public
  $param = [['prep'=>':idFaction', 'variable'=>filter($_POST['factionTroupe'])]];
  $select = "SELECT `idFaction` FROM `Factions` WHERE `valide` = 1 AND `factionPrivate` = 0 AND `idFaction` = :idFaction";
  $readIdFactionPublic = new RCUD($select, $param);
  $data = $readIdFactionPublic->READ();
  if($data !=[]) {
    $check = true;

  } else {
    $check = false;
  }
}
if($check) {
  // Procédure d'enregistrement
  $insert ="INSERT INTO `Troupes`(`typeTroupe`, `nomTroupe`, `factionTroupe`, `descriptionTroupe`,  `valide`, `auteur`)
  VALUES (:typeTroupe, :nomTroupe, :factionTroupe, :descriptionTroupe, 1, :idUser)";
  $parametre = new Preparation ();
  $param = $parametre->creationPrepIdUser ($_POST);
  $action = new RCUD($insert, $param);
  $action->CUD();
  header('location:../index.php?idNav='.$idNav.'&message=Nouvelle unité initialisé.');

} else {
  header('location:../index.php?idNav='.$idNav.'&message=Soucis d\'enregistrement.');
}
