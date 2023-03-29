<?php
//Contrôle doublon mail
$doublon = new Controles();
$sql = "SELECT`email`FROM `users` WHERE `email` = :email";
$preparation = ':email';
$valeur = filter($_POST['email']);
  array_push($controleForm, $doublon->doublon($sql, $preparation , $valeur));
  if($controleForm == [0, 0]) {
    $parametre = new Preparation();
    $param = $parametre->creationPrepTokenUser ($_POST);
    $update = "UPDATE `users` SET `email`= :email WHERE `token` = :token";
    $action = new RCUD($update, $param);
    $action->CUD();
    header('location:../index.php?message=Votre email a été modifié&idNav='.$idNav);
  } else {
    header('location:../index.php?message=Votre email non valable.&idNav='.$idNav);
  }
