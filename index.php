<?php
  include("header.php");
?>

<div class="col-md-9">

    <div class="row carousel-holder">

        <div class="col-md-12">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="item active">
                        <img class="slide-image" width="800px" height="300px"  align="middle" src="images/1.jpg" alt="">
                    </div>
                    <div class="item">
                        <img class="slide-image" width="800px" height="300px" src="images/2.jpg" alt="">
                    </div>
                    <div class="item">
                        <img class="slide-image" width="800px" height="300px" src="images/3.jpg" alt="">
                    </div>
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
        </div>

    </div>

    <div class="row">
      <?php


        foreach($beersArray as $id => $beer){
      ?>
        <div class="col-sm-4 col-lg-4 col-md-4">
            <div class="thumbnail">
                <img src="images/beers/<?php echo $beer["id"]%4 + 1;?>.jpg" alt="">
                <div class="caption">
                    <h4><a href="beer_details.php?id=<?php echo $beer["id"]?>"><?php echo $beer["name"]?></a>
                    </h4>
                    <h6><?php echo $beerTypesArray[$beer["type_id"]]["name"]?></h6>
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
                    </p>
                </div>
            </div>
        </div>
      <?php
        }
      ?>
    </div>

</div>

<?php
  include("footer.php");
?>
