<?php require_once('/../controller/themeController.php'); 
require_once ('../../../../library/class/classNavigation.php');  
require_once ('../../../../library/class/classShared.php');  
$translator = new \Core\shared\SharedClass();  
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
if (isset($_POST)) {  
    if (isset($_POST['method'])) {  
        $theme = new \Core\System\Common\Theme\Controller\themeClass();  
define("LIMIT",14);        if (isset($_POST['offset'])) {  
            $offset = $_POST['offset'];  
        } else {            $offset = 0;  
        }
        if (isset($_POST['limit'])) {  
            $limit = $_POST['limit'];  
        } else {            $limit = LIMIT;  
        }
        if ($_POST['method'] == 'read') {  
            if (isset($_POST ['query'])) {  
                $theme->setFieldQuery($_POST ['query']);  
            }  
            $theme->setStart($offset);  
            $theme->setLimit($limit); // normal system don't like paging..  
            $theme->execute();  
            $theme->setPageOutput('html');  
            $themeArray = $theme->read();  
            if (isset($themeArray [0]['firstRecord'])) {  
                $firstRecord = $themeArray [0]['firstRecord'];  
            }  
            if (isset($themeArray [0]['nextRecord'])) {  
                $nextRecord = $themeArray [0]['nextRecord'];  
            }   
            if (isset($themeArray [0]['previousRecord'])) {  
                $previousRecord = $themeArray [0]['previousRecord'];  
            }   
            if (isset($themeArray [0]['lastRecord'])) {  
                $lastRecord = $themeArray [0]['lastRecord'];  
                $endRecord = $themeArray [0]['lastRecord'];  
           }   
            $navigation = new \Core\Paging\HtmlPaging();  
            $navigation->setViewPath($theme->getViewPath());  
            $navigation->setOffset($offset);  
            $navigation->setLimit($limit);  
            $navigation->setSecurityToken($securityToken);  
            if (isset($themeArray [0]['total'])) {  
                $total = $themeArray [0]['total'];  
            } else {  
                $total = 0;  
            }  
            $navigation->setTotalRecord($total);  
        }  
    }  
 }  
 if ($_POST['method'] == 'read' && $_POST['type'] == 'list') { ?>  
    <div id='infoPanel'></div>  
    <div  class='modal hide fade' id='filterGridAdvance'>  
        <div class='modal-header'>  
            <a class='close' data-dismiss='modal1'>�</a>  
            <h3>Advance Search Record</h3>  
        </div>  
        <div class='modal-body'>  
<div class='control-group' id='themeSequenceDiv' >

                                <label class='control-label'><?php echo $leafTranslation['themeSequence']; ?></label>

                                <div class='controls  input-prepend'>

                                    <input type='text' name='themeSequence' id='themeSequence' placeholder='Numeric Only' class='span3'>

                                    <span name='numericHelpMe' id='themeSequenceHelpMe' class='help-inline'></span>

                                </div>

                            </div>
<div class='control-group' id='themeCodeDiv'>
                                <label class='control-label'><?php echo $leafTranslation['themeCode']; ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='themeCode' id='themeCode' placeholder='Field Of themeCode' class='span3'>
                                </div>
                            </div><div class='control-group' id='themeNoteDiv'>
                                <label class='control-label'><?php echo $leafTranslation['themeNote']; ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='themeNote' id='themeNote' placeholder='Field Of themeNote' class='span3'>
                                </div>
                            </div><div class='control-group' id='themePathDiv'>
                                <label class='control-label'><?php echo $leafTranslation['themePath']; ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='themePath' id='themePath' placeholder='Field Of themePath' class='span3'>
                                </div>
                            </div>        </div> 
        <div class='modal-footer'> 
            <a href='javascript:void(0)' class='btn btn-info'>Search</a> 
            <a href='javascript:void(0)' onclick='showMeModal('filterGridAdvance',0)' class='btn'>Close</a> 
        </div> 
    </div> 
    <div  class='modal hide fade' id='deletePreview'> 
        <div class='modal-header'> 
            <a class='close' data-dismiss='modal1'>�</a> 
            <h3>Are you sure want to delete this record ?</h3> 
        </div> 
        <div class='modal-body'> 
            <input type='hidden' name='themeIdPreview' id='themeIdPreview'> 
<div class='control-group' id='themeSequenceDiv'>
                                <label class='control-label'><?php echo $leafTranslation['themeSequence']; ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='themeSequencePreview' id='themeSequencePreview' placeholder='Field Of themeSequence' class='span3'>
                                </div>
                            </div><div class='control-group' id='themeCodeDiv'>
                                <label class='control-label'><?php echo $leafTranslation['themeCode']; ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='themeCodePreview' id='themeCodePreview' placeholder='Field Of themeCode' class='span3'>
                                </div>
                            </div><div class='control-group' id='themeNoteDiv'>
                                <label class='control-label'><?php echo $leafTranslation['themeNote']; ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='themeNotePreview' id='themeNotePreview' placeholder='Field Of themeNote' class='span3'>
                                </div>
                            </div><div class='control-group' id='themePathDiv'>
                                <label class='control-label'><?php echo $leafTranslation['themePath']; ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='themePathPreview' id='themePathPreview' placeholder='Field Of themePath' class='span3'>
                                </div>
                            </div><div class='control-group' id='isDefaultDiv'>
                                <label class='control-label'><?php echo $leafTranslation['isDefault']; ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='isDefaultPreview' id='isDefaultPreview' placeholder='Field Of isDefault' class='span3'>
                                </div>
                            </div><div class='control-group' id='isApprovedDiv'>
                                <label class='control-label'><?php echo $leafTranslation['isApproved']; ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='isApprovedPreview' id='isApprovedPreview' placeholder='Field Of isApproved' class='span3'>
                                </div>
                            </div><div class='control-group' id='isPostDiv'>
                                <label class='control-label'><?php echo $leafTranslation['isPost']; ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='isPostPreview' id='isPostPreview' placeholder='Field Of isPost' class='span3'>
                                </div>
                            </div>        </div> 
        <div class='modal-footer'> 
            <a href='javascript:void(0)' class='btn btn-danger' onClick='deleteGridRecord()'>Delete</a> 
            <a href='javascript:void(0)' onclick='showMeModal('deletePreview',0)' class='btn'>Close</a> 
        </div> 
   </div> 
<div align='right'> 
        <input type='text' class='input-large search-query' name='query' id='query'> 
        <a href='javascript:void(0)' class='btn' onClick='ajaxQuerySearchAll('<?php $theme->getViewPath(); ?>','<?php echo $securityToken; ?>')'><i class='icon-zoom-in'></i> Search </a> 
        <a href='javascript:void(0)' class='btn' onclick='showMeModal('filterGridAdvance',1)'><i class='icon-zoom-in' ></i> Advance Search </a> 
        <a href='javascript:void(0)' class='btn hide' onclick='hideButton();showGrid('<?php $theme->getViewPath(); ?>','<?php echo $securityToken; ?>',0,<?php echo LIMIT; ?>)' name='clearSearch' id='clearSearch'><i class='icon-refresh' ></i>Clear Search </a> 
        <a href='javascript:void(0)' class='btn' onClick='showForm('<?php $theme->getViewPath(); ?>','<?php echo $securityToken; ?>')'><i class='icon-plus'></i> New </a> 
        <a href='javascript:void(0)' class='btn'><i class='icon-file'></i> Report </a> 
    </div> 
    <br> 
<table class='table table-striped table-bordered table-condensed' name='tableData' id='tableData'> 
        <thead> 
            <tr> 
           <?php   if (is_array($themeArray)) { 
                $totalRecord = 0; 
                $totalRecord = count($themeArray); 
                if ($totalRecord > 0) { 
                    for ($i = 0; $i < $totalRecord; $i++) { ?> 
                        <tr> 
 <th>Action</th> 
<?php switch($themeArray['themeSequence'][$i]) {  
 case 'isDefault':

                case 'isNew':

                case 'isDraft':

                case 'isUpdate':

                case 'isDelete':

                case 'isActive':

                case 'isApproved':

                case 'isReview':

                case 'isPost':

                    if($_SESSION ['isAdmin'] ==1) {
  echo "<td>".$themeArray[$i]['themeSequence']."</th>"; 
      }
    
                break;

                default:
 echo "<td>".$themeArray[$i]['themeSequence']."</th>"; 
} 
 ?>
<?php switch($themeArray['themeCode'][$i]) {  
 case 'isDefault':

                case 'isNew':

                case 'isDraft':

                case 'isUpdate':

                case 'isDelete':

                case 'isActive':

                case 'isApproved':

                case 'isReview':

                case 'isPost':

                    if($_SESSION ['isAdmin'] ==1) {
  echo "<td>".$themeArray[$i]['themeCode']."</th>"; 
      }
    
                break;

                default:
 echo "<td>".$themeArray[$i]['themeCode']."</th>"; 
} 
 ?>
<?php switch($themeArray['themeNote'][$i]) {  
 case 'isDefault':

                case 'isNew':

                case 'isDraft':

                case 'isUpdate':

                case 'isDelete':

                case 'isActive':

                case 'isApproved':

                case 'isReview':

                case 'isPost':

                    if($_SESSION ['isAdmin'] ==1) {
  echo "<td>".$themeArray[$i]['themeNote']."</th>"; 
      }
    
                break;

                default:
 echo "<td>".$themeArray[$i]['themeNote']."</th>"; 
} 
 ?>
<?php switch($themeArray['themePath'][$i]) {  
 case 'isDefault':

                case 'isNew':

                case 'isDraft':

                case 'isUpdate':

                case 'isDelete':

                case 'isActive':

                case 'isApproved':

                case 'isReview':

                case 'isPost':

                    if($_SESSION ['isAdmin'] ==1) {
  echo "<td>".$themeArray[$i]['themePath']."</th>"; 
      }
    
                break;

                default:
 echo "<td>".$themeArray[$i]['themePath']."</th>"; 
} 
 ?>
<?php switch($themeArray['isDefault'][$i]) {  
 case 'isDefault':

                case 'isNew':

                case 'isDraft':

                case 'isUpdate':

                case 'isDelete':

                case 'isActive':

                case 'isApproved':

                case 'isReview':

                case 'isPost':

                    if($_SESSION ['isAdmin'] ==1) {
  echo "<td>".$themeArray[$i]['isDefault']."</th>"; 
      }
    
                break;

                default:
 echo "<td>".$themeArray[$i]['isDefault']."</th>"; 
} 
 ?>
<?php switch($themeArray['isNew'][$i]) {  
 case 'isDefault':

                case 'isNew':

                case 'isDraft':

                case 'isUpdate':

                case 'isDelete':

                case 'isActive':

                case 'isApproved':

                case 'isReview':

                case 'isPost':

                    if($_SESSION ['isAdmin'] ==1) {
  echo "<td>".$themeArray[$i]['isNew']."</th>"; 
      }
    
                break;

                default:
 echo "<td>".$themeArray[$i]['isNew']."</th>"; 
} 
 ?>
<?php switch($themeArray['isDraft'][$i]) {  
 case 'isDefault':

                case 'isNew':

                case 'isDraft':

                case 'isUpdate':

                case 'isDelete':

                case 'isActive':

                case 'isApproved':

                case 'isReview':

                case 'isPost':

                    if($_SESSION ['isAdmin'] ==1) {
  echo "<td>".$themeArray[$i]['isDraft']."</th>"; 
      }
    
                break;

                default:
 echo "<td>".$themeArray[$i]['isDraft']."</th>"; 
} 
 ?>
<?php switch($themeArray['isUpdate'][$i]) {  
 case 'isDefault':

                case 'isNew':

                case 'isDraft':

                case 'isUpdate':

                case 'isDelete':

                case 'isActive':

                case 'isApproved':

                case 'isReview':

                case 'isPost':

                    if($_SESSION ['isAdmin'] ==1) {
  echo "<td>".$themeArray[$i]['isUpdate']."</th>"; 
      }
    
                break;

                default:
 echo "<td>".$themeArray[$i]['isUpdate']."</th>"; 
} 
 ?>
<?php switch($themeArray['isDelete'][$i]) {  
 case 'isDefault':

                case 'isNew':

                case 'isDraft':

                case 'isUpdate':

                case 'isDelete':

                case 'isActive':

                case 'isApproved':

                case 'isReview':

                case 'isPost':

                    if($_SESSION ['isAdmin'] ==1) {
  echo "<td>".$themeArray[$i]['isDelete']."</th>"; 
      }
    
                break;

                default:
 echo "<td>".$themeArray[$i]['isDelete']."</th>"; 
} 
 ?>
<?php switch($themeArray['isActive'][$i]) {  
 case 'isDefault':

                case 'isNew':

                case 'isDraft':

                case 'isUpdate':

                case 'isDelete':

                case 'isActive':

                case 'isApproved':

                case 'isReview':

                case 'isPost':

                    if($_SESSION ['isAdmin'] ==1) {
  echo "<td>".$themeArray[$i]['isActive']."</th>"; 
      }
    
                break;

                default:
 echo "<td>".$themeArray[$i]['isActive']."</th>"; 
} 
 ?>
<?php switch($themeArray['isApproved'][$i]) {  
 case 'isDefault':

                case 'isNew':

                case 'isDraft':

                case 'isUpdate':

                case 'isDelete':

                case 'isActive':

                case 'isApproved':

                case 'isReview':

                case 'isPost':

                    if($_SESSION ['isAdmin'] ==1) {
  echo "<td>".$themeArray[$i]['isApproved']."</th>"; 
      }
    
                break;

                default:
 echo "<td>".$themeArray[$i]['isApproved']."</th>"; 
} 
 ?>
<?php switch($themeArray['isReview'][$i]) {  
 case 'isDefault':

                case 'isNew':

                case 'isDraft':

                case 'isUpdate':

                case 'isDelete':

                case 'isActive':

                case 'isApproved':

                case 'isReview':

                case 'isPost':

                    if($_SESSION ['isAdmin'] ==1) {
  echo "<td>".$themeArray[$i]['isReview']."</th>"; 
      }
    
                break;

                default:
 echo "<td>".$themeArray[$i]['isReview']."</th>"; 
} 
 ?>
<?php switch($themeArray['isPost'][$i]) {  
 case 'isDefault':

                case 'isNew':

                case 'isDraft':

                case 'isUpdate':

                case 'isDelete':

                case 'isActive':

                case 'isApproved':

                case 'isReview':

                case 'isPost':

                    if($_SESSION ['isAdmin'] ==1) {
  echo "<td>".$themeArray[$i]['isPost']."</th>"; 
      }
    
                break;

                default:
 echo "<td>".$themeArray[$i]['isPost']."</th>"; 
} 
 ?>
<?php switch($themeArray['executeBy'][$i]) {  
 case 'isDefault':

                case 'isNew':

                case 'isDraft':

                case 'isUpdate':

                case 'isDelete':

                case 'isActive':

                case 'isApproved':

                case 'isReview':

                case 'isPost':

                    if($_SESSION ['isAdmin'] ==1) {
  echo "<td>".$themeArray[$i]['executeBy']."</th>"; 
      }
    
                break;

                default:
 echo "<td>".$themeArray[$i]['executeBy']."</th>"; 
} 
 ?>
<?php switch($themeArray['executeTime'][$i]) {  
 case 'isDefault':

                case 'isNew':

                case 'isDraft':

                case 'isUpdate':

                case 'isDelete':

                case 'isActive':

                case 'isApproved':

                case 'isReview':

                case 'isPost':

                    if($_SESSION ['isAdmin'] ==1) {
  echo "<td>".$themeArray[$i]['executeTime']."</th>"; 
      }
    
                break;

                default:
 echo "<td>".$themeArray[$i]['executeTime']."</th>"; 
} 
 ?>
            </tr> 
        </thead> 
        <tbody id=tableBody> 
        <?php } 
              if ($_POST['method'] == 'read' && $_POST['type'] == 'list' && $_POST['detail'] == 'body') { 
              if (is_array($themeArray)) { 
                $totalRecord = 0; 
                $totalRecord = count($themeArray); 
                if ($totalRecord > 0) { 
                    for ($i = 0; $i < $totalRecord; $i++) { ?> 
                        <tr> 
 <td><a class='btn-warning btn-mini' onClick='showFormUpdate('<?php $theme->getViewPath(); ?>','<?php echo $securityToken; ?>','<?php echo intval($themeArray [$i]['$themeId']); ?>')'><i class='icon-edit  icon-white'></i>Update</a>  
                    <a class='btn-danger btn-mini' onClick='showModalDelete('<?php $theme->getControllerPath(); ?>','<?php echo $securityToken; ?>','<?php echo $themeArray [$i]['themeId']; ?>','<?php echo $themeArray [$i]['themeSequence']; ?>','<?php echo $themeArray [$i]['themeCode']; ?>','<?php echo $themeArray [$i]['themeNote']; ?>','<?php echo $themeArray [$i]['themePath']; ?>','<?php echo $themeArray [$i]['isDefault']; ?>','<?php echo $themeArray [$i]['isNew']; ?>','<?php echo $themeArray [$i]['isDraft']; ?>','<?php echo $themeArray [$i]['isUpdate']; ?>','<?php echo $themeArray [$i]['isDelete']; ?>','<?php echo $themeArray [$i]['isActive']; ?>','<?php echo $themeArray [$i]['isApproved']; ?>','<?php echo $themeArray [$i]['isReview']; ?>','<?php echo $themeArray [$i]['isPost']; ?>','<?php echo $themeArray [$i]['executeBy']; ?>','<?php echo $themeArray [$i]['executeTime']; ?>',)'><i class='icon-trash  icon-white'></i> Delete</a></td> 
<?php switch($themeArray[$i]['themeSequence']) {  
 case 'isDefault':

                case 'isNew':

                case 'isDraft':

                case 'isUpdate':

                case 'isDelete':

                case 'isActive':

                case 'isApproved':

                case 'isReview':

                case 'isPost':

                    if($_SESSION ['isAdmin'] ==1) {
 echo "<td>".$themeArray[$i]['themeSequence']."</td>"; 
}
    
                break;

                default:
echo "<td>".$themeArray[$i]['themeSequence']."</td>"; 
 } ?><?php switch($themeArray[$i]['themeCode']) {  
 case 'isDefault':

                case 'isNew':

                case 'isDraft':

                case 'isUpdate':

                case 'isDelete':

                case 'isActive':

                case 'isApproved':

                case 'isReview':

                case 'isPost':

                    if($_SESSION ['isAdmin'] ==1) {
 echo "<td>".$themeArray[$i]['themeCode']."</td>"; 
}
    
                break;

                default:
echo "<td>".$themeArray[$i]['themeCode']."</td>"; 
 } ?><?php switch($themeArray[$i]['themeNote']) {  
 case 'isDefault':

                case 'isNew':

                case 'isDraft':

                case 'isUpdate':

                case 'isDelete':

                case 'isActive':

                case 'isApproved':

                case 'isReview':

                case 'isPost':

                    if($_SESSION ['isAdmin'] ==1) {
 echo "<td>".$themeArray[$i]['themeNote']."</td>"; 
}
    
                break;

                default:
echo "<td>".$themeArray[$i]['themeNote']."</td>"; 
 } ?><?php switch($themeArray[$i]['themePath']) {  
 case 'isDefault':

                case 'isNew':

                case 'isDraft':

                case 'isUpdate':

                case 'isDelete':

                case 'isActive':

                case 'isApproved':

                case 'isReview':

                case 'isPost':

                    if($_SESSION ['isAdmin'] ==1) {
 echo "<td>".$themeArray[$i]['themePath']."</td>"; 
}
    
                break;

                default:
echo "<td>".$themeArray[$i]['themePath']."</td>"; 
 } ?><?php switch($themeArray[$i]['isDefault']) {  
 case 'isDefault':

                case 'isNew':

                case 'isDraft':

                case 'isUpdate':

                case 'isDelete':

                case 'isActive':

                case 'isApproved':

                case 'isReview':

                case 'isPost':

                    if($_SESSION ['isAdmin'] ==1) {
 echo "<td>".$themeArray[$i]['isDefault']."</td>"; 
}
    
                break;

                default:
echo "<td>".$themeArray[$i]['isDefault']."</td>"; 
 } ?><?php switch($themeArray[$i]['isNew']) {  
 case 'isDefault':

                case 'isNew':

                case 'isDraft':

                case 'isUpdate':

                case 'isDelete':

                case 'isActive':

                case 'isApproved':

                case 'isReview':

                case 'isPost':

                    if($_SESSION ['isAdmin'] ==1) {
 echo "<td>".$themeArray[$i]['isNew']."</td>"; 
}
    
                break;

                default:
echo "<td>".$themeArray[$i]['isNew']."</td>"; 
 } ?><?php switch($themeArray[$i]['isDraft']) {  
 case 'isDefault':

                case 'isNew':

                case 'isDraft':

                case 'isUpdate':

                case 'isDelete':

                case 'isActive':

                case 'isApproved':

                case 'isReview':

                case 'isPost':

                    if($_SESSION ['isAdmin'] ==1) {
 echo "<td>".$themeArray[$i]['isDraft']."</td>"; 
}
    
                break;

                default:
echo "<td>".$themeArray[$i]['isDraft']."</td>"; 
 } ?><?php switch($themeArray[$i]['isUpdate']) {  
 case 'isDefault':

                case 'isNew':

                case 'isDraft':

                case 'isUpdate':

                case 'isDelete':

                case 'isActive':

                case 'isApproved':

                case 'isReview':

                case 'isPost':

                    if($_SESSION ['isAdmin'] ==1) {
 echo "<td>".$themeArray[$i]['isUpdate']."</td>"; 
}
    
                break;

                default:
echo "<td>".$themeArray[$i]['isUpdate']."</td>"; 
 } ?><?php switch($themeArray[$i]['isDelete']) {  
 case 'isDefault':

                case 'isNew':

                case 'isDraft':

                case 'isUpdate':

                case 'isDelete':

                case 'isActive':

                case 'isApproved':

                case 'isReview':

                case 'isPost':

                    if($_SESSION ['isAdmin'] ==1) {
 echo "<td>".$themeArray[$i]['isDelete']."</td>"; 
}
    
                break;

                default:
echo "<td>".$themeArray[$i]['isDelete']."</td>"; 
 } ?><?php switch($themeArray[$i]['isActive']) {  
 case 'isDefault':

                case 'isNew':

                case 'isDraft':

                case 'isUpdate':

                case 'isDelete':

                case 'isActive':

                case 'isApproved':

                case 'isReview':

                case 'isPost':

                    if($_SESSION ['isAdmin'] ==1) {
 echo "<td>".$themeArray[$i]['isActive']."</td>"; 
}
    
                break;

                default:
echo "<td>".$themeArray[$i]['isActive']."</td>"; 
 } ?><?php switch($themeArray[$i]['isApproved']) {  
 case 'isDefault':

                case 'isNew':

                case 'isDraft':

                case 'isUpdate':

                case 'isDelete':

                case 'isActive':

                case 'isApproved':

                case 'isReview':

                case 'isPost':

                    if($_SESSION ['isAdmin'] ==1) {
 echo "<td>".$themeArray[$i]['isApproved']."</td>"; 
}
    
                break;

                default:
echo "<td>".$themeArray[$i]['isApproved']."</td>"; 
 } ?><?php switch($themeArray[$i]['isReview']) {  
 case 'isDefault':

                case 'isNew':

                case 'isDraft':

                case 'isUpdate':

                case 'isDelete':

                case 'isActive':

                case 'isApproved':

                case 'isReview':

                case 'isPost':

                    if($_SESSION ['isAdmin'] ==1) {
 echo "<td>".$themeArray[$i]['isReview']."</td>"; 
}
    
                break;

                default:
echo "<td>".$themeArray[$i]['isReview']."</td>"; 
 } ?><?php switch($themeArray[$i]['isPost']) {  
 case 'isDefault':

                case 'isNew':

                case 'isDraft':

                case 'isUpdate':

                case 'isDelete':

                case 'isActive':

                case 'isApproved':

                case 'isReview':

                case 'isPost':

                    if($_SESSION ['isAdmin'] ==1) {
 echo "<td>".$themeArray[$i]['isPost']."</td>"; 
}
    
                break;

                default:
echo "<td>".$themeArray[$i]['isPost']."</td>"; 
 } ?><?php switch($themeArray[$i]['executeBy']) {  
 case 'isDefault':

                case 'isNew':

                case 'isDraft':

                case 'isUpdate':

                case 'isDelete':

                case 'isActive':

                case 'isApproved':

                case 'isReview':

                case 'isPost':

                    if($_SESSION ['isAdmin'] ==1) {
 echo "<td>".$themeArray[$i]['executeBy']."</td>"; 
}
    
                break;

                default:
echo "<td>".$themeArray[$i]['executeBy']."</td>"; 
 } ?><?php switch($themeArray[$i]['executeTime']) {  
 case 'isDefault':

                case 'isNew':

                case 'isDraft':

                case 'isUpdate':

                case 'isDelete':

                case 'isActive':

                case 'isApproved':

                case 'isReview':

                case 'isPost':

                    if($_SESSION ['isAdmin'] ==1) {
 echo "<td>".$themeArray[$i]['executeTime']."</td>"; 
}
    
                break;

                default:
echo "<td>".$themeArray[$i]['executeTime']."</td>"; 
 }
 }
 }
 }?>                        </tr> 
                        <?php 
                    } 
                } else { ?> 
                    <tr> 
                        <td colspan='6'><?php $theme->exceptionMessage('No Record'); ?></td> 
                    </tr> 
                    <?php 
                } 
            } else { ?> 
                <tr> 
                    <td colspan='6'><?php $theme->exceptionMessage('Data Record Problem'); ?></td> 
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
    <div class='pagination' id='pagingHtml' name='pagingHtml'><?php $navigation->pagenationv4($offset); ?></div> 
     <script language='javascript' type='text/javascript'> 
         $(document).ready(function(){ 
            // load the system cell if session  and token exist;  
            <?php if(isset($_POST['query'])) { ?> 
                    $('#clearSearch').removeClass(); 
                    $('#clearSearch').addClass('btn'); 
            <?php } ?>  
         }); 
      </script> 
    <?php }  
           if ((isset($_POST['method']) == 'new' || isset($_POST['method']) == 'read') && $_POST['type'] == 'form') { ?> 
    <div id='infoPanel'></div> 
    <input type='hidden' name='themeId' id='themeId' value='<?php if (isset($_POST['themeId'])) { $_POST['themeId'];    } ?>'> 
<div class='control-group' id='themeSequence' >

                                <label class='control-label'><?php echo $leafTranslation['themeSequence']; ?></label>

                                <div class='controls  input-prepend'>

                                    <input type='text' name='themeSequence' id='themeSequence' placeholder='Numeric Only' class='span3'>

                                    <span name='numericHelpMe' id='themeSequenceHelpMe' class='help-inline'></span>

                                </div>

                            </div>
<div class='control-group' id='themeCode'>
                                <label class='control-label'><?php echo $leafTranslation['themeCode']; ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='themeCode' id='themeCode' placeholder='Field Of themeCode' class='span3'>
                                </div>
                            </div><div class='control-group' id='themeNote'>
                                <label class='control-label'><?php echo $leafTranslation['themeNote']; ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='themeNote' id='themeNote' placeholder='Field Of themeNote' class='span3'>
                                </div>
                            </div><div class='control-group' id='themePath'>
                                <label class='control-label'><?php echo $leafTranslation['themePath']; ?></label>
                                <div class='controls  input-prepend'>
                                    <input type='text' name='themePath' id='themePath' placeholder='Field Of themePath' class='span3'>
                                </div>
                            </div><div class='control-group' id='executeBy' >

                                <label class='control-label'><?php echo $leafTranslation['executeBy']; ?></label>

                                <div class='controls  input-prepend'>

                                    <input type='text' name='executeBy' id='executeBy' placeholder='Numeric Only' class='span3'>

                                    <span name='numericHelpMe' id='executeByHelpMe' class='help-inline'></span>

                                </div>

                            </div>
<div class='control-group' id='dateDiv'>
                                <label class='control-label'><?php echo $leafTranslation['executeTime']; ?></label>
                                <div class='controls input-prepend'>
                                    <span class='add-on'>
                                        <i class='icon-calendar'></i>
                                    </span>    
                                    <input type='date' name='executeTime' id='executeTime' placeholder='Date Validation' class='span3'>
                                    <span name='executeTimeHelpMe' id='executeTimeHelpMe' class='help-inline'></span>
                                </div>
                            </div>    <div class='btn-toolbar'> 
        <div class='btn-group'> 
            <a  name='auditRecordButton' id='auditRecordButton'  href='javascript:void(0)' 
    class='<?php if($leafAccess['isDraft']==0) { ?>btn btn-warning disabled<?php } else { ?>btn btn-warning<?php } ?>' 
    onClick='<?php if($leafAccess['isDraft']==1) { ?>) { ?>auditRecord()<?php } ?>'><i class='icon-warning-sign icon-white'></i><?php echo $button['isAuditLabel']; ?></a> 
        </div>        <div class='btn-group'>            <a  name='newRecordButton1' id='newRecordButton1'  href='javascript:void(0)' class='<?php if($leafAccess['isNew']==0) { ?>btn btn-success disabled<?php } else { ?>btn btn-success  <?php } ?>'><i class='icon-plus icon-white'></i><?php echo $button['isNewLabel']; ?></a> 
            <a  name='newRecordButton2' id='newRecordButton2'   href='javascript:void(0)' data-toggle='dropdown' class='btn dropdown-toggle btn-success  disabled'><span class='caret'></span></a> 
            <ul class='dropdown-menu'> 
                <li><a  name='newRecordButton3' id='newRecordButton3'   href='javascript:void(0)' onClick='<?php if($leafAccess['isNew']==1) { ?>newRecord(1) <?php } ?>' class='<?php if($leafAccess['isNew']==0) { ?>disabled<?php } ?>'><i class='icon-plus'></i><?php echo $button['isNewLabel'][0]; ?></a></li> 
                <li><a  name='newRecordButton4' id='newRecordButton4'   href='javascript:void(0)' onClick='<?php if($leafAccess['isNew']==1) { ?>newRecord(2) <?php } ?>' class='<?php if($leafAccess['isNew']==0) { ?>disabled<?php } ?>'><i class='icon-edit'></i><?php echo $button['isNewLabel'][1]; ?></a></li> 
                <li><a  name='newRecordButton5' id='newRecordButton5'   href='javascript:void(0)' onClick='<?php if($leafAccess['isNew']==1) { ?>newRecord(3) <?php } ?>' class='<?php if($leafAccess['isNew']==0) { ?>disabled<?php } ?>'><i class='icon-print'></i><?php echo $button['isNewLabel'][2]; ?></a></li> 
                <li><a  name='newRecordButton6' id='newRecordButton6'    href='javascript:void(0)' onClick='<?php if($leafAccess['isNew']==1) { ?>newRecord(4) <?php } ?>' class='<?php if($leafAccess['isNew']==0) { ?>disabled<?php } ?>'><i class='icon-print'></i><?php echo $button['isNewLabel'][3]; ?></a></li> 
                <li><a  name='newRecordButton7' id='newRecordButton7'    href='javascript:void(0)' onClick='<?php if($leafAccess['isNew']==1) { ?>newRecord(5) <?php } ?>' class='<?php if($leafAccess['isNew']==0) { ?>disabled<?php } ?>'><i class='icon-list'></i><?php echo $button['isNewLabel'][4]; ?></a></li> 
            </ul> 
        </div> 
        <div class='btn-group'> 
            <a  name='updateRecordButton1' id='updateRecordButton'   href='javascript:void(0)' class='<?php if($leafAccess['isUpdate']==0) { ?>btn btn-info  disabled<?php } else { ?>btn btn-info <?php } ?>'><i class='icon-edit icon-white'></i><?php echo $button['isUpdateLabel']; ?></a> 
            <a  name='updateRecordButton2' id='updateRecordButton'    href='javascript:void(0)' data-toggle='dropdown' class='btn dropdown-toggle btn-info  disabled'><span class='caret'></span></a> 
            <ul class='dropdown-menu'> 
                <li><a  name='updateRecordButton3' id='updateRecordButton'    href='javascript:void(0)'  onClick='<?php if($leafAccess['isUpdate']==1) { ?>updateRecord(1)<?php } ?>' class='<?php if($leafAccess['isUpdate']==0) { ?>disabled <?php } ?>'><i class='icon-plus'></i><?php echo $button['isUpdateLabel'][0]; ?></a></li> 
                <li><a  name='updateRecordButton4' id='updateRecordButton'    href='javascript:void(0)' onClick='<?php if($leafAccess['isUpdate']==1) { ?>updateRecord(2)<?php } ?>' class='<?php if($leafAccess['isUpdate']==0) { ?>disabled <?php } ?>'><i class='icon-print'></i><?php echo $button['isUpdateLabel'][1]; ?></a></li> 
               <li><a  name='updateRecordButton5' id='updateRecordButton'    href='javascript:void(0)' onClick='<?php if($leafAccess['isUpdate']==1) { ?>updateRecord(3)<?php } ?>' class='<?php if($leafAccess['isUpdate']==0) { ?>disabled <?php } ?>'><i class='icon-list-alt'></i><?php echo $button['isUpdateLabel'][2]; ?></a></li> 
            </ul> 
        </div> 
        <div class='btn-group'> 
            <a  name='deleteRecordButton' id='deleteRecordButton'  href='javascript:void(0)' class='<?php if($leafAccess['isDelete']==0) { ?>btn btn-danger  disabled<?php } else { ?>btn btn-danger<?php } ?>'  onClick='<?php if($leafAccess['isDelete']==1) { ?>deleteRecord()<?php } ?>'><i class='icon-trash icon-white'></i><?php echo $button['isDeleteLabel']; ?></a> 
        </div> 
        <div class='btn-group'>            <a  name='resetRecordButton' id='resetRecordButton'  href='javascript:void(0)' class='btn btn-info' onClick='resetRecord()'><i class='icon-refresh icon-white'></i>echo $button['isResetLabel']; ?></a> 
        </div> 
        <div class='btn-group'>            <a  name='postRecordButton' id='postRecordButton' href='javascript:void(0)' class='<?php if($leafAccess['isPost']==0) { ?>btn btn-warning  disabled<?php } else { ?>btn btn-warning<?php } ?>'  onClick='<?php if($leafAccess['isPost']==1) { ?>postRecord()<?php } ?>'><i class='icon-cog icon-white'></i><?php echo $button['isPostLabel']; ?></a> 
        </div> 
        <div class='btn-group'>            <a  name='listRecordButton' id='listRecordButton' href='javascript:void(0)' class='btn btn-info' onClick='showGrid('<?php $theme->getViewPath(); ?>','<?php echo $securityToken; ?>',0,<?php echo LIMIT; ?>)'><i class='icon-list icon-white'></i>Listing</a> 
        </div> 
        <div class='btn-group'> 
            <a  name='firstRecordButton' id='firstRecordButton' href='javascript:void(0)' class='btn btn-info  disabled' onClick='firstRecord()'><i class='icon-fast-backward icon-white'></i><?php echo $defaultTranslation['firstButtonLabel']; ?></a> 
        </div> 
        <div class='btn-group'> 
            <a  name='previousRecordButton' id='previousRecordButton'  href='javascript:void(0)' class='btn btn-info  disabled' onClick='previousRecord()'><i class='icon-backward icon-white'></i><?php echo $defaultTranslation['previousButtonLabel']; ?></a> 
        </div> 
        <div class='btn-group'> 
            <a  name='nextRecordButton' id='nextRecordButton'  href='javascript:void(0)' class='btn btn-info  disabled' onClick='nextRecord()'><i class='icon-forward icon-white'></i><?php echo $defaultTranslation['nextButtonLabel']; ?></a> 
        </div> 
        <div class='btn-group'> 
            <a  name='lastRecordButton' id='lastRecordButton'  href='javascript:void(0)' class='btn btn-info disabled' onClick='lastRecord()'><i class='icon-fast-forward icon-white'></i><?php echo $defaultTranslation['endButtonLabel']; ?></a> 
       </div> 
    </div> 
    <input type='hidden' name='x' id='x'> 
    <input type='hidden' name='firstRecord' id='firstRecord' value='<?php if(isset($firstRecord)) { echo $firstRecord; } ?>'> 
    <input type='hidden' name='nextRecord' id='nextRecord' value='<?php if(isset($nextRecord)) { echo $nextRecord; } ?>'> 
    <input type='hidden' name='previousRecord' id='previousRecord' value='<?php if(isset($previousRecord)) { echo $previousRecord; } ?>'> 
    <input type='hidden' name='lastRecord' id='lastRecord' value='<?php if(isset($lastRecord)) { echo $lastRecord; } ?>'> 
    <input type='hidden' name='endRecord' id='endRecord' value='<?php if(isset($endRecord)) { echo $endRecord; } ?>'> 
    <script language='javascript' type='text/javascript'> 
         $(document).ready(function(){  
validateMeNumeric('<?php echo $data[0]['columnName']; ?>') 
validateMeNumeric('<?php echo $data[1]['columnName']; ?>') 
validateMeAlphaNumeric('<?php echo $data[2]['columnName']; ?>') 
validateMeAlphaNumeric('<?php echo $data[3]['columnName']; ?>') 
validateMeAlphaNumeric('<?php echo $data[4]['columnName']; ?>') 
validateMeNumeric('<?php echo $data[14]['columnName']; ?>') 
 $('#<?php echo $data[15]['columnName']; ?>').dateinput({ 
    format :'dd mmm yyyy'
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
            <?php } else { ?> 
            <?php } ?>  
         }); 
    </script> 
<?php } ?> 
<script language='javascript' type='text/javascript' src='./package/system/common/theme/javascript/original/theme.js'></script> 