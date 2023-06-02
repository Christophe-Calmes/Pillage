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
          <div class="nomFaction"><h3>Nom</h3></div>
          <div class="descriptionFaction"><h3>Description</h3></div>
          <div class="login"><h3>Auteur</h3></div>
          <div class="private"><h3>Faction Privé</h3></div>
          <div class="valide"><h3>Valide</h3></div>
          <div class="update"><h3>Modifier</h3></div>
          <div class="delete"><h3>Effacer</h3></div>
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
          <div class="nomFaction">Nom</div>
          <div class="descriptionFaction">Description</div>
          <div class="login">Auteur</div>
          <div class="private">Faction Privé</div>
          <div class="valide">Valide</div>
          <div class="update">Modifier</div>
          <div class="delete">Effacer</div>
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
          <div class="nomFaction">Nom</div>
          <div class="descriptionFaction">Description</div>
          <div class="login">Auteur</div>
          <div class="private">Faction Privé</div>
          <div class="valide">Valide</div>
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
  public function listFactions($variable, $admin) {
    if($admin) {
      $adresse = 107;
    } else {
      $adresse = 114;
    }
    echo '<div class="gallery">';
    foreach ($variable as $key => $value) {
      echo '<a class="item" href='.findTargetRoute($adresse).'&idFaction='.$value['idFaction'].'>'.$value['nomFaction'].'</a>';
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
  public function selectFaction($dataUser, $dataPublic) {
    echo '<label for="factionTroupe">Type de troupe</label>';
    echo '<select name="factionTroupe">';
    foreach ($dataUser as $key => $value) {
      echo '<option value="'.$value['idFaction'].'">Vos factions : '.$value['nomFaction'].'</option>';
    }
    foreach ($dataPublic as $key => $value) {
      echo '<option value="'.$value['idFaction'].'">Les factions officiel : '.$value['nomFaction'].'</option>';
    }

    echo '</select>';
  }

}
