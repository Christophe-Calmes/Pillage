<?php
class Preparation {
  public function creationPrep ($data) {
    foreach ($data as $key => $value) {
      $prepare = array();
      foreach ($data as $key => $value) {
        $value = filter($value);
        array_push($prepare, ['prep' => ':'.$key, 'variable' => $value]);
      }
    }
    return $prepare;
  }
  public function creationPrepIdUser ($data) {
    // Recherche de idUser
    $select="SELECT `idUser` FROM `users` WHERE `token` = :token";
    $parametre = [['prep'=>':token', 'variable'=> $_SESSION['tokenConnexion']]];
    $user = new RCUD($select, $parametre);
    $dataId = $user->READ();
    // Préparation de la rêquete avec identification de l'auteur
    foreach ($data as $key => $value) {
      $prepare = array();
      foreach ($data as $key => $value) {
        $value = filter($value);
        array_push($prepare, ['prep' => ':'.$key, 'variable' => $value]);
      }
    }
      array_push($prepare, ['prep' => ':idUser', 'variable' => $dataId[0]['idUser']]);
      return $prepare;
  }
  public function creationPrepTokenUser ($data) {
    foreach ($data as $key => $value) {
      $prepare = array();
      foreach ($data as $key => $value) {
        $value = filter($value);
        array_push($prepare, ['prep' => ':'.$key, 'variable' => $value]);
      }
    }
      array_push($prepare, ['prep' => ':token', 'variable' => $_SESSION['tokenConnexion']]);
      return $prepare;
  }
}
