<?php
class TroupeRecord extends PrintGrilles {
  private $arrayCA;
  public function __construct($post) {
    parent::__construct();
    $this->arrayCA = [['champs'=>'`SP`', 'set'=>', :SP'],
                      ['champs'=>'`armure`', 'set'=>', :armure'],
                      ['champs'=>'`bouclier`', 'set'=>', :bouclier'],
                      ['champs'=>'`armure`, `bouclier`', 'set'=>', :armure, :bouclier']];
    $this->post = $post;

  }
  public function printPost () {
    // Fonction lié à la debug
    print_r($this->post);
  }
  private function searchIdFaction($token) {
    $checkId = new Controles();
    $idUser = $checkId->idUser($token);
    $idTroupe = filter($this->post['idTroupe']);
    $param = [['prep'=>':idTroupe', 'variable'=>$idTroupe], ['prep'=>':idUser', 'variable'=>$idUser]];
    $select = "SELECT `factionTroupe`, `typeTroupe` FROM `Troupes` WHERE `idTroupe` = :idTroupe AND `auteur` = :idUser";
    $readId = new RCUD($select, $param);
    $data = $readId->READ();
    if(!empty($data)) {
      return $data;
    } else {
      return false;
    }

  }
  public function sumTroupe ($token) {
    $Faction = $this->searchIdFaction($token);
    if(!$Faction) {
      return false;
    }
    // print_r($this->champs);
    // Déclaration de variable
    $set = NULL;
    // Création de la requête
    $index = filter($this->post['classe']);
    $classe = $this->arrayCA[$index]['champs'];
    // [classe] delete
    array_shift($this->post);
    array_pop($this->post);
    // construction de la requête
      foreach ($this->post as $key => $value) {
        $set = '`'.$key.'` + '.$set;
      }
    $set = $set.' '.$classe;
    $sum = 'SUM(`coutBase` + '.$set.') AS `price`';
    $select =  "SELECT {$sum} FROM `cout` WHERE `idFaction` = :idFaction AND`indexType` = :indexType";
    $param = [['prep'=>':idFaction', 'variable'=>$Faction[0]['factionTroupe']],
              ['prep'=>':indexType', 'variable'=>$Faction[0]['typeTroupe']]];
    $read = new RCUD($select, $param);
    $data = $read->READ();
    return $data[0]['price'];
  }

}
