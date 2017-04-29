<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Beer Reviews</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="breweries.php">Breweries</a>
                </li>
                <<!-- li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li> -->
                <?php if(!$isUserLoggedIn){?>
                <li>
                    <a href="login.php">Login</a>
                </li>
                <?php } else{?>
                <li>
                    <a href="add_beer.php">Add Beer</a>
                </li>
                <li>
                    <a href="add_beer_types.php">Add Beer Type</a>
                </li>
                <li>
                    <a href="add_brewery.php">Add Brewery</a>
                </li>
                <li>
                    <a href="logout.php">Logout</a>
                </li>
                <?php }?>
            </ul>

        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
