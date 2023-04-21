<?php
if(controleGrille($_POST, 1)) {
  $parametre = new Preparation();
  $param = $parametre->creationPrep ($_POST);
  $update = "UPDATE `cout` SET `coutBase`=:coutBase,
  `SP`=:SP,`armure`=:armure,`bouclier`=:bouclier,
  `armeImp`=:armeImp,`lance`=:lance,`armeDeBase`=:armeDeBase,
  `hacheD`=:hacheD,`fronde`=:fronde,`javelot`=:javelot,
  `arc`=:arc,`arbalete`=:arbalete,`cheval`=:cheval,
  `banniere`=:banniere,`corDG`=:corDG,
  `chienDG`=:chienDG
  WHERE `indexType` = :indexType AND`idFaction` = :idFaction";
  $action = new RCUD($update, $param);
  $action->CUD();
  header('location:../index.php?idNav='.$idNav.'&idFaction='.$_POST['idFaction'].'&message=Grille mise à jour.');
} else {
  header('location:../index.php?idNav='.$idNav.'&idFaction='.$_POST['idFaction'].'&message=Soucis d\'enregistrement.');
}
