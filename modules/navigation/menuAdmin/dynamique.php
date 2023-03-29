<form class="formulaireClassique" action="<?php filter($_SERVER["PHP_SELF"]); ?>" method="post">
  <h3>Brassage des liens et contrôle des doublons</h3>
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
    $select = "SELECT `idNav` FROM `navigation` WHERE `valide` = 1";
    $void = array();
      $readIdNav = new RCUD($select, $void);
      $listeIdNav = $readIdNav->READ();

  foreach ($listeIdNav as $key => $value) {
    $update = "UPDATE `navigation` SET `targetRoute` = :targetRoute WHERE `idNav` = :idNav";
    $param = [['prep'=>':targetRoute', 'variable'=>IntToken(rand(10,16))], ['prep'=>':idNav', 'variable'=>$value['idNav']]];
        $updateRoute = new RCUD($update, $param);
        $updateRoute->CUD();
  }
  echo '<p>Serie de clé de routage interne modifié.</p>';
  $select = "SELECT COUNT(`targetRoute`) AS `nbr_doublon`, `targetRoute` FROM `navigation` GROUP BY `targetRoute` HAVING COUNT(`targetRoute`) > 1";
  doublon($select);
}
 ?>
