<?php
function filter($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
function filterTexte($data) {
  $data = trim($data);
  $data = stripslashes($data);
  return $data;
}
function haschage($data) {
  $option = ['cost' => 10];
  $data = password_hash($data, PASSWORD_BCRYPT, $option);
  return $data;
}
function champsVide($data) {
  $ok = 0;
  foreach ($data as $key => $value) {
    if ($value === '') {
        $ok = 1;
    }
  }
  return $ok;
}
function sizePost($data, $size) {
  if(strlen($data) <= $size) {
    return 0;
  } else {
    return 1;
  }
}
function Qualiter ($arraySize){
  $qualite = array();
  for ($i=0; $i < (count($arraySize)+1) ; $i++) {
    array_push($qualite, 0);
  }
  return $qualite;
}

function borneSelect($data, $maxArray) {
  if(($data >=0)||($data<=$maxArray)) {
    return 0;
  } else {
    return 1;
  }
}

function redirect($data, $idNav) {
  foreach ($data as $key => $value) {
    if ($value === '') {
      return header('location:../../index.php?message=Un champs est vide');
    }
  }
}

 function identification($niveau, $token) {
   // Niveau d'accréditation pour voir la ressource demandé.
   $read = "SELECT `idUser`, `role` FROM `users` WHERE `token` = :token";
   $param = [['prep'=>':token', 'variable'=>$token]];
   $test = new RCUD( $read, $param);
   $dataIdUser = $test->READ();
   if (($dataIdUser[0]['idUser']== $_SESSION['idUser']) && ( $dataIdUser[0]['role'] >= $niveau)) {
     return 1;
   } else {
     return 0;
   }

 }
 function getSecuriter($route) {
  $read = "SELECT `chemin`, `securite` FROM `targetRCUD` WHERE `routageToken` = :routageToken AND `valide` = 1";
  $param = [['prep'=>':routageToken', 'variable'=>$route]];
  $readDB = new RCUD($read, $param);
  $dataTraiter = $readDB->READ();
  if($dataTraiter == []) {
    session_destroy();
    header('location:../../index.php?message=Deconnexion effectuée');
  } else {
    return $dataTraiter;
  }
 }

function findTargetRoute($id) {
  $select ="SELECT  `targetRoute` FROM `navigation` WHERE `idNav` = :idNav";
  $param = [['prep'=>':idNav', 'variable'=>$id]];
  $findRoute = new RCUD($select, $param);
  $route = $findRoute->READ();
  return 'index.php?idNav='.$route[0]['targetRoute'];
}
