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
    function testValue ($data) {
      switch ($data) {
        case NULL:
          return false;
          break;
        case $data < 0:
          return false;
          break;
        default:
          return true;
      }
    }
    function freeStuff($data) {
      if($data == 0) {
        return 'Gratuit';
      } else {
        return $data;
      }
    }

    function loop ($dataCout, $array) {
      foreach ($array as $key => $value) {
        if(testValue ($dataCout[0][$value['id']])) {
          echo '<li class="formLi">
                  <label for="'.$dataCout[0][$value['id']].'">'.$value['message'].' coût : '.freeStuff($dataCout[0][$value['id']]).' PO</label>
                  <input id="'.$dataCout[0][$value['id']].'" type="checkbox" name="'.$dataCout[0][$value['id']].'"/>
                </li>';
        } else {
          echo '<li class="formLi">Pas de données disponible</li>';
        }
      }
    }

    echo '<section class="flex-rows">';
      echo '<article>';
          echo '<h3>Création du profil de votre unité</h3>';
          echo '<ul>
                  <li class="formLi">'.$dataTroupe[0]['nomFaction'].'</li>
                  <li class="formLi">'.$dataTroupe[0]['nomTroupe'].'</li>
                  <li class="formLi">'.$this->typeTroupe[$dataTroupe[0]['typeTroupe']].'</li>
                  <li class="formLi">Description : '.$dataTroupe[0]['descriptionTroupe'].'</li>
                </ul>';
          if(!empty($dataCout)) {
          echo '<form class="formulaireClassique" action="'.encodeRoutage(1).'" method="post">';
          echo '<ul>';
          echo '<li class="formLi"><h4>Type de protection</h4></li>';
          echo '<li class="formLi"><fieldset class="flex-colonne">';
            $radio = [['id'=>'sp', 'value'=>'0', 'message'=>'Sans protection', 'cout'=>$dataCout[0]['SP']],
                      ['id'=>'armure', 'value'=>'1', 'message'=>'Armure', 'cout'=>$dataCout[0]['armure']],
                      ['id'=>'Bouclier', 'value'=>'2', 'message'=>'Bouclier' , 'cout'=>$dataCout[0]['bouclier']],
                      ['id'=>'CC', 'value'=>'3', 'message'=>'Armure et bouclier', 'cout'=>($dataCout[0]['armure'] + $dataCout[0]['SP'])]];
                      foreach ($radio as $key => $value) {
                        if(testValue ($value['cout'])) {
                            echo '<div class="flex-rows">
                                    <input id="'.$value['id'].'" type="radio" name="classe" value="'.$value['value'].'"/>
                                    <label  for="'.$value['id'].'">'.$value['message'].' Coût : '.$value['cout'].'</label>
                                  </div>';
                        }
                      }
          echo '</li></fieldset>';
          echo '<li class="formLi"><h4>Armes de mêlée</h4></li>';
          $weapon = [['id'=>'armeImp', 'message'=>'Arme Improvisé'],
                      ['id'=>'lance', 'message'=>'Lance'],
                      ['id'=>'armeDeBase', 'message'=>'Arme à une main'],
                      ['id'=>'hacheD', 'message'=>'Hache Danoise']];
          loop($dataCout, $weapon);
          echo '<li class="formLi"><h4>Armes de tir</h4></li>';
          $weaponShoot = [['id'=>'fronde', 'message'=>'Fonde'],
                      ['id'=>'javelot', 'message'=>'Javelot'],
                      ['id'=>'arc', 'message'=>'Arc'],
                      ['id'=>'arbalete', 'message'=>'Arbalete']];
          loop($dataCout, $weaponShoot);
          echo '<li class="formLi"><h4>Equipements</h4></li>';
          $specialRules = [['id'=>'cheval', 'message'=>'Fonde'],
                      ['id'=>'corDG', 'message'=>'Javelot'],
                      ['id'=>'chienDG', 'message'=>'Arc'],
                      ['id'=>'arbalete', 'message'=>'Arbalete']];
            loop($dataCout, $specialRules);

          echo '<input type="hidden" name="idTroupe" value="'.$dataTroupe[0]['idTroupe'].'"/>';
          echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Modifier</button>';
          echo '</form>';
        } else {
          echo '<h3>Grille de coût indisponible</h3>';
        }
      echo '</article>';
      echo '<article>';
        echo '<h3>Profil actuel</h3>';
      echo '</article>';
    echo '</section>';

  }
}
