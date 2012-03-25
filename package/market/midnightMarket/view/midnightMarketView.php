<?php

require_once("/../controller/midnightMarketController.php");
require_once("/../../../system/common/controller/StateController.php");
require_once("/../../../system/common/controller/DayController.php");
$midnightMarket = new \Core\Market\MidnightMarket\Controller\MidnightMarketClass();
$state          = new \Core\System\Common\State\Controller\StateClass();
$day            = new \Core\System\Common\Day\Controller\DayClass();
if(isset($_POST['offset'])) {
    $offset= $_POST['offset'];    
} else {    
    $offset = 0;
}
if(isset($_POST['limit'])) {
    $limit = $_POST['limit'];
} else {   
    $limit = 14;
}

// additional variable
$state->setStart($offset);
$state->setLimit($limit); // normal system don't like paging.. 
$state->execute();
$state->setPageOutput('html');
$stateArray = $state->read();

$day->setStart($offset);
$day->setLimit($limit); // normal system don't like paging.. 
$day->execute();
$day->setPageOutput('html');
$dayArray = $day->read();

// end additional variable
// main
$midnightMarket->setStart($offset);
$midnightMarket->setLimit($limit); // normal system don't like paging.. 
$midnightMarket->execute();
$midnightMarket->setPageOutput('html');
$midnightMarketArray = $midnightMarket->read();


require_once ("../../../../library/class/classNavigation.php");
$navigation = new \Core\Paging\HtmlPaging();
$navigation->setViewPath($midnightMarket->getViewPath());
$navigation->setOffset($offset);
$navigation->setLimit($limit);
$navigation->setTotalRecord($midnightMarketArray [0]['total']);
?> <?php if(isset($_POST['view'])==1) { ?>
<div id="infoPanel"></div>
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
                    <td><select name="state" id="state">
                            <?php  if (is_array($stateArray)) { 
                                        $totalRecord=0;
                                        $totalRecord = count($stateArray);
                                        for($i=0;$i<$totalRecord;$i++) { ?>
                            <option value="<?php echo $stateArray[$i]['stateId']; ?>"><?php echo $stateArray[$i]['stateDesc']; ?></option>
                            <?php  } 
                            }?>
                        </state></td>                
                </tr>
                <tr>
                    <td>Kawasan</td>
                    <td><input type="text" name="midnightMarketLocation" id="midnightLocation"></td>                
                </tr>
                <tr>
                    <td>Hari</td>
                    <td><select name="day" id="day">
                            <?php  if (is_array($dayArray)) { 
                                        $totalRecord=0;
                                        $totalRecord = count($dayArray);
                                        for($i=0;$i<$totalRecord;$i++) { ?>
                            <option value="<?php echo $dayArray[$i]['dayId']; ?>"><?php echo $dayArray[$i]['dayDesc']; ?></option>
                            <?php  } 
                            }?>
                        </state></td>

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
    <a href="javascript:void(0)"class="btn"><i class="icon-plus"></i> New </a>
    <a href="javascript:void(0)" class="btn"><i class="icon-zoom-in"></i> Search </a>
    <a href="javascript:void(0)" class="btn" onclick="showMeModal('filterGridAdvance',1)"><i class="icon-zoom-in" ></i> Advance Search </a>
    <a href="javascript:void(0)" class="btn"><i class="icon-file"></i> Report </a>
    
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
        if (is_array($midnightMarketArray )) {
            $totalRecord = 0;
            $totalRecord = count($midnightMarketArray );
            if ($totalRecord > 0) {
              
                for ($i = 0; $i < $totalRecord; $i++) {
                    
                    ?>
                    <tr>
                        <td><?php echo $midnightMarketArray [$i]['counter']; ?></td>
                        <td><?php echo $midnightMarketArray [$i]['stateDesc']; ?></td>
                        <td><?php echo $midnightMarketArray [$i]['midnightMarketLocation']; ?></td>
                        <td><?php echo $midnightMarketArray [$i]['dayDesc']; ?></td>
                        <td><?php //echo $midnightMarketArray ['maps'][$i];      ?></td>
                        <td><a class="btn-warning btn-mini"><i class="icon-edit  icon-white"></i>Update</a>  <a class="btn-danger btn-mini"><i class="icon-trash  icon-white"></i> Delete</a></td>

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
                        <?php }
                              if(isset($_POST['tableBody'])==1) { ?>
                        <div class="pagination" id="pagingHtml" name="pagingHtml"><!--seperator--><?php  echo $navigation->pagenationv4($offset); ?></div>    
                          <?php } 
                                if(isset($_POST['view'])==1) { ?>
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
                                          
                                            var data = data.split("seperator");
                                            
                                            data[1]=data[1].replace("-->","");
                                            $('#tableBody').empty();
                                            $('#pagingHtml').empty();
                                            $('#tableBody').append(data[0]);
                                            $('#pagingHtml').append(data[1]);
                                        
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

