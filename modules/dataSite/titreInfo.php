<?php
  $InfoSite = new PrintDataSite();
  $data = $InfoSite->getElementSite();
?>
<form class="formulaireClassique" action="<?php echo encodeRoutage(5); ?>" method="post">
  <h3>Les éléments constituants le site</h3>
  <label for="titre">Titre actuel : <?=$data[0]['titre']?></label>
  <input id="titre" type="text" name="titre" value="<?=$data[0]['titre']?>">
  <label for="titreHTML">Titre h1 : <?=$data[0]['sousTitre']?></label>
  <input id="titreHTML" type="text" name="titreHTML" value="<?=$data[0]['titreHTML']?>">
  <label for="sousTitre">Sous-titre actuel : <?=$data[0]['sousTitre']?></label>
  <input id="sousTitre" type="text" name="sousTitre" value="<?=$data[0]['sousTitre']?>">
  <label for="description">Description du site</label>
  <textarea id="description" name="description" rows="8" cols="80"><?=$data[0]['description']?></textarea>
  <button class="buttonForm" type="submit" name="idNav" value="<?=$idNav?>">Mettre à jour</button>
</form>
