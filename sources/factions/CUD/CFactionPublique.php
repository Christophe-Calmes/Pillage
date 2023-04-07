<?php
// Routage 27
$parametre = new Preparation();
$param = $parametre->creationPrepIdUser($_POST);
$insert = "INSERT INTO `Factions`(`nomFaction`, `descriptionFaction`, `valide`, `auteur`, `factionPrivate`) VALUES (:nomFaction, :descriptionFaction, 1, :auteur, 1)";
$action = new RCUD($param, $insert);
$action->CUD();
header('location:../index.php?idNav='.$idNav.'&message=Votre nouvelle faction à été enregistré.');
