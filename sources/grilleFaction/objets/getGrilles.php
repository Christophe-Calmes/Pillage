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
    WHERE `cout`.`idFaction` = :idFaction
    ORDER BY `indexType`";
    $readDB = new RCUD($select, $param);
    $dataFaction = $readDB->READ();
    if($dataFaction == []) {
      return $idFaction;
    } else {
      return $dataFaction;
    }
  }

}
