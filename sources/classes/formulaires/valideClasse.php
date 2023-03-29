<?php
$update = "UPDATE `classes` SET `valide`= 1 WHERE `idClasse` = :idClasse";
$parametre = new Preparation();
$param = $parametre->creationPrep ($_POST);
$action = new RCUD($update, $param);
$action->CUD();
header('location:../index.php?idNav='.$idNav.'&message=Votre classe est valide.');
