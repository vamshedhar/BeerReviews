<?php
  include("header2.php");

  if(!$isUserLoggedIn){
    echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
    exit();
  }

  $beers = new Beers();
  $beerTypes = new BeerTypes();

  if(isset($_POST["delete"])){
    $deleteId = $_POST["updateId"];
    $beers->delete($mysqli, $deleteId);
  }

  if(isset($_POST["name"]) && isset($_POST["type"]) && isset($_POST["brewery"])){

    if(isset($_POST["id"])){
      $result = $beers->update($mysqli, $_POST);
    } else{
      $result = $beers->add($mysqli, $_POST);
    }

  }

  $beerTypesArray = $beerTypes->getAll($mysqli);

  $type = null;

  $beersArray = $beers->getAll($mysqli, $type);

  if(isset($_POST["edit"])){
    $updateId = $_POST["updateId"];
    $beer = $beersArray[$updateId];
  }

?>

<form action="add_beer.php" method="POST">
  <?php if(isset($beer)){
    ?>
    <input type="hidden" name="id" value="<?php echo $beer['id'];?>">
    <?php
    }?>
  <div class="row" style="margin-top: 50px; margin-bottom: 20px;">
    <div class="col-sm-4">
      <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php if(isset($beer)){echo $beer['name'];}?>" placeholder="Name">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Type</label>
        <select name="type" class="form-control" >
          <?php
            foreach ($beerTypesArray as $id => $beerType) {
              ?>
              <option <?php if(isset($beer) && $beer['type_id'] == $id){echo 'selected';}?> value="<?php echo $id; ?>"><?php echo $beerType['name']; ?></option>
              <?php
            }
          ?>
        </select>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Brewery</label>
        <select name="brewery" class="form-control">
          <?php
            foreach ($breweriesArray as $id => $brewery) {
              ?>
              <option <?php if(isset($beer) && $beer['brewery'] == $id){echo 'selected';}?> value="<?php echo $id; ?>"><?php echo $brewery['name']; ?></option>
              <?php
            }
          ?>
        </select>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
        <label for="exampleInputPassword1">Color</label>
        <input type="text" class="form-control" id="color" name="color" value="<?php if(isset($beer)){echo $beer['color'];}?>" placeholder="Color">
      </div>
      <div class="form-group">
        <label for="exampleInputEmail1">Smell</label>
        <input type="text" class="form-control" id="smell" name="smell" value="<?php if(isset($beer)){echo $beer['smell'];}?>" placeholder="Smell">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Taste</label>
        <input type="text" class="form-control" id="taste" name="taste" value="<?php if(isset($beer)){echo $beer['taste'];}?>" placeholder="Taste">
      </div>
    </div>
    <div class="col-sm-4">
      <div class="form-group">
        <label for="exampleInputPassword1">Description</label>
        <textarea name="description" id="description" class="form-control" rows="6"><?php if(isset($beer)){echo $beer['description'];}?></textarea>
      </div>
      <div class="text-right">
        <button type="submit" class="btn btn-primary"><?php if(isset($beer)){echo "Update";} else{echo "Add";}?> Beer</button>
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
      <th>Type</th>
      <th>Brewery</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
  <?php
    foreach ($beersArray as $id => $beer) {
      ?>

      <tr>
        <td><?php echo $beer["id"];?></td>
        <td><?php echo $beer["name"];?></td>
        <td><?php echo $beerTypesArray[$beer["type_id"]]["name"];?></td>
        <td><?php echo $breweriesArray[$beer["brewery"]]["name"];?></td>
        <td class="text-right">
          <form action="add_beer.php" method="POST">
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
