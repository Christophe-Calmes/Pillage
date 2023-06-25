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
function classArmor ($data) {
  $class = '';
  switch ($data) {
      case 0:
        $class = 'SP';
      break;
      case 1:
        $class = 'PP';
      break;
      case 2:
        $class = 'PP';
      break;
      case 3:
        $class = 'PC';
      break;
  }
  return $class;
}
function mouvementUnit($cavalier, $classe) {
  $move = 0;
  if($cavalier == 1) {
    $message = 'Cavalier';
    switch ($classe) {
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
    switch ($classe) {
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
  return $move;
}


Class PrintTroupes extends GetTroupes {
  protected $weapon;
  protected $weaponShoot;
  protected $specialRules;
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
    echo '<section class="flex-rows">';
    echo '<article class="designTroupe">';
    echo '<h3>Profil de l\'unité</h3>';
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
      echo '</article>';
      echo '</section>';
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
        return $data.' PO';
      }
    }
    function loop ($dataCout, $array, $check, $rich) {
      foreach ($array as $key => $value) {
        if(testValue ($dataCout[0][$value['id']])) {
          $rand = rand(0, 1000);

          if($check){
          echo '<li class="formCheck">
                  <p class="pLabel">'.$value['message'].' coût : '.freeStuff($dataCout[0][$value['id']]).'</p>

                  <input type="checkbox" class="checkbox"  id="switch'.$rand.'"  name="'.$value['id'].'" value="1"/>
                  <label for="switch'.$rand.'" class="toggle">
                    <p class="checkedText">'.$value['message'].' - '.freeStuff($dataCout[0][$value['id']]).'</p>
                  </label>
                </li>';
              } else {

                echo '<li class="formCheck">
                        <p class="pLabel">'.$value['message'].' coût : '.freeStuff($dataCout[0][$value['id']]).'</p>
                        <input type="radio" class="checkbox"  id="switch'.$rand.'"  name="radioChoose'.$rich.'" value="'.$value['id'].'"/>
                        <label for="switch'.$rand.'" class="toggle">
                          <p class="checkedText">'.$value['message'].' - '.freeStuff($dataCout[0][$value['id']]).'</p>
                        </label>
                    </li>';

              }
        } else {
          //echo '<li class="formLi">Pas de données disponible</li>';
        }
      }
    }
    echo '<section class="flex-rows">';
      echo '<article class="designTroupe">';
          echo '<h3>Création du profil de la faction '.$dataTroupe[0]['nomFaction'].'</h3>';
          echo '<ul class="presentationTroupe">
                  <li class="formLi">Nom troupe : '.$dataTroupe[0]['nomTroupe'].'</li>
                  <li class="formLi">Type : '.$this->typeTroupe[$dataTroupe[0]['typeTroupe']].'</li>
                  <li class="flex-colonne">
                    <div><h4>Description</h4></div>
                    <div>'.$dataTroupe[0]['descriptionTroupe'].'</div>
                  </li>';
          if(!empty($dataCout)) {

          echo '<li class="formLi">Coût de base du '.$this->typeTroupe[$dataTroupe[0]['typeTroupe']].' : '.$dataCout[0]['coutBase'].' PO</li>';
          echo '</ul>';
          echo '<ul class="flex-rows">';
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
                                    <label class="labelRadio"  for="'.$value['id'].'">'.$value['message'].' Coût : '.$value['cout'].' PO</label>
                                  </div>';

                        }
                      }
          echo '</li></fieldset>';
          echo '</ul>';
          echo '<ul class="flex-rows">';
          echo '<div class="box">';
          echo '<li class="formLi"><h4 class="hForm">Armes de mêlée</h4></li>';
          if($dataTroupe[0]['typeTroupe'] == 3) {
            $choice = true;
          } else {
            $choice = false;
          }
          loop($dataCout, $this->weapon, $choice, 'CC');
          echo '</div>';
          echo '<div class="box">';
          echo '<li class="formLi"><h4 class="hForm">Armes de tir</h4></li>';
          loop($dataCout, $this->weaponShoot, false, 'CT');
          echo '</div>';
          echo '<div class="box">';
          echo '<li class="formLi"><h4 class="hForm">Equipements</h4></li>';
          loop($dataCout, $this->specialRules, true, '');
          echo '</div></li></ul>';
          echo '<input type="hidden" name="idTroupe" value="'.$dataTroupe[0]['idTroupe'].'"/>
          <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Modifier</button>
          </form>';
        } else {
          echo '<ul>';
          echo '<h3>Grille de coût indisponible</h3>';
        }
      echo '</article>';

        $this->presentationOneTroupe ($dataTroupe[0]['idTroupe'], $dataTroupe[0]['auteur']);

  }
  public function addFormTroupe ($idUser, $idNav) {
    $Grilles = new PrintGrilles();
    $factions = new PrintFactions();
    $dataFactionsPublic = $factions->getFactionPublic();
    $dataFactionUser = $factions->getAdminFactionsUser(1, 1, $idUser);
    echo '<div class="objetLeft">
          <h2>Ajouter une troupe</h2>
            <button type="button" id="magic" class="open">Ouvrir le formulaire</button>
        </div>
        <div id="hiddenForm">';
          echo '<form class="formulaireClassique" action="'.encodeRoutage(36).'" method="post">';
          echo '<label for="nomTroupe">Nom de votre unité</label>';
          echo '<input type="text" id="nomTroupe" name="nomTroupe" placeholder="nom de votre unité" />';
                $Grilles->selectType();
                $factions->selectFaction($dataFactionUser, $dataFactionsPublic);
          echo '<label for="descriptionTroupe">Description de votre nouvelle unitée :</label>';
          echo '<textarea id="descriptionTroupe" name="descriptionTroupe" rows="10" cols="55" placeholder="Votre description." required></textarea>';
          echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Créer</button>
          </form>';
        echo '</div>';
      include 'javaScript/magicButton.php';
  }
  public function troupeCardRooster($data, $idNav, $idListe) {
    echo '<div class="troope">
      <div class="information headGrid">
        <div class="nom">'.$data['nomTroupe'].'</div>
        <div class="type">'.$this->typeTroupe[$data['typeTroupe']].'</div>
        <div class="Armure">Classe d\'armure : '.classArmor ($data['classe']).'</div>
        <div class="move">Mouvement : '.mouvementUnit($data['monture'], $data['classe']) .' pouces</div>
        <div class="price">Prix troupe : '.$data['prixTroupe'].' PO</div>
      </div>
      <div class="weapons headGrid">';
      // Création des listes d'armes
      echo '<li class="formLi"><h3>Arme de contact</h3></li>';
        for ($i=0; $i <count($this->weapon) ; $i++) {
          if($data[$this->weapon[$i]['id']] != NULL) {
            echo '<li class="formLi">'.$this->weapon[$i]['message'].'</li>';
          }
          echo'</li>';
        }
      if($data['tireur'] == 1) {
          echo '<li class="formLi"><h3>Arme de tir</h3></li>';
          for ($i=0; $i <count($this->weaponShoot) ; $i++) {
            if($data[$this->weaponShoot[$i]['id']] != NULL) {
              echo '<li class="formLi">'.$this->weaponShoot[$i]['message'].' Portée : '.$this->weaponShoot[$i]['range'].' pouces</li>';
            }
          }

      }
      if (($data['chienDG'] == 1)||($data['corDG'] == 1)) {
          echo '<li class="formLi"><h4>Equipements supplémentaires</h4></li>';
          echo '<li class="formLi">Chien de Guerre : '.yes($data['chienDG']).'</li>';
          echo '<li class="formLi">Core de Guerre : '.yes($data['corDG']).'</li>';
      }


      echo'</div>
            <div class="addTroop headGrid">';
            echo '<li class="formLiCol">
                  <h4>Ajouter dans la liste</h4>
                      <form action="'.encodeRoutage(48).'" method="post">
                          <label for="nombreTroupe">Nombre de troupe</label>
                          <select id="nombreTroupe" name="nombreTroupe">
                            <option value="1">1 figurine</option>';
                            for ($k=2; $k <= 12 ; $k++) {
                              echo '<option value="'.$k.'">'.$k.' figurines</option>';
                            }
                            echo'</select>
                          <input type="hidden" name="idTroupe" value="'.$data['idTroupe'].'"/>
                          <input type="hidden" name="idListe" value="'.$idListe.'"/>
                        <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Ajouter</button>
                      </form>
                  </li>';
      echo'</div>
    </div>';

  }


  public function printListingTroupe($idFaction, $idUser, $idNav, $idListe) {
    $dataListing = $this->listingTroupes($idFaction, $idUser);

    if (empty($dataListing)) {
      $this->noFindTroop();
    } else {
        for ($i=0; $i <count($dataListing) ; $i++) {
          $this->troupeCardRooster($dataListing[$i], $idNav, $idListe);
        }
    }
  }
  public function resumeTroupeFiche($data, $idNav) {
    $unite = "unité";
    if($data['nombreTroupe'] > 1) {
      $unit = "unités";
    }
    echo '<div class="resumeList headGrid">
      <div class="info">
        <div class="Nom">';
          echo '<li class="formLi">Nom : '.$data['nomTroupe'].'</li>';
          echo '<li class="formLi">Type : '.$this->typeTroupe[$data['typeTroupe']].'</li>';
          echo '<li class="formLi">Tireur : '.yes($data['tireur']).'</li>';
          echo '<li class="formLi">Cavalier : '.yes($data['monture']).'</li>';
        echo'</div>
        <div class="Nombre">Nombre : '.$data['nombreTroupe'].' '.$unite.' </div>
          <div class="prices">';
          echo '<li class="formLi">Prix unitaire  :'.$data['prixTroupe'].' PO</li>';
          echo '<li class="formLi">Prix total  :'.$data['prixTroupe'] * $data['nombreTroupe'].' PO</li>';
        echo'</div>
      </div>
      <div class="form1">


          <form action="'.encodeRoutage(49).'" method="post">
            <label for="nombreTroupe">Nombre de troupe</label>
            <select id="nombreTroupe" name="nombreTroupe">';
            for ($k=1; $k <= 12 ; $k++) {
              if($data['nombreTroupe'] == $k) {
                echo '<option value="'.$k.'" selected>'.$k.' figurine(s)</option>';
              }
              echo '<option value="'.$k.'">'.$k.' figurine(s)</option>';
            }
            echo'</select>
            <input type="hidden" name="idCL" value="'.$data['idCL'].'"/>
            <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Modifier nombre '.$data['nomTroupe'].'</button>


        </form>

        </div>
        <div class="form2">
        <form action="'.encodeRoutage(50).'" method="post">
          <input type="hidden" name="idCL" value="'.$data['idCL'].'"/>
          <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Effacer '.$data['nomTroupe'].'</button>
        </form>
        </div>

    </div>';


  }
  protected function PrintingOneTroupeListe($data) {
    echo '<br/>';
    print_r($data);

  }


  public function noFindTroop() {
    echo '<p>Nous ne trouvons pas votre troupe.</p>';
  }

}
