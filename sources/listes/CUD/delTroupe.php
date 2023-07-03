<?php
//encodeRoutage(50)
//print_r($_POST);
// Permet de modifier le nombre de troupe dans un groupe définis d'une liste
// Sécurisation des données
          $parametre = new Preparation();
          $param = $parametre->creationPrep($_POST);
          //print_r($param);
          $select = "SELECT `auteurListe`, `CompositionListe`.`idListe`, `CompositionListe`.`idTroupe`, `typeTroupe`
                    FROM `CompositionListe`
                    INNER JOIN `Listes` ON `Listes`.`idListe` = `CompositionListe`.`idListe`
                    INNER JOIN `Troupes` ON `CompositionListe`.`idTroupe` = `Troupes`.`idTroupe`
                    WHERE `idCL` = :idCL";
          $readingDB = new RCUD($select, $param);
          $idAuteur =  $readingDB->READ();
          $idUser = $checkId->idUser($valeur);
          if($idUser == $idAuteur[0]['auteurListe']) {
            $delete = "DELETE FROM `CompositionListe` WHERE `idCL` = :idCL";
            $action = new RCUD($delete, $param);
            $action->CUD();
            // Controle effacement du chef
            if($idAuteur[0]['typeTroupe'] == 1) {
              $chef = false;
              $select = "SELECT `typeTroupe`
                        FROM `CompositionListe`
                        INNER JOIN `Troupes` ON `Troupes`.`idTroupe` = `CompositionListe`.`idTroupe`
                        WHERE `idListe` = :idListe;";
                        $param=[['prep'=>':idListe', 'variable'=>$idAuteur[0]['idListe']]];
                        $readTT = new RCUD($select, $param);
                        $typeTroupe = $readTT->READ();
                          for ($i=0; $i <count($typeTroupe) ; $i++) {
                            if($typeTroupe[$i]['typeTroupe'] == 1) {
                              $chef = true;
                            }
                          }
                            if(!$chef) {
                              $update = "UPDATE `Listes` SET `chefValide` = 0 WHERE `idListe` = :idListe;";
                              $action = new RCUD($update, $param);
                              $action->CUD();
                            }
            }
            // Check si dans la composition il y a au moins un chef. (typeTroupe == 1)
            // Si il n'y en a pas, retirer le chef valide et le passer à 0

            header('location:../index.php?idNav='.$idNav.'&idListe='.$idAuteur[0]['idListe'].'&message=Liste effacées.');
          } else {
            header('location:../index.php?message=Erreur d\'enregistrement.');
          }
