<?php
// Contrôle si toute les sommes sont entre -1  et 100
//encodeRoutage(34)
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

if(!empty($dataOwner)) {
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

} else {
  // Tester, en cas de tentative de piratage => Déconnexion
  header('location:../index.php?idNav='.findTargetRoute(75));
}
