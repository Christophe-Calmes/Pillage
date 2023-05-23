<?php
function yes($data) {
  if($data == 1) {
    return 'Oui';
  } else {
    return 'Non';
  }
}
function affichageProfil($value, $key) {
  if($value == 1) {
    echo '<li class="formLi">'.$key.'</li>';
  }
}
Class PrintTroupes extends GetTroupes {
  private $weapon;
  private $weaponShoot;
  private $specialRules;
  public function __construct() {
      parent::__construct();
      $this->weapon = [['id'=>'armeImp', 'message'=>'Arme Improvisé', 'range'=> NULL],
                  ['id'=>'lance', 'message'=>'Lance', 'range'=> NULL],
                  ['id'=>'armeDeBase', 'message'=>'Arme à une main', 'range'=> NULL],
                  ['id'=>'hacheD', 'message'=>'Hache Danoise', 'range'=> NULL]];
      $this->weaponShoot = [['id'=>'fronde', 'message'=>'Fonde', 'range'=> 15],
                  ['id'=>'javelot', 'message'=>'Javelot', 'range'=> 6],
                  ['id'=>'arc', 'message'=>'Arc', 'range'=> 20],
                  ['id'=>'arbalete', 'message'=>'Arbalete', 'range'=> 20]];
      $this->specialRules = [['id'=>'cheval', 'message'=>'Cheval'],
                    ['id'=>'corDG', 'message'=>'Cor de guerre'],
                    ['id'=>'chienDG', 'message'=>'Chien de Guerre']];
  }


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
  public function presentationOneTroupe ($idTroupe, $idUser) {
    // Initialisation
    $message = NULL;
    $move = NULL;
    $data = $this->readOneTroupe($idTroupe, $idUser);
    if($data[0]['cheval'] == 1) {
      $message = 'Cavalier';
      switch ($data[0]['classe']) {
        case  0:
        $move = 14;
        break;
        case 1:
        $move = 14;
        break;
        case 2:
        $move = 14;
        break;
        case 3:
        $move = 12;
        break;
      }
    } else {
      switch ($data[0]['classe']) {
        case  0:
        $move = 8;
        break;
        case 1:
        $move = 7;
        break;
        case 2:
        $move = 7;
        break;
        case 3:
        $move = 6;
        break;
      }
    }
    echo '<ul>
            <li class="formLi">'.$data[0]['nomFaction'].'</li>
            <li class="formLi">'.$data[0]['nomTroupe'].'</li>
            <li class="formLi">'.$message.' '.$this->typeTroupe[$data[0]['typeTroupe']].'</li>
            <li class="formLi">Mouvement : '.$move.' "</li>';
    echo '<h3>Equipements</h3>';
    echo '<li class="formLi"> Classe d\'armure : ';
    switch ($data[0]['classe']) {
        case 0:
          echo 'SP';
        break;
        case 1:
          echo 'PP';
        break;
        case 2:
          echo 'PP';
        break;
        case 3:
          echo 'PC';
        break;
    }
    echo'</li>';
    echo '<li class="formLi"><h4>Armes de mêlée</h4></li>';
    for ($i=0; $i <count($this->weapon) ; $i++) {
      if($data[0][$this->weapon[$i]['id']] != NULL) {
        echo '<li class="formLi">'.$this->weapon[$i]['message'].'</li>';
      }
    }
    echo '<li class="formLi"><h4>Armes de tir</h4></li>';
    for ($i=0; $i <count($this->weaponShoot) ; $i++) {
      if($data[0][$this->weaponShoot[$i]['id']] != NULL) {
        echo '<li class="formLi">'.$this->weaponShoot[$i]['message'].' Portée : '.$this->weaponShoot[$i]['range'].' "</li>';
      }
    }
      echo '<li class="formLi"><h4>Equipements</h4></li>';
      for ($i=0; $i <count($this->specialRules) ; $i++) {
        if($data[0][$this->specialRules[$i]['id']] != NULL) {
          echo '<li class="formLi">'.$this->specialRules[$i]['message'].'</li>';
        }
      }
      echo '<li class="formLi"><h4>Coût de l\'unité </h4></li>';
      echo '<li class="formLi">Prix : '.$data[0]['prixTroupe'].' PO</li>
            <li class="formLi">Tireur : '.yes($data[0]['tireur']).'</li>
            <li class="formLi">Cavalier : '.yes($data[0]['monture']).'</li>';
      echo '</ul>';
  }

  public function designTroupe($dataTroupe, $dataCout, $idNav) {
    function testValue ($data) {
      switch ($data) {
        case -1:
          return false;
          break;
        case 0:
          return true;
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
                  <input id="'.$dataCout[0][$value['id']].'" type="checkbox" name="'.$value['id'].'" value="1"/>
                </li>';
        } else {
          echo '<li class="formLi">Pas de données disponible</li>';
        }
      }
    }
    echo '<section class="flex-rows">';
      echo '<article>';
          echo '<h3>Création du profil de votre unité de la faction : '.$dataTroupe[0]['nomFaction'].'</h3>';
          echo '<ul>
                  <li class="formLi">'.$dataTroupe[0]['nomFaction'].'</li>
                  <li class="formLi">'.$dataTroupe[0]['nomTroupe'].'</li>
                  <li class="formLi">'.$this->typeTroupe[$dataTroupe[0]['typeTroupe']].'</li>
                  <li class="formLi">Description : '.$dataTroupe[0]['descriptionTroupe'].'</li>
                </ul>';
          if(!empty($dataCout)) {
          echo '<ul>';
          echo '<li class="formLi">Coût de base du '.$this->typeTroupe[$dataTroupe[0]['typeTroupe']].' : '.$dataCout[0]['coutBase'].' PO</li>';
          echo '<li class="formLi"><form class="formulaireClassique" action="'.encodeRoutage(39).'" method="post">';

          echo '<li class="formLi"><h4>Type de protection</h4></li>';
          echo '<li class="formLi"><fieldset class="flex-colonne">';
            $radio = [['id'=>'sp', 'value'=>'0', 'message'=>'Sans protection', 'cout'=>$dataCout[0]['SP']],
                      ['id'=>'armure', 'value'=>'1', 'message'=>'Armure', 'cout'=>$dataCout[0]['armure']],
                      ['id'=>'Bouclier', 'value'=>'2', 'message'=>'Bouclier' , 'cout'=>$dataCout[0]['bouclier']],
                      ['id'=>'CC', 'value'=>'3', 'message'=>'Armure et bouclier', 'cout'=>($dataCout[0]['armure'] + $dataCout[0]['bouclier'])]];
                      foreach ($radio as $key => $value) {
                        if(testValue ($value['cout'])) {
                          echo '<div class="flex-rows">
                                    <input id="'.$value['id'].'" type="radio" name="classe" value="'.$value['value'].'"/>
                                    <label  for="'.$value['id'].'">'.$value['message'].' Coût : '.$value['cout'].' PO</label>
                                  </div>';

                        }
                      }
          echo '</li></fieldset>';
          echo '<li class="formLi"><h4>Armes de mêlée</h4></li>';
          loop($dataCout, $this->weapon);
          echo '<li class="formLi"><h4>Armes de tir</h4></li>';
          loop($dataCout, $this->weaponShoot);
          echo '<li class="formLi"><h4>Equipements</h4></li>';
          loop($dataCout, $this->specialRules);
          echo '<input type="hidden" name="idTroupe" value="'.$dataTroupe[0]['idTroupe'].'"/>
          <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Modifier</button>
          </form></li>';
        } else {
          echo '<h3>Grille de coût indisponible</h3>';
        }
      echo '</article>';
      echo '<article>';
        echo '<h3>Profil de l\'unité</h3>';
        $this->presentationOneTroupe ($dataTroupe[0]['idTroupe'], $dataTroupe[0]['auteur']);
      echo '</article>';
    echo '</section>';
  }

}
