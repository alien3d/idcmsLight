<?php

namespace Core\Paging;

/**
 * Paging Class 
 */
class HtmlPaging {

    /**
     *  Total Record  
     *  @var totalRecord int
     */
    private $offset;

    /**
     *  Limit Per Entry Output
     *  @var limit int
     */
    private $limit;

    /**
     *  Page Per Page
     *  @var limit int
     */
    private $pages;

    /**
     *  Total Record  
     *  @var totalRecord int
     */
    private $totalRecord;

    /**
     *  Total Record  
     *  @var totalRecord int
     */
    private $newOffset;

    /**
     *  View Path
     *  @var limit string
     */
    private $viewPath;

    /**
     * Return String pagenation
     * @var type 
     */
    private $stringOutput;
     /**
     * Return Security Token
     * @var string 
     */
    private $securityToken;
    

    function __construct() {
        $this->pages = 5;
    }

    /**
     * Set Start Number Per Page
     * @param int $value
     */
    public function setOffset($value) {
        $this->offset = $value;
    }

    /**
     * Return Start Number Per Page
     * @return int
     */
    public function getOffset() {
        return $this->offset;
    }

    /**
     * Set Start Number Per Page
     * @param int $value
     */
    public function setNewOffset($value) {
        $this->newOffset = $value;
    }

    /**
     * Return Start Number Per Page
     * @return int
     */
    public function getNewOffset() {
        return $this->newOffset;
    }

    /**
     * Set limit Per Page
     * @param int $value
     */
    public function setLimit($value) {
        $this->limit = $value;
    }

    /**
     * Return limit Per Page
     * @return int
     */
    public function getLimit() {
        return $this->limit;
    }

    /**
     * Set Total record
     * @param int $value
     */
    public function setTotalRecord($value) {
        $this->totalRecord = $value;
    }

    /**
     * Return Total Record
     * @return int
     */
    public function getTotalRecord() {
        return $this->totalRecord;
    }
    /**
     * Set Total record
     * @param int $value
     */
    public function setViewPath($value) {
        $this->viewPath = $value;
    }

    /**
     * Return Total Record
     * @return int
     */
    public function getViewPath() {
        return $this->viewPath;
    }
     /**
     *Return Security Token
     * @return type 
     */
    function getSecurityToken() {
        return $this->securityToken;
    }
    /**
     * Set Security Token
     * @param string $value 
     */
    function setSecurityToken($value){
        $this->securityToken= $value;
    }
    /*
     * Previous Record
     * @params offset int
     */

    function movePrevious() {
        $this->arrayText = NULL;
        $this->stringOutput = NULL;
        
        $this->setNewOffset($this->getOffset() - $this->getLimit());
        if ($this->getNewOffset() >= 0) {
            $this->stringOutput.="<li><a  href=\"javascript:void(0)\" onClick=\"ajaxQuery('" . $this->getViewPath() . "','".$this->getSecurityToken()."'," . $this->getNewOffset() . ", '" . $this->getLimit() . "')\">&laquo;</a></li>";
        } else {
            $this->stringOutput.="<li class=\"disabled\"><a  href=\"javascript:void(0)\">&laquo;</a></li>";
        }
        return $this->stringOutput;
    }

    /*
     * Next Record
     */

    function moveNext() {
        $this->pages = NULL;
        $this->stringOutput = NULL;

            
            if ($this->getOffset() <= ($this->getTotalRecord() - $this->getLimit())) {
                $this->pages = intval($this->getTotalRecord() / $this->getLimit());
                if ($this->getTotalRecord() % $this->getLimit()) {
                    $this->pages++;
                }
                
                 if (!(@($this->getLimit() / $this->getOffset()) == $this->pages) && $this->pages != 1) {
                    $this->setNewOffset($this->getOffset() + $this->getLimit());
                    $this->stringOutput.= "<li><a  href=\"javascript:void(0)\" onClick=\"ajaxQuery('" . $this->getViewPath() . "','".$this->getSecurityToken()."','".$this->getNewOffset()."','".$this->getLimit()."')\">&raquo;</a></li>";
                    
                 } else {
                    $this->stringOutput.= "<li><a  href=\"javascript:void(0)\" onClick=\"ajaxQuery('" . $this->getViewPath() . "','".$this->getSecurityToken()."',0,0)\">&raquo;</a></li>";

                 }
            } else {
                $this->stringOutput.= "<li class=\"disabled\"><a  href=\"javascript:void(0)\">&raquo;</a></li>";
            }
           return $this->stringOutput;
    }

    /**
     * First Record
     */
    function moveFirst() {
        return("<li><a  href=\"javascript:void(0)\" onClick=\"ajaxQuery('" . $this->getViewPath() . "','".$this->getSecurityToken()."','0', '" . $this->getLimit() . "')\" >&larr;</a></li>");
    }

    /**
     * Last Record
     */
    function moveLast() {

        $this->setNewOffset(($this->getTotalRecord() - 1));
        if ($this->getNewOffset() < 0) {
            $this->setNewOffset(0);
        }
        return ("<li><a  href=\"javascript:void(0)\"  onClick=\"ajaxQuery('" . $this->getViewPath() . "','".$this->getSecurityToken()."'," . $this->getNewOffset() . ", '" . $this->getLimit() . "')\">&rarr;</a></li>");
    }

    /**
     * To appear pagination as 1,2,3,4,5
     * @todo appear only max 3 pages only
     */
    function pagenationv2() {

        $this->arrayText = NULL;
        $this->stringOutput = NULL;
        $this->pages = NULL;

        $temp = $this->getOffset();
        if ($this->getTotalRecord()) {
            $this->pages = intval($this->getTotalRecord() / $this->getLimit());
        }
        if ($this->getTotalRecord() % $this->getLimit()) {
            $this->pages++;
        }

        $offsetloop = 0;
        for ($loopPage = 1; $loopPage <= $this->pages; $loopPage++) {
            $this->stringOutput.="<li ";
            if ($temp == $offsetloop) {
                $this->stringOutput.=" class=\"active\" ";
            }
            $this->stringOutput.="><a href=\"javascript:void(0)\"  onClick=\"ajaxQuery('" . $this->getViewPath() . "','".$this->getSecurityToken()."'," . $offsetloop . ",'" . $this->getLimit() . "') \">" . $loopPage . "</a></li>";
            $offsetloop += $this->getLimit();
        }
        return $this->stringOutput;
    }

    /*
     * To appear Number of Pages
     * @params $translation string
     */

    function pages($translation = null) {
        if (strlen($translation) == 0) {
            $translation = "pages";
        }
        return "<a href=\"javascript:void(0)\">" . $this->pages . " " . ucfirst($translation) . "</a>";
    }

    /*
     * this simple function pagenation like 1-2 page or 3 to 15 page style
     * @params offset int
     */

    function pagenationv3() {
        $allrecord = $this->getOffset() + 1;
        $extra = $allrecord + $this->getLimit() - 1;
        if($extra==99999){
            $extra=$this->getTotalRecord();
        }
        if ($allrecord > $this->getTotalRecord()) {
           // $string = "No Record";
            $string='';
        } else {
            $string = "<li><a href=\"javascript:void(0)\" >" . $allrecord . " to  " . $extra . " from  " . $this->getTotalRecord() . "</a></li>";
        }
        return $string;
    }

    function pagenationv4() {
        echo "<ul>"  . $this->moveFirst().$this->movePrevious().$this->pagenationv2() .$this->pagenationv3().$this->moveNext().$this->moveLast(). "</ul>";
    }
   

}

?>