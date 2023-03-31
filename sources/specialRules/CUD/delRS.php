<?php
// encodeRoutage(25)
$parametre = new Preparation();
$param = $parametre->creationPrep ($_POST);
$delete = "DELETE FROM `ReglesSpeciales` WHERE `idRS`= :idRS";
$action = new RCUD($delete, $param);
$action->CUD();
header('location:../index.php?idNav='.$idNav.'&message=Règle spéciales effacé.');
