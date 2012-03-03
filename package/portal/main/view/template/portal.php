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

        <link  id="cssTwitter1" rel="stylesheet" href="./library/twitter2/docs/assets/css/<?php echo $this->defaultCss; ?>.css">
        <link  id="cssTwitter2" rel="stylesheet" href="./library/twitter2/docs/assets/css/bootstrap-responsive.css">            
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
                    <div id="loginArea" class="navbar-text pull-right">
                        <!--  username -->
                        <input type="textbox" name="username" id="username" placeholder="Username">
                        <!--- password -->

                        <input type="password" name="password" id="password" placeholder="Password">

                        <input type="button" name="loginButton" id="loginButton" value="login" class="btn btn-info"x>
                    </div>
                </div>
            </div>
        </div>

        <div id="centerViewport" class="container">
            <div  id="leftViewportDetail" class="row-fluid hide">
                 <div class="span2" >

                <br> 	
                <a href="" class="thumbnail"><img src="images/Blueticons_Win/PNGs/Cool.png" alt="It's me" width="100" height="100"></a>
                <hr>
                    <div class="sidebar-nav">
                       
                        <ul class="nav nav-list">
                        	<li class="nav-header" onclick="showMeSideBar(1,4)" onmouseover="showMeSideBar(1,4)"><img id="folder1" src="images/icons/folder.png" alt="application"> System</li>
                        	<li  id="common1" class="hide"><ul class="nav nav-list">
                            <li class="hide"> <a href="#" onclick="routing(1,12,'district.php')"><img src="images/icons/application-form.png" alt="application"> Application</a>

                            <div id="choosenLeaf1"></div>
                            <div id="choosenLeafWaitingIcon1"></div></li>
                           	<li class="hide"><a href="#" onclick="routing(2,12,'district.php')"><img src="images/icons/application-form.png" alt="application"> Module</a>
                           	<div id="choosenLeaf2"></div>
                            <div id="choosenLeafWaitingIcon2"></div></li>
                            <li><a href="#" onclick="routing(3,12,'district.php')"><img src="images/icons/application-form.png" alt="application"> Folder</a>
                            <div id="choosenLeaf3"></div>

                            <div id="choosenLeafWaitingIcon3"></div></li>
                            <li><a href="#" onclick="routing(4,12,'district.php')"><img src="images/icons/application-form.png" alt="application"> Leaf</a>
                            <div id="choosenLeaf4"></div>
                            <div id="choosenLeafWaitingIcon4"></div></li>
                            <li><a href="#" onclick="routing(5,12,'district.php')"><img src="images/icons/application-form.png" alt="application"> Language</a>
                            <div id="choosenLeaf5"></div>
                            <div id="choosenLeafWaitingIcon5"></div></li>

                        	</ul>
                        	</li>
                        	<li class="nav-header" onclick="showMeSideBar(2,4)" onmouseover="showMeSideBar(2,4)"><img id="folder2" src="images/icons/folder.png" alt="application"> Translation
</li>
                        	<li id="common2" class="hide">
                        		<ul class="nav nav-list">
                        			<li><a  href="#" onclick="routing(6,12,'district.php')"><img src="images/icons/application-form.png" alt="application"> Default Label</a>
                        			<div id="choosenLeaf6"></div>

                            		<div id="choosenLeafWaitingIcon6"></div></li>
                            		<li><a  href="#" onclick="routing(7,12,'district.php')"><img src="images/icons/application-form.png" alt="application"> Table Mapping</a>
                            		<div id="choosenLeaf7"></div>
                            		<div id="choosenLeafWaitingIcon7"></div></li>
                            		<li><a  href="#" onclick="routing(8,12,'district.php')"><img src="images/icons/application-form.png" alt="application"> System String</a>
                            		<div id="choosenLeaf8"></div>
                            		<div id="choosenLeafWaitingIcon8"></div></li>

                        		
                        		</ul>
                        	</li>
                        	<li class="nav-header" onclick="showMeSideBar(3,4)" onmouseover="showMeSideBar(3,4)"><img id="folder3" src="images/icons/folder.png" alt="application"> Personnel</li>
						    	<li id="common3" class="hide">
                        		<ul class="nav nav-list">

						    <li><a href="#" onclick="routing(9,12,'district.php')"><img src="images/icons/application-form.png" alt="application"> Peference</a>

						    <div id="choosenLeaf9"></div>
                            <div id="choosenLeafWaitingIcon9"></div>
						    </li>
                            <li><a href="#" onclick="routing(10,12,'district.php')"><img src="images/icons/application-form.png" alt="application"> Change Password</a>
                            	    <div id="choosenLeaf10"></div>
                            <div id="choosenLeafWaitingIcon10"></div>

                            </li>

                       		</ul>
                       		</li>
                       		<li class="nav-header" onclick="showMeSideBar(4,4)" onmouseover="showMeSideBar(4,4)"><img id="folder4" src="images/icons/folder-open.png" alt="application"> Common</li>
								
								
								<li  id="common4">
                        		<ul class="nav nav-list">

							<li><a href="#" onclick="routing(11,12,'district.php')"><img src="images/icons/application-form.png" alt="application"> District
							</a>

							<div id="choosenLeaf11"></div>
                            <div id="choosenLeafWaitingIcon11"></div>
							</li>
                            <li><a href="#" onclick="routing(12,12,'district.php')"><img src="images/icons/application-form.png" alt="application"> State
                            </a><div id="choosenLeaf12"></div><div id="choosenLeafWaitingIcon12"></div></li>
                        </ul></li>
                                               </ul>

                    </div><!--/.well -->

                    <hr>
                    <h5>Quick Link</h5>
                    <ul>
                    	<li><a class="nav-item">Application 1</a></li>
                    	<li><a class="nav-item">Application 2</a></li>
                    	<li><a class="nav-item">Application 3</a></li>
                    </ul>

            </div>
            </div>    
            <div id="infoPanel" class="span9 hide"></div>
            <!-- Main hero unit for a primary marketing message or call to action -->
            <div id="centerViewport" class="hero-unit">
                <h1>
                    <img alt="Wait Ya." height="100" width="100" src="./images/Blueticons_Win/PNGs/Devil.png" width="120">
                    <?php
                    $firstHeader = "Welcome.. Core Light";
                    echo $firstHeader;
                    ?></h1>
                <p><?php //$firstDetail = " More elegent system and Code to Code"; ?>
                    <br>
                <p><a class="btn btn-primary btn-large">Learn more &raquo;</a></p>
            </div>

            <!-- Example row of columns -->
            <div id="bottomViewport" class="row">
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

    
       

        </div> <!-- /container -->
            <hr>

        <footer>
                <p>&copy; IDCMS 2012</p>
            </footer>
        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="./library/jquery/jquery-1.7.1.js"></script>
        <script src="./library/global.js"></script>
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
        <script src="./library/jquerytools/jquery.tools.min.js"></script>

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
                           // $('#infoPanel').html('<div class=\"progress\">  <div class=\"bar\" style=\"width: 100%;\">Wait Ya</div></div>');
                            $('#infoPanel').show();
                        },
                        success:function(data){
                            // successful request; do something with the data
                           // $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                            if(data.success ==true){
                               // $('#infoPanel').html('<div class=\'alert alert-info\'><a class="close" data-dismiss=\'alert\'>×</a>Lai  lai.. come in Welcome</div>');
                               // $('#infoPanel').show();
                                // change  the north viewport
                                //  change the left viewport
                                $("#centerViewport").html("");
                                $("#centerViewport").empty();
                                $("#centerViewport").removeClass();
                                $("#centerViewport").addClass("container-fluid");
                                // ajax request load left side.
                                $.ajax({
                                    type: 'POST',
                                    url: 'index.php',
                                    data: {
                                        cell : 'left'
                                    },
                                    success:function(data){
                                        
                                    },
                                    error:function(){
                                        
                                    }

                                });    
                                $("#centerViewport").html("<div id=leftViewport class=span2>ini tepi</div><div id='rightViewport' class='span9' style='border-left: 1px solid #cccccc ; padding-left:10px;'><div class=\'alert alert-info\'>Loading Complete</div>ini center dalam</div>")
                                
                                // change the log in as 
                                $("#loginArea").html("<p class=\"navbar-text pull-right\">Logged in as <a href=\"#\">username</a></p>");
                            }    else {
                                $("#leftViewport").hide(); 
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
        <div id="additionJs"></div>
    </body>
</html>
