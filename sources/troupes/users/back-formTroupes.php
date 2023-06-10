<?php
  // Contrôles
  require 'sources/factions/headFaction.php';
  require 'sources/grilleFaction/headGrilles.php';
  require 'sources/troupes/objets/getTroupes.php';
  require 'sources/troupes/objets/printTroupes.php';
  $troupes = new PrintTroupes();

  //Extration de l'idUser
  $zool = new Controles();
  $idUser = $zool->idUser($_SESSION['tokenConnexion']);
  // Extraction des data des factions
  $dataFactionsPublic = $factions->getFactionPublic();
  $dataFactionUser = $factions->getAdminFactionsUser(1, 1, $idUser);
  echo '<div class="objetLeft">
        <h2>Ajouter une troupe</h2>
          <button type="button" id="magic" class="open">Ouvrir le formulaire</button>
      </div>
      <div id="hiddenForm">';
        echo '<form class="formulaireClassique" action="'.encodeRoutage(36).'" method="post">';
        echo '<label for="nomTroupe">Nom de votre unité</label>';
        echo '<input type="text" id="nomTroupe" name="nomTroupe" placeholder="nom de votre unité" />';
              $Grilles->selectType();
              $factions->selectFaction($dataFactionUser, $dataFactionsPublic);
        echo '<label for="descriptionTroupe">Description de votre nouvelle unitée :</label>';
        echo '<textarea id="descriptionTroupe" name="descriptionTroupe" rows="10" cols="55" placeholder="Votre description." required></textarea>';
        echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Créer</button>
        </form>';
      echo '</div>';
    include 'javaScript/magicButton.php';
$user = new Controles ();
$idUser = $user->idUser($_SESSION['tokenConnexion']);

$array  = [['titre'=>'Troupe valide', 'valide'=>1], ['titre'=>'Troupe non valide', 'valide'=>0]];

// Factions publique - Troupe valide
$dataFactions = $factions->factionPrivatePublic ($idUser);
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
