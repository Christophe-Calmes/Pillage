<?php
$update = "UPDATE `Factions`
SET `nomFaction`= :nomFaction,
`descriptionFaction`= :descriptionFaction,
`factionPrivate`= :factionPrivate,
`valide`= :valide
WHERE `idFaction` = :idFaction AND `auteur` = :idUser";
$parametre = new Preparation();
$param = $parametre->creationPrepIdUser($_POST);
print_r($param);
$action = new RCUD($update, $param);
$action->CUD();
header('location:../'.findTargetRoute(104).'&message=La faction à été modifié.');
