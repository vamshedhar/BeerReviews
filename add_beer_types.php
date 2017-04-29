<?php
  include("header2.php");

  if(!$isUserLoggedIn){
    echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
    exit();
  }

  if(isset($_POST["delete"])){
    $deleteId = $_POST["updateId"];
    $breweries->delete($mysqli, $deleteId);
  }

  if(isset($_POST["name"]) && isset($_POST["street"]) && isset($_POST["city"]) && isset($_POST["state"]) && isset($_POST["pincode"]) && isset($_POST["description"])){

    if(isset($_POST["id"])){
      $result = $breweries->update($mysqli, $_POST);
    } else{
      $result = $breweries->add($mysqli, $_POST);
    }

  }

  $breweriesArray = $breweries->getAll($mysqli);

  if(isset($_POST["edit"])){
    $updateId = $_POST["updateId"];
    $brewery = $breweriesArray[$updateId];
  }

?>

<form action="add_brewery.php" method="POST">
  <?php if(isset($brewery)){
    ?>
    <input type="hidden" name="id" value="<?php echo $brewery['id'];?>">
    <?php
    }?>
  <div class="row" style="margin-top: 50px; margin-bottom: 20px;">
    <div class="col-sm-4">
      <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php if(isset($brewery)){echo $brewery['name'];}?>" placeholder="Name">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Street</label>
        <textarea name="street" id="street" class="form-control" rows="4"><?php if(isset($brewery)){echo $brewery['street'];}?></textarea>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
        <label for="exampleInputPassword1">City</label>
        <input type="text" class="form-control" id="city" name="city" value="<?php if(isset($brewery)){echo $brewery['city'];}?>" placeholder="City">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">State</label>
        <input type="text" class="form-control" id="state" name="state" value="<?php if(isset($brewery)){echo $brewery['state'];}?>" placeholder="State">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Pincode</label>
        <input type="text" class="form-control" id="pincode" name="pincode" value="<?php if(isset($brewery)){echo $brewery['pincode'];}?>" placeholder="Pincode">
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
        <label for="exampleInputPassword1">Description</label>
        <textarea name="description" id="description" class="form-control" rows="6"><?php if(isset($brewery)){echo $brewery['description'];}?></textarea>
      </div>
      <div class="text-right">
        <button type="submit" class="btn btn-primary"><?php if(isset($brewery)){echo "Update";} else{echo "Add";}?> Brewery</button>
      </div>
    </div>
  </div>
</form>

<hr>

<table class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Address</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  <?php
    foreach ($breweriesArray as $id => $brewery) {
      ?>

      <tr>
        <td><?php echo $brewery["id"];?></td>
        <td><?php echo $brewery["name"];?></td>
        <td> <?php echo $brewery['street'].", ".$brewery['city'].", ".$brewery['state'].", ".$brewery['pincode']?></td>
        <td class="text-right">
          <form action="add_brewery.php" method="POST">
            <input type="hidden" name="updateId" value="<?php echo $id;?>">
            <button type="submit" name="edit" class="btn btn-xs btn-primary">Edit</button>
            <button type="submit" name="delete" class="btn btn-xs btn-danger">Delete</button>
          </form>
        </td>
      </tr>

      <?php
    }
  ?>

  </tbody>
</table>

<hr>

<?php
  include("footer2.php");
?>
