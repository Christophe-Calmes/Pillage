<?php
function Oui ($yes){
        if($yes == 0) {
          return 'Non';
        } else {
          return 'Oui';
        }
      }
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
  public function printFaction($variable) {

  echo '<div class="adminFaction headGrid">
          <div class="nomFaction headGrid">Nom</div>
          <div class="descriptionFaction headGrid">Description</div>
          <div class="login headGrid">Auteur</div>
          <div class="private headGrid">Faction Privé</div>
          <div class="valide headGrid">Valide</div>
          <div class="update headGrid">Modifier</div>
          <div class="delete headGrid">Effacer</div>
        </div>';
    foreach ($variable as $key => $value) {
    echo '<div class="adminFaction">
            <div class="nomFaction">'.$value['nomFaction'].'</div>
            <div class="descriptionFaction">'.$value['descriptionFaction'].'</div>
            <div class="login">'.$value['login'].'</div>
            <div class="private">'.Oui($value['factionPrivate']).'</div>
            <div class="valide">'.Oui($value['valide']).'</div>
            <div class="update">A venir</div>
            <div class="delete">A venir</div>
          </div>';
    }
  }
}
