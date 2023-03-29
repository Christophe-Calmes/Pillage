<?php
include '../functions/functionToken.php';
array_push($controleForm, sizePost(filter($_POST['titreMenu']),80));
array_push($controleForm, sizePost(filter($_POST['niveau']),1));
if ($controleForm == [0, 0, 0]) {
  $niveau = filter($_POST['niveau']);
  array_pop($_POST);
  // Création du nouveau menu déroulant
  $parametre = new Preparation();
  $param = $parametre->creationPrep ($_POST);
  $insert = "INSERT INTO `menuNav`(`titreMenu`) VALUES (:titreMenu)";
  $action = new RCUD($insert, $param);
  $action->CUD();
  // Création du menu déroulant dans la table navigation
  // Construction de la valeur déroulant Recherche de l'id du dernière enregistrement
  $select = "SELECT `idMenuDeroulant` FROM `menuNav`ORDER BY `idMenuDeroulant` DESC LIMIT 1";
  $void = array();
  $readLastId = new RCUD($select, $void);
  $lastId = $readLastId->READ();
  // Construction du nouveau $_POST
    $nomNav = $_POST['titreMenu'];
    $_POST = array();
    $_POST['nomNav'] = $nomNav;
    $_POST['cheminNav'] = 'modules/navigation/erreurNav.php';
    $_POST['menuVisible'] = 1;
    $_POST['zoneMenu'] = 0;
    $_POST['ordre'] = 0;
    $_POST['niveau'] = $niveau;
    $_POST['deroulant'] = $lastId[0]['idMenuDeroulant'];
    $_POST['targetRoute'] =  genToken (16);
    // Création du tableau $param pour enregistrement dans navigation
      $insert = "INSERT INTO `navigation`(`nomNav`, `cheminNav`, `menuVisible`, `zoneMenu`, `ordre`, `niveau`, `deroulant`, `targetRoute`)
      VALUES (:nomNav, :cheminNav, :menuVisible, :zoneMenu, :ordre, :niveau, :deroulant, :targetRoute)";
      $parametre = new Preparation();
      $param = $parametre->creationPrep ($_POST);
      $action = new RCUD($insert, $param);
      $action->CUD();
      header('location:../index.php?message=Nouveau menu déroulant enregistré&idNav='.$idNav);
} else {
  header('location:../index.php?message=Menu déroulant trop long&idNav='.$idNav);
}
