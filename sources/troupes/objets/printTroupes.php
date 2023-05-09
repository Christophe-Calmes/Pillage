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
    echo '<ul>';
    foreach ($variable as $key => $value) {
      echo '<li>'.$value['nomTroupe'].' Faction : '.$value['nomFaction'].' Valide :'.yes($value['valide']).'</li>';
    }
    echo '</ul>';
  }
}
