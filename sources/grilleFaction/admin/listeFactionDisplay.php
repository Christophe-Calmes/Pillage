<?php
require 'sources/factions/headFaction.php';
$idUser = new Controles();
$auteur = $idUser->idUser($_SESSION['tokenConnexion']);
$dataFactions = $factions->getGroupFactions ($auteur, 1, 0);
if($dataFactions != []) {
  echo '<h3>Les factions</h3>';
  $factions->listFactionsDisplay($dataFactions, true);
} else {
  echo '<h3>Pas encore de données</h3>';
}
