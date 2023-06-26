<?php

function blackOrFree ($cout) {
  switch ($cout) {
    case 0:
        return 'Gratuit';
        break;
      case $cout < 0:
          return 'Non applicable';
          break;
      default:
          return $cout.' PO';
  }
}
function selectPO ($champs, $name) {
  echo '<div class="flex-rows alignLeft">';
  //echo '<div >';
  echo '<label class="alignRigth" for="'.$champs.'">'.$name.'</label>';
//  echo '</div>';
  //echo '<div class="selectGrid">';
  echo '<select name="'.$champs.'">';
  echo '<option value="-1">Non applicable</option>';
  echo '<option value="0">Gratuit</option>';
  for ($i=1; $i <= 100 ; $i++) {
      echo '<option value="'.$i.'">'.$i.'</option>';
  }
  echo '</select>';
  echo '</div>';
//  echo '</div>';
}
function selectPOSelected ($champs, $name, $value) {
  echo '<div class="flex-rows alignLeft">';
  //echo '<div >';
  echo '<label class="alignRigth" for="'.$champs.'">'.$name.'</label>';
//  echo '</div>';
  //echo '<div class="selectGrid">';
  echo '<select name="'.$champs.'">';
  if ($value == -1) {
    echo '<option value="-1" selected>Non applicable</option>';
  } else {
    echo '<option value="-1">Non applicable</option>';
  }
  if ($value == 0) {
    echo '<option value="0" selected>Gratuit</option>';
  } else {
    echo '<option value="0">Gratuit</option>';
  }
  for ($i=1; $i <= 100 ; $i++) {
      if($value == $i) {
        echo '<option value="'.$i.'" selected>'.$i.'</option>';
      } else {
        echo '<option value="'.$i.'">'.$i.'</option>';
      }
  }
  echo '</select>';
  echo '</div>';
//  echo '</div>';
}

Class PrintGrilles extends GetGrilles {
  protected $typeTroupe;
  public $nomColonne;
  public $champs;
  private $classCSSFirstCol;
  private $nomColonneDisplayGrilles;
  private $debug;

  public function __construct() {
    $this->typeTroupe = ['Guerrier', 'Chef', 'Berserker', 'Huscarl', 'Soigneur', 'Chariot'];
    $this->nomColonne = ['Coût de base', 'Sans Protection', 'Armure', 'Bouclier',
    'Arme improvisé', 'Lance', 'Arme standard', 'Hache danoise', 'Arme de tir',
    'Fronde', 'Javelot', 'Arc', 'Arbalète','Equipement spéciaux',
    'Cheval', 'Bannière', 'Cor de guerre', 'Chiens de guerre'];
    $this->nomColonneDisplayGrilles = ['','Coût de base', 'Protections','Sans Protection', 'Armure', 'Bouclier', 'Arme de contact',
    'Arme improvisé', 'Lance', 'Arme standard', 'Hache danoise', 'Arme de tir',
    'Fronde', 'Javelot', 'Arc', 'Arbalète','Equipement spéciaux',
    'Cheval', 'Bannière', 'Cor de guerre', 'Chiens de guerre'];

    $this->nomTypes = ['Coût de base', 'Sans Protection', 'Armure', 'Bouclier',
    'Arme improvisé', 'Lance', 'Arme standard', 'Hache danoise',
    'Fronde', 'Javelot', 'Arc', 'Arbalète', 'Cheval', 'Bannière',
    'Cor de guerre', 'Chiens de guerre'];
    $this->champs = ['coutBase', 'SP', 'armure', 'bouclier', 'armeImp',
    'lance', 'armeDeBase', 'hacheD', 'fronde', 'javelot', 'arc',
    'arbalete', 'cheval', 'banniere', 'corDG', 'chienDG'];
    $this->classCSSFirstCol = ['zoneBlanche','cout', 'protection', 'sansProtection', 'armure', 'bouclier', 'armesClose',
    'armesImp', 'Lance', 'ArmeBase', 'HacheD', 'armesTir', 'fronde', 'javelot', 'arc', 'arbalete',
    'equipementSpe', 'cheval', 'banniere', 'cor', 'chien'];
    $this->debug = true;
  }
  public function DisplayGrilleOpti($variable) {
    echo '<h3>Faction '.$variable[0]['nomFaction'].'</h3>';
      echo '<div class="grilleFaction">';
      for ($i=0; $i < count($this->typeTroupe); $i++) {
        echo '<div class="'.$this->typeTroupe[$i].' headGrid">'.$this->typeTroupe[$i].'</div>';
      }
      for ($i=0; $i < count($this->nomColonneDisplayGrilles) ; $i++) {
        echo '<div class="'.$this->classCSSFirstCol[$i].' headGrid">'.$this->nomColonneDisplayGrilles[$i].'</div>';

      }
      foreach ($variable as $key => $value) {
        for ($i=0; $i < count($this->typeTroupe ) ; $i++) {
          if($value['indexType'] == $i) {
              for ($index=0; $index <count($this->champs) ; $index++) {
                  echo '<div class="cout'.$value['indexType'].$index.'">'.blackOrFree($value[$this->champs[$index]]).'</div>';
              }
          }
        }
      }
      echo '</div>';
  }

  public function voidFormGrille($idFaction, $idNav, $admin) {
    if($admin) {
      $route = 32;
    } else {
      $route = 34;
    }
    // Permet d'afficher un formulaire de grilles quand aucune données n'est encore enregistré.
    // Etape 1 : Recherche du nom de la faction
    $nameFaction = '';
    $param = [['prep'=>':idFaction', 'variable'=>$idFaction]];
    $select = "SELECT`nomFaction` FROM `Factions` WHERE `idFaction` = :idFaction AND `valide` = 1";
    $readDB = new RCUD($select, $param);
    $dataFaction = $readDB->READ();
    //
    if($dataFaction != []) {
      $nameFaction = $dataFaction[0]['nomFaction'];
        // Génération de la grilles vierge
        echo '<h3>Grille '.$nameFaction.'</h3>';
        echo '<div class="flex-rows headGrid">';
        for ($i=0; $i < count($this->typeTroupe) ; $i++) {
          //Visualisation des éléments pas encore définis
            echo '<form class="formulaireClassique headGrid" action="'.encodeRoutage($route).'" method="post">';
            echo '<h4>'.$this->typeTroupe[$i].'</h4>';
            for ($o=0; $o <count($this->champs) ; $o++) {
              selectPO ($this->champs[$o], $this->nomTypes [$o]);
            }
            echo '<input type="hidden" name="idFaction" value="'.$idFaction.'"/>
                  <input type="hidden" name="indexType" value="'.$i.'"/>
                  <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Créer</button>';
                  echo '</form>';
        }

        echo '</div>';
    } else {
      // Sécurité parce que tentative de hacking
      require 'modules/securiter/deconnexion.php';
    }
  }

    public function formGrille ($variable, $idNav, $admin) {
      if($admin) {
        $route = 33;
        $updateRoute = 32;
      } else {
        $updateRoute = 34;
        $route = 35;
      }


      $nameFaction = $variable[0]['nomFaction'];
      $id = $variable[0]['idFaction'];
      $arrayIndexOk = [];
      // Création d'un tableau d'index

      $arrayIndex = [];
      // Création du tableau d'index type troupe vierge
      for ($i=0; $i < count($this->typeTroupe) ; $i++) {
        array_push($arrayIndex, $i);
      }
      foreach ($variable as $key => $value) {
        array_push($arrayIndexOk, $value['indexType']);
      }
      // Affichage des élément déjà créer
      echo '<h3>Grille '.$nameFaction.'</h3>';
      echo '<div class="flex-rows headGrid">';
      $voidCout = array_diff($arrayIndex, $arrayIndexOk);
      foreach ($variable as $key => $value) {

        if(!empty($this->typeTroupe[$value['indexType']])) {
          // Table pleine
          echo '<form class="formulaireClassique headGrid" action="'.encodeRoutage($route).'" method="post">';
          echo '<h4>Modifier '.$this->typeTroupe[$value['indexType']].'</h4>';
          for ($i=0; $i <count($this->champs) ; $i++) {
            selectPOSelected ($this->champs[$i], $this->nomTypes [$i], $value[$this->champs[$i]]);
          }
          echo '<input type="hidden" name="idFaction" value="'.$value['idFaction'].'"/>
                <input type="hidden" name="indexType" value="'.$value['indexType'].'"/>

                <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Modifier</button>';
        echo '</form>';
        }


      }
      if(!empty($voidCout)) {
        foreach ($voidCout as $k => $v) {
          //Visualisation des éléments pas encore définis
            echo '<form class="formulaireClassique"action="'.encodeRoutage($updateRoute).'" method="post">';
            echo '<h4>'.$this->typeTroupe[$v].'</h4>';
            for ($o=0; $o <count($this->champs) ; $o++) {
              selectPO ($this->champs[$o], $this->nomTypes [$o]);
            }
            echo '<input type="hidden" name="idFaction" value="'.$variable[0]['idFaction'].'"/>
                  <input type="hidden" name="indexType" value="'.$v.'"/>
                  <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Créer</button>';
                  echo '</form>';
        }
      }
      echo '</div>';
      echo '</div>';
    }
    public function selectType() {
      echo '<label for="typeTroupe">Type de troupe</label>';
      echo '<select name="typeTroupe">';
      for ($i=0; $i <count($this->typeTroupe) ; $i++) {
        echo '<option value="'.$i.'">'.$this->typeTroupe[$i].'</option>';
      }
      echo '</select>';
    }
    public function setChamps() {
      return $this->champs;
    }

}
