<?php
require 'sources/factions/objets/getFactions.php';
require 'sources/factions/objets/printFactions.php';
$formulaire = new PrintFactions();
echo '
<div class="objetLeft">
    <h2>Ajouter une faction</h2>
      <button type="button" id="magic" class="open">Ouvrir le formulaire</button>
  </div>
  <div id="hiddenForm">';
  $formulaire->printForm(1, $idNav);

  echo '</div>';
include 'javaScript/magicButton.php';
