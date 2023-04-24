<?php
//encodeRoutage(35)
// Contrôle propriétaire Faction
//Etape 1 : Collecter idUser
$idUser = $checkId->idUser($valeur);
//Etape 2 : Vérifier que la faction est bien la propriété de l'utilisateur
$param = [['prep'=>':idFaction', 'variable'=>filter($_POST['idFaction'])],
          ['prep'=>':auteur', 'variable'=>$idUser]];
$select = "SELECT `factionPrivate` FROM `Factions`
WHERE `idFaction` = :idFaction AND `auteur`= :auteur AND `valide` = 1";
$checkOwner = new RCUD($select, $param);
$dataOwner = $checkOwner->READ();
if($dataOwner != []) {
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
} else {
  // Tester, en cas de tentative de piratage => Déconnexion
  header('location:../index.php?idNav='.findTargetRoute(75));
}
