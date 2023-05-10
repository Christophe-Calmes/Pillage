<?php
  // Contrôles
  // heads
  require 'sources/factions/headFaction.php';
  //$factions
  require 'sources/grilleFaction/headGrilles.php';
  require 'sources/troupes/headTroupes.php';
  //$Grilles
  //Extration de l'idUser
  $zool = new Controles();
  $idUser = $zool->idUser($_SESSION['tokenConnexion']);
  // Extraction des data des factions
  $dataFactionsPublic = $factions->getFactionPublic();
  $dataFactionUser = $factions->getAdminFactionsUser(1, 1, $idUser);

echo '<form class="formulaireClassique" action="'.encodeRoutage(36).'" method="post">';
echo '<label for="nomTroupe">Nom de votre unité</label>';
echo '<input type="text" id="nomTroupe" name="nomTroupe" placeholder="nom de votre unité" />';
      $Grilles->selectType();
      $factions->selectFaction($dataFactionUser, $dataFactionsPublic);
echo '<label for="descriptionTroupe">Description de votre nouvelle unitée :</label>';
echo '<textarea id="descriptionTroupe" name="descriptionTroupe" rows="10" cols="55" placeholder="Votre description." required></textarea>';
echo '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Créer</button>
</form>';
$user = new Controles ();
$idUser = $user->idUser($_SESSION['tokenConnexion']);
$array = [['titre'=>'Vos troupes de factions générales', 'valide'=> 1, 'private'=> 0],
          ['titre'=>'Vos troupes de faction privé', 'valide'=> 1, 'private'=> 1],
          ['titre'=>'Vos troupes de faction privé non valide', 'valide'=> 0, 'private'=> 1],
          ['titre'=>'Vos troupes de faction générale non valide', 'valide'=> 0, 'private'=> 0]];

foreach ($array as $key => $value) {
  $dataTroupe = $troupes->readTroupe ($value['valide'], $idUser, $value['private']);
  if($dataTroupe != []){
    echo '<section>';
    echo '<h3>'.$value['titre'].'</h3>';
    // false zone non admin
    $troupes->simpleTroupes($dataTroupe, false, $idNav);
    echo '</section>';
  }
}
