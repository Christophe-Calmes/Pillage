<?php
// Id 111
// Permet de voir les factions officielles.
require 'sources/grilleFaction/headGrilles.php';
$idFaction = filter($_GET['idFaction']);
$dataGrilles = $Grilles->getFactionData($idFaction);
$Grilles->DisplayGrilleOpti($dataGrilles);
