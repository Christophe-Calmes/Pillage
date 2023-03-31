<?php
class SpecialRules {
  public function getSpecialRules($valide) {
    $select = "SELECT `idRS`, `nomRS`, `descriptionRS`,  `prixRS`, `valide` FROM `ReglesSpeciales` WHERE `valide`=:valide";
    $param = [['prep'=>':valide', 'variable'=>$valide]];
    $dataSpecialRules = new RCUD($select, $param);
    return $dataSpecialRules->READ();
  }
}
