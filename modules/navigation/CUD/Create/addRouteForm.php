<?php
// Créer la route
include '../functions/functionToken.php';
$_POST['route'] = IntToken(20);
//print_r($_POST);
$insert = "INSERT INTO `routageForm`(`chemin`, `securiter`, `route`) VALUES (:chemin, :securiter, :route)";
$parametre = new Preparation();
$param = $parametre->creationPrep ($_POST);
$action = new RCUD($insert, $param);
$action->CUD();
header('location:../index.php?idNav='.$idNav.'&message=Nouvelle route Formulaire entrée');
