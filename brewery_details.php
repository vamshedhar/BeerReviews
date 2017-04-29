<?php
  include("header2.php");

  if(!isset($_GET["id"])){
    echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
    exit();
  }

  $brewery_id = $_GET["id"];

  $brewery = $breweriesArray[$brewery_id];

  $breweryReviews = new BreweryReviews();

  if(isset($_POST['newRating']) && isset($_POST['newReview'])){
    $breweryReviews->addReview($mysqli, $brewery_id, $_POST['newReview'], $_POST['newRating']);
  }

  $reviews = $breweryReviews->getAll($mysqli, $brewery_id);

?>
<div class="col-md-12">

  <div class="thumbnail">
      <img class="img-responsive" src="images/breweries/<?php echo $brewery["id"]?>.jpg" alt="">
      <div class="caption-full">
          <h4 class="pull-right"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $brewery['street'].", ".$brewery['city'].", ".$brewery['state'].", ".$brewery['pincode']?></h4>
          <h4><a href="#"><?php echo $brewery["name"]?></a>
          </h4>
          <p><?php echo $brewery["description"]?></p>
      </div>
      <div class="ratings">
          <p class="pull-right"><?php echo $brewery["total_reviews"]?> reviews</p>
          <p>
            <?php
              $rating = round($brewery["rating"]);
              for($i = 0; $i < $rating; $i++){
                echo "<span class=\"glyphicon glyphicon-star\"></span>";
              }

              for($i = 0; $i < 5 - $rating; $i++){
                echo "<span class=\"glyphicon glyphicon-star-empty\"></span>";
              }
            ?>
              <?php echo round($brewery["rating"]*10)/10;?> stars
          </p>
      </div>
  </div>

  <div class="well">
      <form method="POST" action="brewery_details.php?id=<?php echo $brewery_id?>">
        <div class="row">
          <div class="col-sm-8">
            <div class="form-group">
              <textarea class="form-control" name="newReview" id="newReview" rows="3"></textarea>
            </div>
          </div>
          <div class="col-sm-1">
            <div class="form-group">
              <label for="exampleInputEmail1">Rating</label>
              <select class="form-control" name="newRating" id="newRating">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </select>
            </div>

          </div>
          <div class="col-sm-3">
            <div class="text-right">
              <input type="submit" name="submitReview" value="Leave a Review" class="btn btn-success" />
            </div>
          </div>
        </div>
      </form>



      <hr>

      <?php


        foreach($reviews as $id => $review){
          $rating = $review["rating"];
      ?>

      <div class="row">
          <div class="col-md-12">
            <?php
              for($i = 0; $i < $rating; $i++){
                echo "<span class=\"glyphicon glyphicon-star\"></span>";
              }

              for($i = 0; $i < 5 - $rating; $i++){
                echo "<span class=\"glyphicon glyphicon-star-empty\"></span>";
              }
            ?>
              Anonymous
              <!-- <?php echo $review["first_name"] . ' ' . $review["last_name"]?> -->
              <span class="pull-right"><?php echo $review["date"]?></span>
              <p><?php echo $review["review"]?></p>
          </div>
      </div>

      <hr>

      <?php
        }
      ?>

  </div>

</div>

<?php
  include("footer2.php");
?>
