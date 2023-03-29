<?php
  include 'arrayInterne/roles.php';
  $dataRouteForm = new  PrintNavigation();
?>
<h3>Ajouter une route pour un formulaire</h3>
<?php if($dev) { ?>
<form class="formulaireClassique" action="<?=encodeRoutage(7)?>" method="post">
  <label for="chemin">Le chemin du traitement du formulaire</label>
  <input id="chemin" type="text" name="chemin" required>
  <label for="securiter">Niveau d'administration du formulaire</label>
  <select id="securiter"  name="securiter">
    <?php for ($i=0; $i < count($internaute) ; $i++) {  echo '<option value="'.$i.'">'.$internaute[$i].'</option>'; } ?>
  </select>
  <button class="buttonForm" type="submit" name="idNav" value="<?=$idNav?>">Ajouter</button>
</form>
<?php $dataTraiter = $dataRouteForm->toutesRoutesForm();
      $dataRouteForm->listeRouteForm($dataTraiter, $internaute);
 ?>
<?php } else { echo "Menu indisponible en production";} ?>

<form class="formulaireClassique" action="<?php filter($_SERVER["PHP_SELF"]); ?>" method="post">
  <h3>Brassage routes des formulaires</h3>
<button type="submit" name="button">Changer les serrures</button>
</form>
<?php
function doublon ($select) {
  $void = [];
  $controle = new RCUD($select, $void);
  $doublon = $controle->READ();
  if(!empty($doublon)) {
    echo '<p>Doublon détecté dans le clés. Changer le trousseau.</p>';
    echo '<ul>';
    foreach ($doublon as $key => $value) {
      echo '<li>nombre de doublon :'.$value['nbr_doublon'].' Doublon pointé :'.$value['routageToken'].'</li>';
    }
    echo'</ul>';
  } else {
    echo '<p>Série de clés sans doublon.</p>';
  }
}
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    require 'functions/functionToken.php';
    $select = "SELECT `idForm`, `route` FROM `routageForm` WHERE `valide` = 1";
    $void = array();
      $readIdNav = new RCUD($select, $void);
      $listeIdNav = $readIdNav->READ();

  foreach ($listeIdNav as $key => $value) {
    $update = "UPDATE `routageForm` SET `route`= :route WHERE `idForm` = :idForm";
    $param = [['prep'=>':route', 'variable'=>IntToken(rand(18,20))], ['prep'=>':idForm', 'variable'=>$value['idForm']]];
        $updateRoute = new RCUD($update, $param);
        $updateRoute->CUD();
  }
  echo '<p>Serie de clé de routage interne modifié.</p>';
  $select = "SELECT COUNT(`targetRoute`) AS `nbr_doublon`, `targetRoute` FROM `navigation` GROUP BY `targetRoute` HAVING COUNT(`targetRoute`) > 1";
  doublon($select);
}
 ?>
