<?php
require_once("/../controller/midnightMarketController.php");
require_once("/../../../system/common/controller/StateController.php");
require_once("/../../../system/common/controller/DayController.php");
$midnightMarket = new \Core\Market\MidnightMarket\Controller\MidnightMarketClass();
$state = new \Core\System\Common\State\Controller\StateClass();
$day = new \Core\System\Common\Day\Controller\DayClass();
if (isset($_POST['offset'])) {
    $offset = $_POST['offset'];
} else {
    $offset = 0;
}
if (isset($_POST['limit'])) {
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
if (isset($_POST ['method'])) {
    if (isset($_POST ['query'])) {
        $midnightMarket->setFieldQuery($_POST ['query']);
    }
}
$midnightMarket->setStart($offset);
$midnightMarket->setLimit($limit); // normal system don't like paging.. 
// option second if don't like paging used spyscroll + popup
$midnightMarket->execute();
$midnightMarket->setPageOutput('html');
$midnightMarketArray = $midnightMarket->read();


require_once ("../../../../library/class/classNavigation.php");
$navigation = new \Core\Paging\HtmlPaging();
$navigation->setViewPath($midnightMarket->getViewPath());
$navigation->setOffset($offset);
$navigation->setLimit($limit);
if (isset($midnightMarketArray [0]['total'])) {
    $total = $midnightMarketArray [0]['total'];
} else {
    $total = 0;
}
$navigation->setTotalRecord($total);

?> <?php if (isset($_POST['view']) == 1) { ?>
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
                        <td><select name="stateIdSearch" id="stateIdSearch">
                                <?php
                                if (is_array($stateArray)) {
                                    $totalRecord = 0;
                                    $totalRecord = count($stateArray);
                                    for ($i = 0; $i < $totalRecord; $i++) {
                                        ?>
                                        <option value="<?php echo $stateArray[$i]['stateId']; ?>"><?php echo $stateArray[$i]['stateDesc']; ?></option>
                                    <?php }
                                }
                                ?>
                            </select></td>                
                    </tr>
                    <tr>
                        <td>Kawasan</td>
                        <td><input type="text" name="midnightMarketLocationSearch" id="midnightLocationSearch"></td>                
                    </tr>
                    <tr>
                        <td>Hari</td>
                        <td><select name="dayIdSearch" id="dayIdSearch">
                                <?php
                                if (is_array($dayArray)) {
                                    $totalRecord = 0;
                                    $totalRecord = count($dayArray);
                                    for ($i = 0; $i < $totalRecord; $i++) {
                                        ?>
                                        <option value="<?php echo $dayArray[$i]['dayId']; ?>"><?php echo $dayArray[$i]['dayDesc']; ?></option>
        <?php }
    }
    ?>
                            </select></td>

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
        <input type="text" class="input-large search-query" name="query" id="query">
        <a href="javascript:void(0)" class="btn" onClick="ajaxQuerySearchAll()"><i class="icon-zoom-in"></i> Search </a>
        <a href="javascript:void(0)" class="btn" onclick="showMeModal('filterGridAdvance',1)"><i class="icon-zoom-in" ></i> Advance Search </a>
        <a href="javascript:void(0)" class="btn hide" onclick="hideButton();ajaxQuery('<?php echo $midnightMarket->getViewPath(); ?>',0,<?php echo $limit; ?>)" name="clearSearch" id="clearSearch"><i class="icon-refresh" ></i>Clear Search </a>
        <a href="javascript:void(0)" class="btn" onClick="showForm()"><i class="icon-plus"></i> New </a>      
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
        <?php
        if (isset($_POST['tableBody']) == 1) {
            if (is_array($midnightMarketArray)) {
                $totalRecord = 0;
                $totalRecord = count($midnightMarketArray);
                if ($totalRecord > 0) {

                    for ($i = 0; $i < $totalRecord; $i++) {
                        ?>
                        <tr>
                            <td><?php echo $midnightMarketArray [$i]['counter']; ?></td>
                            <td><?php echo $midnightMarketArray [$i]['stateDesc']; ?></td>
                            <td><?php echo $midnightMarketArray [$i]['midnightMarketLocation']; ?></td>
                            <td><?php echo $midnightMarketArray [$i]['dayDesc']; ?></td>
                            <td><?php //echo $midnightMarketArray ['maps'][$i];      ?></td>
                            <td><a class="btn-warning btn-mini" onClick="showFormUpdate(<?php echo $midnightMarketArray [$i]['midnightMarketId']; ?>)"><i class="icon-edit  icon-white"></i>Update</a>  <a class="btn-danger btn-mini"><i class="icon-trash  icon-white"></i> Delete</a></td>

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
    <?php }
} ?>
<?php if (isset($_POST['view']) == 1) { ?>
        </tbody>
    </table>
<?php }
if (isset($_POST['tableBody']) == 1) {
    ?>
    <div class="pagination" id="pagingHtml" name="pagingHtml"><!--seperator--><?php echo $navigation->pagenationv4($offset); ?></div>    
<?php }
if (isset($_POST['view']) == 1) {
    ?>
    <script language="javascript" type="text/javascript">
        function hideButton() {
            $("#query").val('');
            $("#clearSearch").removeClass();
            $("#clearSearch").addClass('btn hide');
        }
        function ajaxQuery(page,offset,limit) {
                                    
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
        function  ajaxQuerySearchAll() {
            // unhide button search
            $("#clearSearch").removeClass();
            $("#clearSearch").addClass('btn');
            // unlimited for searching because  lazy paging.
            $.ajax({
                type: 'POST',
                url: '<?php echo $midnightMarket->getViewPath(); ?>',
                data: {
                    offset: 0,
                    limit :99999,
                    tableBody:1,
                    method:'read',
                    query : $("#query").val(),
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
        function showForm(){
            
            // unlimited for searching because  lazy paging.
            $.ajax({
                type: 'POST',
                url: '<?php echo $midnightMarket->getViewPath(); ?>',
                data: {
                    form:1,
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
                    $("#centerViewport").html("");
                    $("#centerViewport").empty();
                    $("#centerViewport").removeClass();
                    $("#centerViewport").addClass("container-fluid");
                     
                    $('#centerViewport').append(data);
                                            
                },
                error:function(){
                    // failed request; give feedback to user
                                       
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                }
            });
        }
         function showFormUpdate(midnightMarketId){
            
            // unlimited for searching because  lazy paging.
            $.ajax({
                type: 'POST',
                url: '<?php echo $midnightMarket->getViewPath(); ?>',
                data: {
                    form:1,
                    midnightMarketId:midnightMarketId,
                    securityToken : { token :'<?php echo md5("You been cheated"); ?>' }
                },
                beforeSend:function(){
                    // this is where we append a loading image
                    $('#infoPanel').html('<div class="progress"><img src="./images/loading.gif" alt="Loading..." /></div>');
                },
                success:function(data){
                    // successful request; do something with the data
                    $('#infoPanel').html('<div class=\'alert alert-info\'>Loading Complete</div>');
                    $("#centerViewport").html("");
                    $("#centerViewport").empty();
                    $("#centerViewport").removeClass();
                    $("#centerViewport").addClass("container-fluid");
                     
                    $('#centerViewport').append(data);
                                            
                },
                error:function(){
                    // failed request; give feedback to user
                                       
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                }
            });
        }
    </script>
<?php } ?>
<?php if (isset($_POST['form']) == 1) { ?>
      <div id="infoPanel"></div>
      <input type="hidden" name="midnightMarketId" value="midnightMarketId" value="<?php if(isset($_POST['midnightMarketId'])) { echo $_POST['midnightMarketId']; } ?>" 
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
                <td><select name="stateId" id="stateId">
    <?php
    if (is_array($stateArray)) {
        $totalRecord = 0;
        $totalRecord = count($stateArray);
        for ($i = 0; $i < $totalRecord; $i++) {
                if($midnightMarketArray[0]['stateId']) {
                    $selected="selected";
                } else {
                    $selected=NULL;
                }
            ?>
                                <option value="<?php echo $stateArray[$i]['stateId']; ?>" <?php echo $selected; ?>><?php echo $stateArray[$i]['stateDesc']; ?></option>
                            <?php }
                        }
                        ?>
                    </select></td>                
            </tr>
            <tr>
                <td>Kawasan</td>
                <td><input type="text" name="midnightMarketLocation" id="midnightMarketLocation" value="<?php  if(isset($midnightMarketArray[0]['midnightMarketLocation'])) { echo $midnightMarketArray[0]['midnightMarketLocation'];  } ?>"></td>                
            </tr>
            <tr>
                <td>Hari</td>
                <td><select name="dayId" id="dayId">
    <?php
    if (is_array($dayArray)) {
        $totalRecord = 0;
        $totalRecord = count($dayArray);
        for ($i = 0; $i < $totalRecord; $i++) {
            if($midnightMarketArray[0]['dayId']) {
                    $selected="selected";
                } else {
                    $selected=NULL;
                }
            ?>
                                <option value="<?php echo $dayArray[$i]['dayId']; ?>" <?php echo $selected; ?>><?php echo $dayArray[$i]['dayDesc']; ?></option>
        <?php }
    }
    ?>
                    </select></td>

            </tr>

        </tbody>
    </table>
    <div class="btn-toolbar">
                                <div class="btn-group">
                                    <a href="#" class="btn btn-warning" onClick="ajaxAudit()"><i class="icon-warning-sign icon-white"></i> Audit</a>
                                </div>
                                <div class="btn-group">
                                    <a href="javascript:void(0)" class="btn btn-success"><i class="icon-plus icon-white"></i>New</a>
                                    <a href="javascript:void(0)" data-toggle="dropdown" class="btn dropdown-toggle btn-success"><span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0)" onClick="newRecord(1)"><i class="icon-plus"></i>New &AMP; Continue</a></li>
                                        <li><a href="javascript:void(0)" onClick="newRecord(2)"><i class="icon-edit"></i>New &AMP; Update </a></li>
                                        <li><a href="javascript:void(0)" onClick="newRecord(3)"><i class="icon-print"></i>New &AMP; Continue &AMP; Print </a></li>
                                        <li><a  href="javascript:void(0)" onClick="newRecord(4)"><i class="icon-print"></i>New &AMP; Update &AMP; Print </a></li>
                                        <li><a  href="javascript:void(0)" onClick="newRecord(5)"><i class="icon-list"></i>New &AMP; Listing </a></li>
                                    </ul>
                                </div>
                                <div class="btn-group">
                                    <a href="javascript:void(0)" class="btn btn-info"><i class="icon-edit icon-white"></i>Update</a>
                                    <a href="javascript:void(0)" data-toggle="dropdown" class="btn dropdown-toggle btn-info"><span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0)"  onClick="updateRecord(1)"><i class="icon-plus"></i>Update</a></li>
                                        <li><a href="javascript:void(0)" onClick="updateRecord(2)"><><i class="icon-print"></i>Update &AMP; Print </a></li>
                                        <li><a href="javascript:void(0)" onClick="updateRecord(3)"><><i class="icon-list-alt"></i>Update &AMP; Listing </a></li>
                                    </ul>
                                </div>
                                <div class="btn-group">
                                    <a href="javascript:void(0)" class="btn btn-danger"  onClick="deleteRecord()"><><i class="icon-trash icon-white"></i> Delete</a>
                                </div>
                                <div class="btn-group">
                                    <a href="javascript:void(0)" class="btn btn-info" onClick="resetRecord()"><><i class="icon-refresh icon-white"></i> Reset</a>
                                </div>
                                <div class="btn-group">
                                    <a href="javascript:void(0)" class="btn btn-warning"  onClick="postRecord()"><><i class="icon-cog icon-white"></i> Post</a>
                                </div>
                                <div class="btn-group">
                                    <a href="javascript:void(0)" class="btn btn-info" onClick="showGrid()"><i class="icon-list icon-white"></i>Listing</a>
                                </div>
                                <div class="btn-group">
                                    <a href="javascript:void(0)" class="btn btn-info" onClick="ajaxFirst()"><><i class="icon-fast-backward icon-white"></i> First</a>
                                </div>
                                <div class="btn-group">
                                    <a href="javascript:void(0)" class="btn btn-info" onClick="ajaxPrevious()"><i class="icon-backward icon-white"></i> Previous</a>
                                </div>
                                <div class="btn-group">
                                    <a href="javascript:void(0)" class="btn btn-info" onClick="ajaxNext()"><i class="icon-forward icon-white"></i> Next</a>
                                </div>
                                <div class="btn-group">
                                    <a href="javascript:void(0)" class="btn btn-info" onClick="ajaxLast()"><i class="icon-fast-forward icon-white"></i> End</a>
                                </div>
                            </div>
    <input type="hidden" name="x" id="x">
    <script language="javascript" type="text/javascript">
        function showGrid() {
            $.ajax({
                type: 'POST',
                url: '<?php echo $midnightMarket->getViewPath(); ?>',
                data: {
                    view:1,
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
                    $("#centerViewport").html("");
                    $("#centerViewport").empty();
                    $("#centerViewport").removeClass();
                    $("#centerViewport").addClass("container-fluid");
                     
                    $('#centerViewport').append(data);
                                            
                },
                error:function(){
                    // failed request; give feedback to user
                                       
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Error Could Load The Request Page</div>');
                }
            });
        }
        function ajaxAudit() {
        
        }
        function newRecord(type) {
            
            if(type==1){
                // new record and continue
                if($("#stateId").val().length==0){
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Please Choose State First</div>');
                    $('#stateId').addClass("control-group error");
                    $('#stateId').focus();
                } else if($("#midnightMarketLocation").val().length==0){
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');                
                    $('#midnightMarketLocation').addClass("control-group error");
                    $('#midnightMarketLocation').focus();
                } else if($("#dayId").val().length==0){
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');                
                    $('#dayId').addClass("control-group error");
                    $('#dayId').focus();
                } else {
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Form Complete</div>');

                    $.ajax({
                        type: 'POST',
                        url: '<?php echo $midnightMarket->getControllerPath(); ?>',
                      
                        data: {
                            method:'create',
                            stateId: $("#stateId").val(),
                            midnightMarketLocation : $("#midnightMarketLocation").val(),
                            dayId:$("#dayId").val()
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
                                $("#stateId").val("");
                                $("#midnightMarketLocation").val("");
                                $("#dayId").val("");
                            } else if (data.success == false) {
                                $('#infoPanel').html('<div class=\'alert alert-error\'>'+data.message+'</div>');
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
                if($("#stateId").val().length==0){
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Please Choose State First</div>');
                    $('#stateId').addClass("control-group error");
                    $('#stateId').focus();
                } else if($("#midnightMarketLocation").val().length==0){
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');                
                    $('#midnightMarketLocation').addClass("control-group error");
                    $('#midnightMarketLocation').focus();
                } else if($("#dayId").val().length==0){
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');                
                    $('#dayId').addClass("control-group error");
                    $('#dayId').focus();
                }  else {
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Form Complete</div>');

                    $.ajax({
                        type: 'POST',
                        url: '<?php echo $midnightMarket->getControllerPath(); ?>',
                      
                        data: {
                              method:'create',
                            stateId: $("#stateId").val(),
                            midnightMarketLocation : $("#midnightMarketLocation").val(),
                            dayId:$("#dayId").val()
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
                if($("#stateId").val().length==0){
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Please Choose State First</div>');
                    $('#stateId').addClass("control-group error");
                    $('#stateId').focus();
                } else if($("#midnightMarketLocation").val().length==0){
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');                
                    $('#midnightMarketLocation').addClass("control-group error");
                    $('#midnightMarketLocation').focus();
                } else if($("#dayId").val().length==0){
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');                
                    $('#dayId').addClass("control-group error");
                    $('#dayId').focus();
                }  else {
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Form Complete</div>');

                    $.ajax({
                        type: 'POST',
                        url: '<?php echo $midnightMarket->getControllerPath(); ?>',
                     
                        data: {
                              method:'create',
                            stateId: $("#stateId").val(),
                            midnightMarketLocation : $("#midnightMarketLocation").val(),
                            dayId:$("#dayId").val()
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
                if($("#stateId").val().length==0){
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Please Choose State First</div>');
                    $('#stateId').addClass("control-group error");
                    $('#stateId').focus();
                } else if($("#midnightMarketLocation").val().length==0){
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');                
                    $('#midnightMarketLocation').addClass("control-group error");
                    $('#midnightMarketLocation').focus();
                } else if($("#dayId").val().length==0){
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');                
                    $('#dayId').addClass("control-group error");
                    $('#dayId').focus();
                } else {
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Form Complete</div>');

                    $.ajax({
                        type: 'POST',
                        url: '<?php echo $midnightMarket->getControllerPath(); ?>',
                      
                        data: {
                              method:'create',
                            stateId: $("#stateId").val(),
                            midnightMarketLocation : $("#midnightMarketLocation").val(),
                            dayId:$("#dayId").val()
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
                if($("#stateId").val().length==0){
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Please Choose State First</div>');
                    $('#stateId').addClass("control-group error");
                    $('#stateId').focus();
                } else if($("#midnightMarketLocation").val().length==0){
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');                
                    $('#midnightMarketLocation').addClass("control-group error");
                    $('#midnightMarketLocation').focus();
                } else if($("#dayId").val().length==0){
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');                
                    $('#dayId').addClass("control-group error");
                    $('#dayId').focus();
                }  else {
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Form Complete</div>');

                    $.ajax({
                        type: 'POST',
                        url: '<?php echo $midnightMarket->getControllerPath(); ?>',
                        
                        data: {
                              method:'create',
                            stateId: $("#stateId").val(),
                            midnightMarketLocation : $("#midnightMarketLocation").val(),
                            dayId:$("#dayId").val()
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
        function updateRecord (type) {
            if(type==1){
                // update record and continue
                if($("#stateId").val().length==0){
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Please Choose State First</div>');
                    $('#stateId').addClass("control-group error");
                    $('#stateId').focus();
                } else if($("#midnightMarketLocation").val().length==0){
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');                
                    $('#midnightMarketLocation').addClass("control-group error");
                    $('#midnightMarketLocation').focus();
                } else if($("#dayId").val().length==0){
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');                
                    $('#dayId').addClass("control-group error");
                    $('#dayId').focus();
                } else {
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Form Complete</div>');

                    $.ajax({
                        type: 'POST',
                        url: '<?php echo $midnightMarket->getControllerPath(); ?>',
                      
                        data: {
                            method:'save',
                            stateId: $("#stateId").val(),
                            midnightMarketLocation : $("#midnightMarketLocation").val(),
                            dayId:$("#dayId").val()
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
                                $("#stateId").val("");
                                $("#midnightMarketLocation").val("");
                                $("#dayId").val("");
                            } else if (data.success == false) {
                                $('#infoPanel').html('<div class=\'alert alert-error\'>'+data.message+'</div>');
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
            } else  if ($type==2){
                // update record  preview(modal box)
                if($("#stateId").val().length==0){
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Please Choose State First</div>');
                    $('#stateId').addClass("control-group error");
                    $('#stateId').focus();
                } else if($("#midnightMarketLocation").val().length==0){
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');                
                    $('#midnightMarketLocation').addClass("control-group error");
                    $('#midnightMarketLocation').focus();
                } else if($("#dayId").val().length==0){
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');                
                    $('#dayId').addClass("control-group error");
                    $('#dayId').focus();
                } else {
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Form Complete</div>');

                    $.ajax({
                        type: 'POST',
                        url: '<?php echo $midnightMarket->getControllerPath(); ?>',
                      
                        data: {
                            method:'save',
                            stateId: $("#stateId").val(),
                            midnightMarketLocation : $("#midnightMarketLocation").val(),
                            dayId:$("#dayId").val()
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
                                $("#stateId").val("");
                                $("#midnightMarketLocation").val("");
                                $("#dayId").val("");
                            } else if (data.success == false) {
                                $('#infoPanel').html('<div class=\'alert alert-error\'>'+data.message+'</div>');
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
                // update record and listing
                if($("#stateId").val().length==0){
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Please Choose State First</div>');
                    $('#stateId').addClass("control-group error");
                    $('#stateId').focus();
                } else if($("#midnightMarketLocation").val().length==0){
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');                
                    $('#midnightMarketLocation').addClass("control-group error");
                    $('#midnightMarketLocation').focus();
                } else if($("#dayId").val().length==0){
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Please Key In Description Please</div>');                
                    $('#dayId').addClass("control-group error");
                    $('#dayId').focus();
                } else {
                    $('#infoPanel').html('<div class=\'alert alert-error\'>Form Complete</div>');

                    $.ajax({
                        type: 'POST',
                        url: '<?php echo $midnightMarket->getControllerPath(); ?>',
                      
                        data: {
                            method:'save',
                            stateId: $("#stateId").val(),
                            midnightMarketLocation : $("#midnightMarketLocation").val(),
                            dayId:$("#dayId").val()
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
                                $("#stateId").val("");
                                $("#midnightMarketLocation").val("");
                                $("#dayId").val("");
                            } else if (data.success == false) {
                                $('#infoPanel').html('<div class=\'alert alert-error\'>'+data.message+'</div>');
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
        function searchAllRecord() {
            
        }
        function searchByField() {
            
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

