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
    
    /*
     *  Defaulte template is bootstrap twitter or predefine in the database
     */    
    public $defaultCss;
    /*
     *  Randomize css .
     */ 
    public $defaultCssRandom;
    public $cssRandom;
    public $block;
    public $q;

    function __construct() {
        
        if($this->defaultCssRandom==1) {
           $this->cssRandom[0] ='bootstrap';
           $this->cssRandom[1] ='cyborg';
           $this->cssRandom[2] ='journal';
           $this->cssRandom[3] ='simplex';
           $this->cssRandom[4] ='slate';
           $this->cssRandom[5] ='spacelab';
           $this->cssRandom[6] ='spruce';
           $this->cssRandom[7] ='superhero';
           $this->cssRandom[7] ='ubuntu';
           shuffle($this->cssRandom);
           $this->defaultCss = $this->cssRandom[0];  
        } else {
            $this->defaultCss   = 'journal';
        }
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

    /**
     * Ouput Json Output
     * @params success boolean TRUE or FALSE  
     * @params message System Message
     * @params total Total Record Output
     * @params time Execute Time Per Page
     * @params data Array Of data to send as Ajax Request Respond
     * @params firstRecord  First Record For Paging Navigation ( Form Entry )
     * @params previousRecord   Previous Record For Paging Navigation ( Form Entry )
     * @params nextRecord   Next Record For Paging Navigation ( Form Entry )
     * @params last record Last/End Record For Paging Navigation ( Form Entry )
     */

    function jsonView($success, $message, $start, $total = 0,$data=null, $firstRecord = null, $previousRecord = null, $nextRecord = null, $lastRecord = null) {
         header('Content-Type:application/json; charset=utf-8');
         $end = microtime(true);
         $time = $end - $start;
         	echo json_encode(array(
            	'success' =>$success, 
            	'message' => $message, 
                'total' => $total,             	
            	'time' => $time, 
            	'firstRecord' => $firstRecord, 
            	'previousRecord' => $previousRecord, 
            	'nextRecord' => $nextRecord, 
            	'lastRecord' => $lastRecord, 
            	'data' => $data));
                exit();
                
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