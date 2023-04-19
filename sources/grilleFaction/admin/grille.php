<?php
require 'sources/grilleFaction/objets/getGrilles.php';
require 'sources/grilleFaction/objets/printGrilles.php';
$idFaction = filter($_GET['idFaction']);
$Grilles = new PrintGrilles();
$dataGrilles = $Grilles->getFactionData($idFaction);
$Grilles->formGrille ($dataGrilles, $idNav);
