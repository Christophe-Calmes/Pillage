<?php
//encodeRoutage(39)
// Fonction spécifique
  function setSQL($data, $fields) {
    $set = NULL;
    foreach ($data as $key => $value) {
      if(in_array($key, $fields)) {
        $index = array_search($key, $fields);
        $set = ':'.$key.', '.$set;
      }
    }
    // Retirer la dernière virgule
    $set = substr($set, 0, -2);
    return $set;
  }

  function requestSQL ($data, $fields) {
    $set = NULL;
    foreach ($data as $key => $value) {
      if(in_array($key, $fields)) {
        $set = $key.', '.$set;
      }
    }
    // Retirer la dernière virgule
    $set = substr($set, 0, -2);
    return $set;
  }
  function postTest($date, $test) {
    if(isset($data)) {
      array_push($test, 1);
    } else {
      array_push($test, 0);
    }
    return $test;
  }
// Test classe
$test = [];
$controle = [1];

if (array_search('classe', $_POST) && array_search('idTroupe', $_POST)) {
  array_push($test, 1);
} else {
  array_push($test, 0);
}

print_r($test);

if($test == $controle) {
require '../sources/grilleFaction/objets/getGrilles.php';
require '../sources/grilleFaction/objets/printGrilles.php';
$Grilles = new PrintGrilles();
$fields = $Grilles->setChamps();
$set = setSQL($_POST, $fields);
$fieldsTable = requestSQL($_POST, $fields);
//print_r($fieldsTable);
// Sauvegarde de $_POST
$backPost = $_POST;

echo '<br/>';
// Nettoyage pour la table : Troupe
foreach ($backPost as $key => $value) {
  if($value == 'on') {
    unset($backPost[$key]);
  }
}
$parametre = new Preparation();
$paramTroupe = $parametre->creationPrep ($backPost);
// Recherche des datas sur la table cout
$selectTroupe = "SELECT `typeTroupe`, `factionTroupe`FROM `Troupes` WHERE `idTroupe` = :idTroupe";
$param = [['prep'=>':idTroupe', 'variable'=>filter($_POST['idTroupe'])]];
// data Extraction
$readTroupe = new RCUD($selectTroupe, $param);
$dataTroupe = $readTroupe->READ();
$dataCost = NULL;
// Ajout des type de protection
$arrayCA = [['champs'=>'`SP`', 'set'=>', :SP'],
            ['champs'=>'`armure`', 'set'=>', :armure'],
            ['champs'=>'`bouclier`', 'set'=>', :bouclier'],
            ['champs'=>'`armure`, `bouclier`', 'set'=>', :armure, :bouclier']];
  $fieldsTable = $fieldsTable.$arrayCA[filter($_POST['classe'])]['champs'];
  $set = $set.$arrayCA[filter($_POST['classe'])]['set'];
  if(!empty($dataTroupe)) {
    // Construction du $paramCost
    $paramCost = [['prep'=>':idFaction', 'variable'=>$dataTroupe[0]['factionTroupe']], ['prep'=>':indexType', 'variable'=>$dataTroupe[0]['typeTroupe']]];
    // Cost extraction
    $selectCout = "SELECT `idCout`, `indexType`, `coutBase`, `idFaction`, {$fieldsTable}
    FROM `cout` WHERE `idFaction` = :idFaction AND`indexType` = :indexType";
    $readCost = new RCUD($selectCout, $paramCost);
    $dataCost = $readCost->READ();
  }
print_r($dataCost);
// Calcul du prix de la figurine
} else {
    header('location:../index.php?message=Soucis d\'enregistrement.');
}
