<?php
Class CUDTalent {
  private $post;
  public function __construct($post) {
    // $post = Variable globale $_POST
    $this->post = $post;
  }
  public function deleteFactions () {
    $idTalent = filter($this->post['idTalent']);
    $delete = "DELETE FROM `lienTalentFaction` WHERE `idTalent` = :idTalent";
    $param = [['prep'=>':idTalent', 'variable'=>$idTalent]];
    $action = new RCUD($delete, $param);
    $action->CUD();
    return true;
  }
  public function addAllFaction () {
    $idTalent = $this->post['idTalent'];
    unset($this->post['idTalent']);
      foreach ($this->post as $key => $value) {
        // Sanitize $key
        $key = str_replace("_", " ", $key);
        $select = "SELECT `idFaction` FROM `Factions` WHERE `nomFaction` = '{$key}'";
        $readDB = new RCUD($select, []);
        $idFaction = $readDB->READ();
        $insert = "INSERT INTO `lienTalentFaction`(`idFaction`, `idTalent`) VALUES (:idFaction, :idTalent)";
        $param = [['prep'=>':idFaction', 'variable'=>$idFaction[0]['idFaction']],
                  ['prep'=>'idTalent', 'variable'=>$idTalent]];
        $action = new RCUD($insert, $param);
        $action->CUD();
      }
      return true;
  }
  public function deleteOneFaction() {
    $delete = "DELETE FROM `lienTalentFaction`
              WHERE `idlienTF` = :idlienTF";
    $param = [['prep'=>':idlienTF', 'variable'=>$this->post['idlienTF']]];
    //print_r($this->post['idlienTF']);
    $action = new RCUD($delete, $param);
    $action->CUD();
    return true;
  }
  public function verificationAffectationRecord() {
    $idsFaction = array();
    //print_r($this->post);
    $idTalent = $this->post['idTalent'];
    unset($this->post['idTalent']);
    // Extraction des idFactions
    foreach ($this->post as $key => $value) {
      // Sanitize $key
      $key = str_replace("_", " ", $key);
      $select = "SELECT `idFaction` FROM `Factions` WHERE `nomFaction` = '{$key}'";
      $readDB = new RCUD($select, []);
      $idFaction = $readDB->READ();
      //print_r($idFaction);
      array_push($idsFaction, $idFaction[0]['idFaction']);
    }
    // Record if doesn't exist
    for ($i=0; $i <count($idsFaction) ; $i++) {
        $select = "SELECT `idlienTF`
                  FROM `lienTalentFaction`
                  WHERE `idFaction` = :idFaction AND `idTalent`=:idTalent";
        $param = [['prep'=>':idFaction', 'variable'=>$idsFaction[$i]], ['prep'=>':idTalent', 'variable'=>$idTalent]];
        $check = new RCUD($select, $param);
        $checkId = $check->READ();
        //print_r($checkId);
        // Record
        if(empty($checkId)) {
          $insert = "INSERT INTO `lienTalentFaction`(`idFaction`, `idTalent`) VALUES (:idFaction, :idTalent)";
          $action = new RCUD($insert, $param);
          $action->CUD();
        }
    }
    return true;
  }
}
