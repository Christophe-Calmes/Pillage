<?php

require 'modules/dataSite/objets/getDataSite.php';
require 'modules/dataSite/objets/printDataSite.php';
$dataSite = new PrintDataSite();
$dataSiteDB = $dataSite->getElementSite();
$title = $dataSiteDB[0]['titre'];
$title2 = $dataSiteDB[0]['sousTitre'];
$description = $dataSiteDB[0]['description'];
$titleHeader = $dataSiteDB[0]['titreHTML'];
