<?php
  include 'arrayInterne/roles.php';
?>
<h3>Ajouter un nouveau menu déroulant</h3>
<form class="formulaireClassique" action="<?=encodeRoutage(6)?>" method="post">
  <label for="titreMenu">Nouveau menu</label>
  <input id="titreMenu" type="text" name="titreMenu" required>
  <label for="niveau">Niveau d'acréditation du nouveau menu ?</label>
  <select id="niveau"  name="niveau">
    <?php for ($i=0; $i < count($internaute) ; $i++) {  echo '<option value="'.$i.'">'.$internaute[$i].'</option>'; } ?>
  </select>
  <button class="buttonForm" type="submit" name="idNav" value="<?=$idNav?>">Ajouter</button>
</form>
