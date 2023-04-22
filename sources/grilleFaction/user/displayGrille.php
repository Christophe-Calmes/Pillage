<?php
// Adressage 110
require 'sources/factions/headFaction.php';
$dataFactions = $factions->getFactionPublic();
if($dataFactions != []) {
  echo '<h3>Les factions public disponible</h3>';
  $factions->listFactions($dataFactions);
} else {
  echo '<h3>Pas encore de données</h3>';
}
