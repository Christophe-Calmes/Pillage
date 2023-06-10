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
/*  protected function getFactionTroupe ($idListe) {
    $select = "SELECT `nomFaction`, `Listes`.`idFaction`
              FROM `Listes`
              INNER JOIN `Factions` ON `Listes`.`idFaction` = `Factions`.`idFaction`
              WHERE `idListe` = :idListe";
    $param = [['prep'=>':idListe', 'variable'=>$idListe]];
    $readData = new RCUD($select, $param);
    return $readData->READ();
  }
  protected function getFactionTroupe($idFaction, $idUser) {
    $select = "SELECT `idTroupe`, `typeTroupe`, `nomTroupe`, `factionTroupe`, `descriptionTroupe`, `classe`, `monture`, `valide`,
    `auteur`, `prixTroupe`, `arbalete`, `arc`, `armeDeBase`, `armeImp`, `armure`, `banniere`, `bouclier`, `cheval`, `chienDG`,
    `corDG`, `fronde`, `hacheD`, `javelot`, `lance`, `SP`, `tireur`
    FROM `Troupes`
    WHERE `factionTroupe` = :factionTroupe
    AND`valide` = 1 AND `auteur` = :idUser";
    $param = [['prep'=>':factionTroupe', 'variable'=>$idFaction],
              ['prep'=>':idUser', 'variable'=>$idUser]];
    $readData = new RCUD($select, $param);
    return $readData->READ();
  }*/
}
