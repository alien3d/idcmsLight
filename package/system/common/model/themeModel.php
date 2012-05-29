<?php  namespace Core\System\Common\Theme\Model;
require_once ("../../../../library/class/classValidation.php"); 
/** 
* this is theme model file.This is to ensure strict setting enable for all variable enter to database 
 * 
 * @name IDCMS.
 * @version 2
 * @author hafizan
 * @package System 
 * @subpackage Common 
 * @link http://www.idcms.org
 * @license http://www.gnu.org/copyleft/lesser.html LGPL
 */
class ThemeModel extends \Core\Validation\ValidationClass { 

        

        /**

        * @var int 

        */

        private $themeId; 
 
        

        /**

        * @var int 

        */

        private $themeSequence; 
 
        

        /**

        * @var text 

        */

        private $themeCode; 
 
        

        /**

        * @var text 

        */

        private $themeNote; 
 
        

        /**

        * @var text 

        */

        private $themePath; 
  /* (non-PHPdoc)
     * @see ValidationClass::execute()
     */
    public function execute() {
        /*
         *  Basic Information Table
         */
        $this->setTableName('theme');
        $this->setPrimaryKeyName('themeId');
        $this->setMasterForeignKeyName('themeId');
        //$this->setFilterCharacter('themeDesc');
        $this->setFilterDate('themeDate');
        /**
         * All the Array enviroment.
         */ 
if (isset($_POST ['themeId'])) { 
     $this->setThemeId($this->strict($_POST ['themeId'], 'int'), 0, 'single'); 
 } 
 if (isset($_POST ['themeSequence'])) { 
     $this->setThemeSequence($this->strict($_POST ['themeSequence'], 'int')); 
 } 
 if (isset($_POST ['themeCode'])) { 
     $this->setThemeCode($this->strict($_POST ['themeCode'], 'text')); 
 } 
 if (isset($_POST ['themeNote'])) { 
     $this->setThemeNote($this->strict($_POST ['themeNote'], 'text')); 
 } 
 if (isset($_POST ['themePath'])) { 
     $this->setThemePath($this->strict($_POST ['themePath'], 'text')); 
 } 
 		/**
         * All the $_GET enviroment.
         */
if (isset($_GET ['themeId'])) { 
     $this->setThemeId($this->strict($_GET ['themeId'], 'int'), 0, 'single'); 
 } 
 if (isset($_GET ['themeSequence'])) { 
     $this->setThemeSequence($this->strict($_GET ['themeSequence'], 'int')); 
 } 
 if (isset($_GET ['themeCode'])) { 
     $this->setThemeCode($this->strict($_GET ['themeCode'], 'text')); 
 } 
 if (isset($_GET ['themeNote'])) { 
     $this->setThemeNote($this->strict($_GET ['themeNote'], 'text')); 
 } 
 if (isset($_GET ['themePath'])) { 
     $this->setThemePath($this->strict($_GET ['themePath'], 'text')); 
 } 
 		if (isset($_GET ['themeId'])) {
            $this->setTotal(count($_GET ['themeId']));
        }
        if (isset($_GET ['isDefault'])) {
            if (is_array($_GET ['isDefault'])) {
                $this->isDefault = array();
            }
        }
        if (isset($_GET ['isNew'])) {
            if (is_array($_GET ['isNew'])) {
                $this->isNew = array();
            }
        }
        if (isset($_GET ['isDraft'])) {
            if (is_array($_GET ['isDraft'])) {
                $this->isDraft = array();
            }
        }
        if (isset($_GET ['isUpdate'])) {
            if (is_array($_GET ['isUpdate'])) {
                $this->isUpdate = array();
            }
        }
        if (isset($_GET ['isDelete'])) {
            if (is_array($_GET ['isDelete'])) {
                $this->isDelete = array();
            }
        }
        if (isset($_GET ['isActive'])) {
            if (is_array($_GET ['isActive'])) {
                $this->isActive = array();
            }
        }
        if (isset($_GET ['isApproved'])) {
            if (is_array($_GET ['isApproved'])) {
                $this->isApproved = array();
            }
        }
        if (isset($_GET ['isReview'])) {
            if (is_array($_GET ['isReview'])) {
                $this->isReview = array();
            }
        }
        if (isset($_GET ['isPost'])) {
            if (is_array($_GET ['isPost'])) {
                $this->isPost = array();
            }
        }
        $primaryKeyAll = '';
        for ($i = 0; $i < $this->getTotal(); $i++) {
            if (isset($_GET ['themeId'])) {
            }
            if (isset($_GET ['isDefault'])) {
                if ($_GET ['isDefault'] [$i] == 'true') {
                    $this->setIsDefault(1, $i, 'array');
                } else if ($_GET ['isDefault'] [$i] == 'false') {
                    $this->setIsDefault(0, $i, 'array');
                }
            }
            if (isset($_GET ['isNew'])) {
                if ($_GET ['isNew'] [$i] == 'true') {
                    $this->setIsNew(1, $i, 'array');
                } else if ($_GET ['isNew'] [$i] == 'false') {
                    $this->setIsNew(0, $i, 'array');
                }
            }
            if (isset($_GET ['isDraft'])) {
                if ($_GET ['isDraft'] [$i] == 'true') {
                    $this->setIsDraft(1, $i, 'array');
                } else if ($_GET ['isDraft'] [$i] == 'false') {
                    $this->setIsDraft(0, $i, 'array');
                }
            }
            if (isset($_GET ['isUpdate'])) {
                if ($_GET ['isUpdate'] [$i] == 'true') {
                    $this->setIsUpdate(1, $i, 'array');
                } if ($_GET ['isUpdate'] [$i] == 'false') {
                    $this->setIsUpdate(0, $i, 'array');
                }
            }
            if (isset($_GET ['isDelete'])) {
                if ($_GET ['isDelete'] [$i] == 'true') {
                    $this->setIsDelete(1, $i, 'array');
                } else if ($_GET ['isDelete'] [$i] == 'false') {
                    $this->setIsDelete(0, $i, 'array');
                }
            }
            if (isset($_GET ['isActive'])) {
                if ($_GET ['isActive'] [$i] == 'true') {
                    $this->setIsActive(1, $i, 'array');
                } else if ($_GET ['isActive'] [$i] == 'false') {
                    $this->setIsActive(0, $i, 'array');
                }
            }
            if (isset($_GET ['isApproved'])) {
                if ($_GET ['isApproved'] [$i] == 'true') {
                    $this->setIsApproved(1, $i, 'array');
                } else if ($_GET ['isApproved'] [$i] == 'false') {
                    $this->setIsApproved(0, $i, 'array');
                } 
            } 
            if (isset($_GET ['isReview'])) {
                if ($_GET ['isReview'] [$i] == 'true') {
                    $this->setIsReview(1, $i, 'array');
                } else if ($_GET ['isReview'] [$i] == 'false') {
                    $this->setIsReview(0, $i, 'array');
                }
            }
            if (isset($_GET ['isPost'])) {
                if ($_GET ['isPost'] [$i] == 'true') {
                    $this->setIsPost(1, $i, 'array');
                } else if ($_GET ['isPost'] [$i] == 'false') {
                    $this->setIsPost(0, $i, 'array');
                }
            }
            $primaryKeyAll .= $this->getThemeId($i, 'array') . ",";
        }
        $this->setPrimaryKeyAll((substr($primaryKeyAll, 0, - 1)));
        /**
         * All the $_SESSION enviroment.
         */
        if (isset($_SESSION ['staffId'])) {
            $this->setExecuteBy($_SESSION ['staffId']);
        }
        /**
         * TimeStamp Value.
         */
        if ($this->getVendor() == self::MYSQL) {
            $this->setExecuteTime("'" . date("Y-m-d H:i:s") . "'");
        } else if ($this->getVendor() == self::MSSQL) {
            $this->setExecuteTime("'" . date("Y-m-d H:i:s.u") . "'");
        } else if ($this->getVendor() == self::ORACLE) {
            $this->setExecuteTime("to_date('" . date("Y-m-d H:i:s") . "','YYYY-MM-DD HH24:MI:SS')");
        }
    }
 /* (non-PHPdoc)
     * @see ValidationClass::create()
     */ 
    public function create() {
        $this->setIsDefault(0, 0, 'single');
        $this->setIsNew(1, 0, 'single');
        $this->setIsDraft(0, 0, 'single');
        $this->setIsUpdate(0, 0, 'single');
        $this->setIsActive(1, 0, 'single');
        $this->setIsDelete(0, 0, 'single');
        $this->setIsApproved(0, 0, 'single');
        $this->setIsReview(0, 0, 'single');
        $this->setIsPost(0, 0, 'single');
    } 
    /* (non-PHPdoc)
     * @see ValidationClass::update()
     */
    public function update() {
        $this->setIsDefault(0, 0, 'single');
        $this->setIsNew(0, 0, 'single');
        $this->setIsDraft(0, 0, 'single');
        $this->setIsUpdate(1, '', 'single');
        $this->setIsActive(1, 0, 'single');
        $this->setIsDelete(0, 0, 'single');
        $this->setIsApproved(0, 0, 'single');
        $this->setIsReview(0, 0, 'single');
        $this->setIsPost(0, 0, 'single');
    }
    /* (non-PHPdoc) 
     * @see ValidationClass::delete()
     */
    public function delete() {
        $this->setIsDefault(0, 0, 'single');
        $this->setIsNew(0, 0, 'single');
        $this->setIsDraft(0, 0, 'single');
        $this->setIsUpdate(0, 0, 'single');
        $this->setIsActive(0, '', 'single');
        $this->setIsDelete(1, '', 'single');
        $this->setIsApproved(0, 0, 'single');
        $this->setIsReview(0, 0, 'single');
        $this->setIsPost(0, 0, 'single');
    } 
    /* (non-PHPdoc)
     * @see ValidationClass::draft()
     */
    public function draft() {
        $this->setIsDefault(0, 0, 'single');
        $this->setIsNew(1, 0, 'single');
        $this->setIsDraft(1, 0, 'single');
        $this->setIsUpdate(0, 0, 'single');
        $this->setIsActive(0, 0, 'single');
        $this->setIsDelete(0, 0, 'single');
        $this->setIsApproved(0, 0, 'single');
        $this->setIsReview(0, 0, 'single');
        $this->setIsPost(0, 0, 'single');
    }
    /* (non-PHPdoc)
     * @see ValidationClass::approved()
     */
    public function approved() {
        $this->setIsDefault(0, 0, 'single');
        $this->setIsNew(1, 0, 'single');
        $this->setIsDraft(0, 0, 'single');
        $this->setIsUpdate(0, 0, 'single');
        $this->setIsActive(0, 0, 'single');
        $this->setIsDelete(0, 0, 'single');
        $this->setIsApproved(1, 0, 'single');
        $this->setIsReview(0, 0, 'single');
        $this->setIsPost(0, 0, 'single');
    }
    /* (non-PHPdoc)
     * @see ValidationClass::review()
     */
public function review() { 
        $this->setIsDefault(0, 0, 'single');
        $this->setIsNew(1, 0, 'single');
        $this->setIsDraft(0, 0, 'single');
        $this->setIsUpdate(0, 0, 'single');
        $this->setIsActive(0, 0, 'single');
        $this->setIsDelete(0, 0, 'single');
        $this->setIsApproved(0, 0, 'single');
        $this->setIsReview(1, 0, 'single');
        $this->setIsPost(0, 0, 'single');
    } 
    /* (non-PHPdoc)
     * @see ValidationClass::post()
     */
    public function post() {
        $this->setIsDefault(0, 0, 'single');
        $this->setIsNew(1, 0, 'single');
        $this->setIsDraft(0, 0, 'single');
        $this->setIsUpdate(0, 0, 'single');
        $this->setIsActive(0, 0, 'single');
        $this->setIsDelete(0, 0, 'single');
        $this->setIsApproved(1, 0, 'single');
        $this->setIsReview(0, 0, 'single');
        $this->setIsPost(1, 0, 'single');
    }
     /** 
     * Set theme Identification  Value 
     * @param int|array $value 
     * @param array[int]int $key List Of Primary Key. 
     * @param array[int]string $type  List Of Type.0 As 'single' 1 As 'array' 
     **/ 
    public function setThemeId($value, $key, $type) { 
        if ($type == 'single') { 
           $this->themeId = $value;
        } else if ($type == 'array') {
            $this->themeId[$key] = $value;
        } else {
            echo json_encode(array("success" => false, "message" => "Cannot Identifiy Type String Or Array:setthemeId?"));
            exit(); 
        }
    }
    /**
     * Return theme Identification  Value
     * @param array[int]int $key List Of Primary Key.
     * @param array[int]string $type  List Of Type.0 As 'single' 1 As 'array'
     * @return bool|array
     **/
    public function getThemeId($key, $type) {
        if ($type == 'single') {
            return $this->themeId;
        } else if ($type == 'array') {
            return $this->themeId [$key];
        } else {
            echo json_encode(array("success" => false, "message" => "Cannot Identifiy Type String Or Array:getthemeId ?"));
            exit();
        }
    }
    /**
     * To Return themeSequence 
     * @return $themeSequence
     */ 
    public function getThemeSequence()
    {
        return $this->themeSequence;
    }
    /**
     * To Set themeSequence 
     * @param int $themeSequence
     **/
    public function setThemeSequence($themeSequence)
    {
        $this->themeSequence = $themeSequence;
    } 
    /**
     * To Return themeCode 
     * @return $themeCode
     */ 
    public function getThemeCode()
    {
        return $this->themeCode;
    }
    /**
     * To Set themeCode 
     * @param text $themeCode
     **/
    public function setThemeCode($themeCode)
    {
        $this->themeCode = $themeCode;
    } 
    /**
     * To Return themeNote 
     * @return $themeNote
     */ 
    public function getThemeNote()
    {
        return $this->themeNote;
    }
    /**
     * To Set themeNote 
     * @param text $themeNote
     **/
    public function setThemeNote($themeNote)
    {
        $this->themeNote = $themeNote;
    } 
    /**
     * To Return themePath 
     * @return $themePath
     */ 
    public function getThemePath()
    {
        return $this->themePath;
    }
    /**
     * To Set themePath 
     * @param text $themePath
     **/
    public function setThemePath($themePath)
    {
        $this->themePath = $themePath;
    } 
}
?>