<?php
// Contrôle doublon login
$doublon = new Controles();
  $sql = "SELECT`login`FROM `users` WHERE `login` = :login";
  $preparation = ':login';
  $valeur = filter($_POST['login']);
    array_push($controleForm, $doublon->doublon($sql, $preparation , $valeur));
  if($controleForm == [0, 0]) {
    $parametre = new Preparation();
    $param = $parametre->creationPrepTokenUser ($_POST);
    $update = "UPDATE `users` SET `login`= :login WHERE `token` = :token";
    $action = new RCUD($update, $param);
    $action->CUD();
    header('location:../index.php?message=Votre login a été modifié&idNav='.$idNav);
  } else {
    header('location:../index.php?message=Votre login non valable.&idNav='.$idNav);
  }
