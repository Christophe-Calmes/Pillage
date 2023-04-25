<?php
  // Contrôles
  // heads
  require 'sources/factions/headFaction.php';
  //$factions
  require 'sources/grilleFaction/headGrilles.php';
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
echo '<button class="buttonForm" type="submit" name="idNav" value="<?=$idNav?>">Créer</button>
</form>';
