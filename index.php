
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
                padding-bottom: 40px;
            }
            .sidebar-nav {
                padding: 9px 0;
            }
        </style>
        <link href="./library/twitter2/docs/assets/css/bootstrap-responsive.css" rel="stylesheet">
        <link href="./library/twitter2/docs/assets/css/bootstrap-responsive.css" rel="stylesheet">

        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="images/favicon.ico">
        <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
    </head>

    <body>


        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">

                        <span class="i-bar"></span>
                        <span class="i-bar"></span>
                        <span class="i-bar"></span>
                    </a>
                    <a class="brand" href="#">Core </a>
                    <div class="nav-collapse">
                        <ul class="nav">
                            <li class="active"><a href="#">Home</a></li>

                            <li><a href="#about">About</a></li>
                            <li><a href="#contact">Contact</a></li>
                        </ul>
                        <p class="navbar-text pull-right">Logged in as <a href="#">username</a></p>
                    </div><!--/.nav-collapse -->
                </div>
            </div>

        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span3">
                    <div class="well sidebar-nav">
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

                    </div><!--/.well -->
                </div><!--/span-->
                <div class="span9">
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Setting</a> <span class="divider">/</span>
                        </li>
                        <li class="active">
                            Religion
                        </li>

                    </ul>
                    <div  class="modal hide fade" id="modal1" style="display: none;">
                        <div class="modal-header">
                            <a class="close" data-dismiss="modal1">×</a>
                            <h3>Modal header</h3>
                        </div>
                        <div class="modal-body">
                            <p>One fine body…</p>
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-primary">Save changes</a>
                            <a href="#" onclick="showMe('modal1',0)" class="btn">Close</a>
                        </div>
                    </div>
                    <div  class="modal hide fade" id="modal2" style="display: none;">
                        <div class="modal-header">
                            <a class="close" data-dismiss="modal2">×</a>
                            <h3>Modal header</h3>
                        </div>
                        <div class="modal-body">
                            <p>second body…</p>
                        </div>
                        <div class="modal-footer">
                            <a href="#"  class="btn btn-primary">Save changes</a>
                            <a href="#" onclick="showMe('modal2',0)" class="btn">Close</a>
                        </div>
                    </div>
                    <div align="right">

                        <input type="text" class="input-small search-query">
                        <button class="btn" type="button" onclick="showMe('modal1',1)">New</button>
                        <button class="btn" type="button" onclick="showMe('modal2',1)">Search</button>
                        <button class="btn" type="button">Filtering</button>
                        <button class="btn" type="button" >Excel</button>

                    </div>
                    <div id="infoPanel">
                    </div>
                    <input type="checkbox" onclick="toggleChecked(this.checked)"> Select / Deselect All
                    <table class="table table-striped table-bordered table-condensed hide fade" name="tableData" id="tableData">
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
                    <div class="pagination hide" id="pagingHtml" name="pagingHtml"></div>
                    <div id="formEntry">
                        <form class="well">
                            <label>Title</label>
                            <input type="text" placeholder="Title Of Religion" class="span3">
                            <label>Description</label>
                            <textarea id="textarea" class="input-xlarge" placeholder="Desc Of Religion" rows="3"></textarea>
                            <br>
                            <div class="btn-toolbar">
                                <a href="#" class="btn btn-warning"><i class="icon-warning-sign"></i> Audit</a>
                                <div class="btn-group">
                                    <a href="#" class="btn btn-success">New</a>
                                    <a href="#" data-toggle="dropdown" class="btn dropdown-toggle btn-success"><span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"><i class="icon-plus"></i>New &AMP; Continue</a></li>
                                        <li><a href="#"><i class="icon-edit"></i>New &AMP; Update </a></li>
                                        <li><a href="#"><i class="icon-print"></i>New &AMP; Continue &AMP; Print </a></li>
                                        <li><a  href="#"><i class="icon-print"></i>New &AMP; Update &AMP; Print </a></li>
                                        <li><a  href="#"><i class="icon-list"></i>New &AMP; Listing </a></li>
                                    </ul>
                                </div>
                                <div class="btn-group">
                                    <a href="#" class="btn btn-info">Update</a>
                                    <a href="#" data-toggle="dropdown" class="btn dropdown-toggle btn-info"><span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"><i class="icon-plus"></i>Update</a></li>
                                        <li><a href="#"><i class="icon-print"></i>Update &AMP; Print </a></li>
                                        <li><a href="#"><i class="icon-list-alt"></i>Update &AMP; Listing </a></li>
                                    </ul>
                                </div>
                                <a href="#" class="btn btn-danger"><i class="icon-trash icon-white"></i> Delete</a>
                                <a href="#" class="btn btn-info"><i class="icon-refresh"></i> Reset</a>
                                <a href="#" class="btn btn-warning"><i class="icon-cog"></i> Post</a>
                                <a href="#" class="btn btn-info"><i class="icon-list"></i>Listing</a>
                                <a href="#" class="btn btn-info"><i class="icon-fast-backward"></i> First</a>
                                <a href="#" class="btn btn-info"><i class="icon-backward"></i> Previous</a>
                                <a href="#" class="btn btn-info"><i class="icon-forward"></i> Next</a>
                                <a href="#" class="btn btn-info"><i class="icon-fast-forward"></i> End</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!--/span-->
        </div><!--/row-->

        <hr>
        <!-- start form -->
        <!-- end form -->
        <footer id="viewportBelow">
            <p>&copy; IDCMS Core,Twitter Bootstrap 2012</p>
        </footer>
    </div>

</body>
<script language="javascript" type="text/javascript" src="./library/jquery/jquery-1.7.1.js"></script>
<script language="javascript" type="text/javascript" src="./library/twitter2/js/bootstrap-alert.js"></script>
<script language="javascript" type="text/javascript" src="./library/twitter2/js/bootstrap-button.js"></script>
<script language="javascript" type="text/javascript" src="./library/twitter2/js/bootstrap-carousel.js"></script>
<script language="javascript" type="text/javascript" src="./library/twitter2/js/bootstrap-collapse.js"></script>
<script language="javascript" type="text/javascript" src="./library/twitter2/js/bootstrap-dropdown.js"></script>
<script language="javascript" type="text/javascript" src="./library/twitter2/js/bootstrap-modal.js"></script>
<script language="javascript" type="text/javascript" src="./library/twitter2/js/bootstrap-scrollspy.js"></script>
<script language="javascript" type="text/javascript" src="./library/twitter2/js/bootstrap-tab.js"></script>
<script language="javascript" type="text/javascript" src="./library/twitter2/js/bootstrap-tooltip.js"></script>

<script language="javascript" type="text/javascript" src="./library/twitter2/js/bootstrap-transition.js"></script>
<script language="javascript" type="text/javascript" src="./library/twitter2/js/bootstrap-typeahead.js"></script>

<script language="javascript" type="text/javascript">
    // onload load the first 10 record first
    $(document).ready(function(){
        // ajaxQuery('dummy.php','new',0,'');
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
    function showMe(id,toggle){
        if(toggle==1) {
            $("#"+id).modal('show');
        } else {
            $("#"+id).modal('hide');
        }

    }

</script>
</html>