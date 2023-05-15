<?php
//encodeRoutage(39)
// Objets
require '../sources/grilleFaction/objets/getGrilles.php';
require '../sources/grilleFaction/objets/printGrilles.php';
require '../sources/troupes/objets/CRUDTroupes.php';
$record = new TroupeRecord($_POST);
$record->controlePost();
$price = $record->sumTroupe($_SESSION['tokenConnexion']);
$record->recordDatasTroupe($price, $idNav);
