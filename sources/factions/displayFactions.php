<?php
require 'sources/factions/headFaction.php';
// Affichage faction
  $dataFaction = $factions->getAdminFactions (1, 0);
  if(!empty($dataFaction)) {
    echo '<h3>Les factions Générale</h3>';
    $factions->printFactionUser($dataFaction);
  } else {
    echo '<h3>Aucune factions Générale</h3>';
  }
