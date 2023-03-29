<?php
include '../functions/functionToken.php';
//Contrôle de la qualité des informations en taille.
$sizeTable = [30, 80, 1, 3, 3, 5, 3];
$postKey = array_keys($_POST);
for ($i=0; $i < count($postKey) ; $i++) {
array_push($controleForm, sizePost(filter($_POST[$postKey[$i]]), $sizeTable[$i]));
}
$qualite = array();
for ($i=0; $i < 8 ; $i++) {
  array_push($qualite, 0);
}
//Fin controle de la qualité
//Création du token du target route
$_POST['targetRoute'] =  IntToken (16);
//Fin création token
if($controleForm == $qualite) {
  $insert = "INSERT INTO `navigation`(`nomNav`, `cheminNav`, `menuVisible`, `zoneMenu`, `ordre`, `niveau`, `deroulant`, `targetRoute`)
  VALUES (:nomNav, :cheminNav, :menuVisible, :zoneMenu, :ordre, :niveau, :deroulant, :targetRoute)";
  $parametre = new Preparation();
  $param = $parametre->creationPrep ($_POST);
  $action = new RCUD($insert, $param);
  $action->CUD();
  header('location:../index.php?message=Nouveau lien enregistré&idNav='.$idNav);
} else {
  header('location:../index.php?message=Soucis de traitement de votre formulaire');
}
