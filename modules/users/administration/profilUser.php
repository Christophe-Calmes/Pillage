<?php
  require 'functions/functionDateTime.php';
  require 'functions/functionToken.php';
  require 'modules/users/objets/getUser.php';
  require 'modules/users/objets/printUser.php';
  $user = new PrintUser();
  $dataUser = $user->getProfil($_SESSION['tokenConnexion']);
  echo '<div class="flex-rows">';
  echo '<article>';
  $user->printProfilUser ($dataUser);
  echo '</article>';
  echo '<aside class="flex-colonne">';
  // Modifier step by step
  //Email
  $formModifierProfil = [['name'=>'email', 'message'=>'Votre email', 'type'=>0, 'lastInput'=>$dataUser[0]['email']]];
    $button = 'Modifier email';
  formModification(16, $formModifierProfil, $idNav, $button);
  //Login
  $formModifierProfil = [['name'=>'login', 'message'=>'Votre pseudo', 'type'=>0, 'lastInput'=>$dataUser[0]['login']]];
    $button = 'Modifier pseudo';
  formModification(17, $formModifierProfil, $idNav, $button);
  //mdp
  $formModifierProfil = [['name'=>'mdp', 'message'=>'Votre nouveau mot de passe', 'type'=>0, 'lastInput'=>genToken (12)],
                        ['name'=>'mdpA', 'message'=>'Confirmer votre nouveau mot de passe', 'type'=>9, 'lastInput'=>'????']];
    $button = 'Modifier mot de passe';
  formModification(18, $formModifierProfil, $idNav, $button);
  echo '</aside>';
echo '</div>';
