<?php
Class GetFactions {
  public function getFactionPublic () {
    $select = "SELECT `idFaction`, `nomFaction`, `descriptionFaction`, `valide`, `auteur`, `factionPrivate`
    FROM `Factions` WHERE `valide` = 1 AND `factionPrivate` = 0
    ORDER BY `nomFaction`";
    $void = [];
    $readDB = new RCUD($select, $void);
    return $readDB->READ();
  }
  public function factionPrivatePublic ($idUser) {
    $select = "SELECT `idFaction`, `nomFaction`, `descriptionFaction`, `valide`, `auteur`, `factionPrivate`
    FROM `Factions`
    WHERE `factionPrivate` = 1 AND `auteur` = :idUser;";
    $param = [['prep'=>':idUser', 'variable'=>$idUser]];
    $readDB = new RCUD($select, $param);
    return $readDB->READ();
  }


  public function getGroupFactions ($auteur, $valide, $factionPrivate) {
    $select = "SELECT `idFaction`, `nomFaction`, `descriptionFaction`, `valide`, `auteur`, `factionPrivate`
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
  public function getAdminFactionsUser($valide, $factionPrivate, $idUser) {
    $select = "SELECT `idFaction`, `nomFaction`, `descriptionFaction`, `Factions`.`valide`, `login`, `factionPrivate`
    FROM `Factions`
    INNER JOIN `users` ON `auteur` = `idUser`
    WHERE `Factions`.`valide` = :valide AND `factionPrivate` = :factionPrivate AND `auteur` = :auteur
    ORDER BY `nomFaction`";
    $param = [['prep'=>':valide', 'variable'=>$valide],
              ['prep'=>':factionPrivate', 'variable'=>$factionPrivate],
              ['prep'=>':auteur', 'variable'=>$idUser]];
    $readDB = new RCUD($select, $param);
    return $readDB->READ();
  }
  public function getOneFaction ($idFaction) {
    $select = "SELECT `idFaction`, `nomFaction`, `descriptionFaction`, `factionPrivate`, `valide`
    FROM `Factions`
    WHERE `idFaction` = :idFaction";
    $param = [['prep'=>':idFaction', 'variable'=>$idFaction]];
    $readDB = new RCUD($select, $param);
    return $readDB->READ();
  }
  public function getOneFactionUser ($idFaction, $id) {
    $select = "SELECT `idFaction`, `nomFaction`, `descriptionFaction`, `factionPrivate`, `valide`
    FROM `Factions`
    WHERE `idFaction` = :idFaction AND `auteur` = :auteur";
    $param = [['prep'=>':idFaction', 'variable'=>$idFaction],
              ['prep'=>':auteur', 'variable'=>$id]];
    $readDB = new RCUD($select, $param);
    return $readDB->READ();
  }
  public function getLinkTalentFaction ($idTalent) {
    $select = "SELECT `nomFaction`, `idlienTF`
              FROM `lienTalentFaction`
              INNER JOIN `Factions` ON `Factions`.`idFaction` = `lienTalentFaction`.`idFaction`
              WHERE `idTalent` = :idTalent";
    $param = [['prep'=>':idTalent', 'variable'=>$idTalent]];
    $readDB = new RCUD($select, $param);
    return $readDB->READ();
  }
  public function getLinkTalentPrivateFaction ($idTalent) {
    $select = "SELECT `nomFaction`, `idlienTF`
              FROM `lienTalentFaction`
              INNER JOIN `Factions` ON `Factions`.`idFaction` = `lienTalentFaction`.`idFaction`
              WHERE `idTalent` = :idTalent AND `factionPrivate` = 1;";
    $param = [['prep'=>':idTalent', 'variable'=>$idTalent]];
    $readDB = new RCUD($select, $param);
    return $readDB->READ();
  }

}
