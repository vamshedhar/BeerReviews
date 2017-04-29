<?php
  include("header2.php");

  if(!$isUserLoggedIn){
    echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
    exit();
  }

  $beerTypes = new BeerTypes();

  if(isset($_POST["delete"])){
    $deleteId = $_POST["updateId"];
    $beerTypes->delete($mysqli, $deleteId);
  }

  if(isset($_POST["name"]) && isset($_POST["description"])){

    if(isset($_POST["id"])){
      $result = $beerTypes->update($mysqli, $_POST);
    } else{
      $result = $beerTypes->add($mysqli, $_POST);
    }

  }

  $beerTypesArray = $beerTypes->getAll($mysqli);

  if(isset($_POST["edit"])){
    $updateId = $_POST["updateId"];
    $beerType = $beerTypesArray[$updateId];
  }

?>

<form action="add_beer_types.php" method="POST">
  <?php if(isset($beerType)){
    ?>
    <input type="hidden" name="id" value="<?php echo $beerType['id'];?>">
    <?php
    }?>
  <div class="row" style="margin-top: 50px; margin-bottom: 20px;">
    <div class="col-sm-5">
      <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php if(isset($beerType)){echo $beerType['name'];}?>" placeholder="Name">
      </div>
    </div>
    <div class="col-sm-5">
      <div class="form-group">
        <label for="exampleInputPassword1">Description</label>
        <textarea name="description" id="description" class="form-control"><?php if(isset($beerType)){echo $beerType['description'];}?></textarea>
      </div>
    </div>
    <div class="col-sm-2">
      <br><br>
      <div class="text-right">
        <button type="submit" class="btn btn-primary"><?php if(isset($beerType)){echo "Update";} else{echo "Add";}?> Beer Type</button>
      </div>
    </div>
  </div>
</form>

<hr>


<table class="table table-striped">
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Description</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  <?php
    foreach ($beerTypesArray as $id => $beerType) {
      ?>

      <tr>
        <td><?php echo $beerType["id"];?></td>
        <td><?php echo $beerType["name"];?></td>
        <td width="600px"><?php echo $beerType["description"];?></td>
        <td class="text-right">
          <form action="add_beer_types.php" method="POST">
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
