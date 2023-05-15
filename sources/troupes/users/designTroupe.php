<?php
require 'sources/grilleFaction/headGrilles.php';
require 'sources/troupes/headTroupes.php';
$idTroupe = filter($_GET['idTroupe']);
// Charger la bonne colonne, s'assurer qu'elle est pleine
// Créer un formulaire ppour updater et calculer le prix de la nouvelle troupe.
// Afficher un message si la colonne n'existe pas.
$zool = new Controles();
$idUser = $zool->idUser($_SESSION['tokenConnexion']);
$dataTroupe = $troupes->dataTroupe ($idTroupe, $idUser);
$dataCout = $troupes->readGrille ($idTroupe, $idUser);
$troupes->designTroupe($dataTroupe, $dataCout, $idNav);
$troupes->printTroupeDesign($idTroupe, $idUser);
