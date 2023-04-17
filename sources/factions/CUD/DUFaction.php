<?php
$delete = "DELETE FROM `Factions` WHERE `idFaction` = :idFaction AND valide = 0 AND `auteur` = :idUser";
$parametre = new Preparation();
$param = $parametre->creationPrepIdUser($_POST);
$action = new RCUD($delete, $param);
$action->CUD();
header('location:../'.findTargetRoute(104).'&message=La faction à été effacer.');
