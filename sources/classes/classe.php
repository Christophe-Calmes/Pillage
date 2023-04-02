<div class="objetLeft">
<h2>Ajouter une classe</h2>

<button type="button" id="magic" class="open">Ouvrir le formulaire</button>
</div>
<div id="hiddenForm">
<form class="formulaireClassique" action="<?=encodeRoutage(20)?>" method="post">
  <label for="nomClasse">Nom d'une nouvelle classes </label>
  <input id="nomClasse" type="text" name="nomClasse" required>
  <label for="codeClasse">Code classe ?</label>
  <input id="nomClasse" type="text" name="codeClasse" maxlength="2"required>
  <label for="descriptionClasse">Description de la nouvelle classe </label>
  <textarea id="descriptionClasse" name="descriptionClasse" rows="5" cols="33" required></textarea>
  <label for="deplacement">Déplacement pieton ?</label>
  <input id="deplacement" name="deplacement" type="number" min="0" max="14"/>
  <label for="cavalerie">Déplacement cavalerie ?</label>
  <input id="cavalerie" name="cavalerie" type="number" min="0" max="22"/>
  <button class="buttonForm" type="submit" name="idNav" value="<?=$idNav?>">Ajouter</button>
</form>
</div>
<?php
  require 'objets/getClasse.php';
  require 'objets/printClasse.php';
  $debug = false;
  $classes = new PrintClasses();
  $valideClasse = 1;
  $classes->ListeClasse($classes->getClasse($valideClasse), $valideClasse, $idNav);
  $valideClasse = 0;
  $classes->ListeClasse($classes->getClasse($valideClasse), $valideClasse, $idNav);
  include 'javaScript/magicButton.php';
