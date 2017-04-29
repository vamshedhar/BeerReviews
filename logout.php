<?php
  include("dbconnect.php");
  include("models/models.php");

  setcookie("username", "", time() - 1000);
  session_destroy();

  echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
  exit();
?>
