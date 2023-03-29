<?php
$formInscription = [['name'=>'email', 'message'=>'Votre email', 'type'=>0],
                    ['name'=>'prenom', 'message'=>'Votre prenom', 'type'=>0],
                    ['name'=>'nom', 'message'=>'Votre nom', 'type'=>0],
                    ['name'=>'login', 'message'=>'Votre login', 'type'=>0],
                    ['name'=>'mdp', 'message'=>'Votre mot de passe', 'type'=>9],
                    ['name'=>'mpdA', 'message'=>'Confirmer votre mot de passe', 'type'=>9]];
$button = 'Creation compte';
echo '<h3>Création d\'un compte</h3>';
formAction(1, $formInscription, $idNav, $button);
$formConfirmation = [['name'=>'login', 'message'=>'Votre login', 'type'=>0],
                    ['name'=>'mdp', 'message'=>'Votre mot de passe', 'type'=>9],
                    ['name'=>'token', 'message'=>'Votre token', 'type'=>0]];
$button = 'Activation du compte';
echo '<h3>Activation de votre compte</h3>';
formAction(3, $formConfirmation, $idNav, $button);
