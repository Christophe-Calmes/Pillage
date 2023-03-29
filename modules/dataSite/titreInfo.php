<form class="formulaireClassique" action="<?php echo encodeRoutage(5); ?>" method="post">
  <h3>Les éléments constituants le site</h3>
  <label for="titre">Titre actuel : <?=$title?></label>
  <input id="titre" type="text" name="titre" value="<?=$title?>">
  <label for="titreHTML">Titre h1 : <?=$titleHeader?></label>
  <input id="titreHTML" type="text" name="titreHTML" value="<?=$titleHeader?>">
  <label for="sousTitre">Sous-titre actuel : <?=$title2?></label>
  <input id="sousTitre" type="text" name="sousTitre" value="<?=$title2?>">
  <label for="description">Description du site</label>
  <textarea id="description" name="description" rows="8" cols="80"><?=$description?></textarea>
  <button class="buttonForm" type="submit" name="idNav" value="<?=$idNav?>">Mettre à jour</button>
</form>
