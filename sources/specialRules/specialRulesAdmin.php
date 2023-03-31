<h2>Ajouter une règle spéciale</h2>

<button type="button" id="magic" class="open">Ouvrir le formulaire</button>
<div id="hiddenForm">
<form class="formulaireClassique" action="<?=encodeRoutage(23)?>" method="post">
  <label for="nomRS">Nom de la nouvelle règle spéciale :</label>
  <input id="nomRS" type="text" name="nomRS" required>
  <label for="descriptionRS">Description de la nouvelle règle spéciale : </label>
  <textarea id="descriptionRS" name="descriptionRS" rows="5" cols="33" required></textarea>
  <label for="prixRS">Prix de la règle spéciale ?</label>
  <input id="prixRS" name="prixRS" type="number" min="0" max="90"/>
  <button class="buttonForm" type="submit" name="idNav" value="<?=$idNav?>">Ajouter</button>
</form>
</div>

<?php
  require 'sources/specialRules/objets/getSpecialRules.php';
  require 'sources/specialRules/objets/printSpecialRules.php';
  $specialRules = new PrintSpecialRules();
  $valide = 1;
  $specialRules->ListeSpecialRules($specialRules->getSpecialRules($valide), $valide, $idNav);
  $valide = 0;
  $specialRules->ListeSpecialRules($specialRules->getSpecialRules($valide), $valide, $idNav);
  include 'javaScript/magicButton.php';
