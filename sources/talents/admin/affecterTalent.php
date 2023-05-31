<?php
require 'sources/talents/headTalent.php';
// id navigation 119
$idTalent = filter($_GET['idTalent']);
$talents->affecterTalentFaction($idTalent, $idNav);
