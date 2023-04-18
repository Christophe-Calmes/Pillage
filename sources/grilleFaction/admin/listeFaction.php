<?php
require 'sources/factions/headFaction.php';
$idUser = new Controles();
$auteur = $idUser->idUser($_SESSION['tokenConnexion']);
$dataFactions = $factions->getGroupFactions ($auteur, 1, 0);
$factions->listFactions($dataFactions);
