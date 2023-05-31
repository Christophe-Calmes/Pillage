<?php
// Instance
require 'sources/factions/objets/getFactions.php';

function yes ($data) {
  if($data == 1 ) {
    return 'Oui';
  } else {
    return 'Non';
  }
}

class PrintTalent extends GetTalent {
  public function formTalent($idNav, $route) {
    echo '<div class="objetLeft">
            <h2>Ajouter une règle spéciale</h2>
            <button type="button" id="magic" class="open">Ouvrir le formulaire</button>
          </div>';
    echo '<div id="hiddenForm">
    <form class="formulaireClassique"action="'.encodeRoutage($route).'" method="post">';
    echo '<label for="nomTalent">Nom du talent</label>';
    echo '<input type="text" name="nomTalent" id="nomTalent" placehoder="Nom du talent"/>';
    echo '<label for="descriptionTalent">Description du talent</label>';
    echo '<textarea name="descriptionTalent" rows="8" cols="70">Description de votre nouveau talent.</textarea>';
    echo '<label for="prixTalent">Prix du talent</label>';
    echo '<select name="prixTalent" id="priceTalent">';
    for ($i=0; $i <= 100 ; $i = $i + 10) {
      echo '<option value="'.$i.'">'.$i.' PO</option>';
    }
    echo '</select>';
    echo '<label for="talentDeTroupe">Talent de troupe ?</label>
          <select name="talentDeTroupe" id="talentDeTroupe">
            <option value="0">Non</option>
            <option value="1">Oui</option>
          </select>';
    echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Créer</button>';
    echo '</form>
          </div>';
  }
  public function adminTalent($valide, $idNav) {
    if($valide == 1) {
      $message = "Talent valide";
      $button = "Unvalide";
    } else {
      $message = "Talent non valide";
      $button = "Valide";
    }
    // Recupération des données
    $data = $this->getAllTalent($valide);
    // Display data
    if(!empty($data)) {
    echo '<h3>'.$message.'</h3>';
    echo '<div class="GridClasse headGrid">
              <div class="nomClasse"><h3>Talent</h3></div>
              <div class="deplacementClasse"><h3>Déplacement</h3></div>
              <div class="abrevClasse"><h3>Talent de troupe</h3></div>
              <div class="descriptionClasse centerClasse"><h3>Prix</h3></div>';
        if($_SESSION['role'] == 2){
          echo'<div class="zoneForm"><h3>Administrer</h3></div>';
        }
        echo '</div>';

        foreach ($data as $key => $value) {
          echo '<div class="GridClasse">
              <div class="nomClasse">'.$value['nomTalent'].'</div>
              <div class="deplacementClasse">'.$value['descriptionTalent'].'</div>
              <div class="abrevClasse">'.yes($value['talentDeTroupe']).'</div>
              <div class="descriptionClasse centerClasse">'.$value['prixTalent'].' PO</div>';
              if($_SESSION['role'] == 2){
                echo'<div class="zoneForm">
                <form class="formulaireClassique" action="'.encodeRoutage(41).'" method="post">
                  <input type="hidden" name="idTalent" value="'.$value['idTalent'].'"/>
                  <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">'.$button.'</button>
                </form>';
                // Fait apparaitre l'option pour les talents valide uniquement.
                if($value['valide'] == 1) { echo '<a class="item" href='.findTargetRoute(119).'&idTalent='.$value['idTalent'].'>'.$value['nomTalent'].'</a>';}
                if($value['valide'] == 0) {
                echo '<form class="formulaireClassique" action="'.encodeRoutage(42).'" method="post">
                        <input type="hidden" name="idTalent" value="'.$value['idTalent'].'"/>
                        <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Effacer</button>
                      </form>';
              }
                echo'</div>';

              }
                echo '</div>';
              }
        }
      }
  public function displayOneTalent ($idTalent) {
    $data = $this->getOneTalent($idTalent);
      if(!empty($data)) {
        $factions = new GetFactions();
        $datasFactions = $factions->getLinkTalentFaction ($idTalent);
        // Présentation d'un talent
    echo '<section class="navigationBandeau">
          <div class="talent">
              <div class="nomTalent"><h3>'.$data[0]['nomTalent'].'</h3></div>
              <div class="descriptionTalent">
                '.$data[0]['descriptionTalent'].'
                <br/>
                Talent de troupe : '.yes($data[0]['talentDeTroupe']).'
              </div>
              <div>Prix : '.$data[0]['prixTalent'].' PO</div>
              <div>';
              if(!empty($datasFactions)){
                echo'<ul>
                  <li class="formLi"><h3>Ce talent est disponible pour :</h3></li>';
                  foreach ($datasFactions as $key => $value) {
                      echo'<li class="formLi">'.$value['nomFaction'].'</li>';
                  }
                echo '</ul>';
              } else {
                echo '<p>Pas de données disponible</p>';
              }
            echo '</div>
          </div>
          </section>';
    } else {
      header('location:../index.php?message=Soucis avec les talents sélectionné.');
    }
  }

  public function affecterTalentFaction($idTalent, $idNav) {
    echo '<div class="flex-rows">';

    $factions = new GetFactions();
    $dataFactions = $factions->getFactionPublic();
    echo '<form class="formulaireClassique designTroupe" action="'.encodeRoutage(43).'" method="post">';
    echo '<h3>Affecter les factions valides pour ce talent</h3>';
      foreach ($dataFactions as $key => $value) {
        echo '<li class="formCheck">
              <p>'.$value['nomFaction'].'</p>
                <input type="checkbox" class="checkbox"  id="'.$value['nomFaction'].'"  name="'.$value['nomFaction'].'" value="1"/>
                <label for="'.$value['nomFaction'].'" class="toggle">
                  <p class="checkedText">Affecté à '.$value['nomFaction'].'</p>
                </label>
              </li>';
      }
      echo '<input type="hidden" name="idTalent" value="'.$idTalent.'"/>';
      echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Affecter</button>';
    echo '</form>';
    $this->displayOneTalent ($idTalent);
    echo'</div>';
  }
  public function displayTalentUser ($first, $parPage){
    $data = $this->paginationTalent($first, $parPage);
    echo '<div class="GridClasse headGrid">
              <div class="nomClasse"><h3>Talent</h3></div>
              <div class="deplacementClasse"><h3>Déplacement</h3></div>
              <div class="abrevClasse"><h3>Talent de troupe</h3></div>
              <div class="descriptionClasse centerClasse"><h3>Prix</h3></div>
            </div>';
    foreach ($data as $key => $value) {
      echo '<div class="GridClasse">
                <div class="nomClasse"><h4>'.$value['nomTalent'].'</h4></div>
                <div class="deplacementClasse">'.$value['descriptionTalent'].'</div>
                <div class="abrevClasse">'.yes($value['talentDeTroupe']).'</div>
                <div class="descriptionClasse centerClasse">'.$value['prixTalent'].' PO</div>
              </div>';
    }
  }
}
