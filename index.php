
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Bootstrap, from Twitter</title>
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
        <!--[if lt IE 9]>
          <script src="./library/html5.js"></script>
        <![endif]-->

        <!-- Le styles -->
        <link href="./library/twitter2/docs/assets/css/bootstrap.css" rel="stylesheet">
        <style type="text/css">
            body {
                padding-top: 60px;
            }
        </style>

        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="images/favicon.ico">
        <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
    </head>

    <body>

        <div class="navbar navbar-fixed" id="viewportTop">
            <div class="navbar-inner">
                <div class="fluid-container">
                    <a class="brand" href="#">Core</a>
                    <ul class="nav">
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                    <p class="pull-right">Logged in as <a href="#">username</a></p>
                </div>
            </div>
        </div>

        <div class="fluid-container sidebar-left" id="viewportLeft">
            <div class="fluid-sidebar">
                <div class="well side-nav">
                    <h5 class="nav-label">System Entry</h5>
                    <ul class="nav list">
                        <li> <a class="nav-item" href="#"><i class="icon book"></i>Application</a></li>
                        <li><a class="nav-item" href="#"><i class="icon book"></i>Module</a></li>
                        <li><a class="nav-item" href="#"><i class="icon book"></i>Folder</a></li>
                        <li><a class="nav-item" href="#"><i class="icon book"></i>Leaf</a></li>
                        <li><a class="nav-item" href="#"><i class="icon book"></i>Language</a></li>
                    </ul>
                    <h5 class="nav-label">Translation</h5>
                    <ul class="nav-group">
                        <li><a class="nav-item" href="#"><i class="icon book"></i>Default Label</a></li>
                        <li><a class="nav-item" href="#"><i class="icon book"></i>Table Mapping</a></li>
                        <li><a class="nav-item" href="#"><i class="icon book"></i>System String</a></li>

                    </ul>
                    <h5 class="nav-label">Personnel</h5>
                    <ul class="nav-group">
                        <li><a class="nav-item" href="#"><i class="icon book"></i>Peference</a></li>
                        <li><a class="nav-item" href="#"><i class="icon book"></i>Change Password</a></li>
                    </ul>
                    <h5 class="nav-label">Common</h5>
                    <ul class="nav-group">
                        <li><a class="nav-item" href="#"><i class="icon book"></i>District</a></li>
                        <li><a class="nav-item" href="#"><i class="icon book"></i>State</a></li>
                    </ul>
                </div>
            </div>
            <div class="fluid-content" id="viewportRight">
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Setting</a> <span class="divider">/</span>
                    </li>
                    <li class="active">
                        Religion
                    </li>

                </ul>
                <div align="right">
                    <form>
                        <input type="text" class="input-small search-query">
                        <button class="btn" type="button">Search</button>
                        <button class="btn" type="button">Filtering</button>
                        <button class="btn" type="button">Excel</button>
                    </form>
                </div>    
                <div id="infoPanel">
                </div>    
                <input type="checkbox" onclick="toggleChecked(this.checked)"> Select / Deselect All
                <table class="table table-striped table-bordered table-condensed" name="tableData" id="tableData">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Delete</th>
                            <th>Description</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody id=tableBody>
                    </tbody>    
                </table>
                <div class="pagination" id="pagingHtml" name="pagingHtml">


                </div> 

                <!-- start form -->
                <!-- end form -->
                <footer id="viewportBelow">
                    <p>&copy; IDCMS Core,Twitter Bootstrap 2012</p>
                </footer>
            </div>
        </div>

    </body>
    <script language="javascript" type="text/javascript" src="./library/jquery/jquery-1.7.1.js"></script>
    <script language="javascript" type="text/javascript" src="./library/twitter2/js/bootstrap-modal.js"></script>
    <script language="javascript" type="text/javascript">
        // onload load the first 10 record first
        $(document).ready(function(){
            ajaxQuery('dummy.php','new',0,'');
        });
        function toggleChecked(status) {
        
            $(":checkbox").each( function() {
                alert($(this).val());
                $(this).attr("checked",status);
            });
        }
        function ajaxQuery(page,type,offset,params) {
            $.ajax({
                type: 'POST',
                url: page,
                data: { 
                    offset: offset, 
                    params : params 
                },
                beforeSend:function(){
                    // this is where we append a loading image
                    $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
                },
                success:function(data){
                    // successful request; do something with the data
                   // $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                   $('#infoPanel').empty();
                    if(type == 'new') {
                        $('#tableBody').append(data.tableString);
                        $('#pagingHtml').append(data.pagingString);
                    } else {
                        $('#tableBody').empty();
                        $('#pagingHtml').empty();
                        $('#tableBody').append(data.tableString);
                        $('#pagingHtml').append(data.pagingString);
                    }
                },
                error:function(){
                    // failed request; give feedback to user
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                }
            });
        }
    </script>
</html>