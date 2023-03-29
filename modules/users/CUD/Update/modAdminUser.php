<?php
include '../functions/functionToken.php';
$parametre = new Preparation();
$_POST['token'] = IntToken(16);
$param = $parametre->creationPrep($_POST);
$update = "UPDATE `users` SET `token`= :token, `valide`= :valide,`role`= :role WHERE `idUser` = :idUser";
$action = new RCUD($update, $param);
$action->CUD();
header('location:../index.php?idNav='.$idNav.'&message=User modifier');
