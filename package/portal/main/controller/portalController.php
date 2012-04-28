<?php

namespace Core\Portal\Controller;

if (!isset($_SESSION)) {
    session_start();
}

require_once ("/../../../../library/class/classAbstract.php");
require_once ("/../../../system/management/model/staffModel.php");
require_once("../service/portalService.php");

class PortalControllerClass extends \Core\ConfigClass {

    /**
     * Connection DatabaseObject
     * @var string
     */
    public $q;

    /**
     * @var string
     */
    public $model;

    /**
     * @var string
     */
    public $staffWebAccess;
    public $portalServiceDefault;
    public $portalServiceMenu;
    private $applicationId;
    private $moduleId;
    private $folderId;
    private $leafId;
    function __construct() {
        
    }

    /**
     *  main function
     */
    public function execute() {
        parent::__construct();
        $this->q = new \Core\Database\Mysql\Vendor();


        $this->q->vendor = $this->getVendor();
        $this->q->setRequestDatabase($this->q->getCoreDatabase());
        $this->q->connect($this->getConnection(), $this->getUsername(), $this->getDatabase(), $this->getPassword());

        $this->model = new \Core\System\Management\Staff\Model\StaffModel();
        $this->model->setVendor($this->getVendor());
        $this->model->execute();

        $this->portalServiceDefault = new \Core\Portal\Service\DefaultClass();
        $this->portalServiceDefault->execute();
        $this->portalServiceMenu = new \Core\Portal\Service\MenuNavigatonClass();
        $this->portalServiceMenu->execute();
    }

    function create() {
        
    }

    function read() {
        
    }

    function update() {
        
    }

    function delete() {
        
    }

    function excel() {
        
    }

    public function authentication() {
        $this->portalServiceDefault->authentication($this->model->getStaffName(), $this->model->getStaffPassword());
    }

    public function routeApplication() {
        $this->portalServiceMenu->route($this->getPageId(), $this->getPageType());
    }
    public function routeModule() {
        $this->portalServiceMenu->route($this->getModuleId(), $this->getPageType());
    }
    public function routeFolder() {
        $this->portalServiceMenu->route($this->getFolderId(), $this->getPageType());
    }
    public function routeLeaf() {
        $this->portalServiceMenu->route($this->getLeafId(), $this->getPageType());
    }

    
    public function routeMenu() { 
        
        $data = $this->portalServiceMenu->application();
        $this->renderMenu($data);
    }
    public function routeSidebar() {
        $data = $this->portalServiceMenu->folder($this->getApplicationId(), $this->getModuleId());
        $avatar = './images/Blueticons_Win/PNGs/Devil.png';
        $this->renderSidebar($avatar, $data);
    }
   
    public function renderSidebar($avatar, $folder) {
        $str = "";
        $d = 0;
        $str.="

            <a href=javascript:void(0) class='thumbnail'><img src='" . $avatar . "' width='75' height='75'></a>
                        <hr>

                    ";
        $str.="<ul class='nav nav-list'>";
        $totalFolder = count($folder);
        for ($i = 0; $i < $totalFolder; $i++) {
            $d++;
            $str.="
            <li class       = 'nav-header'
                onclick     = showMeSideBar(" . intval($folder[$i]['folderId']) . "," . intval($totalFolder) . ")
                onmouseover = showMeSideBar(" . intval($folder[$i]['folderId']) . "," . intval($totalFolder) . ")>

            " . $folder[$i]['folderNative'] . "</li>";
            $totalLeaf = count($folder[$i]['leaf']);
            if ($totalLeaf > 0) {
                $str.="<li  id='common" . $d . "' class='hide'><ul class='nav nav-list'>";
            }
            for ($j = 0; $j < $totalLeaf; $j++) {
                $str.="<li ><a href=javascript:void(0) onclick=loadLeft(" . intval($folder[$i]['leaf'][$j]['leafId']) . ",'".$this->getSecurityToken()."')><img src='images/icons/application-form.png' alt='application'> " . $folder[$i]['leaf'][$j]['leafNative'] . "</a><div id=choosenLeaf".$i."></div></li>";
            }
            if ($totalLeaf > 0) {
                $str.="</ul></li>";
            }
        }

        $str.="</ul>";

        echo $str;
    }

    public function renderMenu($application) {
        $str = "";
        $str.="<a class='btn btn-navbar' data-toggle='collapse' data-target='.nav-collapse'>";
        $totalApplication = count($application);
        for ($i = 0; $i < $totalApplication; $i++) {
            $str.="<span class='i-bar'></span>";
        }
        $str .= "</a>
        <a class='brand' href='index.php'>Core</a>
        <div class='nav-collapse'>
                <ul class='nav'>";

        // cms menu router
        if (isset($application)) {
            $totalApplication = count($application);
            for ($i = 0; $i < $totalApplication; $i++) {
                $totalModule = 0;
                if (isset($application[$i]['module'])) {
                    $totalModule = count($application[$i]['module']);
                }
                if ($totalModule == 0) {
                    $str.="<li class='active'><a href='javascript:void(0)' onClick=loadBelow(" . intval($application[$i]['applicationId']) . ",'','','','application')>";


                    if (isset($application[$i]['applicationNative'])) {
                        $str.=$application[$i]['applicationNative'];
                    }
                    $str.="</a></li>";
                } else {
                    $str.="<li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href=''>" . $application[$i]['applicationNative'] . "<b class='caret'></b></a>";

                    $str.="<ul class='dropdown-menu'>";
                    for ($j = 0; $j < $totalModule; $j++) {
                        if($application[$i]['module'][$j]['isSingle']==1) { 
                           $str.="<li><a href='javascript:void(0)' onClick=loadBelow(".intval($application[$i]['applicationId']).",".intval($application[$i]['module'][$j]['moduleId']).",'','','module')>" . $application[$i]['module'][$j]['moduleNative'] . "</a></li>";

                        } else {
                        $str.="<li><a href='javascript:void(0)' 
onClick=loadSidebar(" . intval($application[$i]['applicationId']) . "," . intval($application[$i]['module'][$j]['moduleId']) . ")>" . $application[$i]['module'][$j]['moduleNative'] . "</a></li>";
                    }
                    }
                    $str.="</ul>";
                }
                $str.="</li>";
            }
        }

        $str.="</ul></div>
                    <!--/.nav-collapse -->
                    <div id='loginArea' class='navbar-text pull-right'>
                        <p class='navbar-text pull-right'>Logged in as <a href='javascript:void(0)'><i class='icon-user icon-white'></i>".$_SESSION['staffName']."</a> | <a href='' ><i class='icon-fire icon-white'></i>Notification</a> | <a href='logout.php'><i class='icon-home icon-white'></i>Logout</a></p>
                    </div>
               ";
        echo $str;
       
    }

    /**
     * Set Application Identification
     * @param numeric $applicationId
     * */
    public function setApplicationId($value) {
        $this->applicationId = $value;
    }

    /**
     * Return Application Identification
     * @return numeric $applicationId
     * */
    public function getApplicationId() {
        return $this->applicationId;
    }

    /**
     * Set Module Identification
     * @param numeric $moduleId
     * */
    public function setModuleId($value) {
        $this->moduleId = $value;
    }

    /**
     * Return Module Identification
     * @return numeric $moduleId
     * */
    public function getModuleId() {
        return $this->moduleId;
    }

    /**
     * Set Folder Identification
     * @param numeric $folderId
     * */
    public function setFolderId($value) {
        $this->folderId = $value;
    }

    /**
     * Return Folder Identification
     * @return numeric $folderId
     * */
    public function getFolderId() {
        return $this->folderId;
    }
    /**
     * Set Leaf Identification
     * @param numeric $leafId
     * */
    public function setLeafId($value) {
        $this->leafId = $value;
    }

    /**
     * Return Leaf Identification
     * @return numeric $leafId
     * */
    public function getLeafId() {
        return $this->leafId;
    }

}

$portal = new PortalControllerClass();
// bind varaiable
if (isset($_POST)) {
    if (isset($_POST['pageId']) && strlen($_POST['pageId']) > 0) {
         $portal->setPageId($_POST['pageId']);
    }
    if (isset($_POST['moduleId']) && strlen($_POST['moduleId']) > 0) {
         $portal->setModuleId($_POST['moduleId']);
    }
    if (isset($_POST['folderId']) && strlen($_POST['folderId']) > 0) {
         $portal->setFolderId($_POST['folderId']);
    }
    if (isset($_POST['leafId']) && strlen($_POST['leafId']) > 0) {
         $portal->setLeafId($_POST['leafId']);
    }
    if (isset($_POST['pageType']) && strlen($_POST['pageType']) > 0) {

         $portal->setPageType($_POST['pageType']);
    }
    $portal->execute();
    if (isset($_POST['username']) && isset($_POST['password'])) {

        $portal->authentication();
    }
    if (isset($_POST['method'])) {
                                                 
        if (isset($_POST['pageType'])) {
            if ($_POST['method'] == 'read' && $_POST['pageType'] == 'application') {
                $portal->routeApplication();
            }
            if ($_POST['method'] == 'read' && $_POST['pageType'] == 'module') {
                $portal->routeModule();
            }
            if ($_POST['method'] == 'read' && $_POST['pageType'] == 'folder') {
                $portal->routeFolder();
            }
            if ($_POST['method'] == 'read' && $_POST['pageType'] == 'leaf') {
                $portal->routeLeaf();
            }
            if($_POST['method']=='read' && $_POST['pageType']=='menu') { 
                if (isset($_POST['leafId'])) {
                    $portal->setLeafId($_POST['leafId']);
                }
                $portal->routeMenu();
            }
            if ($_POST['method'] == 'read' && $_POST['pageType'] == 'sidebar') {
                if (isset($_POST['applicationId'])) {
                    $portal->setApplicationId($_POST['applicationId']);
                }
                if (isset($_POST['moduleId'])) {
                    $portal->setModuleId($_POST['moduleId']);
                }
                $portal->routeSidebar();
            }
            
        }
    }
}
?>
