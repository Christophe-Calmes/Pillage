<?php
Class GetTroupes extends PrintGrilles {

  public function readTroupe ($valide, $auteur, $private) {
    $select = "SELECT `idTroupe`, `typeTroupe`, `nomTroupe`, `factionTroupe`, `nomFaction`, `Troupes`.`valide`
              FROM `Troupes`
              INNER JOIN `Factions` ON `Factions`.`idFaction`= `factionTroupe`
              WHERE `Troupes`.`valide` = :valide AND `Troupes`.`auteur` = :auteur AND `factionPrivate` = :factionPrivate
              ORDER BY `nomFaction` AND `nomTroupe`";
    $param = [['prep'=>':valide', 'variable'=>$valide], ['prep'=>':auteur', 'variable'=>$auteur], ['prep'=>':factionPrivate', 'variable'=>$private]];
    $readTroupe = new RCUD($select, $param);
    return $readTroupe->READ();
  }

}
