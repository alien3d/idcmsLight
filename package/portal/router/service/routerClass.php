<?php
namespace Core\Router;
require_once ("/../../../../library/class/classAbstract.php");
/**
 * Description of routerClass
 *
 * @author alien3d
 */
class RouterSystemClass extends \Core\ConfigClass {
    /**
     * Connection DatabaseObject
     * @var string
     */
    public $q;
    public  function __construct() {
        parent::__construct();

        $this->q = new \Core\Database\Mysql\Vendor();

        $this->q->vendor = $this->getVendor();
        $this->q->setRequestDatabase($this->q->getCoreDatabase());
        $this->q->connect($this->getConnection(), $this->getUsername(), $this->getDatabase(), $this->getPassword());

        
    }
    public function execute(){}
    public function create() {}
    public function read() {}
    public function update() {}
    public function delete() {}
    public function excel() {}
    public function application() {
        $data=array();
        if($this->getVendor() ==self::MYSQL) {
            $sql="
        SELECT  `".$this->q->getCoreDatabase()."`.`applicationTranslate`.`applicationNative`
        FROM    `application` 
        JOIN    `applicationAccess`
        USING   (`applicationId`)
        AND     `aplicationAccess`.`teamId`                     =   '".$_SESSION['teamId']."'
        AND     `applicationAccess`.`applicationAccessValue`    =   1";
        }
        $this->q->read($sql);
        while($row = $this->q->fetchArray()){
           $row['detail'] = $this->applicationAndModule($row['applicationId']);
            $data[]=$row;
        }
        return $data;
        
    }
    /**
     *  Navigation Bar.
     * @param $applicationId  Application Identification 
     */
    public function applicationAndModule($applicationId){
        $detail=array();
        if($this->getVendor() ==self::MYSQL) { 
        $sql="
        SELECT  `".$this->q->getCoreDatabase()."`.`moduleTranslate`.`moduleNative`, 
        FROM    `module`
        JOIN    `moduleAccess`
        USING   (`moduleId`)
        JOIN    `moduleTranslate`
        USING   (`moduleId`)
        JOIN    `application` 
        JOIN    `applicationAccess`
        USING   (`applicationId`,`teamId`)
        WHERE   `moduleAccess`.`teamId`                         =   '".$_SESSION['teamId']."'
        AND     `aplicationAccess`.`teamId`                     =   '".$_SESSION['teamId']."'
        AND     `moduleAccess`.`moduleAccessValue`              =   1
        AND     `applicationAccess`.`applicationAccessValue`    =   1
        AND     `application`.`applicationId`                   =   '".$applicationId."'";
       }  else if ($this->getVendor()==self::MSSQL){
        $sql="
        SELECT  * 
        FROM    `application` 
        JOIN    `applicationAccess`
        USING   (`applicationId`)
        WHERE   `teamId`='".$_SESSION['teamId']."'";   
       } else if ($this->getVendor()==self::ORACLE){
        $sql="
        SELECT  * 
        FROM    `application` 
        JOIN    `applicationAccess`
        USING   (`applicationId`)
        WHERE   `teamId`='".$_SESSION['teamId']."'";   
       } else if ($this->getVendor()==self::POSTGRESS){
           
       } else if ($this->getVendor()==self::DB2){
           
       }
       $this->q->read($sql);
       while($row = $this->q->fetchArray()){
           $detail[]=$row[];
       }
       return $detail;
    }
    public function folder() {
         $data=array();
        if($this->getVendor() ==self::MYSQL) {
            $sql="
        SELECT  `".$this->q->getCoreDatabase()."`.`folderTranslate`.`applicationNative`
        FROM    `folder`
        JOIN    `folderAccess`
        USING   (`folderId`)
        WHERE   `folderAccess`.`teamId`             =   '".$_SESSION['teamId']."'
        AND     `folderAccess`.`folderAccessValue`  =   1";
        }
        $this->q->read($sql);
        while($row = $this->q->fetchArray()){
           $row['detail'] = $this->folderAndLeaf($row['folderId']);
            $data[]=$row;
        }
        return $data;
    }
    /**
     *
     * @param int $applicationId
     * @param int $moduleId
     * @param int $folderId 
     */
    public function folderAndleaf($applicationId,$moduleId,$folderId) {
        $detail=array();
        if($this->getVendor() ==self::MYSQL) { 
        $sql="
        SELECT   `".$this->q->getCoreDatabase()."`.`leafTranslate`.`moduleNative`, 
        FROM   `leaf`
        USINg   (`leafId`)
        JOIN    `leafAccess`
        USING   (`leafId`)
        JOIN    `folder`
        USING   (`folderId`) 
        JOIN    `folderAccess`
        USING   (`folderId`)
        JOIN    `folderTranslate`
        USING   (`folderId`)
        WHERE   `folderAccess`.`teamId`                 =   '".$_SESSION['teamId']."'
        AND     `leafAccess`.`staffId`                  =   '".$_SESSION['staffId']."'
        AND     `folderAccess`.`moduleAccessValue`      =   1
        AND     `leafAccess`.`applicationAccessValue`   =   1
        AND     `folder`.`appicationId`                 =   '".$applicationId."'
        AND     `folder`.`moduleId`                     =   '".$moduleId."'
        AND     `folder`.`folderId`                     =   '".$folderId."'";
       }  else if ($this->getVendor()==self::MSSQL){
        $sql="
        SELECT  * 
        FROM    `application` 
        JOIN    `applicationAccess`
        USING   (`applicationId`)
        WHERE   `teamId`='".$_SESSION['teamId']."'";   
       } else if ($this->getVendor()==self::ORACLE){
        $sql="
        SELECT  * 
        FROM    `application` 
        JOIN    `applicationAccess`
        USING   (`applicationId`)
        WHERE   `teamId`='".$_SESSION['teamId']."'";   
       } else if ($this->getVendor()==self::POSTGRESS){
           
       } else if ($this->getVendor()==self::DB2){
           
       }
       $this->q->read($sql);
       while($row = $this->q->fetchArray()){
           $detail[]=$row[];
       }
       return $detail;
    }
    
}
class RouterPortalClass extends \Core\ConfigClass {
    public function __construct(){
        
    }
    public function execute(){
        
    }
    public function create() {}
    public function read() {}
    public function update() {}
    public function delete() {}
    public function excel() {}
    public function menu() {}
    public function subMenu(){}
}
?>
