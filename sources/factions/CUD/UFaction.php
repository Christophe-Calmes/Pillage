<?php
$update = "UPDATE `Factions`
SET `nomFaction`= :nomFaction,
`descriptionFaction`= :descriptionFaction,
`factionPrivate`= :factionPrivate,
`valide`= :valide
WHERE `idFaction` = :idFaction";
$parametre = new Preparation();
$param = $parametre->creationPrep($_POST);
print_r($param);
$action = new RCUD($update, $param);
$action->CUD();
header('location:../'.findTargetRoute(101).'&message=La faction à été modifié.');
