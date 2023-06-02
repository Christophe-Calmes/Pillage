<?php
require 'sources/listes/headArmyList.php';
$id = new Controles();
$idUser = $id->idUser($_SESSION['tokenConnexion']);
$Army->addArmyListe($idNav, $idUser);

require 'javaScript/magicButton.php';
