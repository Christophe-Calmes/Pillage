<?php
//print_r($_POST);
$insert = "INSERT INTO `Talents`(`nomTalent`, `descriptionTalent`, `talentDeTroupe`, `prixTalent`)
            VALUES (:nomTalent, :descriptionTalent, :talentDeTroupe, :prixTalent)";
$parametre = new Preparation();
$param = $parametre->creationPrep ($_POST);
$action = new RCUD($insert, $param);
$action->CUD();
header('location:../index.php?idNav='.$idNav.'&message=Votre nouveau talent est enregistré.');
