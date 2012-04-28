
<head>

</head>

<?php
require_once("/../controller/midnightMarketController.php");
require_once("/../../../system/common/controller/StateController.php");
require_once("/../../../system/common/controller/DayController.php");
define("LIMIT",14);
$salt="chak";
$securityToken= md5("You have been cheated").$salt;
if (isset($_POST)) {
    if (isset($_POST['method'])) {
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
            $limit = LIMIT;
        }

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

        if ($_POST['method'] == 'read') {



// additional variable
// end additional variable
// main

            if (isset($_POST ['query'])) {
                $midnightMarket->setFieldQuery($_POST ['query']);
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
            $navigation->setSecurityToken($securityToken);    
            if (isset($midnightMarketArray [0]['total'])) {
                $total = $midnightMarketArray [0]['total'];
            } else {
                $total = 0;
            }
            $navigation->setTotalRecord($total);
        }
    }
}

?> <?php if ($_POST['method'] == 'read' && $_POST['type'] == 'list') { ?>
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
                                        <?php
                                    }
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
                                        <?php
                                    }
                                }
                                ?>
                            </select></td>

                    </tr>

                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <a href="javascript:void(0)" class="btn btn-info">Search</a>
            <a href="javascript:void(0)" onclick="showMeModal('filterGridAdvance',0)" class="btn">Close</a>
        </div>
    </div>
    <div  class="modal hide fade" id="deletePreview">
        <div class="modal-header">
            <a class="close" data-dismiss="modal1">×</a>
            <h3>Are you sure want to delete this record ?</h3>
        </div>
        <div class="modal-body">
            <input type="hidden" name="midnightMarketIdPreview" id="midnightMarketIdPreview">
            <table>      
                <tr>
                    <td>Negeri</td>
                    <td><div id="stateIdPreview"></div></td>                
                </tr>
                <tr>
                    <td>Kawasan</td>
                    <td><div id="midnightMarketLocationPreview"></div></td>                
                </tr>
                <tr>
                    <td>Hari</td>
                    <td><div id="dayIdPreview"></div></td>

                </tr>

                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <a href="javascript:void(0)" class="btn btn-danger" onClick="deleteGridRecord()">Delete</a>
            <a href="javascript:void(0)" onclick="showMeModal('deletePreview',0)" class="btn">Close</a>
        </div>
    </div>

    <div align="right">    
        <input type="text" class="input-large search-query" name="query" id="query">
        <a href="javascript:void(0)" class="btn" onClick="ajaxQuerySearchAll('<?php echo $midnightMarket->getViewPath(); ?>','<?php echo $securityToken; ?>')"><i class="icon-zoom-in"></i> Search </a>
        <a href="javascript:void(0)" class="btn" onclick="showMeModal('filterGridAdvance',1)"><i class="icon-zoom-in" ></i> Advance Search </a>
        <a href="javascript:void(0)" class="btn hide" onclick="hideButton();ajaxQuery('<?php echo $midnightMarket->getViewPath(); ?>','<?php echo $securityToken; ?>',0,<?php echo LIMIT; ?>)" name="clearSearch" id="clearSearch"><i class="icon-refresh" ></i>Clear Search </a>
        <a href="javascript:void(0)" class="btn" onClick="showForm('<?php echo $midnightMarket->getViewPath(); ?>','<?php echo $securityToken; ?>')"><i class="icon-plus"></i> New </a>      
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
        if ($_POST['method'] == 'read' && $_POST['type'] == 'list' && $_POST['detail'] == 'body') {
            if (is_array($midnightMarketArray)) {
                $totalRecord = 0;
                $totalRecord = count($midnightMarketArray);
                if ($totalRecord > 0) {

                    for ($i = 0; $i < $totalRecord; $i++) {
                        ?>
                        <!--above-->
                        <tr>
                            <td><?php echo $midnightMarketArray [$i]['counter']; ?></td>
                            <td><?php echo $midnightMarketArray [$i]['stateDesc']; ?></td>
                            <td><?php echo $midnightMarketArray [$i]['midnightMarketLocation']; ?></td>
                            <td><?php echo $midnightMarketArray [$i]['dayDesc']; ?></td>
                            <td><?php //echo $midnightMarketArray ['maps'][$i];                 ?></td>
                            <td><a class="btn-warning btn-mini" onClick="showFormUpdate('<?php echo $midnightMarket->getViewPath(); ?>','<?php echo $securityToken; ?>','<?php echo intval($midnightMarketArray [$i]['midnightMarketId']); ?>')"><i class="icon-edit  icon-white"></i>Update</a>  <a class="btn-danger btn-mini" onClick="showModalDelete('<?php echo $midnightMarket->getControllerPath(); ?>','<?php echo $securityToken; ?>','<?php echo $midnightMarketArray [$i]['midnightMarketId']; ?>','<?php echo $midnightMarketArray [$i]['stateDesc']; ?>','<?php echo $midnightMarketArray [$i]['midnightMarketLocation']; ?>','<?php echo $midnightMarketArray [$i]['dayDesc']; ?>')"><i class="icon-trash  icon-white"></i> Delete</a></td>

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
                <?php
            }
        }
        ?>
          
        <?php if ($_POST['method'] == 'read' && $_POST['type'] == 'list') { ?>
        </tbody>
    </table>
    <?php
}
if ($_POST['method'] == 'read' && $_POST['type'] == 'list' && $_POST['detail'] == 'body') {
    ?>
    <div class="pagination" id="pagingHtml" name="pagingHtml"><?php echo $navigation->pagenationv4($offset); ?></div>
     <script language="javascript" type="text/javascript">
         $(document).ready(function(){
            // load the system cell if session  and token exist; 
            <?php if(isset($_POST['query'])) { ?>
                    $("#clearSearch").removeClass();
                    $("#clearSearch").addClass("btn");
            <?php } ?> 
         });       
      </script>          
    <?php
}
?>
<?php if ((isset($_POST['method']) == 'new' || isset($_POST['method']) == 'read') && $_POST['type'] == 'form') { ?>
    <div id="infoPanel"></div>
    <input type="hidden" name="midnightMarketId" id="midnightMarketId" value="<?php
    if (isset($_POST['midnightMarketId'])) {
        echo $_POST['midnightMarketId'];
    }
    ?>"> 
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
                        <option value="">Please Select Record</option>    
                        <?php
                        if (is_array($stateArray)) {
                            $totalRecord = 0;
                            $totalRecord = count($stateArray);
                            for ($i = 0; $i < $totalRecord; $i++) {
                                if (isset($midnightMarketArray[0]['stateId'])) {
                                    $selected = "selected";
                                    $stateIdOld = $stateArray[$i]['stateDesc'];
                                } else {
                                    $selected = NULL;
                                }
                                ?>
                                <option value="<?php echo $stateArray[$i]['stateId']; ?>" <?php echo $selected; ?>><?php echo $stateArray[$i]['stateDesc']; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select><input type="hidden" name="stateIdOld" value="<?php
                    if (isset($stateIdOld)) {
                        echo $stateIdOld;
                    }
                        ?>"></td>                
            </tr>
            <tr>
                <td>Kawasan</td>
                <td><input type="text" name="midnightMarketLocation" id="midnightMarketLocation" value="<?php
                                if (isset($midnightMarketArray[0]['midnightMarketLocation'])) {
                                    echo $midnightMarketArray[0]['midnightMarketLocation'];
                                    $midnightMarketLocationOld = $midnightMarketArray[0]['midnightMarketLocation'];
                                }
                        ?>"><input type="hidden" name="midnightMarketLocationOld" id="midnightMarketLocationOld" value="<?php
                       if (isset($midnightMarketLocationOld)) {
                           echo $midnightMarketLocationOld;
                       }
                        ?>"></td>                
            </tr>
            <tr>
                <td>Hari</td>
                <td><select name="dayId" id="dayId">
                        <option value="">Please Select Record</option> 
                        <?php
                        if (is_array($dayArray)) {
                            $totalRecord = 0;
                            $totalRecord = count($dayArray);
                            for ($i = 0; $i < $totalRecord; $i++) {
                                if (isset($midnightMarketArray[0]['dayId'])) {
                                    $selected = "selected";
                                    $dayIdOld = $dayArray[$i]['dayDesc'];
                                } else {
                                    $selected = NULL;
                                }
                                ?>
                                <option value="<?php echo $dayArray[$i]['dayId']; ?>" <?php echo $selected; ?>><?php echo $dayArray[$i]['dayDesc']; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select><input type="hidden" name="dayIdOld" id="dayIdOld" value="<?php
                    if (isset($dayIdOld)) {
                        echo $dayIdOld;
                    }
                        ?>"</td>

            </tr>

        </tbody>
    </table>
    <div class="btn-toolbar">
        <div class="btn-group">
            <a  name="auditRecordButton" id="auditRecordButton"  href="#" class="btn btn-warning disabled" onClick="auditRecord()"><i class="icon-warning-sign icon-white"></i> Audit</a>
        </div>
        <div class="btn-group">
            <a  name="newRecordButton1" id="newRecordButton1"  href="javascript:void(0)" class="btn btn-success  disabled"><i class="icon-plus icon-white"></i>New</a>
            <a  name="newRecordButton2" id="newRecordButton2"   href="javascript:void(0)" data-toggle="dropdown" class="btn dropdown-toggle btn-success  disabled"><span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a  name="newRecordButton3" id="newRecordButton3"   href="javascript:void(0)" onClick="newRecord(1)" class="disabled"><i class="icon-plus"></i>New &AMP; Continue</a></li>
                <li><a  name="newRecordButton4" id="newRecordButton4"   href="javascript:void(0)" onClick="newRecord(2)" class="disabled"><i class="icon-edit"></i>New &AMP; Update </a></li>
                <li><a  name="newRecordButton5" id="newRecordButton5"   href="javascript:void(0)" onClick="newRecord(3)" class="disabled"><i class="icon-print"></i>New &AMP; Continue &AMP; Print </a></li>
                <li><a  name="newRecordButton6" id="newRecordButton6"    href="javascript:void(0)" onClick="newRecord(4)" class="disabled"><i class="icon-print"></i>New &AMP; Update &AMP; Print </a></li>
                <li><a  name="newRecordButton7" id="newRecordButton7"    href="javascript:void(0)" onClick="newRecord(5)" class="disabled"><i class="icon-list"></i>New &AMP; Listing </a></li>
            </ul>
        </div>
        <div class="btn-group">
            <a  name="updateRecordButton1" id="updateRecordButton"   href="javascript:void(0)" class="btn btn-info  disabled"><i class="icon-edit icon-white"></i>Update</a>
            <a  name="updateRecordButton2" id="updateRecordButton"    href="javascript:void(0)" data-toggle="dropdown" class="btn dropdown-toggle btn-info  disabled"><span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a  name="updateRecordButton3" id="updateRecordButton"    href="javascript:void(0)"  onClick="updateRecord(1)" class="disabled"><i class="icon-plus"></i>Update</a></li>
                <li><a  name="updateRecordButton4" id="updateRecordButton"    href="javascript:void(0)" onClick="updateRecord(2)" class="disabled"><i class="icon-print"></i>Update &AMP; Print </a></li>
                <li><a  name="updateRecordButton5" id="updateRecordButton"    href="javascript:void(0)" onClick="updateRecord(3)" class="disabled"><i class="icon-list-alt"></i>Update &AMP; Listing </a></li>
            </ul>
        </div>
        <div class="btn-group">
            <a  name="deleteRecordButton" id="deleteRecordButton"  href="javascript:void(0)" class="btn btn-danger  disabled"  onClick="deleteRecord()"><i class="icon-trash icon-white"></i> Delete</a>
        </div>
        <div class="btn-group">
            <a  name="resetRecordButton" id="resetRecordButton"  href="javascript:void(0)" class="btn btn-info  disabled" onClick="resetRecord()"><i class="icon-refresh icon-white"></i> Reset</a>
        </div>
        <div class="btn-group">
            <a  name="postRecordButton" id="postRecordButton" href="javascript:void(0)" class="btn btn-warning  disabled"  onClick="postRecord()"><i class="icon-cog icon-white"></i> Post</a>
        </div>
        <div class="btn-group">
            <a  name="listRecordButton" id="listRecordButton" href="javascript:void(0)" class="btn btn-info" onClick="showGrid()"><i class="icon-list icon-white"></i>Listing</a>
        </div>
        <div class="btn-group">
            <a  name="firstRecordButton" id="firstRecordButton" href="javascript:void(0)" class="btn btn-info  disabled" onClick="firstRecord()"><i class="icon-fast-backward icon-white"></i> First</a>
        </div>
        <div class="btn-group">
            <a  name="previousRecordButton" id="previousRecordButton"  href="javascript:void(0)" class="btn btn-info  disabled" onClick="previousRecord()"><i class="icon-backward icon-white"></i> Previous</a>
        </div>
        <div class="btn-group">
            <a  name="nextRecordButton" id="nextRecordButton"  href="javascript:void(0)" class="btn btn-info  disabled" onClick="nextRecord()"><i class="icon-forward icon-white"></i> Next</a>
        </div>
        <div class="btn-group">
            <a  name="lastRecordButton" id="lastRecordButton"  href="javascript:void(0)" class="btn btn-info disabled" onClick="lastRecord()"><i class="icon-fast-forward icon-white"></i> End</a>
        </div>
    </div>
    <input type="hidden" name="x" id="x">
    <!---hidden value for navigation button-->
    <input type="hidden" name="firstRecord" id="firstRecord">       
    <input type="hidden" name="nextRecord" id="nextRecord">
    <input type="hidden" name="previousRecord" id="previousRecord">
    <input type="hidden" name="lastRecord" id="lastRecord">
    <input type="hidden" name="endRecord" id="endRecord">
    <script language="javascript" type="text/javascript">
         $(document).ready(function(){
            // load the system cell if session  and token exist; 
            <?php if(isset($_POST['query'])) { ?>
                    $("#clearSearch").removeCss();
                    $("#clearSearch").addClass("btn");
            <?php } ?>        
            <?php if($_POST['method']=='new') { ?>
            $("#resetRecordButton").removeClass();
            $("#resetRecordButton").addClass("btn btn-info");
            
            $("#newRecordButton").removeClass();
            $("#newRecordButton").addClass("btn btn-success");
            
            $("#firstRecordButton").removeClass();
            $("#firstRecordButton").addClass("btn btn-info");
            
            $("#lastRecordButton").removeClass();
            $("#lastRecordButton").addClass("btn btn-info");
            <?php } else { ?>
            <?php } ?>    
         });
        
    </script>    
<?php } ?>
<script language="javascript" type="text/javascript" src="./package/market/midnightMarket/javascript/original/midnightMarket.js"></script>

