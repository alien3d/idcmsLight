<?php

/* last Change Code 24 March 2007
  log file :: repair on >> false counting error 24 March 2007
  Owner :Hafizan Bin Abd Aziz
  License :Creative License
 */

class navigation {

    /**
     *  Limit Per Entry Output
     *  @var limit int
     */
    public  $limit;
    /**
     *  Total Record  
     *  @var totalRecord int
     */
    public  $countRecord;
    /**
     *  Total Record  
     *  @var totalRecord int
     */
    public  $offset;
    /**
     *  Total Record  
     *  @var arrayVariable string
     */
    public  $arrayVariable;
    /**
     *  Total Record  
     *  @var arrayText striing
     */
    public  $arrayText;
    /**
     *  Total Record  
     *  @var arrayVariableValue string
     */
    public  $arrayVariableValue;
    /**
     *  Total Record  
     *  @var pages int
     */
    private $pages;
    /**
     *  Total Record  
     *  @var lastRecord int
     */
    private $last_record;
    function __construct() {
        $this->pages=5;
    }
    /*
     * Previous Record
     * @params offset int
     */
    function prevPage($offset) {

        $this->offset = NULL;
        $this->arrayText = NULL;
        $this->offset = $offset;
        $prevOffset = $this->offset - $this->limit;
        if ($prevOffset >= 0) {
            
                $string.="<li><a  href=\"javascript:void(0)\" ";
                $countRecord = count($this->arrayVariable);
                if ($countRecord >= 1) {

                    for ($i = 0; $i < $countRecord; $i++) {
                        if ($this->arrayVariable[$i] == "offset") {
                            $this->arrayVariableValue[$i] = $prevOffset;
                        }
                        $this->arrayText = $this->arrayVariable[$i] . "=" . $this->arrayVariableValue[$i] . "&" . $this->arrayText;
                    }
                } 
                

                $string.="onClick=\"ajaxQuery('".basename($_SERVER['PHP_SELF'])."','not',".$prevOffset.", '".$this->arrayText."')\">&laquo;</a></li>";
            
        } else {

            $string.="<li><a  href=\"#\">&laquo; </a></li>";
        }
        return $string;
    }
    /*
     * Next Record
     * @params $offset
     */
    function nextPage($offset) {

        $this->offset = NULL;
        $this->arrayText = NULL;
        $this->pages = NULL;
        $this->offset = $offset;
        ;
        if ($this->offset <= ($this->countRecord - $this->limit)) {
            if ($this->countRecord) {
                $this->pages = intval($this->countRecord / $this->limit);
                if ($this->countRecord % $this->limit) {
                    $this->pages++;
                }
                if (!(($this->offset / $this->limit) == $this->pages) && $this->pages != 1) {
                    $this->offset = $this->offset + $this->limit;
                    $string="<li><a  href=\"javascript:void(0)\" ";
                    $countRecordArray = count($this->arrayVariable);
                    if ($countRecordArray >= 1) {
                        for ($i = 0; $i < $countRecordArray; $i++) {
                            if ($this->arrayVariable[$i] == "offset") {
                                $this->arrayVariableValue[$i] = $this->offset;
                                  $ajaxOffset = $this->arrayVariableValue[$i];
                            }
                            $this->arrayText = $this->arrayVariable[$i] . "=" . $this->arrayVariableValue[$i] . "&" . $this->arrayText;
                        }
                    } else {
                        $string.="onClick=\"ajaxQuery('".basename($_SERVER['PHP_SELF'])."','not',0,'></a></li>";
                    }
                    
                    $string.="onClick=\"ajaxQuery('".basename($_SERVER['PHP_SELF'])."','not',".$ajaxOffset.", '".$this->arrayText."')\">&raquo;</a></li>";
                } else {
                    $string.="<li><a  href=\"#\">&raquo;</a></li>";
                }
            }
        } else {
            $string.="<li><a  href=\"#\">&raquo;</a></li>";
        }
        return $string;
    }
    /*
     * First Record
     */
    function moveFirst() {

        $this->arrayText = NULL;
        $this->offset = 0;
        $string="<li><a  href=\"javascript:void(0)\" ";
        $countRecordArray = count($this->arrayVariable);
        if ($countRecordArray >= 1) {
            for ($j = 0; $j < $countRecordArray; $j++) {
                if ($this->arrayVariable[$j] == "offset") {
                    $this->arrayVariableValue[$j] = $this->offset;
                }
                $this->arrayText = $this->arrayVariable[$j] . "=" . $this->arrayVariableValue[$j] . "&" . $this->arrayText;
            }
        } else {
            $string.="\"></a></li>";
        }
        $string.= $this->arrayText;
        $string.="\"></a></li>";
        return $string;
    }
    /*
     * Last Record
     */
    function moveLast() {

        $this->arrayText = NULL;
        $this->last_record = $this->countRecord - 1;
        if ($this->last_record < 0) {
            $this->last_record = 0;
        }
        $string="<li><a  href=\"javascript:void(0)\" ";
        $countRecordArray = count($this->arrayVariable);
        if ($countRecordArray >= 1) {
            for ($j = 0; $j < $countRecordArray; $j++) {
                if ($this->arrayVariable[$j] == "offset") {
                    $this->arrayVariableValue[$j] = $this->last_record;
                      $ajaxOffset = $this->arrayVariableValue[$k];
                }
                $this->arrayText = $this->arrayVariable[$j] . "=" . $this->arrayVariableValue[$j] . "&" . $this->arrayText;
            }
        } else {
            $string.=" onClick=\"ajaxQuery('".basename($_SERVER['PHP_SELF'])."','not',".$ajaxOffset.", '".$this->arrayText."')\"></a></li>";
        }
        $string.=$this->arrayText;
        $string.="></a></li>";
        return $string;
    }
    /*
     * To appear pagination as 1,2,3,4,5
     * @params offset int
     */
    function pagenation($offset) {

        $this->offset = NULL;
        $this->arrayText = NULL;
        $this->pages = NULL;
        $this->offset = $offset;
        if ($this->countRecord) {
            $this->pages = intval($this->countRecord / $this->limit);
        }
        if ($this->countRecord % $this->limit) {
            $this->pages++;
        }
        $countRecordArray = count($this->arrayVariable);
        $offsetloop = 0;
        for ($loop_page = 1; $loop_page <= $this->pages; $loop_page++) {
            $string=" <li><a  href=\"javascript:void(0)\" ";
            if ($countRecordArray >= 1) {
               
                for ($k = 0; $k < $countRecordArray; $k++) {

                    if ($this->arrayVariable[$k] == "offset") {
                        $this->arrayVariableValue[$k] = $offsetloop;
                          $ajaxOffset = $this->arrayVariableValue[$k];
                    }
                    $this->arrayText = $this->arrayVariable[$k] . "=" . $this->arrayVariableValue[$k] . "&" . $this->arrayText;
                }
            } else {
               $string.="Do play play la I know you want to hack it ?";
            }
            $string.=$this->arrayText;
            $string.=" onClick=\"ajaxQuery('".basename($_SERVER['PHP_SELF'])."','not',".$ajaxOffset.", '".$this->arrayText."')\">" . $loop_page . "</a></li>";
            $offsetloop = $offsetloop + $this->limit;
        }
        return $string;
    }
    /*
     * To appear pagination as 1,2,3,4,5
     * @params offset int
     * @todo appear only max 3 pages only
     */
    function pagenationv2($offset) {
        $this->offset = NULL;
        $this->arrayText = NULL;
        $this->pages = NULL;
        $this->offset = $offset;
        
        $temp = $offset;
        if ($this->countRecord) {
            $this->pages = intval($this->countRecord / $this->limit);
        }
        if ($this->countRecord % $this->limit) {
            $this->pages++;
        }
        $countRecordArray = count($this->arrayVariable);
        $offsetloop = 0;
        for ($loop_page = 1; $loop_page <= $this->pages; $loop_page++) {
            
            if ($countRecordArray >= 1) {
               
                for ($k = 0; $k < $countRecordArray; $k++) {
                      $string.="<li ";
                     if($temp==$offsetloop) {
                         $string.=" class=active ";
                     }
                     $string.="><a  href=\"javascript:void(0)\" ";   
                    if ($this->arrayVariable[$k] == "offset") {
                        $this->arrayVariableValue[$k] = $offsetloop;
                          
                    }
                    $this->arrayText = $this->arrayVariable[$k] . "=" . $this->arrayVariableValue[$k] . "&" . $this->arrayText;
                    $string.=" onClick=\"ajaxQuery('".basename($_SERVER['PHP_SELF'])."','not',".$offsetloop.", '".$this->arrayText."')\">" . $loop_page . "</a></li>";

                    
                }
            } else {
               $string.="Do play play la I know you want to hack it ?";
            }
            
            $offsetloop = $offsetloop + $this->limit;
            
        }
        return $string;
        
    }
    /*
     * To appear Number of Pages
     * @params $translation string
     */
    function pages($translation=null) {
        if(strlen($translation)==0){
            $translation="pages";
        }
        return "<a href=\"javascript:void(0)\">".$this->pages." ".ucfirst($translation)."</a>";
    }
    /*
     * this simple function pagenation like 1-2 page or 3 to 15 page style
     * @params offset int
     */
    function pagenationv3($offset) {

        
        $this->offset = NULL;
        $this->offset = $offset;
        $allrecord = $this->offset + 1;
        $extra  = $allrecord +$this->limit-1;
        if ($allrecord > $this->countRecord) {
           $string="No Record";
        } else {
          $string="<li><a href=\"#\" >" . $allrecord . " to  ".$extra." from  " . $this->countRecord . "</a></li>";
        }
        return $string;
    }

}

?>