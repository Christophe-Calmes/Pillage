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
}
