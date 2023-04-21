<?php
/*
$arrayControle = [];
$arrayPO = [];

  // contrôle idFaction valide
  $param = [['prep'=>':idFaction', 'variable'=>$_POST['idFaction']]];

  $select = "SELECT `idFaction` FROM `Factions` WHERE `idFaction` = :idFaction";
  $controleId = new RCUD($select, $param);
  $idFaction = $controleId->READ();
  if($idFaction[0]['idFaction'] == $_POST['idFaction']) {
    array_push($arrayControle, 1);
    array_push($arrayPO, 1);
  } else {
    array_push($arrayControle, 0);
    array_push($arrayPO, 0);
  }

  // Contrôle adresse nomColonne
  if($_POST['indexType'] < 0 || $_POST['indexType'] > 6) {
    array_push($arrayControle, 0);
    array_push($arrayPO, 0);
  } else {
    array_push($arrayControle, 1);
    array_push($arrayPO, 1);
  }
  // Controle pour éviter les doublons de colonne dans la même grille
  $param = [['prep'=>':idFaction', 'variable'=>$_POST['idFaction']],
            ['prep'=>':indexType', 'variable'=>$_POST['indexType']]];
  $select = "SELECT `idCout` FROM `cout` WHERE `idFaction` = :idFaction AND `indexType`= :indexType";
  $controleDoublon = new RCUD($select, $param);
  $idCout = $controleDoublon->READ();
  if($idCout != []) {
    array_push($arrayControle, 0);
    array_push($arrayPO, 0);
  } else {
    array_push($arrayControle, 1);
    array_push($arrayPO, 1);
  }


  // Controle Valeur PO
foreach ($_POST as $key => $value) {
  if($key != 'idFaction' || $key != 'indexType') {
    array_push($arrayControle, 1);
    array_push($arrayPO, controlePO($value));
  }
}*/

// Contrôle si toute les sommes sont entre -1  et 100
if(controleGrille($_POST, 1)) {
  $insert = "INSERT INTO `cout`(`indexType`, `coutBase`, `idFaction`, `SP`,
    `armure`, `bouclier`, `armeImp`, `lance`, `armeDeBase`, `hacheD`, `fronde`,
    `javelot`, `arc`, `arbalete`, `cheval`, `banniere`, `corDG`, `chienDG`)
    VALUES (:indexType, :coutBase, :idFaction, :SP,
      :armure, :bouclier, :armeImp, :lance, :armeDeBase, :hacheD, :fronde,
      :javelot, :arc, :arbalete, :cheval, :banniere, :corDG, :chienDG)";
  $parametre = new Preparation();
  $param = $parametre->creationPrep($_POST);
  $action = new RCUD($insert, $param);
  $action->CUD();
  header('location:../index.php?idNav='.$idNav.'&idFaction='.$_POST['idFaction'].'&message=Grille mise à jour.');
} else {
  header('location:../index.php?idNav='.$idNav.'&idFaction='.$_POST['idFaction'].'&message=Soucis d\'enregistrement.');
}
