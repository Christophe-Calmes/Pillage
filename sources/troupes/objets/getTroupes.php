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
    public function readGrille ($idTroupe, $idUser) {
      // Permet de trouver le bon champs dans la table "cout"
      // Extraction des éléments factionTroupe et typeTroupe depuis la table troupes
      $select = "SELECT `typeTroupe`,  `factionTroupe`
                  FROM `Troupes`
                  WHERE `idTroupe`= :idTroupe
                  AND `valide` = 1
                  AND `auteur` = :idUser";
      $param = [['prep'=>':idTroupe', 'variable'=>$idTroupe],
                ['prep'=>':idUser', 'variable'=>$idUser]];
      $readTroupe = new RCUD($select, $param);
      $data = $readTroupe->READ();
      // Extration des données
      if(!empty($data)){
        $typeTroupe = $data[0]['typeTroupe'];
        $factionTroupe = $data[0]['factionTroupe'];
        $select = "SELECT `idCout`, `indexType`, `coutBase`, `idFaction`,
                  `SP`, `armure`, `bouclier`, `armeImp`, `lance`, `armeDeBase`,
                  `hacheD`, `fronde`, `javelot`, `arc`, `arbalete`, `cheval`, `banniere`,
                  `corDG`, `chienDG`
                  FROM `cout`
                  WHERE `idFaction` = :idFaction
                  AND `indexType` =:indexType";
          $param = [['prep'=>':indexType', 'variable'=>$data[0]['typeTroupe']],
                    ['prep'=>':idFaction', 'variable'=>$data[0]['factionTroupe']]];
          $readTroupe = new RCUD($select, $param);
          return $readTroupe->READ();
    } else {
      return NULL;
    }
  }
  public function dataTroupe ($idTroupe, $idUser) {
    $select = "SELECT `idTroupe`, `typeTroupe`, `nomTroupe`, `factionTroupe`,
                `descriptionTroupe`, `classe`, `monture`,
                `Troupes`.`valide`, `Troupes`.`auteur`, `prixTroupe`, `nomFaction`
                FROM `Troupes`
                INNER JOIN `Factions` ON `factionTroupe` = `idFaction`
                WHERE `idTroupe` = :idTroupe
                AND `Troupes`.`auteur`= :idUser
                AND `Troupes`.`valide` = 1";
    $param = [['prep'=>':idTroupe', 'variable'=>$idTroupe],
              ['prep'=>':idUser', 'variable'=>$idUser]];
    $readTroupe = new RCUD($select, $param);
    return $readTroupe->READ();
  }
}
