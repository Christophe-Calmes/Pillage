<?php
// route 122
require 'sources/listes/headArmyList.php';
  // idUser
  $checkId = new Controles();
  $idUser = $checkId->idUser($_SESSION['tokenConnexion']);
  $idListe = filter($_GET['idListe']);
//print_r($idListe);
echo '<h3>Création de la liste</h3>';
echo '<section class="flex-rows">';
  $dataFaction = $Army->rooster($idListe, $idUser, $idNav, $idListe);
  $Army->diplayList($idListe, $idNav);
echo '</section>';
