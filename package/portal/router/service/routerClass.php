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
    /**
     *  Navigation Bar. Just call once.Previous call many times 2 database 
     */
    public function applicationModuleFolder(){
        if($this->getVendor() ==self::MYSQL) { 
        $sql="
        SELECT  `icore`.`applicationTranslate`.`applicationNative`,
                `icore`.`moduleTranslate`.`moduleNative`,
                `iCore`.`folderTranslate`.`folderNative`, 
        FROM    `folder`
        JOIN    `folderAccess`
        USING   (`folderId`,`moduleId`)
        JOIN    `folderTranslate`
        USING   (`folderId`)
        JOIN    `module`
        USING   (`moduleId`,`applicationId`)
        JOIN    `application` 
        JOIN    `applicationAccess`
        USING   (`applicationId`)
        WHERE   `teamId`='".$_SESSION['teamId']."'";
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
           $data[]=$row[];
       }
    }
    public function leaf($applicationId,$moduleId,$folderId) {
        
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
