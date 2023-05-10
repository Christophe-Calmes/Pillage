<?php
function yes($data) {
  if($data == 1) {
    return 'Oui';
  } else {
    return 'Non';
  }
}

Class PrintTroupes extends GetTroupes {
  public function simpleTroupes($variable, $admin, $idNav) {
    // $ admin false / true
    if (!$admin) {
      // Valide / Unvalide
      $route = 37;
      // Delette
      $routeDel = 38;
    } else {
      $route = 39;
    }
    // Permet d'afficher les troupes créer par l'utilisateur
    echo '<ul>';
    foreach ($variable as $key => $value) {
      if($value['valide'] == 1) {
        $message = 'Invalider';
      } else {
        $message = 'Valider';
      }
      echo '<li class="formLi">';
        echo '<form class="formulaireClassique" action="'.encodeRoutage($route).'" method="post">';
        echo '<input type="hidden" name="idTroupe" value="'.$value['idTroupe'].'"/>';
        echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">'.$message.'</button>';
        echo '</form>';
        if($value['valide'] == 0) {
          echo '<form class="formulaireClassique" action="'.encodeRoutage($routeDel).'" method="post">';
          echo '<input type="hidden" name="idTroupe" value="'.$value['idTroupe'].'"/>';
          echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Effacer</button>';
          echo '</form>';
        }

        echo $value['nomTroupe'].' Faction : '.$value['nomFaction'].'
        Type de Troupe : '.$this->typeTroupe[$value['typeTroupe']].'
        Valide :'.yes($value['valide']);
      echo '</li>';
    }
    echo '</ul>';
  }
}
