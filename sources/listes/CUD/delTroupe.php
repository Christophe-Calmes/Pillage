<?php
//encodeRoutage(50)
print_r($_POST);
// Permet de modifier le nombre de troupe dans un groupe définis d'une liste
// Sécurisation des données
          $parametre = new Preparation();
          $param = $parametre->creationPrep($_POST);
          //print_r($param);
          $select = "SELECT `auteurListe`, `CompositionListe`.`idListe`
                    FROM `CompositionListe`
                    INNER JOIN `Listes` ON `Listes`.`idListe` = `CompositionListe`.`idListe`
                    WHERE `idCL` = :idCL";
          $readingDB = new RCUD($select, $param);
          $idAuteur =  $readingDB->READ();
          $idUser = $checkId->idUser($valeur);
          if($idUser == $idAuteur[0]['auteurListe']) {
            $delete = "DELETE FROM `CompositionListe` WHERE `idCL` = :idCL";
            $action = new RCUD($delete, $param);
            $action->CUD();
            header('location:../index.php?idNav='.$idNav.'&idListe='.$idAuteur[0]['idListe'].'&message=Liste créer.');
          } else {
            header('location:../index.php?message=Erreur d\'enregistrement.');
          }
