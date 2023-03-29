<?php
Class PrintNavigation extends GetNavigation {
  public function bandeauHaut($variable){
    echo '<nav><ul class="navigationBandeau">';
      foreach ($variable as $key => $value) {
        if(($value['zoneMenu'] == 0)&&($value['deroulant'] == 0)) {
          echo '<li><a href="index.php?idNav='.$value['targetRoute'].'">'.$value['nomNav'].'</a></li>';
        } else {
          echo '<div class="dropdown">';
          echo '<button class="buttonForm">'.$value['nomNav'].'</button>';
          $select = "SELECT `idNav`, `nomNav`, `cheminNav`, `menuVisible`, `zoneMenu`, `ordre`, `niveau`, `valide`, `deroulant`, `targetRoute`
          FROM `navigation`
          WHERE `zoneMenu` = :zoneMenu AND `niveau` = :niveau AND `valide` = 1";
          $param = [['prep'=>':zoneMenu', 'variable'=>$value['deroulant']],['prep'=>':niveau', 'variable'=>$value['niveau']]];
          $readData = new RCUD($select, $param);
          $dataTraiter = $readData->READ();
          echo ' <div class="dropdown-child">';
          foreach ($dataTraiter as $cle => $valeur) {
              echo '<div><a href="index.php?idNav='.$valeur['targetRoute'].'">'.$valeur['nomNav'].'</a></div>';
          }
          echo '</div>';
          echo '</div>';
        }
      }
    echo '</ul></nav>';
  }
  public function selectZoneMenu($variable) {
    echo '<label for="zoneMenu">Zone du menu</label>
          <select id="zoneMenu" name="zoneMenu">
          <option value="0">Bandeau de navigation</option>';
          foreach ($variable as $key => $value) {
            echo '<option value="'.$value['idMenuDeroulant'].'">'.$value['titreMenu'].'</option>';
          }
    echo'</select>';
  }
  public function menuDeroulant($variable) {
    echo '<label for="deroulant">Menu déroulant ?</label>
          <select id="deroulant" name="deroulant">
          <option value="0">Non</option>';
          foreach ($variable as $key => $value) {
            echo '<option value="'.$value['idMenuDeroulant'].'">'.$value['titreMenu'].'</option>';
          }
    echo'</select>';
  }
  public function listeMenuDeroulant($variable) {
    echo '<ul>';
      foreach ($variable as $key => $value) {
        echo '<li>'.$value['titreMenu'].'</li>';
      }
    echo '</ul>';
  }
  public function listeRouteForm($variable, $securiter) {
    echo '<ul>';
      foreach ($variable as $key => $value) {
        echo '<li>'.$securiter[$value['securiter']].' | '.$value['chemin'].' |Action => encodeRoutage('.$value['idForm'].')</li>';
      }
    echo '</ul>';
  }
}
