<?php
namespace Core\Cms\Controller;
require_once './package/module/index/view/indexView.php';
//require_once './package/module/index/service/indexService.php';
//require_once './package/user/model/userModel.php'; 

class indexController {
    private $indexView;
    function __construct() {
        $this->indexView = new \Core\Cms\View\indexView();
    }
    function execute() {
       $this->indexView();
    }
    function indexView() {
        
        $this->indexView->indexView();
       
    }
}
$x = new indexController();
$x->execute();
?>
