<?php
//encoderoutage 31
// Contrôle si toute les sommes sont entre -1  et 100

//print_r(controleGrille($_POST, filter($_POST['indexType'])));
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
  echo 'Not Error';
  print_r($_POST);
  header('location:../index.php?idNav='.$idNav.'&idFaction='.$_POST['idFaction'].'&message=Grille mise à jour.');
} else {
  echo 'Error<br />';
  print_r($_POST);
header('location:../index.php?idNav='.$idNav.'&idFaction='.$_POST['idFaction'].'&message=Soucis d\'enregistrement.');
}
