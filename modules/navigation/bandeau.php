<?php
  require 'modules/navigation/objets/getNavigation.php';
  require 'modules/navigation/objets/printNavigation.php';

  $readNav = new PrintNavigation();
  if(isset($_SESSION['role'])) {
      $dataNavBandeau = $readNav->getNav($_SESSION['role']);
  } else {
      $dataNavBandeau = $readNav->getNav(0);
  }
  $readNav->bandeauHaut($dataNavBandeau);
