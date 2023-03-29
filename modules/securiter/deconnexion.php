<?php
  session_destroy();
  $_SESSION = array();
  // En ligne
  //header('location: https://rtd.graines1901.com/');
  // En local
  header('location:index.php?message=Vous êtes déconnecté');
