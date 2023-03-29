<?php
Class PrintUser extends GetUser{
private $role;
private $yes;
  public function __construct() {
    $this->role = ['Visiteur', 'Membre', 'Administrateur'];
    $this->yes = ['Non', 'Oui'];
  }
  public  function userTable ($variable, $idNav) {
    if ($variable == []) {
      echo '<p>Pas de données</p>';
    } else {
    echo '<table>';
      echo '<tr>
            <th>Login</th>
            <th>Role</th>
            <th>Date d\'inscription</th>
            <th>Modifier</th>
          </tr>';
          foreach ($variable as $key => $value) {
            echo '<tr>
                    <td>'.$value['login'].'</td>
                    <td>'.$this->role[$value['role']].'</td>
                    <td>'.brassageDate($value['dateCreation']).'</td>
                    <td>
                      <form action="'.encodeRoutage(14).'" method="post">
                        <label for="valide">Valider</label>
                        <select  id="valide" name="valide">';
                        for ($i=0; $i < count($this->yes) ; $i++) {
                          if($value['valide'] == $i) {
                            echo '<option value="'.$i.'" selected>'.$this->yes[$value['valide']].'</option>';
                          } else {
                            echo '<option value="'.$i.'">'.$this->yes[$i].'</option>';
                          }
                        }
                        echo'</select>
                        <label for="role">Niveau d\'accréditation</label>
                        <select id="role" name="role">';
                          for ($i=0; $i < count($this->role) ; $i++) {
                            if($value['role'] == $i) {
                              echo '<option value="'.$i.'" selected>'.$this->role[$value['role']].'</option>';
                            } else {
                              echo '<option value="'.$i.'">'.$this->role[$i].'</option>';
                            }
                          }
                        echo'</select>
                        <input type="hidden" name="idUser" value="'.$value['idUser'].'" />
                        <button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">Modifier</button>
                      </form>
                    </td>
                  </tr>';
          }
    echo '</table>';}
  }
  public function printProfilUser ($variable) {
    echo '<ul class="listeProfil">';
      echo '<li><h4>Votre profil</h4></li>';
      foreach ($variable as $key => $value) {
        echo '<li>Identité : '.$value['prenom'].' '.$value['nom'].'</li>';
        echo '<li>Pseudo : '.$value['login'].'</li>';
        echo '<li>Role : '.$this->role[$value['role']].'</li>';
        echo '<li>Date d\'inscription : '.brassageDate($value['dateCreation']).'</li>';
      }
    echo '</ul>';
  }

}
