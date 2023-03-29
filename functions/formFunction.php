<?php
function encodeRoutage($id) {
  $param = [['prep'=>':idForm', 'variable'=>$id]];
  $select = "SELECT `route` FROM `routageForm` WHERE `idForm` = :idForm AND `valide` = 1";
  $readTarget = new RCUD($select, $param);
  $data = $readTarget->READ();
  return 'formulaires/DBaccess.php?route='.$data[0]['route'];
}
function formAction($id, $variable, $idNav, $button) {
  // Idnav On / off => $idNav = 0
  if($idNav == 0) {
    $NavButton = '<button class="buttonForm" type="submit" name="idNav" value="0">'.$button.'</button>';
  } else {
    $NavButton = '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">'.$button.'</button>';
  }
$type =  ['text',  'date', 'time', 'email',
'datetime-local', 'file', 'hidden',
'month', 'number', 'password', 'radio', 'range', 'search', 'checkbox', 'url' ];
  echo '<form class="formulaireClassique" action="'.encodeRoutage($id).'" method="post">';
  foreach ($variable as $key => $value) {
    echo '<label for="'.$value['name'].'">'.$value['message'].'</label>
            <input id="'.$value['name'].'" type="'.$type[$value['type']].'" name="'.$value['name'].'" required>';
  }
  echo $NavButton;
  echo '</form>';
}
function formModification($id, $variable, $idNav, $button) {
  // Idnav On / off => $idNav = 0
  if($idNav == 0) {
    $NavButton = '<button class="buttonForm" type="submit" name="idNav" value="0">'.$button.'</button>';
  } else {
    $NavButton = '<button class="buttonForm" type="submit" name="idNav" value="'.$idNav.'">'.$button.'</button>';
  }
$type =  ['text',  'date', 'time', 'email',
'datetime-local', 'file', 'hidden',
'month', 'number', 'password', 'radio', 'range', 'search', 'checkbox', 'url' ];
  echo '<form class="formulaireClassique" action="'.encodeRoutage($id).'" method="post">';
  foreach ($variable as $key => $value) {
    echo '<label for="'.$value['name'].'">'.$value['message'].'</label>
            <input id="'.$value['name'].'" type="'.$type[$value['type']].'" name="'.$value['name'].'" value="'.$value['lastInput'].'" required>';
  }
  echo $NavButton;
  echo '</form>';
}
