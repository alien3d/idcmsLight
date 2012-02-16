<?php

namespace core\Controller\SLG;
require_once("default.php");
require_once("namespaceModel.php"); // odd but no choice
require_once("namespaceView.php"); // odd but no choice
use \core;
class admin extends \core\basicController {

    public $adminModel;
    public $adminView;

    function execute() {

        $this->adminModel = new \core\Model\SLG\admin;
        $this->adminView = new \core\View\SLG\admin();
    }

    function indexView() {
        $this->adminView->indexView($this->adminModel);
    }

}

class email extends \core\basicController {

    public $emailModel;
    public $emailView;

    function execute() {

        $this->emailModel = new \core\Model\SLG\email();
        $this->emailView = new \core\View\SLG\email();
    }

    function indexView() {

        $this->emailView->indexView($this->emailModel);
    }

}

$a = new admin;
$a->execute();
$a->indexView();
//$e = new email();
//$e->execute();
//$e->indexView()
?>