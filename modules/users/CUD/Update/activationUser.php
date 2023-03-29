<?php
//Vérification compte avec le token
$select = "SELECT `mdp` FROM `users` WHERE `valide` = 0 AND `token` = :token AND `login` = :login";
$param = [['prep'=>':token', 'variable'=>filter($_POST['token'])], ['prep'=>':login', 'variable'=>filter($_POST['login'])]];
$readMDP = new RCUD($select, $param);
$dataTraiter = $readMDP->READ();
if(password_verify(filter($_POST['mdp']), $dataTraiter[0]['mdp'])) {
  // Mise à jour du compte
  $update = "UPDATE `users` SET `valide` = 1, `role` = 1 WHERE `token` = :token";
  $param = [['prep'=>':token', 'variable'=>filter($_POST['token'])]];
  $action = new RCUD($update, $param);
  $action->CUD();
    header('location:../index.php?message=Votre compte est actif&idNav='.$idNav);
} else {
  header('location:../index.php?message=Activation échoué&idNav='.$idNav);
}
