<?php

$sizeTable = [50, 120, 100, 255];
$postKey = array_keys($_POST);
for ($i=0; $i < count($postKey) ; $i++) {
array_push($controleForm, sizePost(filter($_POST[$postKey[$i]]), $sizeTable[$i]));
}
$qualiter = Qualiter($sizeTable);

if($qualiter == $controleForm) {
  $parametre = new Preparation();
  $param = $parametre->creationPrep ($_POST);
  $update = "UPDATE `dataSite`
  SET `titre`=:titre,`sousTitre`=:sousTitre,`description`=:description,`titreHTML`=:titreHTML
  WHERE `idDataSite` = 1";
    $action = new RCUD($update, $param);
    $action->CUD();
    header('location:../index.php?idNav='.$idNav.'&message=Update du site pris en compte');
} else {
  header('location:../index.php?idNav='.$idNav.'&message=Un des champs est trop long');
}


 ?>
