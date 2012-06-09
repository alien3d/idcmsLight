  

<?php require_once('/../controller/raceController.php'); 
$dateStartRange = null; 
$dateEndRange = null;
if(isset($_POST['dateRangeStart'])){
    $dateRangeStart=$_POST['dateRangeStart']; 
} else { 
    $dateRangeStart=date('d-m-Y'); 
} 
if(isset($_POST['dateRangeEnd'])){ 
    $dateRangeEnd = $_POST['dateRangeEnd'];
} 
require_once ('../../../../library/class/classNavigation.php');  
require_once ('../../../../library/class/classShared.php');  
$translator = new \Core\shared\SharedClass();  
$translator->setCurrentDatabase('icommon'); 
$translator->setCurrentTable('race');  
$translator->execute();  
$systemFormat           =   $translator->getSystemFormat();  
$defaultTranslation     =   $translator->getDefaultTranslation();  
$foreignKeyTranslation  =   $translator->getForeignkeyTranslation();  
$leafTranslation        =   $translator->getLeafTranslation();  
$buttonTranslation      =   $translator->getButtonTranslation();  
$isAdmin                =   $translator->getAdminAccess(); 
$leafAccess             =   $translator->getLeafAccess(); 
   
$salt="chak"; 
$securityToken= md5("You have been cheated").$salt;
 $arrayInfo = $translator->getFileInfo('race.php'); 
 $applicationId=$arrayInfo['applicationId']; 
 $moduleId=$arrayInfo['moduleId']; 
if (isset($_POST)) {  
    if (isset($_POST['method'])) {  
        $race = new \Core\System\Common\Race\Controller\RaceClass();  
define("LIMIT",14);
        if (isset($_POST['offset'])) {  
            $offset = $_POST['offset'];  
        } else {            $offset = 0;  
        }
        if (isset($_POST['limit'])) {  
            $limit = $_POST['limit'];  
        } else {            $limit = LIMIT;  
        }
 if ($_POST['method'] == 'read') {  
     if (isset($_POST ['query'])) { 
         $race->setFieldQuery($_POST ['query']); 
     } 
     if (isset($_POST ['filter'])) { 
         $race->setGridQuery($_POST ['filter']); 
     }                 
     if (isset($_POST ['character'])) { 
		$race->setCharacterQuery($_POST['character']); 
     } 
     if (isset($_POST ['dateRangeStart'])) { 
		$race->setDateRangeStartQuery($_POST['dateRangeStart']); 
		//explode the data to get day,month,year 
		$start=explode("-",$_POST ['dateRangeStart']); 
		$race->setStartDay($start[2]); 
		$race->setStartMonth($start[1]); 
		$race->setStartYear($start[0]); 
     } 
     if (isset($_POST ['dateRangeEnd']) && (strlen($_POST['dateRangeEnd'])> 0) ) { 
		$race->setDateRangeEndQuery($_POST['dateRangeEnd']); 
		//explode the data to get day,month,year 
		$start=explode("-",$_POST ['dateRangeEnd']); 
		$race->setEndDay($start[2]); 
		$race->setEndMonth($start[1]); 
		$race->setEndYear($start[0]); 
     } 
     if (isset($_POST ['dateRangeType'])) { 
		$race->setDateRangeTypeQuery($_POST['dateRangeType']); 
     } 
     if (isset($_POST ['dateRangeExtraType'])) { 
		$race->setDateRangeExtraTypeQuery($_POST['dateRangeExtraType']); 
     } 
            $race->setStart($offset);  
            $race->setLimit($limit); // normal system don't like paging..  
            $race->execute();  
            $race->setPageOutput('html');  
            $raceArray = $race->read();  
            if (isset($raceArray [0]['firstRecord'])) {  
                $firstRecord = $raceArray [0]['firstRecord'];  
            }  
            if (isset($raceArray [0]['nextRecord'])) {  
                $nextRecord = $raceArray [0]['nextRecord'];  
            }   
            if (isset($raceArray [0]['previousRecord'])) {  
                $previousRecord = $raceArray [0]['previousRecord'];  
            }   
            if (isset($raceArray [0]['lastRecord'])) {  
                $lastRecord = $raceArray [0]['lastRecord'];  
                $endRecord = $raceArray [0]['lastRecord'];  
           }   
            $navigation = new \Core\Paging\HtmlPaging();  
            $navigation->setViewPath($race->getViewPath());  
            $navigation->setOffset($offset);  
            $navigation->setLimit($limit);  
            $navigation->setSecurityToken($securityToken);  
            if (isset($raceArray [0]['total'])) {  
                $total = $raceArray [0]['total'];  
            } else {  
                $total = 0;  
            }  
            $navigation->setTotalRecord($total);  
        }  
    }  
 }  
 if ($_POST['method'] == 'read' && $_POST['type'] == 'list') { ?>  
   <div  id='leftViewportDetail' class='well span2'> 
                <div id='btnList'>
                <!-- button type only be used on non critical only .. ie9 bugs -->
                <button type='button' name='menuBack' class='btn btn-inverse btn-small' onClick=loadSidebar(<?php echo $applicationId; ?>,'<?php echo $moduleId; ?>')><i class='icon-arrow-left'></i> Menu </button> <button type='button' value='New Record' name='newRecordButton' id='newRecordButton' class='btn btn-info btn-small' onClick=showForm('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>')><i class='icon-plus'></i> New Record </button> 
                </div>
                <hr>
                <h3>Search</h3>
                <input type='text' name='queryWidget' id='queryWidget' class='span2' value='<?php if(isset($_POST['query'])) {  echo $_POST['query']; } ?>'>
<br>                    <input type='button' name='searchString' id='searchString' value='Search' class='btn btn-info' onClick=ajaxQuerySearchAll('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>')>
                    <input type='button' name='clearSearchString' id='clearSearchString' value='Clear' class='btn' onClick=showGrid('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>',0,<?php echo LIMIT; ?>)>
                <hr>
                <h4>Date</h4>
                 <table cellpadding=1 cellspacing=1>
                     <tr>
                         <td colspan='3'><a href=javascript:void(0) onClick=ajaxQuerySearchAllDate('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','1979-01-01','2012-06-09')>Any Time</a></td>
                     </tr>
                     <tr>
                     <tr>
                         <td align='right'><a href=javascript:void(0) rel='tooltip' title='Previous Day' onClick=ajaxQuerySearchAllDate('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','<?php echo $dateRangeStart; ?>','','day','previous')>&laquo;</a></td>
                         <td align='center'><a href=javascript:void(0) onClick=ajaxQuerySearchAllDate('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','<?php echo $dateRangeStart; ?>','','day','')>Today</a></td>
                         <td align='left'><a href=javascript:void(0) rel='tooltip' title='Next Day' onClick=ajaxQuerySearchAllDate('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','<?php echo $dateRangeStart; ?>','','day','next')>&raquo;</a></td>
                     </tr>
                     <tr>
                         <td align='right'><a href=javascript:void(0) rel='tooltip' title='Previous Week'  onClick=ajaxQuerySearchAllDate('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','<?php echo $dateRangeStart; ?>','','week','previous')>&laquo;</a> </td>
                         <td align='center'><a href=javascript:void(0) onClick=ajaxQuerySearchAllDate('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','<?php echo $dateRangeStart; ?>','','week','')>Week</a> </td>
                         <td align='left'><a href=javascript:void(0) rel='tooltip' title='Next Week' onClick=ajaxQuerySearchAllDate('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','<?php echo $dateRangeStart; ?>','','week','next')>&raquo;</a></td>
                     </tr>
                     <tr>
                         <td align='right'><a href=javascript:void(0) rel='tooltip' title='Previous Month'  onClick=ajaxQuerySearchAllDate('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','<?php echo $dateRangeStart; ?>','','month','previous')>&laquo;</td> 
                         <td align='center'><a href=javascript:void(0) onClick=ajaxQuerySearchAllDate('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','<?php echo $dateRangeStart; ?>','','month','')>Month</a> </td>
                         <td align='left'><a href=javascript:void(0) rel='tooltip' title='Next Month' onClick=ajaxQuerySearchAllDate('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','<?php echo $dateRangeStart; ?>','','month','next')>&raquo;</a></td>
                     </tr>
                     <tr>
                         <td align='right'><a href=javascript:void(0) rel='tooltip' title='Previous Year'  onClick=ajaxQuerySearchAllDate('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','<?php echo $dateRangeStart; ?>','','year','previous')>&laquo;</a></td> 
                        <td align='center'><a href=javascript:void(0) onClick=ajaxQuerySearchAllDate('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','<?php echo $dateRangeStart; ?>','','year','')>Year</a> </td>
                         <td align='left'><a href=javascript:void(0) rel='tooltip' title='Next Year' onClick=ajaxQuerySearchAllDate('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','<?php echo $dateRangeStart; ?>','','year','next')>&raquo;</a></td>
                         </tr>
</table>
                Range
                <div style='style:none'>
                    <input type='date' name='dateRangeStart' id='dateRangeStart' class='span2' value='<?php if(isset($_POST['dateRangeStart'])) { echo $_POST['dateRangeStart']; } ?>'><br>
                    <input type='date' name='dateRangeEnd' id='dateRangeEnd' class='span2' value='<?php if(isset($_POST['dateRangeEnd'])) { echo $_POST['dateRangeEnd']; } ?>'><br>
                    <input type='button' name='searchDate' id='searchDate' value='Search' class='btn btn-info' onClick=ajaxQuerySearchAllDateRange('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>')>
                    <input type='button' name='clearSearchDate' id='clearSearchDate' value='Clear' class='btn' onClick=showGrid('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>',0,<?php echo LIMIT; ?>)>
                </div>
                <hr>
             <h4>Filter Date Information</h4>
             <table>
<tr>
    <td>Current Date</td>
    <td>:</td>
    <td><?php echo date('d-m-Y'); ?></td>
</tr>
<tr>
    <td>Filter Date</td>
     <td>:</td>
     <td><?php if(isset($_POST['dateRangeStart'])) { echo $_POST['dateRangeStart']; } ?> <?php if(isset($_POST['dateRangeEnd']) && (strlen($_POST['dateRangeEnd'])> 0)) { echo 'till  '.$_POST['dateRangeEnd']; } ?> </td>
</tr>
<tr>
    <td>Filter Method </td>
     <td>:</td>
     <td><?php if(isset($_POST['dateRangeType'])) { echo $_POST['dateRangeType']; } ?></td>
</tr>
<tr>
    <td>Filter Type </td>
     <td>:</td>
     <td><?php if(isset($_POST['dateRangeExtraType'])) { echo $_POST['dateRangeExtraType']; } ?></td>
</tr>
</table>            </div>
        <div name='rightViewport' id='rightViewport' class='span13'>
    <div id='infoPanel'></div>  
    <div  class='modal hide fade' id='filterGridAdvance'>  
        <div class='modal-header'>  
            <a class='close' data-dismiss='modal1'>x</a>  
            <h3>Advance Search Record</h3>  
        </div>  
        <div class='modal-body'>  
<div class='control-group' id='raceSequenceDiv' >

                                <label class='control-label'><?php if(isset( $leafTranslation['raceSequenceLabel'])) {  echo $leafTranslation['raceSequenceLabel']; } ?></label>

                                <div class='controls  input-prepend'>

                                    <input type='text' name='raceSequence' id='raceSequence' placeholder='Numeric Only' class='span3'>

                                    <span name='numericHelpMe' id='raceSequenceHelpMe' class='help-inline'></span>

                                </div>

                            </div>
<div class='control-group' id='raceCodeDiv'>
                                <label class='control-label'><?php if(isset( $leafTranslation['raceCodeLabel'])) {  echo $leafTranslation['raceCodeLabel']; } ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='raceCode' id='raceCode' placeholder='Field Of raceCode' class='span3'>
                                </div>
                            </div><div class='control-group' id='raceDescDiv'>
                                <label class='control-label'><?php if(isset( $leafTranslation['raceDescLabel'])) {  echo $leafTranslation['raceDescLabel']; } ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='raceDesc' id='raceDesc' placeholder='Field Of raceDesc' class='span3'>
                                </div>
                            </div>        </div> 
        <div class='modal-footer'> 
            <a href=javascript:void(0) class='btn btn-info'>Search</a> 
            <a href=javascript:void(0) onclick=showMeModal('filterGridAdvance',0) class='btn'>Close</a> 
        </div> 
    </div> 
    <div  class='modal hide fade' id='deletePreview'> 
        <div class='modal-header'> 
            <a class='close' data-dismiss='modal1'>x</a> 
            <h3>Are you sure want to delete this record ?</h3> 
        </div> 
        <div class='modal-body'> 
            <input type='hidden' name='raceIdPreview' id='raceIdPreview'> 
<div class='control-group' id='raceSequenceDiv'>
                                <label class='control-label'><?php echo $leafTranslation['raceSequenceLabel'];  ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='raceSequencePreview' id='raceSequencePreview' placeholder='Field Of raceSequence' class='span3'>
                                </div>
                            </div><div class='control-group' id='raceCodeDiv'>
                                <label class='control-label'><?php echo $leafTranslation['raceCodeLabel'];  ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='raceCodePreview' id='raceCodePreview' placeholder='Field Of raceCode' class='span3'>
                                </div>
                            </div><div class='control-group' id='raceDescDiv'>
                                <label class='control-label'><?php echo $leafTranslation['raceDescLabel'];  ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='raceDescPreview' id='raceDescPreview' placeholder='Field Of raceDesc' class='span3'>
                                </div>
                            </div>        </div> 
        <div class='modal-footer'> 
            <a href=javascript:void(0) class='btn btn-danger' onClick=deleteGridRecord('<?php echo $race->getControllerPath(); ?>','<?php echo $securityToken; ?>','<?php echo $race->getViewPath(); ?>')>Delete</a> 
            <a href=javascript:void(0) onclick=showMeModal('deletePreview',0) class='btn'>Close</a> 
        </div> 
   </div> 
<div align='left'  class='btn-group'> 
        <a title='A' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','A')>A</a> 
        <a title='B' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','B')>B</a> 
        <a title='C' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','C')>C</a> 
        <a title='D' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','D')>D</a> 
        <a title='E' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','E')>E</a> 
        <a title='F' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','F')>F</a> 
        <a title='G' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','G')>G</a> 
        <a title='H' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','H')>H</a> 
        <a title='I' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','I')>I</a> 
        <a title='J' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','J')>J</a> 
        <a title='K' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','K')>K</a> 
        <a title='L' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','L')>L</a> 
        <a title='M' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','M')>M</a> 
        <a title='N' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','N')>N</a> 
        <a title='O' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','O')>O</a> 
        <a title='P' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','P')>P</a> 
        <a title='Q' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','Q')>Q</a> 
        <a title='R' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','R')>R</a> 
        <a title='S' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','S')>S</a> 
        <a title='T' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','T')>T</a> 
        <a title='U' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','U')>U</a> 
        <a title='V' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','V')>V</a> 
        <a title='W' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','W')>W</a> 
        <a title='X' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','X')>X</a> 
        <a title='Y' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','Y')>Y</a> 
        <a title='Z' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>','Z')>Z</a> 
</div><br><br>    <div id='infoPanel'><?php if(isset($_POST['message'])) {  ?>           
            <div class='alert alert-error'><a class='close' data-dismiss='alert'>x</a><?php echo $_POST['message']; ?></div>
<?php } ?></div> 
<table class='table table-striped table-bordered table-condensed' name='tableData' id='tableData'> 
        <thead> 
            <tr> 
                 <th>#</th><?php  
 echo "<th>Action</th>"; 
 echo "<th>Desc</th>"; 
if($_SESSION ['isAdmin'] ==1) {
  echo "<th>By</th>"; 
}
  if($_SESSION ['isAdmin'] ==1) {
  echo "<th>Time</th>"; 
}
  ?>
       <th><input  class='check_all' type='checkbox' name='check_all' id='check_all' alt='Check Record' onclick=toggleChecked(this.checked)></th>
            </tr> 
        </thead> 
        <tbody id=tableBody> 
 <?php             if ($_POST['method'] == 'read' && $_POST['type'] == 'list' && $_POST['detail'] == 'body') { 
              if (is_array($raceArray)) { 
                $totalRecord = 0; 
                $totalRecord = count($raceArray); 
                if ($totalRecord > 0) { 
                      $counter=0; 
                    for ($i = 0; $i < $totalRecord; $i++) { 
                     $counter++;
                     echo "<tr>"; 
                     echo "<td>".($counter+$offset)."</td>"; 
 echo  "<td><div class='btn-group'>
		<a rel='tooltip' class='tooltip-top btn btn-warning' data-original-title='Edit' onClick=showFormUpdate('".$race->getViewPath()."','".$securityToken."','".intval($raceArray [$i]['raceId'])."')><i class='icon-edit icon-white'></i></a>  
                    <a rel='tooltip' class='tooltip-top btn btn-danger' data-original-title='Delete' onClick=showModalDelete('".rawurlencode($raceArray [$i]['raceId'])."','".rawurlencode($raceArray [$i]['raceSequence'])."','".rawurlencode($raceArray [$i]['raceCode'])."','".rawurlencode($raceArray [$i]['raceDesc'])."','".rawurlencode($raceArray [$i]['isDefault'])."','".rawurlencode($raceArray [$i]['isNew'])."','".rawurlencode($raceArray [$i]['isDraft'])."','".rawurlencode($raceArray [$i]['isUpdate'])."','".rawurlencode($raceArray [$i]['isDelete'])."','".rawurlencode($raceArray [$i]['isActive'])."','".rawurlencode($raceArray [$i]['isApproved'])."','".rawurlencode($raceArray [$i]['isReview'])."','".rawurlencode($raceArray [$i]['isPost'])."','".rawurlencode($raceArray [$i]['executeBy'])."','".rawurlencode($raceArray [$i]['executeTime'])."')><i class='icon-trash  icon-white'></i></a></td>"; 
if(isset($raceArray[$i]['raceDesc'])) { 
 $value = $raceArray[$i]['raceDesc'];
 } 
if(isset($value) && (strlen($value) > 0 )) {
	echo "<td align=left>".$value."</td>"; 
} else { 
 	echo "<td  align=left>&nbsp;</td>"; 
 }
if(isset($raceArray[$i]['executeBy'])) { 
	echo "<td>".$raceArray[$i]['staffName']."</td>"; 
} else {
	echo "<td>&nbsp;</td>";
	}
  if(isset($raceArray[$i]['executeTime'])) { 
 	$valueArray = $raceArray[$i]['executeTime'];  
 	$valueArrayDate 	=	explode(' ',$valueArray);  
 	$valueArrayFirst 	= 	$valueArrayDate[0];         
 	$valueArraySecond	= 	$valueArrayDate[1];          
 	$valueDataFirst 	= 	explode('-',$valueArrayFirst);  
 	$year 				=	$valueDataFirst[0];               
 	$month 			= 	$valueDataFirst[1];            
 	$day	 			= 	$valueDataFirst[2];                
		$valueDataSecond 	= 	explode(':',$valueArraySecond);  
 	$hour 				= 	$valueDataSecond[0];  
 	$minute 			= 	$valueDataSecond[1];  
 	$second 			= 	$valueDataSecond[2];  
	$value = date($systemFormat['systemSettingDateFormat']." ".$systemFormat['systemSettingTimeFormat'],mktime($hour,$minute,$second,$month,$day,$year)); 
	echo "<td>".$value."</td>"; 
} else { 
	echo "<td>&nbsp;</td>"; 
} 
  	if($raceArray[$i]['isDelete']) {
    $checked='checked';
} else {
    $checked=null;
}
                         echo "<td>
    <input style='display:none;' type='checkbox' name='raceId[]' id='raceId' value='".$raceArray[$i]['raceId']."'>
    <input ".$checked." type='checkbox' name='isDelete[]' id='isDelete' value='".$raceArray[$i]['isDelete']."'>
    
</td>";
                    echo "</tr>"; 
                  }  } 
                } else { ?> 
                    <tr> 
                        <td colspan='6'><?php $race->exceptionMessage('No Record'); ?></td> 
                    </tr> 
                    <?php 
                } 
            } else { ?> 
                <tr> 
                    <td colspan='6'><?php $race->exceptionMessage('Data Record Problem'); ?></td> 
                </tr> 
                <?php 
            } 
        } 
        if ($_POST['method'] == 'read' && $_POST['type'] == 'list') { ?> 
        </tbody> 
    </table> 
   <?php 
} 
if ($_POST['method'] == 'read' && $_POST['type'] == 'list' && $_POST['detail'] == 'body') { ?> 
<div class='pull-right'> 
<button class='delete btn btn-warning' type='button' onClick=deleteGridRecordCheckbox('<?php echo $race->getControllerPath(); ?>','<?php echo $securityToken; ?>','<?php echo $race->getViewPath(); ?>')> 
<i class='icon-white icon-trash'></i> 
Delete Checked Box 
</button> 
</div> 
    <div class='pagination' id='pagingHtml' name='pagingHtml'><?php $navigation->pagenationv4($offset); ?></div> 
     <script language='javascript' type='text/javascript'> 
         $(document).ready(function(){ 
            // load the system cell if session  and token exist;  
            <?php if(isset($_POST['query'])) { ?> 
                    $('#clearSearch').removeClass(); 
                    $('#clearSearch').addClass('btn'); 
            <?php } ?>  
 $('#dateRangeStart').datepicker({  
                 format :'d-m-yyyy'  
             });  
             $('#dateRangeEnd').datepicker({  
                 format :'d-m-yyyy'  
             });   
                     $('a[rel=tooltip]').tooltip();    
         }); 
   function toggleChecked(status) {
 $('input:checkbox').each( function() {
 $(this).attr('checked',status);
 }); } 
      </script> 
</div>    <?php }  
           if ((isset($_POST['method']) == 'new' || isset($_POST['method']) == 'read') && $_POST['type'] == 'form') { ?> 
    <div id='infoPanel'></div> 
         <form class='well form-vertical'>
    <input type='hidden' name='raceId' id='raceId' 
value='<?php if (isset($_POST['raceId'])) { 
                echo $_POST['raceId'];    
            }  ?>'> 
<div class='control-group' id='raceSequenceForm' >

                                <label class='control-label'><?php echo $leafTranslation['raceSequenceLabel']; ?></label>

                                <div class='controls  input-prepend'>

                                    <input type='text' name='raceSequence' id='raceSequence' placeholder='Numeric Only' class='span3' value='<?php if(isset($raceArray) && is_array($raceArray)) { echo $raceArray[0]['raceSequence']; } ?>'>

                                    <span name='numericHelpMe' id='raceSequenceHelpMe' class='help-inline' ></span>

                                </div>

                            </div>
<div class='control-group' id='raceCodeForm'>
                                <label class='control-label'><?php echo $leafTranslation['raceCodeLabel']; ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='raceCode' id='raceCode' placeholder='Field Of raceCode' class='span3' 
                                    value='<?php if(isset($raceArray) && is_array($raceArray)) {  echo $raceArray[0]['raceCode']; } ?>' maxlength='4'>
                                </div>
                            </div><div class='control-group' id='raceDescForm'>
                                <label class='control-label'><?php echo $leafTranslation['raceDescLabel']; ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='raceDesc' id='raceDesc' placeholder='Field Of raceDesc' class='span3' 
                                    value='<?php if(isset($raceArray) && is_array($raceArray)) {  echo $raceArray[0]['raceDesc']; } ?>'>
                                </div>
                            </div><div class='control-group' id='executeByForm' >

                                <label class='control-label'><?php echo $leafTranslation['executeByLabel']; ?></label>

                                <div class='controls  input-prepend'>

                                    <input type='text' name='executeBy' id='executeBy' placeholder='String Only' class='span3' value='<?php if(isset($raceArray) && is_array($raceArray)) { echo $raceArray[0]['staffName']; } ?>' readOnly>

                                    <span name='numericHelpMe' id='executeByHelpMe' class='help-inline' ></span>

                                </div>

                            </div>
<?php 
if(isset($raceArray) && is_array($raceArray)) { 
     $valueArray = $raceArray[0]['executeTime'];  
     $valueArrayDate    =   explode(' ',$valueArray);
     $valueArrayFirst   =   $valueArrayDate[0];
     $valueArraySecond  =   $valueArrayDate[1];
     $valueDataFirst    =   explode('-',$valueArrayFirst);
     $year              =   $valueDataFirst[0];
     $month             =   $valueDataFirst[1];
     $day               =   $valueDataFirst[2];
 $valueDataSecond   =   explode(':',$valueArraySecond);
     $hour              =   $valueDataSecond[0];
     $minute            =   $valueDataSecond[1];
     $second            =   $valueDataSecond[2];
 $value = date($systemFormat['systemSettingDateFormat']." ".$systemFormat['systemSettingTimeFormat'],mktime($hour,$minute,$second,$month,$day,$year)); 
 }
 ?><div class='control-group' id='executeTimeForm'>
                                <label class='control-label'><?php echo $leafTranslation['executeTimeLabel']; ?></label>
                                <div class='controls input-prepend'>
                                    <span class='add-on'>
                                        <i class='icon-calendar'></i>
                                    </span>    
                                    <input type='date' name='executeTime' id='executeTime' placeholder='Date Validation' class='span3' value='<?php if(isset($value)) { echo $value; } ?>' readOnly>
                                    <span name='executeTimeHelpMe' id='executeTimeHelpMe' class='help-inline'></span>
                                </div>
                            </div></form>
<div class='form-actions'>
    <div class='btn-toolbar'> 
        <div class='btn-group'> 
            <a  name='auditRecordButton' id='auditRecordButton'  href=javascript:void(0) 
    class='<?php if($leafAccess['isDraft']==0) { ?>btn btn-warning disabled<?php } else { ?>btn btn-warning<?php } ?>' 
    <?php if($leafAccess['isDraft']==1) { ?>) { ?>onClick=auditRecord('<?php echo $race->getControllerPath(); ?>','<?php echo $securityToken; ?>',)<?php } ?>><i class='icon-warning-sign icon-white'></i><?php echo $buttonTranslation['isAuditLabel']; ?></a> 
        </div>        <div class='btn-group'>            <a  name='newRecordButton1' id='newRecordButton1' href=javascript:void(0) class='<?php if($leafAccess['leafAccessCreateValue']==0) { ?>btn btn-success disabled<?php } else { ?>btn btn-success  <?php } ?>'><i class=icon-plus icon-white></i><?php echo $buttonTranslation['isNewLabel'][0]; ?></a> 
            <a  name='newRecordButton2' id='newRecordButton2' href=javascript:void(0) data-toggle='dropdown' class='<?php if($leafAccess['leafAccessCreateValue']==0) { ?>btn dropdown-toggle btn-success disabled<?php } else { ?>btn dropdown-toggle btn-success<?php } ?>'><span class=caret></span></a> 
            <ul class='dropdown-menu'> 
                <li><a name='newRecordButton3' id='newRecordButton3' href=javascript:void(0) <?php if($leafAccess['leafAccessCreateValue']==1) { ?>onClick=newRecord('<?php echo $race->getControllerPath(); ?>','<?php echo $securityToken; ?>',1,'<?php echo $leafAccess['leafAccessUpdateValue'];?>','<?php echo $leafAccess['leafAccessDeleteValue'];?>') <?php } ?> class='<?php if($leafAccess['isNew']==0) { ?>disabled<?php } ?>'><i class='icon-plus'></i><?php echo $buttonTranslation['isNewLabel'][1]; ?></a></li> 
                <li><a name='newRecordButton4' id='newRecordButton4' href=javascript:void(0) <?php if($leafAccess['leafAccessCreateValue']==1) { ?>onClick=newRecord('<?php echo $race->getControllerPath(); ?>','<?php echo $securityToken; ?>',2,'<?php echo $leafAccess['leafAccessUpdateValue'];?>','<?php echo $leafAccess['leafAccessDeleteValue'];?>') <?php } ?> class='<?php if($leafAccess['isNew']==0) { ?>disabled<?php } ?>'><i class='icon-edit'></i><?php echo $buttonTranslation['isNewLabel'][2]; ?></a></li> 
                <li><a name='newRecordButton5' id='newRecordButton5' href=javascript:void(0) <?php if($leafAccess['leafAccessCreateValue']==1) { ?>onClick=newRecord('<?php echo $race->getControllerPath(); ?>','<?php echo $securityToken; ?>',3,'<?php echo $leafAccess['leafAccessUpdateValue'];?>','<?php echo $leafAccess['leafAccessDeleteValue'];?>') <?php } ?> class='<?php if($leafAccess['isNew']==0) { ?>disabled<?php } ?>'><i class='icon-print'></i><?php echo $buttonTranslation['isNewLabel'][3]; ?></a></li> 
                <li><a name='newRecordButton6' id='newRecordButton6' href=javascript:void(0) <?php if($leafAccess['leafAccessCreateValue']==1) { ?>onClick=newRecord('<?php echo $race->getControllerPath(); ?>','<?php echo $securityToken; ?>',4,'<?php echo $leafAccess['leafAccessUpdateValue'];?>','<?php echo $leafAccess['leafAccessDeleteValue'];?>') <?php } ?> class='<?php if($leafAccess['isNew']==0) { ?>disabled<?php } ?>'><i class='icon-print'></i><?php echo $buttonTranslation['isNewLabel'][4]; ?></a></li> 
                <li><a name='newRecordButton7' id='newRecordButton7' href=javascript:void(0) <?php if($leafAccess['leafAccessCreateValue']==1) { ?>onClick=newRecord('<?php echo $race->getControllerPath(); ?>','<?php echo $securityToken; ?>',5,'<?php echo $leafAccess['leafAccessUpdateValue'];?>','<?php echo $leafAccess['leafAccessDeleteValue'];?>') <?php } ?> class='<?php if($leafAccess['isNew']==0) { ?>disabled<?php } ?>'><i class='icon-list'></i><?php echo $buttonTranslation['isNewLabel'][5]; ?></a></li> 
            </ul> 
        </div> 
        <div class='btn-group'> 
            <a  name='updateRecordButton1' id='updateRecordButton1' href=javascript:void(0) class='<?php if($leafAccess['leafAccessUpdateValue']==0) { ?>btn btn-info 	disabled<?php } else { ?>btn btn-info <?php } ?>'><i class=icon-edit icon-white></i><?php echo $buttonTranslation['isUpdateLabel'][0]; ?></a> 
            <a  name='updateRecordButton2' id='updateRecordButton2' href=javascript:void(0) data-toggle='dropdown' class='<?php if($leafAccess['leafAccessUpdateValue']==0) { ?>btn dropdown-toggle btn-info disabled<?php } else { ?>btn dropdown-toggle btn-info <?php } ?>'><span class='caret'></span></a> 
            <ul class='dropdown-menu'> 
                <li><a name='updateRecordButton3' id='updateRecordButton3' href=javascript:void(0) <?php if($leafAccess['leafAccessUpdateValue']==1) { ?>onClick=updateRecord('<?php echo $race->getControllerPath(); ?>','<?php echo $securityToken; ?>',1,'<?php echo $leafAccess['leafAccessDeleteValue'];?>')<?php } ?> class='<?php if($leafAccess['isUpdate']==0) { ?>disabled <?php } ?>'><i class='icon-plus'></i><?php echo $buttonTranslation['isUpdateLabel'][1]; ?></a></li> 
                <li><a name='updateRecordButton4' id='updateRecordButton4' href=javascript:void(0) <?php if($leafAccess['leafAccessUpdateValue']==1) { ?>onClick=updateRecord('<?php echo $race->getControllerPath(); ?>','<?php echo $securityToken; ?>',2,'<?php echo $leafAccess['leafAccessDeleteValue'];?>')<?php } ?> class='<?php if($leafAccess['isUpdate']==0) { ?>disabled <?php } ?>'><i class='icon-print'></i><?php echo $buttonTranslation['isUpdateLabel'][2]; ?></a></li> 
                <li><a name='updateRecordButton5' id='updateRecordButton5' href=javascript:void(0) <?php if($leafAccess['leafAccessUpdateValue']==1) { ?>onClick=updateRecord('<?php echo $race->getControllerPath(); ?>','<?php echo $securityToken; ?>',3,'<?php echo $leafAccess['leafAccessDeleteValue'];?>')<?php } ?> class='<?php if($leafAccess['isUpdate']==0) { ?>disabled <?php } ?>'><i class='icon-list-alt'></i><?php echo $buttonTranslation['isUpdateLabel'][3]; ?></a></li> 
            </ul> 
        </div> 
        <div class='btn-group'> 
            <a name='deleteRecordButton' id='deleteRecordButton' href='javascript:void(0)'   <?php if($leafAccess['isDelete']==1) { ?>onClick=deleteRecord('<?php echo $race->getControllerPath(); ?>','<?php echo $securityToken; ?>')<?php } ?> class='<?php if($leafAccess['isDelete']==0) { ?>btn btn-danger disabled<?php } else { ?>btn btn-danger<?php } ?>'><i class='icon-trash icon-white'></i><?php echo $buttonTranslation['isDeleteLabel']; ?></a> 
        </div> 
        <div class='btn-group'>            <a name='resetRecordButton' id='resetRecordButton' href=javascript:void(0) class='btn btn-info' onClick=resetRecord('<?php echo $race->getControllerPath(); ?>','<?php echo $securityToken; ?>','<?php echo $leafAccess['leafAccessUpdateValue'];?>','<?php echo $leafAccess['leafAccessDeleteValue'];?>')><i class=icon-refresh icon-white></i><?php echo $buttonTranslation['isResetLabel']; ?></a> 
        </div> 
        <div class='btn-group'>            <a name='postRecordButton' id='postRecordButton' href=javascript:void(0) class='<?php if($leafAccess['leafAccessPostValue']==0) { ?>btn btn-warning  disabled<?php } else { ?>btn btn-warning<?php } ?>' <?php if($leafAccess['isPost']==1) { ?>onClick=postRecord('<?php echo $race->getControllerPath(); ?>','<?php echo $securityToken; ?>')<?php } ?>><i class=icon-cog icon-white></i><?php echo $buttonTranslation['isPostLabel']; ?></a> 
        </div> 
        <div class='btn-group'>            <a name='listRecordButton' id='listRecordButton' href=javascript:void(0) class='btn btn-info' onClick=showGrid('<?php echo $race->getViewPath(); ?>','<?php echo $securityToken; ?>',0,<?php echo LIMIT; ?>)><i class=icon-list icon-white></i>Listing</a> 
        </div> 
        <div class='btn-group'> 
            <a name='firstRecordButton' id='firstRecordButton' href=javascript:void(0) class='btn btn-info' onClick=firstRecord('<?php echo $race->getControllerPath(); ?>','<?php echo $securityToken; ?>','<?php echo $leafAccess['leafAccessUpdateValue'];?>','<?php echo $leafAccess['leafAccessDeleteValue'];?>')><i class=icon-fast-backward icon-white></i><?php echo $defaultTranslation['firstButtonLabel']; ?></a> 
        </div> 
        <div class='btn-group'> 
            <a name='previousRecordButton' id='previousRecordButton' href=javascript:void(0) class='btn btn-info disabled' onClick=previousRecord('<?php echo $race->getControllerPath(); ?>','<?php echo $securityToken; ?>','<?php echo $leafAccess['leafAccessUpdateValue'];?>','<?php echo $leafAccess['leafAccessDeleteValue'];?>')><i class=icon-backward icon-white></i><?php echo $defaultTranslation['previousButtonLabel']; ?></a> 
        </div> 
        <div class='btn-group'> 
            <a name='nextRecordButton' id='nextRecordButton' href=javascript:void(0) class='btn btn-info disabled' onClick=nextRecord('<?php echo $race->getControllerPath(); ?>','<?php echo $securityToken; ?>','<?php echo $leafAccess['leafAccessUpdateValue'];?>','<?php echo $leafAccess['leafAccessDeleteValue'];?>')><i class=icon-forward icon-white></i><?php echo $defaultTranslation['nextButtonLabel']; ?></a> 
        </div> 
        <div class='btn-group'> 
            <a name='lastRecordButton' id='lastRecordButton' href=javascript:void(0) class='btn btn-info' onClick=lastRecord('<?php echo $race->getControllerPath(); ?>','<?php echo $securityToken; ?>','<?php echo $leafAccess['leafAccessUpdateValue'];?>','<?php echo $leafAccess['leafAccessDeleteValue'];?>')><i class=icon-fast-forward icon-white></i><?php echo $defaultTranslation['endButtonLabel']; ?></a> 
       </div> 
    </div></div> 
    <input type='hidden' name='x' id='x'> 
    <input type='hidden' name='firstRecord' id='firstRecord' value='<?php if(isset($firstRecord)) { echo $firstRecord; } ?>'> 
    <input type='hidden' name='nextRecord' id='nextRecord' value='<?php if(isset($nextRecord)) { echo $nextRecord; } ?>'> 
    <input type='hidden' name='previousRecord' id='previousRecord' value='<?php if(isset($previousRecord)) { echo $previousRecord; } ?>'> 
    <input type='hidden' name='lastRecord' id='lastRecord' value='<?php if(isset($lastRecord)) { echo $lastRecord; } ?>'> 
    <input type='hidden' name='endRecord' id='endRecord' value='<?php if(isset($endRecord)) { echo $endRecord; } ?>'> 
    <script language='javascript' type='text/javascript'> 
         $(document).ready(function(){  
validateMeNumeric('raceId') 
validateMeNumeric('raceSequence') 
validateMeAlphaNumeric('raceCode') 
validateMeAlphaNumeric('raceDesc') 
validateMeNumeric('executeBy') 
 $('executeTime').datepicker({ 
    format :'<?php echo $systemFormat['systemSettingDateFormat'].$systemFormat['systemSettingTimeFormat']; ?>'
   });  
            <?php if(isset($_POST['query'])) { ?> 
                    $('#clearSearch').removeCss(); 
                    $('#clearSearch').addClass('btn'); 
            <?php } ?> 
            <?php if($_POST['method']=='new') { ?> 
            $('#resetRecordButton').removeClass(); 
            $('#resetRecordButton').addClass('btn btn-info'); 
            $('#newRecordButton').removeClass(); 
            $('#newRecordButton').addClass('btn btn-success'); 
            $('#firstRecordButton').removeClass(); 
            $('#firstRecordButton').addClass('btn btn-info');  
            $('#lastRecordButton').removeClass(); 
            $('#lastRecordButton').addClass('btn btn-info'); 
            <?php } else  if ($_POST['raceId']) { ?> 
 $('#newRecordButton1').removeClass(); 
 $('#newRecordButton2').removeClass(); 
 $('#newRecordButton3').removeClass(); 
 $('#newRecordButton4').removeClass(); 
 $('#newRecordButton5').removeClass(); 
 $('#newRecordButton6').removeClass(); 
 $('#newRecordButton7').removeClass(); 
 $('#newRecordButton1').addClass('btn btn-success disabled'); 
 $('#newRecordButton2').addClass('btn  dropdown-toggle btn-success disabled'); 
 $('#newRecordButton1').attr('onClick', ''); 
 $('#newRecordButton2').attr('onClick', ''); 
 $('#newRecordButton3').attr('onClick', ''); 
 $('#newRecordButton4').attr('onClick', ''); 
 $('#newRecordButton5').attr('onClick', ''); 
 $('#newRecordButton6').attr('onClick', ''); 
 $('#newRecordButton7').attr('onClick', ''); 
 $('#updateRecordButton1').removeClass(); 
 $('#updateRecordButton2').removeClass(); 
 $('#updateRecordButton3').removeClass(); 
 $('#updateRecordButton4').removeClass(); 
 $('#updateRecordButton5').removeClass(); 
<?php if($leafAccess['leafAccessUpdateValue']==1) { ?> 
 $('#updateRecordButton1').addClass('btn btn-info'); 
 $('#updateRecordButton2').addClass('btn dropdown-toggle btn-info'); 
 $('#updateRecordButton3').attr('onClick', "updateRecord('<?php echo $race->getControllerPath(); ?>','<?php echo $securityToken; ?>',1)"); 
 $('#updateRecordButton4').attr('onClick', "updateRecord('<?php echo $race->getControllerPath(); ?>','<?php echo $securityToken; ?>',2)"); 
 $('#updateRecordButton5').attr('onClick', "updateRecord('<?php echo $race->getControllerPath(); ?>','<?php echo $securityToken; ?>',3)"); 
<?php }  else { ?> 
 $('#updateRecordButton1').addClass('btn btn-info disabled'); 
 $('#updateRecordButton2').addClass('btn dropdown-toggle btn-info disabled'); 
 $('#updateRecordButton1').attr('onClick', ''); 
 $('#updateRecordButton2').attr('onClick', ''); 
 $('#updateRecordButton3').attr('onClick', ''); 
 $('#updateRecordButton4').attr('onClick', ''); 
 $('#updateRecordButton5').attr('onClick', ''); 
<?php } ?> 
<?php if($leafAccess['leafAccessDeleteValue']==1) { ?> 
 $('#deleteRecordButton').removeClass();
 $('#deleteRecordButton').addClass('btn btn-danger'); 
 $('#deleteRecordButton').attr('onClick', "deleteRecord('<?php echo $race->getControllerPath(); ?>','<?php echo $securityToken; ?>')"); 
<?php }  else { ?> 
 $('#deleteRecordButton').removeClass();
 $('#deleteRecordButton').addClass('btn btn-danger disabled'); 
 $('#deleterecordButton').attr('onClick', ''); 
            <?php } ?>  
            <?php } ?>  
         }); 
    </script> 
<?php } ?> 
<script language='javascript' type='text/javascript' src='./package/system/common/javascript/race.js'></script> 
