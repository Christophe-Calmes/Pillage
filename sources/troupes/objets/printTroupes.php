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
      // Update
      $update = 39;
      // Delette
      $routeDel = 38;
      //Designer
      $design = 117;
    } else {
      $route = 40;
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
          } else {
            echo '<a href='.findTargetRoute($design).'&idTroupe='.$value['idTroupe'].'>Définir</a>';
          }
        echo $value['nomTroupe'].' Faction : '.$value['nomFaction'].'
        Type de Troupe : '.$this->typeTroupe[$value['typeTroupe']].'
        Valide :'.yes($value['valide']);
      echo '</li>';
    }
    echo '</ul>';
  }
  public function designTroupe($dataTroupe, $dataCout, $idNav) {
    print_r($dataTroupe);
    echo '<br/>';
    print_r($dataCout);
    echo '<section class="flex-rows">';
      echo '<article>';
          echo '<h3>Création du profil de votre unité</h3>';
          echo '<ul>
                  <li class="formLi">'.$dataTroupe[0]['nomFaction'].'</li>
                  <li class="formLi">'.$dataTroupe[0]['nomTroupe'].'</li>
                  <li class="formLi">Description : '.$dataTroupe[0]['descriptionTroupe'].'</li>
                </ul>';
          echo '<form class="formulaireClassique" action="'.encodeRoutage(1).'" method="post">';
          echo '<ul>';
            echo'<li class="formLi"><label for="SP">Sans protection coût : '.$dataCout[0]['SP'].' PO</label>
                  <input id="SP" type="checkbox" name="SP"/>
                </li>';
          echo '<li class="formLi">
                  <label for="armure">Armure coût : '.$dataCout[0]['armure'].' PO</label>
                  <input id="armure" type="checkbox" name="armure"/>
                </li>';
          echo '<li class="formLi">
                  <label for="bouclier">Bouclier coût : '.$dataCout[0]['bouclier'].' PO</label>
                  <input id="armure" type="checkbox" name="bouclier"/>
                </li>';
          echo '<li class="formLi"><h4>Armes de mêlée</h4></li>';
          echo '<li class="formLi">
                  <label for="armeImp">Arme Improvisé coût : '.$dataCout[0]['armeImp'].' PO</label>
                  <input id="armure" type="checkbox" name="armeImp"/>
                </li>';
          echo '<li class="formLi">
                  <label for="lance">Lance coût : '.$dataCout[0]['lance'].' PO</label>
                  <input id="lance" type="checkbox" name="lance"/>
                </li>';
          echo '<input type="hidden" name="idTroupe" value="'.$dataTroupe[0]['idTroupe'].'"/>';
          echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Modifier</button>';
          echo '</form>';
      echo '</article>';
      echo '<article>';
        echo '<h3>Profil actuel</h3>';
      echo '</article>';
    echo '</section>';

  }
}
