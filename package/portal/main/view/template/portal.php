<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Core Framework + Jquery + Twitter Bootsrap 2</title>
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
        <!--[if lt IE 9]>
          <script src="./library/html5.js"></script>
        <![endif]-->

        <!-- Le styles -->

        <link rel="stylesheet" href="./library/twitter2/docs/assets/css/bootstrap.css">
        <link rel="stylesheet" href="./library/twitter2/docs/assets/css/bootstrap-responsive.css">            
        <style type="text/css">
            body {
                padding-top: 60px;
                padding-bottom: 40px;
            }
        </style>

        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="../../../../../images/favicon.ico">
        <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
    </head>

    <body>

        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="i-bar"></span>
                        <span class="i-bar"></span>
                        <span class="i-bar"></span>
                    </a>
                    <a class="brand" href="#">Core</a>
                    <div class="nav-collapse">
                        <ul class="nav">
                            <?php // cms menu router 
                            // foreach ($menuRouter as menuLinks) {  
                            ?>
                            <li class="active"><a href="#">Core</a></li>
                            <li><a href="./library/twitter2/docs/">Twitter 2 Bootstrap</a></li>
                            <li><a href="./library/jquery/">Jquery Offline Api</a></li>
<?php // }  ?>
                        </ul>
                    </div><!--/.nav-collapse -->
                    <div class="navbar-text pull-right">
                        <!--  username -->
                        <input type="textbox" name="username" id="username" placeholder="Username">
                        <!--- password -->

                        <input type="password" name="password" id="password" placeholder="Password">

                        <input type="button" name="login" value="login" class="btn btn-info"x>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">

            <!-- Main hero unit for a primary marketing message or call to action -->
            <div class="hero-unit">
                <h1>
                    <img alt="Wait Ya." height="100" width="100" src="./images/Blueticons_Win/PNGs/Devil.png" width="120">
                    <?php
                    $firstHeader = "Welcome.. Core Light";
                    echo $firstHeader;
                    ?></h1>
                <p><?php $firstDetail = " More elegent system and Code to Code"; ?>
                    <br>
                <p><a class="btn btn-primary btn-large">Learn more &raquo;</a></p>
            </div>

            <!-- Example row of columns -->
            <div class="row">
                <div class="span4">
                    <h2>Heading</h2>
                    <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                    <p><a class="btn" href="#">View details &raquo;</a></p>
                </div>
                <div class="span4">
                    <h2>Heading</h2>
                    <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                    <p><a class="btn" href="#">View details &raquo;</a></p>
                </div>
                <div class="span4">
                    <h2>Heading</h2>
                    <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
                    <p><a class="btn" href="#">View details &raquo;</a></p>
                </div>
            </div>

            <hr>

            <footer>
                <p>&copy; Company 2012</p>
            </footer>

        </div> <!-- /container -->

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="./library/jquery/jquery-1.7.1.js"></script>
        <script src="./library/twitter2/js/bootstrap-transition.js"></script>
        <script src="./library/twitter2/js/bootstrap-collapse.js"></script>
        <script language="javascript">
            
        </script>
    </body>
</html>
