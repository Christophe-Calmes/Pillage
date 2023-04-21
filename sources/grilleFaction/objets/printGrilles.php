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
          return $cout;
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
  private $typeTroupe;
  private $nomColonne;
  private $champs;
  private $debug;

  public function __construct() {
    $this->typeTroupe = ['Guerrier', 'Chef', 'Berserker', 'Huscarl', 'Soigneur', 'Chariot'];
    $this->nomColonne = ['Coût de base', 'Sans Protection', 'Armure', 'Bouclier',
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
    $this->debug = true;
  }

  public function DisplayGrille($variable){
    echo '<div class="grilleFaction">';
  for ($i=0; $i < count($this->typeTroupe); $i++) {
    echo '<div class="'.$this->typeTroupe[$i].' headGrid">'.$this->typeTroupe[$i].'</div>';
  }



echo '<div class="zoneBlanche headGrid"></div>
      <div class="cout headGrid">'.$this->nomColonne[0].'</div>';

echo '<div class="protection headGrid">Protections</div>
      <div class="sansProtection headGrid">'.$this->nomColonne[1].'</div>
      <div class="armure headGrid">'.$this->nomColonne[2].'</div>
      <div class="bouclier headGrid">'.$this->nomColonne[3].'</div>
      <div class="armesClose headGrid">Arme de contact</div>
      <div class="armesImp headGrid">'.$this->nomColonne[4].'</div>
      <div class="Lance headGrid">'.$this->nomColonne[5].'</div>
      <div class="ArmeBase headGrid">'.$this->nomColonne[6].'</div>
      <div class="HacheD headGrid">'.$this->nomColonne[7].'</div>
      <div class="armesTir headGrid">Arme de tir</div>
      <div class="fronde headGrid">'.$this->nomColonne[8].'</div>
      <div class="javelot headGrid">'.$this->nomColonne[9].'</div>
      <div class="arc headGrid">'.$this->nomColonne[10].'</div>
      <div class="arbalete headGrid">'.$this->nomColonne[11].'</div>
      <div class="equipementSpe headGrid">Equipements spéciales</div>
      <div class="cheval headGrid">'.$this->nomColonne[12].'</div>
      <div class="banniere headGrid">'.$this->nomColonne[13].'</div>
      <div class="cor headGrid">'.$this->nomColonne[14].'</div>
      <div class="chien headGrid">'.$this->nomColonne[15].'</div>';
  foreach ($variable as $key => $value) {
    for ($i=0; $i < count($this->typeTroupe ) ; $i++) {
      if($value['indexType'] == $i) {
        echo '<div class="cout'.$value['indexType'] .'1">'.blackOrFree($value['SP']).'</div>
              <div class="cout'.$value['indexType'] .'0">'.blackOrFree($value['coutBase']).'</div>
              <div class="cout'.$value['indexType'] .'2">'.blackOrFree($value['armure']).'</div>
              <div class="cout'.$value['indexType'] .'3">'.blackOrFree($value['bouclier']).'</div>
              <div class="cout'.$value['indexType'] .'4">'.blackOrFree($value['armeImp']).'</div>
              <div class="cout'.$value['indexType'] .'5">'.blackOrFree($value['lance']).'</div>
              <div class="cout'.$value['indexType'] .'6">'.blackOrFree($value['armeDeBase']).'</div>
              <div class="cout'.$value['indexType'] .'7">'.blackOrFree($value['hacheD']).'</div>
              <div class="cout'.$value['indexType'] .'8">'.blackOrFree($value['fronde']).'</div>
              <div class="cout'.$value['indexType'] .'9">'.blackOrFree($value['javelot']).'</div>
              <div class="cout'.$value['indexType'] .'10">'.blackOrFree($value['arc']).'</div>
              <div class="cout'.$value['indexType'] .'11">'.blackOrFree($value['arbalete']).'</div>
              <div class="cout'.$value['indexType'] .'12">'.blackOrFree($value['cheval']).'</div>
              <div class="cout'.$value['indexType'] .'13">'.blackOrFree($value['banniere']).'</div>
              <div class="cout'.$value['indexType'] .'14">'.blackOrFree($value['corDG']).'</div>
              <div class="cout'.$value['indexType'] .'15">'.blackOrFree($value['chienDG']).'</div>';
      }
    }
  }
echo '</div>';
  }

  public function voidFormGrille($idFaction, $idNav) {
    // Permet d'afficher un formulaire de grilles quand aucune données n'est encore enregistré.
    // Etape 1 : Recherche du nom de la faction
    $nameFaction = '';
    $param = [['prep'=>':idFaction', 'variable'=>$idFaction]];
    $select = "SELECT`nomFaction` FROM `Factions` WHERE `idFaction` = :idFaction AND `valide` = 1";
    $readDB = new RCUD($select, $param);
    $dataFaction = $readDB->READ();
    if($dataFaction != []) {
      $nameFaction = $dataFaction[0]['nomFaction'];
        // Génération de la grilles vierge
        echo '<h3>Grille du '.$nameFaction.'</h3>';
        echo '<div class="flex-rows">';
        for ($i=0; $i < count($this->typeTroupe) ; $i++) {
          //Visualisation des éléments pas encore définis
            echo '<form class="formulaireClassique"action="'.encodeRoutage(32).'" method="post">';
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

    public function formGrille ($variable, $idNav) {
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
        array_shift($arrayIndex);
      }
      // Affichage des élément déjà créer
      echo '<h3>Grille du '.$nameFaction.'</h3>';
      echo '<div class="flex-rows">';
      for ($l=0; $l <count($arrayIndexOk) ; $l++) {
        foreach ($variable as $key => $value) {
          if($value['indexType'] == $arrayIndexOk[$l]) {
            echo '<form class="formulaireClassique"action="'.encodeRoutage(33).'" method="post">';
            echo '<h4>Modifier '.$this->typeTroupe[$l].'</h4>';
            for ($i=0; $i <count($this->champs) ; $i++) {
              selectPOSelected ($this->champs[$i], $this->nomTypes [$i], $value[$this->champs[$i]]);
            }
            echo '<input type="hidden" name="idFaction" value="'.$value['idFaction'].'"/>
                  <input type="hidden" name="indexType" value="'.$value['indexType'].'"/>
                  <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Modifier</button>';
          echo '</form>';
          }
        }
      }
      // Intialisation boucle
        for ($i=count($arrayIndexOk); $i < count($this->typeTroupe) ; $i++) {
          //Visualisation des éléments pas encore définis
            echo '<form class="formulaireClassique"action="'.encodeRoutage(32).'" method="post">';
            echo '<h4>'.$this->typeTroupe[$i].'</h4>';
            for ($o=0; $o <count($this->champs) ; $o++) {
              selectPO ($this->champs[$o], $this->nomTypes [$o]);
            }
            echo '<input type="hidden" name="idFaction" value="'.$id.'"/>
                  <input type="hidden" name="indexType" value="'.$i.'"/>
                  <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Créer</button>';
                  echo '</form>';
        }
      echo '</div>';
      echo '</div>';
    }

}
