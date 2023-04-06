<?php
Class GetArmes {
  public function getArmes ($type) {
    // $type prend la valeur 0 pour les armes de tir et 1 pour les armes de contact
    $select = "SELECT `nomArme`, `descriptionArme`, `contact`, `distance` FROM `Armes` WHERE `contact` = :contact ORDER BY `nomArme`";
    $param = [['prep'=>':contact', 'variable'=>$type]];
    $request = new RCUD($select, $param);
    return $request->READ();
  }
}
