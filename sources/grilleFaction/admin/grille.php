<?php
require 'sources/grilleFaction/headGrilles.php';
  $idFaction = filter($_GET['idFaction']);
  $dataGrilles = $Grilles->getFactionData($idFaction);
  if($dataGrilles == $idFaction) {
    echo '<h3>Pas encore de données dans les grilles</h3>';
    $Grilles->voidFormGrille($idFaction, $idNav, true) ;
  } else {
    $Grilles->formGrille($dataGrilles, $idNav, true);
  }
