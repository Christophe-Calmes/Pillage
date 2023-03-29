<?php
$formInscription = [['name'=>'login', 'message'=>'Votre login', 'type'=>0],
                    ['name'=>'mdp', 'message'=>'Votre mot de passe', 'type'=>9]];
$button = 'Connexion';
formAction(2, $formInscription, 0, $button);
 ?>
 <h3>Vous n'avez pas encore de compte ?</h3>
<a href="<?php echo findTargetRoute(73); ?>">Créer un compte ?</a>
