<?php
require 'sources/talents/headTalent.php';
//$talents->displayTalentUser();
  if(isset($_GET['page']) && (!empty($_GET['page']))) {
    $currentPage = filter($_GET['page']);
  } else {
    $currentPage = 1;
  }
    $parPage = 5;
    // Déclaration de paramètre vide :
    $param = array();
    // Nombre d'éléments talent.
    $nbrTalent = $talents->nombreTalents();
    $pages = ceil($nbrTalent/$parPage);
    $premier = ($currentPage * $parPage) - $parPage;
    // Affichage
    $talents->displayTalentUser ($premier , $parPage);
  for ($page=1; $page <= $pages ; $page++ ) {
    echo '<a class="lienNav" href="index.php?idNav='.$idNav.'&page='.$page.'">'.$page.'</a>';
  }
