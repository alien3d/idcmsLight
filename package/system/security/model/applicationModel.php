<?php  namespace Core\System\Security\Application\Model;
require_once ("../../../../library/class/classValidation.php"); 
/** 
* this is application model file.This is to ensure strict setting enable for all variable enter to database 
 * 
 * @name IDCMS.
 * @version 2
 * @author hafizan
 * @package System 
 * @subpackage Security 
 * @link http://www.idcms.org
 * @license http://www.gnu.org/copyleft/lesser.html LGPL
 */
class ApplicationModel extends \Core\Validation\ValidationClass { 

		

		/**

		* @var int 

		*/

		private $applicationId; 
 
		

		/**

		* @var int 

		*/

		private $iconId; 
 
		

		/**

		* @var int 

		*/

		private $applicationSequence; 
 
		

		/**

		* @var text 

		*/

		private $applicationCode; 
 
		

		/**

		* @var text 

		*/

		private $applicationEnglish; 
 
		

		/**

		* @var text 

		*/

		private $applicationFilename; 
 
		

		/**

		* @var text 

		*/

		private $applicationDashboardFilename; 
 
		

		/**

		* @var tiny 

		*/

		private $isSingle; 
  /* (non-PHPdoc)
	 * @see ValidationClass::execute()
	 */
	public function execute() {
		/*
		 *  Basic Information Table
		 */
		$this->setTableName('application');
		$this->setPrimaryKeyName('applicationId');
		$this->setMasterForeignKeyName('applicationId');
		//$this->setFilterCharacter('applicationDesc');
		//$this->setFilterCharacter('applicationNote');
		$this->setFilterDate('applicationDate');
		/**
		 * All the Array enviroment.
		 */ 
if (isset($_POST ['applicationId'])) { 
     $this->setApplicationId($this->strict($_POST ['applicationId'], 'int'), 0, 'single'); 
 } 
 if (isset($_POST ['iconId'])) { 
     $this->setIconId($this->strict($_POST ['iconId'], 'int')); 
 } 
 if (isset($_POST ['applicationSequence'])) { 
     $this->setApplicationSequence($this->strict($_POST ['applicationSequence'], 'int')); 
 } 
 if (isset($_POST ['applicationCode'])) { 
     $this->setApplicationCode($this->strict($_POST ['applicationCode'], 'text')); 
 } 
 if (isset($_POST ['applicationEnglish'])) { 
     $this->setApplicationEnglish($this->strict($_POST ['applicationEnglish'], 'text')); 
 } 
 if (isset($_POST ['applicationFilename'])) { 
     $this->setApplicationFilename($this->strict($_POST ['applicationFilename'], 'text')); 
 } 
 if (isset($_POST ['applicationDashboardFilename'])) { 
     $this->setApplicationDashboardFilename($this->strict($_POST ['applicationDashboardFilename'], 'text')); 
 } 
 if (isset($_POST ['isSingle'])) { 
     $this->setIsSingle($this->strict($_POST ['isSingle'], 'tiny')); 
 } 
 		/**
		 * All the $_GET enviroment.
		 */
if (isset($_GET ['applicationId'])) { 
     $this->setApplicationId($this->strict($_GET ['applicationId'], 'int'), 0, 'single'); 
 } 
 if (isset($_GET ['iconId'])) { 
     $this->setIconId($this->strict($_GET ['iconId'], 'int')); 
 } 
 if (isset($_GET ['applicationSequence'])) { 
     $this->setApplicationSequence($this->strict($_GET ['applicationSequence'], 'int')); 
 } 
 if (isset($_GET ['applicationCode'])) { 
     $this->setApplicationCode($this->strict($_GET ['applicationCode'], 'text')); 
 } 
 if (isset($_GET ['applicationEnglish'])) { 
     $this->setApplicationEnglish($this->strict($_GET ['applicationEnglish'], 'text')); 
 } 
 if (isset($_GET ['applicationFilename'])) { 
     $this->setApplicationFilename($this->strict($_GET ['applicationFilename'], 'text')); 
 } 
 if (isset($_GET ['applicationDashboardFilename'])) { 
     $this->setApplicationDashboardFilename($this->strict($_GET ['applicationDashboardFilename'], 'text')); 
 } 
 if (isset($_GET ['isSingle'])) { 
     $this->setIsSingle($this->strict($_GET ['isSingle'], 'tiny')); 
 } 
 		if (isset($_GET ['applicationId'])) {
			$this->setTotal(count($_GET ['applicationId']));
             if (is_array($_GET ['applicationId'])) {
                 $this->applicationId = array();
             }
		}
		if (isset($_GET ['isDefault'])) {
             $this->setIsDefaultTotal(count($_GET['isDefault']));
             if (is_array($_GET ['isDefault'])) {
                 $this->isDefault = array();
             }
		}
		if (isset($_GET ['isNew'])) {
             $this->setIsNewTotal(count($_GET['isNew']));
			if (is_array($_GET ['isNew'])) {
				$this->isNew = array();
			}
		}
		if (isset($_GET ['isDraft'])) {
             $this->setIsDraftTotal(count($_GET['isDraft']));
			if (is_array($_GET ['isDraft'])) {
				$this->isDraft = array();
			}
		}
		if (isset($_GET ['isUpdate'])) {
             $this->setIsUpdateTotal(count($_GET['isUpdate']));
			if (is_array($_GET ['isUpdate'])) {
				$this->isUpdate = array();
			}
		}
		if (isset($_GET ['isDelete'])) {
             $this->setIsDeleteTotal(count($_GET['isDelete']));
			if (is_array($_GET ['isDelete'])) {
				$this->isDelete = array();
			}
		}
		if (isset($_GET ['isActive'])) {
             $this->setIsActiveTotal(count($_GET['isActive']));
			if (is_array($_GET ['isActive'])) {
				$this->isActive = array();
			}
		}
		if (isset($_GET ['isApproved'])) {
             $this->setIsApprovedTotal(count($_GET['isApproved']));
			if (is_array($_GET ['isApproved'])) {
				$this->isApproved = array();
			}
		}
		if (isset($_GET ['isReview'])) {
             $this->setIsReviewTotal(count($_GET['isReview']));
			if (is_array($_GET ['isReview'])) {
				$this->isReview = array();
			}
		}
		if (isset($_GET ['isPost'])) {
             $this->setIsPostTotal(count($_GET['isPost']));
			if (is_array($_GET ['isPost'])) {
				$this->isPost = array();
			}
		}
		$primaryKeyAll = '';
		for ($i = 0; $i < $this->getTotal(); $i++) {
			if (isset($_GET ['applicationId'])) {
				$this->setApplicationId($this->strict($_GET ['applicationId'] [$i], 'numeric'), $i, 'array');
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
			$primaryKeyAll .= $this->getApplicationId($i, 'array') . ",";
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
     * Set application Identification  Value 
     * @param int|array $value 
     * @param array[int]int $key List Of Primary Key. 
     * @param array[int]string $type  List Of Type.0 As 'single' 1 As 'array' 
     **/ 
    public function setApplicationId($value, $key, $type) { 
        if ($type == 'single') { 
           $this->applicationId = $value;
        } else if ($type == 'array') {
            $this->applicationId[$key] = $value;
        } else {
            echo json_encode(array("success" => false, "message" => "Cannot Identifiy Type String Or Array:setapplicationId?"));
            exit(); 
        }
    }
    /**
     * Return application Identification  Value
     * @param array[int]int $key List Of Primary Key.
     * @param array[int]string $type  List Of Type.0 As 'single' 1 As 'array'
     * @return bool|array
     **/
    public function getApplicationId($key, $type) {
        if ($type == 'single') {
            return $this->applicationId;
        } else if ($type == 'array') {
            return $this->applicationId [$key];
        } else {
            echo json_encode(array("success" => false, "message" => "Cannot Identifiy Type String Or Array:getapplicationId ?"));
            exit();
        }
	}
	/**
	 * To Return iconId 
	 * @return $iconId
	 */ 
	public function getIconId()
	{
	    return $this->iconId;
	}
	/**
	 * To Set iconId 
	 * @param int $iconId
	 **/
	public function setIconId($iconId)
	{
	    $this->iconId = $iconId;
	} 
	/**
	 * To Return applicationSequence 
	 * @return $applicationSequence
	 */ 
	public function getApplicationSequence()
	{
	    return $this->applicationSequence;
	}
	/**
	 * To Set applicationSequence 
	 * @param int $applicationSequence
	 **/
	public function setApplicationSequence($applicationSequence)
	{
	    $this->applicationSequence = $applicationSequence;
	} 
	/**
	 * To Return applicationCode 
	 * @return $applicationCode
	 */ 
	public function getApplicationCode()
	{
	    return $this->applicationCode;
	}
	/**
	 * To Set applicationCode 
	 * @param text $applicationCode
	 **/
	public function setApplicationCode($applicationCode)
	{
	    $this->applicationCode = $applicationCode;
	} 
	/**
	 * To Return applicationEnglish 
	 * @return $applicationEnglish
	 */ 
	public function getApplicationEnglish()
	{
	    return $this->applicationEnglish;
	}
	/**
	 * To Set applicationEnglish 
	 * @param text $applicationEnglish
	 **/
	public function setApplicationEnglish($applicationEnglish)
	{
	    $this->applicationEnglish = $applicationEnglish;
	} 
	/**
	 * To Return applicationFilename 
	 * @return $applicationFilename
	 */ 
	public function getApplicationFilename()
	{
	    return $this->applicationFilename;
	}
	/**
	 * To Set applicationFilename 
	 * @param text $applicationFilename
	 **/
	public function setApplicationFilename($applicationFilename)
	{
	    $this->applicationFilename = $applicationFilename;
	} 
	/**
	 * To Return applicationDashboardFilename 
	 * @return $applicationDashboardFilename
	 */ 
	public function getApplicationDashboardFilename()
	{
	    return $this->applicationDashboardFilename;
	}
	/**
	 * To Set applicationDashboardFilename 
	 * @param text $applicationDashboardFilename
	 **/
	public function setApplicationDashboardFilename($applicationDashboardFilename)
	{
	    $this->applicationDashboardFilename = $applicationDashboardFilename;
	} 
	/**
	 * To Return isSingle 
	 * @return $isSingle
	 */ 
	public function getIsSingle()
	{
	    return $this->isSingle;
	}
	/**
	 * To Set isSingle 
	 * @param tiny $isSingle
	 **/
	public function setIsSingle($isSingle)
	{
	    $this->isSingle = $isSingle;
	} 
}
?>