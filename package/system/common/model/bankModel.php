<?php
namespace Core\System\Common\Bank\Model;
require_once ("../../../../library/class/classValidation.php");

/**
 * this is Bank model file.This is to ensure strict setting enable for all variable enter to database
 *
 * @name IDCMS.
 * @version 2
 * @author hafizan
 * @package Bank
 * @link http://www.idcms.org
 * @license http://www.gnu.org/copyleft/lesser.html LGPL
 */
class BankModel extends \Core\Validation\ValidationClass {

	/**
	 * @var int
	 */
	private $bankId;
	/**
	 * @var int
	 */
	private $generalLedgerChartOfAccountId;
	/**
	 * @var string
	 */
	private $bankCode;
	/**
	 * @var string
	 */
	private $bankSwiftCode;
	/**
	 * @var string
	 */
	private $bankSwiftCodeCity;
	/**
	 * @var string
	 */
	private $bankSwiftCodeBranch;
	/**
	 * @var string
	 */
	private $bankMepsCode;
	/**
	 * @var string
	 */
	private $bankDesc;


	/* (non-PHPdoc)
	 * @see ValidationClass::execute()
	 */

	public function execute() {
		/*
		 *  Basic Information Table
		 */
		$this->setTableName('bank');
		$this->setPrimaryKeyName('bankId');
		/**
		 * All the $_POST enviroment.
		 */
		if (isset($_POST ['bankId'])) {
			$this->setBankId($this->strict($_POST ['bankId'], 'numeric'), 0, 'single');
		}
		if (isset($_POST ['generalLedgerChartOfAccountId'])) {
			$this->setGeneralLedgerChartOfAccountId($this->strict($_POST ['generalLedgerChartOfAccountId'], 'numeric'));
		}
		if (isset($_POST ['bankCode'])) {
			$this->setBankCode($this->strict($_POST ['bankCode'], 'memo'));
		}
		if (isset($_POST ['bankSwiftCode'])) {
			$this->setBankSwiftCode($this->strict($_POST ['bankSwiftCode'], 'memo'));
		}
		if (isset($_POST ['bankSwiftCodeCity'])) {
			$this->setBankSwiftCodeCity($this->strict($_POST ['bankSwiftCodeCity'], 'memo'));
		}
		if (isset($_POST ['bankSwiftCodeBranch'])) {
			$this->setBankSwiftCodeBranch($this->strict($_POST ['bankSwiftCodeBranch'], 'memo'));
		}
		if (isset($_POST ['bankMepsCode'])) {
			$this->setBankMepsCodeCity($this->strict($_POST ['bankMepsCode'], 'memo'));
		}
		if (isset($_POST ['bankCode'])) {
			$this->setBankCode($this->strict($_POST ['bankCode'], 'memo'));
		}
		if (isset($_POST ['bankCode'])) {
			$this->setBankCode($this->strict($_POST ['bankCode'], 'memo'));
		}
		if (isset($_POST ['bankCode'])) {
			$this->setBankCode($this->strict($_POST ['bankCode'], 'memo'));
		}
		if (isset($_POST ['bankDesc'])) {
			$this->setBankDesc($this->strict($_POST ['bankDesc'], 'memo'));
		}
		/**
		 * All the $_GET enviroment.
		 */
		if (isset($_GET ['bankId'])) {
			$this->setTotal(count($_GET ['bankId']));
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
			if (isset($_GET ['bankId'])) {
				$this->setBankId($this->strict($_GET ['bankId'] [$i], 'numeric'), $i, 'array');
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
			$primaryKeyAll .= $this->getBankId($i, 'array') . ",";
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
	 * Set Bank Identification  Value
	 * @param int|array $value
	 * @param array[int]int $key List Of Primary Key.
	 * @param array[int]string $type  List Of Type.0 As 'single' 1 As 'array'
	 */
	public function setBankId($value, $key, $type) {
		if ($type == 'single') {
			$this->bankId = $value;
		} else if ($type == 'array') {
			$this->bankId [$key] = $value;
		} else {
			echo json_encode(array("success" => false, "message" => "Cannot Identifiy Type String Or Array:setBankId ?"));
			exit();
		}
	}

	/**
	 * Return Bank Identification  Value
	 * @param array[int]int $key List Of Primary Key.
	 * @param array[int]string $type  List Of Type.0 As 'single' 1 As 'array'
	 * @return bool|array
	 */
	public function getBankId($key, $type) {
		if ($type == 'single') {
			return $this->bankId;
		} else if ($type == 'array') {
			return $this->bankId [$key];
		} else {
			echo json_encode(array("success" => false, "message" => "Cannot Identifiy Type String Or Array:getBankId ?"));
			exit();
		}
	}





	/**
	 *
	 * @return
	 */
	public function getBankCode()
	{
		return $this->bankCode;
	}

	/**
	 *
	 * @param $bankCode
	 */
	public function setBankCode($bankCode)
	{
		$this->bankCode = $bankCode;
	}

	/**
	 *
	 * @return
	 */
	public function getBankDesc()
	{
		return $this->bankDesc;
	}

	/**
	 *
	 * @param $bankDesc
	 */
	public function setBankDesc($bankDesc)
	{
		$this->bankDesc = $bankDesc;
	}

	/**
	 *
	 * @return
	 */
	public function getBankSwiftCode()
	{
		return $this->bankSwiftCode;
	}

	/**
	 *
	 * @param $bankSwiftCode
	 */
	public function setBankSwiftCode($bankSwiftCode)
	{
		$this->bankSwiftCode = $bankSwiftCode;
	}

	/**
	 *
	 * @return
	 */
	public function getBankSwiftCodeCity()
	{
		return $this->bankSwiftCodeCity;
	}

	/**
	 *
	 * @param $bankSwiftCodeCity
	 */
	public function setBankSwiftCodeCity($bankSwiftCodeCity)
	{
		$this->bankSwiftCodeCity = $bankSwiftCodeCity;
	}

	/**
	 *
	 * @return
	 */
	public function getBankSwiftCodeBranch()
	{
		return $this->bankSwiftCodeBranch;
	}

	/**
	 *
	 * @param $bankSwiftCodeBranch
	 */
	public function setBankSwiftCodeBranch($bankSwiftCodeBranch)
	{
		$this->bankSwiftCodeBranch = $bankSwiftCodeBranch;
	}

	/**
	 *
	 * @return
	 */
	public function getBankMepsCode()
	{
		return $this->bankMepsCode;
	}

	/**
	 *
	 * @param $bankMepsCode
	 */
	public function setBankMepsCode($bankMepsCode)
	{
		$this->bankMepsCode = $bankMepsCode;
	}

	public function getGeneralLedgerChartOfAccountId()
	{
		return $this->generalLedgerChartOfAccountId;
	}

	public function setGeneralLedgerChartOfAccountId($generalLedgerChartOfAccountId)
	{
		$this->generalLedgerChartOfAccountId = $generalLedgerChartOfAccountId;
	}
}

?>
