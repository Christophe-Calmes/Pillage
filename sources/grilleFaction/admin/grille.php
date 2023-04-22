<?php
require 'sources/grilleFaction/headGrilles.php';
//require 'sources/grilleFaction/objets/getGrilles.php';
//require 'sources/grilleFaction/objets/printGrilles.php';
  $idFaction = filter($_GET['idFaction']);
  //$Grilles = new PrintGrilles();
  $dataGrilles = $Grilles->getFactionData($idFaction);
  if($dataGrilles == $idFaction) {
    echo '<h3>Pas encore de données dans les grilles</h3>';
    $Grilles->voidFormGrille($idFaction, $idNav) ;
  } else {
    $Grilles->formGrille ($dataGrilles, $idNav);
  }
