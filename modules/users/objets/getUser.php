<?php
Class GetUser {
  public function getUserCurrentPage($premier, $parPage, $valide) {
    $select = "SELECT `idUser`, `login`, `role`, `dateCreation`, `valide` FROM `users` WHERE `valide`  = :valide ORDER BY `login` LIMIT {$premier}, {$parPage}";
    $param = [['prep'=>':valide', 'variable'=>$valide]];
    $readUsersPage = new RCUD($select, $param);
    return $readUsersPage->READ();
  }
  public function getProfil($token) {
    $select = "SELECT `token`, `email`, `prenom`, `nom`, `login`,`role`, `dateCreation`
    FROM `users`
    WHERE `token` = :token";
    $param = [['prep'=>':token', 'variable'=>$token]];
    $readProfil = new RCUD($select, $param);
    return $readProfil->READ();
  }
}
