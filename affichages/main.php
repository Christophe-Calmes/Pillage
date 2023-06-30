<?php
class ControlerAffichage {
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
      function dev($route, $dev) {
        if($dev){echo $route;}
      }
      $dev = true;
      if (isset($data['idNav'])) {
          $idNav = filter($data['idNav']);
          $readNav = new GetNavigation();
          $chemin = $readNav->getContenus($idNav);
          if (empty($chemin)) {
              deadEnd();
          } elseif ((empty($session)) && ($chemin[0]['niveau'] == 0)) {
              dev($chemin[0]['cheminNav'], $dev);
              include $chemin[0]['cheminNav'];
              return $idNav;
          } elseif ((isset($session['role'])) && ($session['role'] <= $chemin[0]['niveau'])) {
              dev($chemin[0]['cheminNav'], $dev);
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
    ControlerAffichage::idOrNot($_SESSION);
  // Affichage message
  if (isset($_GET['message'])) {echo '<h3>'.filter($_GET['message']).'</h3>';}
  $idNav = ControlerAffichage::displayNav($_GET, $_SESSION);
echo '</section>';
echo '</main>';
