<?php
namespace Core;
/**
 * this is main setting files
 * @name IDCMS
 * @version 2
 * @author hafizan
 * @link http://www.idcms.org
 * @license http://www.gnu.org/copyleft/lesser.html LGPL
 */
date_default_timezone_set("Asia/Kuala_Lumpur");
require_once 'PHPExcel.php';
require_once 'PHPExcel/IOFactory.php';
/**
 * Database Configuration File and Database
 * @author hafizan
 *
 */
abstract class ConfigClass
{
	/**
	 * Program Identification
	 * @var int
	 */
	private $leafId;
	/**
	 * User Identification
	 * @var int
	 */
	private $staffId;
	/**
	 * Database Connection
	 * @var string
	 */
	private $connection;
	/**
	 * Database Name
	 * @var string
	 */
	private $database;
	/**
	 * Database Name
	 * @var string
	 */
	private $username;
	/**
	 * Staff Password.
	 * @var string
	 */
	private $password;
	/**
	 * Database Vendor
	 * @var string
	 */
	private $vendor;
	/**
	 * Extjs Field Query UX
	 * @var string
	 */
	private $fieldQuery;
	/**
	 * Extjs Grid  Filter Plugin
	 * @var string
	 */
	private $gridQuery;
	/**
	 * Character Based Query Style
	 * @var string
	 */
	private $characterQuery;
	/**
	 * Date Filtering Query Style
	 * @var date
	 */
	private $dateRangeStartQuery;
	/**
	 * Date Filtering Query Style
	 * @var date
	 */
	private $dateRangeEndQuery;
	/**
	 * Day,Week,Month,Year
	 * @var string
	 */
	private $dateRangeTypeQuery;
        /**
	 * Previous or Next Day,Week,Month,Year
	 * @var string
	 */
	private $dateRangeExtraTypeQuery;
	/**
	 * Start Day
	 * @var string
	 */
	private $startDay;
	/**
	 * Start Week
	 * @var string
	 */
	private $startWeek;
	/**
	 * Start Month
	 * @var string
	 */
	private $startMonth;
	/**
	 * Start Year
	 * @var string
	 */
	private $startYear;
	/**
	 * End Day
	 * @var string
	 */
	private $endDay;
	/**
	 * End Week
	 * @var string
	 */
	private $endWeek;
	/**
	 * End Month
	 * @var string
	 */
	private $endMonth;
	/**
	 * End Year
	 * @var string
	 */
	private $endYear;
	/**
	 * End Month
	 * @var string
	 */
	private $filterMonth;
	/**
	 * End Year
	 * @var string
	 */
	private $filterYear;
	/**
	 * Start
	 * @var string
	 */
	private $start;
	/**
	 * Limit
	 * @var string
	 */
	private $limit;
	/**
	 **
	 * Ascending ,Descending ASC,DESC
	 * @var string
	 */
	private $order;
	/**
	 * Sort the default field.Mostly consider as primary key default.
	 * @var string
	 */
	private $sortField;
	/**
	 * Default Language  : English
	 * @var int
	 */
	private $defaultLanguageId;
	/**
	 * Open To See Audit  Column --> approved,new,delete and e.g
	 * @var int
	 */
	private $isAdmin;
	/**
	 * Enter description here ...
	 * @var string
	 */
	public $value;
	/**
	 * Enter description here ...
	 * @var string
	 */
	public $type;
	/**
	 * Path Of the application
	 * @var string
	 */
	private $application;
	/**
	 * Request Database
	 * @var string
	 */
	private $requestDatabase;
        /**
	 * Message Error Handling
	 * @var string
	 */
        public $message;
        /**
	 * Identification Of The Page
	 * @var numeric
	 */
        public $PageId;
        /**
	 * Full Or Sidebar
	 * @var enum
	 */
        public $pageType;
        /**
	 * HTML , JSON
	 * @var enum
	 */
        public $pageOutput;
        /**
	 * View Name.
	 * @var string
	 */
        public $viewFilename;
        /**
	 * View Path.Not automatic because give flexibility
	 * @var string
	 */
        public $viewPath;
        /**
	 * Controller Path.
	 * @var string
	 */
        public $controllerFilename;
        /**
	 * Controller Path.Not automatic because give flexibility
	 * @var string
	 */
        public $controllerPath;
        /**
	 * Service Filename
	 * @var string
	 */
        public $serviceFilename;
        /**
	 * Service Path.Not automatic because give flexibility
	 * @var string
	 */
     public $servicePath;
    /**
     * Return Security Token
     * @var string 
     */
    private $securityToken;
	/**
	 *
	 * @var $currentDatabase
	 */
	private $currentDatabase;
	/**
	 *
	 * @var $currentTable
	 */
	private $currentTable;
	
	/**
	 * Mysql Database (open Core)
	 * @var const string
	 */
	const MYSQL = 'mysql';
	/**
	 * Microsoft Sql Server Database (Close Source)
	 * @var const string
	 */
	const MSSQL = 'microsoft';
	/**
	 * Oracle Database (Close  Source)
	 * @var const string
	 */
	const ORACLE = 'oracle';
	/**
	 * Database DB2 IBM ( Close Source)
	 * @var const string
	 */
	const DB2 = 'db2';
	/**
	 * Postgress (Open Source)
	 * @var const string
	 */
	const POSTGRESS = 'postgress';
	/**
	 * Cubrid Database ? korean database
	 * @var const string
	 */
	const CUBRID = 'cubrid';
	/**
	 * Firebird / Interbase
	 * @var const string
	 */
	const IBASE = 'ibase';

	// end basic access database
	/*
	 *   @version  0.1  filter strict php setting
	 */
	function __construct ()
	{
		//optional
                
		if (isset($_SESSION['vendor'])) {
			$this->setVendor($_SESSION['vendor']);
		} else {
                    $this->setVendor(self::MYSQL); // testing period only
                }
		if (isset($_SESSION['languageId'])) {
			$this->setLanguageId($_SESSION['languageId']);
		}
		if (isset($_SESSION['staffId'])) {
			$this->setStaffId($_SESSION['staffId']);
		}
                
		if ($this->getVendor() == self::MYSQL) {
			require_once ('classMysql.php');
                        
			$this->setConnection('localhost');
			$this->setUsername('root');
			$this->setPassword('123456');
			$this->setApplication('idcmsCore');
		} elseif ($this->getVendor() == self::MSSQL) {
			require_once ('classMssql.php');
			$this->setConnection('ADMIN-PC\X2');
			$this->setUsername('root');
			$this->setpassword("pa\$\$word4SPH");
			$this->setApplication('idcmsCore');
		} elseif ($this->getVendor() == self::ORACLE) {
			require_once ('classOracle.php');
			$this->setConnection('localhost');
			$this->setUsername('idcmsCore');
			$this->setPassword('pa$$word4SPH');
			$this->setApplication('idcmsCore');
		} elseif ($this->getVendor() == self::DB2) {
			require_once ('classDb2.php');
			//$this->setConnection('ADMIN-PC\X2');  // not required
			$this->setUsername('db2admin');
			$this->setpassword("123456");
			$this->setApplication('Core');

		} elseif ($this->getVendor() == self::POSTGRESS) {
			require_once ('classPostgress.php');
			$this->setConnection('localhost');
			$this->setUsername('idcmsCore');
			$this->setPassword('pa$$word4SPH');
		} else {
			// undefined database vendor and application
		}
		$this->setDefaultLanguageId(21);
                // set per page.please overide at the controller if  don't want the same.
                
	}
	/**
	 * New Record From Database
	 */
	abstract protected function create ();
	/**
	 * Read Record From Databaase
	 */
	abstract protected function read ();
	/**
	 * Update Record From Database
	 */
	abstract protected function update ();
	/**
	 * Delete Record From Database
	 */
	abstract protected function delete ();
	/**
	 * Microsoft Excel 2007 Ouput File Generation
	 */
	abstract protected function excel ();
	/**
	 * Return Staff Name
	 */
	public function staff ()
	{
		header('Content-Type:application/json; charset=utf-8');
		$time_start = microtime(true);

		if ($this->getVendor() == self::MYSQL) {
			$sql = "
			SELECT 	`staffId`,
					`staffNo`,
					`staffName`
			FROM   	`staff`
			WHERE	`isActive`=1";
		} else
		if ($this->getVendor() == self::MSSQL) {
			$sql = "
			SELECT 	[staffId],
					[staffNo],
					[staffName]
			FROM   	[staff]
			WHERE  	[isActive]=1";
		} else
		if ($this->getVendor() == self::ORACLE) {
			$sql = "
			SELECT 	STAFFID 	AS 	\"staffId\",
					STAFFNO 	AS 	\"staffNo\",
					STAFFNAME 	AS  \"staffName\"
			FROM   	STAFF 		
			WHERE	STAFF.ISACTIVE=1";
		}else
		if ($this->getVendor() == self::DB2) {
			$sql = "
			SELECT 	STAFFID 	AS 	\"staffId\",
					STAFFNO 	AS 	\"staffNo\",
					STAFFNAME 	AS  \"staffName\"
			FROM   	STAFF 		
			WHERE	STAFF.ISACTIVE=1";
		}else
		if ($this->getVendor() == self::POSTGRESS) {
			$sql = "
			SELECT 	STAFFID 	AS 	\"staffId\",
					STAFFNO 	AS 	\"staffNo\",
					STAFFNAME 	AS  \"staffName\"
			FROM   	STAFF 		
			WHERE	STAFF.ISACTIVE=1";
		}
		$result = $this->q->fast($sql);
		$total = $this->q->numberRows($result);
		$items = array();
		while (($row = $this->q->fetchAssoc($result)) == TRUE) {
			$items[] = $row;
		}
		$time_end = microtime(true);
		$time = $time_end - $time_start;
		echo json_encode(
		array('success' => true, 'total' => $total, 'time'=>$time,'message' => $this->systemString->getReadMessage(),
        'staff' => $items));
	}
	/**
	 *	Generate Document no
	 */
	function documentNumbering(){
		// this is to generate doc_no
		$sqlDocumentNumberingUpdate="
		UPDATE	`documentSequence`
		SET     `documentSequenceNumber` =`documentSequenceNumber` + 1
		WHERE   `documentSequenceId` =
		(
		 	SELECT  `documentSequenceId`
			FROM  	`documentSetting`
			WHERE 	`leafId`='".$this->getleafId()."'
		)";
		$this->q->update($sqlDocumentNumberingUpdate);
		if ($this->q->execute == 'fail') {
			echo json_encode(array("success" => false, "message" => $this->q->responce));
			exit();
		}
		$sqlDocumentNumbering="
		SELECT	CONCAT(`documentSequenceCode`,`documentSequenceNumber`) AS `documentNumber`
		FROM  	`documentSequence`
		WHERE	`documentSequenceId` =
		(
		 	SELECT  `documentSequenceId`
			FROM  	`documentSetting`
			WHERE 	`leafId`='".$this->getleafId()."'
		)
		";

		$resultDocumentNumbering=$this->q->fast($sqlDocumentNumbering);
		if ($this->q->execute == 'fail') {
			echo json_encode(array("success" => false, "message" => $this->q->responce));
			exit();
		}
		$rowDocumentNumbering = $this->q->fetchArray($resultDocumentNumbering);
			
		return $rowDocumentNumbering['documentNumber'];
	}
	/**
	 * to filter data type.
	 * @param value $v
	 * value variable come from server request or variable
	 * @param type $t
	 * Available data type password or p ,
	 * numeric  or n,
	 * booleand or b,
	 * string   or s,
	 * wyswg    or w
	 * memo     or m,
	 * float    or f,
	 * date     or d
	 * username or u
	 * calender or
	 * web      or wb
	 * iconname   or i
	 * * @version 0.1 addd filter addslasshes
	 * @return NULL|string|Ambigous <NULL, number, value, string, mixed>|number|unknown
	 */
	public function strict ($v, $t,$dateFormat=null)
	{
		$this->value = $v;
		$this->type = $t;
		// short form code available
		if ($this->type == 'password' || $this->type == 'p') {
			if (strlen($this->value) != 32) {
				if (empty($this->value)) {
					return null;
				}
			}
			return (addslashes($this->value));
		} elseif ($this->type == 'numeric' || $this->type == 'n' || $this->type == 'int') {
			if (! is_numeric($this->value)) {
				$this->value = 0;
				return ($this->value);
			} else {
				return (intval($this->value));
			}
		} elseif ($this->type == 'boolean' || $this->type == 'b') {
			if ($this->value == 'true' || $this->value == 'TRUE' ||  $this->value == true  || $this->value  == TRUE ) {
				return 1;
			} elseif ($this->value == 'false' || $this->value == 'FALSE' ||  $this->value == false   || $this->value  == FALSE ) {
				return 0;
			}
		} elseif ($this->type == 'string' || $this->type == 's' || $this->type == 'text') {
			if (empty($this->value) && (strlen($this->value) == 0)) {
				$this->value = null;
				return ($this->value);
			} elseif (strlen($this->value) == 0) {
				$this->value = null;
				return ($this->value);
			} else {

				//$this->value=trim(strtoupper($this->value)); // trim any space better for searching issue
				$this->value = addslashes($this->value);
				return $this->value;
			}
		} else
		if (($this->type == 'email' || $this->type == 'e') ||
		($this->type == 'filename' || $this->type == 'f') ||
		($this->type == 'iconname' || $this->type == 'i') ||
		($this->type == 'calendar' || $this->type == 'c') ||
		($this->type == 'username' || $this->type == 'u') ||
		($this->type == 'web' || $this->type == 'wb')) {
			if (empty($this->value) && (strlen($this->value) == 0)) {
				$this->value = null;
				return ($this->value);
			} elseif (strlen($this->value) == 0) {
				$this->value = null;
				return ($this->value);
			} else {
				$this->value = trim($this->value); // trim any space better for searching issue
				return $this->value;
			}
		} elseif ($this->type == 'wyswyg' || $this->type == 'w') {
			// just return back
			// addslashes will destroy the code
			$this->value = addslashes(
			$this->value);
			return (htmlspecialchars($this->value));
		} elseif ($this->type == 'blob') {
			// this is easy for php/mysql developer
			$this->value = addslashes($this->value);
			return (htmlspecialchars($this->value));
		} elseif ($this->type == 'memo' || $this->type == 'm') {
			// this is easy for vb/access developer
			$this->value = addslashes($this->value);
			return (htmlspecialchars($this->value));
		} elseif ($this->type == 'currency') {
			// make easier for vb.net programmer to understand float value
			$this->value = str_replace("$", "",
			$this->value); // filter for extjs if exist
			$this->value = str_replace(",", "",
			$this->value);
			return ($this->value);
		} elseif ($this->type == 'float' || $this->type == 'f') {
			// make easier c programmer to understand float value
			$this->value = str_replace("$", "",
			$this->value); // filter for extjs if exist
			$this->value = str_replace(",", "",
			$this->value);
			return ($this->value);
		} elseif ($this->type == 'date' || $this->type == 'd') {
			// ext date like this mm/dd yy03/03/07
			// ext date mm/dd/yy mysql date yyyymmdd
			//ext allready validate date at javascript runtime
			// check either the date empty or not if empty key in today value
			if (empty($this->value)) {
				return (date("Y-m-d"));
			} else {
				return $value; // no need to check..
				/**
				 * Windows Date Format 
				 * d,dd = day;
				 * ddd,dddd  = day of week
				 * M = month,
				 * MMM =  use  3 digit  short cut month
				 * y = year
				 
				if(empty($dateFormat)) {
					$dateFormat='dd/mm/YYYY'; // this is base on pc date format
				}
				// By default we only support five type of date format only
				switch ($this->checkDateFormat()) {
					
					case 'dd/mm/YYYY':
						$day = substr($this->value, 0, 2);
						$month = substr($this->value, 3, 2);
						$year = substr($this->value, 6, 4);
						return ($year . "-" . $month . "-" . $day);
					break;
					case 'mm/dd/YYYY':
						$month = substr($this->value, 0, 2);
						$day = substr($this->value, 3, 2);
						$year = substr($this->value, 6, 4);
						return ($year . "-" . $month . "-" . $day);
					break;
					case 'dd-mm-YYYY':
						$day = substr($this->value, 0, 2);
						$month = substr($this->value, 3, 2);
						$year = substr($this->value, 6, 4);
						return ($year . "-" . $month . "-" . $day);
					case 'mm-dd-YYYY':
					case 'M/d/yyyy':
					case 'MM/dd/yyyy':
					
						$month = substr($this->value, 0, 2);
						$day = substr($this->value, 3, 2);
						$year = substr($this->value, 6, 4);
						return ($year . "-" . $month . "-" . $day);
					break;
					case 'M/d/yy':
					case 'MM/dd/yy':
						// this is two digit year
						
					break;
					case  'yy/MM/dd':
					break;
					case  'yyyy-MM-dd':
					break;
					case  'dd-MMM-yy':
					break;
					default : 
						return (date("Y-m-d"));
				
				}
				**/
				
			}
		}
	}
	function checkDateFormat() {
		/**
		 *  Basic System Information ,Date and  Currency Format
		 */
		if ($q->vendor == sharedx::MYSQL) {
			$sql="
			SELECT `systemSettingDateFormat`
			FROM   `systemSetting`	";
			
		} else if ($q->vendor == sharedx::MSSQL) {
			$sql="
			SELECT [systemSettingDateFormat]
			FROM   [systemSetting]	";
			
		} else if ($q->vendor == sharedx::ORACLE) {
			$sql="
			SELECT SYSTEMSETTINGDATEFORMAT
			FROM   SYSTEMSETTING	";
			
		} else if ($q->vendor ==sharedx::DB2) {
			$sql="
			SELECT SYSTEMSETTINGDATEFORMAT
			FROM   SYSTEMSETTING	";	
		} else if ($q->vendor ==sharedx::POSTGRESS) {
			$sql="
			SELECT SYSTEMSETTINGDATEFORMAT
			FROM   SYSTEMSETTING	";	
		}	

		$result = $q->fast ( $sql );

		$row = $q->fetchAssoc ( $result );
		$systemSettingDateFormat		=  $row['systemSettingDateFormat']; 		
		return  $systemSettingDateFormat;
	}
        /**
         * Block of html error message
         * @param $message .Message of the error
         */
        function exceptionMessage($message){
            $this->message = $message;
            if(strlen($this->message)>0) {
                echo "<div class=\"alert alert-error\"><a class=\"close\" data-dismiss=\'alert\'>×</a>".$message."</div>";
            }
        }
        /**
         * Block of html error message
         * @param $message .Message of the error
         */
        function exceptionMessageArray($message){
            $this->message = $message;
            if(is_array($message)) {
            echo "<pre class=\"prettyprint linenums\" style=\"margin-bottom: 9px;\">".print_r($message)."</pre>";
            } else {
               echo "<pre class=\"prettyprint linenums lang-sql\" id=\"sql-lang\" style=\"margin-bottom: 9px;\">".($message)."</pre>";

            }
            
        }    
	/**
	 * Set Application Path
	 * @param string $value
	 */
	public function setApplication ($value)
	{
		$this->application = $value;
	}
	/**
	 * Return Application Path
	 * @return string
	 */
	public function getApplication ()
	{
		return $this->application;
	}
	/**
	 * Set Staff Identification
	 * @param int $value
	 */
	public function setStaffId ($value)
	{
		$this->staffId = $value;
	}
	/**
	 * Return Staff Identification
	 * @return int
	 */
	public function getStaffId ()
	{
		return $this->staffId;
	}
	/**
	 * Set Connection
	 * @param string $value
	 */
	public function setConnection ($value)
	{
		$this->connection = $value;
	}
	/**
	 * Set Connection
	 * @return string
	 */
	public function getConnection ()
	{
		return $this->connection;
	}
	/**
	 * Set Database
	 * @param string $value
	 */
	public function setDatabase ($value)
	{
		$this->database = $value;
	}
	/**
	 * Return Database
	 * @return string
	 */
	public function getDatabase ()
	{
		return $this->database;
	}
	/**
	 * Set Vendor Value
	 * @param string $value
	 */
	public function setVendor ($value)
	{
		$this->vendor = $value;
	}
	/**
	 * Return Vendor
	 * @return string
	 */
	public function getVendor ()
	{
		return $this->vendor;
	}
	/**
	 * Set Username
	 * @param string $value
	 */
	public function setUsername ($value)
	{
		$this->username = $value;
	}
	/**
	 * Return Username
	 * @return string
	 */
	public function getUsername ()
	{
		return $this->username;
	}
	/**
	 * Set Password
	 * @param string $value
	 */
	public function setPassword ($value)
	{
		$this->password = $value;
	}
	/**
	 * Return Password
	 * @return string
	 */
	public function getPassword ()
	{
		return $this->password;
	}
	/**
	 * Set Language Identification
	 * @param int $value
	 */
	public function setLanguageId ($value)
	{
		$this->languageId = $value;
	}
	/**
	 * Return Language Identification
	 * @return int
	 */
	public function getLanguageId ()
	{
		return $this->languageId;
	}
	/**
	 * Set leaf / Application Identification
	 * @param int $value
	 */
	public function setLeafId ($value)
	{
		$this->leafId = $value;
	}
	/**
	 * Return Leaf /Application Identification
	 * @return number
	 */
	public function getLeafId ()
	{
		return $this->leafId;
	}
	/**
	 * Set Is Admin Value
	 * @param bool $value
	 */
	public function setIsAdmin ($value)
	{
		$this->isAdmin = $value;
	}
	/**
	 * Return Is Admin
	 * @return bool
	 */
	public function getIsAdmin ()
	{
		return $this->isAdmin;
	}
	/**
	 * Set Filter Query
	 * @param string $value
	 */
	public function setFieldQuery ($value)
	{
		$this->fieldQuery = $value;
	}
	/**
	 * Return Field Query
	 * @return string
	 */
	public function getFieldQuery ()
	{
		return $this->fieldQuery;
	}
	/**
	 * Set Grid Query Filtering
	 * @param string $value
	 */
	public function setGridQuery ($value)
	{
		$this->gridQuery = $value;
	}
	/**
	 * Return Grid Query Filtering
	 * @return string
	 */
	public function getGridQuery ()
	{
		return $this->gridQuery;
	}
	/**
	 * Set Start Number Per Page
	 * @param int $value
	 */
	public function setStart ($value)
	{
		$this->start = $value;
	}
	/**
	 * Return Start Number Per Page
	 * @return int
	 */
	public function getStart ()
	{
		return $this->start;
	}
	/**
	 * Set limit Per Page
	 * @param int $value
	 */
	public function setLimit ($value)
	{
		$this->limit = $value;
	}
	/**
	 * Return limit Per Page
	 * @return int
	 */
	public function getLimit ()
	{
		return $this->limit;
	}
	/**
	 * Set Sql Statement Ordering
	 * @param string $value
	 */
	public function setOrder ($value)
	{
		$this->order = $value;
	}
	/**
	 * Return Sql Statement Ordering
	 * @return string
	 */
	public function getOrder ()
	{
		return $this->order;
	}
	/**
	 * Set Sql Statement Sorting
	 * @param string $value
	 */
	public function setSortField ($value)
	{
		$this->sortField = $value;
	}
	/**
	 * Return Sql Statement Sorting
	 * @return string
	 */
	public function getSortField ()
	{
		return $this->sortField;
	}
	/**
	 * @return the $defaultLanguageId
	 */
	public function getDefaultLanguageId() {
		return $this->defaultLanguageId;
	}

	/**
	 * @param number $defaultLanguageId
	 */
	public function setDefaultLanguageId($defaultLanguageId) {
		$this->defaultLanguageId = $defaultLanguageId;
	}

	/**
	 * @return the $requestDatabase
	 */
	public function getRequestDatabase() {
		return $this->requestDatabase;
	}

	/**
	 * @param number $defaultLanguageId
	 */
	public function setRequestDatabase($requestDatabase) {
		$this->requestDatabase = $requestDatabase;
	}


	/**
	 *
	 * @return
	 */
	public function getCharacterQuery()
	{
                return $this->characterQuery;
	}

	/**
	 *
	 * @param $characterQuery
	 */
	public function setCharacterQuery($value)
	{
		$this->characterQuery = $value;
	}



	/**
	 *
	 * @return
	 */
	public function getDateRangeStartQuery()
	{
		return $this->dateRangeStartQuery;
	}

	/**
	 *
	 * @param $dateRangeStartQuery
	 */
	public function setDateRangeStartQuery($dateRangeStartQuery)
	{
		$this->dateRangeStartQuery = $dateRangeStartQuery;
	}

	/**
	 *
	 * @return
	 */
	public function getDateRangeEndQuery()
	{
		return $this->dateRangeEndQuery;
	}

	/**
	 *
	 * @param $dateRangeEndQuery
	 */
	public function setDateRangeEndQuery($dateRangeEndQuery)
	{
		$this->dateRangeEndQuery = $dateRangeEndQuery;
	}

	/**
	 *
	 * @return
	 */
	public function getDateRangeTypeQuery()
	{
		return $this->dateRangeTypeQuery;
	}

	/**
	 *
	 * @param $DateRangeTypeQuery
	 */
	public function setDateRangeTypeQuery($value)
	{
		$this->dateRangeTypeQuery = $value;
	}
        
        /**
	 *
	 * @return
	 */
	public function getDateRangeExtraTypeQuery()
	{
		return $this->dateRangeExtraTypeQuery;
	}

	/**
	 *
	 * @param $DateRangeTypeQuery
	 */
	public function setDateRangeExtraTypeQuery($value)
	{
		$this->dateRangeExtraTypeQuery = $value;
	}

	/**
	 * 
	 * @return 
	 */
	public function getStartDay()
	{
	    return $this->startDay;
	}

	/**
	 * 
	 * @param $startDay
	 */
	public function setStartDay($startDay)
	{
	    $this->startDay = $startDay;
	}

	/**
	 * 
	 * @return 
	 */
	public function getStartWeek()
	{
	    return $this->startWeek;
	}

	/**
	 * 
	 * @param $startWeek
	 */
	public function setStartWeek($startWeek)
	{
	    $this->startWeek = $startWeek;
	}

	/**
	 * 
	 * @return 
	 */
	public function getStartMonth()
	{
	    return $this->startMonth;
	}

	/**
	 * 
	 * @param $startMonth
	 */
	public function setStartMonth($startMonth)
	{
	    $this->startMonth = $startMonth;
	}

	/**
	 * 
	 * @return 
	 */
	public function getStartYear()
	{
	    return $this->startYear;
	}

	/**
	 * 
	 * @param $startYear
	 */
	public function setStartYear($startYear)
	{
	    $this->startYear = $startYear;
	}

	/**
	 * 
	 * @return 
	 */
	public function getEndDay()
	{
	    return $this->endDay;
	}

	/**
	 * 
	 * @param $endDay
	 */
	public function setEndDay($endDay)
	{
	    $this->endDay = $endDay;
	}

	/**
	 * 
	 * @return 
	 */
	public function getEndWeek()
	{
	    return $this->endWeek;
	}

	/**
	 * 
	 * @param $endWeek
	 */
	public function setEndWeek($endWeek)
	{
	    $this->endWeek = $endWeek;
	}

	/**
	 * 
	 * @return 
	 */
	public function getEndMonth()
	{
	    return $this->endMonth;
	}

	/**
	 * 
	 * @param $endMonth
	 */
	public function setEndMonth($endMonth)
	{
	    $this->endMonth = $endMonth;
	}

	/**
	 * 
	 * @return 
	 */
	public function getEndYear()
	{
	    return $this->endYear;
	}

	/**
	 * 
	 * @param $endYear
	 */
	public function setEndYear($endYear)
	{
	    $this->endYear = $endYear;
	}

	/**
	 * 
	 * @return 
	 */
	public function getValue()
	{
	    return $this->value;
	}

	/**
	 * 
	 * @param $value
	 */
	public function setValue($value)
	{
	    $this->value = $value;
	}

	/**
	 * 
	 * @return 
	 */
	public function getType()
	{
	    return $this->type;
	}

	/**
	 * 
	 * @param $type
	 */
	public function setType($value)
	{
	    $this->type = $value;
	}
        /**
         *
         * @return type 
         */
	public function getFilterMonth()
	{
	    return $this->filterMonth;
	}
        /**
         *
         * @param type $value 
         */
	public function setFilterMonth($value)
	{
	    $this->filterMonth = $value;
	}
        /**
         *
         * @return type 
         */
	public function getFilterYear()
	{
	    return $this->filterYear;
	}
        /**
         *
         * @param type $value 
         */
	public function setFilterYear($value)
	{
	    $this->filterYear = $value;
	}
        /**
         *
         * @return type 
         */
        public function getPageId()
	{
	    return $this->pageId;
	}
        /**
         *
         * @param type $value 
         */
	public function setPageId($value)
	{
	    $this->pageId = $value;
	}
        /**
         *
         * @return type 
         */
         public function getPageType()
	{
	    return $this->pageType;
	}
        /**
         *
         * @param type $value 
         */
	public function setPageType($value)
	{
	    $this->pageType = $value;
	}
        /**
         *
         * @return type 
         */
        public function getPageOutput()
	{
	    return $this->pageOutput;
	}
        /**
         *
         * @param string $value 
         */
	public function setPageOutput($value)
	{
	    $this->pageOutput = $value;
	}
        /**
         * Return Controller Filename
         * @return string 
         */
        public function getControllerFilename()
	{
	    return $this->controllerFilename;
	}
        /**
         * Set Controller Filename
         * @param string $controllerFilename 
         */
	public function setControllerFilename($value)
	{
	    $this->controllerFilename = $value;
	}
        /**
         * Return Controller Path
         * @return string 
         */
        public function getControllerPath()
	{
	    return $this->controllerPath;
	}
        /**
         * Set Controller Path
         * @param string $controllerPath 
         */
	public function setControllerPath($value)
	{
	    $this->controllerPath = $value;
	}
        /**
         * Return View Path
         * @return string 
         */
        public function getViewPath()
	{
	    return $this->viewPath;
	}
        /**
         * Set View Path
         * @param string $value
         */
	public function setViewPath($value)
	{
	    $this->viewPath = $value;
	}
        /**
         * Return View Filename
         * @return string 
         */
        public function getViewFilename()
	{
	    return $this->viewFilename;
	}
        /**
         * Set View Filename
         * @param string $value
         */
	public function setViewFilname($value)
	{
	    $this->viewFilename = $value;
	}
        /**
         * Return Service Filename
         * @return string 
         */
        public function getServiceFilename()
	{
	    return $this->viewFilename;
	}
        /**
         * Set Service Filename
         * @param string $value
         */
	public function setServiceFilename($value)
	{
	    $this->serviceFilename = $value;
	}
         /**
         * Return Service Path
         * @return string 
         */
        public function getServicePath()
	{
	    return $this->viewPath;
	}
        /**
         * Set Service Path
         * @param string $value
         */
	public function setServicePath($value)
	{
	    $this->servicePath = $value;
	}
         /**
     *Return Security Token
     * @return type 
     */
    function getSecurityToken() {
        return $this->securityToken;
    }
    /**
     * Set Security Token
     * @param string $value 
     */
    function setSecurityToken($value){
        $this->securityToken= $value;
    }
	/**
     * Return Current Database 
     * @return string 
     */
    function getCurrentDatabase() {
        return $this->currentDatabase;
    }
    /**
     * Set Current Database Name
     * @param string $value 
     */
    function setCurrentDatabase($value){
        $this->currentDatabase= $value;
    }
	/**
     * Return Current Table 
     * @return string 
     */
    function getCurrentTable() {
        return $this->currentTable;
    }
    /**
     * Set Current Table Name
     * @param string $value 
     */
    function setCurrentTable($value){
        $this->currentTable= $value;
    }
}
?>
