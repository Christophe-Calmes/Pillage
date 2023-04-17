<?php
require 'sources/factions/headFaction.php';
$idUser = new Controles();
$id = $idUser->idUser($_SESSION['tokenConnexion']);
$dataFaction = $factions->getOneFactionUser(filter($_GET['idFaction']), $id);
$factions->updateFaction($dataFaction, $idNav, false);
