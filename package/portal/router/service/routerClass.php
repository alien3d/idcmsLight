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
