<?php
require 'sources/factions/headFaction.php';
echo '<div class="objetLeft">
        <h2>Ajouter une faction</h2>
          <button type="button" id="magic" class="open">Ouvrir le formulaire</button>
      </div>
      <div id="hiddenForm">';
        $factions->printForm(0, $idNav);
  echo '</div>';
// Affichage faction
$arrayFactions = [['valide'=>1, 'factionPrivate'=> 1, 'message'=>'<h3>Vos factions valides privés</h3>'],
                  ['valide'=>0, 'factionPrivate'=> 1, 'message'=>'<h3>Vos factions non valides privés</h3>']];
$idUser  = new Controles();
$id = $idUser->idUser($_SESSION['tokenConnexion']);
foreach ($arrayFactions as $key => $value) {
  $dataFaction = $factions->getAdminFactionsUser($value['valide'], $value['factionPrivate'], $id);
  if(!empty($dataFaction)) {
    echo $value['message'];
    $factions->printFactionUserAdmin($dataFaction, $idNav);
  }
}
include 'javaScript/magicButton.php';
