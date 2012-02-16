<?php
namespace Core\Login\Controller;
session_start();
require_once ("../../class/classValidation.php");
require_once ("../view/loginView.php");
require_once ("../service/loginService.php");
class LoginController  extends ValidationClass {
	private $model;
    private $service;
	function __construct() {
		
	}
	/**
     * Class Loader
     */
    public function execute() {
		// service
		$this->service = new LoginService ();
        $this->service->execute();
		// model sceleton
        $this->model = new StaffModel ();
        $this->model->setVendor($this->service->getVendor());
		if (isset ( $_POST ['staffName'] )) {
			$this->model->setStaffName ( $this->strict ( $_POST ['staffName'], 'password' ) );
		}
		if (isset ( $_POST ['staffPassword'] )) {
			$this->model->setStaffPassword ( $this->strict ( $_POST ['staffPassword'], 'password' ) );
		}
        $this->model->execute();
		
    }
	public function create() {
		$this->service->create();
	}
	public function read() {
		$this->service->read();
	}
	public function update() {
		$this->service->update();
	} 
	public function delete() {
		$this->service->delete();
	}
    public function excel() {
	}
	private function setCheckLogin() {
		$this->model->setStaffId($this->service->checkInfo($this->model->getStaffName(),$this->model->getStaffPassword()));
	}
	private function getCheckLogin() { 
		$this->access=$this->service->checkLogin($this->model->getStaffId());
	}
	public function indexView() {
		$this->view->indexView();
	}
    public function jsonView() { 
		$this->view->jsonView($this->access);
    } 	
}
$loginObject  = new LoginController();
if(isset($_POST['staffId'])) { 
	$this->setStaffId($_POST['staffId']);
} 
$loginObject->execute();
if($_POST['mode']=='html') {
	$loginObject->indexView();
}
if($_POST['authorization']==1) { 
	$loginObject->jsonView();
}
 
?>