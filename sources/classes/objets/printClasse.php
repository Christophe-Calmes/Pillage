<?php
class PrintClasses extends Classes {
  public function ListeClasse($data, $valide, $idNav) {

    if($data != null) {

    if($valide == 1){echo '<h2>Classes valides</h2>';}
    if($valide == 0){echo '<h2>Classes non-valides</h2>';}
    echo '<div class="GridClasse">
        <div class="nomClasse"><h3>Nom</h3></div>
        <div class="abrevClasse"><h3>Abréviation</h3></div>
        <div class="deplacementClasse"><h3>Déplacement</h3></div>
        <div class="descriptionClasses">
        <h3>Description & prix</h3>
        </div>
        <div class="zoneForm"><h3>Administrer</h3></div>
    </div>';
  }
    foreach ($data as $key) {
      echo '<div class="GridClasse">
          <div class="nomClasse">'.$key['nomClasse'].'</div>
          <div class="abrevClasse">'.$key['codeClasse'].'</div>
          <div class="deplacementClasse">'.$key['deplacement'].' "</div>
          <div class="descriptionClasses">
            '.$key['descriptionClasse'].'
            <br/>
              Prix :'.$key['prixClasse'].'
          </div>';
          if($key['valide'] == 1) {
          echo'<div class="zoneForm">
            <form class="formulaireClassique" action="'.encodeRoutage(21).'" method="post">
              <input type="hidden" name="idClasse" value="'.$key['idClasse'].'"/>
              <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Non valide</button>
            </form>
          </div>';
        } else {
          echo'<div class="zoneForm">
          <form class="formulaireClassique" action="'.encodeRoutage(21).'" method="post">
              <input type="hidden" name="idClasse" value="'.$key['idClasse'].'"/>
              <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Delete</button>
            </form>
          </div>';
          }
      echo '</div>';
    }

  }
}
