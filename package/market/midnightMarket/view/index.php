<?php
require_once("/../controller/midnightMarketController.php");
$midnightMarket = new \Core\Market\MidnightMarket\Controller\MidnightMarketClass();
$offset = 0;
$limit = 2;
$midnightMarket->setStart($offset);
$midnightMarket->setLimit($limit); // normal system don't like paging.. 
$midnightMarket->execute();
$midnightMarket->setPageOutput('html');
$data = $midnightMarket->read();
require_once ("../../../../library/class/classNavigation.php");
$navigation = new \Core\Paging\HtmlPaging();
$navigation->setControllerPath($midnightMarket->getControllerPath());
$navigation->countRecord = $data[0]['total'];

$navigation->arrayVariable=array('x');
$navigation->arrayVariableValue=array(1);
$navigation->offset = $offset;
$navigation->limit = $limit;

?>
<div  class="modal hide fade" id="filterGridAdvance">
    <div class="modal-header">
        <a class="close" data-dismiss="modal1">×</a>
        <h3>Advance Search Record</h3>
    </div>
    <div class="modal-body">
        <table>
            <thead>
                <tr>
                    <th>Fields</th>
                    <th>Input</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Negeri</td>
                    <td><select name="state" id="state"></state></td>                
                </tr>
                <tr>
                    <td>Kawasan</td>
                    <td><select name="state" id="state"></state></td>                
                </tr>
                <tr>
                    <td>Hari</td>
                    <td><select name="state" id="state"></state></td>

                </tr>
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-primary">Search</a>
        <a href="#" onclick="showMeModal('filterGridAdvance',0)" class="btn">Close</a>
    </div>
</div>

<div align="right">    
    <input type="text" class="input-small search-query" name="query" id="query">
    <button class="btn" type="button" onclick="showMe('modal1',1)">New</button>
    <button class="btn" type="button" onclick="searchMe()">Search</button>
    <button class="btn" type="button" onclick="showMeModal('filterGridAdvance',1)">Advance Search</button>
    <button class="btn" type="button">Report</button>
</div>
<br>
<table class="table table-striped table-bordered table-condensed" name="tableData" id="tableData">   
    <thead>
        <tr>
            <th>No</th>
            <th>Negeri</th>
            <th>Kawasan</th>
            <th>Hari</th>
            <th>Google Maps</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id=tableBody>
        <?php
        if (is_array($data)) {
            $totalRecord=count($data);    
            if ($totalRecord > 0) {
                $counter = 0;
                for ($i = 0; $i < $totalRecord; $i++) {
                    $counter = $i + 1;
                    ?>
                    <tr>
                        <td><?php echo $counter; ?></td>
                        <td><?php echo $data[$i]['stateDesc']; ?></td>
                        <td><?php echo $data[$i]['midnightMarketLocation']; ?></td>
                        <td><?php echo $data[$i]['dayTitle']; ?></td>
                        <td><?php //echo $data['maps'][$i];     ?></td>
                        <td><a link=""><a></td>

                                    </tr>
                                <?php }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="6"><?php $midnightMarket->exceptionMessage("No Record"); ?></td>
                                </tr> 
    <?php }
} else {
    ?>
                            <tr>
                                <td colspan="6"><?php $midnightMarket->exceptionMessage("Data Record Problem"); ?></td>
                            </tr>    
<?php } ?>        
                        </tbody>
                        </table>
                        <div class="pagination" id="CorePaging" name="CorePaging"><?php echo $navigation->pagenationv4($offset); ?></div>    
                        <script language="javascript">
                            // ajax request only implement on
                        </script>
