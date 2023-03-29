<?php
  require 'objets/getClasse.php';
  require 'objets/printClasse.php';
  $debug = false;
  $classes = new PrintClasses();
?>
<h2>Ajouter une classe</h2>
<?php
if($debug) {
  print_r($idNav);
}
?>
<button type="button" id="magic" class="open">Ouvrir le formulaire</button>
<div id="hiddenForm" style="display: none;" >
<form class="formulaireClassique" action="<?=encodeRoutage(20)?>" method="post">
  <label for="nomClasse">Nom d'une nouvelle classes </label>
  <input id="nomClasse" type="text" name="nomClasse" required>
  <label for="codeClasse">Code classe ?</label>
  <input id="nomClasse" type="text" name="codeClasse" maxlength="2"required>
  <label for="descriptionClasse">Description de la nouvelle classe </label>
  <textarea id="descriptionClasse" name="descriptionClasse" rows="5" cols="33" required></textarea>
  <label for="deplacement">Déplacement lié à la classe en pouces ?</label>
  <input id="deplacement" name="deplacement" type="number" min="0" max="12"/>
  <label for="prixClasse">Prix de la classe ?</label>
  <input id="prixClasse" name="prixClasse" type="number" min="0" max="30"/>
  <button class="buttonForm" type="submit" name="idNav" value="<?=$idNav?>">Ajouter</button>
</form>
</div>
<script type="text/javascript">
  let jeckyl = document.getElementById('magic');
  let magax = document.getElementById('hiddenForm');
  jeckyl.addEventListener('click', function(){
    if(!open) {
      jeckyl.innerText = "Fermer le formulaire";
      magax.style.display = "block";
      open = true;
    } else {
      jeckyl.innerText = "Ouvrir le formulaire";
      magax.style.display = "none";
      open = false;
    }
    return open;
  });
</script>


<?php
  $valideClasse = 1;
  $classes->ListeClasse($classes->getClasse($valideClasse), $valideClasse, $idNav);
  $valideClasse = 0;
  $classes->ListeClasse($classes->getClasse($valideClasse), $valideClasse, $idNav);
