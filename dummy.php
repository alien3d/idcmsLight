<?php
header('Content-Type:application/json; charset=utf-8');
include_once("./library/class/classNavigationOri.php");

    $limit = 10;

if (empty($_POST['offset'])) {
    $offset = 0;
} else {
    $offset = $_POST['offset'];
}

$ng = new navigation;
$array1 = array("offset");
$array2 = array($offset);
$ng->offset  = $offset;
$ng->page    = basename($_SERVER['PHP_SELF']);
$ng->limit = $limit;
$ng->arrayVariable = $array1;
$ng->arrayVariableValue = $array2;
   $tableString = "";

    // start playing with the form terus.. 
    mysql_connect("localhost", "root", "123456");
    mysql_select_db("icore");
    $sql = "select * from religionSample ";
    $result = mysql_query($sql);
    $ng->countRecord = mysql_num_rows($result);
    $sql = "select * from `religionSample` ";
    if($_POST['religionId']){
        $sql.=" AND `religionId`='".$_POST['religionId']."' limit 1";
    } else {
       $sql.=" limit " . $offset . "," . $limit . " ";
    }  
    $result = mysql_query($sql);
     

    $i = $offset+1;
 
    while ($row = mysql_fetch_array($result)) {


        $tableString.="
                           
                        <tr>

                            <td>" . ($i++) . "</td>
                            <td><input type=\"checkbox\" name=\"optionsCheckbox\" id=\"optionsCheckbox\" value=\"" . $row['religionId'] . "\"></td>

                            <td>" . $row['religionTitle'] . "</td>
                            <td><a class=\"btn btn-info\" data-toggle=\"modal\" href=\"#myModal\" ><i class=\"icon-edit icon-white\"></i> Edit</a> <a class=\"btn btn-danger\" data-toggle=\"modal\" href=\"#myModal\" ><i class=\"icon-trash  icon-white\"></i> Remove</a></td>

                        </tr>";
    }
  

$pagingString = "<ul>
                        <li><a href=\"javascript:void(0)\" onClick=\"ajaxQuery('".basename($_SERVER['PHP_SELF'])."','not',0,'')\">0</a></li>".$ng->prevPage($offset)." " . $ng->pagenationv2($offset)." ".$ng->nextPage($offset)." ".$ng->pages()." ".$ng->pagenationv3($offset)."</ul>";
 echo json_encode(

        array("success" => true,
            "tableString" => $tableString,
            "pagingString" => $pagingString,
            "sql"=>$sql));

 
?>