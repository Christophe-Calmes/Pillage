<?php
  require 'functions/functionPagination.php';
require 'sources/listes/headArmyList.php';
$id = new Controles();
$idUser = $id->idUser($_SESSION['tokenConnexion']);
$Army->addArmyListe($idNav, $idUser);
require 'javaScript/magicButton.php';
// Pagination des listes valides
// Paramètre de pagination
if(isset($_GET['page']) && (!empty($_GET['page']))) {
    $currentPage = filter($_GET['page']);
  } else {
  $currentPage = 1;
  }
  $parPage = 5;
  $pages = ceil($Army->nbrYourList($idUser, 1)/$parPage);
  //print_r($pages);
  // Calcul du premier objet dans la page.
$premier = ($currentPage * $parPage) - $parPage;
$dataListe = $Army->getYourlistPagined($idUser, 1, $premier, $parPage);
print_r($dataListe);


for ($page=1; $page <= $pages ; $page++ ) {
    echo '<a class="lienNav" href="index.php?idNav='.$idNav.'&page='.$page.'">'.$page.'</a>';
  }