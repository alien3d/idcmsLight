<?php
session_start();
require_once ("./package/portal/main/service/portalService.php");
$menu = new \Core\Portal\Service\MenuNavigatonClass;
$menu->execute();
$application = $menu->application();

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
        <style type="text/css">
            body {
                padding-top: 60px;
                padding-bottom: 40px;
            }
        </style>
        <link  id="cssTwitter1" rel="stylesheet" href="./library/twitter2/docs/assets/css/bootstrap.css">
        <link  id="cssTwitter2" rel="stylesheet" href="./library/twitter2/docs/assets/css/bootstrap-responsive.css">            
        <link   rel="stylesheet" href="./library/pretty/prettify.css">            



        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="../../../../../images/favicon.ico">
        <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
    </head>
    <script src="./library/pretty/prettify.js"></script>

    <body onload="prettyPrint()">

        <?php ?>
        <div class="navbar navbar-fixed-top">

            <div class="navbar-inner">
                <div id="menu" class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <?php
                        $totalApplication = count($application);
                        for ($i = 0; $i < $totalApplication; $i++) {
                            ?>
                            <span class="i-bar"></span>
                        <?php } ?>
                    </a>
                    <a class="brand" href="index.php">Core</a>
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
                                        <li class="active"><a href="javascript:void(0)" onClick=loadBelow('<?php echo intval($application[$i]['applicationId']); ?>','','','','application')>

                                                <?php
                                                if (isset($application[$i]['applicationNative'])) {
                                                    echo $application[$i]['applicationNative'];
                                                }
                                                ?></a></li>
                                            <?php } else { ?>
                                        <li class="dropdown">
                                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown" ><?php echo $application[$i]['applicationNative']; ?> <b class="caret"></b></a>

                                            <ul class="dropdown-menu">
                                                <?php for ($j = 0; $j < $totalModule; $j++) {
                                                    if ($application[$i]['module'][$j]['isSingle'] == 1) {
                                                        ?>
                                                        <li><a href="javascript:void(0)" onClick=loadBelow('<?php echo intval($application[$i]['applicationId']); ?>','<?php echo intval($application[$i]['module'][$j]['moduleId']); ?>','','','module')><?php echo $application[$i]['module'][$j]['moduleNative']; ?></a></li>
                                                    <?php } else { ?>
                                                        <li><a href="javascript:void(0)" onClick="loadSidebar('<?php echo intval($application[$i]['applicationId']); ?>','<?php echo $application[$i]['module'][$j]['moduleId']; ?>')"><?php echo $application[$i]['module'][$j]['moduleNative']; ?></a></li>
                                                    <?php }
                                                } ?>    
                                            </ul>
                                        <?php }
                                        ?>

                                    </li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </div><!--/.nav-collapse -->


<?php if (isset($_SESSION['staffId'])) { ?>
                        <div  id="loginArea" class="btn-group pull-right">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="icon-user"></i> <?php echo $_SESSION['staffName']; ?>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href=href='javascript:void(0)'>Profile</a></li>
                                <li class="divider"></li>
                                <li><a href="logout.php">Sign Out</a></li>
                            </ul></div>
<?php } else { ?>
                        <div id="loginArea" class="navbar-text pull-right">
                            <input type="textbox" name="username" id="username" placeholder="Username">
                            <input type="password" name="password" id="password" placeholder="Password">
                            <input type="button" name="loginButton" id="loginButton" value="login" class="btn btn-info">
                        </div>   
<?php } ?>

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
                                                <li class="hide"> <a href="javascript:void(0)" onclick="loadLeft(<?php echo $folder[$i]['leaf'][$j]['leafId']; ?>,<?php echo $totalLeaf; ?>,'<?php echo $folder[$i]['leaf'][$j]['leafId']; ?>')"><img src="images/icons/application-form.png" alt="application"><?php echo $folder[$i]['leaf'][$j]['leafNative']; ?></a>
                                                    <?php
                                                }
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
            <div name="centerViewport" id="centerViewport" class="hero-unit">
                <h1>
                    <img alt="Wait Ya." height="100" width="100" src="./images/Blueticons_Win/PNGs/Devil.png" width="120">
                    <?php
                    $firstHeader = "Welcome.. Core Light";
                    echo $firstHeader;
                    ?></h1>
                <p><?php //$firstDetail = " More elegent system and Code to Code";       ?>
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
                        url: './package/portal/main/controller/portalController.php',
                        data: {
                            username: $("#username").val(),
                            password : $("#password").val(),
                            tokenKey : '<?php echo md5("you have been cheated"); ?>',
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
                                $('#infoPanel').html('<div class=\'alert alert-info\'><a class="close" data-dismiss=\'alert\'>×</a>Lai  lai.. come in Welcome</div>');
                                $('#infoPanel').show();
                                // change  the north viewport
                                //  change the left viewport
                                $("#centerViewport").html("");
                                $("#centerViewport").empty();
                                $("#centerViewport").removeClass();
                                $("#centerViewport").addClass("container-fluid");
                                // clear the portal menu and insert system menu
                                $("#menu").html("");
                                $("#menu").empty();
                              
                                // ajax request load left side.
                                $.ajax({
                                    type: 'POST',
                                    url: './package/portal/main/controller/portalController.php',
                                    data: {
                                        method : 'read',
                                        pageType :'menu'
                                    },
                                    success:function(data){
                                        $("#menu").html(data);
                                    },
                                    error:function(){
                                        $('#infoPanel').html('<div class=\'alert alert-error\'><a class="close" data-dismiss=\'alert\'>×</a>Error Could Load The Request Page</div>');
                                        $('#infoPanel').show();
                                    }

                                });    
                                $("#centerViewport").html("Please choose above menu first")
                                
                             
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
            function loadBelow(pageId,moduleId,folderId,leafId,pageType){
                //empty the center viewport
                $("#centerViewport").html('');        
                var url = './package/portal/main/controller/portalController.php';
                //    $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
                $("#centerViewport").removeClass();
                $("#centerViewport").addClass("container-fluid");    
                $("#centerViewport").load(url,{ method:'read',type:'list',detail:'body',pageId:pageId,moduleId:moduleId,folderId:folderId,leafId:leafId,pageType:pageType }, function(response, status, xhr) {
        
                    
            
                    if (status == "error") {
                
                        var msg = "Sorry but there was an error: ";
                
                        $('#infoPanel').html('<div class=\'alert alert-error\'><a class="close" data-dismiss=\'alert\'>×</a>aik'+msg + xhr.status + " " + xhr.statusText+'</div>');

                    } 
                });        
            }
            function loadSidebar(applicationId,moduleId){
                $('#infoPanel').html('<div class=\'alert alert-info\'><a class="close" data-dismiss=\'alert\'>×</a>Lai  lai.. come in Welcome</div>');
                $('#infoPanel').show();
                // change  the north viewport
                //  change the left viewport
                $("#centerViewport").html("");
                $("#centerViewport").empty();
                $("#centerViewport").removeClass();
                $("#centerViewport").addClass("container-fluid");
                $("#centerViewport").removeAttr("style");
           //     $("#centerViewport").css( "height","+=768" );

                
                // ajax request to load side bar westport view
                $.ajax({
                    type: 'POST',
                    url: './package/portal/main/controller/portalController.php',
                    data: {
                        method : 'read',
                        pageType : 'sidebar',
                        applicationId : applicationId,
                        moduleId : moduleId,
                        securityTocken:'<?php echo md5("You have been cheated"); ?>'
                    },
                    success:function(data){
                        var str = data;
                        if(str.search("error") > 1) {
                            $('#centerViewport').html(data);
                        } else {
                            $("#centerViewport").html("<div id=leftViewport class=span2  style='border-right: 1px solid #cccccc ; padding-right:10px;'>"+data+"</div><div id='rightViewport' class='span9' ><div class=\'alert alert-info\'>Loading Complete</div><div >Please Choose Left Menu First</div></div>")

                        }
                    },
                    error:function(){
                        $('#infoPanel').html('<div class=\'alert alert-error\'><a class="close" data-dismiss=\'alert\'>×</a>Error Could Load The Request Page</div>');
                        $('#infoPanel').show();           
                    }

                });   
            }
            function loadLeft(leafId,securityToken){
                //empty the center viewport
                $("#rightViewport").html('');        
                var url = './package/portal/main/controller/portalController.php';
                //    $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
            
                $("#rightViewport").load(url,{ method:'read',type:'list',detail:'body',leafId:leafId,pageType:'leaf',securityToken:securityToken }, function(response, status, xhr) {
        
                    
            
                    if (status == "error") {
                
                        var msg = "Sorry but there was an error: ";
                
                        $('#infoPanel').html('<div class=\'alert alert-error\'><a class="close" data-dismiss=\'alert\'>×</a>aik'+msg + xhr.status + " " + xhr.statusText+'</div>');

                    } 
                });        
            }
        </script>
        <div id="additionJs"></div>
    </body>
</html>
