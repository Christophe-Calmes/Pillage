<?php
//encodeRoutage(39)
// Objets
require '../sources/grilleFaction/objets/getGrilles.php';
require '../sources/grilleFaction/objets/printGrilles.php';
require '../sources/troupes/objets/CRUDTroupes.php';
$record = new TroupeRecord($_POST);
$price = $record->sumTroupe ($_SESSION['tokenConnexion']);
// Contrôle sur Price
if(!$price) {
  header('location:../index.php?message=Soucis d\'enregistrement.');
} else {
  print_r($price);
}
