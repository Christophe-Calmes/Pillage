<?php
require 'sources/factions/headFaction.php';
echo '
<div class="objetLeft">
    <h2>Ajouter une faction</h2>
      <button type="button" id="magic" class="open">Ouvrir le formulaire</button>
  </div>
  <div id="hiddenForm">';
  $factions->printForm(1, $idNav);

  echo '</div>';
// Affichage faction
$arrayFactions = [
  ['valide'=>1, 'factionPrivate'=> 0, 'message'=>'<h3>Les factions valides</h3>'],
  ['valide'=>0, 'factionPrivate'=> 0, 'message'=>'<h3>Les factions non valides</h3>'],
  ['valide'=>1, 'factionPrivate'=> 1, 'message'=>'<h3>Les factions valides privés</h3>'],
  ['valide'=>0, 'factionPrivate'=> 1, 'message'=>'<h3>Les factions non valides privés</h3>']];

foreach ($arrayFactions as $key => $value) {
  $dataFaction = $factions->getAdminFactions ($value['valide'], $value['factionPrivate']);
  if($dataFaction != []) {
    echo $value['message'];
    $factions->printFaction($dataFaction, $idNav);
  }
}
include 'javaScript/magicButton.php';
