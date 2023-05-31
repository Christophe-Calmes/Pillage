<?php
Class GetTalent {
  protected function getAllTalent($valide) {
    $select = "SELECT `idTalent`, `nomTalent`, `descriptionTalent`, `talentDeTroupe`, `prixTalent`, `valide`
              FROM `Talents`
              WHERE `valide`=:valide";
    $param = [['prep'=>':valide', 'variable'=>$valide]];
    $read = new RCUD($select, $param);
    return $read->READ();
  }
  protected function getOneTalent($id) {
    $select ="SELECT `nomTalent`, `descriptionTalent`, `talentDeTroupe`, `prixTalent`, `valide` FROM `Talents` WHERE `idTalent` = :idTalent";
    $param = [['prep'=>':idTalent', 'variable'=>$id]];
    $read = new RCUD($select, $param);
    return $read->READ();
  }
    public function nombreTalents() {
      $count = "SELECT COUNT(`idTalent`) AS `nbrTalent` FROM `Talents` WHERE `valide` = 1";
      $nrbC = new RCUD($count, []);
      $dataNbrC = $nrbC->READ();
      return $dataNbrC[0]['nbrTalent'];

    }
    public function paginationTalent($first, $parPage) {
      $select = "SELECT `idTalent`, `nomTalent`, `descriptionTalent`, `talentDeTroupe`, `prixTalent`, `valide`
        FROM `Talents`
        WHERE `valide` = 1
        ORDER BY `nomTalent` DESC LIMIT {$first}, {$parPage};";
        $read = new RCUD($select, []);
        return $read->READ();
    }
}
