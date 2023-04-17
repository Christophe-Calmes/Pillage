<?php
$delete = "DELETE FROM `Factions` WHERE `idFaction` = :idFaction AND valide = 0";
$parametre = new Preparation();
$param = $parametre->creationPrep($_POST);
$action = new RCUD($delete, $param);
$action->CUD();
header('location:../'.findTargetRoute(101).'&message=La faction à été effacer.');
