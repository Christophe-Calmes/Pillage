<?php
// Routage 27
$parametre = new Preparation();
$param = $parametre->creationPrepIdUser($_POST);
$insert = "INSERT INTO `Factions`(`nomFaction`, `descriptionFaction`, `valide`, `factionPrivate`, `auteur`)
VALUES (:nomFaction, :descriptionFaction, 1, 1, :idUser)";
$action = new RCUD($insert, $param);
$action->CUD();
header('location:../index.php?idNav='.$idNav.'&message=Votre nouvelle faction à été enregistré.');
