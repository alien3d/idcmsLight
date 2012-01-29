<?php
namespace Core\Paging;
/* last Change Code 24 March 2007
  log file :: repair on >> false counting error 24 March 2007
  Owner :Hafizan Bin Abd Aziz
  License :Creative License
 */

class HtmlPaging {

    var $sql;
    var $limit;
    var $countRecord;
    var $queryRecord;
    var $offset;
    var $arrayVariable;
    var $arrayText;
    var $arrayVariableValue;
    var $error;
    var $pages;
    var $textOffset;
    var $last_record;

    function prevPage($offset) {

        $this->offset = NULL;
        $this->arrayText = NULL;
        $this->offset = $offset;
        if ($this->offset > 1) {
            $prevOffset = $this->offset - $this->limit;
            if ($prevOffset <= -1) {
                print"<li><a  href=\"#\"></a>";
            } else {
                print"<li><a  href=\"" . $_SERVER['PHP_SELF'] . "?";
                $countRecord = count($this->arrayVariable);
                if ($countRecord >= 1) {

                    for ($i = 0; $i < $countRecord; $i++) {
                        if ($this->arrayVariable[$i] == "offset") {
                            $this->arrayVariableValue[$i] = $prevOffset;
                        }
                        $this->arrayText = $this->arrayVariable[$i] . "=" . $this->arrayVariableValue[$i] . "&" . $this->arrayText;
                    }
                } else {
                    print"\"></a></li>";
                }
                echo $this->arrayText;

                print"\"></a></li>";
            }
        } else {

            print"<li><a  href=\"#\"></a></li>";
        }
    }

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
                    print"<li><a  href=\"" . $_SERVER['PHP_SELF'] . "?";
                    $countRecordArray = count($this->arrayVariable);
                    if ($countRecordArray >= 1) {
                        for ($i = 0; $i < $countRecordArray; $i++) {
                            if ($this->arrayVariable[$i] == "offset") {
                                $this->arrayVariableValue[$i] = $this->offset;
                            }
                            $this->arrayText = $this->arrayVariable[$i] . "=" . $this->arrayVariableValue[$i] . "&" . $this->arrayText;
                        }
                    } else {
                        print"\"></a></li>";
                    }
                    echo $this->arrayText;
                    print"\"></a></li>";
                } else {
                    print"<li><a  href=\"#\"></a></li>";
                }
            }
        } else {
            print"<li><a  href=\"#\"></a></li>";
        }
    }

    function moveFirst() {

        $this->arrayText = NULL;
        $this->offset = 0;
        print"<li><a  href=\"" . $_SERVER['PHP_SELF'] . "?";
        $countRecordArray = count($this->arrayVariable);
        if ($countRecordArray >= 1) {
            for ($j = 0; $j < $countRecordArray; $j++) {
                if ($this->arrayVariable[$j] == "offset") {
                    $this->arrayVariableValue[$j] = $this->offset;
                }
                $this->arrayText = $this->arrayVariable[$j] . "=" . $this->arrayVariableValue[$j] . "&" . $this->arrayText;
            }
        } else {
            print"\"></a></li>";
        }
        echo $this->arrayText;
        print"\"></a></li>";
    }

    function moveLast() {

        $this->arrayText = NULL;
        $this->last_record = $this->countRecord - 1;
        if ($this->last_record < 0) {
            $this->last_record = 0;
        }
        print"<li><a  href=\"" . $_SERVER['PHP_SELF'] . "?";
        $countRecordArray = count($this->arrayVariable);
        if ($countRecordArray >= 1) {
            for ($j = 0; $j < $countRecordArray; $j++) {
                if ($this->arrayVariable[$j] == "offset") {
                    $this->arrayVariableValue[$j] = $this->last_record;
                }
                $this->arrayText = $this->arrayVariable[$j] . "=" . $this->arrayVariableValue[$j] . "&" . $this->arrayText;
            }
        } else {
            print"\"></a></li>";
        }
        echo $this->arrayText;
        print"\"></a></li>";
    }

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
            print" <li><a  href=\"" . $_SERVER['PHP_SELF'] . "?";
            if ($countRecordArray >= 1) {
               
                for ($k = 0; $k < $countRecordArray; $k++) {

                    if ($this->arrayVariable[$k] == "offset") {
                        $this->arrayVariableValue[$k] = $offsetloop;
                    }
                    $this->arrayText = $this->arrayVariable[$k] . "=" . $this->arrayVariableValue[$k] . "&" . $this->arrayText;
                }
            } else {
                print"Do play play la I know you want to hack it ?";
            }
            echo $this->arrayText;
            print"pages=" . $loop_page . "\">" . $loop_page . "</a></li>";
            $offsetloop = $offsetloop + $this->limit;
        }
    }

    function pagenationv2($offset) {
        /*
          this function uses to pull out limit per page without pulling out all 1,2,3,4,5 but pull out  certain value
          of the pagenation itself like  4,5,6 depend on calculation offset + limit  more beautiful pagenation style

         */


        $this->offset = NULL;
        $this->arrayText = NULL;
        $this->offset = $offset;


        $this->textOffset = "offset";
        if ($this->countRecord) {
            $this->pages = intval($this->countRecord / $this->limit);
        }
        if ($this->countRecord % $this->limit) {
            $this->pages++;
        }
        $countRecordArray = count($this->arrayVariable);

        if ($this->countRecord) {

            $j = 0;
            // e.g limit eq 2 and times with 2 the pages will ouput 3 pages.Which mean will be minus 1
            $perpage = 5;
            $page_start = ($this->offset / $this->limit ) + 1;
            $page_end = $page_start + $perpage;
            $page_prev = $page_start - 1;
            $page_next = $page_end + 1;
            if ($page_prev <= 0) {
                $page_prev = NULL;
            }
            if ($page_next >= $this->pages) {
                $page_next = NULL;
            }
            if ($page_end >= $this->pages) {
                $page_end = $this->pages;
            }
            $offsetloop = 0;
            //echo $page_prev;
            for ($loop_page = 1; $loop_page <= $this->pages; $loop_page++) {

                ++$j;
                $this->arrayText = NULL;
                if ($page_prev == $loop_page) {

                    print"  <li><a href=\"" . $_SERVER['PHP_SELF'] . "?";

                    for ($k = 0; $k < $countRecordArray; $k++) {

                        if ($this->arrayVariable[$k] == $this->textOffset) {
                            $this->arrayVariableValue[$k] = $offsetloop;
                        }
                        $this->arrayText = $this->arrayVariable[$k] . "=" . $this->arrayVariableValue[$k] . "&" . $this->arrayText;
                    }
                    echo $this->arrayText;
                    print"\">&laquo;</a></li>  ";
                    $this->arrayText = NULL;
                }
                if (($page_start <= $loop_page ) && ($page_end >= $loop_page)) {
                    // print last page
                    // print the loop pages
                    print" <li> <a href=\"" . $_SERVER['PHP_SELF'] . "?";
                }
                $this->arrayText = NULL; // set as null first  because to prevent >> offset double
                if ($countRecordArray >= 1) {

                  

                    for ($k = 0; $k < $countRecordArray; $k++) {

                        if ($this->arrayVariable[$k] == $this->textOffset) {
                            $this->arrayVariableValue[$k] = $offsetloop;
                        }
                        $this->arrayText = $this->arrayVariable[$k] . "=" . $this->arrayVariableValue[$k] . "&" . $this->arrayText;

                        // here suppost to get last value of offset
                        $lastoffset = $this->arrayVariableValue[$k];
                    }
                } else {
                    print"Do play play la I know you want to hack it ?";
                }

                if (($page_start <= $loop_page ) && ($page_end >= $loop_page)) {
                    echo $this->arrayText;
                }

                if (($page_start <= $loop_page ) && ($page_end >= $loop_page)) {
                    // print the loop page
                    print"\">" . $loop_page . "</a></li>  ";
                    // print the
                }

                $offsetloop = $offsetloop + $this->limit;
                if ($page_next == $loop_page) {

                    print"<li><a href=\"" . $_SERVER['PHP_SELF'] . "?";
                    $this->arrayText = NULL; // set as null first  because to prevent >> offset double
                    for ($k = 0; $k < $countRecordArray; $k++) {

                        if ($this->arrayVariable[$k] == "offset") {
                            $this->arrayVariableValue[$k] = ($offsetloop - $this->limit);
                        }
                        $this->arrayText = $this->arrayVariable[$k] . "=" . $this->arrayVariableValue[$k] . "&" . $this->arrayText;
                    }

                    echo $this->arrayText;
                    print"\">&raquo;</a></li>";
                    $this->arrayText = NULL;
                }
            }
            // unset variable so don't puts to array
            unset($this->arrayText);
        }
        $this->pagenationv3($offset);
    }

    function pagenationv3($offset) {

        // this simple function pagenation like 1-2 page or 3 to 15 page style
        $this->offset = NULL;
        $this->offset = $offset;
        $allrecord = $this->offset + 1;
        if ($allrecord > $this->countRecord) {
            print"No Record";
        } else {
           echo "<li><a href=\"#\" >" . $allrecord . " - " . $this->countRecord . "</a></li>";
        }
    }

}

?>