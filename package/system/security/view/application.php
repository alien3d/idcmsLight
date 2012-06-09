  

<?php require_once('/../controller/applicationController.php'); 
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
$translator->setCurrentDatabase('icore'); 
$translator->setCurrentTable('application');  
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
 $arrayInfo = $translator->getFileInfo('application.php'); 
 $applicationId=$arrayInfo['applicationId']; 
 $moduleId=$arrayInfo['moduleId']; 
if (isset($_POST)) {  
    if (isset($_POST['method'])) {  
        $application = new \Core\System\Security\Application\Controller\ApplicationClass();  
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
         $application->setFieldQuery($_POST ['query']); 
     } 
     if (isset($_POST ['filter'])) { 
         $application->setGridQuery($_POST ['filter']); 
     }                 
     if (isset($_POST ['character'])) { 
		$application->setCharacterQuery($_POST['character']); 
     } 
     if (isset($_POST ['dateRangeStart'])) { 
		$application->setDateRangeStartQuery($_POST['dateRangeStart']); 
		//explode the data to get day,month,year 
		$start=explode("-",$_POST ['dateRangeStart']); 
		$application->setStartDay($start[2]); 
		$application->setStartMonth($start[1]); 
		$application->setStartYear($start[0]); 
     } 
     if (isset($_POST ['dateRangeEnd']) && (strlen($_POST['dateRangeEnd'])> 0) ) { 
		$application->setDateRangeEndQuery($_POST['dateRangeEnd']); 
		//explode the data to get day,month,year 
		$start=explode("-",$_POST ['dateRangeEnd']); 
		$application->setEndDay($start[2]); 
		$application->setEndMonth($start[1]); 
		$application->setEndYear($start[0]); 
     } 
     if (isset($_POST ['dateRangeType'])) { 
		$application->setDateRangeTypeQuery($_POST['dateRangeType']); 
     } 
     if (isset($_POST ['dateRangeExtraType'])) { 
		$application->setDateRangeExtraTypeQuery($_POST['dateRangeExtraType']); 
     } 
            $application->setStart($offset);  
            $application->setLimit($limit); // normal system don't like paging..  
            $application->execute();  
            $application->setPageOutput('html');  
            $applicationArray = $application->read();  
            if (isset($applicationArray [0]['firstRecord'])) {  
                $firstRecord = $applicationArray [0]['firstRecord'];  
            }  
            if (isset($applicationArray [0]['nextRecord'])) {  
                $nextRecord = $applicationArray [0]['nextRecord'];  
            }   
            if (isset($applicationArray [0]['previousRecord'])) {  
                $previousRecord = $applicationArray [0]['previousRecord'];  
            }   
            if (isset($applicationArray [0]['lastRecord'])) {  
                $lastRecord = $applicationArray [0]['lastRecord'];  
                $endRecord = $applicationArray [0]['lastRecord'];  
           }   
            $navigation = new \Core\Paging\HtmlPaging();  
            $navigation->setViewPath($application->getViewPath());  
            $navigation->setOffset($offset);  
            $navigation->setLimit($limit);  
            $navigation->setSecurityToken($securityToken);  
            if (isset($applicationArray [0]['total'])) {  
                $total = $applicationArray [0]['total'];  
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
                <button type='button' name='menuBack' class='btn btn-inverse btn-small' onClick=loadSidebar(<?php echo $applicationId; ?>,'<?php echo $moduleId; ?>')><i class='icon-arrow-left'></i> Menu </button> <button type='button' value='New Record' name='newRecordButton' id='newRecordButton' class='btn btn-info btn-small' onClick=showForm('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>')><i class='icon-plus'></i> New Record </button> 
                </div>
                <hr>
                <h3>Search</h3>
                <input type='text' name='queryWidget' id='queryWidget' class='span2' value='<?php if(isset($_POST['query'])) {  echo $_POST['query']; } ?>'>
<br>                    <input type='button' name='searchString' id='searchString' value='Search' class='btn btn-info' onClick=ajaxQuerySearchAll('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>')>
                    <input type='button' name='clearSearchString' id='clearSearchString' value='Clear' class='btn' onClick=showGrid('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>',0,<?php echo LIMIT; ?>)>
                <hr>
                <h4>Date</h4>
                 <table cellpadding=1 cellspacing=1>
                     <tr>
                         <td colspan='3'><a href=javascript:void(0) onClick=ajaxQuerySearchAllDate('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','1979-01-01','2012-06-09')>Any Time</a></td>
                     </tr>
                     <tr>
                     <tr>
                         <td align='right'><a href=javascript:void(0) rel='tooltip' title='Previous Day' onClick=ajaxQuerySearchAllDate('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','<?php echo $dateRangeStart; ?>','','day','previous')>&laquo;</a></td>
                         <td align='center'><a href=javascript:void(0) onClick=ajaxQuerySearchAllDate('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','<?php echo $dateRangeStart; ?>','','day','')>Today</a></td>
                         <td align='left'><a href=javascript:void(0) rel='tooltip' title='Next Day' onClick=ajaxQuerySearchAllDate('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','<?php echo $dateRangeStart; ?>','','day','next')>&raquo;</a></td>
                     </tr>
                     <tr>
                         <td align='right'><a href=javascript:void(0) rel='tooltip' title='Previous Week'  onClick=ajaxQuerySearchAllDate('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','<?php echo $dateRangeStart; ?>','','week','previous')>&laquo;</a> </td>
                         <td align='center'><a href=javascript:void(0) onClick=ajaxQuerySearchAllDate('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','<?php echo $dateRangeStart; ?>','','week','')>Week</a> </td>
                         <td align='left'><a href=javascript:void(0) rel='tooltip' title='Next Week' onClick=ajaxQuerySearchAllDate('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','<?php echo $dateRangeStart; ?>','','week','next')>&raquo;</a></td>
                     </tr>
                     <tr>
                         <td align='right'><a href=javascript:void(0) rel='tooltip' title='Previous Month'  onClick=ajaxQuerySearchAllDate('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','<?php echo $dateRangeStart; ?>','','month','previous')>&laquo;</td> 
                         <td align='center'><a href=javascript:void(0) onClick=ajaxQuerySearchAllDate('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','<?php echo $dateRangeStart; ?>','','month','')>Month</a> </td>
                         <td align='left'><a href=javascript:void(0) rel='tooltip' title='Next Month' onClick=ajaxQuerySearchAllDate('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','<?php echo $dateRangeStart; ?>','','month','next')>&raquo;</a></td>
                     </tr>
                     <tr>
                         <td align='right'><a href=javascript:void(0) rel='tooltip' title='Previous Year'  onClick=ajaxQuerySearchAllDate('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','<?php echo $dateRangeStart; ?>','','year','previous')>&laquo;</a></td> 
                        <td align='center'><a href=javascript:void(0) onClick=ajaxQuerySearchAllDate('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','<?php echo $dateRangeStart; ?>','','year','')>Year</a> </td>
                         <td align='left'><a href=javascript:void(0) rel='tooltip' title='Next Year' onClick=ajaxQuerySearchAllDate('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','<?php echo $dateRangeStart; ?>','','year','next')>&raquo;</a></td>
                         </tr>
</table>
                Range
                <div style='style:none'>
                    <input type='date' name='dateRangeStart' id='dateRangeStart' class='span2' value='<?php if(isset($_POST['dateRangeStart'])) { echo $_POST['dateRangeStart']; } ?>'><br>
                    <input type='date' name='dateRangeEnd' id='dateRangeEnd' class='span2' value='<?php if(isset($_POST['dateRangeEnd'])) { echo $_POST['dateRangeEnd']; } ?>'><br>
                    <input type='button' name='searchDate' id='searchDate' value='Search' class='btn btn-info' onClick=ajaxQuerySearchAllDateRange('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>')>
                    <input type='button' name='clearSearchDate' id='clearSearchDate' value='Clear' class='btn' onClick=showGrid('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>',0,<?php echo LIMIT; ?>)>
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
<div class='control-group' id='iconIdDiv' >

                                <label class='control-label'><?php if(isset( $leafTranslation['iconIdLabel'])) {  echo $leafTranslation['iconIdLabel']; } ?></label>

                                <div class='controls  input-prepend'>

                                    <input type='text' name='iconId' id='iconId' placeholder='Numeric Only' class='span3'>

                                    <span name='numericHelpMe' id='iconIdHelpMe' class='help-inline'></span>

                                </div>

                            </div>
<div class='control-group' id='applicationSequenceDiv' >

                                <label class='control-label'><?php if(isset( $leafTranslation['applicationSequenceLabel'])) {  echo $leafTranslation['applicationSequenceLabel']; } ?></label>

                                <div class='controls  input-prepend'>

                                    <input type='text' name='applicationSequence' id='applicationSequence' placeholder='Numeric Only' class='span3'>

                                    <span name='numericHelpMe' id='applicationSequenceHelpMe' class='help-inline'></span>

                                </div>

                            </div>
<div class='control-group' id='applicationCodeDiv'>
                                <label class='control-label'><?php if(isset( $leafTranslation['applicationCodeLabel'])) {  echo $leafTranslation['applicationCodeLabel']; } ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='applicationCode' id='applicationCode' placeholder='Field Of applicationCode' class='span3'>
                                </div>
                            </div><div class='control-group' id='applicationEnglishDiv'>
                                <label class='control-label'><?php if(isset( $leafTranslation['applicationEnglishLabel'])) {  echo $leafTranslation['applicationEnglishLabel']; } ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='applicationEnglish' id='applicationEnglish' placeholder='Field Of applicationEnglish' class='span3'>
                                </div>
                            </div><div class='control-group' id='applicationFilenameDiv'>
                                <label class='control-label'><?php if(isset( $leafTranslation['applicationFilenameLabel'])) {  echo $leafTranslation['applicationFilenameLabel']; } ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='applicationFilename' id='applicationFilename' placeholder='Field Of applicationFilename' class='span3'>
                                </div>
                            </div><div class='control-group' id='applicationDashboardFilenameDiv'>
                                <label class='control-label'><?php if(isset( $leafTranslation['applicationDashboardFilenameLabel'])) {  echo $leafTranslation['applicationDashboardFilenameLabel']; } ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='applicationDashboardFilename' id='applicationDashboardFilename' placeholder='Field Of applicationDashboardFilename' class='span3'>
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
            <input type='hidden' name='applicationIdPreview' id='applicationIdPreview'> 
<div class='control-group' id='iconIdDiv'>
                                <label class='control-label'><?php echo $leafTranslation['iconIdLabel'];  ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='iconIdPreview' id='iconIdPreview' placeholder='Field Of iconId' class='span3'>
                                </div>
                            </div><div class='control-group' id='applicationSequenceDiv'>
                                <label class='control-label'><?php echo $leafTranslation['applicationSequenceLabel'];  ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='applicationSequencePreview' id='applicationSequencePreview' placeholder='Field Of applicationSequence' class='span3'>
                                </div>
                            </div><div class='control-group' id='applicationCodeDiv'>
                                <label class='control-label'><?php echo $leafTranslation['applicationCodeLabel'];  ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='applicationCodePreview' id='applicationCodePreview' placeholder='Field Of applicationCode' class='span3'>
                                </div>
                            </div><div class='control-group' id='applicationEnglishDiv'>
                                <label class='control-label'><?php echo $leafTranslation['applicationEnglishLabel'];  ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='applicationEnglishPreview' id='applicationEnglishPreview' placeholder='Field Of applicationEnglish' class='span3'>
                                </div>
                            </div><div class='control-group' id='applicationFilenameDiv'>
                                <label class='control-label'><?php echo $leafTranslation['applicationFilenameLabel'];  ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='applicationFilenamePreview' id='applicationFilenamePreview' placeholder='Field Of applicationFilename' class='span3'>
                                </div>
                            </div><div class='control-group' id='applicationDashboardFilenameDiv'>
                                <label class='control-label'><?php echo $leafTranslation['applicationDashboardFilenameLabel'];  ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='applicationDashboardFilenamePreview' id='applicationDashboardFilenamePreview' placeholder='Field Of applicationDashboardFilename' class='span3'>
                                </div>
                            </div>        </div> 
        <div class='modal-footer'> 
            <a href=javascript:void(0) class='btn btn-danger' onClick=deleteGridRecord('<?php echo $application->getControllerPath(); ?>','<?php echo $securityToken; ?>','<?php echo $application->getViewPath(); ?>')>Delete</a> 
            <a href=javascript:void(0) onclick=showMeModal('deletePreview',0) class='btn'>Close</a> 
        </div> 
   </div> 
<div align='left'  class='btn-group'> 
        <a title='A' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','A')>A</a> 
        <a title='B' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','B')>B</a> 
        <a title='C' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','C')>C</a> 
        <a title='D' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','D')>D</a> 
        <a title='E' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','E')>E</a> 
        <a title='F' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','F')>F</a> 
        <a title='G' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','G')>G</a> 
        <a title='H' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','H')>H</a> 
        <a title='I' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','I')>I</a> 
        <a title='J' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','J')>J</a> 
        <a title='K' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','K')>K</a> 
        <a title='L' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','L')>L</a> 
        <a title='M' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','M')>M</a> 
        <a title='N' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','N')>N</a> 
        <a title='O' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','O')>O</a> 
        <a title='P' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','P')>P</a> 
        <a title='Q' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','Q')>Q</a> 
        <a title='R' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','R')>R</a> 
        <a title='S' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','S')>S</a> 
        <a title='T' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','T')>T</a> 
        <a title='U' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','U')>U</a> 
        <a title='V' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','V')>V</a> 
        <a title='W' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','W')>W</a> 
        <a title='X' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','X')>X</a> 
        <a title='Y' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','Y')>Y</a> 
        <a title='Z' href=javascript:void(0) class='btn btn-small' onClick=ajaxQuerySearchAllCharacter('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>','Z')>Z</a> 
</div><br><br>    <div id='infoPanel'><?php if(isset($_POST['message'])) {  ?>           
            <div class='alert alert-error'><a class='close' data-dismiss='alert'>x</a><?php echo $_POST['message']; ?></div>
<?php } ?></div> 
<table class='table table-striped table-bordered table-condensed' name='tableData' id='tableData'> 
        <thead> 
            <tr> 
                 <th>#</th><?php  
 echo "<th>Action</th>"; 
 echo "<th>iconId</th>"; 
 echo "<th>English</th>"; 
 echo "<th>Filename</th>"; 
 echo "<th>DashboardFilename</th>"; 
 echo "<th>isSingle</th>"; 
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
              if (is_array($applicationArray)) { 
                $totalRecord = 0; 
                $totalRecord = count($applicationArray); 
                if ($totalRecord > 0) { 
                      $counter=0; 
                    for ($i = 0; $i < $totalRecord; $i++) { 
                     $counter++;
                     echo "<tr>"; 
                     echo "<td>".($counter+$offset)."</td>"; 
 echo  "<td><div class='btn-group'>
		<a rel='tooltip' class='tooltip-top btn btn-warning' data-original-title='Edit' onClick=showFormUpdate('".$application->getViewPath()."','".$securityToken."','".intval($applicationArray [$i]['applicationId'])."')><i class='icon-edit icon-white'></i></a>  
                    <a rel='tooltip' class='tooltip-top btn btn-danger' data-original-title='Delete' onClick=showModalDelete('".rawurlencode($applicationArray [$i]['applicationId'])."','".rawurlencode($applicationArray [$i]['iconId'])."','".rawurlencode($applicationArray [$i]['applicationSequence'])."','".rawurlencode($applicationArray [$i]['applicationCode'])."','".rawurlencode($applicationArray [$i]['applicationEnglish'])."','".rawurlencode($applicationArray [$i]['applicationFilename'])."','".rawurlencode($applicationArray [$i]['applicationDashboardFilename'])."','".rawurlencode($applicationArray [$i]['isDefault'])."','".rawurlencode($applicationArray [$i]['isNew'])."','".rawurlencode($applicationArray [$i]['isDraft'])."','".rawurlencode($applicationArray [$i]['isUpdate'])."','".rawurlencode($applicationArray [$i]['isDelete'])."','".rawurlencode($applicationArray [$i]['isActive'])."','".rawurlencode($applicationArray [$i]['isApproved'])."','".rawurlencode($applicationArray [$i]['isReview'])."','".rawurlencode($applicationArray [$i]['isPost'])."','".rawurlencode($applicationArray [$i]['isSingle'])."','".rawurlencode($applicationArray [$i]['executeBy'])."','".rawurlencode($applicationArray [$i]['executeTime'])."')><i class='icon-trash  icon-white'></i></a></td>"; 
if(isset($applicationArray[$i]['iconId'])) { 
 $value = $applicationArray[$i]['iconId'];
 } 
if(isset($value) && (strlen($value) > 0 )) {
	echo "<td align=right>".$value."</td>"; 
} else { 
 	echo "<td  align=right>&nbsp;</td>"; 
 }
if(isset($applicationArray[$i]['applicationEnglish'])) { 
 $value = $applicationArray[$i]['applicationEnglish'];
 } 
if(isset($value) && (strlen($value) > 0 )) {
	echo "<td align=left>".$value."</td>"; 
} else { 
 	echo "<td  align=left>&nbsp;</td>"; 
 }
if(isset($applicationArray[$i]['applicationFilename'])) { 
 $value = $applicationArray[$i]['applicationFilename'];
 } 
if(isset($value) && (strlen($value) > 0 )) {
	echo "<td align=left>".$value."</td>"; 
} else { 
 	echo "<td  align=left>&nbsp;</td>"; 
 }
if(isset($applicationArray[$i]['applicationDashboardFilename'])) { 
 $value = $applicationArray[$i]['applicationDashboardFilename'];
 } 
if(isset($value) && (strlen($value) > 0 )) {
	echo "<td align=left>".$value."</td>"; 
} else { 
 	echo "<td  align=left>&nbsp;</td>"; 
 }
if(isset($applicationArray[$i]['isSingle'])) { 
 $value = $applicationArray[$i]['isSingle'];
 } 
if(isset($value) && (strlen($value) > 0 )) {
	echo "<td align=left>".$value."</td>"; 
} else { 
 	echo "<td  align=left>&nbsp;</td>"; 
 }
if(isset($applicationArray[$i]['executeBy'])) { 
	echo "<td>".$applicationArray[$i]['staffName']."</td>"; 
} else {
	echo "<td>&nbsp;</td>";
	}
  if(isset($applicationArray[$i]['executeTime'])) { 
 	$valueArray = $applicationArray[$i]['executeTime'];  
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
  	if($applicationArray[$i]['isDelete']) {
    $checked='checked';
} else {
    $checked=null;
}
                         echo "<td>
    <input style='display:none;' type='checkbox' name='applicationId[]' id='applicationId' value='".$applicationArray[$i]['applicationId']."'>
    <input ".$checked." type='checkbox' name='isDelete[]' id='isDelete' value='".$applicationArray[$i]['isDelete']."'>
    
</td>";
                    echo "</tr>"; 
                  }  } 
                } else { ?> 
                    <tr> 
                        <td colspan='6'><?php $application->exceptionMessage('No Record'); ?></td> 
                    </tr> 
                    <?php 
                } 
            } else { ?> 
                <tr> 
                    <td colspan='6'><?php $application->exceptionMessage('Data Record Problem'); ?></td> 
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
<button class='delete btn btn-warning' type='button' onClick=deleteGridRecordCheckbox('<?php echo $application->getControllerPath(); ?>','<?php echo $securityToken; ?>','<?php echo $application->getViewPath(); ?>')> 
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
         <form class='well 'form-vertical'>
    <input type='hidden' name='applicationId' id='applicationId' 
value='<?php if (isset($_POST['applicationId'])) { 
                echo $_POST['applicationId'];    
            }  ?>'> 
<div class='control-group' id='iconIdForm' >

                                <label class='control-label'><?php echo $leafTranslation['iconIdLabel']; ?></label>

                                <div class='controls  input-prepend'>

                                    <input type='text' name='iconId' id='iconId' placeholder='Numeric Only' class='span3' value='<?php if(isset($applicationArray) && is_array($applicationArray)) { echo $applicationArray[0]['iconId']; } ?>'>

                                    <span name='numericHelpMe' id='iconIdHelpMe' class='help-inline' ></span>

                                </div>

                            </div>
<div class='control-group' id='applicationSequenceForm' >

                                <label class='control-label'><?php echo $leafTranslation['applicationSequenceLabel']; ?></label>

                                <div class='controls  input-prepend'>

                                    <input type='text' name='applicationSequence' id='applicationSequence' placeholder='Numeric Only' class='span3' value='<?php if(isset($applicationArray) && is_array($applicationArray)) { echo $applicationArray[0]['applicationSequence']; } ?>'>

                                    <span name='numericHelpMe' id='applicationSequenceHelpMe' class='help-inline' ></span>

                                </div>

                            </div>
<div class='control-group' id='applicationCodeForm'>
                                <label class='control-label'><?php echo $leafTranslation['applicationCodeLabel']; ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='applicationCode' id='applicationCode' placeholder='Field Of applicationCode' class='span3' 
                                    value='<?php if(isset($applicationArray) && is_array($applicationArray)) {  echo $applicationArray[0]['applicationCode']; } ?>'>
                                </div>
                            </div><div class='control-group' id='applicationEnglishForm'>
                                <label class='control-label'><?php echo $leafTranslation['applicationEnglishLabel']; ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='applicationEnglish' id='applicationEnglish' placeholder='Field Of applicationEnglish' class='span3' 
                                    value='<?php if(isset($applicationArray) && is_array($applicationArray)) {  echo $applicationArray[0]['applicationEnglish']; } ?>'>
                                </div>
                            </div><div class='control-group' id='applicationFilenameForm'>
                                <label class='control-label'><?php echo $leafTranslation['applicationFilenameLabel']; ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='applicationFilename' id='applicationFilename' placeholder='Field Of applicationFilename' class='span3' 
                                    value='<?php if(isset($applicationArray) && is_array($applicationArray)) {  echo $applicationArray[0]['applicationFilename']; } ?>'>
                                </div>
                            </div><div class='control-group' id='applicationDashboardFilenameForm'>
                                <label class='control-label'><?php echo $leafTranslation['applicationDashboardFilenameLabel']; ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='applicationDashboardFilename' id='applicationDashboardFilename' placeholder='Field Of applicationDashboardFilename' class='span3' 
                                    value='<?php if(isset($applicationArray) && is_array($applicationArray)) {  echo $applicationArray[0]['applicationDashboardFilename']; } ?>'>
                                </div>
                            </div><div class='control-group' id='executeByForm' >

                                <label class='control-label'><?php echo $leafTranslation['executeByLabel']; ?></label>

                                <div class='controls  input-prepend'>

                                    <input type='text' name='executeBy' id='executeBy' placeholder='String Only' class='span3' value='<?php if(isset($applicationArray) && is_array($applicationArray)) { echo $applicationArray[0]['staffName']; } ?>' readOnly>

                                    <span name='numericHelpMe' id='executeByHelpMe' class='help-inline' ></span>

                                </div>

                            </div>
<?php 
if(isset($applicationArray) && is_array($applicationArray)) { 
     $valueArray = $applicationArray[0]['executeTime'];  
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
                            </div></form><br>
<div class='form-actions'>
    <div class='btn-toolbar'> 
        <div class='btn-group'> 
            <a  name='auditRecordButton' id='auditRecordButton'  href=javascript:void(0) 
    class='<?php if($leafAccess['isDraft']==0) { ?>btn btn-warning disabled<?php } else { ?>btn btn-warning<?php } ?>' 
    <?php if($leafAccess['isDraft']==1) { ?>) { ?>onClick=auditRecord('<?php echo $application->getControllerPath(); ?>','<?php echo $securityToken; ?>',)<?php } ?>><i class='icon-warning-sign icon-white'></i><?php echo $buttonTranslation['isAuditLabel']; ?></a> 
        </div>        <div class='btn-group'>            <a  name='newRecordButton1' id='newRecordButton1' href=javascript:void(0) class='<?php if($leafAccess['leafAccessCreateValue']==0) { ?>btn btn-success disabled<?php } else { ?>btn btn-success  <?php } ?>'><i class=icon-plus icon-white></i><?php echo $buttonTranslation['isNewLabel'][0]; ?></a> 
            <a  name='newRecordButton2' id='newRecordButton2' href=javascript:void(0) data-toggle='dropdown' class='<?php if($leafAccess['leafAccessCreateValue']==0) { ?>btn dropdown-toggle btn-success disabled<?php } else { ?>btn dropdown-toggle btn-success<?php } ?>'><span class=caret></span></a> 
            <ul class='dropdown-menu'> 
                <li><a name='newRecordButton3' id='newRecordButton3' href=javascript:void(0) <?php if($leafAccess['leafAccessCreateValue']==1) { ?>onClick=newRecord('<?php echo $application->getControllerPath(); ?>','<?php echo $securityToken; ?>',1) <?php } ?> class='<?php if($leafAccess['isNew']==0) { ?>disabled<?php } ?>'><i class='icon-plus'></i><?php echo $buttonTranslation['isNewLabel'][1]; ?></a></li> 
                <li><a name='newRecordButton4' id='newRecordButton4' href=javascript:void(0) <?php if($leafAccess['leafAccessCreateValue']==1) { ?>onClick=newRecord('<?php echo $application->getControllerPath(); ?>','<?php echo $securityToken; ?>',2) <?php } ?> class='<?php if($leafAccess['isNew']==0) { ?>disabled<?php } ?>'><i class='icon-edit'></i><?php echo $buttonTranslation['isNewLabel'][2]; ?></a></li> 
                <li><a name='newRecordButton5' id='newRecordButton5' href=javascript:void(0) <?php if($leafAccess['leafAccessCreateValue']==1) { ?>onClick=newRecord('<?php echo $application->getControllerPath(); ?>','<?php echo $securityToken; ?>',3) <?php } ?> class='<?php if($leafAccess['isNew']==0) { ?>disabled<?php } ?>'><i class='icon-print'></i><?php echo $buttonTranslation['isNewLabel'][3]; ?></a></li> 
                <li><a name='newRecordButton6' id='newRecordButton6' href=javascript:void(0) <?php if($leafAccess['leafAccessCreateValue']==1) { ?>onClick=newRecord('<?php echo $application->getControllerPath(); ?>','<?php echo $securityToken; ?>',4) <?php } ?> class='<?php if($leafAccess['isNew']==0) { ?>disabled<?php } ?>'><i class='icon-print'></i><?php echo $buttonTranslation['isNewLabel'][4]; ?></a></li> 
                <li><a name='newRecordButton7' id='newRecordButton7' href=javascript:void(0) <?php if($leafAccess['leafAccessCreateValue']==1) { ?>onClick=newRecord('<?php echo $application->getControllerPath(); ?>','<?php echo $securityToken; ?>',5) <?php } ?> class='<?php if($leafAccess['isNew']==0) { ?>disabled<?php } ?>'><i class='icon-list'></i><?php echo $buttonTranslation['isNewLabel'][5]; ?></a></li> 
            </ul> 
        </div> 
        <div class='btn-group'> 
            <a  name='updateRecordButton1' id='updateRecordButton1' href=javascript:void(0) class='<?php if($leafAccess['leafAccessUpdateValue']==0) { ?>btn btn-info 	disabled<?php } else { ?>btn btn-info <?php } ?>'><i class=icon-edit icon-white></i><?php echo $buttonTranslation['isUpdateLabel'][0]; ?></a> 
            <a  name='updateRecordButton2' id='updateRecordButton2' href=javascript:void(0) data-toggle='dropdown' class='<?php if($leafAccess['leafAccessUpdateValue']==0) { ?>btn dropdown-toggle btn-info disabled<?php } else { ?>btn dropdown-toggle btn-info <?php } ?>'><span class='caret'></span></a> 
            <ul class='dropdown-menu'> 
                <li><a name='updateRecordButton3' id='updateRecordButton3' href=javascript:void(0) <?php if($leafAccess['leafAccessUpdateValue']==1) { ?>onClick=updateRecord('<?php echo $application->getControllerPath(); ?>','<?php echo $securityToken; ?>',1)<?php } ?> class='<?php if($leafAccess['isUpdate']==0) { ?>disabled <?php } ?>'><i class='icon-plus'></i><?php echo $buttonTranslation['isUpdateLabel'][1]; ?></a></li> 
                <li><a name='updateRecordButton4' id='updateRecordButton4' href=javascript:void(0) <?php if($leafAccess['leafAccessUpdateValue']==1) { ?>onClick=updateRecord('<?php echo $application->getControllerPath(); ?>','<?php echo $securityToken; ?>',2)<?php } ?> class='<?php if($leafAccess['isUpdate']==0) { ?>disabled <?php } ?>'><i class='icon-print'></i><?php echo $buttonTranslation['isUpdateLabel'][2]; ?></a></li> 
                <li><a name='updateRecordButton5' id='updateRecordButton5' href=javascript:void(0) <?php if($leafAccess['leafAccessUpdateValue']==1) { ?>onClick=updateRecord('<?php echo $application->getControllerPath(); ?>','<?php echo $securityToken; ?>',3)<?php } ?> class='<?php if($leafAccess['isUpdate']==0) { ?>disabled <?php } ?>'><i class='icon-list-alt'></i><?php echo $buttonTranslation['isUpdateLabel'][3]; ?></a></li> 
            </ul> 
        </div> 
        <div class='btn-group'> 
            <a name='deleteRecordButton' id='deleteRecordButton' href='javascript:void(0)'   <?php if($leafAccess['isDelete']==1) { ?>onClick=deleteRecord('<?php echo $application->getControllerPath(); ?>','<?php echo $securityToken; ?>')<?php } ?> class='<?php if($leafAccess['isDelete']==0) { ?>btn btn-danger disabled<?php } else { ?>btn btn-danger<?php } ?>'><i class='icon-trash icon-white'></i><?php echo $buttonTranslation['isDeleteLabel']; ?></a> 
        </div> 
        <div class='btn-group'>            <a name='resetRecordButton' id='resetRecordButton' href=javascript:void(0) class='btn btn-info' onClick=resetRecord('<?php echo $application->getControllerPath(); ?>','<?php echo $securityToken; ?>')><i class=icon-refresh icon-white></i><?php echo $buttonTranslation['isResetLabel']; ?></a> 
        </div> 
        <div class='btn-group'>            <a name='postRecordButton' id='postRecordButton' href=javascript:void(0) class='<?php if($leafAccess['leafAccessPostValue']==0) { ?>btn btn-warning  disabled<?php } else { ?>btn btn-warning<?php } ?>' <?php if($leafAccess['isPost']==1) { ?>onClick=postRecord('<?php echo $application->getControllerPath(); ?>','<?php echo $securityToken; ?>')<?php } ?>><i class=icon-cog icon-white></i><?php echo $buttonTranslation['isPostLabel']; ?></a> 
        </div> 
        <div class='btn-group'>            <a name='listRecordButton' id='listRecordButton' href=javascript:void(0) class='btn btn-info' onClick=showGrid('<?php echo $application->getViewPath(); ?>','<?php echo $securityToken; ?>',0,<?php echo LIMIT; ?>)><i class=icon-list icon-white></i>Listing</a> 
        </div> 
        <div class='btn-group'> 
            <a name='firstRecordButton' id='firstRecordButton' href=javascript:void(0) class='btn btn-info' onClick=firstRecord('<?php echo $application->getControllerPath(); ?>','<?php echo $securityToken; ?>')><i class=icon-fast-backward icon-white></i><?php echo $defaultTranslation['firstButtonLabel']; ?></a> 
        </div> 
        <div class='btn-group'> 
            <a name='previousRecordButton' id='previousRecordButton' href=javascript:void(0) class='btn btn-info disabled' onClick=previousRecord('<?php echo $application->getControllerPath(); ?>','<?php echo $securityToken; ?>')><i class=icon-backward icon-white></i><?php echo $defaultTranslation['previousButtonLabel']; ?></a> 
        </div> 
        <div class='btn-group'> 
            <a name='nextRecordButton' id='nextRecordButton' href=javascript:void(0) class='btn btn-info disabled' onClick=nextRecord('<?php echo $application->getControllerPath(); ?>','<?php echo $securityToken; ?>')><i class=icon-forward icon-white></i><?php echo $defaultTranslation['nextButtonLabel']; ?></a> 
        </div> 
        <div class='btn-group'> 
            <a name='lastRecordButton' id='lastRecordButton' href=javascript:void(0) class='btn btn-info' onClick=lastRecord('<?php echo $application->getControllerPath(); ?>','<?php echo $securityToken; ?>')><i class=icon-fast-forward icon-white></i><?php echo $defaultTranslation['endButtonLabel']; ?></a> 
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
validateMeNumeric('applicationId') 
validateMeNumeric('iconId') 
validateMeNumeric('applicationSequence') 
validateMeAlphaNumeric('applicationCode') 
validateMeAlphaNumeric('applicationEnglish') 
validateMeAlphaNumeric('applicationFilename') 
validateMeAlphaNumeric('applicationDashboardFilename') 
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
            <?php } else  if ($_POST['applicationId']) { ?> 
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
 $('#updateRecordButton3').attr('onClick', "updateRecord('<?php echo $application->getControllerPath(); ?>','<?php echo $securityToken; ?>',1)"); 
 $('#updateRecordButton4').attr('onClick', "updateRecord('<?php echo $application->getControllerPath(); ?>','<?php echo $securityToken; ?>',2)"); 
 $('#updateRecordButton5').attr('onClick', "updateRecord('<?php echo $application->getControllerPath(); ?>','<?php echo $securityToken; ?>',3)"); 
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
 $('#deleteRecordButton').attr('onClick', "deleteRecord('<?php echo $application->getControllerPath(); ?>','<?php echo $securityToken; ?>')"); 
<?php }  else { ?> 
 $('#deleteRecordButton').removeClass();
 $('#deleteRecordButton').addClass('btn btn-danger disabled'); 
 $('#deleterecordButton').attr('onClick', ''); 
            <?php } ?>  
            <?php } ?>  
         }); 
    </script> 
<?php } ?> 
<script language='javascript' type='text/javascript' src='./package/system/security/javascript/application.js'></script> 
