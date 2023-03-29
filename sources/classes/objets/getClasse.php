<?php
 class Classes {
   public function getClasse($valide) {
     $select = "SELECT `idClasse`, `nomClasse`, `codeClasse`, `deplacement`, `descriptionClasse`, `valide`, `prixClasse` FROM `classes` WHERE `valide` = :valide";
     $param = [['prep'=>':valide', 'variable'=>$valide]];
     $dataClasse = new RCUD($select, $param);
     return $dataClasse->READ();
   }
 }
