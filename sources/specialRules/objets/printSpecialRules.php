<?php
class PrintSpecialRules extends SpecialRules {
  public function ListeSpecialRules ($data, $valide, $idNav) {
    // Cas où il y a des données dans $dataSpecialRules
    if($data != null) {
      if($valide == 1) {echo '<h2>Règles spéciales valides</h2>';}
      if($valide == 0) {echo '<h2>Règles spéciales non-valides</h2>';}
      // Entête du tableau des règles spéciales
      echo '<div class="GridRS">
              <div class="nomRS"><h3>Nom</h3></div>
              <div class="descriptionRS"><h3>Description</h3></div>
              <div class="prixRS"><h3>Prix</h3></div>';
              if($_SESSION['role'] == 2){echo'<div class="formRS"><h3>Administration</h3></div>';}
            echo'</div>';
            foreach ($data as $key) {
              echo '<div class="GridRS">
                      <div class="nomRS">'.$key['nomRS'].'</div>
                      <div class="descriptionRS">'.$key['descriptionRS'].'</div>
                      <div class="prixRS">'.$key['prixRS'].'</div>';
                      if($key['valide'] == 1 && $_SESSION['role'] == 2){
                        echo'<div class="formRS">
                              <form class="formulaireClassique" action="'.encodeRoutage(24).'" method="post">
                                <input type="hidden" name="idRS" value="'.$key['idRS'].'"/>
                                <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Non valide</button>
                              </form>
                             </div>';}
                        //
                        if($_SESSION['role'] == 2 && $key['valide'] == 0) {
                        $message = ['Valider' ,'Delete'];
                        echo '<div class="zoneForm">';
                        for ($i=24; $i <=25 ; $i++) {
                          echo'<form class="formulaireClassique" action="'.encodeRoutage($i).'" method="post">
                              <input type="hidden" name="idRS" value="'.$key['idRS'].'"/>
                              <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">'.$message[$i-24].'</button>
                            </form>';
                            }
                        }
                    echo'</div>';
            }


    }


  }
}
