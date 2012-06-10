<?php

namespace Core\System\Common\Race\Controller;

if (!isset($_SESSION)) {
    session_start();
}
require_once ("../../../../library/class/classAbstract.php");
require_once ("../../../../library/class/classRecordSet.php");
require_once ("../../../../library/class/classDate.php");
require_once ("../../../../library/class/classSystemString.php");
//require_once ("/../../../../class/classDocumentTrail.php"); 
//require_once ("../../document/model/documentModel.php"); 
require_once ("/../model/raceModel.php");

/**
 * this is race setting files.This sample template file for master record 
 * @name IDCMS 
 * @version 2 
 * @author hafizan 
 * @package System 
 * @subpackage Common 
 * @link http://www.idcms.org 
 * @license http://www.gnu.org/copyleft/lesser.html LGPL 
 */
class RaceClass extends \Core\ConfigClass {

    /**
     * Connection to the database 
     * @var string 
     */
    public $q;

    /**
     * Php Excel Generate Microsoft Excel 2007 Output.Format : xlsx 
     * @var string 
     */
    private $excel;

    /**
     * Record Pagination 
     * @var string 
     */
    private $recordSet;

    /**
     * Document Trail Audit. 
     * @var string 
     */
    private $documentTrail;

    /**
     * System String Message. 
     * @var string $systemString; 
     */
    public $systemString;

    /**
     * Audit Row TRUE or False 
     * @var bool 
     */
    private $audit;

    /**
     * Log Sql Statement TRUE or False 
     * @var string 
     */
    private $log;

    /**
     * Model 
     * @var string 
     */
    public $model;

    /**
     * Audit Filter
     * @var string
     */
    public $auditFilter;

    /**
     * Audit Column 
     * @var string 
     */
    public $auditColumn;

    /**
     * Duplicate Testing either the key of table same or have been created. 
     * @var bool
     */
    public $duplicateTest;

    function __construct() {
        $this->setViewPath("./package/system/common/view/race.php");
        $this->setControllerPath("./package/system/common/controller/raceController.php");
        //$this->setServicePath("./package/system/common/service/raceService.php"); 
    }

    /**
     * Class Loader 
     */
    function execute() {
        parent::__construct();
        $this->audit = 0;
        $this->log = 1;
        $this->model = new \Core\System\Common\Race\Model\RaceModel();
        $this->model->setVendor($this->getVendor());
        $this->model->execute();
        if ($this->getVendor() == self::MYSQL) {
            $this->q = new \Core\Database\Mysql\Vendor();
        } else if ($this->getVendor() == self::MSSQL) {
            $this->q = new \Core\Database\Mssql\Vendor();
        } else if ($this->getVendor() == self::ORACLE) {
            $this->q = new \Core\Database\Oracle\Vendor();
        } else if ($this->getVendor() == self::POSTGRESS) {
            $this->q = new \Core\Database\Postgress\Vendor();
        } else if ($this->getVendor() == self ::DB2) {
            $this->q = new \Core\Database\Db2\Vendor();
        }
        $this->q->vendor = $this->getVendor();
        $this->q->setRequestDatabase($this->q->getCoreDatabase());
        $this->q->setCurrentDatabase($this->q->getCommonDatabase());

        $this->q->connect($this->getConnection(), $this->getUsername(), $this->getDatabase(), $this->getPassword());
        $this->systemString = new \Core\SystemString\SystemString();
        $this->systemString->setVendor($this->getVendor());
        $this->systemString->setLeafId($this->getLeafId());
        $this->systemString->execute();
        $this->recordSet = new \Core\Recordset\RecordSet();
        $this->recordSet->setCurrentDatabase($this->q->getCommonDatabase());
        $this->recordSet->setCurrentTable($this->model->getTableName());
        $this->recordSet->setPrimaryKeyName($this->model->getPrimaryKeyName());
        $this->recordSet->execute();
        //    $this->documentTrail = new \Core\Document\Trail; 
        //    $this->documentTrail->setVendor($this->getVendor()); 
        //     $this->documentTrail->setStaffId($this->getStaffId()); 
        //     $this->documentTrail->setLanguageId($this->getLanguageId()); 
        //$this->excel = new PHPExcel (); 
    }

    /* (non-PHPdoc)  
     * @see config::create()  
     */

    public function create() {
        header('Content-Type:application/json; charset=utf-8');
        $start = microtime(true);
        if ($this->getVendor() == self::MYSQL) {
            $sql = "SET NAMES utf8";
            $this->q->fast($sql);
        }
        $this->q->start();
        $this->model->create();
        if ($this->getVendor() == self::MYSQL) {
            $sql = "INSERT INTO `icommon`.`race` ( 
	`raceSequence`,
	`raceCode`,
	`raceDesc`,
	`isDefault`,
	`isNew`,
	`isDraft`,
	`isUpdate`,
	`isDelete`,
	`isActive`,
	`isApproved`,
	`isReview`,
	`isPost`,
	`executeBy`,
	`executeTime`
) VALUES ( 
 '" . $this->model->getRaceSequence() . "',
 '" . $this->model->getRaceCode() . "',
 '" . $this->model->getRaceDesc() . "',
 '" . $this->model->getIsDefault(0, 'single') . "',
 '" . $this->model->getIsNew(0, 'single') . "',
 '" . $this->model->getIsDraft(0, 'single') . "',
 '" . $this->model->getIsUpdate(0, 'single') . "',
 '" . $this->model->getIsDelete(0, 'single') . "',
 '" . $this->model->getIsActive(0, 'single') . "',
 '" . $this->model->getIsApproved(0, 'single') . "',
 '" . $this->model->getIsReview(0, 'single') . "',
 '" . $this->model->getIsPost(0, 'single') . "',
 '" . $this->model->getExecuteBy() . "',
 " . $this->model->getExecuteTime() . "
 );";
        } else if ($this->getVendor() == self::MSSQL) {

            $sql = "INSERT INTO [icommon].[race] (
	[raceId],
	[raceSequence],
	[raceCode],
	[raceDesc],
	[isDefault],
	[isNew],
	[isDraft],
	[isUpdate],
	[isDelete],
	[isActive],
	[isApproved],
	[isReview],
	[isPost],
	[executeBy],
	[executeTime]
) VALUES ( 
 '" . $this->model->getRaceSequence() . "',
 '" . $this->model->getRaceCode() . "',
 '" . $this->model->getRaceDesc() . "',
 '" . $this->model->getIsDefault(0, 'single') . "',
 '" . $this->model->getIsNew(0, 'single') . "',
 '" . $this->model->getIsDraft(0, 'single') . "',
 '" . $this->model->getIsUpdate(0, 'single') . "',
 '" . $this->model->getIsDelete(0, 'single') . "',
 '" . $this->model->getIsActive(0, 'single') . "',
 '" . $this->model->getIsApproved(0, 'single') . "',
 '" . $this->model->getIsReview(0, 'single') . "',
 '" . $this->model->getIsPost(0, 'single') . "',
 '" . $this->model->getExecuteBy() . "',
 " . $this->model->getExecuteTime() . "
 );";
        } else if ($this->getVendor() == self::ORACLE) {

            $sql = "INSERT INTO 	RACE ( 
	RACESEQUENCE,
	RACECODE,
	RACEDESC,
	ISDEFAULT,
	ISNEW,
	ISDRAFT,
	ISUPDATE,
	ISDELETE,
	ISACTIVE,
	ISAPPROVED,
	ISREVIEW,
	ISPOST,
	EXECUTEBY,
	EXECUTETIME
) VALUES ( 
 '" . $this->model->getRaceSequence() . "',
 '" . $this->model->getRaceCode() . "',
 '" . $this->model->getRaceDesc() . "',
 '" . $this->model->getIsDefault(0, 'single') . "',
 '" . $this->model->getIsNew(0, 'single') . "',
 '" . $this->model->getIsDraft(0, 'single') . "',
 '" . $this->model->getIsUpdate(0, 'single') . "',
 '" . $this->model->getIsDelete(0, 'single') . "',
 '" . $this->model->getIsActive(0, 'single') . "',
 '" . $this->model->getIsApproved(0, 'single') . "',
 '" . $this->model->getIsReview(0, 'single') . "',
 '" . $this->model->getIsPost(0, 'single') . "',
 '" . $this->model->getExecuteBy() . "',
 " . $this->model->getExecuteTime() . "
 );";
        } else if ($this->getVendor() == self::DB2) {

            $sql = "INSERT INTO 	RACE ( 
	RACESEQUENCE,
	RACECODE,
	RACEDESC,
	ISDEFAULT,
	ISNEW,
	ISDRAFT,
	ISUPDATE,
	ISDELETE,
	ISACTIVE,
	ISAPPROVED,
	ISREVIEW,
	ISPOST,
	EXECUTEBY,
	EXECUTETIME
) VALUES ( 
 '" . $this->model->getRaceSequence() . "',
 '" . $this->model->getRaceCode() . "',
 '" . $this->model->getRaceDesc() . "',
 '" . $this->model->getIsDefault(0, 'single') . "',
 '" . $this->model->getIsNew(0, 'single') . "',
 '" . $this->model->getIsDraft(0, 'single') . "',
 '" . $this->model->getIsUpdate(0, 'single') . "',
 '" . $this->model->getIsDelete(0, 'single') . "',
 '" . $this->model->getIsActive(0, 'single') . "',
 '" . $this->model->getIsApproved(0, 'single') . "',
 '" . $this->model->getIsReview(0, 'single') . "',
 '" . $this->model->getIsPost(0, 'single') . "',
 '" . $this->model->getExecuteBy() . "',
 " . $this->model->getExecuteTime() . "
 );";
        } else if ($this->getVendor() == self::POSTGRESS) {

            $sql = "INSERT INTO 	RACE ( 
	RACESEQUENCE,
	RACECODE,
	RACEDESC,
	ISDEFAULT,
	ISNEW,
	ISDRAFT,
	ISUPDATE,
	ISDELETE,
	ISACTIVE,
	ISAPPROVED,
	ISREVIEW,
	ISPOST,
	EXECUTEBY,
	EXECUTETIME
) VALUES ( 
 '" . $this->model->getRaceSequence() . "',
 '" . $this->model->getRaceCode() . "',
 '" . $this->model->getRaceDesc() . "',
 '" . $this->model->getIsDefault(0, 'single') . "',
 '" . $this->model->getIsNew(0, 'single') . "',
 '" . $this->model->getIsDraft(0, 'single') . "',
 '" . $this->model->getIsUpdate(0, 'single') . "',
 '" . $this->model->getIsDelete(0, 'single') . "',
 '" . $this->model->getIsActive(0, 'single') . "',
 '" . $this->model->getIsApproved(0, 'single') . "',
 '" . $this->model->getIsReview(0, 'single') . "',
 '" . $this->model->getIsPost(0, 'single') . "',
 '" . $this->model->getExecuteBy() . "',
 " . $this->model->getExecuteTime() . "
 );";
        }
        $this->q->create($sql);
        $raceId = $this->q->lastInsertId();
        if ($this->q->execute == 'fail') {
            echo json_encode(array("success" => false, "message" => $this->q->responce));
            exit();
        }
        $this->q->commit();
        $end = microtime(true);
        $time = $end - $start;
        echo json_encode(
                array("success" => true,
                    "message" => $this->systemString->getCreateMessage(),
                    "raceId" => $raceId,
                    "time" => $time));
        exit();
    }

    /* (non-PHPdoc) 
     * @see config::read() 
     */

    public function read() {
        if ($this->getPageOutput() == 'json') {
            header('Content-Type:application/json; charset=utf-8');
        }
        $start = microtime(true);
        if (isset($_SESSION['isAdmin'])) {
            if ($_SESSION['isAdmin'] == 0) {
                if ($this->q->vendor == self::MYSQL) {
                    $this->auditFilter = "	`race`.`isActive`		=	1	";
                } else if ($this->q->vendor == self::MSSQL) {
                    $this->auditFilter = "	[race].[isActive]		=	1	";
                } else if ($this->q->vendor == self::ORACLE) {
                    $this->auditFilter = "	RACE.ISACTIVE	=	1	";
                }
            } else if ($_SESSION['isAdmin'] == 1) {
                if ($this->getVendor() == self::MYSQL) {
                    $this->auditFilter = "	1	=	1	";
                } else if ($this->q->vendor == self::MSSQL) {
                    $this->auditFilter = "	1	=	1 	";
                } else if ($this->q->vendor == self::ORACLE) {
                    $this->auditFilter = "	1	=	1 	";
                }
            }
        }
        if ($this->getVendor() == self::MYSQL) {
            $sql = "SET NAMES utf8";
            $this->q->fast($sql);
        }
        $items = array();
        if ($this->getVendor() == self::MYSQL) {

            $sql = "SELECT`race`.`raceId`,
`race`.`raceSequence`,
`race`.`raceCode`,
`race`.`raceDesc`,
`race`.`isDefault`,
`race`.`isNew`,
`race`.`isDraft`,
`race`.`isUpdate`,
`race`.`isDelete`,
`race`.`isActive`,
`race`.`isApproved`,
`race`.`isReview`,
`race`.`isPost`,
`race`.`executeBy`,
`race`.`executeTime`,
`staff`.`staffName`
			FROM 	`icommon`.`race`
			JOIN	`iCore`.`staff`
			ON		`race`.`executeBy` = `staff`.`staffId`
			WHERE 		" . $this->auditFilter;
            if ($this->model->getRaceId(0, 'single')) {
                $sql .= " AND `" . $this->model->getTableName() . "`.`" . $this->model->getPrimaryKeyName() . "`='" . $this->model->getRaceId(0, 'single') . "'";
            }
        } else if ($this->getVendor() == self::MSSQL) {

            $sql = "SELECT [race].[raceId],
[race].[raceSequence],
[race].[raceCode],
[race].[raceDesc],
[race].[isDefault],
[race].[isNew],
[race].[isDraft],
[race].[isUpdate],
[race].[isDelete],
[race].[isActive],
[race].[isApproved],
[race].[isReview],
[race].[isPost],
[race].[executeBy],
[race].[executeTime],
[staff].[staffName]
			FROM 	[icommon].[race]
			JOIN		[iCore].[staff]
			ON		[race].[executeBy] = [staff].[staffId]
			WHERE 		" . $this->auditFilter;
            if ($this->model->getRaceId(0, 'single')) {
                $sql .= " AND [" . $this->model->getTableName() . "].[" . $this->model->getPrimaryKeyName() . "]		=	'" . $this->model->getRaceId(0, 'single') . "'";
            }
        } else if ($this->getVendor() == self::ORACLE) {

            $sql = "SELECT RACE.RACEID,
 RACE.RACESEQUENCE,
 RACE.RACECODE,
 RACE.RACEDESC,
 RACE.ISDEFAULT,
 RACE.ISNEW,
 RACE.ISDRAFT,
 RACE.ISUPDATE,
 RACE.ISDELETE,
 RACE.ISACTIVE,
 RACE.ISAPPROVED,
 RACE.ISREVIEW,
 RACE.ISPOST,
 RACE.EXECUTEBY,
 RACE.EXECUTETIME,
STAFF.STAFFNAME
			FROM 	RACE 

			JOIN		STAFF 

			ON		RACE.EXECUTEBY = STAFF.STAFFID 

			WHERE 		" . $this->auditFilter;
            if ($this->model->getRaceId(0, 'single')) {
                $sql .= " AND " . strtoupper($this->model->getTableName()) . strtoupper($this->model->getPrimaryKeyName()) . "='" . $this->model->getRaceId(0, 'single') . "'";
            }
        } else if ($this->getVendor() == self::DB2) {
            if ($this->model->getRaceId(0, 'single')) {
                $sql .= " AND " . strtoupper($this->model->getTableName()) . strtoupper($this->model->getPrimaryKeyName()) . "='" . $this->model->getRaceId(0, 'single') . "'";
            }
        } else if ($this->getVendor() == self::POSTGRESS) {
            if ($this->model->getRaceId(0, 'single')) {
                $sql .= " AND " . strtoupper($this->model->getTableName()) . strtoupper($this->model->getPrimaryKeyName()) . "='" . $this->model->getRaceId(0, 'single') . "'";
            }
        } else {
            echo json_encode(array("success" => false, "message" => $this->systemString->getNonSupportedDatabase()));
            exit();
        }
        /**
         * filter column based on first character 
         */
        if ($this->getCharacterQuery()) {
            if ($this->q->vendor == self::MYSQL) {
                $sql.=" AND `" . $this->model->getTableName() . "`.`" . $this->model->getFilterCharacter() . "` like '" . $this->getCharacterQuery() . "%'";
            } else if ($this->q->vendor == self::MSSQL) {
                $sql.=" AND [" . $this->model->getTableName() . "].[" . $this->model->getFilterCharacter() . "] like '" . $this->getCharacterQuery() . "%'";
            } else if ($this->q->vendor == self::ORACLE) {
                $sql.=" AND " . strtoupper($this->model->getTableName()) . "." . strtoupper($this->model->getFilterCharacter()) . " = '" . $this->getCharacterQuery() . "'";
            } else if ($this->q->vendor == self::DB2) {
                $sql.=" AND " . strtoupper($this->model->getTableName()) . "." . strtoupper($this->model->getFilterCharacter()) . " = '" . $this->getCharacterQuery() . "'";
            } else if ($this->q->vendor == self::POSTGRESS) {
                $sql.=" AND " . strtoupper($this->model->getTableName()) . "." . strtoupper($this->model->getFilterCharacter()) . " = '" . $this->getCharacterQuery() . "'";
            }
        }
        /**
         * filter column based on Range Of Date 
         * Example Day,Week,Month,Year 
         */
        if ($this->getDateRangeStartQuery()) {
            $sql.=$this->q->dateFilter($this->model->getTableName(), $this->model->getFilterDate(), $this->getDateRangeStartQuery(), $this->getDateRangeEndQuery(), $this->getDateRangeTypeQuery(), $this->getDateRangeExtraTypeQuery());
        }
        /**
         * filter column don't want to filter.Example may contain  sensetive information or unwanted to be search. 
         * E.g  $filterArray=array('`leaf`.`leafId`'); 
         * @variables $filterArray; 
         */
        $filterArray = null;
        $filterArray = array('raceId');
        /**
         * filter table 
         * @variables $tableArray 
         */
        $tableArray = null;
        $tableArray = array('race');
        if ($this->getFieldQuery()) {
            $this->q->setFieldQuery($this->getFieldQuery());
            if ($this->getVendor() == self::MYSQL) {
                $sql .= $this->q->quickSearch($tableArray, $filterArray);
            } else if ($this->getVendor() == self::MSSQL) {
                $tempSql = $this->q->quickSearch($tableArray, $filterArray);
                $sql .= $tempSql;
            } else if ($this->getVendor() == self::ORACLE) {
                $tempSql = $this->q->quickSearch($tableArray, $filterArray);
                $sql .= $tempSql;
            }
        }
        /**
         * Extjs filtering mode 
         */
        if ($this->getGridQuery()) {
            $this->q->setGridQuery($this->getGridQuery());
            if ($this->getVendor() == self::MYSQL) {
                $sql .= $this->q->searching();
            } else if ($this->getVendor() == self::MSSQL) {
                $tempSql2 = $this->q->searching();
                $sql .= $tempSql2;
            } else if ($this->getVendor() == self::ORACLE) {
                $tempSql2 = $this->q->searching();
                $sql .= $tempSql2;
            } else if ($this->getVendor() == self::DB2) {
                
            } else if ($this->getVendor() == self::POSTGRESS) {
                
            }
        }
        // optional debugger.uncomment if wanted to used 
        //if ($this->q->execute == 'fail') { 
        //	echo json_encode(array( 
        //   "success" => false, 
        //   "message" => $this->q->realEscapeString($sql) 
        //	)); 
        //	exit(); 
        //} 
        // end of optional debugger 
        $this->q->read($sql);
        if ($this->q->execute == 'fail') {
            echo json_encode(array("success" => false, "message" => $this->q->responce));
            exit();
        }
        $total = $this->q->numberRows();
        if ($this->getSortField()) {
            if ($this->getVendor() == self::MYSQL) {
                $sql .= "	ORDER BY `" . $this->getSortField() . "` " . $this->getOrder() . " ";
            } else if ($this->getVendor() == self::MSSQL) {
                $sql .= "	ORDER BY [" . $this->getSortField() . "] " . $this->getOrder() . " ";
            } else if ($this->getVendor() == self::ORACLE) {
                $sql .= "	ORDER BY " . strtoupper($this->getSortField()) . " " . strtoupper($this->getOrder()) . " ";
            }
        }
        $_SESSION ['sql'] = $sql; // push to session so can make report via excel and pdf 
        $_SESSION ['start'] = $this->getStart();
        $_SESSION ['limit'] = $this->getLimit();
        if ($this->getLimit()) {
            // only mysql have limit 
            if ($this->getVendor() == self::MYSQL) {
                $sql .= " LIMIT  " . $this->getStart() . "," . $this->getLimit() . " ";
            } else if ($this->getVendor() == self::MSSQL) {
                /**
                 * Sql Server and Oracle used row_number 
                 * Parameterize Query We don't support 
                 * */;

                $sql = "WITH [raceDerived] AS
							(
								SELECT [race].[raceId],
[race].[raceSequence],
[race].[raceCode],
[race].[raceDesc],
[race].[isDefault],
[race].[isNew],
[race].[isDraft],
[race].[isUpdate],
[race].[isDelete],
[race].[isActive],
[race].[isApproved],
[race].[isReview],
[race].[isPost],
[race].[executeBy],
[race].[executeTime],
[staff].[staffName],
ROW_NUMBER() OVER (ORDER BY [race].[raceId]) AS 'RowNumber'

						
			FROM 	[icommon].[race]
			JOIN		[iCore].[staff]
			ON		[race].[executeBy] = [staff].[staffId]
			WHERE " . $this->auditFilter . $tempSql . $tempSql2 . "
							)
							SELECT		*
							FROM 		[raceDerived]
							WHERE 		[RowNumber]
							BETWEEN	" . ($this->getStart() + 1) . "
							AND 			" . ($this->getStart() + $this->getLimit()) . " ;";
            } else if ($this->getVendor() == self::ORACLE) {
                /**
                 * Oracle using derived table also 
                 * */
                $sql = "
						SELECT *
						FROM ( SELECT	a.*,
												rownum r
						FROM (
SELECT RACE.RACEID,
 RACE.RACESEQUENCE,
 RACE.RACECODE,
 RACE.RACEDESC,
 RACE.ISDEFAULT,
 RACE.ISNEW,
 RACE.ISDRAFT,
 RACE.ISUPDATE,
 RACE.ISDELETE,
 RACE.ISACTIVE,
 RACE.ISAPPROVED,
 RACE.ISREVIEW,
 RACE.ISPOST,
 RACE.EXECUTEBY,
 RACE.EXECUTETIME,
STAFF.STAFFNAME
			FROM 	RACE
			JOIN		STAFF
			ON		RACE.EXECUTEBY = STAFF.STAFFID
			WHERE 		" . $this->auditFilter . $tempSql . $tempSql2 . "
								 ) a
						where rownum <= '" . ($this->getStart() + $this->getLimit()) . "' )
						where r >=  '" . ($this->getStart() + 1) . "'";
            } else {
                echo json_encode(array("success" => false, "message" => $this->systemString->getNonSupportedDatabase()));
                exit();
            }
        }
        /*
         *  Only Execute One Query 
         */
        if (!($this->model->getRaceId(0, 'single'))) {
            $this->q->read($sql);
            if ($this->q->execute == 'fail') {
                echo json_encode(array("success" => false, "message" => $this->q->responce));
                exit();
            }
        }
        $items = array();
        $i = 1;
        while (($row = $this->q->fetchAssoc()) == TRUE) {
            $row['total'] = $total; // small overide 
            $row['counter'] = $this->getStart() + 15;
            if ($this->model->getRaceId(0, 'single')) {
                $row['firstRecord'] = $this->firstRecord('value');
                $row['previousRecord'] = $this->previousRecord('value', $this->model->getRaceId(0, 'single'));
                $row['nextRecord'] = $this->nextRecord('value', $this->model->getRaceId(0, 'single'));
                $row['lastRecord'] = $this->lastRecord('value');
            }
            $items [] = $row;
            $i++;
        }
        if ($this->getPageOutput() == 'html') {
            return $items;
        } else if ($this->getPageOutput() == 'json') {
            if ($this->model->getRaceId(0, 'single')) {
                $end = microtime(true);
                $time = $end - $start;
                $json_encode = json_encode(array(
                    'success' => true,
                    'total' => $total,
                    'message' => $this->systemString->getReadMessage(),
                    'time' => $time,
                    'firstRecord' => $this->firstRecord('value'),
                    'previousRecord' => $this->previousRecord('value', $this->model->getRaceId(0, 'single')),
                    'nextRecord' => $this->nextRecord('value', $this->model->getRaceId(0, 'single')),
                    'lastRecord' => $this->lastRecord('value'),
                    'data' => $items));
                $json_encode = str_replace("[", "", $json_encode);
                $json_encode = str_replace("]", "", $json_encode);
                echo $json_encode;
            } else {
                if (count($items) == 0) {
                    $items = '';
                }
                $end = microtime(true);
                $time = $end - $start;
                echo json_encode(array(
                    'success' => true,
                    'total' => $total,
                    'message' => $this->systemString->getReadMessage(),
                    'time' => $time,
                    'firstRecord' => $this->recordSet->firstRecord('value'),
                    'previousRecord' => $this->recordSet->previousRecord('value', $this->model->getRaceId(0, 'single')),
                    'nextRecord' => $this->recordSet->nextRecord('value', $this->model->getRaceId(0, 'single')),
                    'lastRecord' => $this->recordSet->lastRecord('value'),
                    'data' => $items));
                exit();
            }
        }
    }

    /* (non-PHPdoc) 
     * @see config::update() 
     */

    function update() {
        header('Content-Type:application/json; charset=utf-8');
        $start = microtime(true);
        if ($this->getVendor() == self::MYSQL) {
            $sql = "SET NAMES utf8";
            $this->q->fast($sql);
            if ($this->q->execute == 'fail') {
                echo json_encode(array("success" => false, "message" => $this->q->responce));
                exit();
            }
        }
        $this->q->start();
        $this->model->update();
        // before updating check the id exist or not . if exist continue to update else warning the user 
        if ($this->getVendor() == self::MYSQL) {
            $sql = " 
		SELECT	`" . $this->model->getPrimaryKeyName() . "` 
		FROM 	`icommon`.`" . $this->model->getTableName() . "` 
		WHERE  	`" . $this->model->getPrimaryKeyName() . "` = '" . $this->model->getRaceId(0, 'single') . "' ";
        } else if ($this->getVendor() == self::MSSQL) {
            $sql = " 
			SELECT	[" . $this->model->getPrimaryKeyName() . "] 
			FROM 	[icommon].[" . $this->model->getTableName() . "] 
			WHERE  	[" . $this->model->getPrimaryKeyName() . "] = '" . $this->model->getRaceId(0, 'single') . "' ";
        } else if ($this->getVendor() == self::ORACLE) {
            $sql = " 
		SELECT	" . strtoupper($this->model->getPrimaryKeyName()) . " 
		FROM 	" . strtoupper($this->model->getTableName()) . " 
		WHERE  	" . strtoupper($this->model->getPrimaryKeyName()) . " = '" . $this->model->getRaceId(0, 'single') . "' ";
        } else if ($this->getVendor() == self::DB2) {
            $sql = " 
			SELECT	" . strtoupper($this->model->getPrimaryKeyName()) . " 
			FROM 	" . strtoupper($this->model->getTableName()) . " 
			WHERE  	" . strtoupper($this->model->getPrimaryKeyName()) . " = '" . $this->model->getRaceId(0, 'single') . "' ";
        } else if ($this->getVendor() == self::POSTGRESS) {
            $sql = " 
			SELECT	" . strtoupper($this->model->getPrimaryKeyName()) . " 
			FROM 	" . strtoupper($this->model->getTableName()) . " 
			WHERE  	" . strtoupper($this->model->getPrimaryKeyName()) . " = '" . $this->model->getRaceId(0, 'single') . "' ";
        }
        $result = $this->q->fast($sql);
        $total = $this->q->numberRows($result, $sql);
        if ($total == 0) {
            echo json_encode(array("success" => false, "message" => $this->systemString->getRecordNotFoundMessage()));
            exit();
        } else {
            if ($this->getVendor() == self::MYSQL) {

                $sql = "UPDATE `icommon`.`race` SET 
 `raceSequence` = '" . $this->model->getRaceSequence() . "',
 `raceCode` = '" . $this->model->getRaceCode() . "',
 `raceDesc` = '" . $this->model->getRaceDesc() . "',
 `isDefault` = '" . $this->model->getIsDefault('0', 'single') . "',
 `isNew` = '" . $this->model->getIsNew('0', 'single') . "',
 `isDraft` = '" . $this->model->getIsDraft('0', 'single') . "',
 `isUpdate` = '" . $this->model->getIsUpdate('0', 'single') . "',
 `isDelete` = '" . $this->model->getIsDelete('0', 'single') . "',
 `isActive` = '" . $this->model->getIsActive('0', 'single') . "',
 `isApproved` = '" . $this->model->getIsApproved('0', 'single') . "',
 `isReview` = '" . $this->model->getIsReview('0', 'single') . "',
 `isPost` = '" . $this->model->getIsPost('0', 'single') . "',
 `executeBy` = '" . $this->model->getExecuteBy('0', 'single') . "',
 `executeTime` = " . $this->model->getExecuteTime() . " 
WHERE `raceId`='" . $this->model->getRaceId('0', 'single') . "'";
            } else if ($this->getVendor() == self::MSSQL) {

                $sql = "UPDATE [icommon].[race] SET 
 [raceSequence] = '" . $this->model->getRaceSequence() . "',
 [raceCode] = '" . $this->model->getRaceCode() . "',
 [raceDesc] = '" . $this->model->getRaceDesc() . "',
 [isDefault] = '" . $this->model->getIsDefault(0, 'single') . "',
 [isNew] = '" . $this->model->getIsNew(0, 'single') . "',
 [isDraft] = '" . $this->model->getIsDraft(0, 'single') . "',
 [isUpdate] = '" . $this->model->getIsUpdate(0, 'single') . "',
 [isDelete] = '" . $this->model->getIsDelete(0, 'single') . "',
 [isActive] = '" . $this->model->getIsActive(0, 'single') . "',
 [isApproved] = '" . $this->model->getIsApproved(0, 'single') . "',
 [isReview] = '" . $this->model->getIsReview(0, 'single') . "',
 [isPost] = '" . $this->model->getIsPost(0, 'single') . "',
 [executeBy] = '" . $this->model->getExecuteBy(0, 'single') . "',
 [executeTime] = " . $this->model->getExecuteTime() . " 
WHERE [raceId]='" . $this->model->getRaceId('0', 'single') . "'";
            } else if ($this->getVendor() == self::ORACLE) {

                $sql = "UPDATE `RACE` SET
  RACEID = '" . $this->model->getRaceId() . "',
 RACECODE = '" . $this->model->getRaceCode() . "',
 RACEDESC = '" . $this->model->getRaceDesc() . "',
 ISDEFAULT = '" . $this->model->getIsDefault(0, 'single') . "',
 ISNEW = '" . $this->model->getIsNew(0, 'single') . "',
 ISDRAFT = '" . $this->model->getIsDraft(0, 'single') . "',
 ISUPDATE = '" . $this->model->getIsUpdate(0, 'single') . "',
 ISDELETE = '" . $this->model->getIsDelete(0, 'single') . "',
 ISACTIVE = '" . $this->model->getIsActive(0, 'single') . "',
 ISAPPROVED = '" . $this->model->getIsApproved(0, 'single') . "',
 ISREVIEW = '" . $this->model->getIsReview(0, 'single') . "',
 ISPOST = '" . $this->model->getIsPost(0, 'single') . "',
 EXECUTEBY = '" . $this->model->getExecuteBy(0, 'single') . "',
 EXECUTETIME = " . $this->model->getExecuteTime() . " 
WHERE `RACEID`='" . $this->model->getRaceId('0', 'single') . "'";
            } else if ($this->getVendor() == self::DB2) {

                $sql = "UPDATE `RACE` SET
  RACESEQUENCE = '" . $this->model->getRaceSequence() . "',
 RACECODE = '" . $this->model->getRaceCode() . "',
 RACEDESC = '" . $this->model->getRaceDesc() . "',
 ISDEFAULT = '" . $this->model->getIsDefault(0, 'single') . "',
 ISNEW = '" . $this->model->getIsNew(0, 'single') . "',
 ISDRAFT = '" . $this->model->getIsDraft(0, 'single') . "',
 ISUPDATE = '" . $this->model->getIsUpdate(0, 'single') . "',
 ISDELETE = '" . $this->model->getIsDelete(0, 'single') . "',
 ISACTIVE = '" . $this->model->getIsActive(0, 'single') . "',
 ISAPPROVED = '" . $this->model->getIsApproved(0, 'single') . "',
 ISREVIEW = '" . $this->model->getIsReview(0, 'single') . "',
 ISPOST = '" . $this->model->getIsPost(0, 'single') . "',
 EXECUTEBY = '" . $this->model->getExecuteBy(0, 'single') . "',
 EXECUTETIME = " . $this->model->getExecuteTime() . " 
WHERE `RACEID`='" . $this->model->getRaceId('0', 'single') . "'";
            } else if ($this->getVendor() == self::POSTGRESS) {

                $sql = "UPDATE `RACE` SET
  RACESEQUENCE = '" . $this->model->getRaceSequence() . "',
 RACECODE = '" . $this->model->getRaceCode() . "',
 RACEDESC = '" . $this->model->getRaceDesc() . "',
 ISDEFAULT = '" . $this->model->getIsDefault(0, 'single') . "',
 ISNEW = '" . $this->model->getIsNew(0, 'single') . "',
 ISDRAFT = '" . $this->model->getIsDraft(0, 'single') . "',
 ISUPDATE = '" . $this->model->getIsUpdate(0, 'single') . "',
 ISDELETE = '" . $this->model->getIsDelete(0, 'single') . "',
 ISACTIVE = '" . $this->model->getIsActive(0, 'single') . "',
 ISAPPROVED = '" . $this->model->getIsApproved(0, 'single') . "',
 ISREVIEW = '" . $this->model->getIsReview(0, 'single') . "',
 ISPOST = '" . $this->model->getIsPost(0, 'single') . "',
 EXECUTEBY = '" . $this->model->getExecuteBy(0, 'single') . "',
 EXECUTETIME = " . $this->model->getExecuteTime() . " 
WHERE `RACEID`='" . $this->model->getRaceId('0', 'single') . "'";
            }
            $this->q->update($sql);
            if ($this->q->execute == 'fail') {
                echo json_encode(array("success" => false, "message" => $this->q->responce));
                exit();
            }
        }
        $this->q->commit();
        $end = microtime(true);
        $time = $end - $start;
        echo json_encode(
                array("success" => true,
                    "message" => $this->systemString->getUpdateMessage(),
                    "time" => $time));
        exit();
    }

    /* (non-PHPdoc) 
     * @see config::delete() 
     */

    function delete() {
        header('Content-Type:application/json; charset=utf-8');
        $start = microtime(true);
        if ($this->getVendor() == self::MYSQL) {
            $sql = "SET NAMES utf8";
            $this->q->fast($sql);
        }
        $this->q->start();
        $this->model->delete();
        // before updating check the id exist or not . if exist continue to update else warning the user 
        if ($this->getVendor() == self::MYSQL) {
            $sql = " 
		SELECT	`" . $this->model->getPrimaryKeyName() . "` 
		FROM 	`icommon`.`" . $this->model->getTableName() . "` 
		WHERE  	`" . $this->model->getPrimaryKeyName() . "` = '" . $this->model->getRaceId(0, 'single') . "' ";
        } else if ($this->getVendor() == self::MSSQL) {
            $sql = " 
			SELECT	[" . $this->model->getPrimaryKeyName() . "]  
			FROM 	[icommon].[" . $this->model->getTableName() . "] 
			WHERE  	[" . $this->model->getPrimaryKeyName() . "] = '" . $this->model->getRaceId(0, 'single') . "' ";
        } else if ($this->getVendor() == self::ORACLE) {
            $sql = " 
		SELECT	" . strtoupper($this->model->getPrimaryKeyName()) . " 
		FROM 	" . strtoupper($this->model->getTableName()) . " 
		WHERE  	" . strtoupper($this->model->getPrimaryKeyName()) . " = '" . $this->model->getRaceId(0, 'single') . "' ";
        } else if ($this->getVendor() == self::DB2) {
            $sql = " 
			SELECT	" . strtoupper($this->model->getPrimaryKeyName()) . " 
			FROM 	" . strtoupper($this->model->getTableName()) . " 
			WHERE  	" . strtoupper($this->model->getPrimaryKeyName()) . " = '" . $this->model->getRaceId(0, 'single') . "' ";
        } else if ($this->getVendor() == self::POSTGRESS) {
            $sql = " 
			SELECT	" . strtoupper($this->model->getPrimaryKeyName()) . " 
			FROM 	" . strtoupper($this->model->getTableName()) . " 
			WHERE  	" . strtoupper($this->model->getPrimaryKeyName()) . " = '" . $this->model->getRaceId(0, 'single') . "' ";
        }
        $result = $this->q->fast($sql);
        $total = $this->q->numberRows($result, $sql);
        if ($total == 0) {
            echo json_encode(array("success" => false, "message" => $this->systemString->getRecordNotFoundMessage()));
            exit();
        } else {
            if ($this->getVendor() == self::MYSQL) {
                $sql = "  	UPDATE 	`icommon`.`race`

					SET 	`isDefault`				=	'" . $this->model->getIsDefault(0, 'single') . "',
							`isNew`					=	'" . $this->model->getIsNew(0, 'single') . "',
							`isDraft`					=	'" . $this->model->getIsDraft(0, 'single') . "',
							`isUpdate`				=	'" . $this->model->getIsUpdate(0, 'single') . "',
							`isDelete`					=	'" . $this->model->getIsDelete(0, 'single') . "',
							`isActive`					=	'" . $this->model->getIsActive(0, 'single') . "',
							`isApproved`			=	'" . $this->model->getIsApproved(0, 'single') . "',
							`isReview`				=	'" . $this->model->getIsReview(0, 'single') . "',
							`isPost`					=	'" . $this->model->getIsPost(0, 'single') . "',
							`executeBy`				=	'" . $this->model->getExecuteBy() . "',
							`executeTime`			=	" . $this->model->getExecuteTime() . "
				WHERE 	`raceId`	=  '" . $this->model->getRaceId(0, 'single') . "'";
            } else if ($this->getVendor() == self::MSSQL) {

                $sql = "   	
				UPDATE 	[icommon].[race]
				SET 			[isDefault]					=	'" . $this->model->getIsDefault(0, 'single') . "',
								[isNew]						=	'" . $this->model->getIsNew(0, 'single') . "',
								[isDraft]					=	'" . $this->model->getIsDraft(0, 'single') . "',
								[isUpdate]					=	'" . $this->model->getIsUpdate(0, 'single') . "',
								[isDelete]					=	'" . $this->model->getIsDelete(0, 'single') . "',
								[isActive]					=	'" . $this->model->getIsActive(0, 'single') . "',
								[isApproved]				=	'" . $this->model->getIsApproved(0, 'single') . "',
								[isReview]					=	'" . $this->model->getIsReview(0, 'single') . "',
								[isPost]						=	'" . $this->model->getIsPost(0, 'single') . "',
								[executeBy]				=	'" . $this->model->getExecuteBy() . "',
								[executeTime]			=	" . $this->model->getExecuteTime() . "
				WHERE 		[raceId]	=  '" . $this->model->getRaceId(0, 'single') . "'";
            } else if ($this->getVendor() == self::ORACLE) {

                $sql = " 
				UPDATE 	RACE
				SET 	ISDEFAULT		=	'" . $this->model->getIsDefault(0, 'single') . "',
						ISNEW			=	'" . $this->model->getIsNew(0, 'single') . "',
						ISDRAFT			=	'" . $this->model->getIsDraft(0, 'single') . "',
						ISUPDATE		=	'" . $this->model->getIsUpdate(0, 'single') . "',
						ISDELETE		=	'" . $this->model->getIsDelete(0, 'single') . "',
						ISACTIVE		=	'" . $this->model->getIsActive(0, 'single') . "',
						ISAPPROVED		=	'" . $this->model->getIsApproved(0, 'single') . "',
						ISREVIEW		=	'" . $this->model->getIsReview(0, 'single') . "',
						ISPOST			=	'" . $this->model->getIsPost(0, 'single') . "',
						EXECUTEBY		=	'" . $this->model->getExecuteBy() . "',
						EXECUTETIME		=	" . $this->model->getExecuteTime() . "
				WHERE 	RACEID	=  '" . $this->model->getRaceId(0, 'single') . "'";
            } else if ($this->getVendor() == self::DB2) {

                $sql = " 
				UPDATE 	RACE
				SET 	ISDEFAULT		=	'" . $this->model->getIsDefault(0, 'single') . "',
						ISNEW			=	'" . $this->model->getIsNew(0, 'single') . "',
						ISDRAFT			=	'" . $this->model->getIsDraft(0, 'single') . "',
						ISUPDATE		=	'" . $this->model->getIsUpdate(0, 'single') . "',
						ISDELETE		=	'" . $this->model->getIsDelete(0, 'single') . "',
						ISACTIVE		=	'" . $this->model->getIsActive(0, 'single') . "',
						ISAPPROVED		=	'" . $this->model->getIsApproved(0, 'single') . "',
						ISREVIEW		=	'" . $this->model->getIsReview(0, 'single') . "',
						ISPOST			=	'" . $this->model->getIsPost(0, 'single') . "',
						EXECUTEBY		=	'" . $this->model->getExecuteBy() . "',
						EXECUTETIME		=	" . $this->model->getExecuteTime() . "
				WHERE 	RACEID	=  '" . $this->model->getRaceId(0, 'single') . "'";
            } else if ($this->getVendor() == self::POSTGRESS) {
                $sql = " 
				UPDATE 	RACE
				SET 	ISDEFAULT		=	'" . $this->model->getIsDefault(0, 'single') . "',
						ISNEW			=	'" . $this->model->getIsNew(0, 'single') . "',
						ISDRAFT			=	'" . $this->model->getIsDraft(0, 'single') . "',
						ISUPDATE		=	'" . $this->model->getIsUpdate(0, 'single') . "',
						ISDELETE		=	'" . $this->model->getIsDelete(0, 'single') . "',
						ISACTIVE		=	'" . $this->model->getIsActive(0, 'single') . "',
						ISAPPROVED		=	'" . $this->model->getIsApproved(0, 'single') . "',
						ISREVIEW		=	'" . $this->model->getIsReview(0, 'single') . "',
						ISPOST			=	'" . $this->model->getIsPost(0, 'single') . "',
						EXECUTEBY		=	'" . $this->model->getExecuteBy() . "',
						EXECUTETIME		=	" . $this->model->getExecuteTime() . "
				WHERE 	RACEID	=  '" . $this->model->getRaceId(0, 'single') . "'";
            }
            $this->q->update($sql);
            if ($this->q->execute == 'fail') {
                echo json_encode(array("success" => false, "message" => $this->q->responce));
                exit();
            }
        }
        $this->q->commit();
        $end = microtime(true);
        $time = $end - $start;
        echo json_encode(
                array("success" => true,
                    "message" => $this->systemString->getDeleteMessage(),
                    "time" => $time));
        exit();
    }

    /**
     * To Update flag Status 
     */
    function updateStatus() {
        header('Content-Type:application/json; charset=utf-8');
        $start = microtime(true);
        $sqlLooping = null;
        if ($this->getVendor() == self::MYSQL) {
            $sql = "SET NAMES utf8";
            $this->q->fast($sql);
        }
        $this->q->start();
        $loop = $this->model->getTotal();
        if ($this->getVendor() == self::MYSQL) {
            $sql = " 
			UPDATE `icommon`.`" . $this->model->getTableName() . "` 
			SET";
        } else if ($this->getVendor() == self::MSSQL) {
            $sql = " 
			UPDATE 	[icommon].[" . $this->model->getTableName() . "] 
			SET 	";
        } else if ($this->getVendor() == self::ORACLE) {
            $sql = " 
			UPDATE " . strtoupper($this->model->getTableName()) . " 
			SET    ";
        } else if ($this->getVendor() == self::DB2) {
            $sql = " 
			UPDATE " . strtoupper($this->model->getTableName()) . " 
			SET    ";
        } else if ($this->getVendor() == self::POSTGRESS) {
            $sql = " 
			UPDATE " . strtoupper($this->model->getTableName()) . " 
			SET    ";
        } else {
            echo json_encode(array("success" => false, "message" => $this->systemString->getNonSupportedDatabase()));
            exit();
        }
        if ($_SESSION) {
            if ($_SESSION['isAdmin'] == 1) {
                if ($this->model->getIsDefaultTotal() > 0) {
                    if ($this->getVendor() == self::MYSQL) {
                        $sqlLooping .= " `isDefault` = CASE `icommon`.`" . $this->model->getTableName() . "`.`" . $this->model->getPrimaryKeyName() . "`";
                    } else if ($this->getVendor() == self::MSSQL) {
                        $sqlLooping .= "  [isDefault] = CASE [icommon].[" . $this->model->getTableName() . "].[" . $this->model->getPrimaryKeyName() . "]";
                    } else if ($this->getVendor() == self::ORACLE) {
                        $sqlLooping .= " ISDEFAULT = CASE icommon." . strtoupper($this->model->getTableName()) . strtoupper($this->model->getPrimaryKeyName()) . " ";
                    } else if ($this->getVendor() == self::DB2) {
                        $sqlLooping .= "  ISDEFAULT = CASE icommon." . strtoupper($this->model->getTableName()) . strtoupper($this->model->getPrimaryKeyName()) . " ";
                    } else if ($this->getVendor() == self::POSTGRESS) {
                        $sqlLooping .= " ISDEFAULT = CASE icommon." . strtoupper($this->model->getTableName()) . strtoupper($this->model->getPrimaryKeyName()) . " ";
                    } else {
                        echo json_encode(array("success" => false, "message" => $this->systemString->getNonSupportedDatabase()));
                        exit();
                    }
                    for ($i = 0; $i < $loop; $i++) {
                        $sqlLooping .= "
                         WHEN '" . $this->model->getRaceId($i, 'array') . "'
                         THEN '" . $this->model->getIsDefault($i, 'array') . "'";
                    }
                    $sqlLooping .= " END,";
                }
                if ($this->model->getIsDraftTotal() > 0) {
                    if ($this->getVendor() == self::MYSQL) {
                        $sqlLooping .= " `isDraft` = CASE `icommon`.`" . $this->model->getTableName() . "`.`" . $this->model->getPrimaryKeyName() . "`";
                    } else if ($this->getVendor() == self::MSSQL) {
                        $sqlLooping .= "  [isDraft] = CASE [icommon].[" . $this->model->getTableName() . "].[" . $this->model->getPrimaryKeyName() . "]";
                    } else if ($this->getVendor() == self::ORACLE) {
                        $sqlLooping .= " ISDRAFT = CASE icommon." . strtoupper($this->model->getTableName()) . strtoupper($this->model->getPrimaryKeyName()) . " ";
                    } else if ($this->getVendor() == self::DB2) {
                        $sqlLooping .= "  ISDRAFT = CASE icommon." . strtoupper($this->model->getTableName()) . strtoupper($this->model->getPrimaryKeyName()) . " ";
                    } else if ($this->getVendor() == self::POSTGRESS) {
                        $sqlLooping .= " ISDRAFT = CASE icommon." . strtoupper($this->model->getTableName()) . strtoupper($this->model->getPrimaryKeyName()) . " ";
                    } else {
                        echo json_encode(array("success" => false, "message" => $this->systemString->getNonSupportedDatabase()));
                        exit();
                    }
                    for ($i = 0; $i < $loop; $i++) {
                        $sqlLooping .= "
                         WHEN '" . $this->model->getRaceId($i, 'array') . "'
                         THEN '" . $this->model->getIsDraft($i, 'array') . "'";
                    }
                    $sqlLooping .= " END,";
                }
                if ($this->model->getIsNewTotal() > 0) {
                    if ($this->getVendor() == self::MYSQL) {
                        $sqlLooping .= " `isNew` = CASE `icommon`.`" . $this->model->getTableName() . "`.`" . $this->model->getPrimaryKeyName() . "`";
                    } else if ($this->getVendor() == self::MSSQL) {
                        $sqlLooping .= "  [isNew] = CASE [icommon].[" . $this->model->getTableName() . "].[" . $this->model->getPrimaryKeyName() . "]";
                    } else if ($this->getVendor() == self::ORACLE) {
                        $sqlLooping .= " ISNEW = CASE icommon." . strtoupper($this->model->getTableName()) . strtoupper($this->model->getPrimaryKeyName()) . " ";
                    } else if ($this->getVendor() == self::DB2) {
                        $sqlLooping .= "  ISNEW = CASE icommon." . strtoupper($this->model->getTableName()) . strtoupper($this->model->getPrimaryKeyName()) . " ";
                    } else if ($this->getVendor() == self::POSTGRESS) {
                        $sqlLooping .= " ISNEW = CASE icommon." . strtoupper($this->model->getTableName()) . strtoupper($this->model->getPrimaryKeyName()) . " ";
                    } else {
                        echo json_encode(array("success" => false, "message" => $this->systemString->getNonSupportedDatabase()));
                        exit();
                    }
                    for ($i = 0; $i < $loop; $i++) {
                        $sqlLooping .= "
                         WHEN '" . $this->model->getRaceId($i, 'array') . "'
                         THEN '" . $this->model->getIsNew($i, 'array') . "'";
                    }
                    $sqlLooping .= " END,";
                }
                if ($this->model->getIsActiveTotal() > 0) {
                    if ($this->getVendor() == self::MYSQL) {
                        $sqlLooping .= " `isActive` = CASE `icommon`.`" . $this->model->getTableName() . "`.`" . $this->model->getPrimaryKeyName() . "`";
                    } else if ($this->getVendor() == self::MSSQL) {
                        $sqlLooping .= "  [isActive] = CASE [icommon].[" . $this->model->getTableName() . "].[" . $this->model->getPrimaryKeyName() . "]";
                    } else if ($this->getVendor() == self::ORACLE) {
                        $sqlLooping .= " ISACTIVE = CASE icommon." . strtoupper($this->model->getTableName()) . strtoupper($this->model->getPrimaryKeyName()) . " ";
                    } else if ($this->getVendor() == self::DB2) {
                        $sqlLooping .= "  ISACTIVE = CASE icommon." . strtoupper($this->model->getTableName()) . strtoupper($this->model->getPrimaryKeyName()) . " ";
                    } else if ($this->getVendor() == self::POSTGRESS) {
                        $sqlLooping .= " ISACTIVE = CASE icommon." . strtoupper($this->model->getTableName()) . strtoupper($this->model->getPrimaryKeyName()) . " ";
                    } else {
                        echo json_encode(array("success" => false, "message" => $this->systemString->getNonSupportedDatabase()));
                        exit();
                    }
                    for ($i = 0; $i < $loop; $i++) {
                        $sqlLooping .= "
                         WHEN '" . $this->model->getRaceId($i, 'array') . "'
                         THEN '" . $this->model->getIsActive($i, 'array') . "'";
                    }
                    $sqlLooping .= " END,";
                }
                if ($this->model->getIsUpdateTotal() > 0) {
                    if ($this->getVendor() == self::MYSQL) {
                        $sqlLooping .= " `isUpdate` = CASE `icommon`.`" . $this->model->getTableName() . "`.`" . $this->model->getPrimaryKeyName() . "`";
                    } else if ($this->getVendor() == self::MSSQL) {
                        $sqlLooping .= "  [isUpdate] = CASE [icommon].[" . $this->model->getTableName() . "].[" . $this->model->getPrimaryKeyName() . "]";
                    } else if ($this->getVendor() == self::ORACLE) {
                        $sqlLooping .= " ISUPDATE = CASE icommon." . strtoupper($this->model->getTableName()) . strtoupper($this->model->getPrimaryKeyName()) . " ";
                    } else if ($this->getVendor() == self::DB2) {
                        $sqlLooping .= "  ISUPDATE = CASE icommon." . strtoupper($this->model->getTableName()) . strtoupper($this->model->getPrimaryKeyName()) . " ";
                    } else if ($this->getVendor() == self::POSTGRESS) {
                        $sqlLooping .= " ISUPDATE = CASE icommon." . strtoupper($this->model->getTableName()) . strtoupper($this->model->getPrimaryKeyName()) . " ";
                    } else {
                        echo json_encode(array("success" => false, "message" => $this->systemString->getNonSupportedDatabase()));
                        exit();
                    }
                    for ($i = 0; $i < $loop; $i++) {
                        $sqlLooping .= "
                         WHEN '" . $this->model->getRaceId($i, 'array') . "'
                         THEN '" . $this->model->getIsUpdate($i, 'array') . "'";
                    }
                    $sqlLooping .= " END,";
                }
                if ($this->model->getIsDeleteTotal() > 0) {
                    if ($this->getVendor() == self::MYSQL) {
                        $sqlLooping .= " `isDelete` = CASE `icommon`.`" . $this->model->getTableName() . "`.`" . $this->model->getPrimaryKeyName() . "`";
                    } else if ($this->getVendor() == self::MSSQL) {
                        $sqlLooping .= "  [isDelete] = CASE [icommon].[" . $this->model->getTableName() . "].[" . $this->model->getPrimaryKeyName() . "]";
                    } else if ($this->getVendor() == self::ORACLE) {
                        $sqlLooping .= " ISDELETE = CASE icommon." . strtoupper($this->model->getTableName()) . strtoupper($this->model->getPrimaryKeyName()) . " ";
                    } else if ($this->getVendor() == self::DB2) {
                        $sqlLooping .= "  ISDELETE = CASE icommon." . strtoupper($this->model->getTableName()) . strtoupper($this->model->getPrimaryKeyName()) . " ";
                    } else if ($this->getVendor() == self::POSTGRESS) {
                        $sqlLooping .= " ISDELETE = CASE icommon." . strtoupper($this->model->getTableName()) . strtoupper($this->model->getPrimaryKeyName()) . " ";
                    } else {
                        echo json_encode(array("success" => false, "message" => $this->systemString->getNonSupportedDatabase()));
                        exit();
                    }
                    for ($i = 0; $i < $loop; $i++) {
                        $sqlLooping .= "
                         WHEN '" . $this->model->getRaceId($i, 'array') . "'
                         THEN '" . $this->model->getIsDelete($i, 'array') . "'";
                    }
                    $sqlLooping .= " END,";
                }
                if ($this->model->getIsReviewTotal() > 0) {
                    if ($this->getVendor() == self::MYSQL) {
                        $sqlLooping .= " `isReview` = CASE `icommon`.`" . $this->model->getTableName() . "`.`" . $this->model->getPrimaryKeyName() . "`";
                    } else if ($this->getVendor() == self::MSSQL) {
                        $sqlLooping .= "  [isReview] = CASE [icommon].[" . $this->model->getTableName() . "].[" . $this->model->getPrimaryKeyName() . "]";
                    } else if ($this->getVendor() == self::ORACLE) {
                        $sqlLooping .= " ISREVIEW = CASE icommon." . strtoupper($this->model->getTableName()) . strtoupper($this->model->getPrimaryKeyName()) . " ";
                    } else if ($this->getVendor() == self::DB2) {
                        $sqlLooping .= "  ISREVIEW = CASE icommon." . strtoupper($this->model->getTableName()) . strtoupper($this->model->getPrimaryKeyName()) . " ";
                    } else if ($this->getVendor() == self::POSTGRESS) {
                        $sqlLooping .= " ISREVIEW = CASE icommon." . strtoupper($this->model->getTableName()) . strtoupper($this->model->getPrimaryKeyName()) . " ";
                    } else {
                        echo json_encode(array("success" => false, "message" => $this->systemString->getNonSupportedDatabase()));
                        exit();
                    }
                    for ($i = 0; $i < $loop; $i++) {
                        $sqlLooping .= "
                         WHEN '" . $this->model->getRaceId($i, 'array') . "'
                         THEN '" . $this->model->getIsReview($i, 'array') . "'";
                    }
                    $sqlLooping .= " END,";
                }
                if ($this->model->getIsPostTotal() > 0) {
                    if ($this->getVendor() == self::MYSQL) {
                        $sqlLooping .= " `isPost` = CASE `icommon`.`" . $this->model->getTableName() . "`.`" . $this->model->getPrimaryKeyName() . "`";
                    } else if ($this->getVendor() == self::MSSQL) {
                        $sqlLooping .= "  [isPost] = CASE [icommon].[" . $this->model->getTableName() . "].[" . $this->model->getPrimaryKeyName() . "]";
                    } else if ($this->getVendor() == self::ORACLE) {
                        $sqlLooping .= " ISPOST = CASE icommon." . strtoupper($this->model->getTableName()) . strtoupper($this->model->getPrimaryKeyName()) . " ";
                    } else if ($this->getVendor() == self::DB2) {
                        $sqlLooping .= "  ISPOST = CASE icommon." . strtoupper($this->model->getTableName()) . strtoupper($this->model->getPrimaryKeyName()) . " ";
                    } else if ($this->getVendor() == self::POSTGRESS) {
                        $sqlLooping .= " ISPOST = CASE icommon." . strtoupper($this->model->getTableName()) . strtoupper($this->model->getPrimaryKeyName()) . " ";
                    } else {
                        echo json_encode(array("success" => false, "message" => $this->systemString->getNonSupportedDatabase()));
                        exit();
                    }
                    for ($i = 0; $i < $loop; $i++) {
                        $sqlLooping .= "
                         WHEN '" . $this->model->getRaceId($i, 'array') . "'
                         THEN '" . $this->model->getIsPost($i, 'array') . "'";
                    }
                    $sqlLooping .= " END,";
                }
                if ($this->model->getIsApprovedTotal() > 0) {
                    if ($this->getVendor() == self::MYSQL) {
                        $sqlLooping .= " `isApproved` = CASE `icommon`.`" . $this->model->getTableName() . "`.`" . $this->model->getPrimaryKeyName() . "`";
                    } else if ($this->getVendor() == self::MSSQL) {
                        $sqlLooping .= "  [isApproved] = CASE [icommon].[" . $this->model->getTableName() . "].[" . $this->model->getPrimaryKeyName() . "]";
                    } else if ($this->getVendor() == self::ORACLE) {
                        $sqlLooping .= " ISAPPROVED = CASE icommon." . strtoupper($this->model->getTableName()) . strtoupper($this->model->getPrimaryKeyName()) . " ";
                    } else if ($this->getVendor() == self::DB2) {
                        $sqlLooping .= "  ISAPPROVED = CASE icommon." . strtoupper($this->model->getTableName()) . strtoupper($this->model->getPrimaryKeyName()) . " ";
                    } else if ($this->getVendor() == self::POSTGRESS) {
                        $sqlLooping .= " ISAPPROVED = CASE icommon." . strtoupper($this->model->getTableName()) . strtoupper($this->model->getPrimaryKeyName()) . " ";
                    } else {
                        echo json_encode(array("success" => false, "message" => $this->systemString->getNonSupportedDatabase()));
                        exit();
                    }
                    for ($i = 0; $i < $loop; $i++) {
                        $sqlLooping .= "
                         WHEN '" . $this->model->getRaceId($i, 'array') . "'
                         THEN '" . $this->model->getIsApproved($i, 'array') . "'";
                    }
                    $sqlLooping .= " END,";
                }
            } else {
                if ($this->model->getIsDeleteTotal() > 0) {
                    if ($this->getVendor() == self::MYSQL) {
                        $sqlLooping .=" `isDelete` = CASE `icommon`.`" . $this->model->getTableName() . "`.`" . $this->model->getPrimaryKeyName() . "`";
                    } else if ($this->getVendor() == self::MSSQL) {
                        $sqlLooping .= "  [isDelete] = CASE [icommon].[" . $this->model->getTableName() . "].[" . $this->model->getPrimaryKeyName() . "]";
                    } else if ($this->getVendor() == self::ORACLE) {
                        $sqlLooping .= " ISDELETE = CASE icommon." . strtoupper($this->model->getTableName()) . strtoupper($this->model->getPrimaryKeyName()) . " ";
                    } else if ($this->getVendor() == self::DB2) {
                        $sqlLooping .= " ISDELETE = CASE icommon." . strtoupper($this->model->getTableName()) . strtoupper($this->model->getPrimaryKeyName()) . " ";
                    } else if ($this->getVendor() == self::POSTGRESS) {
                        $sqlLooping .= " ISDELETE = CASE icommon." . strtoupper($this->model->getTableName()) . strtoupper($this->model->getPrimaryKeyName()) . " ";
                    } else {
                        echo json_encode(array("success" => false, "message" => $this->systemString->getNonSupportedDatabase()));
                        exit();
                    }
                    for ($i = 0; $i < $loop; $i++) {
                        $sqlLooping .= "
                         WHEN '" . $this->model->getRaceId($i, 'array') . "'
                         THEN '" . $this->model->getIsDelete($i, 'array') . "'";
                    }
                    $sqlLooping .= " END,";
                }
            }
        }
        $sql .= substr($sqlLooping, 0, - 1);
        if ($this->getVendor() == self::MYSQL) {
            $sql .= " 
			WHERE `" . $this->model->getPrimaryKeyName() . "` IN (" . $this->model->getPrimaryKeyAll() . ")";
        } else if ($this->getVendor() == self::MSSQL) {
            $sql .= " 
			WHERE [" . $this->model->getPrimaryKeyName() . "] IN (" . $this->model->getPrimaryKeyAll() . ")";
        } else if ($this->getVendor() == self::ORACLE) {
            $sql .= " 
			WHERE " . strtoupper($this->model->getPrimaryKeyName()) . "  IN (" . $this->model->getPrimaryKeyAll() . ")";
        } else if ($this->getVendor() == self::DB2) {
            $sql .= " 
			WHERE " . strtoupper($this->model->getPrimaryKeyName()) . "  IN (" . $this->model->getPrimaryKeyAll() . ")";
        } else if ($this->getVendor() == self::POSTGRESS) {
            $sql .= " 
			WHERE " . strtoupper($this->model->getPrimaryKeyName()) . "  IN (" . $this->model->getPrimaryKeyAll() . ")";
        } else {
            echo json_encode(array("success" => false, "message" => $this->systemString->getNonSupportedDatabase()));
            exit();
        }
        $this->q->update($sql);
        if ($this->q->execute == 'fail') {
            echo json_encode(array("success" => false, "message" => $this->q->responce));
            exit();
        }
        $this->q->commit();
        if ($this->getIsAdmin()) {
            $message = $this->systemString->getUpdateMessage();
        } else {
            $message = $this->systemString->getDeleteMessage();
        }
        $end = microtime(true);
        $time = $end - $start;
        echo json_encode(
                array("success" => true,
                    "message" => $message,
                    "time" => $time)
        );
        exit();
    }

    /**
     * To check if a key duplicate or not 
     */
    function duplicate() {
        header('Content-Type:application/json; charset=utf-8');
        $start = microtime(true);
        if ($this->getVendor() == self::MYSQL) {
            $sql = "SET NAMES utf8";
            $this->q->fast($sql);
        }
        if ($this->getVendor() == self::MYSQL) {
            $sql = " 
			SELECT	`raceCode` 
			FROM 	`icommon`.`race` 
			WHERE 	`race` 	= 	'" . $this->model->getRaceCode() . "' 
			AND		`isActive`				=	1";
        } else if ($this->getVendor() == self::MSSQL) {
            $sql = " 
			SELECT	[referenceNo] 
			FROM 	[icommon].[race] 
			WHERE 	[race] = 	'" . $this->model->getRaceCode() . "' 
			AND	[isActive]                  =	1";
        } else if ($this->getVendor() == self::ORACLE) {
            $sql = " 
			SELECT	REFERENCENO 
			FROM 	RACE 
			WHERE 	RACE	= 	'" . $this->model->getRaceCode() . "' 
			AND		ISACTIVE			=	1";
        }
        $this->q->read($sql);
        $total = 0;
        $total = $this->q->numberRows();
        if ($this->q->execute == 'fail') {
            echo json_encode(array("success" => false, "message" => $this->q->responce));
            exit();
        }
        if ($total > 0) {
            $row = $this->q->fetchArray();
            $end = microtime(true);
            $time = $end - $start;
            echo json_encode(
                    array("success" => true,
                        "total" => $total,
                        "message" => $this->systemString->getDuplicateMessage(),
                        "referenceNo" => $row ['referenceNo'],
                        "time" => $time));
            exit();
        } else {
            $end = microtime(true);
            $time = $end - $start;
            echo json_encode(
                    array("success" => true,
                        "total" => $total,
                        "message" => $this->systemString->getNonDuplicateMessage(),
                        "time" => $time));
            exit();
        }
    }

    function firstRecord($value) {
        return $this->recordSet->firstRecord($value);
    }

    function nextRecord($value, $primaryKeyValue) {
        return $this->recordSet->nextRecord($value, $primaryKeyValue);
    }

    function previousRecord($value, $primaryKeyValue) {
        return $this->recordSet->previousRecord($value, $primaryKeyValue);
    }

    function lastRecord($value) {
        return $this->recordSet->lastRecord($value);
    }

    /* (non-PHPdoc) 
     * @see config::excel() 
     */

    function excel() {
        header('Content-Type:application/json; charset=utf-8');
        $start = microtime(true);
        if ($this->getVendor() == self::MYSQL) {
            $sql = "SET NAMES utf8";
            $this->q->fast($sql);
        }
        if ($_SESSION ['start'] == 0) {
            $sql = str_replace("LIMIT", "", $_SESSION ['sql']);
            $sql = str_replace($_SESSION ['start'] . "," . $_SESSION ['limit'], "", $sql);
        } else {
            $sql = $_SESSION ['sql'];
        }
        $this->q->read($sql);
        if ($this->q->execute == 'fail') {
            echo json_encode(array("success" => false, "message" => $this->q->responce));
            exit();
        }
        $this->excel->setActiveSheetIndex(0);
        // check file exist or not and return response 
        $styleThinBlackBorderOutline = array('borders' => array('inside' => array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '000000')), 'outline' => array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '000000'))));
        // header all using  3 line  starting b 
        $this->excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(TRUE);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(TRUE);
        $this->excel->getActiveSheet()->setCellValue('B2', $this->title);
        $this->excel->getActiveSheet()->setCellValue('C2', '');
        $this->excel->getActiveSheet()->mergeCells('B2:C2');
        $this->excel->getActiveSheet()->setCellValue('B3', 'No');
        $this->excel->getActiveSheet()->setCellValue('C3', 'Penerangan');
        $this->excel->getActiveSheet()->getStyle('B2:C2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $this->excel->getActiveSheet()->getStyle('B2:C2')->getFill()->getStartColor()->setARGB('66BBFF');
        $this->excel->getActiveSheet()->getStyle('B3:C3')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $this->excel->getActiveSheet()->getStyle('B3:C3')->getFill()->getStartColor()->setARGB('66BBFF');
        // 
        $loopRow = 4;
        $i = 0;
        while (($row = $this->q->fetchAssoc()) == TRUE) {
            //	echo print_r($row); 
            $this->excel->getActiveSheet()->setCellValue('B' . $loopRow, ++$i);
            $this->excel->getActiveSheet()->setCellValue('C' . $loopRow, 'a' . $row ['religionDetailSampleDesc']);
            $loopRow++;
            $lastRow = 'C' . $loopRow;
        }
        $from = 'B2';
        $to = $lastRow;
        $formula = $from . ":" . $to;
        $this->excel->getActiveSheet()->getStyle($formula)->applyFromArray($styleThinBlackBorderOutline);
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');
        $filename = "race" . rand(0, 10000000) . ".xlsx";
        $path = $_SERVER ['DOCUMENT_ROOT'] . "/" . $this->application . "/basic/document/excel/" . $filename;
        $this->documentTrail->create_trail($this->leafId, $path, $filename);
        $objWriter->save($path);
        $file = fopen($path, 'r');
        if ($file) {
            $end = microtime(true);
            $time = $end - $start;
            echo json_encode(
                    array("success" => true,
                        "message" => $this->systemString->getFileGenerateMessage(),
                        "filename" => $filename,
                        "time" => $time));
            exit();
        } else {
            $end = microtime(true);
            $time = $end - $start;
            echo json_encode(
                    array("success" => false,
                        "message" => $this->systemString->getFileNotGenerateMessage(),
                        "time" => $time));
            exit();
        }
    }

}

$raceObject = new RaceClass ();
/**
 * crud -create,read,update,delete 
 * */
if (isset($_POST ['method'])) {
    if (isset($_POST['output'])) {
        /*
         *  Load the dynamic value 
         */
        $raceObject->setPageOutput('json');
        $raceObject->execute();
        /*
         *  Crud Operation (Create Read Update Delete/Destory) 
         */
        if ($_POST ['method'] == 'create') {
            $raceObject->create();
        }
        if ($_POST ['method'] == 'save') {
            $raceObject->update();
        }
        if ($_POST ['method'] == 'read') {
            $raceObject->read();
        }
        if ($_POST ['method'] == 'delete') {
            $raceObject->delete();
        }
        if ($_POST ['method'] == 'posting') {
            //	$raceObject->posting(); 
        }
        if ($_POST ['method'] == 'reverse') {
            //	$raceObject->delete(); 
        }
    }
}
if (isset($_GET ['method'])) {
    /*
     *  Initilize Value before load in the loader
     */
    if (isset($_GET ['leafId'])) {
        $raceObject->setLeafId($_GET ['leafId']);
    }
    /*
     * Admin Only
     */
    if (isset($_GET ['isAdmin'])) {
        $raceObject->setIsAdmin($_GET ['isAdmin']);
    }
    /**
     * Database Request
     */
    if (isset($_GET ['databaseRequest'])) {
        $raceObject->setRequestDatabase($_GET ['databaseRequest']);
    }
    /*
     *  Load the dynamic value
     */
    $raceObject->execute();
    if (isset($_GET ['field'])) {
        if ($_GET ['field'] == 'staffId') {
            $raceObject->staff();
        }
    }
    /*
     * Update Status of The Table. Admin Level Only 
     */
    if ($_GET ['method'] == 'updateStatus') {
        $raceObject->updateStatus();
    }
    /*
     *  Checking Any Duplication  Key 
     */
    if (isset($_GET ['raceCode'])) {
        if (strlen($_GET ['raceCode']) > 0) {
            $raceObject->duplicate();
        }
    }
    if ($_GET ['method'] == 'dataNavigationRequest') {
        if ($_GET ['dataNavigation'] == 'firstRecord') {
            $raceObject->firstRecord('json');
        }
        if ($_GET ['dataNavigation'] == 'previousRecord') {
            $raceObject->previousRecord('json', 0);
        }
        if ($_GET ['dataNavigation'] == 'nextRecord') {
            $raceObject->nextRecord('json', 0);
        }
        if ($_GET ['dataNavigation'] == 'lastRecord') {
            $raceObject->lastRecord('json');
        }
    }
    /*
     * Excel Reporting  
     */
    if (isset($_GET ['mode'])) {
        if ($_GET ['mode'] == 'excel') {
            $raceObject->excel();
        }
    }
}
?>