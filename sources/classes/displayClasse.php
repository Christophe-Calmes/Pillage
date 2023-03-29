<?php
require 'objets/getClasse.php';
require 'objets/printClasse.php';
$classes = new PrintClasses();
$valideClasse = 1;
 $classes->ListeClasse($classes->getClasse($valideClasse), $valideClasse, $idNav);
