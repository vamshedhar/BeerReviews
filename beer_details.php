<?php
  include("header.php");

  if(!isset($_GET["id"])){
    echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
    exit();
  }

  $beer_id = $_GET["id"];

  $beer = $beersArray[$beer_id];

  $beerReviews = new BeerReviews();

  if(isset($_POST['newRating']) && isset($_POST['newReview'])){
    $beerReviews->addReview($mysqli, $beer_id, $_POST['newReview'], $_POST['newRating']);
  }

  $reviews = $beerReviews->getAll($mysqli, $beer_id);

?>
<div class="col-md-9">

  <div class="thumbnail">
      <img class="img-responsive" src="http://placehold.it/800x300" alt="">
      <div class="caption-full">
          <h4 class="pull-right"><?php echo $beerTypesArray[$beer["type_id"]]["name"]?></h4>
          <h4><a href="#"><?php echo $beer["name"]?></a>
          </h4>
          <p><?php echo $beer["description"]?></p>
      </div>
      <div class="ratings">
          <p class="pull-right"><?php echo $beer["total_reviews"]?> reviews</p>
          <p>
            <?php
              $rating = round($beer["rating"]);
              for($i = 0; $i < $rating; $i++){
                echo "<span class=\"glyphicon glyphicon-star\"></span>";
              }

              for($i = 0; $i < 5 - $rating; $i++){
                echo "<span class=\"glyphicon glyphicon-star-empty\"></span>";
              }
            ?>
              <?php echo round($beer["rating"]*10)/10;?> stars
          </p>
      </div>
  </div>

  <div class="well">
      <form method="POST" action="beer_details.php?id=<?php echo $beer_id?>">
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
  include("footer.php");
?>
