<?php
require 'sources/factions/headFaction.php';
$dataFaction = $factions->getOneFaction(filter($_GET['idFaction']));
$factions->updateFaction ($dataFaction, $idNav, true);
