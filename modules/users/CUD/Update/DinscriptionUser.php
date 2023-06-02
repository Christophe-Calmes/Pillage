<?php
require '../functions/functionToken.php';

// Génération d'un token
$resetToken = genToken (rand(10,12));
print_r($resetToken);

// Encode routage 46 (membre) et 47 Admi
$idCheck = new Controles();
$idUser = $idCheck->idUser($_SESSION['tokenConnexion']);
// Construction de la requête pour invalider le compte.
$update = "UPDATE `users`
          SET `valide`= 0, `token`= :token
          WHERE `idUser` = :idUser";
$param = [['prep'=>':idUser', 'variable'=>$idUser],
          ['prep'=>':token', 'variable'=>$resetToken]];
$action = new RCUD($update, $param);
$action->CUD();
// Déconnexion user
session_destroy();
$_SESSION = array();
// En ligne
//header('location: https://pillage.graines1901.com/');
// En local
header('location:../index.php?idNav=0&message=Vous êtes déconnecté');
