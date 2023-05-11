<?php
// Fonction spécifique
function detection ($data, $fields) {
  $set = NULL;
  foreach ($data as $key => $value) {
    if(in_array($key, $fields)) {
      $index = array_search($key, $fields);
      $set = ':'.$key.', '.$set;
    }
  }
  // Retirer la dernière virgule
  $set = substr($set, 0, -2);
  return $set;
}

//encodeRoutage(39)
require '../sources/grilleFaction/objets/getGrilles.php';
require '../sources/grilleFaction/objets/printGrilles.php';
$Grilles = new PrintGrilles();
$fields = $Grilles->setChamps();
$set = detection($_POST, $fields);

// Sauvegarde de $_POST
$backPost = $_POST;
print_r($backPost);
echo '<br/>';
// Nettoyage pour la table : Troupe
foreach ($backPost as $key => $value) {
  if($value == 'on') {
    unset($backPost[$key]);
  }
}
print_r($backPost);

/*
$tableau = array(
    array("nom" => "Jean", "age" => 30),
    array("nom" => "Marie", "age" => 25),
    array("nom" => "Pierre", "age" => 40)
);

foreach ($tableau as $key => $value) {
    if ($value["nom"] == "Marie") {
        $tableau[$key]["age"] = 26; // Remplace la valeur de "age" si le nom est "Marie"
    }
}

print_r($tableau);

*/


$parametre = new Preparation();
$param = $parametre->creationPrep ($backPost);
echo '<br/>';
print_r($param);


// Construction de la requête en fonction du POST

/*
$tableauRelationnel = array(
    array('id' => 1, 'nom' => 'Pierre'),
    array('id' => 2, 'nom' => 'Paul'),
    array('id' => 3, 'nom' => 'Jacques')
);

$tableauSimple = array('Pierre', 'Jacques');

foreach ($tableauRelationnel as $ligne) {
    if (in_array($ligne['nom'], $tableauSimple)) {
        $index = array_search($ligne['nom'], $tableauSimple);
        echo "L'index de la correspondance pour {$ligne['nom']} est : $index\n";
    }
}
*/
