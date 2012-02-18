<?php

namespace Core\Portal\View;

require_once ("/../../../../library/class/classAbstract.php");
require_once('/../service/portalService.php');

class PortalViewClass extends \Core\ConfigClass {
    /*
     *  File /View /Json to execute
     *  var templateFile
     */

    public $templateFile;
    /*
     *  Template Path
     *  var templatePath
     */
    public $templatePath;
    /*
     *  Full path  = templatePath  + templateFilename
     *  var fullPathname
     */
    public $fullPathname;
    public $block;
    public $q;

    function __construct() {
        $this->templatePath = $_SERVER['DOCUMENT_ROOT']."/x/package/portal/main/view/template/";

        //  $this->q = new \Core\Database\Mysql\Vendor();
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

    function htmlView($templatefile = null) {
        // this include .tpl file
        $this->templateFile = $templatefile;
         

        if (empty($this->templateFile)) {

            require_once '/../../problem/nopage.php';
        } else {
            // check path if the file exist
          $this->fullPathname = $this->templatePath . $this->templateFile;
            require_once($this->fullPathname);

            if (file_exists($this->fullPathname)) {
                $this->blockDiv();
                // check security if the person authorize or not.
                //  if ($this->q->security($this->templateFile) == 1) {
                require_once($this->fullPathname);
                //  } else {
                //      require_once '/../../../problem/noaccess.php';
                // }
            } else {
                      require_once '/../../../problem/nofile.php';
            }
        }
    }

    function blockDiv() {
        
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