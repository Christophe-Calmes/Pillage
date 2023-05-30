<?php
require 'sources/talents/headTalent.php';
$talents->formTalent($idNav, 40);
$talents->adminTalent(1, $idNav);
$talents->adminTalent(0, $idNav);
require 'javaScript/magicButton.php';
