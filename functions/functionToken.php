<?php
function genToken ($size) {
    $alpha = 'abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    for ($i=0; $i < 3 ; $i++) {
        $alpha = str_shuffle($alpha).$alpha;
    }
    $token = NULL;
    for ($i=0 ; $i < $size  ; $i++ ) {
      $number = rand(0, strlen($alpha));
      $letter = substr($alpha, $number, 1);
      $token = $token.$letter;
      //$token =  $token.substr($alpha, rand(0,strlen($alpha)));
    }
    return $token;
}
function IntToken ($size) {
    $alpha = '1234564567890';
    for ($i=0; $i < 6 ; $i++) {
        $alpha = str_shuffle($alpha).$alpha;
    }
    $token = NULL;
    for ($i=0 ; $i < $size  ; $i++ ) {
      $number = rand(0, strlen($alpha));
      $letter = substr($alpha, $number, 1);
      $token = $token.$letter;
      //$token =  $token.substr($alpha, rand(0,strlen($alpha)));
    }
    return $token;
}
