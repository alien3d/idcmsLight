<?php

namespace Core\Portal\Controller;

require_once './library/class/classValidation.php';
require_once './package/portal/main/view/portalView.php';
require_once './package/portal/main/service/portalService.php';
require_once './package/system/management/model/staffModel.php';

class PortalControllerClass extends \Core\Validation\ValidationClass {

    private $portalView;
    private $portalService;
    private $staffModel;

    function __construct() {
        $this->portalView = new \Core\Portal\View\PortalViewClass();
        $this->portalService = new \Core\Portal\Service\PortalServiceClass();
        $this->staffModel = new \Core\System\Management\Staff\Model\StaffModel();
    }

    function create() {
        
    }

    function read() {
        
    }

    function update() {
        
    }

    function delete() {
        
    }

    /**
     * Assign Post  / Get Variable to The Model
     */
    private function getVariable() {
        if (isset($_POST['username'])) {
                  $this->staffModel->setStaffName($this->strict($_POST['username'],'string'));
        }
        if (isset($_POST['password'])) {
                  $this->staffModel->setStaffPassword($this->strict($_POST['password'],'password'));
        }
    }

    /**
     *  main function
     */
    public function execute() {
        $this->getVariable();       
        if ($this->staffModel->getStaffName() && $this->staffModel->getStaffPassword()) {
            // Start Initilization Portal Service Class
            $this->portalService->execute();
            // process the  login
            $returnArray = $this->portalService->authentication($this->staffModel->getStaffName(),$this->staffModel->getStaffPassword());
            $this->portalView->jsonView($returnArray['success'], $returnArray['message'], $returnArray['start']);            
        } else {
            // index page view.
            $this->portalView->htmlView("portal.php", "portal");
        }

    }

}
$x = new PortalControllerClass();
$x->execute();
?>
