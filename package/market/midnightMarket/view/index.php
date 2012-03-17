<?php //require_once("/../controller/midnightMarketController.php");
    //  $data = new \Core\market\controller\midnightMarketControllerClass();
$data['counter'][]=1;
$data['state'][]='Negeri Sembilan';
$data['location'][]='Taman Semarak, Nilai';
$data['day'][]='Selasa';

$data['counter'][]='2';
$data['state'][]='Negeri Sembilan';
$data['location'][]='Flat Taman Semarak, Nilai'; 	
$data['day'][]='Sabtu';

$data['counter'][]=3; 
$data['state'][] = 'Negeri Sembilan';
$data['location'][]='Flat Cempaka'; 	
$data['day'][]='Jumaat';

?>
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
    <?php for($i=0;$i<count($data['counter']);$i++)   { ?>
        <tr>
            <td><?php echo $data['counter'][$i]; ?></td>
            <td><?php echo $data['state'][$i]; ?></td>
            <td><?php echo $data['location'][$i]; ?></td>
            <td><?php echo $data['day'][$i]; ?></td>
            <td><?php //echo $data['maps'][$i]; ?></td>
            <td><a link=""><a></td>

        </tr>
    <?php } ?>    
    </tbody>
</table>
<script language="javascript">
    // ajax request only implement on
</script>
