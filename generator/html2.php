<?php
$str.="<?php require_once('/../controller/".$data[0]['tableName'].".php'); \n";
$str.="require_once('/../../../system/common/controller/StateController.php');  \n";
$str.="require_once('/../../../system/common/controller/DayController.php');  \n";
$str.="if (isset(\$_POST)) {  \n";
$str.="    if (isset(\$_POST['method'])) {  \n";
$str.="        \$".$data[0]['tableName']." = new \Core\Market\MidnightMarket\Controller\/".ucwords($data[0]['tableName'])."Class();  \n";
$str.="        \$state = new \Core\System\Common\State\Controller\StateClass();  \n";
$str.="        \$day = new \Core\System\Common\Day\Controller\DayClass();  \n";
$str.="        if (isset(\$_POST['offset'])) {  \n";
$str.="            \$offset = \$_POST['offset'];  \n";
$str.="        } else {";
$str.="            \$offset = 0;  \n";
$str.="        }";
$str.="        if (isset(\$_POST['limit'])) {  \n";
$str.="            \$limit = \$_POST['limit'];  \n";
$str.="        } else {";
$str.="            \$limit = LIMIT;  \n";
$str.="        }";
$str.="        \$state->setStart(\$offset);  \n";
$str.="        \$state->setLimit(\$limit); // normal system don't like paging..  \n"; 
$str.="        \$state->setPageOutput('html');  \n";
$str.="        \$stateArray = \$state->read();  \n";
$str.="        \$day->setStart(\$offset);  \n";
$str.="        \$day->setLimit(\$limit); // normal system don't like paging..  \n";
$str.="        \$day->execute();  \n";
$str.="        \$day->setPageOutput('html');  \n";
$str.="        \$dayArray = \$day->read();  \n";
$str.="        if (\$_POST['method'] == 'read') {  \n";
$str.="            if (isset(\$_POST ['query'])) {  \n";
$str.="                \$".$data[0]['tableName']."->setFieldQuery(\$_POST ['query']);  \n";
$str.="            }  \n";        
$str.="            \$".$data[0]['tableName']."->setStart(\$offset);  \n";
$str.="            \$".$data[0]['tableName']."->setLimit(\$limit); // normal system don't like paging..  \n";
$str.="            \$".$data[0]['tableName']."->execute();  \n";
$str.="            \$".$data[0]['tableName']."->setPageOutput('html');  \n";
$str.="            \$".$data[0]['tableName']." = \$".$data[0]['tableName']."->read();  \n";
$str.="            if (isset(\$/".$data[0]['tableName']." [0]['firstRecord'])) {  \n";
$str.="                \$firstRecord = \$".$data[0]['tableName']." [0]['firstRecord'];  \n";
$str.="            }  \n";
$str.="            if (isset(\$/".$data[0]['tableName']." [0]['nextRecord'])) {  \n";
$str.="                \$nextRecord = \$".$data[0]['tableName']." [0]['nextRecord'];  \n";
$str.="            }   \n";
$str.="            if (isset(\$/".$data[0]['tableName']." [0]['previousRecord'])) {  \n";
$str.="                \$previousRecord = \$".$data[0]['tableName']." [0]['previousRecord'];  \n";
$str.="            }   \n";
$str.="            if (isset(\$/".$data[0]['tableName']." [0]['lastRecord'])) {  \n";
$str.="                \$lastRecord = \$".$data[0]['tableName']." [0]['lastRecord'];  \n";
$str.="                \$endRecord = \$".$data[0]['tableName']." [0]['lastRecord'];  \n";
$str.="           }   \n";
$str.="            require_once ('../../../../library/class/classNavigation.php');  \n";
$str.="            \$navigation = new \Core\Paging\HtmlPaging();  \n";
$str.="            \$navigation->setViewPath(\$/".$data[0]['tableName']."->getViewPath());  \n";
$str.="            \$navigation->setOffset(\$offset);  \n";
$str.="            \$navigation->setLimit(\$limit);  \n";
$str.="            \$navigation->setSecurityToken(\$securityToken);  \n";    
$str.="            if (isset(\$".$data[0]['tableName']." [0]['total'])) {  \n";
$str.="                \$total = \$".$data[0]['tableName']." [0]['total'];  \n";
$str.="            } else {  \n";
$str.="                \$total = 0;  \n";
$str.="            }  \n";
$str.="            \$navigation->setTotalRecord(\$total);  \n";
$str.="        }  \n";
$str.="    }  \n";
$str.=" }  \n";
$str.=" if (\$_POST['method'] == 'read' && \$_POST['type'] == 'list') { ?>  \n";
$str.="    <div id='infoPanel'></div>  \n";
$str.="    <div  class='modal hide fade' id='filterGridAdvance'>  \n";
$str.="        <div class='modal-header'>  \n";
$str.="            <a class='close' data-dismiss='modal1'>�</a>  \n";
$str.="            <h3>Advance Search Record</h3>  \n";
$str.="        </div>  \n";
$str.="        <div class='modal-body'>  \n";
// start loop field
//$str.=print_r($data);
$total=0;
$total = count($data);
for($i=0;$i<$total;$i++) {
    switch($data[$i]['formType']){
        case 'varchar':
        case 'text':
        case 'double':
            $str.="<div class='control-group' id='".$data[0]['columnName']."Div'>
                                <label class='control-label'>".$data[0]['columnName']."</label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='".$data[0]['columnName']."' id='".$data[0]['columnName']."' placeholder='Field Of ".$data[0]['columnName']."' class='span3'>
                                </div>
                            </div>";
        break;
        case 'int':
             $str.="<div class='control-group' id='numericDiv'>
                                <label class='control-label'>".$data[0]['columnName']."</label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='".$data[0]['columnName']."' id='".$data[0]['columnName']."' placeholder='Numeric Only' class='span3'>
                                    <span name='numericHelpMe' id='".$data[0]['columnName']."HelpMe' class='help-inline'></span>
                                </div>
                            </div>";
        break;
        case 'tiny':
            $str.="<div class='control-group' id='numericDiv'>
                                <label class='control-label'>Numeric</label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='".$data[0]['columnName']."' id='".$data[0]['columnName']."' placeholder='Numeric Only' class='span3'>
                                    <span name='numericHelpMe' id='".$data[0]['columnName']."HelpMe' class='help-inline'></span>
                                </div>
                            </div>";
        break;
        
        case 'date':
        case 'datetime':
            $str.="<div class='control-group' id='dateDiv'>
                                <label class='control-label'>".$data[0]['columnName']."</label>
                                <div class='controls input-prepend'>
                                    <span class='add-on'>
                                        <i class='icon-calendar'></i>
                                    </span>    
                                    <input type='date' name='".$data[0]['columnName']."' id='".$data[0]['columnName']."' placeholder='Date Validation' class='span3'>
                                    <span name='".$data[0]['columnName']."HelpMe' id='".$data[0]['columnName']."HelpMe' class='help-inline'></span>
                                </div>
                            </div>";
       
        
        break;
        default :
            $str.=" unditefi";
    }
}
// end loop field

$str.="        </div> \n";
$str.="        <div class='modal-footer'> \n";
$str.="            <a href='javascript:void(0)' class='btn btn-info'>Search</a> \n";
$str.="            <a href='javascript:void(0)' onclick='showMeModal('filterGridAdvance',0)' class='btn'>Close</a> \n";
$str.="        </div> \n";
$str.="    </div> \n";
$str.="    <div  class='modal hide fade' id='deletePreview'> \n";
$str.="        <div class='modal-header'> \n";
$str.="            <a class='close' data-dismiss='modal1'>�</a> \n";
$str.="            <h3>Are you sure want to delete this record ?</h3> \n";
$str.="        </div> \n";
$str.="        <div class='modal-body'> \n";
$str.="            <input type='hidden' name='".$data[0]['tableName']."IdPreview' id='".$data[0]['tableName']."IdPreview'> \n";
//$str.=print_r($data);


for($i=0;$i<$total;$i++) {
   
        $str.="<div class='control-group' id='".$data[$i]['columnName']."Div'>
                                <label class='control-label'>".$data[$i]['columnName']."</label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='".$data[$i]['columnName']."Preview' id='".$data[0]['columnName']."Preview' placeholder='Field Of ".$data[0]['columnName']."' class='span3'>
                                </div>
                            </div>";
    
}
$str.="        </div> \n";
$str.="        <div class='modal-footer'> \n";
$str.="            <a href='javascript:void(0)' class='btn btn-danger' onClick='deleteGridRecord()'>Delete</a> \n";
$str.="            <a href='javascript:void(0)' onclick='showMeModal('deletePreview',0)' class='btn'>Close</a> \n";
$str.="        </div> \n";
$str.="   </div> \n";
$str.="<div align='right'> \n";    
$str.="        <input type='text' class='input-large search-query' name='query' id='query'> \n";
$str.="        <a href='javascript:void(0)' class='btn' onClick='ajaxQuerySearchAll('<?php \$".$data[0]['tableName']."->getViewPath(); ?>','<?php echo \$securityToken; ?>')'><i class='icon-zoom-in'></i> Search </a> \n";
$str.="        <a href='javascript:void(0)' class='btn' onclick='showMeModal('filterGridAdvance',1)'><i class='icon-zoom-in' ></i> Advance Search </a> \n";
$str.="        <a href='javascript:void(0)' class='btn hide' onclick='hideButton();showGrid('<?php \$".$data[0]['tableName']."->getViewPath(); ?>','<?php echo \$securityToken; ?>',0,<?php echo LIMIT; ?>)' name='clearSearch' id='clearSearch'><i class='icon-refresh' ></i>Clear Search </a> \n";
$str.="        <a href='javascript:void(0)' class='btn' onClick='showForm('<?php \$midnightMarket->getViewPath(); ?>','<?php echo \$securityToken; ?>')'><i class='icon-plus'></i> New </a> \n";      
$str.="        <a href='javascript:void(0)' class='btn'><i class='icon-file'></i> Report </a> \n";
$str.="    </div> \n";
$str.="    <br> \n";
$str.="<table class='table table-striped table-bordered table-condensed' name='tableData' id='tableData'> \n";   
$str.="        <thead> \n";
$str.="            <tr> \n";



for($i=0;$i<$total;$i++) {
    $str.="<th><?php echo \$translate[".$data[$i]['columnName']."]; ?></th>";
}
$str.="            </tr> \n";
$str.="        </thead> \n";
$str.="        <tbody id=tableBody> \n";
$str.="        <?php } \n";
$str.="              if (\$_POST['method'] == 'read' && \$_POST['type'] == 'list' && \$_POST['detail'] == 'body') { \n";
$str.="              if (is_array(\$".$data[0]['tableName']."Array)) { \n";
$str.="                \$totalRecord = 0; \n";
$str.="                \$totalRecord = count(\$".$data[0]['tableName']."Array); \n";
$str.="                if (\$totalRecord > 0) { \n";
$str.="                    for (\$i = 0; \$i < \$totalRecord; \$i++) { ?> \n";
$str.="                        <tr> \n";
for($i=0;$i<$total;$i++) {
    if($data[$i]['Key']=='PRI'){
        $str.=" <td><a class='btn-warning btn-mini' onClick='showFormUpdate('<?php \$midnightMarket->getViewPath(); ?>','<?php echo \$securityToken; ?>','<?php echo intval(\$midnightMarketArray [\$i]['midnightMarketId']); ?>')'><i class='icon-edit  icon-white'></i>Update</a>  
                    <a class='btn-danger btn-mini' onClick='showModalDelete('<?php \$midnightMarket->getControllerPath(); ?>','<?php echo \$securityToken; ?>','<?php \$midnightMarketArray [\$i]['midnightMarketId']; ?>','<?php \$midnightMarketArray [\$i]['stateDesc']; ?>','<?php \$midnightMarketArray [\$i]['midnightMarketLocation']; ?>','<?php \$midnightMarketArray [\$i]['dayDesc']; ?>')'><i class='icon-trash  icon-white'></i> Delete</a></td> \n";

    } else {
        $str.="<td><?php \$midnightMarketArray ['maps'][\$i];  ?></td> \n";

    }
}
$str.="                        </tr> \n";
$str.="                        <?php \n";
$str.="                    } \n";
$str.="                } else { ?> \n";
$str.="                    <tr> \n";
$str.="                        <td colspan='6'><?php \$".$data[0]['tableName']."->exceptionMessage('No Record'); ?></td> \n";
$str.="                    </tr> \n"; 
$str.="                    <?php \n";
$str.="                } \n";
$str.="            } else { ?> \n";
$str.="                <tr> \n";
$str.="                    <td colspan='6'><?php \$".$data[0]['tableName']."->exceptionMessage('Data Record Problem'); ?></td> \n";
$str.="                </tr> \n";    
$str.="                <?php \n";
$str.="            } \n";
$str.="        } \n";
$str.="        if (\$_POST['method'] == 'read' && \$_POST['type'] == 'list') { ?> \n";
$str.="        </tbody> \n";
$str.="    </table> \n";
 $str.="   <?php \n";
$str.="} \n";
$str.="if (\$_POST['method'] == 'read' && \$_POST['type'] == 'list' && \$_POST['detail'] == 'body') { ?> \n";
$str.="    <div class='pagination' id='pagingHtml' name='pagingHtml'><?php \$navigation->pagenationv4(\$offset); ?></div> \n";
$str.="     <script language='javascript' type='text/javascript'> \n";
$str.="         \$(document).ready(function(){ \n";
$str.="            // load the system cell if session  and token exist;  \n";
$str.="            <?php if(isset(\$_POST['query'])) { ?> \n";
$str.="                    \$('#clearSearch').removeClass(); \n";
$str.="                    \$('#clearSearch').addClass('btn'); \n";
$str.="            <?php } ?>  \n";
$str.="         }); \n";       
$str.="      </script> \n";          
$str.="    <?php }  \n";
$str.="           if ((isset(\$_POST['method']) == 'new' || isset(\$_POST['method']) == 'read') && \$_POST['type'] == 'form') { ?> \n";
$str.="    <div id='infoPanel'></div> \n";
$str.="    <input type='hidden' name='".$data[0]['tableName']."Id' id='".$data[0]['tableName']."' value='<?php if (isset(\$_POST['".$data[0]['tableName']."'])) { \$_POST['".$data[0]['tableName']."'];    } ?>'> \n"; 
// start loop field
//$str.=print_r($data);
$total=0;
$total = count($data);
for($i=0;$i<$total;$i++) {
    switch($data[$i]['formType']){
        case 'varchar':
        case 'text':
        case 'double':
            $str.="<div class='control-group' id='".$data[0]['columnName']."Div'>
                                <label class='control-label'>".$data[0]['columnName']."</label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='".$data[0]['columnName']."' id='".$data[0]['columnName']."' placeholder='Field Of ".$data[0]['columnName']."' class='span3'>
                                </div>
                            </div>";
        break;
        case 'int':
             $str.="<div class='control-group' id='numericDiv'>
                                <label class='control-label'>".$data[0]['columnName']."</label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='".$data[0]['columnName']."' id='".$data[0]['columnName']."' placeholder='Numeric Only' class='span3'>
                                    <span name='numericHelpMe' id='".$data[0]['columnName']."HelpMe' class='help-inline'></span>
                                </div>
                            </div>";
        break;
        case 'tiny':
            $str.="<div class='control-group' id='numericDiv'>
                                <label class='control-label'>Numeric</label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='".$data[0]['columnName']."' id='".$data[0]['columnName']."' placeholder='Numeric Only' class='span3'>
                                    <span name='numericHelpMe' id='".$data[0]['columnName']."HelpMe' class='help-inline'></span>
                                </div>
                            </div>";
        break;
        
        case 'date':
        case 'datetime':
            $str.="<div class='control-group' id='dateDiv'>
                                <label class='control-label'>".$data[0]['columnName']."</label>
                                <div class='controls input-prepend'>
                                    <span class='add-on'>
                                        <i class='icon-calendar'></i>
                                    </span>    
                                    <input type='date' name='".$data[0]['columnName']."' id='".$data[0]['columnName']."' placeholder='Date Validation' class='span3'>
                                    <span name='".$data[0]['columnName']."HelpMe' id='".$data[0]['columnName']."HelpMe' class='help-inline'></span>
                                </div>
                            </div>";
       
        
        break;
        default :
            $str.=" unditefi";
    }
}
// end loop field
$str.="    <div class='btn-toolbar'> \n";
$str.="        <div class='btn-group'> \n";
$str.="            <a  name='auditRecordButton' id='auditRecordButton'  href='#' class='btn btn-warning disabled' onClick='auditRecord()'><i class='icon-warning-sign icon-white'></i> Audit</a> \n";
$str.="        </div>";
$str.="        <div class='btn-group'>";
$str.="            <a  name='newRecordButton1' id='newRecordButton1'  href='javascript:void(0)' class='btn btn-success  disabled'><i class='icon-plus icon-white'></i>New</a> \n";
$str.="            <a  name='newRecordButton2' id='newRecordButton2'   href='javascript:void(0)' data-toggle='dropdown' class='btn dropdown-toggle btn-success  disabled'><span class='caret'></span></a> \n";
$str.="            <ul class='dropdown-menu'> \n";
$str.="                <li><a  name='newRecordButton3' id='newRecordButton3'   href='javascript:void(0)' onClick='newRecord(1)' class='disabled'><i class='icon-plus'></i>New &AMP; Continue</a></li> \n";
$str.="                <li><a  name='newRecordButton4' id='newRecordButton4'   href='javascript:void(0)' onClick='newRecord(2)' class='disabled'><i class='icon-edit'></i>New &AMP; Update </a></li> \n";
$str.="                <li><a  name='newRecordButton5' id='newRecordButton5'   href='javascript:void(0)' onClick='newRecord(3)' class='disabled'><i class='icon-print'></i>New &AMP; Continue &AMP; Print </a></li> \n";
$str.="                <li><a  name='newRecordButton6' id='newRecordButton6'    href='javascript:void(0)' onClick='newRecord(4)' class='disabled'><i class='icon-print'></i>New &AMP; Update &AMP; Print </a></li> \n";
$str.="                <li><a  name='newRecordButton7' id='newRecordButton7'    href='javascript:void(0)' onClick='newRecord(5)' class='disabled'><i class='icon-list'></i>New &AMP; Listing </a></li> \n";
$str.="            </ul> \n";
$str.="        </div> \n";
$str.="        <div class='btn-group'> \n";
$str.="            <a  name='updateRecordButton1' id='updateRecordButton'   href='javascript:void(0)' class='btn btn-info  disabled'><i class='icon-edit icon-white'></i>Update</a> \n";
$str.="            <a  name='updateRecordButton2' id='updateRecordButton'    href='javascript:void(0)' data-toggle='dropdown' class='btn dropdown-toggle btn-info  disabled'><span class='caret'></span></a> \n";
$str.="            <ul class='dropdown-menu'> \n";
$str.="                <li><a  name='updateRecordButton3' id='updateRecordButton'    href='javascript:void(0)'  onClick='updateRecord(1)' class='disabled'><i class='icon-plus'></i>Update</a></li> \n";
$str.="                <li><a  name='updateRecordButton4' id='updateRecordButton'    href='javascript:void(0)' onClick='updateRecord(2)' class='disabled'><i class='icon-print'></i>Update &AMP; Print </a></li> \n";
$str.="               <li><a  name='updateRecordButton5' id='updateRecordButton'    href='javascript:void(0)' onClick='updateRecord(3)' class='disabled'><i class='icon-list-alt'></i>Update &AMP; Listing </a></li> \n";
$str.="            </ul> \n";
$str.="        </div> \n";
$str.="        <div class='btn-group'> \n";
$str.="            <a  name='deleteRecordButton' id='deleteRecordButton'  href='javascript:void(0)' class='btn btn-danger  disabled'  onClick='deleteRecord()'><i class='icon-trash icon-white'></i> Delete</a> \n";
$str.="        </div> \n";
$str.="        <div class='btn-group'>";
$str.="            <a  name='resetRecordButton' id='resetRecordButton'  href='javascript:void(0)' class='btn btn-info  disabled' onClick='resetRecord()'><i class='icon-refresh icon-white'></i> Reset</a> \n";
$str.="        </div> \n";
$str.="        <div class='btn-group'>";
$str.="            <a  name='postRecordButton' id='postRecordButton' href='javascript:void(0)' class='btn btn-warning  disabled'  onClick='postRecord()'><i class='icon-cog icon-white'></i> Post</a> \n";
$str.="        </div> \n";
$str.="        <div class='btn-group'>";
$str.="            <a  name='listRecordButton' id='listRecordButton' href='javascript:void(0)' class='btn btn-info' onClick='showGrid('<?php \$".$data[0]['tableName']."->getViewPath(); ?>','<?php echo \$securityToken; ?>',0,<?php 'LIMIT; ?>)'><i class='icon-list icon-white'></i>Listing</a> \n";
$str.="        </div> \n";
$str.="        <div class='btn-group'> \n";
$str.="            <a  name='firstRecordButton' id='firstRecordButton' href='javascript:void(0)' class='btn btn-info  disabled' onClick='firstRecord()'><i class='icon-fast-backward icon-white'></i> First</a> \n";
$str.="        </div> \n";
$str.="        <div class='btn-group'> \n";
$str.="            <a  name='previousRecordButton' id='previousRecordButton'  href='javascript:void(0)' class='btn btn-info  disabled' onClick='previousRecord()'><i class='icon-backward icon-white'></i> Previous</a> \n";
$str.="        </div> \n";
$str.="        <div class='btn-group'> \n";
$str.="            <a  name='nextRecordButton' id='nextRecordButton'  href='javascript:void(0)' class='btn btn-info  disabled' onClick='nextRecord()'><i class='icon-forward icon-white'></i> Next</a> \n";
$str.="        </div> \n";
$str.="        <div class='btn-group'> \n";
$str.="            <a  name='lastRecordButton' id='lastRecordButton'  href='javascript:void(0)' class='btn btn-info disabled' onClick='lastRecord()'><i class='icon-fast-forward icon-white'></i> End</a> \n";
$str.="       </div> \n";
$str.="    </div> \n";
$str.="    <input type='hidden' name='x' id='x'> \n";
$str.="    <input type='hidden' name='firstRecord' id='firstRecord' value='<?php if(isset(\$firstRecord)) { \$firstRecord; } ?>'> \n";       
$str.="    <input type='hidden' name='nextRecord' id='nextRecord' value='<?php if(isset(\$nextRecord)) { \$nextRecord; } ?>'> \n";
$str.="    <input type='hidden' name='previousRecord' id='previousRecord' value='<?php if(isset(\$previousRecord)) { \$previousRecord; } ?>'> \n";
$str.="    <input type='hidden' name='lastRecord' id='lastRecord' value='<?php if(isset(\$lastRecord)) { \$lastRecord; } ?>'> \n";
$str.="    <input type='hidden' name='endRecord' id='endRecord' value='<?php if(isset(\$endRecord)) { \$endRecord; } ?>'> \n";
$str.="    <script language='javascript' type='text/javascript'> \n";
$str.="         \$(document).ready(function(){  \n";
$str.="            <?php if(isset(\$_POST['query'])) { ?> \n";
$str.="                    \$('#clearSearch').removeCss(); \n";
$str.="                    \$('#clearSearch').addClass('btn'); \n";
$str.="            <?php } ?> \n";        
$str.="            <?php if(\$_POST['method']=='new') { ?> \n";
$str.="            \$('#resetRecordButton').removeClass(); \n";
$str.="            \$('#resetRecordButton').addClass('btn btn-info'); \n";
$str.="            \$('#newRecordButton').removeClass(); \n";
$str.="            \$('#newRecordButton').addClass('btn btn-success'); \n";            
$str.="            \$('#firstRecordButton').removeClass(); \n";
$str.="            \$('#firstRecordButton').addClass('btn btn-info');  \n";           
$str.="            \$('#lastRecordButton').removeClass(); \n";
$str.="            \$('#lastRecordButton').addClass('btn btn-info'); \n";
$str.="            <?php } else { ?> \n";
$str.="            <?php } ?>  \n";   
$str.="         }); \n";        
$str.="    </script> \n";    
$str.="<?php } ?> \n";
$str.="<script language='javascript' type='text/javascript' src='./package/market/midnightMarket/javascript/original/".$data[0]['tableName'].".js'></script> \n";
?>
