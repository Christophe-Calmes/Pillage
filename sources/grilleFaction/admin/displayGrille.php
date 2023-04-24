<?php
// Adressage 108
require 'sources/grilleFaction/headGrilles.php';
  $idFaction = filter($_GET['idFaction']);
  $dataGrilles = $Grilles->getFactionData($idFaction);
  $Grilles->DisplayGrilleOpti($dataGrilles);
