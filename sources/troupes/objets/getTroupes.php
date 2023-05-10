<?php
Class GetTroupes extends PrintGrilles {

  public function readTroupe ($valide, $auteur, $private, $idFaction) {
    $select = "SELECT `idTroupe`, `typeTroupe`, `nomTroupe`, `factionTroupe`, `nomFaction`, `Troupes`.`valide`
              FROM `Troupes`
              INNER JOIN `Factions` ON `Factions`.`idFaction`= `factionTroupe`
              WHERE `Troupes`.`valide` = :valide
              AND `Troupes`.`auteur` = :auteur
              AND `factionPrivate` = :factionPrivate
              AND `factionTroupe` = :factionTroupe
              ORDER BY `nomFaction` AND `nomTroupe`";
    $param = [['prep'=>':valide', 'variable'=>$valide],
              ['prep'=>':auteur', 'variable'=>$auteur],
              ['prep'=>':factionPrivate', 'variable'=>$private],
              ['prep'=>':factionTroupe', 'variable'=>$idFaction]];
    $readTroupe = new RCUD($select, $param);
    return $readTroupe->READ();
  }

}
