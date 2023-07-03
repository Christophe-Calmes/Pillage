<?php
require 'sources/listes/headArmyList.php';
  $idListe = filter($_GET['idListe']);

  //print_r($idListe);
  $Army->SharePrintingListe($idListe, $idNav);
