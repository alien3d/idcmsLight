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
                            <?php
                            // cms menu router 
                            // foreach ($menuRouter as menuLinks) {  
                            ?>
                            <li class="active"><a href="#">Core</a></li>
                            <li><a href="./library/twitter2/docs/">Twitter 2 Bootstrap</a></li>
                            <li><a href="./library/jquery/">Jquery Offline Api</a></li>
                            <?php // }   ?>
                        </ul>
                    </div><!--/.nav-collapse -->
                    <div class="navbar-text pull-right">
                        <!--  username -->
                        <input type="textbox" name="username" id="username" placeholder="Username">
                        <!--- password -->

                        <input type="password" name="password" id="password" placeholder="Password">

                        <input type="button" name="loginButton" id="loginButton" value="login" class="btn btn-info"x>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div id="infoPanel" class="hide"></div>
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
                <div class="span3 well">
                    <h2>Php 5</h2>
                    <p>Implementing Various Of Php 5 Object Oriented technologies like namespace ,abstract and much more</p>
                </div>
                <div class="span3 well">
                    <h2>System</h2>
                    <p>User Interface using Twitter Bootsrap and SAS Images.Much Faster To load Page</p>
                </div>
                <div class="span3 well">
                    <h2>Database</h2>
                    <p>Able to cope with Other Vendor Database and Fast.Slow is not an option here.</p>
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
        <script src="./library/twitter2/js/bootstrap-alert.js"></script>
        <script src="./library/twitter2/js/bootstrap-button.js"></script>
        <script src="./library/twitter2/js/bootstrap-carousel.js"></script>
        <script src="./library/twitter2/js/bootstrap-collapse.js"></script>
        <script src="./library/twitter2/js/bootstrap-dropdown.js"></script>
        <script src="./library/twitter2/js/bootstrap-modal.js"></script>
        <script src="./library/twitter2/js/bootstrap-scrollspy.js"></script>
        <script src="./library/twitter2/js/bootstrap-tab.js"></script>
        <script src="./library/twitter2/js/bootstrap-tooltip.js"></script>
        <script src="./library/twitter2/js/bootstrap-transition.js"></script>
        <script src="./library/twitter2/js/bootstrap-typeahead.js"></script>
        <script language="javascript">
            // sent ajax request to login
            
            $("#loginButton").click(function(){
                var message;
                if($("#username").val().length==0 && $("#password").val().length == 0) {
                    message="Please field the username and password field lor";
                    $('#infoPanel').html('<div class=\'alert alert-error\' ><a class="close" data-dismiss=\'alert\'>×</a>'+message +'</div>');
                    $('#infoPanel').show();
                } else if($("#username").val().length==0 && $("#password").val().length > 0){
                    message="Please field the username field first la";
                    $('#infoPanel').html('<div class=\'alert alert-error\'><a class="close" data-dismiss=\'alert\'>×</a>'+message +'</div>');
                    $('#infoPanel').show();    
                } else if ($("#password").val().length==0 && $("#username").val().length > 0){
                    message ="Please field the password field first la";
                    $('#infoPanel').html('<div class=\'alert alert-error\'><a class="close" data-dismiss=\'alert\'>×</a>'+message +'</div>');
                    $('#infoPanel').show();
                } else {
                    $.ajax({
                        type: 'POST',
                        url: 'index.php',
                        data: {
                            username: $("#username").val(),
                            password : $("#password").val()
                        },
                        beforeSend:function(){
                            // this is where we append a loading image
                            $('#infoPanel').html('<div class=\"progress\">  <div class=\"bar\" style=\"width: 100%;\">Wait Ya</div></div>');
                            $('#infoPanel').show();
                        },
                        success:function(data){
                            // successful request; do something with the data
                            $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                            if(data.success ==true){
                                $('#infoPanel').html('<div class=\'alert alert-info\'><a class="close" data-dismiss=\'alert\'>×</a>Lai  lai.. come in Welcome</div>');
                                $('#infoPanel').show(); 
                            }    else {
                                $('#infoPanel').html('<div class=\'alert alert-error\'><a class="close" data-dismiss=\'alert\'>×</a>Who are you ?puchu tau</div>');
                                $('#infoPanel').show();    
                            } 
                
                        },
                        error:function(){
                            // failed request; give feedback to user
                            $('#infoPanel').html('<div class=\'alert alert-error\'><a class="close" data-dismiss=\'alert\'>×</a>Error Could Load The Request Page</div>');
                            $('#infoPanel').show();
                        }
                    });
                }
                $("#closeAlertError").click(function() {
                    $("#infoPanel").hide();
                });
                // if success.clear all code   empty menu and below
                // ask router menu block
                // ask router left menu block
            });
            
        </script>
    </body>
</html>
