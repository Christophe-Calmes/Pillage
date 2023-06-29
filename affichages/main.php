<?php
class controlerAffichage {
  // Inspiration de l'amiTik.
  public static function idOrNot($data) {
    if(isset($_SESSION['login'])) {
      echo '<h3>Session de '.$_SESSION['login'].'</h3>';
    } else {
      echo '<h3>Bienvenus</h3>';
    }
  }
  public static function displayNav($data, $session) {
      function deadEnd() {
          include 'modules/navigation/pageGeneral.php';
          return 0;
      }

      if (isset($data['idNav'])) {
          $idNav = filter($data['idNav']);
          $readNav = new GetNavigation();
          $chemin = $readNav->getContenus($idNav);
          if (empty($chemin)) {
              deadEnd();
          } elseif ((empty($session)) && ($chemin[0]['niveau'] == 0)) {
              include $chemin[0]['cheminNav'];
              return $idNav;
          } elseif ((isset($session['role'])) && ($session['role'] <= $chemin[0]['niveau'])) {
              include $chemin[0]['cheminNav'];
              return $idNav;
          } else {
              deadEnd();
          }
      } else {
          deadEnd();
      }
  }
}

echo '<main>';
  echo '<section>';

    controlerAffichage::idOrNot($_SESSION);

    // if(isset($_SESSION['login'])) {
    //   echo '<h3>Session de '.$_SESSION['login'].'</h3>';
    // } else {
    //   echo '<h3>Bienvenus</h3>';
    // }
  // Mode dev true / false - Affiche le chemin des pages + Ajout de menus / page dans le site.
  $dev = true;
  // Affichage message
  if (isset($_GET['message'])) {echo '<h3>'.filter($_GET['message']).'</h3>';}

  $idNav = controlerAffichage::displayNav($_GET, $_SESSION);
  // Affichage elements
 // if(isset($_GET['idNav'])) {
 //    $idNav = filter($_GET['idNav']);
 //    $chemin = $readNav->getContenus($idNav);
 //    if($chemin == []) {
 //        include 'modules/navigation/pageGeneral.php';
 //
 //    } else {
 //      if($dev) {
 //        echo $chemin[0]['cheminNav'];
 //      }
 //        if(($_SESSION == [])&&($chemin[0]['niveau'] == 0)) {
 //          if($chemin[0]['niveau'] == 0) {
 //            include $chemin[0]['cheminNav'];
 //          } else {
 //              include 'modules/navigation/pageGeneral.php';
 //          }
 //        } elseif((isset($_SESSION['role']))&&($_SESSION['role'] >= $chemin[0]['niveau'])) {
 //          include $chemin[0]['cheminNav'];
 //        } else {
 //          include 'modules/navigation/pageGeneral.php';
 //        }
 //    }
 //  } else {
 //    $idNav = 0;
 //    include 'modules/navigation/pageGeneral.php';
 //  }

echo '</section>';
echo '</main>';
