<?php
//encodeRoutage(49)
// Permet de modifier le nombre de troupe dans un groupe définis d'une liste
// Sécurisation des données
          $parametre = new Preparation();
          $param = $parametre->creationPrep($_POST);
          //print_r($param);
          $paramSecure = [['prep'=>':idCL', 'variable'=>filter($_POST['idCL'])]];
          $select = "SELECT `auteurListe`, `CompositionListe`.`idListe`
                    FROM `CompositionListe`
                    INNER JOIN `Listes` ON `Listes`.`idListe` = `CompositionListe`.`idListe`
                    WHERE `idCL` = :idCL";
          $readingDB = new RCUD($select, $paramSecure);
          $idAuteur =  $readingDB->READ();
          $idUser = $checkId->idUser($valeur);
          if($idUser == $idAuteur[0]['auteurListe']) {
            $update = "UPDATE `CompositionListe` SET `nombreTroupe` = :nombreTroupe WHERE `idCL`  = :idCL";
            $action = new RCUD($update, $param);
            $action->CUD();
            header('location:../index.php?idNav='.$idNav.'&idListe='.$idAuteur[0]['idListe'].'&message=Liste créer.');
          } else {
            header('location:../index.php?message=Erreur d\'enregistrement.');
          }
