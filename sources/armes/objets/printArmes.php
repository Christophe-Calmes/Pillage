<?php
Class PrintArmes extends GetArmes {
  public function displayArmes($data, $type) {
  echo '<article>';
  if($type == 0) {
    echo '<h3>Armes de contacts</h3>';
  }
  if($type == 1) {
    echo '<h3>Armes de tirs</h3>';
  }
  echo '<div class="arrayWeapon">
    <div class="nomWeapon"><h3>Nom d\'arme</h3></div>
    <div class="descriptionWeapon"><h3>Description</h3></div>
    <div class="close"><h3>Type</h3></div>';
        if($type == 0) {
    echo'<div class="distance"><h3>Portée</h3></div>';
  }
    echo'</div>';
  foreach ($data as $key ) {
  echo '<div class="arrayWeapon">
      <div class="nomWeapon">'.$key['nomArme'].'</div>
      <div class="descriptionWeapon">'.$key['descriptionArme'].'</div>
      <div class="close">';
      if($key['contact'] == 1) {
        echo 'Arme de close';
      } else {
        echo 'Arme de tir';
      }
      echo'</div>';
      if($type == 0) {
        echo $key['distance'].' " / '.($key['distance']*2).' "';
      }
      echo'</div>';
  }
  echo '</article>';
  }
}
