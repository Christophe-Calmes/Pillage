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
        $set = '`'.$key.'` , '.$set;
      }
    }
    // Retirer la dernière virgule
    $set = substr($set, 0, -2).',';
    return $set;
  }
  function sumSQL ($data, $fields) {
    $set = NULL;
    foreach ($data as $key => $value) {
      if(in_array($key, $fields)) {
        $set = '`'.$key.'` + '.$set;
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


// Contrôle pour s'arrurer que classe et idTroupe sont bien dans le formulaire.
if (array_key_exists('classe', $_POST) && array_key_exists('idTroupe', $_POST)) {
  array_push($test, 1);
} else {
  array_push($test, 0);
}
if($test == $controle) {
  require '../sources/grilleFaction/objets/getGrilles.php';
  require '../sources/grilleFaction/objets/printGrilles.php';
  $Grilles = new PrintGrilles();
  $fields = $Grilles->setChamps();
  $set = setSQL($_POST, $fields);
  $fieldsTable = requestSQL($_POST, $fields);
  $sum = sumSQL ($_POST, $fields);
  // Sauvegarde de $_POST
  $backPost = $_POST;
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
      $SUM = 'SUM(`coutBase` + '.$sum.') AS `price`';
      $selectCout = 'SELECT '.$SUM.' FROM `cout` WHERE `idFaction` = :idFaction AND`indexType` = :indexType';
      $readCost = new RCUD($selectCout, $paramCost);
      $dataCost = $readCost->READ();
    }
    // Calcul du prix de la figurine
    $prixTroupe = $dataCost[0]['price'];
    $parametre = new Preparation();
    $param = $parametre->creationPrepIdUser ($_POST);
    //print_r($param);
    $requestSet = NULL;
    //print_r($fields);
    // Extractio des valeur pour générer la requête dynamique
    array_unshift($param, ['prep'=>':prixTroupe', 'variable'=>$prixTroupe]);
    foreach (array_slice($param , 0, count($param)-2)as $key => $value) {
      // Construction
      $set =  substr($value['prep'],1);
      $prep = $value['prep'];
      $construct = '`'.$set.'` = '.$prep.', ';
      $requestSet = $requestSet.$construct;
    }
    // Elmine la dernière , de la requête
    $requestSet =  substr($requestSet, 0, -2);
    // Enregistrement de l'update
    $update = "UPDATE `Troupes` SET
              {$requestSet}
              WHERE `idTroupe` = :idTroupe
              AND `auteur` = :idUser";
        /*print_r($param);
        echo '<br/>';
        print_r($update);*/
   $action = new RCUD($update, $param);
   $action->CUD();
   header('location:../index.php?idNav='.$idNav.'&idTroupe='.filter($_POST['idTroupe']).'&message=Soucis d\'enregistrement.');
} else {
    header('location:../index.php?message=Soucis d\'enregistrement.');
}
