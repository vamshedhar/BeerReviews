<?php
  session_start();
  ob_start();
  $servername = "localhost";
  $username = "root";
  $password = "root";
  $dbname = "beerreviews";

  // Create connection
  $mysqli = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
  }

  $isUserLoggedIn = false;

  if(isset($_SESSION["username"]) && isset($_COOKIE["username"])){
    $isUserLoggedIn = $_SESSION["username"] == $_COOKIE["username"];
  }


?>
