<?php
Class GetDataSite {
  public function getElementSite() {
    $select = "SELECT `titre`, `sousTitre`, `description`, `titreHTML` FROM `dataSite` WHERE `idDataSite` = 1";
    $void = array();
    $readDataSite = new RCUD($select, $void);
    return $readDataSite->READ();
  }
}
