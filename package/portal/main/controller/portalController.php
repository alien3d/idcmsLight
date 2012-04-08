<?php

namespace Core\Portal\Controller;

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
        $this->portalServiceDefault->authentication($this->model->getUsername(), $this->model->getPassword());
    }

    public function route() {
        $this->portalServiceMenu->route($this->getPageId(), $this->getPageType());
    }

}

$portal = new PortalControllerClass();
// bind varaiable
if (isset($_POST['pageId'])) {
    $portal->setPageId($_POST['pageId']);
}
if (isset($_POST['pageType'])) {

    $portal->setPageType($_POST['pageType']);
}
$portal->execute();
if (isset($_POST['username']) && isset($_POST['password'])) {
    $portal->authentication();
}
if (isset($_POST['method'])) {
    if ($_POST['method'] == 'read') {

        $portal->route();
    }
}
?>
