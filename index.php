<?php

namespace Core\Portal\Controller;

require_once './library/class/classValidation.php';
require_once './package/portal/main/view/portalView.php';
require_once './package/portal/main/service/portalService.php';

//require_once './package/system/user/model/userModel.php'; 

class PortalControllerClass extends \Core\Validation\ValidationClass {

    private $portalView;
    private $portalService;
    private $userModel;

    function __construct() {
        $this->portalView = new \Core\Portal\View\PortalViewClass();
         $this->portalService    = new \Core\Portal\Service\PortalServiceClass();
        //     $this->userModel        = new \Core\Admin\Model\UserModelClass();
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
    function getVariable() {
        if (isset($_POST['username'])) {
            //      $this->userModel->setUsername($this->strict($_GET['username'],'string'));
        }
        if (isset($_POST['password'])) {
            //      $this->userModel->setPassword($this->strict($_GET['password'],'password'));
        }
    }

    /**
     *  main function
     */
    function execute() {
        $this->getVariable();
        /*
          if($this->userModel->getUsername() && $this->userModel->getUsername()){
          $id=$this->portalService->processLogin();

          if($id==0){
          // cannot be found
          $this->portalView->jsonView("access","denied");
          }  else {
          // authorize access
          $this->portalView->jsonView("access","granted");
          }
          }  else {
          $this->portalView->htmlView("index.php","portal");
          }
         * 
         */
        $this->portalView->htmlView("portal.php", "portal");
    }

}

$x = new PortalControllerClass();
$x->execute();
?>
