<?php
// route form 43
//print_r($_POST);
// Nettoyage ancienne affectation
$idTalent = filter($_POST['idTalent']);
array_pop($_POST);
// Effacer les anciennes données
$delete = "DELETE FROM `lienTalentFaction` WHERE `idTalent` = :idTalent";
$param = [['prep'=>':idTalent', 'variable'=>$idTalent]];
$action = new RCUD($delete, $param);
$action->CUD();
//print_r($_POST);
// Construction de la requête
//$param = array();

foreach ($_POST as $key => $value) {
    $select = "SELECT `idFaction` FROM `Factions` WHERE `nomFaction` = '{$key}'";
    //print_r($select);
    //echo '<br/>';

    $readDB = new RCUD($select, []);
    $idFaction = $readDB->READ();
    print_r($idFaction);
    $insert = "INSERT INTO `lienTalentFaction`(`idFaction`, `idTalent`) VALUES (:idFaction, :idTalent)";
    $param = [['prep'=>':idFaction', 'variable'=>$idFaction[0]['idFaction']],
              ['prep'=>'idTalent', 'variable'=>$idTalent]];
    $action = new RCUD($insert, $param);
    $action->CUD();

}
header('location:../index.php?idNav='.$idNav.'&idTalent='.$idTalent.'&messagae=Talent affecté.');
