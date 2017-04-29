<?php
  class User{

    function validate($mysqli, $username, $password){

      $username = $mysqli->real_escape_string($_POST["username"]);
      $password = $mysqli->real_escape_string($_POST["password"]);

      $query = "SELECT * FROM user WHERE username='$username'";

      $result = $mysqli->query($query) or die(mysqli_error($mysqli));

      if($result->num_rows != 1){
        return false;
      } else{
        $user = $result->fetch_assoc();

        if($user['password'] == $password){
          return true;
        }
      }

      return false;
    }
  }
?>
