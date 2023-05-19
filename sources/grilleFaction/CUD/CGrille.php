<?php
//encoderoutage 31
// Contrôle si toute les sommes sont entre -1  et 100
if(controleGrille($_POST, filter($_POST['indexType']))) {
  $insert = "INSERT INTO `cout`(`indexType`, `coutBase`, `idFaction`, `SP`,
    `armure`, `bouclier`, `armeImp`, `lance`, `armeDeBase`, `hacheD`, `fronde`,
    `javelot`, `arc`, `arbalete`, `cheval`, `banniere`, `corDG`, `chienDG`)
    VALUES (:indexType, :coutBase, :idFaction, :SP,
      :armure, :bouclier, :armeImp, :lance, :armeDeBase, :hacheD, :fronde,
      :javelot, :arc, :arbalete, :cheval, :banniere, :corDG, :chienDG)";
  $parametre = new Preparation();
  $param = $parametre->creationPrep($_POST);
  $action = new RCUD($insert, $param);
  $action->CUD();
  header('location:../index.php?idNav='.$idNav.'&idFaction='.$_POST['idFaction'].'&message=Grille mise à jour.');
} else {
  header('location:../index.php?idNav='.$idNav.'&idFaction='.$_POST['idFaction'].'&message=Soucis d\'enregistrement.');
}
