<?php
require 'sources/armes/objets/getArmes.php';
require 'sources/armes/objets/printArmes.php';
$weapon = new PrintArmes();
$dataWeapon = $weapon->getArmes(0);
$weapon->displayArmes($dataWeapon, 0);
$dataWeapon = $weapon->getArmes(1);
$weapon->displayArmes($dataWeapon, 1);
