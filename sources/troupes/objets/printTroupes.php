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

    echo '<section class="flex-rows">';
      echo '<article>';
          echo '<h3>Création du profil de votre unité</h3>';
          echo '<ul>
                  <li class="formLi">'.$dataTroupe[0]['nomFaction'].'</li>
                  <li class="formLi">'.$dataTroupe[0]['nomTroupe'].'</li>
                  <li class="formLi">Description : '.$dataTroupe[0]['descriptionTroupe'].'</li>
                </ul>';
          if(!empty($dataCout)) {
          echo '<form class="formulaireClassique" action="'.encodeRoutage(1).'" method="post">';
          echo '<ul>';
          echo '<li class="formLi"><h4>Type de protection</h4></li>';
            echo'<li class="formLi"><label for="SP">Sans protection (SP) coût : '.$dataCout[0]['SP'].' PO</label>
                  <input id="SP" type="checkbox" name="P1"/>
                </li>';
          echo '<li class="formLi">
                  <label for="armure">Armure (PP) coût : '.$dataCout[0]['armure'].' PO</label>
                  <input id="armure" type="checkbox" name="P2"/>
                </li>';
          echo '<li class="formLi">
                  <label for="bouclier">Bouclier (PP) coût : '.$dataCout[0]['bouclier'].' PO</label>
                  <input id="armure" type="checkbox" name="P3"/>
                </li>';
          echo '<li class="formLi">
                  <label for="bouclier">Armure + Bouclier (PC) coût : '.($dataCout[0]['bouclier'] + $dataCout[0]['armure']).' PO</label>
                  <input id="armure" type="checkbox" name="P4"/>
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
          echo '<li class="formLi">
                  <label for="armeDeBase">Arme à une main coût : '.$dataCout[0]['armeDeBase'].' PO</label>
                  <input id="armeDeBase" type="checkbox" name="armeDeBase"/>
                </li>';
          echo '<li class="formLi">
                  <label for="hacheD">Hache Danoise coût : '.$dataCout[0]['hacheD'].' PO</label>
                  <input id="hacheD" type="checkbox" name="hacheD"/>
                </li>';
          echo '<li class="formLi"><h4>Armes de tir</h4></li>';
          echo '<li class="formLi">
                  <label for="fronde">Fronde coût : '.$dataCout[0]['fronde'].' PO</label>
                  <input id="fronde" type="checkbox" name="fronde"/>
                </li>';
          echo '<li class="formLi">
                  <label for="javelot">Javelot coût : '.$dataCout[0]['javelot'].' PO</label>
                  <input id="javelot" type="checkbox" name="javelot"/>
                </li>';
          echo '<li class="formLi">
                  <label for="arc">Arc coût : '.$dataCout[0]['arc'].' PO</label>
                  <input id="arc" type="checkbox" name="arc"/>
                </li>';
          echo '<li class="formLi">
                  <label for="arbalete">Arbalète coût : '.$dataCout[0]['arbalete'].' PO</label>
                  <input id="arbalete" type="checkbox" name="arbalete"/>
                </li>';
          echo '<li class="formLi"><h4>Equipements</h4></li>';
          echo '<li class="formLi">
                  <label for="cheval">Cheval coût : '.$dataCout[0]['cheval'].' PO</label>
                  <input id="cheval" type="checkbox" name="cheval"/>
                </li>';
          echo '<li class="formLi">
                  <label for="banniere">Bannière coût : '.$dataCout[0]['banniere'].' PO</label>
                  <input id="abanniere" type="checkbox" name="banniere"/>
                </li>';
          echo '<li class="formLi">
                  <label for="corDG">Cor de guerre coût : '.$dataCout[0]['corDG'].' PO</label>
                  <input id="corDG" type="checkbox" name="corDG"/>
                </li>';
          echo '<li class="formLi">
                  <label for="chienDG">Chien de guerre coût : '.$dataCout[0]['chienDG'].' PO</label>
                  <input id="chienDG" type="checkbox" name="chienDG"/>
                </li>';
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
