<?php

$strId = null;
$strId = $data[0]['primaryKeyName'];

$str.="<?php require_once('/../controller/" . $data[0]['tableName'] . "Controller.php'); \n";
// initilize dummy value for date
$str.="\$dateStartRange = null; \n";
$str.="\$dateEndRange = null;\n";
$str.="if(isset(\$_POST['dateRangeStart'])){\n";
$str.="    \$dateRangeStart=\$_POST['dateRangeStart']; \n";
$str.="} else { \n";
$str.="    \$dateRangeStart=date('d-m-Y'); \n";
$str.="} \n";
$str.="if(isset(\$_POST['dateRangeEnd'])){ \n";
$str.="    \$dateRangeEnd = \$_POST['dateRangeEnd'];\n";
$str.="} \n";
$str.="require_once ('../../../../library/class/classNavigation.php');  \n";
$str.="require_once ('../../../../library/class/classShared.php');  \n";

$str.="\$translator = new \Core\shared\SharedClass();  \n";
$str.="\$translator->setCurrentDatabase('" . $data[0]['database'] . "'); \n";
$str.="\$translator->setCurrentTable('" . $data[0]['tableName'] . "');  \n";
$str.="\$translator->execute();  \n";
$str.="\$systemFormat           =   \$translator->getSystemFormat();  \n";
$str.="\$defaultTranslation     =   \$translator->getDefaultTranslation();  \n";
$str.="\$foreignKeyTranslation  =   \$translator->getForeignkeyTranslation();  \n";
$str.="\$leafTranslation        =   \$translator->getLeafTranslation();  \n";
$str.="\$buttonTranslation      =   \$translator->getButtonTranslation();  \n";
$str.="\$isAdmin                =   \$translator->getAdminAccess(); \n";
$str.="\$leafAccess             =   \$translator->getLeafAccess(); \n";
$str.="   \n";
$str.="\$salt=\"chak\"; \n";
$str.="\$securityToken= md5(\"You have been cheated\").\$salt;\n";
$str.=" \$arrayInfo = \$translator->getFileInfo('" . $data[0]['tableName'] . ".php'); \n";
$str.=" \$applicationId=\$arrayInfo['applicationId']; \n";
$str.=" \$moduleId=\$arrayInfo['moduleId']; \n";
$str.="if (isset(\$_POST)) {  \n";
$str.="    if (isset(\$_POST['method'])) {  \n";
$str.="        \$" . $data[0]['tableName'] . " = new \Core\\" . ucwords($data[0]['package']) . "\\" . ucwords($data[0]['module']) . "\\" . ucwords($data[0]['tableName']) . "\Controller\\";
$str.=ucfirst($data[0]['tableName']);
$str.="Class();  \n";
$str.="define(\"LIMIT\",14);\n";

$str.="        if (isset(\$_POST['offset'])) {  \n";
$str.="            \$offset = \$_POST['offset'];  \n";
$str.="        } else {";
$str.="            \$offset = 0;  \n";
$str.="        }\n";
$str.="        if (isset(\$_POST['limit'])) {  \n";
$str.="            \$limit = \$_POST['limit'];  \n";
$str.="        } else {";
$str.="            \$limit = LIMIT;  \n";
$str.="        }\n";


$total = 0;
$total = count($data);
for ($i = 0; $i < $total; $i++) {
    if ($data[$i]['foreignKey'] == 1 && $data[$i]['Key'] == 'MUL') {
        // we only can assumed it was the same package and module otherwise manual change
        $str.="        \$" . str_replace("Id", "", $data[$i]['columnName']) . " = new \Core\\" . ucwords($data[0]['package']) . "\\" . ucwords($data[0]['module']) . "\\" . ucfirst(str_replace("Id", "", $data[$i]['columnName'])) . "\Controller\\" . ucfirst(str_replace("Id", "", $data[$i]['columnName'])) . "Class();  \n";
        $str.="        \$" . str_replace("Id", "", $data[$i]['columnName']) . "->setStart(\$offset);  \n";
        $str.="        \$" . str_replace("Id", "", $data[$i]['columnName']) . "->setLimit(\$limit); // normal system don't like paging..  \n";
        $str.="        \$" . str_replace("Id", "", $data[$i]['columnName']) . "->setPageOutput('html');  \n";
    }
}
$str.=" if (\$_POST['method'] == 'read') {  \n";

$str.="     if (isset(\$_POST ['query'])) { \n";
$str.="         \$" . $data[0]['tableName'] . "->setFieldQuery(\$_POST ['query']); \n";
$str.="     } \n";
$str.="     if (isset(\$_POST ['filter'])) { \n";
$str.="         \$" . $data[0]['tableName'] . "->setGridQuery(\$_POST ['filter']); \n";
$str.="     }                 \n";
$str.="     if (isset(\$_POST ['character'])) { \n";
$str.="		\$" . $data[0]['tableName'] . "->setCharacterQuery(\$_POST['character']); \n";
$str.="     } \n";
$str.="     if (isset(\$_POST ['dateRangeStart'])) { \n";
$str.="		\$" . $data[0]['tableName'] . "->setDateRangeStartQuery(\$_POST['dateRangeStart']); \n";
$str.="		//explode the data to get day,month,year \n";
$str.="		\$start=explode(\"-\",\$_POST ['dateRangeStart']); \n";
$str.="		\$" . $data[0]['tableName'] . "->setStartDay(\$start[2]); \n";
$str.="		\$" . $data[0]['tableName'] . "->setStartMonth(\$start[1]); \n";
$str.="		\$" . $data[0]['tableName'] . "->setStartYear(\$start[0]); \n";
$str.="     } \n";
$str.="     if (isset(\$_POST ['dateRangeEnd']) && (strlen(\$_POST['dateRangeEnd'])> 0) ) { \n";
$str.="		\$" . $data[0]['tableName'] . "->setDateRangeEndQuery(\$_POST['dateRangeEnd']); \n";
$str.="		//explode the data to get day,month,year \n";
$str.="		\$start=explode(\"-\",\$_POST ['dateRangeEnd']); \n";
$str.="		\$" . $data[0]['tableName'] . "->setEndDay(\$start[2]); \n";
$str.="		\$" . $data[0]['tableName'] . "->setEndMonth(\$start[1]); \n";
$str.="		\$" . $data[0]['tableName'] . "->setEndYear(\$start[0]); \n";
$str.="     } \n";
$str.="     if (isset(\$_POST ['dateRangeType'])) { \n";
$str.="		\$" . $data[0]['tableName'] . "->setDateRangeTypeQuery(\$_POST['dateRangeType']); \n";
$str.="     } \n";
$str.="     if (isset(\$_POST ['dateRangeExtraType'])) { \n";
$str.="		\$" . $data[0]['tableName'] . "->setDateRangeExtraTypeQuery(\$_POST['dateRangeExtraType']); \n";
$str.="     } \n";
$str.="            \$" . $data[0]['tableName'] . "->setStart(\$offset);  \n";
$str.="            \$" . $data[0]['tableName'] . "->setLimit(\$limit); // normal system don't like paging..  \n";
$str.="            \$" . $data[0]['tableName'] . "->execute();  \n";
$str.="            \$" . $data[0]['tableName'] . "->setPageOutput('html');  \n";
$str.="            \$" . $data[0]['tableName'] . "Array = \$" . $data[0]['tableName'] . "->read();  \n";
$str.="            if (isset(\$" . $data[0]['tableName'] . "Array [0]['firstRecord'])) {  \n";
$str.="                \$firstRecord = \$" . $data[0]['tableName'] . "Array [0]['firstRecord'];  \n";
$str.="            }  \n";
$str.="            if (isset(\$" . $data[0]['tableName'] . "Array [0]['nextRecord'])) {  \n";
$str.="                \$nextRecord = \$" . $data[0]['tableName'] . "Array [0]['nextRecord'];  \n";
$str.="            }   \n";
$str.="            if (isset(\$" . $data[0]['tableName'] . "Array [0]['previousRecord'])) {  \n";
$str.="                \$previousRecord = \$" . $data[0]['tableName'] . "Array [0]['previousRecord'];  \n";
$str.="            }   \n";
$str.="            if (isset(\$" . $data[0]['tableName'] . "Array [0]['lastRecord'])) {  \n";
$str.="                \$lastRecord = \$" . $data[0]['tableName'] . "Array [0]['lastRecord'];  \n";
$str.="                \$endRecord = \$" . $data[0]['tableName'] . "Array [0]['lastRecord'];  \n";
$str.="           }   \n";
$str.="            \$navigation = new \Core\Paging\HtmlPaging();  \n";
$str.="            \$navigation->setViewPath(\$" . $data[0]['tableName'] . "->getViewPath());  \n";
$str.="            \$navigation->setOffset(\$offset);  \n";
$str.="            \$navigation->setLimit(\$limit);  \n";
$str.="            \$navigation->setSecurityToken(\$securityToken);  \n";
$str.="            if (isset(\$" . $data[0]['tableName'] . "Array [0]['total'])) {  \n";
$str.="                \$total = \$" . $data[0]['tableName'] . "Array [0]['total'];  \n";
$str.="            } else {  \n";
$str.="                \$total = 0;  \n";
$str.="            }  \n";
$str.="            \$navigation->setTotalRecord(\$total);  \n";
$str.="        }  \n";
$str.="    }  \n";
$str.=" }  \n";

$str.=" if (\$_POST['method'] == 'read' && \$_POST['type'] == 'list') { ?>  \n";
$str.="   <div  id='leftViewportDetail' class='well span2'> \n";
$str.="                <div id='btnList'>\n";
$str.="                <!-- button type only be used on non critical only .. ie9 bugs -->\n";
$str.="                <button type='button' name='menuBack' class='btn btn-inverse btn-small' onClick=loadSidebar(<?php echo \$applicationId; ?>,'<?php echo \$moduleId; ?>')><i class='icon-arrow-left'></i> Menu </button> <button type='button' value='New Record' name='newRecordButton' id='newRecordButton' class='btn btn-info btn-small' onClick=showForm('<?php echo \$" . $data[0]['tableName'] . "->getViewPath(); ?>','<?php echo \$securityToken; ?>')><i class='icon-plus'></i> New Record </button> \n";
$str.="                </div>\n";
$str.="                <hr>\n";
$str.="                <h3>Search</h3>\n";
$str.="                <input type='text' name='queryWidget' id='queryWidget' class='span2' value='<?php if(isset(\$_POST['query'])) {  echo \$_POST['query']; } ?>'>\n<br>";
$str.="                    <input type='button' name='searchString' id='searchString' value='Search' class='btn btn-info' onClick=ajaxQuerySearchAll('<?php echo \$" . $data[0]['tableName'] . "->getViewPath(); ?>','<?php echo \$securityToken; ?>')>\n";
$str.="                    <input type='button' name='clearSearchString' id='clearSearchString' value='Clear' class='btn' onClick=showGrid('<?php echo \$" . $data[0]['tableName'] . "->getViewPath(); ?>','<?php echo \$securityToken; ?>',0,<?php echo LIMIT; ?>)>\n";
$str.="                <hr>\n";
$str.="                <h4>Date</h4>\n";
$str.="                 <table cellpadding=1 cellspacing=1>\n";
$str.="                     <tr>\n";
// starting unix time till this day
$str.="                         <td colspan='3'><a href=javascript:void(0) onClick=ajaxQuerySearchAllDate('<?php echo \$" . $data[0]['tableName'] . "->getViewPath(); ?>','<?php echo \$securityToken; ?>','1979-01-01','" . date('Y-m-d') . "')>Any Time</a></td>\n";
$str.="                     </tr>\n";
$str.="                     <tr>\n";
$str.="                     <tr>\n";
$str.="                         <td align='right'><a href=javascript:void(0) rel='tooltip' title='Previous Day' onClick=ajaxQuerySearchAllDate('<?php echo \$" . $data[0]['tableName'] . "->getViewPath(); ?>','<?php echo \$securityToken; ?>','<?php echo \$dateRangeStart; ?>','','day','previous')>&laquo;</a></td>\n";
$str.="                         <td align='center'><a href=javascript:void(0) onClick=ajaxQuerySearchAllDate('<?php echo \$" . $data[0]['tableName'] . "->getViewPath(); ?>','<?php echo \$securityToken; ?>','<?php echo \$dateRangeStart; ?>','','day','')>Today</a></td>\n";
$str.="                         <td align='left'><a href=javascript:void(0) rel='tooltip' title='Next Day' onClick=ajaxQuerySearchAllDate('<?php echo \$" . $data[0]['tableName'] . "->getViewPath(); ?>','<?php echo \$securityToken; ?>','<?php echo \$dateRangeStart; ?>','','day','next')>&raquo;</a></td>\n";
$str.="                     </tr>\n";
$str.="                     <tr>\n";
$str.="                         <td align='right'><a href=javascript:void(0) rel='tooltip' title='Previous Week'  onClick=ajaxQuerySearchAllDate('<?php echo \$" . $data[0]['tableName'] . "->getViewPath(); ?>','<?php echo \$securityToken; ?>','<?php echo \$dateRangeStart; ?>','','week','previous')>&laquo;</a> </td>\n";
$str.="                         <td align='center'><a href=javascript:void(0) onClick=ajaxQuerySearchAllDate('<?php echo \$" . $data[0]['tableName'] . "->getViewPath(); ?>','<?php echo \$securityToken; ?>','<?php echo \$dateRangeStart; ?>','','week','')>Week</a> </td>\n";
$str.="                         <td align='left'><a href=javascript:void(0) rel='tooltip' title='Next Week' onClick=ajaxQuerySearchAllDate('<?php echo \$" . $data[0]['tableName'] . "->getViewPath(); ?>','<?php echo \$securityToken; ?>','<?php echo \$dateRangeStart; ?>','','week','next')>&raquo;</a></td>\n";
$str.="                     </tr>\n";
$str.="                     <tr>\n";
$str.="                         <td align='right'><a href=javascript:void(0) rel='tooltip' title='Previous Month'  onClick=ajaxQuerySearchAllDate('<?php echo \$" . $data[0]['tableName'] . "->getViewPath(); ?>','<?php echo \$securityToken; ?>','<?php echo \$dateRangeStart; ?>','','month','previous')>&laquo;</td> \n";
;
$str.="                         <td align='center'><a href=javascript:void(0) onClick=ajaxQuerySearchAllDate('<?php echo \$" . $data[0]['tableName'] . "->getViewPath(); ?>','<?php echo \$securityToken; ?>','<?php echo \$dateRangeStart; ?>','','month','')>Month</a> </td>\n";
$str.="                         <td align='left'><a href=javascript:void(0) rel='tooltip' title='Next Month' onClick=ajaxQuerySearchAllDate('<?php echo \$" . $data[0]['tableName'] . "->getViewPath(); ?>','<?php echo \$securityToken; ?>','<?php echo \$dateRangeStart; ?>','','month','next')>&raquo;</a></td>\n";
$str.="                     </tr>\n";
$str.="                     <tr>\n";
$str.="                         <td align='right'><a href=javascript:void(0) rel='tooltip' title='Previous Year'  onClick=ajaxQuerySearchAllDate('<?php echo \$" . $data[0]['tableName'] . "->getViewPath(); ?>','<?php echo \$securityToken; ?>','<?php echo \$dateRangeStart; ?>','','year','previous')>&laquo;</a></td> \n";
$str.="                        <td align='center'><a href=javascript:void(0) onClick=ajaxQuerySearchAllDate('<?php echo \$" . $data[0]['tableName'] . "->getViewPath(); ?>','<?php echo \$securityToken; ?>','<?php echo \$dateRangeStart; ?>','','year','')>Year</a> </td>\n";
$str.="                         <td align='left'><a href=javascript:void(0) rel='tooltip' title='Next Year' onClick=ajaxQuerySearchAllDate('<?php echo \$" . $data[0]['tableName'] . "->getViewPath(); ?>','<?php echo \$securityToken; ?>','<?php echo \$dateRangeStart; ?>','','year','next')>&raquo;</a></td>\n";
$str.="                         </tr>\n";
$str.="</table>\n";
$str.="                Range\n";
$str.="                <div style='style:none'>\n";
$str.="                    <input type='date' name='dateRangeStart' id='dateRangeStart' class='span2' value='<?php if(isset(\$_POST['dateRangeStart'])) { echo \$_POST['dateRangeStart']; } ?>'><br>\n";
$str.="                    <input type='date' name='dateRangeEnd' id='dateRangeEnd' class='span2' value='<?php if(isset(\$_POST['dateRangeEnd'])) { echo \$_POST['dateRangeEnd']; } ?>'><br>\n";
$str.="                    <input type='button' name='searchDate' id='searchDate' value='Search' class='btn btn-info' onClick=ajaxQuerySearchAllDateRange('<?php echo \$" . $data[0]['tableName'] . "->getViewPath(); ?>','<?php echo \$securityToken; ?>')>\n";
$str.="                    <input type='button' name='clearSearchDate' id='clearSearchDate' value='Clear' class='btn' onClick=showGrid('<?php echo \$" . $data[0]['tableName'] . "->getViewPath(); ?>','<?php echo \$securityToken; ?>',0,<?php echo LIMIT; ?>)>\n";

$str.="                </div>\n";
$str.="                <hr>\n";
$str.="             <h4>Filter Date Information</h4>\n";
$str.="             <table>\n";
$str.="<tr>\n";
$str.="    <td>Current Date</td>\n";
$str.="    <td>:</td>\n";
$str.="    <td><?php echo date('d-m-Y'); ?></td>\n";
$str.="</tr>\n";
$str.="<tr>\n";
$str.="    <td>Filter Date</td>\n";
$str.="     <td>:</td>\n";
$str.="     <td><?php if(isset(\$_POST['dateRangeStart'])) { echo \$_POST['dateRangeStart']; } ?> <?php if(isset(\$_POST['dateRangeEnd']) && (strlen(\$_POST['dateRangeEnd'])> 0)) { echo 'till  '.\$_POST['dateRangeEnd']; } ?> </td>\n";
$str.="</tr>\n";
$str.="<tr>\n";
$str.="    <td>Filter Method </td>\n";
$str.="     <td>:</td>\n";
$str.="     <td><?php if(isset(\$_POST['dateRangeType'])) { echo \$_POST['dateRangeType']; } ?></td>\n";
$str.="</tr>\n";
$str.="<tr>\n";
$str.="    <td>Filter Type </td>\n";
$str.="     <td>:</td>\n";
$str.="     <td><?php if(isset(\$_POST['dateRangeExtraType'])) { echo \$_POST['dateRangeExtraType']; } ?></td>\n";
$str.="</tr>\n";
$str.="</table>";
$str.="            </div>\n";

$str.="        <div name='rightViewport' id='rightViewport' class='span13'>\n";
$str.="    <div id='infoPanel'></div>  \n";
$str.="    <div  class='modal hide fade' id='filterGridAdvance'>  \n";
$str.="        <div class='modal-header'>  \n";
$str.="            <a class='close' data-dismiss='modal1'>x</a>  \n";
$str.="            <h3>Advance Search Record</h3>  \n";
$str.="        </div>  \n";
$str.="        <div class='modal-body'>  \n";
// start loop field
//$str.=print_r($data);

for ($i = 0; $i < $total; $i++) {
    switch ($data[$i]['formType']) {
        case 'varchar':
        case 'text':
        case 'double':
            $str.="<div class='control-group' id='" . $data[$i]['columnName'] . "Div'>
                                <label class='control-label'><?php if(isset( \$leafTranslation['" . $data[$i]['columnName'] . "Label'])) {  echo \$leafTranslation['" . $data[$i]['columnName'] . "Label']; } ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='" . $data[$i]['columnName'] . "' id='" . $data[$i]['columnName'] . "' placeholder='Field Of " . $data[$i]['columnName'] . "' class='span3'>
                                </div>
                            </div>";
            break;
        case 'int':
            if ($data[$i]['columnName'] != 'executeBy') {
                if (trim($data[$i]['columnName']) == trim($strId)) {
                    // we don't search primary key   
                } else {
                    if ($data[$i]['foreignKey'] == 1 && $data[$i]['Key'] == 'MUL') {
                        $str.="<div class='control-group' id='" . $data[$i]['columnName'] . "Div'>
                                <label class='control-label'><?php if(isset( \$leafTranslation['" . $data[$i]['columnName'] . "Label'])) {  echo \$leafTranslation['" . $data[$i]['columnName'] . "Label']; } ?></label>
                                <div class='controls  input-prepend'><select name='" . $data[$i]['columnName'] . "' id='" . $data[$i]['columnName'] . "'>\n
                                <?php
                                if (is_array(\$" . $data[$i]['columnName'] . "Array)) {
                                    \$totalRecord = 0;
                                    \$totalRecord = count(\$" . $data[$i]['columnName'] . "Array);
                                    for (\$i = 0; \$i < \$totalRecord; \$i++) { ?>
                                        <option value='<?php echo \$" . $data[$i]['columnName'] . "Array[\$i]['" . $data[$i]['columnName'] . "Id']; ?>'><?php echo \$" . $data[$i]['columnName'] . "Array[\$i]['" . $data[$i]['columnName'] . "Desc']; ?></option>                                       
                                    }\n
                                }\n                                
                            </select>\n
                            </div>\n
                          </div>\n";
                    } else if ($data[$i]['Key'] == '') {
                        $str.="<div class='control-group' id='" . $data[$i]['columnName'] . "Div' >\n
                                <label class='control-label'><?php if(isset( \$leafTranslation['" . $data[$i]['columnName'] . "Label'])) {  echo \$leafTranslation['" . $data[$i]['columnName'] . "Label']; } ?></label>\n
                                <div class='controls  input-prepend'>\n
                                    <input type='text' name='" . $data[$i]['columnName'] . "' id='" . $data[$i]['columnName'] . "' placeholder='Numeric Only' class='span3'>\n
                                    <span name='numericHelpMe' id='" . $data[$i]['columnName'] . "HelpMe' class='help-inline'></span>\n
                                </div>\n
                            </div>\n";
                    }
                }
            }
            break;
        case 'tiny':
            // by default searching tiny is not available
            break;

        case 'date':
        case 'datetime':
            if ($data[$i]['columnName'] != 'executeTime') {
                $str.="<div class='control-group' id='dateDiv'>
                                <label class='control-label'><?php if(isset( \$leafTranslation['" . $data[$i]['columnName'] . "Label'])) {  echo \$leafTranslation['" . $data[$i]['columnName'] . "Label']; } ?></label>
                                <div class='controls input-prepend'>
                                    <span class='add-on'>
                                        <i class='icon-calendar'></i>
                                    </span>    
                                    <input type='date' name='" . $data[$i]['columnName'] . "' id='" . $data[$i]['columnName'] . "' placeholder='Date Validation' class='span3'>
                                    <span name='" . $data[$i]['columnName'] . "HelpMe' id='" . $data[$i]['columnName'] . "HelpMe' class='help-inline'></span>
                                </div>
                            </div>";
            }


            break;
        default :
            $str.=" unditefi";
    }
}
// end loop field

$str.="        </div> \n";
$str.="        <div class='modal-footer'> \n";
$str.="            <a href=javascript:void(0) class='btn btn-info'>Search</a> \n";
$str.="            <a href=javascript:void(0) onclick=showMeModal('filterGridAdvance',0) class='btn'>Close</a> \n";
$str.="        </div> \n";
$str.="    </div> \n";
$str.="    <div  class='modal hide fade' id='deletePreview'> \n";
$str.="        <div class='modal-header'> \n";
$str.="            <a class='close' data-dismiss='modal1'>x</a> \n";
$str.="            <h3>Are you sure want to delete this record ?</h3> \n";
$str.="        </div> \n";
$str.="        <div class='modal-body'> \n";
$str.="            <input type='hidden' name='" . $data[0]['primaryKeyName'] . "Preview' id='" . $data[0]['primaryKeyName'] . "Preview'> \n";
//$str.=print_r($data);


for ($i = 0; $i < $total; $i++) {
    if ($data[$i]['columnName'] != 'executeBy' &&
            $data[$i]['columnName'] != 'executeTime' &&
            $data[$i]['columnName'] != 'isDefault' &&
            $data[$i]['columnName'] != 'isApproved' &&
            $data[$i]['columnName'] != 'isPost' &&
            $data[$i]['columnName'] != 'isDelete' &&
            $data[$i]['columnName'] != 'isNew' &&
            $data[$i]['columnName'] != 'isDraft' &&
            $data[$i]['columnName'] != 'isUpdate' &&
            $data[$i]['columnName'] != 'isDelete' &&
            $data[$i]['columnName'] != 'isActive' &&
            $data[$i]['columnName'] != 'isSeperated' &&
            $data[$i]['columnName'] != 'isSingle' &&
            $data[$i]['columnName'] != 'isReview' &&
            $data[$i]['columnName'] != 'isConsolidation' &&
            $data[$i]['columnName'] != $strId) {
        $str.="<div class='control-group' id='" . $data[$i]['columnName'] . "Div'>
                                <label class='control-label'><?php echo \$leafTranslation['" . $data[$i]['columnName'] . "Label'];  ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='" . $data[$i]['columnName'] . "Preview' id='" . $data[$i]['columnName'] . "Preview' placeholder='Field Of " . $data[$i]['columnName'] . "' class='span3'>
                                </div>
                            </div>";
    }
}
$str.="        </div> \n";
$str.="        <div class='modal-footer'> \n";
$str.="            <a href=javascript:void(0) class='btn btn-danger' onClick=deleteGridRecord('<?php echo \$" . $data[0]['tableName'] . "->getControllerPath(); ?>','<?php echo \$securityToken; ?>','<?php echo \$" . $data[0]['tableName'] . "->getViewPath(); ?>')>Delete</a> \n";
$str.="            <a href=javascript:void(0) onclick=showMeModal('deletePreview',0) class='btn'>Close</a> \n";
$str.="        </div> \n";
$str.="   </div> \n";
$str.="<div align='left'  class='btn-group'> \n";
// old type button.now moved to sidebar.Thinking optional first
//initilize dummy value
$characterArray = null;
$characterArray = range('A', 'Z');
foreach ($characterArray as $character) {
    $str.="        <a title='" . $character . "' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo \$" . $data[0]['tableName'] . "->getViewPath(); ?>','<?php echo \$securityToken; ?>','" . $character . "')>" . $character . "</a> \n";
}

$str.="</div>";
$str.="<br><br>";
/**
  //$str.="<div align='right'> \n";

  //$str.="        <input type='text' class='input-large search-query' name='query' id='query'> \n";
  //$str.="        <a href=javascript:void(0) class=btn onClick=ajaxQuerySearchAll('<?php echo \$" . $data[0]['tableName'] . "->getViewPath(); ?>','<?php echo \$securityToken; ?>')><i class=icon-zoom-in></i> Search </a> \n";
  //$str.="        <a href=javascript:void(0) class=btn onclick=showMeModal('filterGridAdvance',1)><i class=icon-zoom-in></i> Advance Search </a> \n";
  //$str.="        <a href=javascript:void(0) class=btn hide onclick=hideButton();showGrid('<?php echo \$" . $data[0]['tableName'] . "->getViewPath(); ?>','<?php echo \$securityToken; ?>',0,<?php echo LIMIT; ?>) name=clearSearch id=clearSearch><i class=icon-refresh></i>Clear Search </a> \n";
  //$str.="        <a href=javascript:void(0) class=btn onClick=showForm('<?php echo \$" . $data[0]['tableName'] . "->getViewPath(); ?>','<?php echo \$securityToken; ?>')><i class=icon-plus></i> New </a> \n";
  //$str.="        <a href=javascript:void(0) class=btn><i class='icon-file'></i> Report </a> \n";
  //$str.="    </div> \n";
  // old type button.now moved to sidebar
  $str.="    <br> \n";
 * 
 */
$str.="    <div id='infoPanel'><?php if(isset(\$_POST['message'])) {  ?>           
            <div class='alert alert-error'><a class='close' data-dismiss='alert'>x</a><?php echo \$_POST['message']; ?></div>
<?php } ?></div> \n";
$str.="<table class='table table-striped table-bordered table-condensed' name='tableData' id='tableData'> \n";
$str.="        <thead> \n";
$str.="            <tr> \n";
$str.="                 <th>#</th>";
$str.="<?php  \n";
// only output one record only.
for ($i = 0; $i < $total; $i++) {
    if ($data[$i]['Key'] == 'PRI') {
        $str.=" echo \"<th>Action</th>\"; \n";
    } else {

        switch ($data[$i]['columnName']) {
            case 'isDefault':
            case 'isNew':
            case 'isDraft':
            case 'isUpdate':
            case 'isDelete':
            case 'isActive':
            case 'isApproved':
            case 'isReview':
            case 'isPost':
            // both consider optional
            case $data[0]['tableName'] . 'Sequence':
            case $data[0]['tableName'] . 'Code':
                /**
                  // hidden for temporaly purpose.customer request then open it
                 * */
                break;
            case 'executeBy':
            case 'executeTime':
                $str.="if(\$_SESSION ['isAdmin'] ==1) {\n ";
                $str.=" echo \"<th>" . str_replace(array('is', 'execute'), array('', ''), $data[$i]['columnName']) . "</th>\"; \n";
                $str.="}\n  ";
                break;
            default:
                $str.=" echo \"<th>" . str_replace($data[0]['tableName'], '', $data[$i]['columnName']) . "</th>\"; \n";
        }
    }
}
$str.="?>\n";
$str.="       <th><input  class='check_all' type='checkbox' name='check_all' id='check_all' alt='Check Record' onclick=toggleChecked(this.checked)></th>
";
$str.="            </tr> \n";
$str.="        </thead> \n";
$str.="        <tbody id=tableBody> \n";
$str.=" <?php             if (\$_POST['method'] == 'read' && \$_POST['type'] == 'list' && \$_POST['detail'] == 'body') { \n";
$str.="              if (is_array(\$" . $data[0]['tableName'] . "Array)) { \n";
$str.="                \$totalRecord = 0; \n";
$str.="                \$totalRecord = count(\$" . $data[0]['tableName'] . "Array); \n";
$str.="                if (\$totalRecord > 0) { \n";
$str.="                      \$counter=0; \n";
$str.="                    for (\$i = 0; \$i < \$totalRecord; \$i++) { \n";
$str.="                     \$counter++;\n";
$str.="                     echo \"<tr>\"; \n";
$str.="                     echo \"<td>\".(\$counter+\$offset).\"</td>\"; \n";
// initlize dummy value
$strInside = null;
$align = null;

for ($i = 0; $i < $total; $i++) {
    if ($data[$i]['Key'] == 'PRI') {
        $str.=" echo  \"<td><div class='btn-group'>
		<a rel='tooltip' class='tooltip-top btn btn-warning' data-original-title='Edit' onClick=showFormUpdate('\".\$" . $data[0]['tableName'] . "->getViewPath().\"','\".\$securityToken.\"','\".intval(\$" . $data[0]['tableName'] . "Array [\$i]['" . $data[0]['primaryKeyName'] . "']).\"')><i class='icon-edit icon-white'></i></a>  
                    <a rel='tooltip' class='tooltip-top btn btn-danger' data-original-title='Delete' onClick=showModalDelete(";
        for ($d = 0; $d < $total; $d++) {
            // encode first to prevent bugs on javascript parsing
            $strInside.="'\".rawurlencode(\$" . $data[0]['tableName'] . "Array [\$i]['" . $data[$d]['columnName'] . "']).\"',";
        }
        $str.=substr($strInside, 0, -1);
        $str.=")><i class='icon-trash  icon-white'></i></a></td>\"; \n";
    } else {

        switch ($data[$i]['columnName']) {
            case 'isDefault':
            case 'isNew':
            case 'isDraft':
            case 'isUpdate':
            case 'isDelete':
            case 'isActive':
            case 'isApproved':
            case 'isReview':
            case 'isPost':
            // both consider optional
            case $data[0]['tableName'] . 'Sequence':
            case $data[0]['tableName'] . 'Code':

                /**
                  // hidden for temporaly purpose.customer request then open it
                  $str.=" if(\$_SESSION ['isAdmin'] ==1) {\n ";
                  $str.="		if(isset(\$" . $data[0]['tableName'] . "Array[\$i]['" . $data[$i]['columnName'] . "'])) {\n ";
                  $str.=" echo \"<td>\".\$" . $data[0]['tableName'] . "Array[\$i]['" . $data[$i]['columnName'] . "'].\"</td>\"; \n";
                  $str.=" } else { \n";
                  $str.="			echo \"<td>&nbsp;</td>\"; \n";
                  $str.="		}\n";
                  $str.="	} \n ";
                  $str.="?>\n";
                 * */
                break;
            case 'executeBy':
                $str.="if(isset(\$" . $data[0]['tableName'] . "Array[\$i]['" . $data[$i]['columnName'] . "'])) { \n";
                $str.="	echo \"<td>\".\$" . $data[0]['tableName'] . "Array[\$i]['staffName'].\"</td>\"; \n";
                $str.="} else {\n";
                $str.="	echo \"<td>&nbsp;</td>\";\n";
                $str.="	}\n  ";
                break;
            case 'executeTime':
                $str.="if(isset(\$" . $data[0]['tableName'] . "Array[\$i]['" . $data[$i]['columnName'] . "'])) { \n";
                $str.=" 	\$valueArray = \$" . $data[0]['tableName'] . "Array[\$i]['" . $data[$i]['columnName'] . "'];  \n";

                $str.=" 	\$valueArrayDate 	=	explode(' ',\$valueArray);  \n";
                $str.=" 	\$valueArrayFirst 	= 	\$valueArrayDate[0];         \n";
                $str.=" 	\$valueArraySecond	= 	\$valueArrayDate[1];          \n";

                $str.=" 	\$valueDataFirst 	= 	explode('-',\$valueArrayFirst);  \n";
                $str.=" 	\$year 				=	\$valueDataFirst[0];               \n";
                $str.=" 	\$month 			= 	\$valueDataFirst[1];            \n";
                $str.=" 	\$day	 			= 	\$valueDataFirst[2];                \n";

                $str.="		\$valueDataSecond 	= 	explode(':',\$valueArraySecond);  \n";
                $str.=" 	\$hour 				= 	\$valueDataSecond[0];  \n";
                $str.=" 	\$minute 			= 	\$valueDataSecond[1];  \n";
                $str.=" 	\$second 			= 	\$valueDataSecond[2];  \n";

                $str.="	\$value = date(\$systemFormat['systemSettingDateFormat'].\" \".\$systemFormat['systemSettingTimeFormat'],mktime(\$hour,\$minute,\$second,\$month,\$day,\$year)); \n";
                $str.="	echo \"<td>\".\$value.\"</td>\"; \n";
                $str.="} else { \n";
                $str.="	echo \"<td>&nbsp;</td>\"; \n";
                $str.="} \n  	";
                break;
            default:
                // if the type are decimel or float. align right
                // if the length is 4 align  center
                // if  normal align  left.For easy reading

                if ($data[$i]['formType'] == 'double' || $data[$i]['formType'] == 'int') {
                    $align = 'right';
                } else if ($data[$i]['length'] == 4) {
                    $align = 'center';
                } else {
                    $align = 'left';
                }
                //must check data type if date .. convert output to master setting date
                $str.="if(isset(\$" . $data[0]['tableName'] . "Array[\$i]['" . $data[$i]['columnName'] . "'])) { \n";

                if ($data[$i]['formType'] == 'date') {
                    $str.=" 	\$valueArray 		= 	\$" . $data[0]['tableName'] . "Array[\$i]['" . $data[$i]['columnName'] . "']; \n";
                    $str.=" 	\$valueData 		= 	explode('-',\$valueArray);  \n";
                    $str.=" 	\$year 				= 	\$valueData[0];  \n";
                    $str.=" 	\$month 			= 	\$valueData[1];   \n";
                    $str.=" 	\$day 				= 	\$valueData[2];  \n";
                    $str.=" 	\$value				=	date(\$systemFormat['systemSettingDateFormat'],mktime(0,0,0,\$month,\$day,\$year));  \n";
                } else if ($data[$i]['formType'] == 'datetime') {
                    $str.=" 	\$valueArray = \$" . $data[0]['tableName'] . "Array[\$i]['" . $data[$i]['columnName'] . "'];  \n";

                    $str.=" 	\$valueArrayDate 	=	explode(' ',\$valueArray);\n";
                    $str.=" 	\$valueArrayFirst 	= 	\$valueArrayDate[0];\n";
                    $str.=" 	\$valueArraySecond	= 	\$valueArrayDate[1];\n";

                    $str.=" 	\$valueDataFirst 	= 	explode('-',\$valueArrayFirst);\n";
                    $str.=" 	\$year 				=	\$valueDataFirst[0];\n";
                    $str.=" 	\$month 			= 	\$valueDataFirst[1];\n";
                    $str.=" 	\$day	 			= 	\$valueDataFirst[2];\n";

                    $str.="	\$valueDataSecond 	= 	explode(':',\$valueArraySecond);\n";
                    $str.=" 	\$hour 				= 	\$valueDataSecond[0];\n";
                    $str.=" 	\$minute 			= 	\$valueDataSecond[1];\n";
                    $str.=" 	\$second 			= 	\$valueDataSecond[2];\n";

                    $str.=" \$value = date(\$systemFormat['systemSettingDateFormat'].\" \".\$systemFormat['systemSettingTimeFormat'],mktime(\$hour,\$minute,\$second,\$month,\$day,\$year)); \n";
                } else {

                    $str.=" \$value = \$" . $data[0]['tableName'] . "Array[\$i]['" . $data[$i]['columnName'] . "'];\n";
                }
                $str.=" } \n";
                $str.="if(isset(\$value) && (strlen(\$value) > 0 )) {\n";
                $str.="	echo \"<td align=" . $align . ">\".\$value.\"</td>\"; \n";
                $str.="} else { \n ";
                $str.="	echo \"<td  align=" . $align . ">&nbsp;</td>\"; \n ";
                $str.="}\n";
        }
    }
}
// new experiment delete function back.. give more focus to user.. 
$str.="if(\$" . $data[0]['tableName'] . "Array[\$i]['isDelete']) {\n";
$str.="    \$checked='checked';\n";
$str.="} else {\n";
$str.="    \$checked=null;\n";
$str.="}\n";
$str.="                         echo \"<td>
    <input style='display:none;' type='checkbox' name='" . $data[0]['primaryKeyName'] . "[]' id='" . $data[0]['primaryKeyName'] . "' value='\".\$" . $data[0]['tableName'] . "Array[\$i]['" . $data[0]['primaryKeyName'] . "'].\"'>
    <input \".\$checked.\" type='checkbox' name='isDelete[]' id='isDelete' value='\".\$" . $data[0]['tableName'] . "Array[\$i]['isDelete'].\"'>
    
</td>\";\n";
$str.="                    echo \"</tr>\"; \n";
$str.="                  }  } \n";
$str.="                } else { ?> \n";
$str.="                    <tr> \n";
$str.="                        <td colspan='6'><?php \$" . $data[0]['tableName'] . "->exceptionMessage('No Record'); ?></td> \n";
$str.="                    </tr> \n";
$str.="                    <?php \n";
$str.="                } \n";
$str.="            } else { ?> \n";
$str.="                <tr> \n";
$str.="                    <td colspan='6'><?php \$" . $data[0]['tableName'] . "->exceptionMessage('Data Record Problem'); ?></td> \n";
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
$str.="<div class='pull-right'> \n";
$str.="<button class='delete btn btn-warning' type='button' onClick=deleteGridRecordCheckbox('<?php echo \$" . $data[0]['tableName'] . "->getControllerPath(); ?>','<?php echo \$securityToken; ?>','<?php echo \$" . $data[0]['tableName'] . "->getViewPath(); ?>')> \n";
$str.="<i class='icon-white icon-trash'></i> \n";
$str.="Delete Checked Box \n";
$str.="</button> \n";
$str.="</div> \n";
$str.="    <div class='pagination' id='pagingHtml' name='pagingHtml'><?php \$navigation->pagenationv4(\$offset); ?></div> \n";
$str.="     <script language='javascript' type='text/javascript'> \n";
$str.="         \$(document).ready(function(){ \n";
$str.="            // load the system cell if session  and token exist;  \n";
$str.="            <?php if(isset(\$_POST['query'])) { ?> \n";
$str.="                    \$('#clearSearch').removeClass(); \n";
$str.="                    \$('#clearSearch').addClass('btn'); \n";
$str.="            <?php } ?>  \n";
$str.=" $('#dateRangeStart').datepicker({  \n";
$str.="                 format :'d-m-yyyy'  \n";
$str.="             });  \n";
$str.="             $('#dateRangeEnd').datepicker({  \n";
$str.="                 format :'d-m-yyyy'  \n";
$str.="             });   \n";
$str.="                     \$('a[rel=tooltip]').tooltip();    \n";
$str.="         }); \n";
$str.="   function toggleChecked(status) {\n";
$str.=" $('input:checkbox').each( function() {\n";
$str.=" $(this).attr('checked',status);\n";
$str.=" }); } \n";
$str.="      </script> \n";
$str.="</div>";
$str.="    <?php }  \n";
$str.="           if ((isset(\$_POST['method']) == 'new' || isset(\$_POST['method']) == 'read') && \$_POST['type'] == 'form') { ?> \n";

$str.="    <div id='infoPanel'></div> \n";
$str.="         <form class='well " . $data[0]['targetFormStyle'] . "'>\n";

$str.="    <input type='hidden' name='" . $data[0]['primaryKeyName'] . "' id='" . $data[0]['primaryKeyName'] . "' 
value='<?php if (isset(\$_POST['" . $data[0]['primaryKeyName'] . "'])) { 
                echo \$_POST['" . $data[0]['primaryKeyName'] . "'];    
            }  ?>'> \n";
// start loop field
//$str.=print_r($data);
$total = 0;
$total = count($data);
for ($i = 0; $i < $total; $i++) {
    switch ($data[$i]['formType']) {
        case 'varchar':
        case 'text':
        case 'double':
            // check if field name have Code.. Max for character.
            $pos = strpos($data[$i]['columnName'], 'Code');
            if ($pos !== false) {

                $str.="<div class='control-group' id='" . $data[$i]['columnName'] . "Form'>
                                <label class='control-label'><?php echo \$leafTranslation['" . $data[$i]['columnName'] . "Label']; ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='" . $data[$i]['columnName'] . "' id='" . $data[$i]['columnName'] . "' placeholder='Field Of " . $data[$i]['columnName'] . "' class='span3' 
                                    value='<?php if(isset($" . $data[0]['tableName'] . "Array) && is_array($" . $data[0]['tableName'] . "Array)) {  echo \$" . $data[0]['tableName'] . "Array[0]['" . $data[$i]['columnName'] . "']; } ?>' maxlength='4'>
                                </div>
                            </div>";
            } else {
                $str.="<div class='control-group' id='" . $data[$i]['columnName'] . "Form'>
                                <label class='control-label'><?php echo \$leafTranslation['" . $data[$i]['columnName'] . "Label']; ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='" . $data[$i]['columnName'] . "' id='" . $data[$i]['columnName'] . "' placeholder='Field Of " . $data[$i]['columnName'] . "' class='span3' 
                                    value='<?php if(isset($" . $data[0]['tableName'] . "Array) && is_array($" . $data[0]['tableName'] . "Array)) {  echo \$" . $data[0]['tableName'] . "Array[0]['" . $data[$i]['columnName'] . "']; } ?>'>
                                </div>
                            </div>";
            }
            break;
        case 'int':
            if ($data[$i]['Key'] == 'PRI') {
                // don't do anything for primary key. input hidden allready cater for it
            } else if ($data[$i]['foreignKey'] == 1 && $data[$i]['Key'] == 'MUL') {
                $str.="<div class='control-group' id='" . $data[$i]['columnName'] . "Form'>
                                <label class='control-label'><?php echo \$leafTranslation['" . $data[$i]['columnName'] . "Label']; ?></label>
                                <div class='controls  input-prepend'><select name='" . $data[$i]['columnName'] . "' id='" . $data[$i]['columnName'] . "'>\n
                                <?php
                                if (is_array(\$" . $data[$i]['columnName'] . "Array)) {
                                    \$totalRecord = 0;
                                    \$totalRecord = count(\$" . $data[$i]['columnName'] . "Array);
                                    for (\$i = 0; \$i < \$totalRecord; \$i++) { ?>
                                        <option value='<?php echo \$" . $data[$i]['columnName'] . "Array[0][\$i]['" . $data[$i]['columnName'] . "']; ?>'><?php echo \$" . $data[$i]['columnName'] . "Array[\$i]['" . $data[$i]['columnName'] . "Desc']; ?></option>                                       
                                    }\n
                                }\n                                
                            </select>\n
                            </div>\n
                          </div>\n";
            } else if ($data[$i]['Key'] == '') {
                if ($data[$i]['columnName'] == 'executeBy') {

                    $str.="<div class='control-group' id='" . $data[$i]['columnName'] . "Form' >\n
                                <label class='control-label'><?php echo \$leafTranslation['" . $data[$i]['columnName'] . "Label']; ?></label>\n
                                <div class='controls  input-prepend'>\n
                                    <input type='text' name='" . $data[$i]['columnName'] . "' id='" . $data[$i]['columnName'] . "' placeholder='String Only' class='span3' value='<?php if(isset($" . $data[0]['tableName'] . "Array) && is_array($" . $data[0]['tableName'] . "Array)) { echo \$" . $data[0]['tableName'] . "Array[0]['staffName']; } ?>' readOnly>\n
                                    <span name='numericHelpMe' id='" . $data[$i]['columnName'] . "HelpMe' class='help-inline' ></span>\n
                                </div>\n
                            </div>\n";
                } else {
                    $str.="<div class='control-group' id='" . $data[$i]['columnName'] . "Form' >\n
                                <label class='control-label'><?php echo \$leafTranslation['" . $data[$i]['columnName'] . "Label']; ?></label>\n
                                <div class='controls  input-prepend'>\n
                                    <input type='text' name='" . $data[$i]['columnName'] . "' id='" . $data[$i]['columnName'] . "' placeholder='Numeric Only' class='span3' value='<?php if(isset($" . $data[0]['tableName'] . "Array) && is_array($" . $data[0]['tableName'] . "Array)) { echo \$" . $data[0]['tableName'] . "Array[0]['" . $data[$i]['columnName'] . "']; } ?>'>\n
                                    <span name='numericHelpMe' id='" . $data[$i]['columnName'] . "HelpMe' class='help-inline' ></span>\n
                                </div>\n
                            </div>\n";
                }
            }
            break;
        case 'tiny':
            // by default preview tiny is not available
            break;

        case 'date':
        case 'datetime':
            //must check data type if date .. convert output to master setting date

            if ($data[$i]['formType'] == 'date') {
                $str.="<?php ";
                $str.="if(isset($" . $data[0]['tableName'] . "Array) && is_array($" . $data[0]['tableName'] . "Array)) { \n";
                $str.="     \$valueArray        =   \$" . $data[0]['tableName'] . "Array[0]['" . $data[$i]['columnName'] . "']; \n";
                $str.="     \$valueData         =   explode('-',\$valueArray);  \n";
                $str.="     \$year              =   \$valueData[0];  \n";
                $str.="     \$month             =   \$valueData[1];   \n";
                $str.="     \$day               =   \$valueData[2];  \n";
                $str.="     \$value             =   date(\$systemFormat['systemSettingDateFormat'],mktime(0,0,0,\$month,\$day,\$year));  \n";
                $str.=" } ?>";
            } else if ($data[$i]['formType'] == 'datetime') {
                $str.="<?php \n";
                $str.="if(isset($" . $data[0]['tableName'] . "Array) && is_array($" . $data[0]['tableName'] . "Array)) { \n";
                $str.="     \$valueArray = \$" . $data[0]['tableName'] . "Array[0]['" . $data[$i]['columnName'] . "'];  \n";

                $str.="     \$valueArrayDate    =   explode(' ',\$valueArray);\n";
                $str.="     \$valueArrayFirst   =   \$valueArrayDate[0];\n";
                $str.="     \$valueArraySecond  =   \$valueArrayDate[1];\n";

                $str.="     \$valueDataFirst    =   explode('-',\$valueArrayFirst);\n";
                $str.="     \$year              =   \$valueDataFirst[0];\n";
                $str.="     \$month             =   \$valueDataFirst[1];\n";
                $str.="     \$day               =   \$valueDataFirst[2];\n";

                $str.=" \$valueDataSecond   =   explode(':',\$valueArraySecond);\n";
                $str.="     \$hour              =   \$valueDataSecond[0];\n";
                $str.="     \$minute            =   \$valueDataSecond[1];\n";
                $str.="     \$second            =   \$valueDataSecond[2];\n";

                $str.=" \$value = date(\$systemFormat['systemSettingDateFormat'].\" \".\$systemFormat['systemSettingTimeFormat'],mktime(\$hour,\$minute,\$second,\$month,\$day,\$year)); \n";
                $str.=" }\n ?>";
            }
            if ($data[$i]['columnName'] == 'executeTime') {
                $str.="<div class='control-group' id='" . $data[$i]['columnName'] . "Form'>
                                <label class='control-label'><?php echo \$leafTranslation['" . $data[$i]['columnName'] . "Label']; ?></label>
                                <div class='controls input-prepend'>
                                    <span class='add-on'>
                                        <i class='icon-calendar'></i>
                                    </span>    
                                    <input type='date' name='" . $data[$i]['columnName'] . "' id='" . $data[$i]['columnName'] . "' placeholder='Date Validation' class='span3' value='<?php if(isset(\$value)) { echo \$value; } ?>' readOnly>
                                    <span name='" . $data[$i]['columnName'] . "HelpMe' id='" . $data[$i]['columnName'] . "HelpMe' class='help-inline'></span>
                                </div>
                            </div>";
            } else {
                $str.="<div class='control-group' id='" . $data[$i]['columnName'] . "Form'>
                                <label class='control-label'><?php echo \$leafTranslation['" . $data[$i]['columnName'] . "Label']; ?></label>
                                <div class='controls input-prepend'>
                                    <span class='add-on'>
                                        <i class='icon-calendar'></i>
                                    </span>    
                                    <input type='date' name='" . $data[$i]['columnName'] . "' id='" . $data[$i]['columnName'] . "' placeholder='Date Validation' class='span3' value='<?php echo \$" . $data[0]['tableName'] . "Array[0]['" . $data[$i]['columnName'] . "']; ?>'>
                                    <span name='" . $data[$i]['columnName'] . "HelpMe' id='" . $data[$i]['columnName'] . "HelpMe' class='help-inline'></span>
                                </div>
                            </div>";
            }

            break;
        default :
            $str.=" unditefi";
    }
}
// end loop field
$str.="</form>\n";
$str.="<div class='form-actions'>\n";
$str.="    <div class='btn-toolbar'> \n";
$str.="        <div class='btn-group'> \n";
$str.="            <a  name='auditRecordButton' id='auditRecordButton'  href=javascript:void(0) 
    class='<?php if(\$leafAccess['isDraft']==0) { ?>btn btn-warning disabled<?php } else { ?>btn btn-warning<?php } ?>' 
    <?php if(\$leafAccess['isDraft']==1) { ?>) { ?>onClick=auditRecord('<?php echo \$" . $data[0]['tableName'] . "->getControllerPath(); ?>','<?php echo \$securityToken; ?>',)<?php } ?>><i class='icon-warning-sign icon-white'></i><?php echo \$buttonTranslation['isAuditLabel']; ?></a> \n";
$str.="        </div>";
$str.="        <div class='btn-group'>";
$str.="            <a  name='newRecordButton1' id='newRecordButton1' href=javascript:void(0) class='<?php if(\$leafAccess['leafAccessCreateValue']==0) { ?>btn btn-success disabled<?php } else { ?>btn btn-success  <?php } ?>'><i class=icon-plus icon-white></i><?php echo \$buttonTranslation['isNewLabel'][0]; ?></a> \n";
$str.="            <a  name='newRecordButton2' id='newRecordButton2' href=javascript:void(0) data-toggle='dropdown' class='<?php if(\$leafAccess['leafAccessCreateValue']==0) { ?>btn dropdown-toggle btn-success disabled<?php } else { ?>btn dropdown-toggle btn-success<?php } ?>'><span class=caret></span></a> \n";
$str.="            <ul class='dropdown-menu'> \n";
$str.="                <li><a name='newRecordButton3' id='newRecordButton3' href=javascript:void(0) <?php if(\$leafAccess['leafAccessCreateValue']==1) { ?>onClick=newRecord('<?php echo \$" . $data[0]['tableName'] . "->getControllerPath(); ?>','<?php echo \$securityToken; ?>',1,'<?php echo \$leafAccess['leafAccessUpdateValue'];?>','<?php echo \$leafAccess['leafAccessDeleteValue'];?>') <?php } ?> class='<?php if(\$leafAccess['isNew']==0) { ?>disabled<?php } ?>'><i class='icon-plus'></i><?php echo \$buttonTranslation['isNewLabel'][1]; ?></a></li> \n";
$str.="                <li><a name='newRecordButton4' id='newRecordButton4' href=javascript:void(0) <?php if(\$leafAccess['leafAccessCreateValue']==1) { ?>onClick=newRecord('<?php echo \$" . $data[0]['tableName'] . "->getControllerPath(); ?>','<?php echo \$securityToken; ?>',2,'<?php echo \$leafAccess['leafAccessUpdateValue'];?>','<?php echo \$leafAccess['leafAccessDeleteValue'];?>') <?php } ?> class='<?php if(\$leafAccess['isNew']==0) { ?>disabled<?php } ?>'><i class='icon-edit'></i><?php echo \$buttonTranslation['isNewLabel'][2]; ?></a></li> \n";
$str.="                <li><a name='newRecordButton5' id='newRecordButton5' href=javascript:void(0) <?php if(\$leafAccess['leafAccessCreateValue']==1) { ?>onClick=newRecord('<?php echo \$" . $data[0]['tableName'] . "->getControllerPath(); ?>','<?php echo \$securityToken; ?>',3,'<?php echo \$leafAccess['leafAccessUpdateValue'];?>','<?php echo \$leafAccess['leafAccessDeleteValue'];?>') <?php } ?> class='<?php if(\$leafAccess['isNew']==0) { ?>disabled<?php } ?>'><i class='icon-print'></i><?php echo \$buttonTranslation['isNewLabel'][3]; ?></a></li> \n";
$str.="                <li><a name='newRecordButton6' id='newRecordButton6' href=javascript:void(0) <?php if(\$leafAccess['leafAccessCreateValue']==1) { ?>onClick=newRecord('<?php echo \$" . $data[0]['tableName'] . "->getControllerPath(); ?>','<?php echo \$securityToken; ?>',4,'<?php echo \$leafAccess['leafAccessUpdateValue'];?>','<?php echo \$leafAccess['leafAccessDeleteValue'];?>') <?php } ?> class='<?php if(\$leafAccess['isNew']==0) { ?>disabled<?php } ?>'><i class='icon-print'></i><?php echo \$buttonTranslation['isNewLabel'][4]; ?></a></li> \n";
$str.="                <li><a name='newRecordButton7' id='newRecordButton7' href=javascript:void(0) <?php if(\$leafAccess['leafAccessCreateValue']==1) { ?>onClick=newRecord('<?php echo \$" . $data[0]['tableName'] . "->getControllerPath(); ?>','<?php echo \$securityToken; ?>',5,'<?php echo \$leafAccess['leafAccessUpdateValue'];?>','<?php echo \$leafAccess['leafAccessDeleteValue'];?>') <?php } ?> class='<?php if(\$leafAccess['isNew']==0) { ?>disabled<?php } ?>'><i class='icon-list'></i><?php echo \$buttonTranslation['isNewLabel'][5]; ?></a></li> \n";
$str.="            </ul> \n";
$str.="        </div> \n";
$str.="        <div class='btn-group'> \n";
$str.="            <a  name='updateRecordButton1' id='updateRecordButton1' href=javascript:void(0) class='<?php if(\$leafAccess['leafAccessUpdateValue']==0) { ?>btn btn-info 	disabled<?php } else { ?>btn btn-info <?php } ?>'><i class=icon-edit icon-white></i><?php echo \$buttonTranslation['isUpdateLabel'][0]; ?></a> \n";
$str.="            <a  name='updateRecordButton2' id='updateRecordButton2' href=javascript:void(0) data-toggle='dropdown' class='<?php if(\$leafAccess['leafAccessUpdateValue']==0) { ?>btn dropdown-toggle btn-info disabled<?php } else { ?>btn dropdown-toggle btn-info <?php } ?>'><span class='caret'></span></a> \n";
$str.="            <ul class='dropdown-menu'> \n";
$str.="                <li><a name='updateRecordButton3' id='updateRecordButton3' href=javascript:void(0) <?php if(\$leafAccess['leafAccessUpdateValue']==1) { ?>onClick=updateRecord('<?php echo \$" . $data[0]['tableName'] . "->getControllerPath(); ?>','<?php echo \$securityToken; ?>',1,'<?php echo \$leafAccess['leafAccessDeleteValue'];?>')<?php } ?> class='<?php if(\$leafAccess['isUpdate']==0) { ?>disabled <?php } ?>'><i class='icon-plus'></i><?php echo \$buttonTranslation['isUpdateLabel'][1]; ?></a></li> \n";
$str.="                <li><a name='updateRecordButton4' id='updateRecordButton4' href=javascript:void(0) <?php if(\$leafAccess['leafAccessUpdateValue']==1) { ?>onClick=updateRecord('<?php echo \$" . $data[0]['tableName'] . "->getControllerPath(); ?>','<?php echo \$securityToken; ?>',2,'<?php echo \$leafAccess['leafAccessDeleteValue'];?>')<?php } ?> class='<?php if(\$leafAccess['isUpdate']==0) { ?>disabled <?php } ?>'><i class='icon-print'></i><?php echo \$buttonTranslation['isUpdateLabel'][2]; ?></a></li> \n";
$str.="                <li><a name='updateRecordButton5' id='updateRecordButton5' href=javascript:void(0) <?php if(\$leafAccess['leafAccessUpdateValue']==1) { ?>onClick=updateRecord('<?php echo \$" . $data[0]['tableName'] . "->getControllerPath(); ?>','<?php echo \$securityToken; ?>',3,'<?php echo \$leafAccess['leafAccessDeleteValue'];?>')<?php } ?> class='<?php if(\$leafAccess['isUpdate']==0) { ?>disabled <?php } ?>'><i class='icon-list-alt'></i><?php echo \$buttonTranslation['isUpdateLabel'][3]; ?></a></li> \n";
$str.="            </ul> \n";
$str.="        </div> \n";
$str.="        <div class='btn-group'> \n";
$str.="            <a name='deleteRecordButton' id='deleteRecordButton' href='javascript:void(0)'   <?php if(\$leafAccess['isDelete']==1) { ?>onClick=deleteRecord('<?php echo \$" . $data[0]['tableName'] . "->getControllerPath(); ?>','<?php echo \$securityToken; ?>','<?php echo \$leafAccess['leafAccessDeleteValue'];?>')<?php } ?> class='<?php if(\$leafAccess['isDelete']==0) { ?>btn btn-danger disabled<?php } else { ?>btn btn-danger<?php } ?>'><i class='icon-trash icon-white'></i><?php echo \$buttonTranslation['isDeleteLabel']; ?></a> \n";
$str.="        </div> \n";
$str.="        <div class='btn-group'>";
$str.="            <a name='resetRecordButton' id='resetRecordButton' href=javascript:void(0) class='btn btn-info' onClick=resetRecord('<?php echo \$" . $data[0]['tableName'] . "->getControllerPath(); ?>','<?php echo \$securityToken; ?>','<?php echo \$leafAccess['leafAccessUpdateValue'];?>','<?php echo \$leafAccess['leafAccessDeleteValue'];?>')><i class=icon-refresh icon-white></i><?php echo \$buttonTranslation['isResetLabel']; ?></a> \n";
$str.="        </div> \n";
$str.="        <div class='btn-group'>";
$str.="            <a name='postRecordButton' id='postRecordButton' href=javascript:void(0) class='<?php if(\$leafAccess['leafAccessPostValue']==0) { ?>btn btn-warning  disabled<?php } else { ?>btn btn-warning<?php } ?>' <?php if(\$leafAccess['isPost']==1) { ?>onClick=postRecord('<?php echo \$" . $data[0]['tableName'] . "->getControllerPath(); ?>','<?php echo \$securityToken; ?>')<?php } ?>><i class=icon-cog icon-white></i><?php echo \$buttonTranslation['isPostLabel']; ?></a> \n";
$str.="        </div> \n";
$str.="        <div class='btn-group'>";
$str.="            <a name='listRecordButton' id='listRecordButton' href=javascript:void(0) class='btn btn-info' onClick=showGrid('<?php echo \$" . $data[0]['tableName'] . "->getViewPath(); ?>','<?php echo \$securityToken; ?>',0,<?php echo LIMIT; ?>)><i class=icon-list icon-white></i>Listing</a> \n";
$str.="        </div> \n";
$str.="        <div class='btn-group'> \n";
$str.="            <a name='firstRecordButton' id='firstRecordButton' href=javascript:void(0) class='btn btn-info' onClick=firstRecord('<?php echo \$" . $data[0]['tableName'] . "->getControllerPath(); ?>','<?php echo \$securityToken; ?>','<?php echo \$leafAccess['leafAccessUpdateValue'];?>','<?php echo \$leafAccess['leafAccessDeleteValue'];?>')><i class=icon-fast-backward icon-white></i><?php echo \$defaultTranslation['firstButtonLabel']; ?></a> \n";
$str.="        </div> \n";
$str.="        <div class='btn-group'> \n";
$str.="            <a name='previousRecordButton' id='previousRecordButton' href=javascript:void(0) class='btn btn-info disabled' onClick=previousRecord('<?php echo \$" . $data[0]['tableName'] . "->getControllerPath(); ?>','<?php echo \$securityToken; ?>','<?php echo \$leafAccess['leafAccessUpdateValue'];?>','<?php echo \$leafAccess['leafAccessDeleteValue'];?>')><i class=icon-backward icon-white></i><?php echo \$defaultTranslation['previousButtonLabel']; ?></a> \n";
$str.="        </div> \n";
$str.="        <div class='btn-group'> \n";
$str.="            <a name='nextRecordButton' id='nextRecordButton' href=javascript:void(0) class='btn btn-info disabled' onClick=nextRecord('<?php echo \$" . $data[0]['tableName'] . "->getControllerPath(); ?>','<?php echo \$securityToken; ?>','<?php echo \$leafAccess['leafAccessUpdateValue'];?>','<?php echo \$leafAccess['leafAccessDeleteValue'];?>')><i class=icon-forward icon-white></i><?php echo \$defaultTranslation['nextButtonLabel']; ?></a> \n";
$str.="        </div> \n";
$str.="        <div class='btn-group'> \n";
$str.="            <a name='lastRecordButton' id='lastRecordButton' href=javascript:void(0) class='btn btn-info' onClick=lastRecord('<?php echo \$" . $data[0]['tableName'] . "->getControllerPath(); ?>','<?php echo \$securityToken; ?>','<?php echo \$leafAccess['leafAccessUpdateValue'];?>','<?php echo \$leafAccess['leafAccessDeleteValue'];?>')><i class=icon-fast-forward icon-white></i><?php echo \$defaultTranslation['endButtonLabel']; ?></a> \n";
$str.="       </div> \n";
$str.="    </div></div> \n";
$str.="    <input type='hidden' name='x' id='x'> \n";
$str.="    <input type='hidden' name='firstRecord' id='firstRecord' value='<?php if(isset(\$firstRecord)) { echo \$firstRecord; } ?>'> \n";
$str.="    <input type='hidden' name='nextRecord' id='nextRecord' value='<?php if(isset(\$nextRecord)) { echo \$nextRecord; } ?>'> \n";
$str.="    <input type='hidden' name='previousRecord' id='previousRecord' value='<?php if(isset(\$previousRecord)) { echo \$previousRecord; } ?>'> \n";
$str.="    <input type='hidden' name='lastRecord' id='lastRecord' value='<?php if(isset(\$lastRecord)) { echo \$lastRecord; } ?>'> \n";
$str.="    <input type='hidden' name='endRecord' id='endRecord' value='<?php if(isset(\$endRecord)) { echo \$endRecord; } ?>'> \n";
$str.="    <script language='javascript' type='text/javascript'> \n";
$str.="         \$(document).ready(function(){  \n";
for ($i = 0; $i < $total; $i++) {
    switch ($data[$i]['formType']) {
        case 'varchar':
        case 'text':
            $str.="validateMeAlphaNumeric('" . $data[$i]['columnName'] . "') \n";
            break;
        case 'double':
            $str.="validateMeAlphaCurrency('" . $data[$i]['columnName'] . "') \n";
            break;
        case 'int':
            $str.="validateMeNumeric('" . $data[$i]['columnName'] . "') \n";
            break;
        case 'date':
            $str.=" \$('" . $data[$i]['columnName'] . "').datepicker({ \n";
            $str.="    format :'<?php echo  \$systemFormat['systemSettingDateFormat']; ?>\n";
            $str.="   });  \n";
            break;
        case 'datetime':
            $str.=" \$('" . $data[$i]['columnName'] . "').datepicker({ \n";
            $str.="    format :'<?php echo \$systemFormat['systemSettingDateFormat'].\$systemFormat['systemSettingTimeFormat']; ?>'\n";
            $str.="   });  \n";
            break;
    }
}
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
$str.="            <?php } else  if (\$_POST['" . $data[0]['primaryKeyName'] . "']) { ?> \n";
// new button segment
// remove classes
$str.=" \$('#newRecordButton1').removeClass(); \n";
$str.=" \$('#newRecordButton2').removeClass(); \n";
$str.=" \$('#newRecordButton3').removeClass(); \n";
$str.=" \$('#newRecordButton4').removeClass(); \n";
$str.=" \$('#newRecordButton5').removeClass(); \n";
$str.=" \$('#newRecordButton6').removeClass(); \n";
$str.=" \$('#newRecordButton7').removeClass(); \n";
// add disabled class
$str.=" \$('#newRecordButton1').addClass('btn btn-success disabled'); \n";
$str.=" \$('#newRecordButton2').addClass('btn  dropdown-toggle btn-success disabled'); \n";

// empty the  onClick field.

$str.=" \$('#newRecordButton1').attr('onClick', ''); \n";
$str.=" \$('#newRecordButton2').attr('onClick', ''); \n";
$str.=" \$('#newRecordButton3').attr('onClick', ''); \n";
$str.=" \$('#newRecordButton4').attr('onClick', ''); \n";
$str.=" \$('#newRecordButton5').attr('onClick', ''); \n";
$str.=" \$('#newRecordButton6').attr('onClick', ''); \n";
$str.=" \$('#newRecordButton7').attr('onClick', ''); \n";

// end new button segment
// update button segment
$str.=" \$('#updateRecordButton1').removeClass(); \n";
$str.=" \$('#updateRecordButton2').removeClass(); \n";
$str.=" \$('#updateRecordButton3').removeClass(); \n";
$str.=" \$('#updateRecordButton4').removeClass(); \n";
$str.=" \$('#updateRecordButton5').removeClass(); \n";

$str.="<?php if(\$leafAccess['leafAccessUpdateValue']==1) { ?> \n";
$str.=" \$('#updateRecordButton1').addClass('btn btn-info'); \n";
// toggle button
$str.=" \$('#updateRecordButton2').addClass('btn dropdown-toggle btn-info'); \n";
$str.=" \$('#updateRecordButton3').attr('onClick', \"updateRecord('<?php echo \$" . $data[0]['tableName'] . "->getControllerPath(); ?>','<?php echo \$securityToken; ?>',1,<?php echo \$leafAccess['leafAccessDeleteValue'];?>')\"); \n";
$str.=" \$('#updateRecordButton4').attr('onClick', \"updateRecord('<?php echo \$" . $data[0]['tableName'] . "->getControllerPath(); ?>','<?php echo \$securityToken; ?>',2,'<?php echo \$leafAccess['leafAccessDeleteValue'];?>')\"); \n";
$str.=" \$('#updateRecordButton5').attr('onClick', \"updateRecord('<?php echo \$" . $data[0]['tableName'] . "->getControllerPath(); ?>','<?php echo \$securityToken; ?>',3,'<?php echo \$leafAccess['leafAccessDeleteValue'];?>')\"); \n";
$str.="<?php }  else { ?> \n";
$str.=" \$('#updateRecordButton1').addClass('btn btn-info disabled'); \n";
// toggle button
$str.=" \$('#updateRecordButton2').addClass('btn dropdown-toggle btn-info disabled'); \n";
$str.=" \$('#updateRecordButton1').attr('onClick', ''); \n";
$str.=" \$('#updateRecordButton2').attr('onClick', ''); \n";
$str.=" \$('#updateRecordButton3').attr('onClick', ''); \n";
$str.=" \$('#updateRecordButton4').attr('onClick', ''); \n";
$str.=" \$('#updateRecordButton5').attr('onClick', ''); \n";
$str.="<?php } ?> \n";

$str.="<?php if(\$leafAccess['leafAccessDeleteValue']==1) { ?> \n";
$str.=" \$('#deleteRecordButton').removeClass();\n";
$str.=" \$('#deleteRecordButton').addClass('btn btn-danger'); \n";
$str.=" \$('#deleteRecordButton').attr('onClick', \"deleteRecord('<?php echo \$" . $data[0]['tableName'] . "->getControllerPath(); ?>','<?php echo \$securityToken; ?>','<?php echo \$leafAccess['leafAccessDeleteValue'];?>')\"); \n";

$str.="<?php }  else { ?> \n";
$str.=" \$('#deleteRecordButton').removeClass();\n";
$str.=" \$('#deleteRecordButton').addClass('btn btn-danger disabled'); \n";
$str.=" \$('#deleterecordButton').attr('onClick', ''); \n";
$str.="            <?php } ?>  \n";
$str.="            <?php } ?>  \n";
$str.="         }); \n";
$str.="    </script> \n";
$str.="<?php } ?> \n";
$str.="<script language='javascript' type='text/javascript' src='./package/" . $data[0]['package'] . "/" . $data[0]['module'] . "/javascript/" . $data[0]['tableName'] . ".js'></script> \n";

// input type hidden
?>  

