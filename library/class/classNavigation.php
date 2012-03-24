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
     *  Controller Path
     *  @var limit string
     */
    private $controllerPath;

    /**
     * Return String pagenation
     * @var type 
     */
    private $stringOutput;
    /**
     * Form Filter
     * @var type 
     */
    private $formFilter;
    /**
     * Single Filter Type
     * @var string
     */
    private $textboxFilter;

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
     * Return Controller Path
     * @return string 
     */
    public function getControllerPath() {
        return $this->controllerPath;
    }

    /**
     * Set Controller Path
     * @param type $controllerPath 
     */
    public function setControllerPath($value) {
        $this->controllerPath = $value;
    }
    /**
     * Return Controller Path
     * @return string 
     */
    public function getFormFilter() {
        return $this->formFilter;
    }

    /**
     * Set Controller Path
     * @param type $controllerPath 
     */
    public function setFormFilter($value) {
        $this->formFilter = $value;
    }
    /**
     * Return Controller Path
     * @return string 
     */
    public function getTextboxFilter() {
        return $this->textboxFilter;
    }

    /**
     * Set Controller Path
     * @param type $controllerPath 
     */
    public function setTextboxFilter($value) {
        $this->textboxFilter = $value;
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
            $this->stringOutput.="<li><a  href=\"javascript:void(0)\" onClick=\"ajaxQuery('" . $this->getControllerPath() . "','not'," . $this->getNewOffset() . ", '" . $this->getLimit() . "'," . $this->getFormFilter() . "','".$this->getTexboxFilter()."')\">&laquo;</a></li>";
        } else {
            $this->stringOutput.="<li><a  href=\"javascript:void(0)\">&laquo; </a></li>";
        }
        return $this->stringOutput;
    }

    /*
     * Next Record
     */

    function moveNext() {
        $this->pages = NULL;
        $this->stringOutput = NULL;

        if ($this->getTotalRecord()) {
            if ($this->getOffset() <= ($this->getTotalRecord() - $this->getLimit())) {
                $this->pages = intval($this->getTotalRecord() / $this->getLimit());
                if ($this->getTotalRecord() % $this->getLimit()) {
                    $this->pages++;
                }
                if (!(($this->getLimit() / $this->getOffset()) == $this->pages) && $this->pages != 1) {
                    $this->setNewOffset($this->getOffset() + $this->getLimit());
                    $this->stringOutput.= "<li><a  href=\"javascript:void(0)\" onClick=\"ajaxQuery('" . $this->getControllerPath() . "','not',0,0," . $this->getFormFilter() . "','".$this->getTexboxFilter()."')></a></li>";
                }
            } else {
                $this->stringOutput = "<li><a  href=\"javascript:void(0)\">&raquo;</a></li>";
            }
        } else {
            $this->stringOutput = "<li><a  href=\"javascript:void(0)\">&raquo;</a></li>";
        }

        return $this->stringOutput;
    }

    /**
     * First Record
     */
    function moveFirst() {
        return("<li><a  href=\"javascript:void(0)\" onClick=\"ajaxQuery('" . $this->getControllerPath() . "','not','0', '" . $this->getLimit() . "'," . $this->getFormFilter() . "','".$this->getTexboxFilter()."')\" >&larr;</a></li>");
    }

    /**
     * Last Record
     */
    function moveLast() {

        $this->setNewOffset(($this->getTotalRecord() - 1));
        if ($this->getNewOffset() < 0) {
            $this->setNewOffset(0);
        }
        return ("<li><a  href=\"javascript:void(0)\"  onClick=\"ajaxQuery('" . $this->getControllerPath() . "','not'," . $this->getNewOffset() . ", '" . $this->getLimit() . "'," . $this->getFormFilter() . "','".$this->getTexboxFilter()."')\">&rarr;</a></li>");
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
                $this->stringOutput.=" class=active ";
            }
            $this->stringOutput.=" onClick=\"ajaxQuery('" . $this->getControllerPath() . "','not'," . $offsetloop . ",'" . $this->getLimit() . "', '" . $this->getFormFilter() . "','".$this->getTexboxFilter()."')\">" . $loopPage . "</a></li>";
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
        if ($allrecord > $this->getTotalRecord()) {
            $string = "No Record";
        } else {
            $string = "<li><a href=\"javascript:void(0)\" >" . $allrecord . " to  " . $extra . " from  " . $this->getTotalRecord() . "</a></li>";
        }
        return $string;
    }

    function pagenationv4() {
        echo "<ul>" . $this->moveFirst() . $this->movePrevious() . $this->pagenationv2() . $this->pagenationv3() . $this->moveNext() . $this->moveLast() . "</ul>";
    }

}

?>