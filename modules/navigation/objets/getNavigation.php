<?php
Class GetNavigation {
  public function getNav($zoneMenu) {
    //niveau => élément lier à l'autorisation
    //Zone menu=>Zone du menu déroulant
    // Déroulant => Si le menu est un menu déroulant et le quel.
    $select = "SELECT `nomNav`, `cheminNav`, `zoneMenu`, `ordre`, `niveau`, `valide`, `deroulant`, `targetRoute`
    FROM `navigation`
    WHERE `valide` = 1 AND `niveau` = :niveau AND `menuVisible` = 1 AND `zoneMenu` = 0
    ORDER BY `ordre`";
    $param = [['prep'=>':niveau', 'variable'=>$zoneMenu]];
    $dataNav = new RCUD($select, $param);
    return $dataNav->READ();
  }
  public function getContenus($idNav) {
    $select = "SELECT  `cheminNav`,  `niveau`, `targetRoute` FROM `navigation` WHERE `targetRoute` = :targetRoute AND  `valide` = 1";
    $param = [['prep'=>':targetRoute', 'variable'=>$idNav]];
    $getNav = new RCUD($select, $param);
    return $getNav->READ();
  }
  public function getFrom($idRoute) {
    $select = "SELECT `chemin`, `securiter` FROM `routageForm` WHERE `valide` = 1 AND `route` = :route";
    $param = [['prep'=>':route', 'variable'=>$idRoute]];
    $traitement = new RCUD($select, $param);
    return $traitement->READ();
  }
  public function getMenuDeroulant() {
    $select = "SELECT `idMenuDeroulant`, `titreMenu` FROM `menuNav`";
    $void = array();
    $readData = new RCUD($select, $void);
    return $readData->READ();
  }
  public function toutesRoutesForm() {
      $select = "SELECT `idForm`, `chemin`, `securiter` FROM `routageForm` WHERE `valide` = 1 ORDER BY `securiter` DESC, `idForm`";
      $void = array();
      $readData = new RCUD($select, $void);
      return $readData->READ();
  }
}
