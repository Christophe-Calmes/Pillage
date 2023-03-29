<?php
include '../functions/functionToken.php';
// Controle que le mdp et mdpA sont les mêmes
$mdp = filter($_POST['mdp']);
$mdpA = filter($_POST['mpdA']);
if(($mdp == $mdpA)&&(strlen($mdp) > 9)) {
  // Traitement // MPD : christophe
  array_pop($_POST);
  // Vérification de la taille des éléments
  $elements = [['post'=>'email', 'size'=>80], ['post'=>'prenom', 'size'=>60], ['post'=>'nom', 'size'=>60], ['post'=>'login', 'size'=>60], ['post'=>'mdp', 'size'=>120]];
  foreach ($elements as $key => $value) {
      array_push($controleForm,sizePost(filter($_POST[$value['post']]), $value['size']));
  }
  // Contrôle doublon mail
  $doublon = new Controles();
  $sql = "SELECT`email`FROM `users` WHERE `email` = :email";
  $preparation = ':email';
  $valeur = filter($_POST['email']);
    array_push($controleForm, $doublon->doublon($sql, $preparation , $valeur));
  // Contrôle doublon login
    $sql = "SELECT`login`FROM `users` WHERE `login` = :login";
    $preparation = ':login';
    $valeur = filter($_POST['login']);
      array_push($controleForm, $doublon->doublon($sql, $preparation , $valeur));
  if($controleForm == [0, 0, 0, 0, 0, 0, 0, 0]) {
    $_POST['mdp'] = haschage(filter($_POST['mdp']));
    // Creation d'un primo token
    $_POST['token'] = genToken(16);
    $parametre = new Preparation();
    $param = $parametre->creationPrep ($_POST);
      $insert = "INSERT INTO `users`(`email`, `prenom`, `nom`, `login`, `mdp`, `token`)
      VALUES (:email, :prenom, :nom, :login, :mdp, :token)";
      print_r($param);
      $action = new RCUD($insert, $param);
      $action->CUD();
      //mail(filter($_POST['mail']), 'Votre inscription à', 'Votre token de confirmation:'.$_POST['token'])
    header('location:../index.php?message=Vous avez reçus un mail pour confirmer votre inscription&idNav='.$idNav);
  } else {
    header('location:../index.php?message=Probléme de traitement&idNav='.$idNav);
  }
} else {
  header('location:../index.php?message=Mot de passe non valide');
}
