<?php
function yes($data) {
  if($data == 1) {
    return 'Oui';
  } else {
    return 'Non';
  }
}

Class PrintTroupes extends GetTroupes {
  public function simpleTroupes($variable) {
    // Permet d'afficher les troupes créer par l'utilisateur
    echo '<ul>';
    foreach ($variable as $key => $value) {
      echo '<li>'.$value['nomTroupe'].' Faction : '.$value['nomFaction'].' Type de Troupe : '.$this->typeTroupe[$value['typeTroupe']].' Valide :'.yes($value['valide']).'</li>';
    }
    echo '</ul>';
  }
}
