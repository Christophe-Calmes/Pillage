<?php
class TroupeRecord extends PrintGrilles {
  private $arrayCA;
  public function __construct($post) {
    parent::__construct();
    $this->arrayCA = [['champs'=>'`SP`', 'set'=>', :SP', 'updateSet' => '`SP` = 1'],
                      ['champs'=>'`armure`', 'set'=>', :armure' , 'updateSet' => '`armure` = 1'],
                      ['champs'=>'`bouclier`', 'set'=>', :bouclier', 'updateSet' => '`bouclier` = 1'],
                      ['champs'=>'`armure` + `bouclier`', 'set'=>', :armure, :bouclier', 'updateSet' => '`armure` = 1, `bouclier` = 1']];
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
  public function cavalierOrShooter($idTroupe) {
    $select = "SELECT  `cheval`,`javelot`, `arc`, `arbalete`, `fronde`
                FROM `Troupes`
                WHERE `idTroupe` = :idTroupe";
      $param = [['prep'=>':idTroupe', 'variable'=>$idTroupe]];
      $readOneTroupe = new RCUD($select, $param);
      $data = $readOneTroupe->READ();
      $type = [];
      //print_r($data);
      if($data[0]['cheval'] != NULL) {
        array_push($type, 1);
      } else {
        array_push($type, 0);
      }
      if(($data[0]['javelot'] != NULL)||($data[0]['arc'] != NULL)||($data[0]['arbalete'] != NULL)||($data[0]['fronde'] != NULL)) {
          array_push($type, 1);
      } else {
          array_push($type, 0);
      }
    $update = "";
    print_r($type);
    switch ($type) {
      case [1, 1]:
        $update = "UPDATE `Troupes` SET `monture` = 1, `tireur` = 1 WHERE `idTroupe` = :idTroupe";
        break;
      case [0, 1]:
        $update = "UPDATE `Troupes` SET `monture` = 0, `tireur` = 1 WHERE `idTroupe` = :idTroupe";
        break;
      case [1, 0]:
        $update = "UPDATE `Troupes` SET `monture` = 1, `tireur` = 0 WHERE `idTroupe` = :idTroupe";
        break;

      default:
        $update = "UPDATE `Troupes` SET `monture` = 2, `tireur` = 2 WHERE `idTroupe` = :idTroupe";
        break;
    }
    $param = [['prep'=>':idTroupe', 'variable'=>$idTroupe]];
    $action = new RCUD($update, $param);
    $action->CUD();
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
    // seach price
    //print_r($select);
    $read = new RCUD($select, $param);
    $data = $read->READ();
    return $data[0]['price'];
  }
  public function recordDatasTroupe($price, $idNav) {
    //Reset debut
    $reset = "UPDATE `Troupes` SET `classe`= NULL,`monture`= 0,`prixTroupe`= NULL,`arbalete`= NULL,`arc`= NULL,`armeDeBase`= NULL,
    `armeImp`= NULL,`armure`= NULL,`banniere`= NULL,`bouclier`= NULL,`cheval`= NULL,`chienDG`= NULL,`corDG`= NULL,`fronde`= NULL,`hacheD`= NULL,
    `javelot`= NULL, `lance`= NULL,`SP`= 0, `monture`= 0, `tireur`= 0
    WHERE `idTroupe` = :idTroupe";
    $param = [['prep'=>':idTroupe', 'variable'=> filter($this->post['idTroupe'])]];
    $action = new RCUD($reset,$param);
    $action->CUD();
    //Reset debut
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

    // New equipement
    $update = "UPDATE `Troupes` SET
              `classe` = :classe,
              `prixTroupe` = {$price}
              {$set}
              WHERE `idTroupe` = :idTroupe
              AND `auteur` = :idUser";
    $action = new RCUD($update, $param);
    $action->CUD();
    // New equipement
    // Type de troupe
    $this->cavalierOrShooter(filter($this->post['idTroupe']));
    header('location:../index.php?idNav='.$idNav.'&idTroupe='.filter($this->post['idTroupe']).'&message=Modification prise en compte.');
  }

}
