<?php
class Controles {
  public function doublon($sql, $preparation , $valeur) {
    /* $sql doit être une requette sql, $préparation doit prendre
    la forme :preparation et $valeur c'est la valeur du doublon à tester.*/
    $param = $param = [['prep'=>$preparation, 'variable'=>$valeur]];
    $controle = new RCUD ($sql, $param);
    $test = $controle->READ();
    $preparation = trim($preparation, ':');
    if(empty($test[0][$preparation])) {
      return 0;
    } else {
      return 1;
    }
  }

  function __destruct() {
  }
}
