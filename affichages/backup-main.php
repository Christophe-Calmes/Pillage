<main>
  <section>
<?php
    if(isset($_SESSION['login'])) {
      echo '<h3>Session de '.$_SESSION['login'].'</h3>';
    } else {
      echo '<h3>Bienvenus</h3>';
    }
  // Mode dev true / false - Affiche le chemin des pages + Ajout de menus / page dans le site.
  $dev = true;
  // Affichage message
if (isset($_GET['message'])) {echo '<h3>'.filter($_GET['message']).'</h3>';}
  // Affichage elements
 if(isset($_GET['idNav'])) {
    $idNav = filter($_GET['idNav']);
    $chemin = $readNav->getContenus($idNav);
    if($chemin == []) {
        include 'modules/navigation/pageGeneral.php';

    } else {
      if($dev) {
        echo $chemin[0]['cheminNav'];
      }
        if(($_SESSION == [])&&($chemin[0]['niveau'] == 0)) {
          if($chemin[0]['niveau'] == 0) {
            include $chemin[0]['cheminNav'];
          } else {
              include 'modules/navigation/pageGeneral.php';
          }
        } elseif((isset($_SESSION['role']))&&($_SESSION['role'] >= $chemin[0]['niveau'])) {
          include $chemin[0]['cheminNav'];
        } else {
          include 'modules/navigation/pageGeneral.php';
        }
    }
  } else {
    $idNav = 0;
    include 'modules/navigation/pageGeneral.php';
  }
?>
</section>
</main>
