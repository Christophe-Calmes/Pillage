<?php
require 'sources/factions/headFaction.php';
$idUser = new Controles();
$auteur = $idUser->idUser($_SESSION['tokenConnexion']);
$dataFactions = $factions->getGroupFactions ($auteur, 1, 1);
if($dataFactions != []) {
  echo '<h3>Paramètrage des factions</h3>';
  $factions->listFactions($dataFactions, false) ;
} else {
  echo '<h3>Pas encore de données</h3>';
}
