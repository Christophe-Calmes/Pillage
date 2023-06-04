<?php

class PrintArmy extends GetArmy
{
  public function __construct()
  {
    parent::__construct();
  }
  public function addArmyListe($idNav, $idUser) {
    $factions = new PrintFactions();
    $dataFactionPublic = $factions->getFactionPublic ();
    $dataFactionPrivate = $factions->factionPrivatePublic ($idUser);
    echo '<div class="objetLeft">
    <h2>Ouvrir le formulaire</h2>
    <button type="button" id="magic" class="open">Ouvrir le formulaire</button>
    </div>
    <div id="hiddenForm">';
      echo '<form class="formulaireClassique" id="magic" action="'.encodeRoutage(45).'" method="post">';
      echo '<h3>Liste</h3>';
      echo '<label for="nomListe">Nom de la liste : </label>
            <input id="nomListe" type="text" name="nomListe" placeholder="Nom de liste"/>';
              $factions->selectFaction($dataFactionPrivate, $dataFactionPublic);
      echo '<label for="descriptionListe">Description de votre nouvelle liste</label>
            <textarea name="descriptionListe" rows="8" cols="60">Description de votre nouvelle liste.</textarea>
            <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Créer la liste</button>
    </form>
    </div>';
  }
  
  public function __destruct()
  {
    
  }
}
