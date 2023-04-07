<?php
Class GetFactions {
  public function getGroupFactions ($auteur, $valide, $factionPrivate) {
    $select = "SELECT `idFaction`, `nomFaction`, `descriptionFaction`, `valide`, `auteur`, `factionPrivate`
    FROM `Factions`
    WHERE `auteur` = :auteur AND `valide` = :valide AND `factionPrivate` = :factionPrivate ORDER BY `nomFaction`";
    $param = [['prep'=>':auteur', 'variable'=>$auteur],
              ['prep'=>':valide', 'variable'=>$valide],
              ['prep'=>':factionPrivate', 'variable'=>$factionPrivate],];
    $readDB = new RCUD($select, $param);
    return $readDB->READ();
  }
}
