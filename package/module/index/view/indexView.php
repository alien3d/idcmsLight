<?php
namespace Core\Cms\View;
//require_once('./service/index.php');
  class indexView {
    public $templateFile;
    public $pathFile;
    public $fullPathname;
    public $block;
    function __construct() {
        $this->pathFile = "../package/index/view/";
        
    }

    function indexView($templatefile = null) {
        // this include .tpl file
        $this->templateFile = $templatefile;
        if (empty($this->templateFile)) {
            
            require_once '/../../problem/nopage.php';
        } else {
            // check path if the file exist
            $this->fullPathname = $this->pathFile . $this->templateFile;
            if (file_exists($this->templateFile)) {
                $this->blockDiv();

                include_once($this->fullPathname);
            } else {
                require_once '/../../problem/nofile.php';


            }
        }
    }

    function blockDiv($block) {
        switch($block){
            case 'courosel':
                
            break;
            case 'intro1':
            break;
            case 'intro2':
            break;
            case 'intro3':
            break;    
        }
    }

    /*
     * Ouput Json Output
     */

    function jsonView($success, $data) {
        echo json_encode(array("success" => $success, "data" => $data));
    }

    /*
     * Ouput Xml Output
     */

    function xmlView() {
        
    }

    /*
     * Ouput Web Service Output
     */

    function webserviceView() {
        
    }

}