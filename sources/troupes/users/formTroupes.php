<?php
  // Contrôles
  require 'sources/factions/headFaction.php';
  require 'sources/grilleFaction/objets/getGrilles.php';
  require 'sources/grilleFaction/objets/printGrilles.php';
  require 'sources/troupes/objets/getTroupes.php';
  require 'sources/troupes/objets/printTroupes.php';
  $troupes = new PrintTroupes();
  //Extration de l'idUser
  $zool = new Controles();
  $idUser = $zool->idUser($_SESSION['tokenConnexion']);
  // Extraction des data des factions
  $troupes->addFormTroupe ($idUser, $idNav);
  // Tableau des troupes


function affichage($troupes, $dataFactions, $idUser, $idNav) {
  $array  = [['titre'=>'Troupe valide', 'valide'=>1], ['titre'=>'Troupe non valide', 'valide'=>0]];
  foreach ($array as $First => $valued) {
    echo '<h3>'.$valued['titre'].'</h3>';
    foreach ($dataFactions as $key => $value) {
      $message = NULL;
      if ($value['factionPrivate'] == 1) {$message = 'Votre faction : ';}
      $dataTroupe = $troupes->readTroupe ($valued['valide'], $idUser, $value['factionPrivate'], $value['idFaction']);
      if(!empty($dataTroupe)){
        echo '<h3>'.$message.' '.$value['nomFaction'].'</h3>';
        //print_r($dataTroupe);
        echo '<section>';
        // false zone non admin
        $troupes->simpleTroupes($dataTroupe, false, $idNav);
        echo '</section>';
      }
    }
  }
}


// Factions privé - Troupe valide
$dataFactions = $factions->factionPrivatePublic ($idUser);
affichage($troupes, $dataFactions, $idUser, $idNav);
// Faction publique - Troupe valide
$dataFactions = $factions->getFactionPublic();
affichage($troupes, $dataFactions, $idUser, $idNav);
