<?php
// adressage echo '<form action="'.encodeRoutage(32).'" method="post">';
$arrayControle = [];
$arrayPO = [];
foreach ($_POST as $key => $value) {
  if($key != 'idFaction' || $key != 'indexType') {
    array_push($arrayControle, 1);
    array_push($arrayPO, controlePO($value));
  }
}
// Contrôle si toute les sommes sont entre -1  et 100
if($arrayControle == $arrayPO) {
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
