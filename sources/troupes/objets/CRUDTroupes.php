<?php
class TroupeRecord extends PrintGrilles {
  private $arrayCA;
  public function __construct($post) {
    parent::__construct();
    $this->arrayCA = [['champs'=>'`SP`', 'set'=>', :SP', 'updateSet' => '`SP` = 1'],
                      ['champs'=>'`armure`', 'set'=>', :armure' , 'updateSet' => '`armure` = 1'],
                      ['champs'=>'`bouclier`', 'set'=>', :bouclier', 'updateSet' => '`bouclier` = 1'],
                      ['champs'=>'`armure`, `bouclier`', 'set'=>', :armure, :bouclier', 'updateSet' => '`armure` = 1, `bouclier` = 1']];
    $this->post = $post;

  }
  public function controlePost() {
    //Controle que classe existe bien.
    if(empty($this->post['classe'])) {
      header('location:../index.php?message=Soucis d\'enregistrement.');
    }
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
    // transfert $this->post
    $postCost = $this->post;
    $Faction = $this->searchIdFaction($token);
    if(!$Faction) {
      return false;
    }
    // print_r($this->champs);
    // Déclaration de variable
    $set = NULL;
    // Création de la requête
    $index = filter($postCost['classe']);
    $classe = $this->arrayCA[$index]['champs'];
    // [classe] delete
    array_shift($postCost);
    array_pop($postCost);
    // construction de la requête
      foreach ($postCost as $key => $value) {
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
  public function recordDatasTroupe($price, $idNav) {
    $set = NULL;
    $postSet= $this->post;
    // Construire la requête
    $index = filter($this->post['classe']);
    $classe = $this->arrayCA[$index]['updateSet'];
    array_shift($postSet);
    array_pop($postSet);
      foreach ($postSet as $key => $value) {
        $set = ', `'.$key.'` = :'.$key.$set;
      }
    $set = $set.', '.$classe;
    $parametre = new Preparation();
    $param = $parametre->creationPrepIdUser ($this->post);
    $update = "UPDATE `Troupes` SET
              `classe` = :classe
              {$set}
              WHERE `idTroupe` = :idTroupe
              AND `auteur` = :idUser";
    //  ajouter armure, SP et bouclier dans param...
    $action = new RCUD($update, $param);
    $action->CUD();
    header('location:../index.php?idNav='.$idNav.'&idTroupe='.filter($this->post['idTroupe']).'&message=Modification prise en compte.');
  }
}
