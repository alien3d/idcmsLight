<?php  namespace Core\Sample\Religion\Religionsample\Model;
require_once ("../../../../library/class/classValidation.php"); 
/** 
* this is religionsample model file.This is to ensure strict setting enable for all variable enter to database 
 * 
 * @name IDCMS.
 * @version 2
 * @author hafizan
 * @package Sample 
 * @subpackage Religion 
 * @link http://www.idcms.org
 * @license http://www.gnu.org/copyleft/lesser.html LGPL
 */
class ReligionsampleModel extends \Core\Validation\ValidationClass { 

		

		/**

		* @var int 

		*/

		private $religionSampleId; 
 
		

		/**

		* @var text 

		*/

		private $religionSampleTitle; 
 
		

		/**

		* @var text 

		*/

		private $religionSampleNote;
              
  /* (non-PHPdoc)
	 * @see ValidationClass::execute()
	 */
	public function execute() {
		/*
		 *  Basic Information Table
		 */
		$this->setTableName('religionsample');
		$this->setPrimaryKeyName('religionSampleId');
		$this->setMasterForeignKeyName('religionSampleId');
		//$this->setFilterCharacter('religionsampleDesc');
		$this->setFilterCharacter('religionsampleTitle');
		$this->setFilterDate('religionsampleDate');
		/**
		 * All the Array enviroment.
		 */ 
if (isset($_POST ['religionSampleId'])) { 
     $this->setReligionSampleId($this->strict($_POST ['religionSampleId'], 'int'), 0, 'single'); 
 } 
 if (isset($_POST ['religionSampleTitle'])) { 
     $this->setReligionSampleTitle($this->strict($_POST ['religionSampleTitle'], 'text')); 
 } 
 if (isset($_POST ['religionSampleNote'])) { 
     $this->setReligionSampleNote($this->strict($_POST ['religionSampleNote'], 'text')); 
 } 
 		/**
		 * All the $_GET enviroment.
		 */
if (isset($_GET ['religionSampleId'])) { 
     $this->setReligionSampleId($this->strict($_GET ['religionSampleId'], 'int'), 0, 'single'); 
 } 
 if (isset($_GET ['religionSampleTitle'])) { 
     $this->setReligionSampleTitle($this->strict($_GET ['religionSampleTitle'], 'text')); 
 } 
 if (isset($_GET ['religionSampleNote'])) { 
     $this->setReligionSampleNote($this->strict($_GET ['religionSampleNote'], 'text')); 
 } 
 		if (isset($_GET ['religionSampleId'])) {
			$this->setTotal(count($_GET ['religionSampleId']));
                        if(is_array($_GET ['religionSampleId'])) {
                            $this->religionSampleId=array();
                        }
		}
		if (isset($_GET ['isDefault'])) {
             $this->setIsDefaultTotal(count($_GET['isDefault']));             if (is_array($_GET ['isDefault'])) {
                 $this->isDefault = array();
             }
		}
		if (isset($_GET ['isNew'])) {
             $this->setIsNewTotal(count($_GET['isNew']));			if (is_array($_GET ['isNew'])) {
				$this->isNew = array();
			}
		}
		if (isset($_GET ['isDraft'])) {
             $this->setIsDraftTotal(count($_GET['isDraft']));			if (is_array($_GET ['isDraft'])) {
				$this->isDraft = array();
			}
		}
		if (isset($_GET ['isUpdate'])) {
             $this->setIsUpdateTotal(count($_GET['isUpdate']));			if (is_array($_GET ['isUpdate'])) {
				$this->isUpdate = array();
			}
		}
		if (isset($_GET ['isDelete'])) {
             $this->setIsDeleteTotal(count($_GET['isDelete']));			if (is_array($_GET ['isDelete'])) {
				$this->isDelete = array();
			}
		}
		if (isset($_GET ['isActive'])) {
             $this->setIsActiveTotal(count($_GET['isActive']));			if (is_array($_GET ['isActive'])) {
				$this->isActive = array();
			}
		}
		if (isset($_GET ['isApproved'])) {
             $this->setIsApprovedTotal(count($_GET['isApproved']));			if (is_array($_GET ['isApproved'])) {
				$this->isApproved = array();
			}
		}
		if (isset($_GET ['isReview'])) {
             $this->setIsReviewTotal(count($_GET['isReview']));			if (is_array($_GET ['isReview'])) {
				$this->isReview = array();
			}
		}
		if (isset($_GET ['isPost'])) {
             $this->setIsPostTotal(count($_GET['isPost']));			if (is_array($_GET ['isPost'])) {
				$this->isPost = array();
			}
		}
		$primaryKeyAll = '';
		for ($i = 0; $i < $this->getTotal(); $i++) {
			if (isset($_GET ['religionSampleId'])) {
				$this->setReligionSampleId($this->strict($_GET ['religionSampleId'] [$i], 'numeric'), $i, 'array');
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
			$primaryKeyAll .= $this->getReligionSampleId($i, 'array') . ",";
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
     * Set religionsample Identification  Value 
     * @param int|array $value 
     * @param array[int]int $key List Of Primary Key. 
     * @param array[int]string $type  List Of Type.0 As 'single' 1 As 'array' 
     **/ 
    public function setReligionSampleId($value, $key, $type) { 
        if ($type == 'single') { 
           $this->religionSampleId = $value;
        } else if ($type == 'array') {
            $this->religionSampleId[$key] = $value;
        } else {
            echo json_encode(array("success" => false, "message" => "Cannot Identifiy Type String Or Array:setreligionSampleId?"));
            exit(); 
        }
    }
    /**
     * Return religionsample Identification  Value
     * @param array[int]int $key List Of Primary Key.
     * @param array[int]string $type  List Of Type.0 As 'single' 1 As 'array'
     * @return bool|array
     **/
    public function getReligionSampleId($key, $type) {
        if ($type == 'single') {
            return $this->religionSampleId;
        } else if ($type == 'array') {
            return $this->religionSampleId [$key];
        } else {
            echo json_encode(array("success" => false, "message" => "Cannot Identifiy Type String Or Array:getreligionSampleId ?"));
            exit();
        }
	}
	/**
	 * To Return religionSampleTitle 
	 * @return $religionSampleTitle
	 */ 
	public function getReligionSampleTitle()
	{
	    return $this->religionSampleTitle;
	}
	/**
	 * To Set religionSampleTitle 
	 * @param text $religionSampleTitle
	 **/
	public function setReligionSampleTitle($religionSampleTitle)
	{
	    $this->religionSampleTitle = $religionSampleTitle;
	} 
	/**
	 * To Return religionSampleNote 
	 * @return $religionSampleNote
	 */ 
	public function getReligionSampleNote()
	{
	    return $this->religionSampleNote;
	}
	/**
	 * To Set religionSampleNote 
	 * @param text $religionSampleNote
	 **/
	public function setReligionSampleNote($religionSampleNote)
	{
	    $this->religionSampleNote = $religionSampleNote;
	} 
}
?>