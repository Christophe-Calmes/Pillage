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
  echo '<div class="gridSelectGrille">';
  echo '<div class="labelGrid">';
  echo '<label for="'.$champs.'">'.$name.'</label>';
  echo '</div>';
  echo '<div class="selectGrid">';
  echo '<select name="'.$champs.'">';
  echo '<option value="-1">Non applicable</option>';
  for ($i=0; $i <= 100 ; $i++) {
      echo '<option value="'.$i.'">'.$i.'</option>';
  }
  echo '</select>';
  echo '</div>';
  echo '</div>';
}

Class PrintGrilles extends GetGrilles {
  private $typeTroupe;
  private $nomColonne;
  private $champs;

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
  public function formGrille ($variable, $idNav) {
    $id = $variable[0]['idFaction'];
    $nameFaction = $variable[0]['nomFaction'];
      echo '<h3>Grille du '.$nameFaction.'</h3>';
      echo '<div class="flex-rows">';
      for ($k=0; $k <count($this->typeTroupe); $k++) {

        echo '<form class="formulaireClassique"action="'.encodeRoutage(32).'" method="post">';
        echo '<h4>'.$this->typeTroupe[$k].'</h4>';
        for ($i=0; $i <count($this->champs) ; $i++) {
          selectPO ($this->champs[$i], $this->nomTypes [$i]);
        }
        echo '<input type="hidden" name="idFaction" value="'.$id.'"/>
              <input type="hidden" name="indexType" value="'.$k.'"/>
              <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Créer</button>';
      echo '</form>';

      }
echo '</div>';
/*  echo '<h3>Paramètrage de la grille '.$variable[0]['nomFaction'].'</h3>
  <div class="grilleFactionForm">';

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


      for ($i=0; $i < count($this->typeTroupe); $i++) {
        echo '<form class="00"action="'.encodeRoutage(32).'" method="post">';
          for ($k=0; $k < count($this->champs) ; $k++) {
        echo '<div class="cout'.$i.$k.'">';
                selectPO ($this->champs[$k]);
        echo '</div>';
          }
              echo '<div class="form'.$i.'">
                  <input type="hidden" name="idFaction" value="'.$variable[0]['idFaction'].'"/>
                  <input type="hidden" name="indexType" value="'.$i.'"/>
                  <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Créer</button>
                  </form>
                  </div>';
            }

      echo '</div>';
*/
    }


}
