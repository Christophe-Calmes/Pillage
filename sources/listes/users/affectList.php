<?php
// route 122
require 'sources/listes/headArmyList.php';
  // idUser
  $checkId = new Controles();
  $idUser = $checkId->idUser($_SESSION['tokenConnexion']);
  $idListe = filter($_GET['idListe']);
 $dataFaction = $Army->rooster($idListe, $idUser, $idNav, $idListe);
