<?php
Class GetGrilles {
  public function getFactionData($idFaction) {
    $param = [['prep'=> ':idFaction', 'variable'=>$idFaction]];
    $select="SELECT `idCout`, `indexType`, `coutBase`,
    `SP`, `armure`, `bouclier`, `armeImp`,
    `lance`, `armeDeBase`, `hacheD`, `fronde`,
    `javelot`, `arc`, `arbalete`, `cheval`,
    `banniere`, `corDG`, `chienDG`, `nomFaction`, `Factions`.`idFaction`
    FROM `cout`
    INNER JOIN `Factions` ON `cout`.`idFaction` = `Factions`.`idFaction`
    WHERE `cout`.`idFaction` = :idFaction";
    $readDB = new RCUD($select, $param);
    return $readDB->READ();
  }
}
