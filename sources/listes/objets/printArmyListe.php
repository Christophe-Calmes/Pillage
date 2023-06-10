<?php

class PrintArmy extends GetArmy
{
  public function __construct()
  {
    parent::__construct();
  }
  public function addArmyListe($idNav, $idUser) {
    $factions = new PrintFactions();
    $dataFactionPublic = $factions->getFactionPublic ();
    $dataFactionPrivate = $factions->factionPrivatePublic ($idUser);
    echo '<div class="objetLeft">
    <h2>Ouvrir le formulaire</h2>
    <button type="button" id="magic" class="open">Ouvrir le formulaire</button>
    </div>
    <div id="hiddenForm">';
      echo '<form class="formulaireClassique" id="magic" action="'.encodeRoutage(45).'" method="post">';
      echo '<h3>Liste</h3>';
      echo '<label for="nomListe">Nom de la liste : </label>
            <input id="nomListe" type="text" name="nomListe" placeholder="Nom de liste"/>';
              $factions->selectFaction($dataFactionPrivate, $dataFactionPublic);
      echo '<label for="descriptionListe">Description de votre nouvelle liste</label>
            <textarea name="descriptionListe" rows="8" cols="60">Description de votre nouvelle liste.</textarea>
            <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Créer la liste</button>
    </form>
    </div>';
  }
  public function displayList($data) {
    echo '<div class="colums6 headGrid">
            <div class="col1">Nom liste</div>
            <div class="col2">Faction</div>
            <div class="col3">Partager ?</div>
            <div class="col4">Chef valide ?</div>
            <div class="col5">Prix</div>
            <div class="col6">Administrer</div>
          </div>';
    foreach ($data as $key => $value) {
      if(empty($value['prixListe'])) {
        $message = "Non définis";
      } else {
        $message = $value['prixListe'].' PO';
      }

      echo ' <div class="colums6">
              <div class="col1">'.$value['nomListe'].'</div>
              <div class="col2">'.$value['nomFaction'].'</div>
              <div class="col3">'.yes($value['partager']).'</div>
              <div class="col4">'.yes($value['chefValide']).'</div>
              <div class="col5">'.$message.'</div>
              <div class="col6"> <a class="item" href='.findTargetRoute(122).'&idListe='.$value['idListe'].'>Roster</a></div>
            </div> ';
    }

  //print_r($data);
  }
  public function rooster($idListe, $idUser) {
    // Information sur la liste
    //$dataFaction = $this->getFactionTroupe($idListe);
    //print_r($dataFaction);
    //$dataTroupe = $this->getFactionTroupe($dataFaction[0]['idFaction'], $idUser);
    //print_r($dataTroupe);
  }

  public function __destruct()
  {

  }
}
