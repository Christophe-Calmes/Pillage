<?php
  $yes = ['Non', 'Oui'];
  include 'arrayInterne/roles.php';
  $dataMenuDeroulant = $readNav->getMenuDeroulant();
?>
<h3>Ajouter un lien de navigation</h3>
<form class="formulaireClassique" action="<?php echo encodeRoutage(4); ?>" method="post">
  <label for="nomNav">Nom du lien</label>
  <input id="nomNav" type="text" name="nomNav" required>
  <label for="cheminNav">chemin du lien</label>
  <input id="cheminNav" type="text" name="cheminNav" required>
  <label for="menuVisible">Menu visible ?</label>
    <select id="menuVisible" name="menuVisible">
      <?php for ($i=0; $i < count($yes) ; $i++) {  echo '<option value="'.$i.'">'.$yes[$i].'</option>'; } ?>
    </select>
  <label for="ordre">Ordre d'apparition</label>
  <input id="ordre" type="number" name="ordre" min="0" max="20" required>
  <label for="niveau">Niveau d'acréditation</label>
    <select id="niveau" name="niveau">
      <?php for ($i=0; $i < count($internaute) ; $i++) {  echo '<option value="'.$i.'">'.$internaute[$i].'</option>'; } ?>
    </select>
    <?php
      $readNav->selectZoneMenu($dataMenuDeroulant);
      $readNav->menuDeroulant($dataMenuDeroulant);
    ?>

<button class="buttonForm" type="submit" name="idNav" value="<?=$idNav?>">Ajouter</button>
</form>
