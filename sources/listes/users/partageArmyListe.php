<?php
require 'functions/functionPagination.php';
require 'sources/listes/headArmyList.php';
  // Pagination des listes valides
  // Paramètre de pagination
    if(isset($_GET['page']) && (!empty($_GET['page']))) {
        $currentPage = filter($_GET['page']);
      } else {
        $currentPage = 1;
      }
    $parPage = 12;
    $pages = ceil($Army->nbrShareList()/$parPage);
    //print_r($pages);
    // Calcul du premier objet dans la page.
    $premier = ($currentPage * $parPage) - $parPage;
    $dataListe = $Army->getShareListPagined( $premier, $parPage);
    $Army->displayShareList($dataListe);

    for ($page=1; $page <= $pages ; $page++ ) {
        echo '<a class="lienNav" href="index.php?idNav='.$idNav.'&page='.$page.'">'.$page.'</a>';
      }
