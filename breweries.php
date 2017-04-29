<?php include("header2.php");?>

<!-- Jumbotron Header -->
        <header class="jumbotron hero-spacer">
            <h1>Breweries</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
        </header>

        <hr>

        <!-- Title -->
        <div class="row">
            <div class="col-lg-12">
                <h3>Latest Features</h3>
            </div>
        </div>
        <!-- /.row -->

        <!-- Page Features -->
        <div class="row text-center">

            <?php


              foreach($breweriesArray as $id => $brewery){
            ?>
            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="http://placehold.it/800x500" alt="">
                    <div class="caption">
                        <h4><a href="brewery_details.php?id=<?php echo $brewery["id"]?>"><?php echo $brewery["name"]?></h4>
                        <p><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $brewery['street'].", ".$brewery['city'].", ".$brewery['state'].", ".$brewery['pincode']?></p>
                    </div>
                    <div class="ratings">
                        <p class="pull-right"><?php echo $brewery["total_reviews"]?> reviews</p>
                        <p align="left">
                          <?php
                            $rating = round($brewery["rating"]);
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
        <!-- /.row -->

        <hr>

<?php include("footer2.php");?>
