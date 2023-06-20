<?php

class GetArmy extends PrintTroupes
{

  function __construct()
  {
    parent::__construct();
  }
  public function nbrYourList($idUser, $valide) {
    $select = "SELECT COUNT(`idListe`) AS `nbr` FROM `Listes` WHERE `auteurListe` = :idUser AND `valide` = :valide";
    $param = [['prep'=>':valide', 'variable'=>$valide],
              ['prep'=>':idUser', 'variable'=>$idUser]];
              $readData = new RCUD($select, $param);
              $nbr = $readData->READ();
              return $nbr[0]['nbr'];

  }

  public function getYourlistPagined($idUser, $valide, $premier, $parPage) {
    $select="SELECT `idListe`, `Listes`.`idFaction`, `nomListe`, `descriptionListe`, `auteurListe`, `Listes`.`valide`, `partager`, `chefValide`, `prixListe`, `nomFaction`
    FROM `Listes`
    INNER JOIN `Factions` ON `Listes`.`idFaction` =  `Factions`.`idFaction`
    WHERE `Listes`.`valide` = :valide AND`auteurListe` = :idUser
    ORDER BY `nomListe` DESC LIMIT {$premier}, {$parPage}";
    $param = [['prep'=>':valide', 'variable'=>$valide],
              ['prep'=>':idUser', 'variable'=>$idUser]];
    $readData = new RCUD($select, $param);
    return $readData->READ();
  }
  protected function findIdFaction ($idListe) {
    $select = "SELECT `idFaction` FROM `Listes` WHERE `idListe` = :idListe";
    $param = [['prep'=>':idListe', 'variable'=>$idListe]];
    $readIdFaction =  new RCUD($select, $param);
    $data = $readIdFaction->READ();
    return $data[0]['idFaction'];
  }
  protected function compoListe($idListe, $select) {
    // Nbre de figurine dans la listes
    $param = [['prep'=>':idListe', 'variable'=>$idListe]];
    $read =  new RCUD($select, $param);
    $data = $read->READ();
    return $data[0]['total'];
  }
  protected function propotionList($idListe) {
    $result = array();
    $arraySQL = ["SELECT SUM(`nombreTroupe`) AS `total`
                  FROM `CompositionListe`
                  WHERE `idListe` = :idListe;",
                  "SELECT SUM(`nombreTroupe`) AS `total`
                    FROM `CompositionListe`
                    INNER JOIN `Troupes` ON `Troupes`.`idTroupe` = `CompositionListe`.`idTroupe`
                    WHERE `idListe` = :idListe AND `tireur`= 1",
                    "SELECT SUM(`nombreTroupe`) AS `total`
                      FROM `CompositionListe`
                      INNER JOIN `Troupes` ON `Troupes`.`idTroupe` = `CompositionListe`.`idTroupe`
                      WHERE `idListe` = :idListe AND `monture`= 1;"];
      for ($i=0; $i <count($arraySQL); $i++) {
        array_push($result, $this->compoListe($idListe, $arraySQL[$i]));
      }
      if ($result[0] > 0) {
        $total = $result[0];
        $shooter = $result[1];
        $knight = $result[2];
        array_push($result, round(($shooter/$total)*100, 2));
        array_push($result, round(($knight/$total)*100, 2));
        // 0 => total, 1 = shooter, 2= chevalier, 3 = % de shooter, 4 = % de chevalier
        return $result;
      } else {
        return [0, 0, 0, 0, 0];
      }
  }
  protected function troopePrice ($idListe) {
    $select = "SELECT  SUM(`nombreTroupe` * `prixTroupe`) AS `total`
              FROM `CompositionListe`
              INNER JOIN `Troupes` ON `CompositionListe`.`idTroupe`= `Troupes`.`idTroupe`
              WHERE `idListe` = :idListe;";
    $param = [['prep'=>':idListe', 'variable'=>$idListe]];
    $read =  new RCUD($select, $param);
    $data = $read->READ();
    return $data[0]['total'];
  }
  protected function detailListe($idListe) {
    $select = "SELECT `idCL`, `nombreTroupe`, `nomTroupe`, `typeTroupe`, `tireur`, `monture`, `prixTroupe`, `cheval`, `idListe`
              FROM `CompositionListe`
              INNER JOIN `Troupes` ON `Troupes`.`idTroupe` = `CompositionListe`.`idTroupe`
              WHERE `idListe` = :idListe;";
              $param = [['prep'=>':idListe', 'variable'=>$idListe]];
              $read =  new RCUD($select, $param);
              $data = $read->READ();
              return $data;
  }


}
