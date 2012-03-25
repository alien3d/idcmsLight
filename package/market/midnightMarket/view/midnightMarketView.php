<?php

require_once("/../controller/midnightMarketController.php");
$midnightMarket = new \Core\Market\MidnightMarket\Controller\MidnightMarketClass();
if(isset($_POST['offset'])) {
    $offset= $_POST['offset'];    
} else {    
    $offset = 0;
}
if(isset($_POST['limit'])) {
    $limit = $_POST['limit'];
} else {   
    $limit = 2;
}
$midnightMarket->setStart($offset);
$midnightMarket->setLimit($limit); // normal system don't like paging.. 
$midnightMarket->execute();
$midnightMarket->setPageOutput('html');
$data = $midnightMarket->read();
require_once ("../../../../library/class/classNavigation.php");
$navigation = new \Core\Paging\HtmlPaging();
$navigation->setViewPath($midnightMarket->getViewPath());
$navigation->setOffset($offset);
$navigation->setLimit($limit);
$navigation->setTotalRecord($data[0]['total']);
?> <?php if(isset($_POST['view'])==1) { ?>
<div  class="modal hide fade" id="filterGridAdvance">
    <div class="modal-header">
        <a class="close" data-dismiss="modal1">×</a>
        <h3>Advance Search Record</h3>
    </div>
    <div class="modal-body">
        <table>
            <thead>
                <tr>
                    <th>Fields</th>
                    <th>Input</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Negeri</td>
                    <td><select name="state" id="state"></state></td>                
                </tr>
                <tr>
                    <td>Kawasan</td>
                    <td><select name="state" id="state"></state></td>                
                </tr>
                <tr>
                    <td>Hari</td>
                    <td><select name="state" id="state"></state></td>

                </tr>
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary">Search</a>
        <a href="#" onclick="showMeModal('filterGridAdvance',0)" class="btn">Close</a>
    </div>
</div>

<div align="right">    
    <input type="text" class="input-small search-query" name="query" id="query">
    <button class="btn" type="button" onclick="showMe('modal1',1)">New</button>
    <button class="btn" type="button" onclick="searchMe()">Search</button>
    <button class="btn" type="button" onclick="showMeModal('filterGridAdvance',1)">Advance Search</button>
    <button class="btn" type="button">Report</button>
</div>
<br>

<table class="table table-striped table-bordered table-condensed" name="tableData" id="tableData">   
    <thead>
        <tr>
            <th>No</th>
            <th>Negeri</th>
            <th>Kawasan</th>
            <th>Hari</th>
            <th>Google Maps</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id=tableBody>
        <?php } ?>
        <?php if(isset($_POST['tableBody'])==1) {
        if (is_array($data)) {
            $totalRecord = count($data);
            if ($totalRecord > 0) {
                $counter = 0;
                for ($i = 0; $i < $totalRecord; $i++) {
                    $counter = $i + 1;
                    ?>
                    <tr>
                        <td><?php echo $counter; ?></td>
                        <td><?php echo $data[$i]['stateDesc']; ?></td>
                        <td><?php echo $data[$i]['midnightMarketLocation']; ?></td>
                        <td><?php echo $data[$i]['dayTitle']; ?></td>
                        <td><?php //echo $data['maps'][$i];      ?></td>
                        <td><a link=""><a></td>

                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="6"><?php $midnightMarket->exceptionMessage("No Record"); ?></td>
                                </tr> 
                            <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="6"><?php $midnightMarket->exceptionMessage("Data Record Problem"); ?></td>
                            </tr>    
<?php } } ?>
                            <?php if(isset($_POST['view'])==1) { ?>
                        </tbody>
                        </table>
                        <div class="pagination" id="CorePaging" name="CorePaging"><?php echo $navigation->pagenationv4($offset); ?></div>    
                        <script language="javascript" type="text/javascript">
                            function ajaxQuery(page,type,offset,limit,params) {
                                $.ajax({
                                    type: 'POST',
                                    url: page,
                                    data: {
                                        offset: offset,
                                        limit :limit,
                                      
                                        tableBody:1,
                                        params :{
                                            
                                        },
                                        securityToken : { token :'<?php echo md5("You been cheated"); ?>' }
                                    },
                                    beforeSend:function(){
                                        // this is where we append a loading image
                                        $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
                                    },
                                    success:function(data){
                                        // successful request; do something with the data
                                        $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                                        $('#infoPanel').empty();
                                        
                                            $('#tableBody').empty();
                                            $('#pagingHtml').empty();
                                            $('#tableBody').append(data);
                                            $('#pagingHtml').append(data.pagingString);
                                        
                                    },
                                    error:function(){
                                        // failed request; give feedback to user
                                        $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                                    }
                                });
                            }
                        </script>
                        <?php } ?>
                        <?php if(isset($_POST['form'])==1) { ?>
                        <input type="hidden" name="x" id="x">
                        <script language="javascript" type="text/javascript">
                            function ajaxAudit() {
    
    }
    function newRecord(type) {
        
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
                    url: '<?php echo $midnightMarket->getControllerPath(); ?>',
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
                    url: '<?php echo $midnightMarket->getControllerPath(); ?>',
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
    function updateRecord () {
        if(type==1){
            // update record and continue
        } else  if ($type==2){
            // update record  preview(modal box)
            
        } else if (type==3){
            // update record and listing
            
        } 
        
    }
    function deleteRecord() {
        if(type==1){
            // delete record and go first record
        } else if(type==2){
            // delete record and preview(open modal box)
        }
        $.ajax({
            type: 'POST',
            url: '<?php echo $midnightMarket->getControllerPath(); ?>',
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
            url: '<?php echo $midnightMarket->getControllerPath(); ?>',
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
            url: '<?php echo $midnightMarket->getControllerPath(); ?>',
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
                url: '<?php echo $midnightMarket->getControllerPath(); ?>',
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
                url: '<?php echo $midnightMarket->getControllerPath(); ?>',
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
                url: '<?php echo $midnightMarket->getControllerPath(); ?>',
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
                        </script>    
                       <?php } ?>

