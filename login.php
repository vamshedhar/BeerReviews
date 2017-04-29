<?php
  include("header2.php");

  if(isset($_POST["username"]) && isset($_POST["password"])){
    $user = new User();
    $isValidUser = $user->validate($mysqli, $_POST["username"], $_POST["password"]);

    if($isValidUser){
      setcookie("username", $_POST["username"], time() + (86400 * 30));
      $_SESSION["username"] = $_POST["username"];

      echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
      exit();
    }
  }
?>

<form action="login.php" method="POST">
  <div class="row" style="margin-top: 100px; margin-bottom: 300px;">
    <div class="col-sm-offset-4 col-sm-4">
      <form>
        <div class="form-group">
          <label for="exampleInputEmail1">Username</label>
          <input type="text" class="form-control" id="username" name="username" placeholder="Username">
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
        <?php if(isset($isValidUser) && !$isValidUser){ ?>
        <br><br>
        <p class="text-danger">* Invalid Login Credentials</p>
        <?php } ?>
      </form>
    </div>
  </div>
</form>
<hr>

<?php
  include("footer2.php");
?>
