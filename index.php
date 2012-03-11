<?php
session_start();
require_once ("./package/portal/main/service/portalService.php");
$menu = new \Core\Portal\Service\MenuNavigatonClass;
$menu->execute();

//$folder = $menu->folder();

$story = new \Core\Portal\Service\StoryClass;
$story->execute();
$additionalStory = $story->bottomStory();

$portlet = new \Core\Portal\Service\Portlet;
$portlet->execute();
$setting = $portlet->setting();
$avatar = $portlet->leftCellImage();
$bookmark = $portlet->leftCellBookmark();
$topFive = $portlet->leftCellTopFive();
//$centerStory  = new $additional->centerStory();
$title = "Peringkat Testing";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $title; ?></title>
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
        <!--[if lt IE 9]>
          <script src="./library/html5.js"></script>
        <![endif]-->

        <!-- Le styles -->

        <link  id="cssTwitter1" rel="stylesheet" href="./library/twitter2/docs/assets/css/journal.css">
        <link  id="cssTwitter2" rel="stylesheet" href="./library/twitter2/docs/assets/css/bootstrap-responsive.css">            
        <link   rel="stylesheet" href="./library/pretty/prettify.css">            

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
    <script src="./library/pretty/prettify.js"></script>

    <body onload="prettyPrint()">
        <?php $application = $menu->application(); ?>
        <div class="navbar navbar-fixed-top">

            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <?php
                        $totalApplication = count($application);
                        for ($i = 0; $i < $totalApplication; $i++) {
                            ?>
                            <span class="i-bar"></span>
<?php } ?>
                    </a>
                    <a class="brand" href="#">Core</a>
                    <div class="nav-collapse">

                        <ul class="nav">
                            <?php
                            // cms menu router 
                            if (isset($application)) {
                                $totalApplication = count($application);
                                for ($i = 0; $i < $totalApplication; $i++) {
                                    $totalModule = 0;
                                    if (isset($application[$i]['module'])) {
                                        $totalModule = count($application[$i]['module']);
                                    }
                                    if ($totalModule == 0) {
                                        ?> 
                                        <li class="active"><a href="#" onClick=loadBelow('full','<?php if (isset($application[$i]['applicationId'])) {
                                            echo $application[$i]['applicationId'];
                                        } ?>')>
            <?php if (isset($application[$i]['applicationNative'])) {
                echo $application[$i]['applicationNative'];
            } ?></a></li>
                                            <?php } else { ?>
                                        <li class="dropdown">
                                            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $application[$i]['applicationNative']; ?> <b class="caret"></b></a>

                                            <ul class="dropdown-menu">
            <?php // start looping  ?>
                                                <li><a href="#" onClick="loadBelow('semi','<?php echo $application[$i]['applicationId']; ?>',<?php echo $application[$i]['module'][$j]['moduleId']; ?>)"><?php echo $application[$i]['module'][$j]['moduleNative']; ?></a></li>
                                        <?php // end looping ?>    
                                            </ul>
        <?php } ?>

                                    </li>
    <?php }
} ?>
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
<?php if (isset($avatar)) { ?>   
                        <br> 	
                        <a href="" class="thumbnail"><img src="<?php echo $avatar; ?>" alt="It's me" width="100" height="100"></a>
                        <hr>
                            <?php } ?>
                    <div class="sidebar-nav">

                        <ul class="nav nav-list">
                                    <?php
                                    if (isset($folder)) {
                                        $totalFolder = count($folder);
                                        for ($i = 0; $i < $totalFolder; $i++) {
                                            ?> 
                                    <li class="nav-header" onclick="showMeSideBar(<?php echo $folder['folderId'][$i]; ?>,<?php echo $totalFolder; ?>)" onmouseover="showMeSideBar(<?php echo $folder['folderId'][$i]; ?>,<?php echo $totalFolder; ?>)"><img id="folder1" src="images/icons/<?php echo $folder[$i]['iconName']; ?>" alt="application"><?php echo $folder['folderNative'][$i]; ?></li>
                                    <li  id="common1" class="hide"><ul class="nav nav-list">
        <?php
        $totalLeaf = count($folder['detail']);
        for ($j = 0; $j < $totalLeaf; $j++) {
            ?>
                                                <li class="hide"> <a href="#" onclick="routing(<?php echo $folder[$i]['leaf'][$j]['leafId']; ?>,<?php echo $totalLeaf; ?>,'<?php echo $folder[$i]['leaf'][$j]['leafId']; ?>')"><img src="images/icons/application-form.png" alt="application"><?php echo $folder[$i]['leaf'][$j]['leafNative']; ?></a>
        <?php }
    }
    ?>    


                                    </ul>
                                </li>
                        <?php } ?>
                        </ul>


                    </div><!--/.well -->
<?php if ($setting['topFive'] == 1) { ?>    
                        <hr>
                        <h5><?php echo $topFiveTitle; ?></h5>
                        <ul>
                        <?php
                        if (isset($topFive)) {
                            for ($i = 0; $i < count($topFive); $i++) {
                                ?> 
                                    <li><a class="nav-item" onClick=loadFile(<?php echo $topFive['leafId']; ?>) ><?php echo $topFive['leafNative']; ?></a></li>

                            <?php } ?>  </ul>
                            <?php
                            }
                        }
                        ?>
                        <?php if ($setting['topFive'] == 1) { ?>    
                        <hr>
                        <h5><?php echo $bookmarkTitle; ?></h5>

                        <?php if (isset($bookmark)) { ?>
                            <ul>
        <?php for ($i = 0; $i < count($bookmark); $i++) { ?> 
                                    <li><a class="nav-item" onClick=loadFile(<?php echo $bookmark['leafId']; ?>) ><?php echo $bookmark['leafNative']; ?></a></li>

        <?php } ?>
                            </ul>
    <?php
    }
}
?>

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
                <p><?php //$firstDetail = " More elegent system and Code to Code";    ?>
                    <br>
                <p><a class="btn btn-primary btn-large">Learn more &raquo;</a></p>
            </div>

            <!-- Example row of columns -->
            <div id="bottomViewport" class="row">
<?php foreach ($additionalStory as $story) { ?>
                    <div class="span3 well">
                        <h2><?php echo $story['title']; ?></h2>
                        <p><?php echo $story['description']; ?></p>
                    </div>
<?php } ?>
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
            $(document).ready(function(){
                // load the system cell if session  and token exist; 
                  
            });
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
