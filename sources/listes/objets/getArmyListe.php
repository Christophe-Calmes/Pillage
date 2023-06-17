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
}
