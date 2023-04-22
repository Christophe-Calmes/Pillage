<?php
// Adressage 108
require 'sources/grilleFaction/headGrilles.php';
//require 'sources/grilleFaction/objets/getGrilles.php';
//require 'sources/grilleFaction/objets/printGrilles.php';
//  $Grilles = new PrintGrilles();
  $idFaction = filter($_GET['idFaction']);
  $dataGrilles = $Grilles->getFactionData($idFaction);
  $Grilles->DisplayGrilleOpti($dataGrilles);
