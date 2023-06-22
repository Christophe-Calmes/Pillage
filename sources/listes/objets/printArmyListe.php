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
  protected function displayOneTalents($data, $idNav, $idListe, $type) {
    //print_r($data);
    $message = NULL;
    $route = NULL;
      if($type) {
        $message = "Ajouter";
        $route = 51;
      } else {
        $message = "Efface";
        $route = 52;
      }

      echo '<ul>';
        echo '<li class=formLi>'.$data['nomTalent'].'</li>';
        echo '<li class=formLi>'.$data['prixTalent'].' PO</li>';
        echo '<li class="formLi">
                <form class="formulaireClassique" action="'.encodeRoutage($route).'" method="post">
                <input type="hidden" name="idTalent" value="'.$data['idTalent'].'"/>
                <input type="hidden" name="idListe" value="'.$idListe.'"/>
                <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">'.$message.'</button>
                </form>
              </li>';
      echo '</ul>';

  }

  public function rooster($idListe, $idUser, $idNav) {
    // Trier les troupes de la faction
    $idFaction = $this->findIdFaction($idListe);
    $dataTalent = $this->extractTalent($idFaction);
    $dataTalentAffected = $this->affectedTalent($idListe);
    //$dataAffectedTalent = $this->affectedTalent($idListe);
    $troupes = new PrintTroupes();
    echo '<article>';
    $troupes->printListingTroupe($idFaction, $idUser, $idNav, $idListe);
    echo '</article>';
    echo '<article class="headGrid">';
    if(!empty($dataTalent)){
      echo '<h3>Les talents de la faction</h3>';

        for ($i=0; $i <count($dataTalent) ; $i++) {
          $this->displayOneTalents($dataTalent[$i], $idNav, $idListe, true);
        }
    } else {
        echo '<h3>Plus de talent à affecter.</h3>';
    }
    if(!empty($dataTalentAffected)){
        echo '<h3>Les talents affecté à la liste</h3>';
          for ($i=0; $i <count($dataTalentAffected) ; $i++) {
            $this->displayOneTalents($dataTalentAffected[$i], $idNav, $idListe, false);
          }
      } else {
        echo '<h3>Pas encore de talents affectés.</h3>';
      }
    echo '</article>';

  }
  protected function resumeList($idListe) {
    $message = NULL;
    $col24 = NULL;
    $col26 = NULL;

    $resultList = $this->propotionList($idListe);
    $price = $this->troopePrice ($idListe);
    if(($resultList[3]> 25) ||($resultList[4]> 25)) {
      $message = 'Non';
    } else {
      $message = 'Oui';
    }
    if(($resultList[1] !=0 )&&(($resultList [3]!=0))) {
      $col24 = $resultList[1].'/ '.$resultList[3].'%';
    } else {
      $col24 = 'Pas de tireur';
    }
    if(($resultList [2] !=0 )&&(($resultList [4]!=0))) {
      $col26 = $resultList[2].'/ '.$resultList[4].'%';
    } else {
        $col26 = 'Pas de cavalier';
    }
    //print_r($resultList);
    echo '<article>';
    echo '<h3>Composition de la liste</h3>';
    echo '<p>Prix de la liste : '.$price.' PO</p>';
      echo '<div class="colums2">
              <div class="col21">Nombre total figurines</div>
              <div class="col22">'.$resultList[0].'</div>
              <div class="col23">Nombre total de tireurs</div>
              <div class="col24">'.$col24.'</div>
              <div class="col25">Nombre total de cavalier</div>
              <div class="col26">'.$col26.'</div>
              <div class="col27">Liste légale ?</div>
              <div class="col28">'.$message.'</div>
            </div>';
    echo '</article>';
  }
  public function diplayList($idListe, $idNav) {
    echo '<section class="flex-colonne headGrid">';
    $dataTroupeListe = $this->detailListe($idListe);
    $this->resumeList($idListe);
    //print_r($dataTroupeListe);
    echo '<h3>Liste des troupes de la liste</h3>';
    for ($i=0; $i <count($dataTroupeListe) ; $i++) {
      $this->resumeTroupeFiche($dataTroupeListe[$i], $idNav);
    }
    echo '</section>';
  }

  public function __destruct()
  {

  }
}
