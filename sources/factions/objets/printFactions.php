<?php
Class PrintFactions extends GetFactions {
  public function printForm($type, $idNav) {
    // Si admin $type = 1
    if($type == 1) {
      echo '<form class="formulaireClassique" action="'.encodeRoutage(26).'" method="post">
        <label for="nomFaction">Nom d\'une nouvelle faction de pillage </label>
        <input id="nomFaction" type="text" name="nomFaction" required>
        <label for="descriptionFaction">Description de la nouvelle faction</label>
        <textarea id="descriptionFaction" name="descriptionFaction" rows="5" cols="33" required></textarea>
        <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Ajouter</button>
      </form>';
    } else {
      // 
      echo '<form class="formulaireClassique" action="'.encodeRoutage(27).'" method="post">
        <label for="nomFaction">Nom d\'une nouvelle faction de pillage </label>
        <input id="nomFaction" type="text" name="nomFaction" required>
        <label for="descriptionFaction">Description de la nouvelle faction</label>
        <textarea id="descriptionFaction" name="descriptionFaction" rows="5" cols="33" required></textarea>
        <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Ajouter</button>
      </form>';
    }
  }
}
