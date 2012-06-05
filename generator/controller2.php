<?php
$total = 0;
$total = count($data);
$str.="<?php namespace Core\\" . ucwords($data[0]['package']) . "\\" . ucwords($data[0]['module']) . "\\" . ucwords($data[0]['tableName']) . "\Controller; \n";
$str.="if (!isset(\$_SESSION)) { \n";
$str.="    session_start(); \n";
$str.="} \n";
$str.="require_once (\"../../../../library/class/classAbstract.php\"); \n";
$str.="require_once (\"../../../../library/class/classRecordSet.php\"); \n";
$str.="require_once (\"../../../../library/class/classDate.php\"); \n";
$str.="require_once (\"../../../../library/class/classSystemString.php\"); \n";
$str.="//require_once (\"/../../../../class/classDocumentTrail.php\"); \n";
$str.="//require_once (\"../../document/model/documentModel.php\"); \n";
$str.="require_once (\"/../model/" . $data[0]['tableName'] . "Model.php\"); \n";

$str.="/** \n";
$str.=" * this is " . $data[0]['tableName'] . " setting files.This sample template file for master record \n";
$str.=" * @name IDCMS \n";
$str.=" * @version 2 \n";
$str.=" * @author hafizan \n";
$str.=" * @package " . ucwords($data[0]['package']) . " \n";
$str.=" * @subpackage " . ucwords($data[0]['module']) . " \n";
$str.=" * @link http://www.idcms.org \n";
$str.=" * @license http://www.gnu.org/copyleft/lesser.html LGPL \n";
$str.=" */ \n";
$str.="class ".ucfirst($data[0]['tableName'])."Class extends \Core\ConfigClass { \n";

$str.="	/** \n";
$str.="	 * Connection to the database \n"; 
$str.="	 * @var string \n";
$str.="	 */ \n";
$str.="	public \$q; \n";

$str.="	/** \n";
$str.="	 * Php Excel Generate Microsoft Excel 2007 Output.Format : xlsx \n";
$str.="	 * @var string \n";
$str.="	 */ \n";
$str.="	private \$excel; \n";

$str.="	/** \n";
$str.="	 * Record Pagination \n";
$str.="	 * @var string \n";
$str.="	 */ \n";
$str.="	private \$recordSet; \n";

$str.="	/** \n";
$str.="	 * Document Trail Audit. \n";
$str.="	 * @var string \n";
$str.="	 */ \n";
$str.="	private \$documentTrail; \n";
$str.="	/** \n";
$str.="	 * System String Message. \n";
$str.="	 * @var string \$systemString; \n";
$str.="	 */ \n";
$str.="	public \$systemString; \n";
$str.="	/** \n";
$str.="	 * Audit Row TRUE or False \n";
$str.="	 * @var bool \n";
$str.="	 */ \n";
$str.="	private \$audit; \n";

$str.="	/** \n";
$str.="	 * Log Sql Statement TRUE or False \n";
$str.="	 * @var string \n";
$str.="	 */ \n";
$str.="	private \$log; \n";

$str.="	/** \n";
$str.="	 * Model \n";
$str.="	 * @var string \n";
$str.="	 */ \n";
$str.="	public \$model; \n";

$str.="	/** \n";
$str.="	 * Audit Filter\n";
$str.="	 * @var string\n";
$str.="	 */ \n";
$str.="	public \$auditFilter; \n";

$str.="	/** \n";
$str.="	 * Audit Column \n";
$str.="	 * @var string \n";
$str.="	 */ \n";
$str.="	public \$auditColumn; \n";

$str.="	/** \n";
$str.="	 * Duplicate Testing either the key of table same or have been created. \n";
$str.="	 * @var bool\n";
$str.="	 */ \n";
$str.="	public \$duplicateTest; \n";
$str.="function __construct() { \n";
$str.="	\$this->setViewPath(\"./package/" . ucwords($data[0]['package']) . "/" . ucwords($data[0]['module']) . "/view/".$data[0]['tableName'].".php\"); \n";
$str.=" \$this->setControllerPath(\"./package/" . ucwords($data[0]['package']) . "/" . ucwords($data[0]['module']) . "/controller/".$data[0]['tableName']."Controller.php\");\n";
$str.=" //\$this->setServicePath(\"./package/" . ucwords($data[0]['package']) . "/" . ucwords($data[0]['module']) . "/service/".$data[0]['tableName']."Service.php\"); \n";
$str.="	} \n";
$str.="	/** \n";
$str.="	 * Class Loader \n";
$str.="	 */ \n";
$str.="	function execute() { \n";
$str.="		parent::__construct(); \n";
$str.="        \$this->audit = 0; \n";
$str.="       \$this->log = 1; \n";

$str.="        \$this->model  = new \Core\\" . ucwords($data[0]['package']) . "\\" . ucwords($data[0]['module']) . "\\" . ucwords($data[0]['tableName']) . "\Model\\";
$str.=ucfirst($data[0]['tableName'])."Model(); \n";
$str.="        \$this->model->setVendor(\$this->getVendor()); \n";
$str.="        \$this->model->execute(); \n";

$str.="       if (\$this->getVendor() == self::MYSQL) { \n";
$str.="           \$this->q = new \Core\Database\Mysql\Vendor(); \n";
$str.="       } else if (\$this->getVendor() == self::MSSQL) { \n";
$str.="           \$this->q = new \Core\Database\Mssql\Vendor(); \n";
$str.="       } else if (\$this->getVendor() == self::ORACLE) { \n";
$str.="           \$this->q = new \Core\Database\Oracle\Vendor(); \n";
$str.="       } else if (\$this->getVendor() == self::POSTGRESS) { \n";
$str.="           \$this->q = new \Core\Database\Postgress\Vendor(); \n";
$str.="       } else if (\$this->getVendor() == self ::DB2) { \n";
$str.="          \$this->q = new \Core\Database\Db2\Vendor(); \n";
$str.="        } \n";
$str.="        \$this->q->vendor = \$this->getVendor(); \n";
$str.="        \$this->q->setRequestDatabase(\$this->q->getCoreDatabase()); \n";
$str.="        \$this->q->connect(\$this->getConnection(), \$this->getUsername(), \$this->getDatabase(), \$this->getPassword()); \n";
$str.="        \$this->systemString = new \Core\SystemString\SystemString(); \n";
$str.="        \$this->systemString->setVendor(\$this->getVendor()); \n";
$str.="        \$this->systemString->setLeafId(\$this->getLeafId()); \n";
$str.="        \$this->systemString->execute(); \n";
$str.="        \$this->recordSet = new \Core\Recordset\RecordSet(); \n";
$str.="        \$this->recordSet->setCurrentDatabase(\$this->q->getCoreDatabase()); \n";
$str.="        \$this->recordSet->setCurrentTable(\$this->model->getTableName()); \n";
$str.="        \$this->recordSet->setPrimaryKeyName(\$this->model->getPrimaryKeyName()); \n";
$str.="        \$this->recordSet->execute(); \n";
$str.="        //    \$this->documentTrail = new \Core\Document\Trail; \n";
$str.="        //    \$this->documentTrail->setVendor(\$this->getVendor()); \n";
$str.="        //     \$this->documentTrail->setStaffId(\$this->getStaffId()); \n";
$str.="        //     \$this->documentTrail->setLanguageId(\$this->getLanguageId()); \n";
$str.="        //\$this->excel = new PHPExcel (); \n";
$str.="	} \n";
$str.="  \n";
$str.="	/* (non-PHPdoc)  \n";
$str.="	 * @see config::create()  \n";
$str.="	 */  \n";

$str.="	public function create() {  \n";
$str.="		header('Content-Type:application/json; charset=utf-8');  \n";
$str.="		\$start = microtime(true);  \n";
$str.="		if (\$this->getVendor() == self::MYSQL) {  \n";
$str.="			\$sql = \"SET NAMES utf8\";  \n";
$str.="			\$this->q->fast(\$sql);  \n";
$str.="		} \n";
$str.="		\$this->q->start();  \n";
$str.="		\$this->model->create();  \n";
$str.="		if (\$this->getVendor() == self::MYSQL) {  \n";
$mysqlInsertStatement=null;
$mysqlInsertStatementAField =null;
$mysqlInsertStatementField=null;
$mysqlInsertStatementInsideValue=null;
$mysqlInsertStatementValue=null;
$mysqlInsertStatement.=" \$sql=\"INSERT INTO `".$data[0]['database']."`.`" . $data[0]['tableName'] . "` ( \n";
	for ($i = 0; $i < $total; $i++) {
		if($i >= 1){
			$mysqlInsertStatementAField.="	`".$data[$i]['columnName'] . "`,\n";
		}
	}

	$mysqlInsertStatement.=(substr($mysqlInsertStatementAField,0,-2));
	$mysqlInsertStatement.="\n) VALUES ( \n";
	$i=0;
	for ($i = 0; $i < $total; $i++) {
		if($i >=1) { 
			 if ($data[$i]['columnName']=='executeTime'){
			$mysqlInsertStatementInsideValue.=" \".\$this->model->get".ucFirst($data[$i]['columnName'])."().\",\n";
			}	else if($data[$i]['columnName'] !='isDefault' &&
			$data[$i]['columnName'] !='isNew' &&
			$data[$i]['columnName'] !='isDraft'&&
			$data[$i]['columnName'] !='isUpdate'&&
			$data[$i]['columnName'] !='isDelete'&&
			$data[$i]['columnName'] !='isActive'&&
			$data[$i]['columnName']!='isApproved'&&
			$data[$i]['columnName'] !='isReview'&&
			$data[$i]['columnName'] !='isPost'&&
			$data[$i]['columnName'] !='isSeperated'&&
			$data[$i]['columnName'] !='isConsolidation') {
				$mysqlInsertStatementInsideValue.=" '\".\$this->model->get".ucFirst($data[$i]['columnName'])."().\"',\n";
			}  else {
				$mysqlInsertStatementInsideValue.=" '\".\$this->model->get".ucFirst($data[$i]['columnName'])."(0, 'single').\"',\n";
			}
		}
	}

	$mysqlInsertStatement.=(substr($mysqlInsertStatementInsideValue,0,-2));

	$mysqlInsertStatement.="\n );\";\n";
	$str.=$mysqlInsertStatement;
$str.="		 } else if (\$this->getVendor() == self::MSSQL) {  \n";
$mssqlInsertStatement=null;
$mssqlInsertStatementAField=null;
$mssqlInsertStatementField=null;
$mssqlInsertStatementInsideValue=null;
$mssqlInsertStatementValue=null;
$mssqlInsertStatement.="
		\$sql=\"INSERT INTO [".$data[0]['database']."].[" . $data[0]['tableName'] . "] (\n";
	$i=0;
	for ($i = 0; $i < $total; $i++) {
		if($i >=0 ) { 
			$mssqlInsertStatementAField.="	[".$data[$i]['columnName'] . "],\n";
		}
	}
	$mssqlInsertStatementField.= (substr($mssqlInsertStatementAField,0,-2));
	$mssqlInsertStatement.=$mssqlInsertStatementField;
	$mssqlInsertStatement.="\n) VALUES ( \n";
	$i=0;
	for ($i = 0; $i < $total; $i++) {
		
		if($i >= 1){
			if ($data[$i]['columnName']=='executeTime'){
			$mssqlInsertStatementInsideValue.=" \".\$this->model->get".ucFirst($data[$i]['columnName'])."().\",\n";
			}	elseif($data[$i]['columnName'] !='isDefault' &&
			$data[$i]['columnName'] !='isNew' &&
			$data[$i]['columnName'] !='isDraft'&&
			$data[$i]['columnName'] !='isUpdate'&&
			$data[$i]['columnName'] !='isDelete'&&
			$data[$i]['columnName'] !='isActive'&&
			$data[$i]['columnName']!='isApproved'&&
			$data[$i]['columnName'] !='isReview'&&
			$data[$i]['columnName'] !='isPost'&&
			$data[$i]['columnName'] !='isSeperated'&&
			$data[$i]['columnName'] !='isConsolidation') {
				$mssqlInsertStatementInsideValue.=" '\".\$this->model->get".ucFirst($data[$i]['columnName'])."().\"',\n";
			}  else {
				$mssqlInsertStatementInsideValue.=" '\".\$this->model->get".ucFirst($data[$i]['columnName'])."(0, 'single').\"',\n";
			}
			
		}
	}
	$mssqlInsertStatementValue.=(substr($mssqlInsertStatementInsideValue,0,-2));
	$mssqlInsertStatement.=$mssqlInsertStatementValue;
	$mssqlInsertStatement.="\n );\";\n";
$str.=$mssqlInsertStatement;
$str.="		 } else if (\$this->getVendor() == self::ORACLE) {  \n";
$oracleInsertStatement=null;
$oracleInsertStatementAField=null;
$oracleInsertStatementField=null;
$oracleInsertStatementInsideValue=null;
$oracleInsertStatementValue=null;
$oracleInsertStatement.="
		\$sql=\"INSERT INTO 	".strtoupper($data[0]['tableName'])." ( \n";
	for ($i = 0; $i < $total; $i++) {
		if($i >= 1){
			$oracleInsertStatementAField.="	".strtoupper($data[$i]['columnName']).",\n";
		}
	}
	$oracleInsertStatementField.= (substr($oracleInsertStatementAField,0,-2));
	$oracleInsertStatement.=$oracleInsertStatementField;
	$oracleInsertStatement.="\n) VALUES ( \n";
	$i=0;
	for ($i = 0; $i < $total; $i++) {
		if($i >= 1){
			if ($data[$i]['columnName']=='executeTime'){
			$oracleInsertStatementInsideValue.=" \".\$this->model->get".ucFirst($data[$i]['columnName'])."().\",\n";
			}	else if($data[$i]['columnName'] !='isDefault' &&
			$data[$i]['columnName'] !='isNew' &&
			$data[$i]['columnName'] !='isDraft'&&
			$data[$i]['columnName'] !='isUpdate'&&
			$data[$i]['columnName'] !='isDelete'&&
			$data[$i]['columnName'] !='isActive'&&
			$data[$i]['columnName']!='isApproved'&&
			$data[$i]['columnName'] !='isReview'&&
			$data[$i]['columnName'] !='isPost'&&
			$data[$i]['columnName'] !='isSeperated'&&
			$data[$i]['columnName'] !='isConsolidation') {
				$oracleInsertStatementInsideValue.=" '\".\$this->model->get".ucFirst($data[$i]['columnName'])."().\"',\n";
			}  else {
				$oracleInsertStatementInsideValue.=" '\".\$this->model->get".ucFirst($data[$i]['columnName'])."(0, 'single').\"',\n";
			}
		} 
	}
	$oracleInsertStatementValue.=(substr($oracleInsertStatementInsideValue,0,-2));
	$oracleInsertStatement.=$oracleInsertStatementValue;
	$oracleInsertStatement.="\n );\";\n";	
$str.=$oracleInsertStatement;
$str.="		 } else if (\$this->getVendor() == self::DB2) {  \n";
$oracleInsertStatement=null;
$oracleInsertStatementAField=null;
$oracleInsertStatementField=null;
$oracleInsertStatementInsideValue=null;
$oracleInsertStatementValue=null;
$oracleInsertStatement.="
		\$sql=\"INSERT INTO 	".strtoupper($data[0]['tableName'])." ( \n";
	for ($i = 0; $i < $total; $i++) {
		if($i >= 1){
			$oracleInsertStatementAField.="	".strtoupper($data[$i]['columnName']).",\n";
		}
	}
	$oracleInsertStatementField.= (substr($oracleInsertStatementAField,0,-2));
	$oracleInsertStatement.=$oracleInsertStatementField;
	$oracleInsertStatement.="\n) VALUES ( \n";
	$i=0;
	for ($i = 0; $i < $total; $i++) {
		if($i >= 1){
			if ($data[$i]['columnName']=='executeTime'){
			$oracleInsertStatementInsideValue.=" \".\$this->model->get".ucFirst($data[$i]['columnName'])."().\",\n";
			} else if($data[$i]['columnName'] !='isDefault' &&
			$data[$i]['columnName'] !='isNew' &&
			$data[$i]['columnName'] !='isDraft'&&
			$data[$i]['columnName'] !='isUpdate'&&
			$data[$i]['columnName'] !='isDelete'&&
			$data[$i]['columnName'] !='isActive'&&
			$data[$i]['columnName']!='isApproved'&&
			$data[$i]['columnName'] !='isReview'&&
			$data[$i]['columnName'] !='isPost'&&
			$data[$i]['columnName'] !='isSeperated'&&
			$data[$i]['columnName'] !='isConsolidation') {
				$oracleInsertStatementInsideValue.=" '\".\$this->model->get".ucFirst($data[$i]['columnName'])."().\"',\n";
			}  else {
				$oracleInsertStatementInsideValue.=" '\".\$this->model->get".ucFirst($data[$i]['columnName'])."(0, 'single').\"',\n";
			}
		} 
	}
	$oracleInsertStatementValue.=(substr($oracleInsertStatementInsideValue,0,-2));
	$oracleInsertStatement.=$oracleInsertStatementValue;
	$oracleInsertStatement.="\n );\";\n";	
$str.=$oracleInsertStatement;
	
$str.="		 } else if (\$this->getVendor() == self::POSTGRESS) { \n";
$oracleInsertStatement=null;
$oracleInsertStatementAField=null;
$oracleInsertStatementField=null;
$oracleInsertStatementInsideValue=null;
$oracleInsertStatementValue=null;
$oracleInsertStatement.="
		\$sql=\"INSERT INTO 	".strtoupper($data[0]['tableName'])." ( \n";
	for ($i = 0; $i < $total; $i++) {
		if($i >= 1){
			$oracleInsertStatementAField.="	".strtoupper($data[$i]['columnName']).",\n";
		}
	}
	$oracleInsertStatementField.= (substr($oracleInsertStatementAField,0,-2));
	$oracleInsertStatement.=$oracleInsertStatementField;
	$oracleInsertStatement.="\n) VALUES ( \n";
	$i=0;
	for ($i = 0; $i < $total; $i++) {
		if($i >= 1){
		if ($data[$i]['columnName']=='executeTime'){
			$oracleInsertStatementInsideValue.=" \".\$this->model->get".ucFirst($data[$i]['columnName'])."().\",\n";
			} else if($data[$i]['columnName'] !='isDefault' &&
			$data[$i]['columnName'] !='isNew' &&
			$data[$i]['columnName'] !='isDraft'&&
			$data[$i]['columnName'] !='isUpdate'&&
			$data[$i]['columnName'] !='isDelete'&&
			$data[$i]['columnName'] !='isActive'&&
			$data[$i]['columnName']!='isApproved'&&
			$data[$i]['columnName'] !='isReview'&&
			$data[$i]['columnName'] !='isPost'&&
			$data[$i]['columnName'] !='isSeperated'&&
			$data[$i]['columnName'] !='isConsolidation') {
				$oracleInsertStatementInsideValue.=" '\".\$this->model->get".ucFirst($data[$i]['columnName'])."().\"',\n";
			}  else {
				$oracleInsertStatementInsideValue.=" '\".\$this->model->get".ucFirst($data[$i]['columnName'])."(0, 'single').\"',\n";
			}
		} 
	}
	$oracleInsertStatementValue.=(substr($oracleInsertStatementInsideValue,0,-2));
	$oracleInsertStatement.=$oracleInsertStatementValue;
	$oracleInsertStatement.="\n );\";\n";	
$str.=$oracleInsertStatement;
$str.=" } \n";

$str.="		 \$this->q->create(\$sql); \n";
$str.="		\$" . $data[0]['tableName'] . "Id = \$this->q->lastInsertId(); \n";
$str.="		if (\$this->q->execute == 'fail') { \n";
$str.="			echo json_encode(array(\"success\" => false, \"message\" => \$this->q->responce)); \n";
$str.="			exit(); \n";
$str.="		} \n";
$str.="		\$this->q->commit(); \n";
$str.="		\$end = microtime(true); \n";
$str.="		\$time = \$end - \$start; \n";
$str.="		echo json_encode( \n";
$str.="		array(	\"success\" => true, \n";
$str.="					\"message\" => \$this->systemString->getCreateMessage(),  \n";
$str.="					\"".$data[0]['tableName']."Id"."\" => \$".$data[0]['tableName']."Id".", \n";
$str.="					\"time\"=>\$time)); \n";
$str.="		exit(); \n";
$str.="	} \n";

$str.="	/* (non-PHPdoc) \n";
$str.="	 * @see config::read() \n";
$str.="	 */ \n";

$str.="	public function read() { \n";
$str.="		if (\$this->getPageOutput() == 'json') { \n";
$str.="            header('Content-Type:application/json; charset=utf-8'); \n";
$str.="        } \n";
$str.="		\$start = microtime(true); \n";
$str.="		if (\$this->getIsAdmin() == 0) { \n";
$str.="			if (\$this->q->vendor == self::MYSQL) { \n";
$str.="				\$this->auditFilter = \"	`" . $data[0]['tableName'] . "`.`isActive`		=	1	\"; \n";
$str.="			} else if (\$this->q->vendor == self::MSSQL) { \n";
$str.="				\$this->auditFilter = \"	[" . $data[0]['tableName'] . "].[isActive]		=	1	\"; \n";
$str.="			} else if (\$this->q->vendor == self::ORACLE) { \n";
$str.="				\$this->auditFilter = \"	".strtoupper($data[0]['tableName']).".ISACTIVE	=	1	\"; \n";
$str.="			} \n";
$str.="		} else if (\$this->getIsAdmin() == 1) { \n";
$str.="			if (\$this->getVendor() == self::MYSQL) { \n";
$str.="				\$this->auditFilter = \"	1	=	1	\"; \n";
$str.="			} else if (\$this->q->vendor == self::MSSQL) { \n";
$str.="				\$this->auditFilter = \"	1	=	1 	\"; \n";
$str.="			} else if (\$this->q->vendor == self::ORACLE) { \n";
$str.="				\$this->auditFilter = \"	1	=	1 	\"; \n";
$str.="			} \n";
$str.="		} \n";


$str.="		if (\$this->getVendor() == self::MYSQL) { \n";
$str.="			\$sql = \"SET NAMES utf8\"; \n";
$str.="			\$this->q->fast(\$sql); \n";
$str.="		}  \n";
$str.="		\$items = array(); \n";

$str.="		 if (\$this->getVendor() == self::MYSQL) { \n";
$mysqlReadStatement=null;
$mysqlReadInsideStatement=null;

	$mysqlReadStatement.="\n\$sql = \"SELECT";
	for ($i = 0; $i < $total; $i++) {
		$mysqlReadInsideStatement.="`" . $data[0]['tableName'] . "`.`".$data[$i]['columnName'] . "`,\n";
	}
	$mysqlReadStatement.=$mysqlReadInsideStatement;

	$mysqlReadStatement.="`staff`.`staffName`
			FROM 	`".$data[0]['database']."`.`" . $data[0]['tableName'] . "`
			JOIN	`iCore`.`staff`
			ON		`" . $data[0]['tableName'] . "`.`executeBy` = `staff`.`staffId`
			WHERE 		\" . \$this->auditFilter; \n";
$str.=		$mysqlReadStatement;	
$str.="		 if (\$this->model->get".ucfirst($data[0]['tableName']."Id")."(0, 'single')) { \n";
$str.="				\$sql .= \" AND `\" . \$this->model->getTableName() . \"`.`\" . \$this->model->getPrimaryKeyName() . \"`='\" . \$this->model->get".ucfirst($data[0]['tableName']."Id")."(0, 'single') . \"'\";  \n";
$str.="	}\n	} else if (\$this->getVendor() == self::MSSQL) {  \n";
$mssqlReadStatement=null;
$mssqlReadInsideStatement=null;
$mssqlReadStatement.="\n\$sql = \"SELECT ";

	for ($i = 0; $i < $total; $i++) {
		$mssqlReadInsideStatement.="[" . $data[0]['tableName'] . "].[".$data[$i]['columnName'] . "],\n";
	}
	$mssqlReadStatement.=$mssqlReadInsideStatement;
	$mssqlReadStatement.="[staff].[staffName]
			FROM 	[".$data[0]['database']."].[" . $data[0]['tableName'] . "]
			JOIN		[iCore].[staff]
			ON		[" . $data[0]['tableName'] . "].[executeBy] = [staff].[staffId]
			WHERE 		\" . \$this->auditFilter; \n";
$str.=	$mssqlReadStatement;
$str.="		 if (\$this->model->get".ucfirst($data[0]['tableName']."Id")."(0, 'single')) { \n";
$str.="				\$sql .= \" AND [\" . \$this->model->getTableName() . \"].[\" . \$this->model->getPrimaryKeyName() . \"]		=	'\" . \$this->model->get".ucfirst($data[0]['tableName']."Id")."(0, 'single') . \"'\"; \n";
$str.="			} \n";
			
$str.="		} else if (\$this->getVendor() == self::ORACLE) {  \n";
$oracleReadStatement=null;
$oracleReadInsideStatement=null;
$oracleReadStatement.="\n\$sql = \"SELECT";
	
	for ($i = 0; $i < $total; $i++) {
		$oracleReadInsideStatement.=" ".strtoupper($data[0]['tableName']).".".strtoupper($data[$i]['columnName']).",\n";
	}
	$oracleReadStatement.=$oracleReadInsideStatement;

	$oracleReadStatement.="STAFF.STAFFNAME
			FROM 	".strtoupper($data[0]['tableName'])." \n
			JOIN		STAFF \n
			ON		".strtoupper($data[0]['tableName']).".EXECUTEBY = STAFF.STAFFID \n
			WHERE 		\" . \$this->auditFilter; \n";

$str.= $oracleReadStatement;
$str.="		 if (\$this->model->get".ucfirst($data[0]['tableName']."Id")."(0, 'single'))  {\n";
$str.="				\$sql .= \" AND \" . strtoupper(\$this->model->getTableName())  . strtoupper(\$this->model->getPrimaryKeyName()) . \"='\" . \$this->model->get".ucfirst($data[0]['tableName']."Id")."(0, 'single') . \"'\"; \n";
$str.="			} \n";
			
$str.="		} else if (\$this->getVendor() == self::DB2) {  \n";

$str.="		 if (\$this->model->get".ucfirst($data[0]['tableName']."Id")."(0, 'single')) { \n";
$str.="				\$sql .= \" AND \" . strtoupper(\$this->model->getTableName())  . strtoupper(\$this->model->getPrimaryKeyName()) . \"='\" . \$this->model->get".ucfirst($data[0]['tableName']."Id")."(0, 'single') . \"'\"; \n";
$str.="			} \n";
			
$str.="		} else if (\$this->getVendor() == self::POSTGRESS) {  \n";

$str.="		 if (\$this->model->get".ucfirst($data[0]['tableName']."Id")."(0, 'single')) { \n";
$str.="				\$sql .= \" AND \" . strtoupper(\$this->model->getTableName())  . strtoupper(\$this->model->getPrimaryKeyName()) . \"='\" . \$this->model->get".ucfirst($data[0]['tableName']."Id")."(0, 'single') . \"'\"; \n";
$str.="			} \n";
			
$str.="		}else { \n";
$str.="			echo json_encode(array(\"success\" => false, \"message\" => \$this->systemString->getNonSupportedDatabase())); \n";
$str.="			exit(); \n";
$str.="		} \n";

$str.="		/** \n";
$str.="		 * filter column based on first character \n";
$str.="		 */ \n";
$str.="		if(\$this->getCharacterQuery()){ \n";
$str.="			if(\$this->q->vendor==self::MYSQL){ \n";
$str.="				\$sql.=\" AND `\".\$this->model->getTableName().\"`.`\".\$this->model->getFilterCharacter().\"` like '\".\$this->getCharacterQuery().\"%'\"; \n";
$str.="			} else if(\$this->q->vendor==self::MSSQL){ \n";
$str.="				\$sql.=\" AND [\".\$this->model->getTableName().\"].[\".\$this->model->getFilterCharacter().\"] like '\".\$this->getCharacterQuery().\"%'\"; \n";
$str.="			} else if (\$this->q->vendor==self::ORACLE){ \n";
$str.="				\$sql.=\" AND \".strtoupper(\$this->model->getTableName()).\".\".strtoupper(\$this->model->getFilterCharacter()).\" = '\".\$this->getCharacterQuery().\"'\"; \n";
$str.="			} else if (\$this->q->vendor==self::DB2){ \n";
$str.="				\$sql.=\" AND \".strtoupper(\$this->model->getTableName()).\".\".strtoupper(\$this->model->getFilterCharacter()).\" = '\".\$this->getCharacterQuery().\"'\"; \n";
$str.="			} else if (\$this->q->vendor==self::POSTGRESS){ \n";
$str.="				\$sql.=\" AND \".strtoupper(\$this->model->getTableName()).\".\".strtoupper(\$this->model->getFilterCharacter()).\" = '\".\$this->getCharacterQuery().\"'\"; \n";
$str.="			} \n";
$str.="		} \n";
$str.="		/** \n";
$str.="		 * filter column based on Range Of Date \n";
$str.="		 * Example Day,Week,Month,Year \n";
$str.="		 */ \n";
$str.="		if(\$this->getDateRangeStartQuery()){ \n";
$str.="			\$sql.=\$this->q->dateFilter(\$sql, \$this->model->getTableName(),\$this->model->getFilterDate(),\$this->getDateRangeStartQuery(),\$this->getDateRangeEndQuery(),\$this->getDateRangeTypeQuery(),\$this->getDateRangeExtraTypeQuery()); \n";
$str.="		} \n";
$str.="		/** \n";
$str.="		 * filter column don't want to filter.Example may contain  sensetive information or unwanted to be search. \n";
$str.="		 * E.g  \$filterArray=array('`leaf`.`leafId`'); \n";
$str.="		 * @variables \$filterArray; \n";
$str.="		 */  \n";
$str.="		\$filterArray = null; \n";
$str.="		\$filterArray = array('".$data[0]['tableName']."Id"."'); \n";
$str.="		/** \n";
$str.="		 * filter table \n";
$str.="		 * @variables \$tableArray \n";
$str.="		 */ \n";
$str.="		\$tableArray = null; \n";
$str.="		\$tableArray = array('" . $data[0]['tableName'] . "'); \n";
$str.="		if (\$this->getFieldQuery()) { \n";
$str.="			\$this->q->setFieldQuery(\$this->getFieldQuery()); \n";
$str.="			if (\$this->getVendor() == self::MYSQL) { \n";
$str.="				\$sql .= \$this->q->quickSearch(\$tableArray, \$filterArray); \n";
$str.="			} else if (\$this->getVendor() == self::MSSQL) { \n";
$str.="				\$tempSql = \$this->q->quickSearch(\$tableArray, \$filterArray); \n";
$str.="				\$sql .= \$tempSql; \n";
$str.="			} else if (\$this->getVendor() == self::ORACLE) { \n";
$str.="				\$tempSql = \$this->q->quickSearch(\$tableArray, \$filterArray); \n";
$str.="				\$sql .= \$tempSql; \n";
$str.="			} \n";
$str.="		} \n";
$str.="		/** \n";
$str.="		 * Extjs filtering mode \n";
$str.="		 */ \n";
$str.="		if (\$this->getGridQuery()) { \n";
$str.="			\$this->q->setGridQuery(\$this->getGridQuery()); \n";
$str.="			if (\$this->getVendor() == self::MYSQL) { \n";
$str.="				\$sql .= \$this->q->searching(); \n";
$str.="			} else if (\$this->getVendor() == self::MSSQL) { \n";
$str.="				\$tempSql2 = \$this->q->searching(); \n";
$str.="				\$sql .= \$tempSql2; \n";
$str.="			} else if (\$this->getVendor() == self::ORACLE) { \n";
$str.="				\$tempSql2 = \$this->q->searching(); \n";
$str.="				\$sql .= \$tempSql2; \n";
$str.="			} else if (\$this->getVendor() == self::DB2) { \n";

$str.="			} else if (\$this->getVendor() == self::POSTGRESS) { \n";

$str.="			} \n";
$str.="		} \n";
$str.="		// optional debugger.uncomment if wanted to used \n";
$str.="		//if (\$this->q->execute == 'fail') { \n";
$str.="		//	echo json_encode(array( \n";
$str.="		//   \"success\" => false, \n";
$str.="		//   \"message\" => \$this->q->realEscapeString(\$sql) \n";
$str.="		//	)); \n";
$str.="		//	exit(); \n";
$str.="		//} \n";
$str.="		// end of optional debugger \n";
$str.="		\$this->q->read(\$sql); \n";
$str.="		if (\$this->q->execute == 'fail') { \n";
$str.="			echo json_encode(array(\"success\" => false, \"message\" => \$this->q->responce)); \n";
$str.="			exit(); \n";
$str.="		} \n";
$str.="		\$total = \$this->q->numberRows(); \n";
$str.="		if (\$this->getOrder() && \$this->getSortField()) { \n";
$str.="			if (\$this->getVendor() == self::MYSQL) { \n";
$str.="				\$sql .= \"	ORDER BY `\" . \$this->getSortField() . \"` \" . \$this->getOrder() . \" \"; \n";
$str.="			} else if (\$this->getVendor() == self::MSSQL) { \n";
$str.="				\$sql .= \"	ORDER BY [\" . \$this->getSortField() . \"] \" . \$this->getOrder() . \" \"; \n";
$str.="			} else if (\$this->getVendor() == self::ORACLE) { \n";
$str.="				\$sql .= \"	ORDER BY \" . strtoupper(\$this->getSortField()) . \" \" . strtoupper(\$this->getOrder()) . \" \"; \n";
$str.="			} \n";
$str.="		} \n";
$str.="		\$_SESSION ['sql'] = \$sql; // push to session so can make report via excel and pdf \n";
$str.="		\$_SESSION ['start'] = \$this->getStart(); \n";
$str.="		\$_SESSION ['limit'] = \$this->getLimit(); \n";
$str.="		if (\$this->getStart() && \$this->getLimit()) { \n";
$str.="			// only mysql have limit \n";
$str.="			if (\$this->getVendor() == self::MYSQL) { \n";
$str.="				\$sql .= \" LIMIT  \" . \$this->getStart() . \",\" . \$this->getLimit() . \" \"; \n";
$str.="			} else if (\$this->getVendor() == self::MSSQL) { \n";
$str.="				/** \n";
$str.="				 * Sql Server and Oracle used row_number \n";
$str.="				 * Parameterize Query We don't support \n";
$str.="				 **/; \n";
$mssqlReadStatement=null;
$mssqlReadInsideStatement=null;
$mssqlReadInsidePagingStatement=null;
$mssqlReadPagingStatement=null;
$mssqlReadStatement.="\n\$sql = \"SELECT ";
	$mssqlReadPagingStatement="
				\$sql =\"WITH [" . $data[0]['tableName'] . "Derived] AS
							(
								SELECT ";
	for ($i = 0; $i < $total; $i++) {
		$mssqlReadInsideStatement.="[" . $data[0]['tableName'] . "].[".$data[$i]['columnName'] . "],\n";
		$mssqlReadInsidePagingStatement.="[" . $data[0]['tableName'] . "].[".$data[$i]['columnName'] . "],\n";
	}
	$mssqlReadInsidePagingStatement.="[staff].[staffName],\n";
	$mssqlReadInsidePagingStatement.="ROW_NUMBER() OVER (ORDER BY [" . $data[0]['tableName'] . "].[".$data[0]['tableName']."Id]) AS 'RowNumber'\n";
	$mssqlReadStatement.=$mssqlReadInsideStatement;

	$mssqlReadPagingStatement.=$mssqlReadInsidePagingStatement;
	$mssqlReadStatement.="[staff].[staffName]
			FROM 	[".$data[0]['database']."].[" . $data[0]['tableName'] . "]
			JOIN		[iCore].[staff]
			ON		[" . $data[0]['tableName'] . "].[executeBy] = [staff].[staffId]
			WHERE 		\" . \$this->auditFilter; \n";
	$mssqlReadPagingStatement.="
						
			FROM 	[".$data[0]['database']."].[" . $data[0]['tableName'] . "]
			JOIN		[iCore].[staff]
			ON		[" . $data[0]['tableName'] . "].[executeBy] = [staff].[staffId]
			WHERE \" . \$this->auditFilter . \$tempSql . \$tempSql2 . \"
							)
							SELECT		*
							FROM 		[" . $data[0]['tableName'] . "Derived]
							WHERE 		[RowNumber]
							BETWEEN	\" . (\$this->getStart() + 1) . \"
							AND 			\" . (\$this->getStart() + \$this->getLimit()) . \" ;\";\n";
$str.= $mssqlReadPagingStatement;							
$str.="			 } else if (\$this->getVendor() == self::ORACLE) { \n";
$str.="				/** \n";
$str.="				 * Oracle using derived table also \n";
$str.="				 **/ \n";
$oracleReadStatement=null;
$oracleReadPagingStatement=null;
$oracleReadInsideStatement=null;
$oracleReadPagingCopyStatement=null;
$oracleReadStatement.="\n\$sql = \"SELECT";
	$oracleReadPagingStatement.="
						\$sql = \"
						SELECT *
						FROM ( SELECT	a.*,
												rownum r
						FROM (";
	for ($i = 0; $i < $total; $i++) {
		$oracleReadInsideStatement.=" ".strtoupper($data[0]['tableName']).".".strtoupper($data[$i]['columnName']).",\n";
	}
	$oracleReadStatement.=$oracleReadInsideStatement;

	$oracleReadStatement.="STAFF.STAFFNAME
			FROM 	".strtoupper($data[0]['tableName'])."
			JOIN		STAFF
			ON		".strtoupper($data[0]['tableName']).".EXECUTEBY = STAFF.STAFFID
			WHERE 		\" . \$this->auditFilter; \n";
	$oracleReadPagingCopyStatement = str_replace('$sql = "','',$oracleReadStatement);
	$oracleReadPagingCopyStatement = str_replace(';','.',$oracleReadPagingCopyStatement);
	$oracleReadPagingStatement.=substr($oracleReadPagingCopyStatement,0,-2);
	$oracleReadPagingStatement.="  \$tempSql . \$tempSql2 . \"
								 ) a
						where rownum <= '\" . (\$this->getStart() + \$this->getLimit()) . \"' )
						where r >=  '\" . (\$this->getStart() + 1) . \"'\";";	
$str.=	$oracleReadPagingStatement;					
$str.="			 } else { \n";
$str.="				echo json_encode(array(\"success\" => false, \"message\" => \$this->systemString->getNonSupportedDatabase())); \n";
$str.="				exit(); \n";
$str.="			} \n";
$str.="		} \n";

$str.="		/* \n";
$str.="		 *  Only Execute One Query \n";
$str.="		 */ \n";
$str.="		if (!(\$this->model->get".ucfirst($data[0]['tableName']."Id")."(0, 'single'))) { \n";
$str.="			\$this->q->read(\$sql); \n";
$str.="			if (\$this->q->execute == 'fail') { \n";
$str.="				echo json_encode(array(\"success\" => false, \"message\" => \$this->q->responce)); \n";
$str.="				exit(); \n";
$str.="			} \n";
$str.="		} \n";
$str.="		\$items = array(); \n";
$str.="        \$i = 1; \n";
$str.="		while ((\$row = \$this->q->fetchAssoc()) == TRUE) { \n";
$str.="			\$row['total'] = \$total; // small overide \n";
$str.="            \$row['counter'] = \$this->getStart() + $i; \n";
$str.="            if (\$this->model->get".ucfirst($data[0]['tableName']."Id")."(0, 'single')) { \n";
$str.="                \$row['firstRecord'] = \$this->firstRecord('value'); \n";
$str.="                \$row['previousRecord'] = \$this->previousRecord('value', \$this->model->get".ucfirst($data[0]['tableName'])."Id(0, 'single')); \n";
$str.="                \$row['nextRecord'] = \$this->nextRecord('value', \$this->model->get".ucfirst($data[0]['tableName'])."Id(0, 'single')); \n";
$str.="                \$row['lastRecord'] = \$this->lastRecord('value'); \n";
$str.="            }  \n";
$str.="            \$items [] = \$row; \n";
$str.="            \$i++; \n";
$str.="		}  \n";
$str.="		if (\$this->getPageOutput() == 'html') { \n";
$str.="            return \$items; \n";
$str.="        } else if (\$this->getPageOutput() == 'json') { \n";
$str.="			if (\$this->model->get".ucfirst($data[0]['tableName']."Id")."(0, 'single')) { \n";
$str.="				\$end = microtime(true); \n";
$str.="				\$time = \$end - \$start; \n";
$str.="				\$json_encode = json_encode(array( \n";
$str.="						'success' => true,  \n";
$str.="						'total' => \$total,  \n";
$str.="						'message' => \$this->systemString->getReadMessage(),  \n";
$str.="						'time' => \$time,  \n";
$str.="						'firstRecord' => \$this->firstRecord('value'),  \n";
$str.="						'previousRecord' => \$this->previousRecord('value', \$this->model->get".ucfirst($data[0]['tableName']."Id")."(0, 'single')),  \n";
$str.="						'nextRecord' => \$this->nextRecord('value', \$this->model->get".ucfirst($data[0]['tableName']."Id")."(0, 'single')),  \n";
$str.="						'lastRecord' => \$this->lastRecord('value'), \n";
$str.="						'data' => \$items)); \n";
$str.="				\$json_encode = str_replace(\"[\", \"\", \$json_encode); \n";
$str.="				\$json_encode = str_replace(\"]\", \"\", \$json_encode); \n";
$str.="				echo \$json_encode; \n";
$str.="			} else { \n";
$str.="				if (count(\$items) == 0) { \n";
$str.="					\$items = ''; \n";
$str.="				} \n";
$str.="				\$end = microtime(true); \n";
$str.="				\$time = \$end - \$start; \n";
$str.="				echo json_encode(array( \n";
$str.="					'success' =>true,  \n";
$str.="					'total' => \$total,  \n";
$str.="					'message' => \$this->systemString->getReadMessage(), \n";
$str.="					'time' => \$time,  \n";
$str.="					'firstRecord' => \$this->recordSet->firstRecord('value'),  \n";
$str.="					'previousRecord' => \$this->recordSet->previousRecord('value', \$this->model->get".ucfirst($data[0]['tableName']."Id")."(0, 'single')),  \n";
$str.="					'nextRecord' => \$this->recordSet->nextRecord('value', \$this->model->get".ucfirst($data[0]['tableName']."Id")."(0, 'single')),  \n";
$str.="					'lastRecord' => \$this->recordSet->lastRecord('value'), \n";
$str.="				'data' => \$items)); \n";
$str.="				exit();  \n";
$str.="			} \n";
$str.="		}	 \n";
$str.="	} \n";

$str.="	/* (non-PHPdoc) \n";
$str.="	 * @see config::update() \n";
$str.="	 */ \n";

$str.="	function update() { \n";
$str.="		header('Content-Type:application/json; charset=utf-8'); \n";
$str.="		\$start = microtime(true); \n";
$str.="		if (\$this->getVendor() == self::MYSQL) { \n";
$str.="			\$sql = \"SET NAMES utf8\"; \n";
$str.="			\$this->q->fast(\$sql); \n";
$str.="			if (\$this->q->execute == 'fail') { \n";
$str.="				echo json_encode(array(\"success\" => false, \"message\" => \$this->q->responce)); \n";
$str.="				exit(); \n";
$str.="			} \n";
$str.="		} \n";
$str.="		\$this->q->start(); \n";
$str.="		\$this->model->update(); \n";
$str.="		// before updating check the id exist or not . if exist continue to update else warning the user \n";
$str.="		if (\$this->getVendor() == self::MYSQL) {  \n";
$str.="			\$sql = \" \n";
$str.="		SELECT	`\" . \$this->model->getPrimaryKeyName() . \"` \n";
$str.="		FROM 	`" . $data[0]['database'] . "`.`\" . \$this->model->getTableName() . \"` \n";
$str.="		WHERE  	`\" . \$this->model->getPrimaryKeyName() . \"` = '\" . \$this->model->get".ucfirst($data[0]['tableName']."Id")."(0, 'single') . \"' \"; \n";
$str.="		} else if (\$this->getVendor() == self::MSSQL) { \n";
$str.="			\$sql = \" \n";
$str.="			SELECT	[\" . \$this->model->getPrimaryKeyName() . \"] \n";
$str.="			FROM 	[" . $data[0]['database'] . "].[\" . \$this->model->getTableName() . \"] \n";
$str.="			WHERE  	[\" . \$this->model->getPrimaryKeyName() . \"] = '\" . \$this->model->get".ucfirst($data[0]['tableName']."Id")."(0, 'single') . \"' \"; \n";
$str.="		} else if (\$this->getVendor() == self::ORACLE) { \n";
$str.="			\$sql = \" \n";
$str.="		SELECT	\" . strtoupper(\$this->model->getPrimaryKeyName()) . \" \n";
$str.="		FROM 	\" . strtoupper(\$this->model->getTableName()) . \" \n";
$str.="		WHERE  	\" . strtoupper(\$this->model->getPrimaryKeyName()) . \" = '\" . \$this->model->get".ucfirst($data[0]['tableName']."Id")."(0, 'single') . \"' \"; \n";
$str.="		} else if (\$this->getVendor() == self::DB2) { \n";
$str.="			\$sql = \" \n";
$str.="			SELECT	\" . strtoupper(\$this->model->getPrimaryKeyName()) . \" \n";
$str.="			FROM 	\" . strtoupper(\$this->model->getTableName()) . \" \n";
$str.="			WHERE  	\" . strtoupper(\$this->model->getPrimaryKeyName()) . \" = '\" . \$this->model->get".ucfirst($data[0]['tableName']."Id")."(0, 'single') . \"' \"; \n";
$str.="		} else if (\$this->getVendor() == self::POSTGRESS) { \n";
$str.="			\$sql = \" \n";
$str.="			SELECT	\" . strtoupper(\$this->model->getPrimaryKeyName()) . \" \n";
$str.="			FROM 	\" . strtoupper(\$this->model->getTableName()) . \" \n";
$str.="			WHERE  	\" . strtoupper(\$this->model->getPrimaryKeyName()) . \" = '\" . \$this->model->get".ucfirst($data[0]['tableName']."Id")."(0, 'single') . \"' \"; \n";
$str.="		} \n";
$str.="		\$result = \$this->q->fast(\$sql); \n";
$str.="		\$total = \$this->q->numberRows(\$result, \$sql); \n";
$str.="		if (\$total == 0) { \n";
$str.="			echo json_encode(array(\"success\" => false, \"message\" => \$this->systemString->getRecordNotFoundMessage())); \n";
$str.="			exit(); \n";
$str.="		} else { \n";
$str.="			if (\$this->getVendor() == self::MYSQL) { \n";
$mysqlUpdateStatement=null;
$mysqlUpdateStatementInsideValue=null;
$mysqlUpdateStatementValue=null;
$mysqlUpdateStatement="\n\$sql=\"UPDATE `".$data[0]['database']."`.`" . $data[0]['tableName'] . "` SET \n";
	$i=0;
	for ($i = 0; $i < $total; $i++) {
		
		if($i >= 1  ) { 
		if($data[$i]['columnName'] !='isDefault' &&
		$data[$i]['columnName'] !='isNew' &&
		$data[$i]['columnName'] !='isDraft'&&
		$data[$i]['columnName'] !='isUpdate'&&
		$data[$i]['columnName'] !='isDelete'&&
		$data[$i]['columnName'] !='isActive'&&
		$data[$i]['columnName'] !='isApproved'&&
		$data[$i]['columnName'] !='isReview'&&
		$data[$i]['columnName'] !='isPost'&&
		$data[$i]['columnName'] !='isSeperated'&&
		$data[$i]['columnName'] !='isConsolidation'&&
		$data[$i]['columnName'] !='isReconciled'&&
		$data[$i]['columnName'] !='executeBy' &&
		$data[$i]['columnName'] !='executeTime') {
			$mysqlUpdateStatementInsideValue.=" `".$data[$i]['columnName'] . "` = '\".\$this->model->get".ucFirst($data[$i]['columnName'])."().\"',\n";
		} else if ($data[$i]['columnName'] =='executeTime') {
			$mysqlUpdateStatementInsideValue.=" `".$data[$i]['columnName'] . "` = \".\$this->model->get".ucFirst($data[$i]['columnName'])."().\",\n";
		} else {
						$mysqlUpdateStatementInsideValue.=" `".$data[$i]['columnName'] . "` = '\".\$this->model->get".ucFirst($data[$i]['columnName'])."('0','single').\"',\n";

		}
		}
	}
	$mysqlUpdateStatementValue.=(substr($mysqlUpdateStatementInsideValue,0,-2));
	$mysqlUpdateStatement.=$mysqlUpdateStatementValue;
	$mysqlUpdateStatement.=" \nWHERE `".$data[0]['tableName']."Id`='\".\$this->model->get".ucfirst($data[0]['tableName'])."Id('0','single').\"'\";\n\n";
$str.=$mysqlUpdateStatement;

$str.="			 } else if (\$this->getVendor() == self::MSSQL) {  \n";

$mssqlUpdateStatement=null;
$mssqlUpdateStatementInsideValue=null;
$mssqlUpdateStatementValue=null;
$mssqlUpdateStatement="\n\$sql=\"UPDATE [".$data[0]['database']."].[".$data[0]['tableName']."] SET \n";
	$i=0;;
	for ($i = 0; $i < $total; $i++) {
		
		if($i >= 1 ) { 
		if($data[$i]['columnName'] !='isDefault' &&
		$data[$i]['columnName'] !='isNew' &&
		$data[$i]['columnName'] !='isDraft'&&
		$data[$i]['columnName'] !='isUpdate'&&
		$data[$i]['columnName'] !='isDelete'&&
		$data[$i]['columnName'] !='isActive'&&
		$data[$i]['columnName'] !='isApproved'&&
		$data[$i]['columnName'] !='isReview'&&
		$data[$i]['columnName'] !='isPost'&&
		$data[$i]['columnName'] !='isSeperated'&&
		$data[$i]['columnName'] !='isConsolidation'&&
		$data[$i]['columnName'] !='isReconciled'&&
		$data[$i]['columnName'] !='executeBy' &&
		$data[$i]['columnName'] !='executeTime') {
			$mssqlUpdateStatementInsideValue.=" [".$data[$i]['columnName'] . "] = '\".\$this->model->get".ucFirst($data[$i]['columnName'])."().\"',\n";
		} else if ($data[$i]['columnName'] =='executeTime') {
			$mssqlUpdateStatementInsideValue.=" [".$data[$i]['columnName'] . "] = \".\$this->model->get".ucFirst($data[$i]['columnName'])."().\",\n";
		}else {
			$mssqlUpdateStatementInsideValue.=" [".$data[$i]['columnName'] . "] = '\".\$this->model->get".ucFirst($data[$i]['columnName'])."(0, 'single').\"',\n";
		}
		}
	}
	$mssqlUpdateStatementValue.=(substr($mssqlUpdateStatementInsideValue,0,-2));
	$mssqlUpdateStatement.=$mssqlUpdateStatementValue;
	$mssqlUpdateStatement.=" \nWHERE [".$data[0]['tableName']."Id]='\".\$this->model->get".ucfirst($data[0]['tableName'])."Id('0','single').\"'\";\n\n";
$str.=$mssqlUpdateStatement;
$str.="			 } else if (\$this->getVendor() == self::ORACLE) {  \n";
$oracleUpdateStatement=null;
$oracleUpdateStatementInsideValue=null;
$oracleUpdateStatementValue=null;
$oracleUpdateStatement="\n\$sql=\"UPDATE `".strtoupper($data[0]['tableName'])."` SET\n ";
	$i=0;
	for ($i = 0; $i < $total; $i++) {
		
		if($i !=1 ) { 
		if($data[$i]['columnName'] !='isDefault' &&
		$data[$i]['columnName'] !='isNew' &&
		$data[$i]['columnName'] !='isDraft'&&
		$data[$i]['columnName'] !='isUpdate'&&
		$data[$i]['columnName'] !='isDelete'&&
		$data[$i]['columnName'] !='isActive'&&
		$data[$i]['columnName'] !='isApproved'&&
		$data[$i]['columnName'] !='isReview'&&
		$data[$i]['columnName'] !='isPost'&&
		$data[$i]['columnName'] !='isSeperated'&&
		$data[$i]['columnName'] !='isConsolidation'&&
		$data[$i]['columnName'] !='isReconciled'&&
		$data[$i]['columnName'] !='executeBy' &&
		$data[$i]['columnName'] !='executeTime') {
			$oracleUpdateStatementInsideValue.=" ".strtoupper($data[$i]['columnName'])." = '\".\$this->model->get".ucFirst($data[$i]['columnName'])."().\"',\n";
		} else if ($data[$i]['columnName'] =='executeTime'){
			$oracleUpdateStatementInsideValue.=" ".strtoupper($data[$i]['columnName'])." = \".\$this->model->get".ucFirst($data[$i]['columnName'])."().\",\n";
		}else {
			$oracleUpdateStatementInsideValue.=" ".strtoupper($data[$i]['columnName'])." = '\".\$this->model->get".ucFirst($data[$i]['columnName'])."(0, 'single').\"',\n";
		}
		}
	}
	$oracleUpdateStatementValue.=(substr($oracleUpdateStatementInsideValue,0,-2));
	$oracleUpdateStatement.=$oracleUpdateStatementValue;
	$oracleUpdateStatement.=" \nWHERE `".strtoupper($data[0]['tableName']."Id")."`='\".\$this->model->get".ucfirst($data[0]['tableName'])."Id('0','single').\"'\";\n\n";

$str.=$oracleUpdateStatement;
$str.="			 } else if (\$this->getVendor() == self::DB2) {  \n";
$oracleUpdateStatement=null;
$oracleUpdateStatementInsideValue=null;
$oracleUpdateStatementValue=null;
$oracleUpdateStatement="\n\$sql=\"UPDATE `".strtoupper($data[0]['tableName'])."` SET\n ";
	$i=0;
	for ($i = 0; $i < $total; $i++) {
		
		if($i >= 1) { 
		if($data[$i]['columnName'] !='isDefault' &&
		$data[$i]['columnName'] !='isNew' &&
		$data[$i]['columnName'] !='isDraft'&&
		$data[$i]['columnName'] !='isUpdate'&&
		$data[$i]['columnName'] !='isDelete'&&
		$data[$i]['columnName'] !='isActive'&&
		$data[$i]['columnName'] !='isApproved'&&
		$data[$i]['columnName'] !='isReview'&&
		$data[$i]['columnName'] !='isPost'&&
		$data[$i]['columnName'] !='isSeperated'&&
		$data[$i]['columnName'] !='isConsolidation'&&
		$data[$i]['columnName'] !='isReconciled'&&
		$data[$i]['columnName'] !='executeBy' &&
		$data[$i]['columnName'] !='executeTime') {
			$oracleUpdateStatementInsideValue.=" ".strtoupper($data[$i]['columnName'])." = '\".\$this->model->get".ucFirst($data[$i]['columnName'])."().\"',\n";
		} else if ($data[$i]['columnName'] =='executeTime'){
			$oracleUpdateStatementInsideValue.=" ".strtoupper($data[$i]['columnName'])." = \".\$this->model->get".ucFirst($data[$i]['columnName'])."().\",\n";
		}else {
			$oracleUpdateStatementInsideValue.=" ".strtoupper($data[$i]['columnName'])." = '\".\$this->model->get".ucFirst($data[$i]['columnName'])."(0, 'single').\"',\n";
		}
		}
	}
	$oracleUpdateStatementValue.=(substr($oracleUpdateStatementInsideValue,0,-2));
	$oracleUpdateStatement.=$oracleUpdateStatementValue;
	$oracleUpdateStatement.=" \nWHERE `".strtoupper($data[0]['tableName']."Id")."`='\".\$this->model->get".ucfirst($data[0]['tableName'])."Id('0','single').\"'\";\n\n";

$str.=$oracleUpdateStatement;
$str.="			} else if (\$this->getVendor() == self::POSTGRESS) {  \n";
$oracleUpdateStatement=null;
$oracleUpdateStatementInsideValue=null;
$oracleUpdateStatementValue=null;
$oracleUpdateStatement="\n\$sql=\"UPDATE `".strtoupper($data[0]['tableName'])."` SET\n ";
	$i=0;
	for ($i = 0; $i < $total; $i++) {
		
		if($i >= 1) { 
		if($data[$i]['columnName'] !='isDefault' &&
		$data[$i]['columnName'] !='isNew' &&
		$data[$i]['columnName'] !='isDraft'&&
		$data[$i]['columnName'] !='isUpdate'&&
		$data[$i]['columnName'] !='isDelete'&&
		$data[$i]['columnName'] !='isActive'&&
		$data[$i]['columnName'] !='isApproved'&&
		$data[$i]['columnName'] !='isReview'&&
		$data[$i]['columnName'] !='isPost'&&
		$data[$i]['columnName'] !='isSeperated'&&
		$data[$i]['columnName'] !='isConsolidation'&&
		$data[$i]['columnName'] !='isReconciled'&&
		$data[$i]['columnName'] !='executeBy' &&
		$data[$i]['columnName'] !='executeTime') {
			$oracleUpdateStatementInsideValue.=" ".strtoupper($data[$i]['columnName'])." = '\".\$this->model->get".ucFirst($data[$i]['columnName'])."().\"',\n";
		} else if ($data[$i]['columnName'] =='executeTime'){
			$oracleUpdateStatementInsideValue.=" ".strtoupper($data[$i]['columnName'])." = \".\$this->model->get".ucFirst($data[$i]['columnName'])."().\",\n";
		}else {
			$oracleUpdateStatementInsideValue.=" ".strtoupper($data[$i]['columnName'])." = '\".\$this->model->get".ucFirst($data[$i]['columnName'])."(0, 'single').\"',\n";
		}
		}
	}
	$oracleUpdateStatementValue.=(substr($oracleUpdateStatementInsideValue,0,-2));
	$oracleUpdateStatement.=$oracleUpdateStatementValue;
	$oracleUpdateStatement.=" \nWHERE `".strtoupper($data[0]['tableName']."Id")."`='\".\$this->model->get".ucfirst($data[0]['tableName'])."Id('0','single').\"'\";\n\n";

$str.=$oracleUpdateStatement;
$str.="			} \n";

$str.="			\$this->q->update(\$sql); \n";
$str.="			if (\$this->q->execute == 'fail') { \n";
$str.="				echo json_encode(array(\"success\" => false, \"message\" => \$this->q->responce)); \n";
$str.="				exit(); \n";
$str.="			} \n";
$str.="		} \n";
$str.="		\$this->q->commit(); \n";
$str.="		\$end = microtime(true); \n";
$str.="		\$time = \$end - \$start; \n";
$str.="		echo json_encode( \n";
$str.="		array(	\"success\" =>true, \n";
$str.="					\"message\" => \$this->systemString->getUpdateMessage(), \n";
$str.="					\"time\"=>\$time)); \n";
$str.="		exit(); \n";
$str.="	} \n";

$str.="	 /* (non-PHPdoc) \n";
$str.="	 * @see config::delete() \n";
$str.="	 */ \n";

$str.="	function delete() { \n";
$str.="		header('Content-Type:application/json; charset=utf-8'); \n";
$str.="		\$start = microtime(true); \n";
$str.="		if (\$this->getVendor() == self::MYSQL) { \n";
$str.="			\$sql = \"SET NAMES utf8\"; \n";
$str.="			\$this->q->fast(\$sql); \n";
$str.="		} \n";
$str.="		\$this->q->start(); \n";
$str.="		\$this->model->delete(); \n";
$str.="		// before updating check the id exist or not . if exist continue to update else warning the user \n";
$str.="		if (\$this->getVendor() == self::MYSQL) { \n";
$str.="			\$sql = \" \n";
$str.="		SELECT	`\" . \$this->model->getPrimaryKeyName() . \"` \n";
$str.="		FROM 	`" . $data[0]['database'] . "`.`\" . \$this->model->getTableName() . \"` \n";
$str.="		WHERE  	`\" . \$this->model->getPrimaryKeyName() . \"` = '\" . \$this->model->get".ucfirst($data[0]['tableName']."Id")."(0, 'single') . \"' \";  \n";
$str.="		} else if (\$this->getVendor() == self::MSSQL) { \n";
$str.="			\$sql = \" \n";
$str.="			SELECT	[\" . \$this->model->getPrimaryKeyName() . \"]  \n";
$str.="			FROM 	[" . $data[0]['database'] . "].[\" . \$this->model->getTableName() . \"] \n";
$str.="			WHERE  	[\" . \$this->model->getPrimaryKeyName() . \"] = '\" . \$this->model->get".ucfirst($data[0]['tableName']."Id")."(0, 'single') . \"' \"; \n";
$str.="		} else if (\$this->getVendor() == self::ORACLE) { \n";
$str.="			\$sql = \" \n";
$str.="		SELECT	\" . strtoupper(\$this->model->getPrimaryKeyName()) . \" \n";
$str.="		FROM 	\" . strtoupper(\$this->model->getTableName()) . \" \n";
$str.="		WHERE  	\" . strtoupper(\$this->model->getPrimaryKeyName()) . \" = '\" . \$this->model->get".ucfirst($data[0]['tableName']."Id")."(0, 'single') . \"' \"; \n";
$str.="		} else if (\$this->getVendor() == self::DB2) { \n";
$str.="			\$sql = \" \n";
$str.="			SELECT	\" . strtoupper(\$this->model->getPrimaryKeyName()) . \" \n";
$str.="			FROM 	\" . strtoupper(\$this->model->getTableName()) . \" \n";
$str.="			WHERE  	\" . strtoupper(\$this->model->getPrimaryKeyName()) . \" = '\" . \$this->model->get".ucfirst($data[0]['tableName']."Id")."(0, 'single') . \"' \"; \n";
$str.="		} else if (\$this->getVendor() == self::POSTGRESS) { \n";
$str.="			\$sql = \" \n";
$str.="			SELECT	\" . strtoupper(\$this->model->getPrimaryKeyName()) . \" \n";
$str.="			FROM 	\" . strtoupper(\$this->model->getTableName()) . \" \n";
$str.="			WHERE  	\" . strtoupper(\$this->model->getPrimaryKeyName()) . \" = '\" . \$this->model->get".ucfirst($data[0]['tableName']."Id")."(0, 'single') . \"' \"; \n";
$str.="		} \n";
$str.="		\$result = \$this->q->fast(\$sql); \n";
$str.="		\$total = \$this->q->numberRows(\$result, \$sql); \n";
$str.="		if (\$total == 0) { \n";
$str.="			echo json_encode(array(\"success\" => false, \"message\" => \$this->systemString->getRecordNotFoundMessage())); \n";
$str.="			exit(); \n";
$str.="		} else { \n";
$str.="			if (\$this->getVendor() == self::MYSQL) { \n";
$str.= " \$sql=\"  	UPDATE 	`".$data[0]['database']."`.`" . $data[0]['tableName'] . "`\n
					SET 	`isDefault`				=	'\" . \$this->model->getIsDefault(0, 'single') . \"',
							`isNew`					=	'\" . \$this->model->getIsNew(0, 'single') . \"',
							`isDraft`					=	'\" . \$this->model->getIsDraft(0, 'single') . \"',
							`isUpdate`				=	'\" . \$this->model->getIsUpdate(0, 'single') . \"',
							`isDelete`					=	'\" . \$this->model->getIsDelete(0, 'single') . \"',
							`isActive`					=	'\" . \$this->model->getIsActive(0, 'single') . \"',
							`isApproved`			=	'\" . \$this->model->getIsApproved(0, 'single') . \"',
							`isReview`				=	'\" . \$this->model->getIsReview(0, 'single') . \"',
							`isPost`					=	'\" . \$this->model->getIsPost(0, 'single') . \"',
							`executeBy`				=	'\" . \$this->model->getExecuteBy() . \"',
							`executeTime`			=	\" . \$this->model->getExecuteTime() . \"
				WHERE 	`".$data[0]['tableName']."Id`	=  '\" . \$this->model->get".ucfirst($data[0]['tableName'])."Id(0, 'single') . \"'\";\n";

$str.="			 } else if (\$this->getVendor() == self::MSSQL) {  \n";
$str.= "
			\$sql=\"   	
				UPDATE 	[".$data[0]['database']."].[" . $data[0]['tableName'] . "]
				SET 			[isDefault]					=	'\" . \$this->model->getIsDefault(0, 'single') . \"',
								[isNew]						=	'\" . \$this->model->getIsNew(0, 'single') . \"',
								[isDraft]					=	'\" . \$this->model->getIsDraft(0, 'single') . \"',
								[isUpdate]					=	'\" . \$this->model->getIsUpdate(0, 'single') . \"',
								[isDelete]					=	'\" . \$this->model->getIsDelete(0, 'single') . \"',
								[isActive]					=	'\" . \$this->model->getIsActive(0, 'single') . \"',
								[isApproved]				=	'\" . \$this->model->getIsApproved(0, 'single') . \"',
								[isReview]					=	'\" . \$this->model->getIsReview(0, 'single') . \"',
								[isPost]						=	'\" . \$this->model->getIsPost(0, 'single') . \"',
								[executeBy]				=	'\" . \$this->model->getExecuteBy() . \"',
								[executeTime]			=	\" . \$this->model->getExecuteTime() . \"
				WHERE 		[".$data[0]['tableName']."Id]	=  '\" . \$this->model->get".ucfirst($data[0]['tableName'])."Id(0, 'single') . \"'\";\n";
$str.="			 } else if (\$this->getVendor() == self::ORACLE) {  \n";
	$str.= "
	\$sql=\" 
				UPDATE 	".strtoupper($data[0]['tableName'])."
				SET 	ISDEFAULT		=	'\" . \$this->model->getIsDefault(0, 'single') . \"',
						ISNEW			=	'\" . \$this->model->getIsNew(0, 'single') . \"',
						ISDRAFT			=	'\" . \$this->model->getIsDraft(0, 'single') .\"',
						ISUPDATE		=	'\" . \$this->model->getIsUpdate(0, 'single') . \"',
						ISDELETE		=	'\" . \$this->model->getIsDelete(0, 'single') . \"',
						ISACTIVE		=	'\" . \$this->model->getIsActive(0, 'single') . \"',
						ISAPPROVED		=	'\" . \$this->model->getIsApproved(0, 'single') .\"',
						ISREVIEW		=	'\" .\$this->model->getIsReview(0, 'single') . \"',
						ISPOST			=	'\" . \$this->model->getIsPost(0, 'single') .\"',
						EXECUTEBY		=	'\" . \$this->model->getExecuteBy() .\"',
						EXECUTETIME		=	\" . \$this->model->getExecuteTime() . \"
				WHERE 	".strtoupper($data[0]['tableName'])."Id	=  '\" . \$this->model->get".ucfirst($data[0]['tableName'])."Id(0, 'single') . \"'\";\n";
$str.="			 } else if (\$this->getVendor() == self::DB2) {  \n";
	$str .= "
	\$sql=\" 
				UPDATE 	".strtoupper($data[0]['tableName'])."
				SET 	ISDEFAULT		=	'\" . \$this->model->getIsDefault(0, 'single') . \"',
						ISNEW			=	'\" . \$this->model->getIsNew(0, 'single') . \"',
						ISDRAFT			=	'\" . \$this->model->getIsDraft(0, 'single') .\"',
						ISUPDATE		=	'\" . \$this->model->getIsUpdate(0, 'single') . \"',
						ISDELETE		=	'\" . \$this->model->getIsDelete(0, 'single') . \"',
						ISACTIVE		=	'\" . \$this->model->getIsActive(0, 'single') . \"',
						ISAPPROVED		=	'\" . \$this->model->getIsApproved(0, 'single') .\"',
						ISREVIEW		=	'\" .\$this->model->getIsReview(0, 'single') . \"',
						ISPOST			=	'\" . \$this->model->getIsPost(0, 'single') .\"',
						EXECUTEBY		=	'\" . \$this->model->getExecuteBy() .\"',
						EXECUTETIME		=	\" . \$this->model->getExecuteTime() . \"
				WHERE 	".strtoupper($data[0]['tableName'])."Id	=  '\" . \$this->model->get".ucfirst($data[0]['tableName'])."Id(0, 'single') . \"'\";\n";
$str.="			 } else if (\$this->getVendor() == self::POSTGRESS) {  \n";
$str .= " \$sql=\" 
				UPDATE 	".strtoupper($data[0]['tableName'])."
				SET 	ISDEFAULT		=	'\" . \$this->model->getIsDefault(0, 'single') . \"',
						ISNEW			=	'\" . \$this->model->getIsNew(0, 'single') . \"',
						ISDRAFT			=	'\" . \$this->model->getIsDraft(0, 'single') .\"',
						ISUPDATE		=	'\" . \$this->model->getIsUpdate(0, 'single') . \"',
						ISDELETE		=	'\" . \$this->model->getIsDelete(0, 'single') . \"',
						ISACTIVE		=	'\" . \$this->model->getIsActive(0, 'single') . \"',
						ISAPPROVED		=	'\" . \$this->model->getIsApproved(0, 'single') .\"',
						ISREVIEW		=	'\" .\$this->model->getIsReview(0, 'single') . \"',
						ISPOST			=	'\" . \$this->model->getIsPost(0, 'single') .\"',
						EXECUTEBY		=	'\" . \$this->model->getExecuteBy() .\"',
						EXECUTETIME		=	\" . \$this->model->getExecuteTime() . \"
				WHERE 	".strtoupper($data[0]['tableName'])."Id	=  '\" . \$this->model->get".ucfirst($data[0]['tableName'])."Id(0, 'single') . \"'\";\n";
$str.="			}  \n";
$str.="			\$this->q->update(\$sql); \n";
$str.="			if (\$this->q->execute == 'fail') { \n";
$str.="				echo json_encode(array(\"success\" => false, \"message\" => \$this->q->responce)); \n";
$str.="				exit(); \n";
$str.="			} \n";
$str.="		} \n";
$str.="		\$this->q->commit(); \n";
$str.="		\$end = microtime(true); \n";
$str.="		\$time = \$end - \$start; \n";
$str.="		echo json_encode( \n";
$str.="		array(	\"success\" => true, \n";
$str.="					\"message\" => \$this->systemString->getDeleteMessage(), \n";
$str.="					\"time\"=>\$time)); \n";
$str.="		exit(); \n";
$str.="	} \n";

$str.=" /** \n";
$str.="	 * To Update flag Status \n";
$str.="	 */ \n";
$str.="	function updateStatus() { \n";
$str.="		header('Content-Type:application/json; charset=utf-8'); \n";
$str.="		\$start = microtime(true); \n";
$str.="		if (\$this->getVendor() == self::MYSQL) { \n";

$str.="			\$sql = \"SET NAMES utf8\"; \n";
$str.="			\$this->q->fast(\$sql); \n";
$str.="		} \n";
$str.="		\$this->q->start(); \n";
$str.="		\$loop = \$this->model->getTotal(); \n";
$str.="		if (\$this->getVendor() == self::MYSQL) { \n";
$str.="			\$sql = \" \n";
$str.="			UPDATE `" . $data[0]['database'] . "`.`\" . \$this->model->getTableName() . \"` \n";
$str.="			SET\"; \n";
$str.="		} else if (\$this->getVendor() == self::MSSQL) { \n";
$str.="			\$sql = \" \n";
$str.="			UPDATE 	[" . $data[0]['database'] . "].[\" . \$this->model->getTableName() . \"] \n";
$str.="			SET 	\"; \n";
$str.="		} else if (\$this->getVendor() == self::ORACLE) { \n";
$str.="			\$sql = \" \n";
$str.="			UPDATE \" . strtoupper(\$this->model->getTableName()) . \" \n";
$str.="			SET    \"; \n";
$str.="		} else if (\$this->getVendor() == self::DB2) { \n";
$str.="			\$sql = \" \n";
$str.="			UPDATE \" . strtoupper(\$this->model->getTableName()) . \" \n";
$str.="			SET    \"; \n";
$str.="		} else if (\$this->getVendor() == self::POSTGRESS) { \n";
$str.="			\$sql = \" \n";
$str.="			UPDATE \" . strtoupper(\$this->model->getTableName()) . \" \n";
$str.="			SET    \"; \n";
$str.="		} else { \n";
$str.="			echo json_encode(array(\"success\" => false, \"message\" => \$this->systemString->getNonSupportedDatabase())); \n";
$str.="			exit(); \n";
$str.="		} \n";
$str.="		 /** \n";
$str.="		 * System Validation Checking \n";
$str.="		 * @var \$access \n";
$str.="		 */ \n";
$str.="		\$access = array(\"isDefault\", \"isNew\", \"isDraft\", \"isUpdate\", \"isDelete\", \"isActive\", \"isApproved\", \"isReview\", \"isPost\"); \n";
$str.="				\$accessClear = array(\"isDefault\", \"isNew\", \"isDraft\", \"isUpdate\",  \"isActive\", \"isApproved\", \"isReview\", \"isPost\"); \n";
		
$str.="		foreach (\$access as \$systemCheck) { \n";

$str.="			switch (\$systemCheck) { \n";
$str.="				case 'isDefault' : \n";
$str.="					for (\$i = 0; \$i < \$loop; \$i++) {\n";
$str.="						if (strlen(\$this->model->getIsDefault(\$i, 'array')) > 0) {\n";
$str.="							if (\$this->getVendor() == self::MYSQL) {\n";
$str.="								\$sqlLooping .= \" `\" . \$systemCheck . \"` = CASE `" . $data[0]['database'] . "`.`\".\$this->model->getTableName().\"`.`\" . \$this->model->getPrimaryKeyName() . \"`\"; \n";
$str.="							} else if (\$this->getVendor() == self::MSSQL) {\n";
$str.="								\$sqlLooping .= \"  [\" . \$systemCheck . \"] = CASE [" . $data[0]['database'] . "].[\".\$this->model->getTableName().\"].[\" . \$this->model->getPrimaryKeyName() . \"]\"; \n";
$str.="							} else if (\$this->getVendor() == self::ORACLE) {\n";
$str.="								\$sqlLooping .= \"	\" . strtoupper(\$systemCheck) . \" = CASE " . $data[0]['database'] . ".\" . strtoupper(\$this->model->getTableName()).strtoupper(\$this->model->getPrimaryKeyName()) . \" \"; \n";
$str.="							} else if (\$this->getVendor() == self::DB2) {\n";
$str.="								\$sqlLooping .= \"	\" . strtoupper(\$systemCheck) . \" = CASE " . $data[0]['database'] . ".\" . strtoupper(\$this->model->getTableName()).strtoupper(\$this->model->getPrimaryKeyName()) . \" \"; \n";
$str.="							} else if (\$this->getVendor() == self::POSTGRESS) {\n";
$str.="								\$sqlLooping .= \"	\" . strtoupper(\$systemCheck) . \" = CASE " . $data[0]['database'] . ".\" . strtoupper(\$this->model->getTableName()).strtoupper(\$this->model->getPrimaryKeyName()) . \" \"; \n";
$str.="							} else { \n";
$str.="								echo json_encode(array(\"success\" => false, \"message\" => \$this->systemString->getNonSupportedDatabase())); \n";
$str.="								exit();\n";
$str.="							}\n";
$str.="							\$sqlLooping .= \"\n";
$str.="							WHEN '\" . \$this->model->get".ucfirst($data[0]['tableName']."Id")."(\$i, 'array') . \"'\n";
$str.="							THEN '\" . \$this->model->getIsDefault(\$i, 'array') . \"'\";\n";
$str.="							\$sqlLooping .= \" END,\";\n";
$str.="						} \n";
$str.="					} \n";
$str.="					break; \n";
$str.="				case 'isNew' : \n";
$str.="					for (\$i = 0; \$i < \$loop; \$i++) {\n";
$str.="						if (strlen(\$this->model->getIsNew(\$i, 'array')) > 0) {\n";
$str.="							if (\$this->getVendor() == self::MYSQL) {\n";
$str.="								\$sqlLooping .= \" `\" . \$systemCheck . \"` = CASE `" . $data[0]['database'] . "`.`\".\$this->model->getTableName().\"`.`\" . \$this->model->getPrimaryKeyName() . \"`\"; \n";
$str.="							} else if (\$this->getVendor() == self::MSSQL) {\n";
$str.="								\$sqlLooping .= \"  [\" . \$systemCheck . \"] = CASE [" . $data[0]['database'] . "].[\".\$this->model->getTableName().\"].[\" . \$this->model->getPrimaryKeyName() . \"]\"; \n";
$str.="							} else if (\$this->getVendor() == self::ORACLE) {\n";
$str.="								\$sqlLooping .= \"	\" . strtoupper(\$systemCheck) . \" = CASE " . $data[0]['database'] . ".\" . strtoupper(\$this->model->getTableName()).strtoupper(\$this->model->getPrimaryKeyName()) . \" \"; \n";
$str.="							} else if (\$this->getVendor() == self::DB2) {\n";
$str.="								\$sqlLooping .= \"	\" . strtoupper(\$systemCheck) . \" = CASE " . $data[0]['database'] . ".\" . strtoupper(\$this->model->getTableName()).strtoupper(\$this->model->getPrimaryKeyName()) . \" \"; \n";
$str.="							} else if (\$this->getVendor() == self::POSTGRESS) {\n";
$str.="								\$sqlLooping .= \"	\" . strtoupper(\$systemCheck) . \" = CASE " . $data[0]['database'] . ".\" . strtoupper(\$this->model->getTableName()).strtoupper(\$this->model->getPrimaryKeyName()) . \" \"; \n";
$str.="							} else {\n";
$str.="								echo json_encode(array(\"success\" => false, \"message\" => \$this->systemString->getNonSupportedDatabase()));\n";
$str.="								exit();\n";
$str.="							} \n";
$str.="							\$sqlLooping .= \" \n";
$str.="							WHEN '\" . \$this->model->get".ucfirst($data[0]['tableName']."Id")."(\$i, 'array') . \"' \n";
$str.="							THEN '\" . \$this->model->getIsNew(\$i, 'array') . \"'\"; \n";
$str.="							\$sqlLooping .= \" END,\";\n";
$str.="						} \n";
$str.="					} \n";
$str.="					break; \n";
$str.="				case 'isDraft' : \n";
$str.="					for (\$i = 0; \$i < \$loop; \$i++) {\n";
$str.="						if (strlen(\$this->model->getIsDraft(\$i, 'array')) > 0) {\n";
$str.="							if (\$this->getVendor() == self::MYSQL) {\n";
$str.="								\$sqlLooping .= \" `\" . \$systemCheck . \"` = CASE `" . $data[0]['database'] . "`.`\".\$this->model->getTableName().\"`.`\" . \$this->model->getPrimaryKeyName() . \"`\"; \n";
$str.="							} else if (\$this->getVendor() == self::MSSQL) {\n";
$str.="								\$sqlLooping .= \"  [\" . \$systemCheck . \"] = CASE [" . $data[0]['database'] . "].[\".\$this->model->getTableName().\"].[\" . \$this->model->getPrimaryKeyName() . \"]\"; \n";
$str.="							} else if (\$this->getVendor() == self::ORACLE) {\n";
$str.="								\$sqlLooping .= \"	\" . strtoupper(\$systemCheck) . \" = CASE " . $data[0]['database'] . ".\" . strtoupper(\$this->model->getTableName()).strtoupper(\$this->model->getPrimaryKeyName()) . \" \"; \n";
$str.="							} else if (\$this->getVendor() == self::DB2) {\n";
$str.="								\$sqlLooping .= \"	\" . strtoupper(\$systemCheck) . \" = CASE " . $data[0]['database'] . ".\" . strtoupper(\$this->model->getTableName()).strtoupper(\$this->model->getPrimaryKeyName()) . \" \"; \n";
$str.="							} else if (\$this->getVendor() == self::POSTGRESS) {\n";
$str.="								\$sqlLooping .= \"	\" . strtoupper(\$systemCheck) . \" = CASE " . $data[0]['database'] . ".\" . strtoupper(\$this->model->getTableName()).strtoupper(\$this->model->getPrimaryKeyName()) . \" \"; \n";
$str.="							} else {\n";
$str.="								echo json_encode(array(\"success\" => false, \"message\" => \$this->systemString->getNonSupportedDatabase()));\n";
$str.="								exit();\n";
$str.="							} \n";
$str.="							\$sqlLooping .= \"\n";
$str.="							WHEN '\" . \$this->model->get".ucfirst($data[0]['tableName']."Id")."(\$i, 'array') . \"'\n";
$str.="							THEN '\" . \$this->model->getIsDraft(\$i, 'array') . \"'\";\n";
$str.="							\$sqlLooping .= \" END,\";\n";
$str.="						} \n";
$str.="					} \n";
$str.="					break; \n";
$str.="				case 'isUpdate' :\n";
$str.="					for (\$i = 0; \$i < \$loop; \$i++) {\n";
$str.="						if (strlen(\$this->model->getIsUpdate(\$i, 'array')) > 0) {\n";
$str.="							if (\$this->getVendor() == self::MYSQL) {\n";
$str.="								\$sqlLooping .= \" `\" . \$systemCheck . \"` = CASE `" . $data[0]['database'] . "`.`\".\$this->model->getTableName().\"`.`\" . \$this->model->getPrimaryKeyName() . \"`\"; \n";
$str.="							} else if (\$this->getVendor() == self::MSSQL) {\n";
$str.="								\$sqlLooping .= \"  [\" . \$systemCheck . \"] = CASE [" . $data[0]['database'] . "].[\".\$this->model->getTableName().\"].[\" . \$this->model->getPrimaryKeyName() . \"]\"; \n";
$str.="							} else if (\$this->getVendor() == self::ORACLE) {\n";
$str.="								\$sqlLooping .= \"	\" . strtoupper(\$systemCheck) . \" = CASE " . $data[0]['database'] . ".\" . strtoupper(\$this->model->getTableName()).strtoupper(\$this->model->getPrimaryKeyName()) . \" \"; \n";
$str.="							} else if (\$this->getVendor() == self::DB2) {\n";
$str.="								\$sqlLooping .= \"	\" . strtoupper(\$systemCheck) . \" = CASE " . $data[0]['database'] . ".\" . strtoupper(\$this->model->getTableName()).strtoupper(\$this->model->getPrimaryKeyName()) . \" \"; \n";
$str.="							} else if (\$this->getVendor() == self::POSTGRESS) {\n";
$str.="								\$sqlLooping .= \"	\" . strtoupper(\$systemCheck) . \" = CASE " . $data[0]['database'] . ".\" . strtoupper(\$this->model->getTableName()).strtoupper(\$this->model->getPrimaryKeyName()) . \" \"; \n";
$str.="							} else {\n";
$str.="								echo json_encode(array(\"success\" => false, \"message\" => \$this->systemString->getNonSupportedDatabase()));\n";
$str.="								exit();\n";
$str.="							}\n";
$str.="							\$sqlLooping .= \"\n";
$str.="							WHEN '\" . \$this->model->get".ucfirst($data[0]['tableName']."Id")."(\$i, 'array') . \"'\n";
$str.="							THEN '\" . \$this->model->getIsUpdate(\$i, 'array') . \"'\";\n";
$str.="							\$sqlLooping .= \" END,\";\n";
$str.="						} \n";
$str.="					} \n";
$str.="					break; \n";
$str.="				case 'isDelete' :\n";
$str.="					for (\$i = 0; \$i < \$loop; \$i++) {\n";
$str.="						if (strlen(\$this->model->getIsDelete(\$i, 'array')) > 0) {\n";
$str.="							if (\$this->getVendor() == self::MYSQL) {\n";
$str.="								\$sqlLooping .= \" `\" . \$systemCheck . \"` = CASE `" . $data[0]['database'] . "`.`\".\$this->model->getTableName().\"`.`\" . \$this->model->getPrimaryKeyName() . \"`\"; \n";
$str.="							} else if (\$this->getVendor() == self::MSSQL) {\n";
$str.="								\$sqlLooping .= \"  [\" . \$systemCheck . \"] = CASE [" . $data[0]['database'] . "].[\".\$this->model->getTableName().\"].[\" . \$this->model->getPrimaryKeyName() . \"]\"; \n";
$str.="							} else if (\$this->getVendor() == self::ORACLE) {\n";
$str.="								\$sqlLooping .= \"	\" . strtoupper(\$systemCheck) . \" = CASE " . $data[0]['database'] . ".\" . strtoupper(\$this->model->getTableName()).strtoupper(\$this->model->getPrimaryKeyName()) . \" \"; \n";
$str.="							} else if (\$this->getVendor() == self::DB2) {\n";
$str.="								\$sqlLooping .= \"	\" . strtoupper(\$systemCheck) . \" = CASE " . $data[0]['database'] . ".\" . strtoupper(\$this->model->getTableName()).strtoupper(\$this->model->getPrimaryKeyName()) . \" \"; \n";
$str.="							} else if (\$this->getVendor() == self::POSTGRESS) {\n";
$str.="								\$sqlLooping .= \"	\" . strtoupper(\$systemCheck) . \" = CASE " . $data[0]['database'] . ".\" . strtoupper(\$this->model->getTableName()).strtoupper(\$this->model->getPrimaryKeyName()) . \" \"; \n";
$str.="							} else {\n";
$str.="								echo json_encode(array(\"success\" => false, \"message\" => \$this->systemString->getNonSupportedDatabase()));\n";
$str.="								exit();\n";
$str.="							}\n";
$str.="							\$sqlLooping .= \"\n";
$str.="							WHEN '\" . \$this->model->get".ucfirst($data[0]['tableName']."Id")."(\$i, 'array') . \"'\n";
$str.="							THEN '\" . \$this->model->getIsDelete(\$i, 'array') . \"'\";\n";
$str.="							\$sqlLooping .= \" END,\";\n";
$str.="							if(!\$this->getIsAdmin()){\n";
$str.="								foreach (\$accessClear as \$clear){\n";
$str.="									// update delete status = 1\n";
$str.="									if (\$this->getVendor() == self::MYSQL) {\n";
$str.="										\$sqlLooping .= \" `\" . \$clear . \"` = CASE `\" . \$this->model->getPrimaryKeyName() . \"`\"; \n";
$str.="									} else if (\$this->getVendor() == self::MSSQL) {\n";
$str.="										\$sqlLooping .= \"  [\" . \$clear. \"] = CASE [\" . \$this->model->getPrimaryKeyName() . \"]\"; \n";
$str.="									} else if (\$this->getVendor() == self::ORACLE) {\n";
$str.="										\$sqlLooping .= \"	\" . \$clear . \" = CASE \" . strtoupper(\$this->model->getPrimaryKeyName()) . \" \"; \n";
$str.="									} else if (\$this->getVendor() == self::DB2) {\n";
$str.="										\$sqlLooping .= \"	\" . \$clear . \" = CASE \" . strtoupper(\$this->model->getPrimaryKeyName()) . \" \"; \n";
$str.="									} else if (\$this->getVendor() == self::POSTGRESS) {\n";
$str.="										\$sqlLooping .= \"	\" .\$clear . \" = CASE \" . strtoupper(\$this->model->getPrimaryKeyName()) . \" \"; \n";
$str.="									} else {\n";
$str.="										echo json_encode(array(\"success\" => false, \"message\" => \$this->systemString->getNonSupportedDatabase())); \n";
$str.="										exit();\n";
$str.="									}\n";
$str.="									\$sqlLooping .= \"\n";
$str.="							WHEN '\" . \$this->model->get".ucfirst($data[0]['tableName']."Id")."(\$i, 'array') . \"'\n";
$str.="							THEN '0'\";\n";
$str.="									\$sqlLooping .= \" END,\";\n";
$str.="								} \n";
									
$str.="							} \n";
$str.="						} \n";
$str.="					} \n";
$str.="					break; \n";
$str.="				case 'isActive' :\n";
$str.="					for (\$i = 0; \$i < \$loop; \$i++) {\n";
$str.="						if (strlen(\$this->model->getIsActive(\$i, 'array')) > 0) {\n";
$str.="							if (\$this->getVendor() == self::MYSQL) {\n";
$str.="								\$sqlLooping .= \" `\" . \$systemCheck . \"` = CASE `" . $data[0]['database'] . "`.`\".\$this->model->getTableName().\"`.`\" . \$this->model->getPrimaryKeyName() . \"`\"; \n";
$str.="							} else if (\$this->getVendor() == self::MSSQL) {\n";
$str.="								\$sqlLooping .= \"  [\" . \$systemCheck . \"] = CASE [" . $data[0]['database'] . "].[\".\$this->model->getTableName().\"].[\" . \$this->model->getPrimaryKeyName() . \"]\"; \n";
$str.="							} else if (\$this->getVendor() == self::ORACLE) {\n";
$str.="								\$sqlLooping .= \"	\" . strtoupper(\$systemCheck) . \" = CASE " . $data[0]['database'] . ".\" . strtoupper(\$this->model->getTableName()).strtoupper(\$this->model->getPrimaryKeyName()) . \" \"; \n";
$str.="							} else if (\$this->getVendor() == self::DB2) {\n";
$str.="								\$sqlLooping .= \"	\" . strtoupper(\$systemCheck) . \" = CASE " . $data[0]['database'] . ".\" . strtoupper(\$this->model->getTableName()).strtoupper(\$this->model->getPrimaryKeyName()) . \" \"; \n";
$str.="							} else if (\$this->getVendor() == self::POSTGRESS) {\n";
$str.="								\$sqlLooping .= \"	\" . strtoupper(\$systemCheck) . \" = CASE " . $data[0]['database'] . ".\" . strtoupper(\$this->model->getTableName()).strtoupper(\$this->model->getPrimaryKeyName()) . \" \"; \n";
$str.="							} else {\n";
$str.="								echo json_encode(array(\"success\" => false, \"message\" => \$this->systemString->getNonSupportedDatabase()));\n";
$str.="								exit();\n";
$str.="							}\n";
$str.="							\$sqlLooping .= \"\n";
$str.="							WHEN '\" . \$this->model->get".ucfirst($data[0]['tableName']."Id")."(\$i, 'array') . \"'\n";
$str.="							THEN '\" . \$this->model->getIsActive(\$i, 'array') . \"'\";\n";
$str.="							\$sqlLooping .= \" END,\";\n";
$str.="						}\n";
$str.="					}\n";
$str.="					break;\n";
$str.="				case 'isApproved' :\n";
$str.="					for (\$i = 0; \$i < \$loop; \$i++) {\n";
$str.="						if (strlen(\$this->model->getIsApproved(\$i, 'array')) > 0) {\n";
$str.="							if (\$this->getVendor() == self::MYSQL) {\n";
$str.="								\$sqlLooping .= \" `\" . \$systemCheck . \"` = CASE `" . $data[0]['database'] . "`.`\".\$this->model->getTableName().\"`.`\" . \$this->model->getPrimaryKeyName() . \"`\"; \n";
$str.="							} else if (\$this->getVendor() == self::MSSQL) {\n";
$str.="								\$sqlLooping .= \"  [\" . \$systemCheck . \"] = CASE [" . $data[0]['database'] . "].[\".\$this->model->getTableName().\"].[\" . \$this->model->getPrimaryKeyName() . \"]\"; \n";
$str.="							} else if (\$this->getVendor() == self::ORACLE) {\n";
$str.="								\$sqlLooping .= \"	\" . strtoupper(\$systemCheck) . \" = CASE " . $data[0]['database'] . ".\" . strtoupper(\$this->model->getTableName()).strtoupper(\$this->model->getPrimaryKeyName()) . \" \"; \n";
$str.="							} else if (\$this->getVendor() == self::DB2) {\n";
$str.="								\$sqlLooping .= \"	\" . strtoupper(\$systemCheck) . \" = CASE " . $data[0]['database'] . ".\" . strtoupper(\$this->model->getTableName()).strtoupper(\$this->model->getPrimaryKeyName()) . \" \"; \n";
$str.="							} else if (\$this->getVendor() == self::POSTGRESS) {\n";
$str.="								\$sqlLooping .= \"	\" . strtoupper(\$systemCheck) . \" = CASE " . $data[0]['database'] . ".\" . strtoupper(\$this->model->getTableName()).strtoupper(\$this->model->getPrimaryKeyName()) . \" \"; \n";
$str.="							} else {\n";
$str.="								echo json_encode(array(\"success\" => false, \"message\" => \$this->systemString->getNonSupportedDatabase())); \n";
$str.="								exit();\n";
$str.="							}\n";
$str.="							\$sqlLooping .= \"\n";
$str.="							WHEN '\" . \$this->model->get".ucfirst($data[0]['tableName']."Id")."(\$i, 'array') . \"'\n";
$str.="							THEN '\" . \$this->model->getIsApproved(\$i, 'array') . \"'\";\n";
$str.="							\$sqlLooping .= \" END,\";\n";
$str.="						}\n";
$str.="					}\n";
$str.="					break;\n";
$str.="				case 'isReview' :\n";
$str.="					for (\$i = 0; \$i < \$loop; \$i++) {\n";
$str.="						if (strlen(\$this->model->getIsReview(\$i, 'array')) > 0) {\n";
$str.="							if (\$this->getVendor() == self::MYSQL) {\n";
$str.="								\$sqlLooping .= \" `\" . \$systemCheck . \"` = CASE `" . $data[0]['database'] . "`.`\".\$this->model->getTableName().\"`.`\" . \$this->model->getPrimaryKeyName() . \"`\"; \n";
$str.="							} else if (\$this->getVendor() == self::MSSQL) {\n";
$str.="								\$sqlLooping .= \"  [\" . \$systemCheck . \"] = CASE [" . $data[0]['database'] . "].[\".\$this->model->getTableName().\"].[\" . \$this->model->getPrimaryKeyName() . \"]\"; \n";
$str.="							} else if (\$this->getVendor() == self::ORACLE) {\n";
$str.="								\$sqlLooping .= \"	\" . strtoupper(\$systemCheck) . \" = CASE " . $data[0]['database'] . ".\" . strtoupper(\$this->model->getTableName()).strtoupper(\$this->model->getPrimaryKeyName()) . \" \"; \n";
$str.="							} else if (\$this->getVendor() == self::DB2) {\n";
$str.="								\$sqlLooping .= \"	\" . strtoupper(\$systemCheck) . \" = CASE " . $data[0]['database'] . ".\" . strtoupper(\$this->model->getTableName()).strtoupper(\$this->model->getPrimaryKeyName()) . \" \"; \n";
$str.="							} else if (\$this->getVendor() == self::POSTGRESS) {\n";
$str.="								\$sqlLooping .= \"	\" . strtoupper(\$systemCheck) . \" = CASE " . $data[0]['database'] . ".\" . strtoupper(\$this->model->getTableName()).strtoupper(\$this->model->getPrimaryKeyName()) . \" \"; \n";
$str.="							} else {\n";
$str.="								echo json_encode(array(\"success\" => false, \"message\" => \$this->systemString->getNonSupportedDatabase()));\n";
$str.="								exit();\n";
$str.="							}\n";
$str.="							\$sqlLooping .= \"\n";
$str.="                            WHEN '\" . \$this->model->get".ucfirst($data[0]['tableName']."Id")."(\$i, 'array') . \"'\n";
$str.="                            THEN '\" . \$this->model->getIsReview(\$i, 'array') . \"'\";\n";
$str.="							\$sqlLooping .= \" END,\";\n";
$str.="						}\n";
$str.="					}\n";
$str.="					break;\n";
$str.="				case 'isPost' :\n";
$str.="					for (\$i = 0; \$i < \$loop; \$i++) {\n";
$str.="						if (strlen(\$this->model->getIsPost(\$i, 'array')) > 0) {\n";
$str.="							if (\$this->getVendor() == self::MYSQL) {\n";
$str.="								\$sqlLooping .= \" `\" . \$systemCheck . \"` = CASE `" . $data[0]['database'] . "`.`\".\$this->model->getTableName().\"`.`\" . \$this->model->getPrimaryKeyName() . \"`\"; \n";
$str.="							} else if (\$this->getVendor() == self::MSSQL) {\n";
$str.="								\$sqlLooping .= \"  [\" . \$systemCheck . \"] = CASE [" . $data[0]['database'] . "].[\".\$this->model->getTableName().\"].[\" . \$this->model->getPrimaryKeyName() . \"]\"; \n";
$str.="							} else if (\$this->getVendor() == self::ORACLE) {\n";
$str.="								\$sqlLooping .= \"	\" . strtoupper(\$systemCheck) . \" = CASE " . $data[0]['database'] . ".\" . strtoupper(\$this->model->getTableName()).strtoupper(\$this->model->getPrimaryKeyName()) . \" \"; \n";
$str.="							} else if (\$this->getVendor() == self::DB2) {\n";
$str.="								\$sqlLooping .= \"	\" . strtoupper(\$systemCheck) . \" = CASE " . $data[0]['database'] . ".\" . strtoupper(\$this->model->getTableName()).strtoupper(\$this->model->getPrimaryKeyName()) . \" \"; \n";
$str.="							} else if (\$this->getVendor() == self::POSTGRESS) {\n";
$str.="								\$sqlLooping .= \"	\" . strtoupper(\$systemCheck) . \" = CASE " . $data[0]['database'] . ".\" . strtoupper(\$this->model->getTableName()).strtoupper(\$this->model->getPrimaryKeyName()) . \" \"; \n";
$str.="							} else {\n";
$str.="								echo json_encode(array(\"success\" => false, \"message\" => \$this->systemString->getNonSupportedDatabase()));\n";
$str.="								exit();\n";
$str.="							}\n";
$str.="							\$sqlLooping .= \"\n";
$str.="                               WHEN '\" . \$this->model->get".ucfirst($data[0]['tableName']."Id")."(\$i, 'array') . \"'\n";
$str.="                                THEN '\" . \$this->model->getIsPost(\$i, 'array') . \"'\";\n";
$str.="							\$sqlLooping .= \" END,\";\n";
$str.="						} \n";
$str.="					} \n";
$str.="					break; \n";
$str.="			} \n";
$str.="		} \n";
$str.="		 \$sql .= substr(\$sqlLooping, 0, - 1);\n";
$str.="		if (\$this->getVendor() == self::MYSQL) {\n";
$str.="			\$sql .= \" \n";
$str.="			WHERE `\" . \$this->model->getPrimaryKeyName() . \"` IN (\" . \$this->model->getPrimaryKeyAll() . \")\"; \n";
$str.="		} else if (\$this->getVendor() == self::MSSQL) {\n";
$str.="			\$sql .= \" \n";
$str.="			WHERE [\" . \$this->model->getPrimaryKeyName() . \"] IN (\" . \$this->model->getPrimaryKeyAll() . \")\"; \n";
$str.="		} else if (\$this->getVendor() == self::ORACLE) {\n";
$str.="			\$sql .= \" \n";
$str.="			WHERE \" . strtoupper(\$this->model->getPrimaryKeyName()) . \"  IN (\" . \$this->model->getPrimaryKeyAll() . \")\"; \n";
$str.="		} else if (\$this->getVendor() == self::DB2) {\n";
$str.="			\$sql .= \" \n";
$str.="			WHERE \" . strtoupper(\$this->model->getPrimaryKeyName()) . \"  IN (\" . \$this->model->getPrimaryKeyAll() . \")\"; \n";
$str.="		} else if (\$this->getVendor() == self::POSTGRESS) {\n";
$str.="			\$sql .= \" \n";
$str.="			WHERE \" . strtoupper(\$this->model->getPrimaryKeyName()) . \"  IN (\" . \$this->model->getPrimaryKeyAll() . \")\"; \n";
$str.="		} else { \n";
$str.="			echo json_encode(array(\"success\" => false, \"message\" => \$this->systemString->getNonSupportedDatabase())); \n";
$str.="			exit(); \n";
$str.="		} \n";
$str.="		\$this->q->update(\$sql); \n";
$str.="		if (\$this->q->execute == 'fail') { \n";
$str.="			echo json_encode(array(\"success\" => false, \"message\" => \$this->q->responce)); \n";
$str.="			exit(); \n";
$str.="		} \n";
$str.="		\$this->q->commit(); \n";
$str.="		if (\$this->getIsAdmin()) { \n";
$str.="			\$message = \$this->systemString->getUpdateMessage(); \n";
$str.="		} else {\n";
$str.="			\$message = \$this->systemString->getDeleteMessage(); \n";
$str.="		} \n";
$str.="		\$end = microtime(true); \n";
$str.="		\$time = \$end - \$start; \n";
$str.="		echo json_encode( \n";
$str.="		array(	\"success\" => true, \n";
$str.="						\"message\" => \$message, \n";
$str.="						\"time\"=>\$time) \n";
$str.="		); \n";
$str.="		exit(); \n";
$str.="	} \n";

$str.="	/** \n";
$str.="	 * To check if a key duplicate or not \n";
$str.="	 */ \n";
$str.="	function duplicate() {\n";
$str.="		header('Content-Type:application/json; charset=utf-8'); \n";
$str.="		\$start = microtime(true);\n";
$str.="		if (\$this->getVendor() == self::MYSQL) { \n";
$str.="			\$sql = \"SET NAMES utf8\"; \n";
$str.="			\$this->q->fast(\$sql); \n";
$str.="		} \n";
$str.="		if (\$this->getVendor() == self::MYSQL) { \n";
$str.="			\$sql = \" \n";
$str.="			SELECT	`" . $data[0]['tableName'] . "Code` \n";
$str.="			FROM 	`" . $data[0]['database'] . "`.`" . $data[0]['tableName'] . "` \n";
$str.="			WHERE 	`".$data[0]['tableName']."` 	= 	'\" . \$this->model->get" . ucfirst($data[0]['tableName']) . "Code() . \"' \n";
$str.="			AND		`isActive`				=	1\"; \n";
$str.="		} else if (\$this->getVendor() == self::MSSQL) { \n";
$str.="			\$sql = \" \n";
$str.="			SELECT	[referenceNo] \n";
$str.="			FROM 	[" . $data[0]['database'] . "].[" . $data[0]['tableName'] . "] \n";
$str.="			WHERE 	[".$data[0]['tableName']."] 	= 	'\" . \$this->model->get" . ucfirst($data[0]['tableName']) . "Code() . \"' \n";
$str.="			AND		[isActive]				=	1\"; \n";
$str.="		} else if (\$this->getVendor() == self::ORACLE) { \n";
$str.="			\$sql = \" \n";
$str.="			SELECT	".strtoupper('referenceNo')." \n";
$str.="			FROM 	".strtoupper($data[0]['tableName'])." \n";
$str.="			WHERE 	".strtoupper($data[0]['tableName'])."	= 	'\" . \$this->model->get" . ucfirst($data[0]['tableName']) . "Code() . \"' \n";
$str.="			AND		ISACTIVE			=	1\"; \n";
$str.="		} \n";
$str.="		\$this->q->read(\$sql); \n";
$str.="		\$total = 0; \n";
$str.="		\$total = \$this->q->numberRows(); \n";
$str.="		if (\$this->q->execute == 'fail') { \n";
$str.="			echo json_encode(array(\"success\" => false, \"message\" => \$this->q->responce)); \n";
$str.="			exit(); \n";
$str.="		} \n";
$str.="		if (\$total > 0) { \n";
$str.="			\$row = \$this->q->fetchArray(); \n";
$str.="			\$end = microtime(true); \n";
$str.="			\$time = \$end - \$start; \n";
$str.="			echo json_encode(\n";
$str.="			array(	\"success\" =>true, \n";
$str.="						\"total\" => \$total, \n";
$str.="				 		\"message\" => \$this->systemString->getDuplicateMessage(),  \n";
$str.="				 		\"referenceNo\" => \$row ['referenceNo'], \n";
$str.="						\"time\"=>\$time)); \n";
$str.="			exit(); \n";
$str.="		} else { \n";
$str.="			\$end = microtime(true); \n";
$str.="			\$time = \$end - \$start; \n";
$str.="			echo json_encode( \n";
$str.="			array(	\"success\" => true, \n";
$str.="						\"total\" => \$total,  \n";
$str.="						\"message\" => \$this->systemString->getNonDuplicateMessage(), \n";
$str.="						\"time\"=>\$time)); \n";
$str.="			exit(); \n";
$str.="		} \n";
$str.="	} \n";

$str.="	function firstRecord(\$value) { \n";
$str.="		return \$this->recordSet->firstRecord(\$value); \n";
$str.="	} \n";

$str.="	function nextRecord(\$value, \$primaryKeyValue) { \n";
$str.="		return \$this->recordSet->nextRecord(\$value, \$primaryKeyValue); \n";
$str.="	} \n";

$str.="	function previousRecord(\$value, \$primaryKeyValue) { \n";
$str.="		return \$this->recordSet->previousRecord(\$value, \$primaryKeyValue); \n";
$str.="	} \n";

$str.="	function lastRecord(\$value) { \n";
$str.="		return \$this->recordSet->lastRecord(\$value); \n";
$str.="	} \n";

$str.="	/* (non-PHPdoc) \n";
$str.="	 * @see config::excel() \n";
$str.="	 */\n";

$str.="	function excel() { \n";
$str.="		header('Content-Type:application/json; charset=utf-8'); \n";
$str.="		\$start = microtime(true); \n";
$str.="		if (\$this->getVendor() == self::MYSQL) { \n";
$str.="			\$sql = \"SET NAMES utf8\"; \n";
$str.="			\$this->q->fast(\$sql); \n";
$str.="		} \n";
$str.="		if (\$_SESSION ['start'] == 0) { \n";
$str.="			\$sql = str_replace(\"LIMIT\", \"\", \$_SESSION ['sql']); \n";
$str.="			\$sql = str_replace(\$_SESSION ['start'] . \",\" . \$_SESSION ['limit'], \"\", \$sql); \n";
$str.="		} else { \n";
$str.="			\$sql = \$_SESSION ['sql']; \n";
$str.="		} \n";
$str.="		\$this->q->read(\$sql); \n";
$str.="		if (\$this->q->execute == 'fail') { \n";
$str.="			echo json_encode(array(\"success\" => false, \"message\" => \$this->q->responce)); \n";
$str.="			exit(); \n";
$str.="		} \n";
$str.="		\$this->excel->setActiveSheetIndex(0); \n";
$str.="		// check file exist or not and return response \n";
$str.="		\$styleThinBlackBorderOutline = array('borders' => array('inside' => array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '000000')), 'outline' => array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '000000')))); \n";
$str.="		// header all using  3 line  starting b \n";
$str.="		\$this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(TRUE); \n";
$str.="		\$this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(TRUE); \n";
$str.="		\$this->excel->getActiveSheet()->setCellValue('B2', \$this->title); \n";
$str.="		\$this->excel->getActiveSheet()->setCellValue('C2', ''); \n";
$str.="		\$this->excel->getActiveSheet()->mergeCells('B2:C2'); \n";
$str.="		\$this->excel->getActiveSheet()->setCellValue('B3', 'No'); \n";
$str.="		\$this->excel->getActiveSheet()->setCellValue('C3', 'Penerangan'); \n";
$str.="		\$this->excel->getActiveSheet()->getStyle('B2:C2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID); \n";
$str.="		\$this->excel->getActiveSheet()->getStyle('B2:C2')->getFill()->getStartColor()->setARGB('66BBFF'); \n";
$str.="		\$this->excel->getActiveSheet()->getStyle('B3:C3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID); \n";
$str.="		\$this->excel->getActiveSheet()->getStyle('B3:C3')->getFill()->getStartColor()->setARGB('66BBFF'); \n";
$str.="		// \n";
$str.="		\$loopRow = 4; \n";
$str.="		\$i = 0; \n";
$str.="		while ((\$row = \$this->q->fetchAssoc()) == TRUE) { \n";
$str.="			//	echo print_r(\$row); \n";
$str.="			\$this->excel->getActiveSheet()->setCellValue('B' . \$loopRow, ++\$i); \n";
$str.="			\$this->excel->getActiveSheet()->setCellValue('C' . \$loopRow, 'a' . \$row ['religionDetailSampleDesc']); \n";
$str.="			\$loopRow++; \n";
$str.="			\$lastRow = 'C' . \$loopRow; \n";
$str.="		} \n";
$str.="		\$from = 'B2'; \n";
$str.="		\$to = \$lastRow; \n";
$str.="		\$formula = \$from . \":\" . \$to;\n";
$str.="		\$this->excel->getActiveSheet()->getStyle(\$formula)->applyFromArray(\$styleThinBlackBorderOutline);\n";
$str.="		\$objWriter = PHPExcel_IOFactory::createWriter(\$this->excel, 'Excel2007');\n";
$str.="		\$filename = \"" . $data[0]['tableName'] . "\" . rand(0, 10000000) . \".xlsx\";\n";
$str.="		\$path = \$_SERVER ['DOCUMENT_ROOT'] . \"/\" . \$this->application . \"/basic/document/excel/\" . \$filename;\n";
$str.="		\$this->documentTrail->create_trail(\$this->leafId, \$path, \$filename);\n";
$str.="		\$objWriter->save(\$path);\n";
$str.="		\$file = fopen(\$path, 'r');\n";
$str.="		if (\$file) { \n";
$str.="			\$end = microtime(true);\n";
$str.="			\$time = \$end - \$start;\n";
$str.="			echo json_encode(\n";
$str.="			array(	\"success\" => true, \n";
$str.="						\"message\" => \$this->systemString->getFileGenerateMessage(), \n";
$str.="						\"filename\" => \$filename,\n";
$str.="						\"time\"=>\$time));\n";
$str.="			exit(); \n";
$str.="		} else { \n";
$str.="			\$end = microtime(true);\n";
$str.="			\$time = \$end - \$start;\n";
$str.="			echo json_encode(\n";
$str.="			array(	\"success\" => false,\n";
$str.="						\"message\" => \$this->systemString->getFileNotGenerateMessage(),\n";
$str.="						\"time\"=>\$time));\n";
$str.="			exit(); \n";
$str.="		} \n";
$str.="	} \n";

$str.="} \n";

$str.="\$" . $data[0]['tableName'] . "Object = new ".ucfirst($data[0]['tableName'])."Class (); \n";
$str.="/** \n";
$str.=" * crud -create,read,update,delete \n";
$str.="* */ \n";
$str.="if (isset(\$_POST ['method'])) { \n";
$str.="	/* \n";
$str.="	 *  Initilize Value before load in the loader \n";
$str.="	 */ \n";
$str.="	if (isset(\$_POST ['leafId'])) { \n";
$str.="		\$" . $data[0]['tableName'] . "Object->setLeafId(\$_POST ['leafId']); \n";
$str.="	} \n";
$str.="	/* \n";
$str.="	 * Admin Only\n";
$str.="	 */ \n";
$str.="	if (isset(\$_POST ['isAdmin'])) { \n";
$str.="		\$" . $data[0]['tableName'] . "Object->setIsAdmin(\$_POST ['isAdmin']); \n";
$str.="	} \n";
$str.="	/** \n";
$str.="	 * Database Request \n";
$str.="	 */ \n";
$str.="	if (isset(\$_POST ['databaseRequest'])) { \n";
$str.="		\$" . $data[0]['tableName'] . "Object->setRequestDatabase(\$_POST ['databaseRequest']); \n";
$str.="	} \n";
$str.="	/* \n";
$str.="	 *  Paging\n";
$str.="	 */ \n";
$str.="	if (isset(\$_POST ['start'])) { \n";
$str.="		\$" . $data[0]['tableName'] . "Object->setStart(\$_POST ['start']); \n";
$str.="	} \n";
$str.="	if (isset(\$_POST ['perPage'])) { \n";
$str.="		\$" . $data[0]['tableName'] . "Object->setLimit(\$_POST ['perPage']); \n";
$str.="	} \n";
$str.="	/* \n";
$str.="	 *  Filtering\n";
$str.="	 */ \n";
$str.="	if (isset(\$_POST ['query'])) { \n";
$str.="		\$" . $data[0]['tableName'] . "Object->setFieldQuery(\$_POST ['query']); \n";
$str.="	} \n";
$str.="	if (isset(\$_POST ['filter'])) { \n";
$str.="		\$" . $data[0]['tableName'] . "Object->setGridQuery(\$_POST ['filter']); \n";
$str.="	} \n";
$str.="	if (isset(\$_POST ['character'])) { \n";
$str.="		\$" . $data[0]['tableName'] . "Object->setCharacterQuery(\$_POST['character']); \n";
$str.="	} \n";
$str.="	if (isset(\$_POST ['dateRangeStart'])) { \n";
$str.="		\$" . $data[0]['tableName'] . "Object->setDateRangeStartQuery(\$_POST['dateRangeStart']); \n";
$str.="		//explode the data to get day,month,year \n";
$str.="		\$start=explode(\"-\",\$_POST ['dateRangeStart']); \n";
$str.="		\$" . $data[0]['tableName'] . "Object->setStartDay(\$start[2]); \n";
$str.="		\$" . $data[0]['tableName'] . "Object->setStartMonth(\$start[1]); \n";
$str.="		\$" . $data[0]['tableName'] . "Object->setStartYear(\$start[0]); \n";
$str.="	} \n";
$str.="	if (isset(\$_POST ['dateRangeEnd'])) { \n";
$str.="		\$" . $data[0]['tableName'] . "Object->setDateRangeEndQuery(\$_POST['dateRangeEnd']); \n";
$str.="		//explode the data to get day,month,year \n";
$str.="		\$start=explode(\"-\",\$_POST ['dateRangeEnd']); \n";
$str.="		\$" . $data[0]['tableName'] . "Object->setEndDay(\$start[2]); \n";
$str.="		\$" . $data[0]['tableName'] . "Object->setEndMonth(\$start[1]); \n";
$str.="		\$" . $data[0]['tableName'] . "Object->setEndYear(\$start[0]); \n";
$str.="	} \n";
$str.="	if (isset(\$_POST ['dateRangeType'])) { \n";
$str.="		\$" . $data[0]['tableName'] . "Object->setDateRangeTypeQuery(\$_POST['dateRangeType']); \n";
$str.="	} \n";
$str.="	if (isset(\$_POST ['dateRangeExtraType'])) { \n";
$str.="		\$" . $data[0]['tableName'] . "Object->setDateRangeExtraTypeQuery(\$_POST['dateRangeExtraType']); \n";
$str.="	} \n";
$str.="	/* \n";
$str.="	 * Ordering \n";
$str.="	 */ \n";
$str.="	if (isset(\$_POST ['order'])) { \n";
$str.="		\$" . $data[0]['tableName'] . "Object->setOrder(\$_POST ['order']); \n";
$str.="	} \n";
$str.="	if (isset(\$_POST ['sortField'])) { \n";
$str.="		\$" . $data[0]['tableName'] . "Object->setSortField(\$_POST ['sortField']); \n";
$str.="	} \n";
$str.="    if(isset(\$_POST['output'])) {  \n";
$str.="	/* \n";
$str.="	 *  Load the dynamic value \n";
$str.="	 */ \n";
$str.="	\$" . $data[0]['tableName'] . "Object ->setPageOutput('json');  \n";
$str.="	\$" . $data[0]['tableName'] . "Object->execute(); \n";
$str.="	/* \n";
$str.="	 *  Crud Operation (Create Read Update Delete/Destory) \n";
$str.="	 */ \n";
$str.="	if (\$_POST ['method'] == 'create') { \n";
$str.="		\$" . $data[0]['tableName'] . "Object->create(); \n";
$str.="	} \n";
$str.="	if (\$_POST ['method'] == 'save') { \n";
$str.="		\$" . $data[0]['tableName'] . "Object->update(); \n";
$str.="	} \n";
$str.="	if (\$_POST ['method'] == 'read') { \n";
$str.="		\$" . $data[0]['tableName'] . "Object->read(); \n";
$str.="	} \n";
$str.="	if (\$_POST ['method'] == 'delete') { \n";
$str.="		\$" . $data[0]['tableName'] . "Object->delete(); \n";
$str.="	} \n";
$str.="	if (\$_POST ['method'] == 'posting') { \n";
$str.="	//	\$" . $data[0]['tableName'] . "Object->posting(); \n";
$str.="	} \n";
$str.="	if (\$_POST ['method'] == 'reverse') { \n";
$str.="	//	\$" . $data[0]['tableName'] . "Object->delete(); \n";
$str.="	} \n";
$str.="} } \n";
$str.="if (isset(\$_GET ['method'])) {\n";
$str.="	/* \n";
$str.="	 *  Initilize Value before load in the loader\n";
$str.="	 */ \n";
$str.="	if (isset(\$_GET ['leafId'])) {\n";
$str.="		\$" . $data[0]['tableName'] . "Object->setLeafId(\$_GET ['leafId']); \n";
$str.="	} \n";
$str.="	/* \n";
$str.="	 * Admin Only\n";
$str.="	 */ \n";
$str.="	if (isset(\$_GET ['isAdmin'])) {\n";
$str.="		\$" . $data[0]['tableName'] . "Object->setIsAdmin(\$_GET ['isAdmin']); \n";
$str.="	} \n";
$str.="	/** \n";
$str.="	 * Database Request\n";
$str.="	 */ \n";
$str.="	if (isset(\$_GET ['databaseRequest'])) {\n";
$str.="		\$" . $data[0]['tableName'] . "Object->setRequestDatabase(\$_GET ['databaseRequest']); \n";
$str.="	} \n";
$str.="	/* \n";
$str.="	 *  Load the dynamic value\n";
$str.="	 */ \n";
$str.="	\$" . $data[0]['tableName'] . "Object->execute(); \n";
$str.="	if (isset(\$_GET ['field'])) {\n";
$str.="		if (\$_GET ['field'] == 'staffId') {\n";
$str.="			\$" . $data[0]['tableName'] . "Object->staff(); \n";
$str.="		} \n";
$str.="	} \n";
$str.="	/*\n";
$str.="	 * Update Status of The Table. Admin Level Only \n";
$str.="	 */\n";
$str.="	if (\$_GET ['method'] == 'updateStatus') { \n";
$str.="		\$" . $data[0]['tableName'] . "Object->updateStatus(); \n";
$str.="	} \n";
$str.="	/* \n";
$str.="	 *  Checking Any Duplication  Key \n";
$str.="	 */ \n";
$str.="	if (isset(\$_GET ['religionDetailSampleDesc'])) { \n";
$str.="		if (strlen(\$_GET ['religionDetailSampleDesc']) > 0) { \n";
$str.="			\$" . $data[0]['tableName'] . "Object->duplicate(); \n";
$str.="		} \n";
$str.="	} \n";
$str.="	if (\$_GET ['method'] == 'dataNavigationRequest') { \n";
$str.="		if (\$_GET ['dataNavigation'] == 'firstRecord') { \n";
$str.="			\$" . $data[0]['tableName'] . "Object->firstRecord('json'); \n";
$str.="		} \n";
$str.="		if (\$_GET ['dataNavigation'] == 'previousRecord') { \n";
$str.="			\$" . $data[0]['tableName'] . "Object->previousRecord('json', 0); \n";
$str.="		} \n";
$str.="		if (\$_GET ['dataNavigation'] == 'nextRecord') {\n";
$str.="			\$" . $data[0]['tableName'] . "Object->nextRecord('json', 0); \n";
$str.="		} \n";
$str.="		if (\$_GET ['dataNavigation'] == 'lastRecord') {\n";
$str.="			\$" . $data[0]['tableName'] . "Object->lastRecord('json'); \n";
$str.="		} \n";
$str.="	} \n";
$str.="	/* \n";
$str.="	 * Excel Reporting  \n";
$str.="	 */ \n";
$str.="	if (isset(\$_GET ['mode'])) { \n";
$str.="		if (\$_GET ['mode'] == 'excel') { \n";
$str.="			\$" . $data[0]['tableName'] . "Object->excel(); \n";
$str.="		} \n";
$str.="	} \n";
$str.="} \n";
$str.="?>";
?>