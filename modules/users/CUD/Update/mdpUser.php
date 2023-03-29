<?php
if((filter($_POST['mdp']) == filter($_POST['mdpA']))&&(strlen(filter($_POST['mdp'])) > 9)) {
  array_pop($_POST);
  $_POST['mdp'] = haschage(filter($_POST['mdp']));
  $parametre = new Preparation();
  $param = $parametre->creationPrepTokenUser ($_POST);
  $update = "UPDATE `users` SET `mdp`= :mdp WHERE `token` = :token";
  $action = new RCUD($update, $param);
  $action->CUD();
  header('location:../index.php?message=Votre mot de passe a été modifié&idNav='.$idNav);
} else {
  header('location:../index.php?message=Nouveau mot de passe invalide&idNav='.$idNav);
}
