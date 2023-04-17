<?php
Class GetFactions {
  public function getGroupFactions ($auteur, $valide, $factionPrivate) {
    $select = "SELECT `nomFaction`, `descriptionFaction`, `valide`, `auteur`, `factionPrivate`
    FROM `Factions`
    WHERE `auteur` = :auteur AND `valide` = :valide AND `factionPrivate` = :factionPrivate
    ORDER BY `nomFaction`";
    $param = [['prep'=>':auteur', 'variable'=>$auteur],
              ['prep'=>':valide', 'variable'=>$valide],
              ['prep'=>':factionPrivate', 'variable'=>$factionPrivate],];
    $readDB = new RCUD($select, $param);
    return $readDB->READ();
  }
  public function getAdminFactions ($valide, $factionPrivate) {
    $select = "SELECT `idFaction`, `nomFaction`, `descriptionFaction`, `Factions`.`valide`, `login`, `factionPrivate`
    FROM `Factions`
    INNER JOIN `users` ON `auteur` = `idUser`
    WHERE `Factions`.`valide` = :valide AND `factionPrivate` = :factionPrivate
    ORDER BY `nomFaction`";
    $param = [['prep'=>':valide', 'variable'=>$valide],
              ['prep'=>':factionPrivate', 'variable'=>$factionPrivate],];
    $readDB = new RCUD($select, $param);
    return $readDB->READ();
  }
  public function getOneFaction ($idFaction) {
    $select = "SELECT `idFaction`, `nomFaction`, `descriptionFaction`
    FROM `Factions`
    WHERE `idFaction` = :idFaction";
    $param = [['prep'=>':idFaction', 'variable'=>$idFaction]];
    $readDB = new RCUD($select, $param);
    return $readDB->READ();
  }
}
