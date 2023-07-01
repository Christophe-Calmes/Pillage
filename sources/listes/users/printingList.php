<?php
require 'sources/listes/headArmyList.php';
  $idListe = filter($_GET['idListe']);
  $checkId = new Controles();
  $idUser = $checkId->idUser($_SESSION['tokenConnexion']);
  //print_r($idListe);
  $Army->printingListe($idListe, $idUser);
