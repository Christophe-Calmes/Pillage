<?php
include '../functions/functionToken.php';
//Vérifier le mot de passe :
$select = "SELECT `idUser`, `login`, `mdp`, `role` FROM `users` WHERE `login` = :login AND `valide` = 1";
$param = [['prep'=>':login', 'variable'=>filter($_POST['login'])]];
$readUser = new RCUD($select, $param);
$dataTraiter = $readUser->READ();
if (password_verify(filter($_POST['mdp']), $dataTraiter[0]['mdp'])) {
  //Création du token de connexion
  $token = genToken(16);
    $update = "UPDATE `users` SET `token`= :token WHERE `idUser` = :idUser";
    $param = [['prep'=>':idUser', 'variable'=>$dataTraiter[0]['idUser']], ['prep'=>':token', 'variable'=>$token]];
      $action = new RCUD($update, $param);
      $action->CUD();
        //Identification en session
          $_SESSION['tokenConnexion'] = $token;
          $_SESSION['role'] = $dataTraiter[0]['role'];
          $_SESSION['login'] = $dataTraiter[0]['login'];
              //Enregistrement dans le journal de connexion
                $insert = "INSERT INTO `journaux`(`ipUser`, `idUser`, `login`, `okConnexion`)
                VALUES (:ipUser, :idUser, :login, 1)";
                $log = [['prep'=>':ipUser', 'variable'=>$_SERVER['REMOTE_ADDR']],
                        ['prep'=>':idUser', 'variable'=>$dataTraiter[0]['idUser']],
                        ['prep'=>':login', 'variable'=>$dataTraiter[0]['login']]];
                $log = new RCUD($insert, $log);
                $log->CUD();
              header('location:../index.php?message=bienvenu '.$_SESSION['login']);

} else {
  $insert="INSERT INTO `journaux`(`ipUser`, `login`, `mdpHacker`)
  VALUES (:ipUser, :login, :mdpHacker)";
  $log = [['prep'=>':ipUser', 'variable'=>$_SERVER['REMOTE_ADDR']],
          ['prep'=>':login', 'variable'=>filter($_POST['login'])],
          ['prep'=>':mdpHacker', 'variable'=>filter($_POST['mdp'])],];
  $log = new RCUD($insert, $log);
  $log->CUD();
    header('location:../index.php?message=Erreur d\'authentification');
}
