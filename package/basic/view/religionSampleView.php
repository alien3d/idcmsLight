<?php
namespace Core\Controller\Basic\Religion;
require_once ("../../../library/class/classNavigation.php");
use Core\Paging\HtmlPaging;
class ReligionSampleView extends HtmlPaging {
    /*
     * @params $data  Array Ouput
     * @params $total Total Record;
     */
    function indexView() {
       
    }
}
class ReligionDetailSampleView extends HtmlPaging {
    function indexView() {
       // include_once './template/religionDetailSample.tpl';
    }
}
?>
