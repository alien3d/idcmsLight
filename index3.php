
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
        <link href="./library/jquerytools/skin1.css" rel="stylesheet">
        <link href="./library/twitter2/docs/assets/css/bootstrap.css" rel="stylesheet">

        <style type="text/css">
            body {
                padding-top: 40px;
                padding-bottom: 0px;
            }
            .sidebar-nav {
                padding: 9px 0;
            }
        </style>
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
                            <li class="dropdown">

                                <a href="#about" class="dropdown-toggle"  data-toggle="dropdown" href="#"><b class="caret"></b>Core</a>
                                <ul class="dropdown-menu">
                                    <li><a href="">System</a></li>
                                    <li><hr></li>
                                    <li><a href="">Sample</a></li>
                                </ul>


                            </li>  
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Financial <b class="caret"></b></a>

                                <ul class="dropdown-menu">
                                    <li><a href="">General Ledger</a></li>
                                    <li><a href="">CashBook</a></li>
                                    <li><a href="">Account  Payable</a></li>
                                    <li><a href="">Account Receivable</a></li>
                                    <li><a href="">Project Accouting</a></li>
                                    <li><hr></li>
                                    <li><a href="">Human Resource</a></li>
                                    <li><a href="">Document Management</a></li>

                                </ul>

                            </li>
                            <li><a href="#contact">Portal</a></li>
                        </ul>
                        <p class="navbar-text pull-right">Logged in as <a href="#">username</a></p>
                    </div><!--/.nav-collapse -->
                </div>
            </div>

        </div>

        <div class="container-fluid">

            <div class="row-fluid">            
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
                </div><!--/span-->

                <div class="span9" style="border-left: 1px solid #cccccc ; padding-left:10px;
                     ">
                    <br>                       
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
                        <div class="pagination hide" id="pagingHtml" name="pagingHtml"></div>
                        <input type="text" class="input-small search-query">
                        <button class="btn" type="button" onclick="showMe('modal1',1)">New</button>
                        <button class="btn" type="button" onclick="showMe('modal2',1)">Search</button>
                        <button class="btn" type="button" onclick="showMeDiv('formEntry',1)">Filtering</button>
                        <button class="btn" type="button" onclick="showMeDiv('formEntry',0)">Excel</button>
                        <button class="btn" type="button" onclick="validateMe('titleReligionDiv',1)">Add Class</button>
                        <button class="btn" type="button" onclick="validateMe('titleReligionDiv',0)">Add Class</button>



                    </div>
                    <br>
                    <div id="infoPanel">
                    </div>
                    <input type="checkbox" onclick="toggleChecked(this.checked)"> Select / Deselect All
                    <table class="table table-striped table-bordered table-condensed hide" name="tableData" id="tableData">
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

                    <div id="formEntry">
                        <form class="well form-inline">
                            <div class="control-group" id="titleReligionDiv">
                                <label class="control-label">Title</label>
                                <div class="controls  input-prepend">
                                    <input type="text" name="religionTitle" id="religionTitle" placeholder="Title Of Religion" class="span3">
                                </div>
                            </div>
                            <div class="control-group" id="alphaNumericDiv">
                                <label class="control-label">Alpha Numeric</label>
                                <div class="controls  input-prepend">
                                    <input type="text" name="alphaNumeric" id="alphaNumeric" placeholder="Alphanumeric Validation" class="span3">
                                    <span name="alphaNumericHelpMe" id="alphaNumericHelpMe" class="help-inline"></span>
                                </div>
                            </div>
                            <div class="control-group" id="numericDiv">
                                <label class="control-label ">Numeric</label>
                                <div class="controls  input-prepend">
                                    <input type="text" name="numeric" id="numeric" placeholder="Numeric Validation" class="span3">
                                    <span name="numericHelpMe" id="numericHelpMe" class="help-inline"></span>
                                </div>
                            </div>
                            <div class="control-group" id="currencyDiv">
                                <label class="control-label">$$$ currency</label>
                                <div class="controls  input-prepend">

                                    <input type="text" name="currency" id="currency" placeholder="currency Validation" class="span3">
                                    <span name="currencyHelpMe" id="currencyHelpMe" class="help-inline"></span>
                                </div>
                            </div>

                            <div class="control-group" id="passwordDiv">
                                <label class="control-label">Password</label>
                                <div class="controls input-prepend">
                                    <span class="add-on">
                                        <i class="icon-lock"></i>
                                    </span>
                                    <input type="text" name="password" id="password" placeholder="Password Validation" class="span3">
                                    <span name="passwordHelpMe" id="passwordHelpMe" class="help-inline"></span>
                                </div>
                            </div>
                            <div class="control-group" id="emailDiv">
                                <label class="control-label">Email</label>
                                <div class="controls input-prepend">
                                    <span class="add-on">
                                        <i class="icon-envelope"></i>
                                    </span>    
                                    <input type="text" name="email" id="email" placeholder="Email Validation" class="span3">
                                    <span name="emailHelpMe" id="emailHelpMe" class="help-inline"></span>
                                </div>
                            </div>
                            <div class="control-group" id="dateDiv">
                                <label class="control-label">Date</label>
                                <div class="controls input-prepend">
                                    <span class="add-on">
                                        <i class="icon-calendar"></i>
                                    </span>    
                                    <input type="date" name="date" id="date" placeholder="Date Validation" class="span3">
                                    <span name="emailHelpMe" id="dateHelpMe" class="help-inline"></span>
                                </div>
                            </div>

                            <label class="control-label">Description</label>
                            <textarea id="textarea" class="input-xlarge" placeholder="Desc Of Religion" rows="3"></textarea>

                            <br>
                            <div class="btn-toolbar">
                                <div class="btn-group">
                                    <a href="#" class="btn btn-warning"><i class="icon-warning-sign icon-white"></i> Audit</a>
                                </div>
                                <div class="btn-group">
                                    <a href="#" class="btn btn-success"><i class="icon-plus icon-white"></i>New</a>
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
                                    <a href="#" class="btn btn-info"><i class="icon-edit icon-white"></i>Update</a>
                                    <a href="#" data-toggle="dropdown" class="btn dropdown-toggle btn-info"><span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#"><i class="icon-plus"></i>Update</a></li>
                                        <li><a href="#"><i class="icon-print"></i>Update &AMP; Print </a></li>
                                        <li><a href="#"><i class="icon-list-alt"></i>Update &AMP; Listing </a></li>
                                    </ul>
                                </div>
                                <div class="btn-group">
                                    <a href="#" class="btn btn-danger"><i class="icon-trash icon-white"></i> Delete</a>
                                </div>
                                <div class="btn-group">
                                    <a href="#" class="btn btn-info"><i class="icon-refresh icon-white"></i> Reset</a>
                                </div>
                                <div class="btn-group">
                                    <a href="#" class="btn btn-warning"><i class="icon-cog icon-white"></i> Post</a>
                                </div>
                                <div class="btn-group">
                                    <a href="#" class="btn btn-info"><i class="icon-list icon-white"></i>Listing</a>
                                </div>
                                <div class="btn-group">
                                    <a href="#" class="btn btn-info"><i class="icon-fast-backward icon-white"></i> First</a>
                                </div>
                                <div class="btn-group">
                                    <a href="#" class="btn btn-info"><i class="icon-backward icon-white"></i> Previous</a>
                                </div>
                                <div class="btn-group">
                                    <a href="#" class="btn btn-info"><i class="icon-forward icon-white"></i> Next</a>
                                </div>
                                <div class="btn-group">
                                    <a href="#" class="btn btn-info"><i class="icon-fast-forward icon-white"></i> End</a>
                                </div>
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
<script language="javascript" type="text/javascript" src="./library/jquerytools/jquery.tools.min.js"></script>

<script language="javascript" type="text/javascript">
    // onload load the first 10 record first
    $(document).ready(function(){
        // ajaxQuery('dummy.php','new',0,'');
        // testingValidation
        // testing alphanumeric
        validateMeAlphaNumeric('alphaNumeric');
        // testing numeric
        validateMeNumeric('numeric');
        // testing currency
        validateMeCurrency('currency');
        // testing email
        validateMeEmail('email'); 
        // testing password
        validateMePassword('password');
        // date
        $("#date").dateinput({
            format :'dd mmm yyyy'
        });
    });
    
    function toggleChecked(status) {

        $(":checkbox").each( function() {
            //alert($(this).val());
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
                $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
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
    function ajaxAudit() {
    
    }
    function ajaxNew(type) {
        
        if(type==1){
            // new record and continue
            if($("#religionTitle").val().length==0){
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Title Please</div>');
                $('#religionTitle').addClass("control-group error");
                $('#religionTitle').focus();
            } else if($("#religionDesc").val().length==0){
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');                
                $('#religionDesc').addClass("control-group error");
                $('#religionDesc').focus();
            }  else {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Form Complete</div>');

                $.ajax({
                    type: 'POST',
                    url: page,
                    data: {
                        religionTitle: $("#religionTitle").val(),
                        religionDesc : $("#religionDesc").val()
                    },
                    beforeSend:function(){
                        // this is where we append a loading image
                        $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
                    },
                    success:function(data){
                        // successful request; do something with the data
                        if(data.success == true) {
                            $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                            // reseting field value
                            $("#religionTitle").val("");
                            $("#religionDesc").val("");
                        }
                    
                    },
                    error:function(data){
                        // failed request; give feedback to user
                        if(data.success==false){
                            $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                        }
                    }
                });
            }
            

        } else if (type==2){
            // new record and update
            // new record and continue
            if($("#religionTitle").val().length==0){
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Title Please</div>');
                $('#religionTitle').addClass("control-group error");
                $('#religionTitle').focus();
            } else if($("#religionDesc").val().length==0){
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');                
                $('#religionDesc').addClass("control-group error");
                $('#religionDesc').focus();
            }  else {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Form Complete</div>');

                $.ajax({
                    type: 'POST',
                    url: page,
                    data: {
                        religionTitle: $("#religionTitle").val(),
                        religionDesc : $("#religionDesc").val()
                    },
                    beforeSend:function(){
                        // this is where we append a loading image
                        $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
                    },
                    success:function(data){
                        // successful request; do something with the data
                        if(data.success == true) {
                            $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                            // reseting field value
                            $("#religionTitle").val("");
                            $("#religionDesc").val("");
                        }
                    
                    },
                    error:function(data){
                        // failed request; give feedback to user
                        if(data.success==false){
                            $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                        }
                    }
                });
            }
    
            
        } else if (type==3){
            // new record and continue and print/preview(Open modal box)
            // new record and continue
            if($("#religionTitle").val().length==0){
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Title Please</div>');
                $('#religionTitle').addClass("control-group error");
                $('#religionTitle').focus();
            } else if($("#religionDesc").val().length==0){
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');                
                $('#religionDesc').addClass("control-group error");
                $('#religionDesc').focus();
            }  else {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Form Complete</div>');

                $.ajax({
                    type: 'POST',
                    url: page,
                    data: {
                        religionTitle: $("#religionTitle").val(),
                        religionDesc : $("#religionDesc").val()
                    },
                    beforeSend:function(){
                        // this is where we append a loading image
                        $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
                    },
                    success:function(data){
                        // successful request; do something with the data
                        if(data.success == true) {
                            $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                            // reseting field value
                            $("#religionTitle").val("");
                            $("#religionDesc").val("");
                        }
                    
                    },
                    error:function(data){
                        // failed request; give feedback to user
                        if(data.success==false){
                            $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                        }
                    }
                });
            }    

            
        } else if (type==4){
            // new record and update and  print/preview(open modal box)
            // new record and continue
            if($("#religionTitle").val().length==0){
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Title Please</div>');
                $('#religionTitle').addClass("control-group error");
                $('#religionTitle').focus();
            } else if($("#religionDesc").val().length==0){
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');                
                $('#religionDesc').addClass("control-group error");
                $('#religionDesc').focus();
            }  else {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Form Complete</div>');

                $.ajax({
                    type: 'POST',
                    url: page,
                    data: {
                        religionTitle: $("#religionTitle").val(),
                        religionDesc : $("#religionDesc").val()
                    },
                    beforeSend:function(){
                        // this is where we append a loading image
                        $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
                    },
                    success:function(data){
                        // successful request; do something with the data
                        if(data.success == true) {
                            $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                            // reseting field value
                            $("#religionTitle").val("");
                            $("#religionDesc").val("");
                        }
                    
                    },
                    error:function(data){
                        // failed request; give feedback to user
                        if(data.success==false){
                            $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                        }
                    }
                });
            }
        } else if (type==5){
            // new record and listing
            // new record and continue
            if($("#religionTitle").val().length==0){
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Title Please</div>');
                $('#religionTitle').addClass("control-group error");
                $('#religionTitle').focus();
            } else if($("#religionDesc").val().length==0){
                $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');                
                $('#religionDesc').addClass("control-group error");
                $('#religionDesc').focus();
            }  else {
                $('#infoPanel').html('<div class=\'alert alert-error\'>Form Complete</div>');

                $.ajax({
                    type: 'POST',
                    url: page,
                    data: {
                        religionTitle: $("#religionTitle").val(),
                        religionDesc : $("#religionDesc").val()
                    },
                    beforeSend:function(){
                        // this is where we append a loading image
                        $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
                    },
                    success:function(data){
                        // successful request; do something with the data
                        if(data.success == true) {
                            $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                            // reseting field value
                            $("#religionTitle").val("");
                            $("#religionDesc").val("");
                        }
                    
                    },
                    error:function(data){
                        // failed request; give feedback to user
                        if(data.success==false){
                            $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                        }
                    }
                });
            }
    
            showMeDiv('tableDate',0);
            showMeDiv('formEntry',1);
        }
    }
    function ajaxUpdate () {
        if(type==1){
            // update record and continue
        } else  if ($type==2){
            // update record  preview(modal box)
            
        } else if (type==3){
            // update record and listing
            
        } 
        
    }
    function ajaxDelete() {
        if(type==1){
            // delete record and go first record
        } else if(type==2){
            // delete record and preview(open modal box)
        }
        $.ajax({
            type: 'POST',
            url: page,
            data: {
                religionId : $("#religionId").val()
            },
            beforeSend:function(){
                // this is where we append a loading image
                $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
            },
            success:function(data){
                // successful request; do something with the data
                if(data.success == true) {
                    $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                    // reseting field value
                    $("#religionTitle").val("");
                    $("#religionDesc").val("");
                }
                    
            },
            error:function(data){
                // failed request; give feedback to user
                if(data.success==false){
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                }
            }
        });
            
    }
    function ajaxReset() {
        $("#religionId").val();
        $("#religionTitle").val();
        $("#religionDesc").val();
        
    }
    function ajaxPost() {
        
    }
    function ajaxFirst() {
        $.ajax({
            type: 'POST',
            url: page,
            data: {
                religionTitle: $("#religionId").val()
            },
            beforeSend:function(){
                // this is where we append a loading image
                $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
            },
            success:function(data){
                // successful request; do something with the data
                if(data.success == true) {
                    $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                    // reseting field value
                    $("#religionTitle").val("");
                    $("#religionDesc").val("");
                }
                    
            },
            error:function(data){
                // failed request; give feedback to user
                if(data.success==false){
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                }
            }
        });
    }
    function ajaxLast() {
        $.ajax({
            type: 'POST',
            url: page,
            data: {
                religionId: $("#religionId").val()
            },
            beforeSend:function(){
                // this is where we append a loading image
                $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
            },
            success:function(data){
                // successful request; do something with the data
                if(data.success == true) {
                    $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                    // reseting field value
                    $("#religionTitle").val("");
                    $("#religionDesc").val("");
                }
                    
            },
            error:function(data){
                // failed request; give feedback to user
                if(data.success==false){
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                }
            }
        });
        
    }
    function ajaxNext() {
        $('#newButton').removeClass();
        if ($('#nextRecord').val() == '' || $('#nextRecord').val() == undefined) {
            $('#infoPanel').html('<div class=\'alert alert-error\'>'+chooseRecordLabel+'</div>');
        }
        if ($('#nextRecord').val() <= $('#lastRecord').val()) {
            $.ajax({
                type: 'POST',
                url: page,
                data: {
                    method: 'read',
                    religionId: $("#religionId").val(),
                    leafId: leafId,
                    isAdmin: isAdmin,
                    render : false
                },
                beforeSend:function(){
                    // this is where we append a loading image
                    $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
                },
                success:function(data){
                    // successful request; do something with the data
                    if(data.success == true) {
                        $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                        // reseting field value
                        $("#religionTitle").val("");
                        $("#religionDesc").val("");
                    }
                    
                },
                error:function(data){
                    // failed request; give feedback to user
                    if(data.success==false){
                        $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                    }
                }
            });
        }
    }
    function ajaxLast() {
        $("#newButton").removeClass();        
        $("#newButton").addClass(".disable");
        if($("#lastRecord").val() =='' || $("#lastRecord").value==undefined){
            $.ajax({
                type: 'POST',
                url: page,
                data: {
                    
                    method: 'dataNavigationRequest',
                    leafId: leafId,
                    dataNavigation: 'lastRecord'
                },
                beforeSend:function(){
                    // this is where we append a loading image
                    $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
                },
                success:function(data){
                    // successful request; do something with the data
                    if(data.success == true) {
                        // navigation bar
                        if (data.nextRecord == 0) {
                            $('#previousButton').removeClass();
                            $('#previousButton').addClass(".disabled");
                        } else {
                            Ext.getCmp('previousButton').enable();
                            $('#previousButton').removeClass();
                            $('#previousButton').addClass(".active");
                        }
                        $('#firstRecord').val(data.firstRecord);
                        $('#previousRecord').val(data.previousRecord);
                        $('#nextRecord').val(data.nextRecord);
                        $('#lastRecord').val(data.lastRecord);
                        $('#endRecord').val((data.lastRecord + 1));
                        $('#nextButton').removeClass();
                        $('#nextButton').addClass(".disabled");
                        $('#previousButton').removeClass();
                        $('#previousButton').addClass(".active");
                        // end navigation bar
                        // start load data
                        $('#religionId').val(data.religionId);
                        $('#religionTitle').val(data.religionTitle);
                        $('#religionDesc').val(data.religionDesc);
                        // end load data.
                        $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                       
                    }
                    
                },
                error:function(data){
                    // failed request; give feedback to user
                    if(data.success==false){
                        $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                    }
                }
            });
        } else {
            $.ajax({
                type: 'POST',
                url: page,
                data: {
                    religionId: $("#religionId").val()
                },
                beforeSend:function(){
                    // this is where we append a loading image
                    $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
                },
                success:function(data){
                    // successful request; do something with the data
                    if(data.success == true) {
                        $('#firstRecord').val(data.firstRecord);
                        $('#previousRecord').val(data.previousRecord);
                        $('#nextRecord').val(data.nextRecord);
                        $('#lastRecord').val(data.lastRecord);
                        $('#endRecord').val((data.lastRecord + 1));
                        $('#nextButton').removeClass();
                        $('#nextButton').addClass(".disabled");
                        $('#previousButton').removeClass();
                        $('#previousButton').addClass(".active");
                        // end navigation bar
                        // start load data
                        $('#religionId').val(data.religionId);
                        $('#religionTitle').val(data.religionTitle);
                        $('#religionDesc').val(data.religionDesc);
                        $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                        
                    }
                    
                },
                error:function(data){
                    // failed request; give feedback to user
                    if(data.success==false){
                        $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                    }
                }
            });
        }
        
    }
    function showMeModal(id,toggle){
        var activity='';
        if(toggle==1) {
            activity='show';
        }  else {
            activity ='hide';
        }     
        $("#"+id).modal(activity);       
    }
    function showMeDiv(id,toggle){
        if(toggle==1){
            $("#"+id).show(5,function(){
                $('#infoPanel').html('<div class=\'alert alert-info\'>Cak Cak</div>');

            }).slideDown('slow').fadeIn();
        } else {
            $("#"+id).hide(5,function(){
                $('#infoPanel').html('<div class=\'alert alert-info\'>Sorok jab</div>');
            });
        }
    }
    function showMeSideBar(counter,total) {
        for(i=1;i<total+1;i++) {
            if("#common"+counter != "#common"+i) {
    				
                $("#common"+i).each(function() {
                    $("#folder"+i).attr('src','images/icons/folder.png');
                    $(this).addClass("hide");
                });
            } else { 
    		
                $("#common"+i).each(function() {
                    $("#folder"+i).attr('src','images/icons/folder-open.png');
                    $(this).removeClass();
                });
            } 
        }
    	
    	
    }
    function validateMePassword(id){
        validateMeColor(id,0,'','');
        
        $('#'+id).keyup(function() {
            var password = $('#'+id).val();
            if(password.length==0){
                validateMeColor(id,1,'error','Please fill password field');

            }else if(password.length < 6){
                   
                validateMeColor(id,1,'warning','Weak Password');

            }else{
                var regex_simple = /^[a-z]$/;
                var regex_capital = /^[A-Z]$/;
                var regex_numbers = /^[0-9]$/;

                var simple_status  = '0';
                var capital_status = '0';
                var number_status  = '0';
                var status_count   = '0';

                for(i=0;i<password.length;i++){
                    var check_character = password.charAt(i);

                    if(regex_simple.test(check_character) && simple_status == '0'){
                        simple_status = '1';
                        status_count++;
                    }
                    if(regex_capital.test(check_character) && capital_status == '0'){
                        capital_status = '1';
                        status_count++;
                    }
                    if(regex_numbers.test(check_character) && number_status == '0'){
                        number_status = '1';
                        status_count++;
                    }
                }

                switch(status_count){
                    case 0:
                            
                        validateMeColor(id,1,'warning','Weak Password');

                        break;
                    case 1:

                            
                        validateMeColor(id,1,'success','Good Password');

                        break;

                    case 2:
                            
                        validateMeColor(id,1,'success','Strong Password');

                        break;

                    case 3:
                            
                        validateMeColor(id,1,'success','Superb Password');

                        break;
                }



            }
        });
       
    }
    
    function validateMeEmail(id){
        // reset first any old validation color
        validateMeColor(id,0,'','');
        // start validate
        $("#"+id).blur(function(){
            var email = $('#'+id).val();
            
            var reEmail = /^[A-Za-z0-9][a-zA-Z0-9._-][A-Za-z0-9]+@([a-zA-Z0-9.-]+\.)+[a-zA-Z0-9.-]{2,4}$/;
            if (email == '') {
               
                validateMeColor(id,1,'warning','Field cannot be empty');
            }else if(email.length > 60){
                
                validateMeColor(id,1,'warning','Email cannot exceed 60 characters');
            }else if(!reEmail.test(email)){
                
                validateMeColor(id,1,'error','Invalid Email');
            } else {
                validateMeColor(id,0,'','');
            }
        });
    }
    function validateMeAlphaNumeric(id) {
       
        $("#"+id).keyup(function(){
            $(this).val( $(this).val().replace(/[^0-9a-zA-Z]/g, "").replace(/^\./, "") ); 
        }).blur(function(){ $(this).val( $(this).val().replace(/[^0-9a-zA-Z]/g, "").replace(/^/, "") ); });
    }
    function validateMeNumeric(id){
        $("#"+id).keyup(function(){
            $(this).val( $(this).val().replace(/[^0-9\.]/g, "").replace(/^\./, "") ); 
        }).blur(function(){ $(this).val( $(this).val().replace(/[^0-9]/g, "").replace(/^/, "") ); });
    }
    function validateMeCurrency(id){
        // by basic will have 
        
        
        $("#"+id).keyup(function(){
            $(this).val( $(this).val().replace(/[^0-9\.]/g, "").replace(/^\./, "") ); 
        }).blur(function(){ $(this).val( $(this).val().replace(/[^0-9\.]/g, "").replace(/^\./, "") ); });
     
    }
    function validateMeDate(id){
        $("#"+id).focus();
    }
    function validateMeColor(id,toggle,type,text){
        cssClass='';
       
        if(toggle==1) {
            $("#"+id).focus();
            if (type=='warning'){
                cssClass="control-group warning";

            } else if (type=='error') {
                cssClass="control-group error";

            } else if (type=='success'){
                cssClass="control-group success";

            }
            $("#"+id+"Div").removeClass();
            $("#"+id+"Div").addClass(cssClass);
            // inline helper
            $("#"+id+"HelpMe").empty();
            $("#"+id+"HelpMe").html(text);
            
           
           
        }  else {
            cssClass="control-group"
            $("#"+id+"Div").removeClass();
            $("#"+id+"Div").addClass(cssClass);
            // inline helper
            $("#"+id+"HelpMe").empty();
        }     
         
    }
    function routing(id,total,page) {
        // appear a  small tick icon.Preventing the usage of breadcrumb eating space
        for(i=1;i<total+1;i++) {
            $("#choosenLeaf"+i).html("");
            if(id == i ) {
                $("#choosenLeaf"+i).html("<img src='images/icons/tick-red.png' alt='Choosen Leaf' width=16 height=16>");
            } 
        }
        // appear a load ajax icon like facebook style.
        //$("#choosenLeafWaitingIcon"+i).html("<img src='images/loading.gif' alt='loading page'"); 
    }

</script>
</html>