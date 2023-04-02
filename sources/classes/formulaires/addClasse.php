<?php
// Vérification spécifique
$_POST['codeClasse'] = strtoupper($_POST['codeClasse']);
if(sizePost($_POST['codeClasse'], 2) == 0) {
  // Préparation
  $preparation = new Preparation();
  $param = $preparation->creationPrep($_POST);
  // insert in DB
  $select = "INSERT INTO `classes`(`nomClasse`, `codeClasse`, `deplacement`, `cavalerie`, `descriptionClasse`) VALUES (:nomClasse, :codeClasse, :deplacement, :cavalerie,:descriptionClasse)";
  $record = new RCUD($select, $param);
  $recordClasse = $record->CUD();
  header('location:../index.php?idNav='.$idNav.'&message=Votre nouvelle classe à été enregistré.');
} else {
  header('location:../index.php?idNav='.$idNav.'&message=Votre code de Classe n\'est pas conforme.');
}
