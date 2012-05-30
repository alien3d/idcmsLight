<?php


$strId = $data[0]['tableName'] . "Id";

$str.="<?php require_once('/../controller/" . $data[0]['tableName'] . "Controller.php'); \n";
$str.="require_once ('../../../../library/class/classNavigation.php');  \n";
$str.="require_once ('../../../../library/class/classShared.php');  \n";

$str.="\$translator = new \Core\shared\SharedClass();  \n";
$str.="\$translator->setCurrentDatabase('".$data[0]['database']."'); \n";
$str.="\$translator->setCurrentTable('".$data[0]['tableName']."');  \n";
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
$str.="        if (\$_POST['method'] == 'read') {  \n";
$str.="            if (isset(\$_POST ['query'])) {  \n";
$str.="                \$" . $data[0]['tableName'] . "->setFieldQuery(\$_POST ['query']);  \n";
$str.="            }  \n";
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
$str.="    <div id='infoPanel'></div>  \n";
$str.="    <div  class='modal hide fade' id='filterGridAdvance'>  \n";
$str.="        <div class='modal-header'>  \n";
$str.="            <a class='close' data-dismiss='modal1'>�</a>  \n";
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
                                <label class='control-label'><?php if(isset(\$" . $data[$i]['columnName'] . ")) {  echo \$leafTranslation['" . $data[$i]['columnName'] . "Label']; } ?></label>
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
                                <label class='control-label'><?php if(isset(\$" . $data[$i]['columnName'] . ")) {  echo \$leafTranslation['" . $data[$i]['columnName'] . "Label']; } ?></label>
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
                    } else  if($data[$i]['Key'] == ''){
                        $str.="<div class='control-group' id='" . $data[$i]['columnName'] . "Div' >\n
                                <label class='control-label'><?php if(isset(\$" . $data[$i]['columnName'] . ")) {  echo \$leafTranslation['" . $data[$i]['columnName'] . "Label']; } ?></label>\n
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
                                <label class='control-label'><?php if(isset(\$" . $data[$i]['columnName'] . ")) {  echo \$leafTranslation['" . $data[$i]['columnName'] . "Label']; } ?></label>
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
$str.="            <a class='close' data-dismiss='modal1'>�</a> \n";
$str.="            <h3>Are you sure want to delete this record ?</h3> \n";
$str.="        </div> \n";
$str.="        <div class='modal-body'> \n";
$str.="            <input type='hidden' name='" . $data[0]['tableName'] . "IdPreview' id='" . $data[0]['tableName'] . "IdPreview'> \n";
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
$str.="            <a href=javascript:void(0) class='btn btn-danger' onClick=deleteGridRecord()>Delete</a> \n";
$str.="            <a href=javascript:void(0) onclick=showMeModal('deletePreview',0) class='btn'>Close</a> \n";
$str.="        </div> \n";
$str.="   </div> \n";
$str.="<div align='right'> \n";
$str.="        <input type='text' class='input-large search-query' name='query' id='query'> \n";
$str.="        <a href=javascript:void(0) class=btn onClick=ajaxQuerySearchAll('<?php echo \$" . $data[0]['tableName'] . "->getViewPath(); ?>','<?php echo \$securityToken; ?>')><i class=icon-zoom-in></i> Search </a> \n";
$str.="        <a href=javascript:void(0) class=btn onclick=showMeModal('filterGridAdvance',1)><i class=icon-zoom-in></i> Advance Search </a> \n";
$str.="        <a href=javascript:void(0) class=btn hide onclick=hideButton();showGrid('<?php echo \$" . $data[0]['tableName'] . "->getViewPath(); ?>','<?php echo \$securityToken; ?>',0,<?php echo LIMIT; ?>) name=clearSearch id=clearSearch><i class=icon-refresh></i>Clear Search </a> \n";
$str.="        <a href=javascript:void(0) class=btn onClick=showForm('<?php echo \$" . $data[0]['tableName'] . "->getViewPath(); ?>','<?php echo \$securityToken; ?>')><i class=icon-plus></i> New </a> \n";
$str.="        <a href=javascript:void(0) class=btn><i class='icon-file'></i> Report </a> \n";
$str.="    </div> \n";
$str.="    <br> \n";
$str.="<table class='table table-striped table-bordered table-condensed' name='tableData' id='tableData'> \n";
$str.="        <thead> \n";
$str.="            <tr> \n";
// only output one record only.
for ($i = 0; $i < $total; $i++) {
    if ($data[$i]['Key'] == 'PRI') {
        $str.=" <th>Action</th> \n";
    } else {
      $str.="<?php  \n";
		switch($data[$i]['columnName']) { 
				case 'isDefault':
                case 'isNew':
                case 'isDraft':
                case 'isUpdate':
                case 'isDelete':
                case 'isActive':
                case 'isApproved':
                case 'isReview':
                case 'isPost':
				case 'executeBy':
                case 'executeTime':
                    $str.="if(\$_SESSION ['isAdmin'] ==1) {\n ";
								$str.=" echo \"<th>".str_replace(array('is','execute'),array('',''),$data[$i]['columnName'])."</th>\"; \n";
					$str.="}\n  ";  
                break;
                default:
								$str.=" echo \"<th>".str_replace($data[0]['tableName'],'',$data[$i]['columnName'])."</th>\"; \n";
		} 
		$str.="?>\n";
	}
}

$str.="            </tr> \n";
$str.="        </thead> \n";
$str.="        <tbody id=tableBody> \n";
$str.=" <?php             if (\$_POST['method'] == 'read' && \$_POST['type'] == 'list' && \$_POST['detail'] == 'body') { \n";
$str.="              if (is_array(\$" . $data[0]['tableName'] . "Array)) { \n";
$str.="                \$totalRecord = 0; \n";
$str.="                \$totalRecord = count(\$" . $data[0]['tableName'] . "Array); \n";
$str.="                if (\$totalRecord > 0) { \n";
$str.="                    for (\$i = 0; \$i < \$totalRecord; \$i++) { ?> \n";
$str.="                        <tr> \n";
$strInside=null;
for ($i = 0; $i < $total; $i++) {
    if ($data[$i]['Key'] == 'PRI') {
        $str.=" <td><a class='btn-warning btn-mini' onClick=showFormUpdate('<?php echo \$" . $data[0]['tableName'] . "->getViewPath(); ?>','<?php echo \$securityToken; ?>','<?php echo intval(\$" . $data[0]['tableName'] . "Array [\$i]['" . $data[0]['tableName'] . "Id']); ?>')><i class='icon-edit icon-white'></i>Update</a>  
                    <a class='btn-danger btn-mini' onClick=showModalDelete(";
        for ($d = 0; $d < $total; $d++) {
			// encode first to prevent bugs on javascript parsing
            $strInside.="'<?php echo rawurlencode(\$" . $data[0]['tableName'] . "Array [\$i]['" . $data[$d]['columnName'] . "']); ?>',";
        }
		$str.=substr($strInside,0,-1);
        $str.=")><i class='icon-trash  icon-white'></i> Delete</a></td> \n";
    } else {
		$str.="<?php  \n";
		switch($data[$i]['columnName']) {
				case 'isDefault':
                case 'isNew':
                case 'isDraft':
                case 'isUpdate':
                case 'isDelete':
                case 'isActive':
                case 'isApproved':
                case 'isReview':
                case 'isPost':
                    $str.=" if(\$_SESSION ['isAdmin'] ==1) {\n ";
					$str.="		if(isset(\$" . $data[0]['tableName'] . "Array[\$i]['" . $data[$i]['columnName'] . "'])) {\n ";
									$str.=" echo \"<td>\".\$" . $data[0]['tableName'] . "Array[\$i]['" . $data[$i]['columnName'] . "'].\"</td>\"; \n";
								$str.=" } else { \n";
								$str.="			echo \"<td>&nbsp;</td>\"; \n";
								$str.="		}\n";
						$str.="	} \n ";
$str.="?>\n";						
                break;
                default:
							$str.="if(isset(\$" . $data[0]['tableName'] . "Array[\$i]['" . $data[$i]['columnName'] . "'])) { \n
										echo \"<td>\".\$" . $data[0]['tableName'] . "Array[\$i]['" . $data[$i]['columnName'] . "'].\"</td>\"; \n";
							$str.="} else { \n 
										echo \"<td>&nbsp;</td>\"; \n
								    } \n  ?>";
		}							

        
    }
}

$str.="                        </tr> \n";
$str.="                        <?php \n";
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
$str.="    <input type='hidden' name='" . $data[0]['tableName'] . "Id' id='" . $data[0]['tableName'] . "Id' value='<?php if (isset(\$_POST['" . $data[0]['tableName'] . "Id'])) { \$_POST['" . $data[0]['tableName'] . "Id'];    } ?>'> \n";
// start loop field
//$str.=print_r($data);
$total = 0;
$total = count($data);
for ($i = 0; $i < $total; $i++) {
    switch ($data[$i]['formType']) {
        case 'varchar':
        case 'text':
        case 'double':
            $str.="<div class='control-group' id='" . $data[$i]['columnName'] . "Form'>
                                <label class='control-label'><?php echo \$leafTranslation['" . $data[$i]['columnName'] . "Label']; ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='" . $data[$i]['columnName'] . "' id='" . $data[$i]['columnName'] . "' placeholder='Field Of " . $data[$i]['columnName'] . "' class='span3'>
                                </div>
                            </div>";
            break;
        case 'int':
            if($data[$i]['Key'] == 'PRI') { 
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
                                        <option value='<?php echo \$" . $data[$i]['columnName'] . "Array[\$i]['" . $data[$i]['columnName'] . "Id']; ?>'><?php echo \$" . $data[$i]['columnName'] . "Array[\$i]['" . $data[$i]['columnName'] . "Desc']; ?></option>                                       
                                    }\n
                                }\n                                
                            </select>\n
                            </div>\n
                          </div>\n";
                    } else  if($data[$i]['Key'] == ''){
                        $str.="<div class='control-group' id='" . $data[$i]['columnName'] . "Form' >\n
                                <label class='control-label'><?php echo \$leafTranslation['" . $data[$i]['columnName'] . "Label']; ?></label>\n
                                <div class='controls  input-prepend'>\n
                                    <input type='text' name='" . $data[$i]['columnName'] . "' id='" . $data[$i]['columnName'] . "' placeholder='Numeric Only' class='span3'>\n
                                    <span name='numericHelpMe' id='" . $data[$i]['columnName'] . "HelpMe' class='help-inline'></span>\n
                                </div>\n
                            </div>\n";
                    }
            break;
        case 'tiny':
            // by default preview tiny is not available
            break;

        case 'date':
        case 'datetime':
            $str.="<div class='control-group' id='" . $data[$i]['columnName'] . "Form'>
                                <label class='control-label'><?php echo \$leafTranslation['" . $data[$i]['columnName'] . "Label']; ?></label>
                                <div class='controls input-prepend'>
                                    <span class='add-on'>
                                        <i class='icon-calendar'></i>
                                    </span>    
                                    <input type='date' name='" . $data[$i]['columnName'] . "' id='" . $data[$i]['columnName'] . "' placeholder='Date Validation' class='span3'>
                                    <span name='" . $data[$i]['columnName'] . "HelpMe' id='" . $data[$i]['columnName'] . "HelpMe' class='help-inline'></span>
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
$str.="            <a  name='auditRecordButton' id='auditRecordButton'  href=javascript:void(0) 
    class='<?php if(\$leafAccess['isDraft']==0) { ?>btn btn-warning disabled<?php } else { ?>btn btn-warning<?php } ?>' 
    onClick=<?php if(\$leafAccess['isDraft']==1) { ?>) { ?>auditRecord('<?php echo \$" . $data[0]['tableName'] . "->getControllerPath(); ?>','<?php echo \$securityToken; ?>',)<?php } ?>><i class='icon-warning-sign icon-white'></i><?php echo \$buttonTranslation['isAuditLabel']; ?></a> \n";
$str.="        </div>";
$str.="        <div class='btn-group'>";
$str.="            <a  name=newRecordButton1 id=newRecordButton1 href=javascript:void(0) class='<?php if(\$leafAccess['isNew']==0) { ?>btn btn-success disabled<?php } else { ?>btn btn-success  <?php } ?>'><i class=icon-plus icon-white></i><?php echo \$buttonTranslation['isNewLabel'][0]; ?></a> \n";
$str.="            <a  name=newRecordButton2 id=newRecordButton2 href=javascript:void(0) data-toggle='dropdown' class='<?php if(\$leafAccess['isNew']==0) { ?>btn dropdown-toggle btn-success disabled<?php } else { ?>btn dropdown-toggle btn-success<?php } ?>'><span class=caret></span></a> \n";
$str.="            <ul class='dropdown-menu'> \n";
$str.="                <li><a name=newRecordButton3 id=newRecordButton3 href=javascript:void(0) onClick=<?php if(\$leafAccess['isNew']==1) { ?>newRecord('<?php echo \$" . $data[0]['tableName'] . "->getControllerPath(); ?>','<?php echo \$securityToken; ?>',1) <?php } ?> class='<?php if(\$leafAccess['isNew']==0) { ?>disabled<?php } ?>'><i class=icon-plus></i><?php echo \$buttonTranslation['isNewLabel'][1]; ?></a></li> \n";
$str.="                <li><a name=newRecordButton4 id=newRecordButton4 href=javascript:void(0) onClick=<?php if(\$leafAccess['isNew']==1) { ?>newRecord('<?php echo \$" . $data[0]['tableName'] . "->getControllerPath(); ?>','<?php echo \$securityToken; ?>',2) <?php } ?> class='<?php if(\$leafAccess['isNew']==0) { ?>disabled<?php } ?>'><i class=icon-edit></i><?php echo \$buttonTranslation['isNewLabel'][2]; ?></a></li> \n";
$str.="                <li><a name=newRecordButton5 id=newRecordButton5 href=javascript:void(0) onClick=<?php if(\$leafAccess['isNew']==1) { ?>newRecord('<?php echo \$" . $data[0]['tableName'] . "->getControllerPath(); ?>','<?php echo \$securityToken; ?>',3) <?php } ?> class='<?php if(\$leafAccess['isNew']==0) { ?>disabled<?php } ?>'><i class=icon-print></i><?php echo \$buttonTranslation['isNewLabel'][3]; ?></a></li> \n";
$str.="                <li><a name=newRecordButton6 id=newRecordButton6 href=javascript:void(0) onClick=<?php if(\$leafAccess['isNew']==1) { ?>newRecord('<?php echo \$" . $data[0]['tableName'] . "->getControllerPath(); ?>','<?php echo \$securityToken; ?>',4) <?php } ?> class='<?php if(\$leafAccess['isNew']==0) { ?>disabled<?php } ?>'><i class=icon-print></i><?php echo \$buttonTranslation['isNewLabel'][4]; ?></a></li> \n";
$str.="                <li><a name=newRecordButton7 id=newRecordButton7 href=javascript:void(0) onClick=<?php if(\$leafAccess['isNew']==1) { ?>newRecord('<?php echo \$" . $data[0]['tableName'] . "->getControllerPath(); ?>','<?php echo \$securityToken; ?>',5) <?php } ?> class='<?php if(\$leafAccess['isNew']==0) { ?>disabled<?php } ?>'><i class=icon-list></i><?php echo \$buttonTranslation['isNewLabel'][5]; ?></a></li> \n";
$str.="            </ul> \n";
$str.="        </div> \n";
$str.="        <div class='btn-group'> \n";
$str.="            <a  name=updateRecordButton1 id=updateRecordButton href=javascript:void(0) class='<?php if(\$leafAccess['isUpdate']==0) { ?>btn btn-info 	disabled<?php } else { ?>btn btn-info <?php } ?>'><i class=icon-edit icon-white></i><?php echo \$buttonTranslation['isUpdateLabel'][0]; ?></a> \n";
$str.="            <a  name=updateRecordButton2 id=updateRecordButton href=javascript:void(0) data-toggle='dropdown' class='<?php if(\$leafAccess['isUpdate']==0) { ?>btn dropdown-toggle btn-info disabled<?php } else { ?>btn dropdown-toggle btn-info <?php } ?>'><span class=caret></span></a> \n";
$str.="            <ul class='dropdown-menu'> \n";
$str.="                <li><a name=updateRecordButton3 id=updateRecordButton href=javascript:void(0) onClick=<?php if(\$leafAccess['isUpdate']==1) { ?>updateRecord('<?php echo \$" . $data[0]['tableName'] . "->getControllerPath(); ?>','<?php echo \$securityToken; ?>',1)<?php } ?>' class=<?php if(\$leafAccess['isUpdate']==0) { ?>disabled <?php } ?>><i class=icon-plus></i><?php echo \$buttonTranslation['isUpdateLabel'][1]; ?></a></li> \n";
$str.="                <li><a name=updateRecordButton4 id=updateRecordButton href=javascript:void(0) onClick=<?php if(\$leafAccess['isUpdate']==1) { ?>updateRecord('<?php echo \$" . $data[0]['tableName'] . "->getControllerPath(); ?>','<?php echo \$securityToken; ?>',2)<?php } ?>' class=<?php if(\$leafAccess['isUpdate']==0) { ?>disabled <?php } ?>><i class=icon-print></i><?php echo \$buttonTranslation['isUpdateLabel'][2]; ?></a></li> \n";
$str.="                <li><a name=updateRecordButton5 id=updateRecordButton href=javascript:void(0) onClick=<?php if(\$leafAccess['isUpdate']==1) { ?>updateRecord('<?php echo \$" . $data[0]['tableName'] . "->getControllerPath(); ?>','<?php echo \$securityToken; ?>',3)<?php } ?>' class=<?php if(\$leafAccess['isUpdate']==0) { ?>disabled <?php } ?>><i class=icon-list-alt></i><?php echo \$buttonTranslation['isUpdateLabel'][3]; ?></a></li> \n";
$str.="            </ul> \n";
$str.="        </div> \n";
$str.="        <div class='btn-group'> \n";
$str.="            <a name=deleteRecordButton id=deleteRecordButton href=javascript:void(0)  onClick=<?php if(\$leafAccess['isDelete']==1) { ?>deleteRecord('<?php echo \$" . $data[0]['tableName'] . "->getControllerPath(); ?>','<?php echo \$securityToken; ?>',)<?php } ?> class=<?php if(\$leafAccess['isDelete']==0) { ?>btn btn-danger disabled<?php } else { ?>btn btn-danger<?php } ?>><i class=icon-trash icon-white></i><?php echo \$buttonTranslation['isDeleteLabel']; ?></a> \n";
$str.="        </div> \n";
$str.="        <div class='btn-group'>";
$str.="            <a name=resetRecordButton id=resetRecordButton href=javascript:void(0) class='btn btn-info' onClick=resetRecord()><i class=icon-refresh icon-white></i><?php echo \$buttonTranslation['isResetLabel']; ?></a> \n";
$str.="        </div> \n";
$str.="        <div class='btn-group'>";
$str.="            <a name=postRecordButton id=postRecordButton href=javascript:void(0) class='<?php if(\$leafAccess['isPost']==0) { ?>btn btn-warning  disabled<?php } else { ?>btn btn-warning<?php } ?>' onClick=<?php if(\$leafAccess['isPost']==1) { ?>postRecord('<?php echo \$" . $data[0]['tableName'] . "->getControllerPath(); ?>','<?php echo \$securityToken; ?>',)<?php } ?>><i class=icon-cog icon-white></i><?php echo \$buttonTranslation['isPostLabel']; ?></a> \n";
$str.="        </div> \n";
$str.="        <div class='btn-group'>";
$str.="            <a name=listRecordButton id=listRecordButton href=javascript:void(0) class='btn btn-info' onClick=showGrid('<?php \$" . $data[0]['tableName'] . "->getViewPath(); ?>','<?php echo \$securityToken; ?>',0,<?php echo LIMIT; ?>)><i class=icon-list icon-white></i>Listing</a> \n";
$str.="        </div> \n";
$str.="        <div class='btn-group'> \n";
$str.="            <a name=firstRecordButton id=firstRecordButton href=javascript:void(0) class='btn btn-info' onClick=firstRecord('<?php echo \$" . $data[0]['tableName'] . "->getControllerPath(); ?>','<?php echo \$securityToken; ?>')><i class=icon-fast-backward icon-white></i><?php echo \$defaultTranslation['firstButtonLabel']; ?></a> \n";
$str.="        </div> \n";
$str.="        <div class='btn-group'> \n";
$str.="            <a name=previousRecordButton id=previousRecordButton href=javascript:void(0) class='btn btn-info disabled' onClick=previousRecord('<?php echo \$" . $data[0]['tableName'] . "->getControllerPath(); ?>','<?php echo \$securityToken; ?>')><i class=icon-backward icon-white></i><?php echo \$defaultTranslation['previousButtonLabel']; ?></a> \n";
$str.="        </div> \n";
$str.="        <div class='btn-group'> \n";
$str.="            <a name=nextRecordButton id=nextRecordButton href=javascript:void(0) class='btn btn-info disabled' onClick=nextRecord('<?php echo \$" . $data[0]['tableName'] . "->getControllerPath(); ?>','<?php echo \$securityToken; ?>')><i class=icon-forward icon-white></i><?php echo \$defaultTranslation['nextButtonLabel']; ?></a> \n";
$str.="        </div> \n";
$str.="        <div class='btn-group'> \n";
$str.="            <a name=lastRecordButton id=lastRecordButton href=javascript:void(0) class='btn btn-info' onClick=lastRecord('<?php echo \$" . $data[0]['tableName'] . "->getControllerPath(); ?>','<?php echo \$securityToken; ?>')><i class=icon-fast-forward icon-white></i><?php echo \$defaultTranslation['endButtonLabel']; ?></a> \n";
$str.="       </div> \n";
$str.="    </div> \n";
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
            $str.="validateMeAlphaNumeric('<?php if(isset(\$data[$i]['columnName'])) { echo \$data[$i]['columnName']; } ?>') \n";
            break;
        case 'double':
            $str.="validateMeAlphaCurrency('<?php if(isset(\$data[$i]['columnName'])) { echo \$data[$i]['columnName']; } ?>') \n";
            break;
        case 'int':
            $str.="validateMeNumeric('<?php if(isset(\$data[$i]['columnName'])) { echo \$data[$i]['columnName']; } ?>') \n";
            break;
        case 'date':
        case 'datetime':
            $str.=" \$('#<?php if(isset(\$data[$i]['columnName'])) { echo \$data[$i]['columnName']; } ?>').dateinput({ \n";
            $str.="    format :'dd mmm yyyy'\n";
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
$str.="            <?php } else { ?> \n";
$str.="            <?php } ?>  \n";
$str.="         }); \n";
$str.="    </script> \n";
$str.="<?php } ?> \n";
$str.="<script language='javascript' type='text/javascript' src='./package/".$data[0]['package']."/".$data[0]['module']."/javascript/" . $data[0]['tableName'] . ".js'></script> \n";
?>  
