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
  public function printFaction($variable, $idNav) {

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
            <div class="update"><a href='.findTargetRoute(102).'&idFaction='.$value['idFaction'].'>Modifier</a></div>
            <div class="delete">';
            if($value['valide'] == 0) {
              echo'<form class="formulaireClassique" action="'.encodeRoutage(29).'" method="post">
                <input type="hidden" name="idFaction" value="'.$value['idFaction'].'"/>
                <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Effacer</button>
              </form>';
            } else {
              echo 'Non disponible';
            }

            echo '</div>
          </div>';
    }
  }
  public function printFactionUserAdmin($variable, $idNav) {

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
            <div class="update"><a href='.findTargetRoute(105).'&idFaction='.$value['idFaction'].'>Modifier</a></div>
            <div class="delete">';
            if($value['valide'] == 0) {
              echo'<form class="formulaireClassique" action="'.encodeRoutage(31).'" method="post">
                <input type="hidden" name="idFaction" value="'.$value['idFaction'].'"/>
                <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Effacer</button>
              </form>';
            } else {
              echo 'Non disponible';
            }

            echo '</div>
          </div>';
    }
  }


  public function printFactionUser($variable) {

  echo '<div class="userFaction headGrid">
          <div class="nomFaction headGrid">Nom</div>
          <div class="descriptionFaction headGrid">Description</div>
          <div class="login headGrid">Auteur</div>
          <div class="private headGrid">Faction Privé</div>
          <div class="valide headGrid">Valide</div>
        </div>';
    foreach ($variable as $key => $value) {
    echo '<div class="userFaction">
            <div class="nomFaction">'.$value['nomFaction'].'</div>
            <div class="descriptionFaction">'.$value['descriptionFaction'].'</div>
            <div class="login">'.$value['login'].'</div>
            <div class="private">'.Oui($value['factionPrivate']).'</div>
            <div class="valide">'.Oui($value['valide']).'</div>
          </div>';
    }
  }

  public function updateFaction($data, $idNav, $type) {
    // Type true = Administrateur, type false User
    if($type) {
      echo '<form class="formulaireClassique" action="'.encodeRoutage(28).'" method="post">';
    } else {
      echo '<form class="formulaireClassique" action="'.encodeRoutage(30).'" method="post">';
    }
    echo '<label for="nomFaction">Nom de la faction </label>
      <input id="nomFaction" type="text" name="nomFaction" value="'.$data[0]['nomFaction'].'" required>
      <label for="descriptionFaction">Description de la nouvelle faction</label>
      <textarea id="descriptionFaction" name="descriptionFaction" rows="5" cols="33" required>'.$data[0]['descriptionFaction'].'</textarea>';
        if($type) {
          echo '<label for="factionPrivate">Faction privé ?</label>
                <select id="factionPrivate" name="factionPrivate">';
          echo selected($data[0]['factionPrivate']);
          echo '</select>';
        }
      echo '<label for="valide">Faction valide ?</label>
      <select id="valide" name="valide">';
      echo selected($data[0]['valide']);
      echo'</select>
      <input name="idFaction" value="'.$data[0]['idFaction'].'" type="hidden"/>
      <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Modifier</button>
    </form>';
  }
  public function listFactions($variable) {
    echo '<div class="gallery">';
    foreach ($variable as $key => $value) {
      echo '<a class="item" href='.findTargetRoute(107).'&idFaction='.$value['idFaction'].'>'.$value['nomFaction'].'</a>';
    }
    echo '</div>';
  }
  public function listFactionsDisplay($variable, $admin) {
    if($admin) {
      $adresse = 108;
    } else {
      $adresse = 111;
    }
    echo '<div class="gallery">';
    foreach ($variable as $key => $value) {
      echo '<a class="item" href='.findTargetRoute($adresse).'&idFaction='.$value['idFaction'].'>'.$value['nomFaction'].'</a>';
    }
    echo '</div>';
  }
}
