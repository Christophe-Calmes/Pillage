<?php
//Routage 45
$parametre = new Preparation();
$param = $parametre->creationPrepIdUser ($_POST);
print_r($param);
$insert = "INSERT INTO `Listes`(`nomListe`, `idFaction`, `descriptionListe`, `auteurListe`)
            VALUES ( :nomListe, :factionTroupe, :descriptionListe, :idUser)";
$action = new RCUD($insert, $param);
$action->CUD();
header('location:../index.php?idNav='.$idNav.'&message=Liste créer.');
