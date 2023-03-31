<?php
// administrateur | sources/specialRules/CUD/updateRS.php |Action => encodeRoutage(24)
$parametre = new Preparation();
$param = $parametre->creationPrep ($_POST);
$select="SELECT `valide` FROM `ReglesSpeciales` WHERE `idRS`=:idRS";
$dataValide = new RCUD($select, $param);
$readValide = $dataValide->READ();
$message = ["Règle spéciale est invalide.", "Règle spéciale est valide."];
if($readValide[0]['valide'] == 1) {
  $update = "UPDATE `ReglesSpeciales` SET  `valide`= 0 WHERE `idRS`= :idRS";
  $oneMessage = $message[0];
} else {
  $update = "UPDATE `ReglesSpeciales` SET `valide`= 1 WHERE `idRS`= :idRS";
  $oneMessage = $message[1];
}
$action = new RCUD($update, $param);
$action->CUD();
header('location:../index.php?idNav='.$idNav.'&message='.$oneMessage);
