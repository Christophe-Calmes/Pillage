<?php
  require 'sources/specialRules/objets/getSpecialRules.php';
  require 'sources/specialRules/objets/printSpecialRules.php';
  $specialRules = new PrintSpecialRules();
  $valide = 1;
  $specialRules->ListeSpecialRules($specialRules->getSpecialRules($valide), $valide, $idNav);
