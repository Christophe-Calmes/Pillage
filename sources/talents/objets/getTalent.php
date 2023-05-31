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
}
