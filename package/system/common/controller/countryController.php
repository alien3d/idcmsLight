<?php
namespace Core\System\Common\Country\Controller;

session_start();
require_once ("../../../../library/class/classAbstract.php");
require_once ("../../../../library/class/classRecordSet.php");
require_once ("../../../../library/class/classDate.php");
require_once ("../../../../library/class/classSystemString.php");
//require_once ("/../../../../class/classDocumentTrail.php");
//require_once ("../../document/model/documentModel.php");
require_once ("/../model/countryModel.php");
 
/**
 * this is country setting files.This sample template file for master record
 * @name IDCMS
 * @version 2
 * @author hafizan
 * @package sample
 * @subpackage country
 * @link http://www.idcms.org
 * @license http://www.gnu.org/copyleft/lesser.html LGPL
 */
class CountryClass extends \Core\ConfigClass {
 
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
 
    /**
     * Class Loader
     */
    function execute() {
        parent::__construct();
 
    //  $this--->x; bugs on generator .. just dummy
        $this->audit = 0;
         
        $this->log = 1;
 
        $this->model = new \Core\System\Common\Country\Model\CountryModel();
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
        $this->q->connect($this->getConnection(), $this->getUsername(), $this->getDatabase(), $this->getPassword());


        $this->systemString = new \Core\SystemString\SystemString();
        $this->systemString->setVendor($this->getVendor());
        $this->systemString->setLeafId($this->getLeafId());
        $this->systemString->execute();

        $this->recordSet = new \Core\Recordset\RecordSet();
        $this->recordSet->setTableName($this->model->getTableName());
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
        $sql="INSERT INTO `".$this->q->getFinancialDatabase()."`.`country` ( 
    `countryId`,
    `countrySequence`,
    `countryCode`,
    `countryCurrencyCode`,
    `countryCurrencyCodeDesc`,
    `countryDesc`,
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
null,
 '".$this->model->getCountrySequence()."',
 '".$this->model->getCountryCode()."',
 '".$this->model->getCountryCurrencyCode()."',
 '".$this->model->getCountryCurrencyCodeDesc()."',
 '".$this->model->getCountryDesc()."',
 '".$this->model->getIsDefault(0, 'single')."',
 '".$this->model->getIsNew(0, 'single')."',
 '".$this->model->getIsDraft(0, 'single')."',
 '".$this->model->getIsUpdate(0, 'single')."',
 '".$this->model->getIsDelete(0, 'single')."',
 '".$this->model->getIsActive(0, 'single')."',
 '".$this->model->getIsApproved(0, 'single')."',
 '".$this->model->getIsReview(0, 'single')."',
 '".$this->model->getIsPost(0, 'single')."',
 '".$this->model->getExecuteBy()."',
 ".$this->model->getExecuteTime()."
 );";
} else if ($this->getVendor() == self::MSSQL) {
        $sql="INSERT INTO [".$this->q->getFinancialDatabase()."].[country] (
    [countryId],
    [countrySequence],
    [countryCode],
    [countryCurrencyCode],
    [countryCurrencyCodeDesc],
    [countryDesc],
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
null,
 '".$this->model->getCountrySequence()."',
 '".$this->model->getCountryCode()."',
 '".$this->model->getCountryCurrencyCode()."',
 '".$this->model->getCountryCurrencyCodeDesc()."',
 '".$this->model->getCountryDesc()."',
 '".$this->model->getIsDefault(0, 'single')."',
 '".$this->model->getIsNew(0, 'single')."',
 '".$this->model->getIsDraft(0, 'single')."',
 '".$this->model->getIsUpdate(0, 'single')."',
 '".$this->model->getIsDelete(0, 'single')."',
 '".$this->model->getIsActive(0, 'single')."',
 '".$this->model->getIsApproved(0, 'single')."',
 '".$this->model->getIsReview(0, 'single')."',
 '".$this->model->getIsPost(0, 'single')."',
 '".$this->model->getExecuteBy()."',
 ".$this->model->getExecuteTime()."
 );";
} else if ($this->getVendor() == self::ORACLE) {
        $sql="INSERT INTO   COUNTRY ( 
    COUNTRYID,
    COUNTRYSEQUENCE,
    COUNTRYCODE,
    COUNTRYCURRENCYCODE,
    COUNTRYCURRENCYCODEDESC,
    COUNTRYDESC,
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
null,
 '".$this->model->getCountrySequence()."',
 '".$this->model->getCountryCode()."',
 '".$this->model->getCountryCurrencyCode()."',
 '".$this->model->getCountryCurrencyCodeDesc()."',
 '".$this->model->getCountryDesc()."',
 '".$this->model->getIsDefault(0, 'single')."',
 '".$this->model->getIsNew(0, 'single')."',
 '".$this->model->getIsDraft(0, 'single')."',
 '".$this->model->getIsUpdate(0, 'single')."',
 '".$this->model->getIsDelete(0, 'single')."',
 '".$this->model->getIsActive(0, 'single')."',
 '".$this->model->getIsApproved(0, 'single')."',
 '".$this->model->getIsReview(0, 'single')."',
 '".$this->model->getIsPost(0, 'single')."',
 '".$this->model->getExecuteBy()."',
 ".$this->model->getExecuteTime()."
 );";
} else if ($this->getVendor() == self::DB2) {
        $sql="INSERT INTO   COUNTRY ( 
    COUNTRYID,
    COUNTRYSEQUENCE,
    COUNTRYCODE,
    COUNTRYCURRENCYCODE,
    COUNTRYCURRENCYCODEDESC,
    COUNTRYDESC,
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
null,
 '".$this->model->getCountrySequence()."',
 '".$this->model->getCountryCode()."',
 '".$this->model->getCountryCurrencyCode()."',
 '".$this->model->getCountryCurrencyCodeDesc()."',
 '".$this->model->getCountryDesc()."',
 '".$this->model->getIsDefault(0, 'single')."',
 '".$this->model->getIsNew(0, 'single')."',
 '".$this->model->getIsDraft(0, 'single')."',
 '".$this->model->getIsUpdate(0, 'single')."',
 '".$this->model->getIsDelete(0, 'single')."',
 '".$this->model->getIsActive(0, 'single')."',
 '".$this->model->getIsApproved(0, 'single')."',
 '".$this->model->getIsReview(0, 'single')."',
 '".$this->model->getIsPost(0, 'single')."',
 '".$this->model->getExecuteBy()."',
 ".$this->model->getExecuteTime()."
 );";
} else if ($this->getVendor() == self::POSTGRESS) {
        $sql="INSERT INTO   COUNTRY ( 
    COUNTRYID,
    COUNTRYSEQUENCE,
    COUNTRYCODE,
    COUNTRYCURRENCYCODE,
    COUNTRYCURRENCYCODEDESC,
    COUNTRYDESC,
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
null,
 '".$this->model->getCountrySequence()."',
 '".$this->model->getCountryCode()."',
 '".$this->model->getCountryCurrencyCode()."',
 '".$this->model->getCountryCurrencyCodeDesc()."',
 '".$this->model->getCountryDesc()."',
 '".$this->model->getIsDefault(0, 'single')."',
 '".$this->model->getIsNew(0, 'single')."',
 '".$this->model->getIsDraft(0, 'single')."',
 '".$this->model->getIsUpdate(0, 'single')."',
 '".$this->model->getIsDelete(0, 'single')."',
 '".$this->model->getIsActive(0, 'single')."',
 '".$this->model->getIsApproved(0, 'single')."',
 '".$this->model->getIsReview(0, 'single')."',
 '".$this->model->getIsPost(0, 'single')."',
 '".$this->model->getExecuteBy()."',
 ".$this->model->getExecuteTime()."
 );";
 
        }$this->q->create($sql);
        $countryId = $this->q->lastInsertId();
        if ($this->q->execute == 'fail') {
            echo json_encode(array("success" => false, "message" => $this->q->responce));
            exit();
        }
        $this->q->commit();
        $end = microtime(true);
        $time = $end - $start;
        echo json_encode(
        array(  "success" => true,
                    "message" => $this->systemString->getCreateMessage(), 
                    "countryId" => $countryId,
                    "time"=>$time));
        exit();
    }
 
    /* (non-PHPdoc)
     * @see config::read()
     */
 
    public function read() {
        header('Content-Type:application/json; charset=utf-8');
        $start = microtime(true);
        if ($this->getIsAdmin() == 0) {
            if ($this->q->vendor == self::MYSQL) {
                $this->auditFilter = "   `country`.`isActive`        =   1   ";
            } else if ($this->q->vendor == self::MSSQL) {
                $this->auditFilter = "   [country].[isActive]        =   1   ";
            } else if ($this->q->vendor == self::ORACLE) {
                $this->auditFilter = "   COUNTRY.ISACTIVE    =   1   ";
            }
        } else if ($this->getIsAdmin() == 1) {
            if ($this->getVendor() == self::MYSQL) {
                $this->auditFilter = "   1   =   1   ";
            } else if ($this->q->vendor == self::MSSQL) {
                $this->auditFilter = "   1   =   1   ";
            } else if ($this->q->vendor == self::ORACLE) {
                $this->auditFilter = "   1   =   1   ";
            }
        }
 
 
        if ($this->getVendor() == self::MYSQL) {
            $sql = "SET NAMES utf8";
            $this->q->fast($sql);
        }
        $items = array();
        if ($this->getVendor() == self::MYSQL) {
$sql = "SELECT`country`.`countryId`,
`country`.`countrySequence`,
`country`.`countryCode`,
`country`.`countryCurrencyCode`,
`country`.`countryCurrencyCodeDesc`,
`country`.`countryDesc`,
`country`.`isDefault`,
`country`.`isNew`,
`country`.`isDraft`,
`country`.`isUpdate`,
`country`.`isDelete`,
`country`.`isActive`,
`country`.`isApproved`,
`country`.`isReview`,
`country`.`isPost`,
`country`.`executeBy`,
`country`.`executeTime`,
`staff`.`staffName`
            FROM    `".$this->q->getFinancialDatabase()."`.`country`
            JOIN    `".$this->q->getManagementDatabase()."`.`staff`
            ON      `country`.`executeBy` = `staff`.`staffId`
            WHERE       " . $this->auditFilter; 
if ($this->model->getCountryId(0, 'single')) {
                $sql .= " AND `" . $this->model->getTableName() . "`.`" . $this->model->getPrimaryKeyName() . "`='" . $this->model->getCountryId(0, 'single') . "'";
            }
             
        } else if ($this->getVendor() == self::MSSQL) {
$sql = "SELECT [country].[countryId],
[country].[countrySequence],
[country].[countryCode],
[country].[countryCurrencyCode],
[country].[countryCurrencyCodeDesc],
[country].[countryDesc],
[country].[isDefault],
[country].[isNew],
[country].[isDraft],
[country].[isUpdate],
[country].[isDelete],
[country].[isActive],
[country].[isApproved],
[country].[isReview],
[country].[isPost],
[country].[executeBy],
[country].[executeTime],
[staff].[staffName]
            FROM    [".$this->q->getFinancialDatabase()."].[country]
            JOIN        [".$this->q->getManagementDatabase()."].[staff]
            ON      [country].[executeBy] = [staff].[staffId]
            WHERE       " . $this->auditFilter; 
if ($this->model->getCountryId(0, 'single')) {
                $sql .= " AND [" . $this->model->getTableName() . "].[" . $this->model->getPrimaryKeyName() . "]        =   '" . $this->model->getCountryId(0, 'single') . "'";
            }
             
        } else if ($this->getVendor() == self::ORACLE) {
$sql = "SELECT COUNTRY.COUNTRYID,
 COUNTRY.COUNTRYSEQUENCE,
 COUNTRY.COUNTRYCODE,
 COUNTRY.COUNTRYCURRENCYCODE,
 COUNTRY.COUNTRYCURRENCYCODEDESC,
 COUNTRY.COUNTRYDESC,
 COUNTRY.ISDEFAULT,
 COUNTRY.ISNEW,
 COUNTRY.ISDRAFT,
 COUNTRY.ISUPDATE,
 COUNTRY.ISDELETE,
 COUNTRY.ISACTIVE,
 COUNTRY.ISAPPROVED,
 COUNTRY.ISREVIEW,
 COUNTRY.ISPOST,
 COUNTRY.EXECUTEBY,
 COUNTRY.EXECUTETIME,
STAFF.STAFFNAME
            FROM    COUNTRY
            JOIN        STAFF
            ON      COUNTRY.EXECUTEBY = STAFF.STAFFID
            WHERE       " . $this->auditFilter; 
if ($this->model->getCountryId(0, 'single')) {
                $sql .= " AND " . strtoupper($this->model->getTableName())  . strtoupper($this->model->getPrimaryKeyName()) . "='" . $this->model->getCountryId(0, 'single') . "'";
            }
             
        } else if ($this->getVendor() == self::DB2) {
$sql = "SELECT COUNTRY.COUNTRYID,
 COUNTRY.COUNTRYSEQUENCE,
 COUNTRY.COUNTRYCODE,
 COUNTRY.COUNTRYCURRENCYCODE,
 COUNTRY.COUNTRYCURRENCYCODEDESC,
 COUNTRY.COUNTRYDESC,
 COUNTRY.ISDEFAULT,
 COUNTRY.ISNEW,
 COUNTRY.ISDRAFT,
 COUNTRY.ISUPDATE,
 COUNTRY.ISDELETE,
 COUNTRY.ISACTIVE,
 COUNTRY.ISAPPROVED,
 COUNTRY.ISREVIEW,
 COUNTRY.ISPOST,
 COUNTRY.EXECUTEBY,
 COUNTRY.EXECUTETIME,
STAFF.STAFFNAME
            FROM    COUNTRY
            JOIN        STAFF
            ON      COUNTRY.EXECUTEBY = STAFF.STAFFID
            WHERE       " . $this->auditFilter; 
if ($this->model->getCountryId(0, 'single')) {
                $sql .= " AND " . strtoupper($this->model->getTableName())  . strtoupper($this->model->getPrimaryKeyName()) . "='" . $this->model->getCountryId(0, 'single') . "'";
            }
             
        } else if ($this->getVendor() == self::POSTGRESS) {
$sql = "SELECT COUNTRY.COUNTRYID,
 COUNTRY.COUNTRYSEQUENCE,
 COUNTRY.COUNTRYCODE,
 COUNTRY.COUNTRYCURRENCYCODE,
 COUNTRY.COUNTRYCURRENCYCODEDESC,
 COUNTRY.COUNTRYDESC,
 COUNTRY.ISDEFAULT,
 COUNTRY.ISNEW,
 COUNTRY.ISDRAFT,
 COUNTRY.ISUPDATE,
 COUNTRY.ISDELETE,
 COUNTRY.ISACTIVE,
 COUNTRY.ISAPPROVED,
 COUNTRY.ISREVIEW,
 COUNTRY.ISPOST,
 COUNTRY.EXECUTEBY,
 COUNTRY.EXECUTETIME,
STAFF.STAFFNAME
            FROM    COUNTRY
            JOIN        STAFF
            ON      COUNTRY.EXECUTEBY = STAFF.STAFFID
            WHERE       " . $this->auditFilter; 
if ($this->model->getCountryId(0, 'single')) {
                $sql .= " AND " . strtoupper($this->model->getTableName())  . strtoupper($this->model->getPrimaryKeyName()) . "='" . $this->model->getCountryId(0, 'single') . "'";
            }
             
        }else {
            echo json_encode(array("success" => false, "message" => $this->systemString->getNonSupportedDatabase()));
            exit();
        }
        /**
         * filter column based on first character
         */
        if($this->getCharacterQuery()){
            if($this->q->vendor==self::MYSQL){
                $sql.=" AND `".$this->model->getTableName()."`.`".$this->model->getFilterCharacter()."` like '".$this->getCharacterQuery()."%'";
            } else if($this->q->vendor==self::MSSQL){
                $sql.=" AND [".$this->model->getTableName()."].[".$this->model->getFilterCharacter()."] like '".$this->getCharacterQuery()."%'";
            } else if ($this->q->vendor==self::ORACLE){
                $sql.=" AND ".strtoupper($this->model->getTableName()).".".strtoupper($this->model->getFilterCharacter())." = '".$this->getCharacterQuery()."'";
            } else if ($this->q->vendor==self::DB2){
                $sql.=" AND ".strtoupper($this->model->getTableName()).".".strtoupper($this->model->getFilterCharacter())." = '".$this->getCharacterQuery()."'";
            } else if ($this->q->vendor==self::POSTGRESS){
                $sql.=" AND ".strtoupper($this->model->getTableName()).".".strtoupper($this->model->getFilterCharacter())." = '".$this->getCharacterQuery()."'";
            }
        }
        /**
         * filter column based on Range Of Date
         * Example Day,Week,Month,Year
         */
        if($this->getDateRangeStartQuery()){
            $sql.=$this->q->dateFilter($sql, $this->model->getTableName(),$this->model->getFilterDate(),$this->getDateRangeStartQuery(),$this->getDateRangeEndQuery(),$this->getDateRangeTypeQuery());
        }
        /**
         * filter column don't want to filter.Example may contain  sensetive information or unwanted to be search.
         * E.g  $filterArray=array('`leaf`.`leafId`');
         * @variables $filterArray;
         */
        $filterArray = null;
        $filterArray = array('countryId');
        /**
         * filter table
         * @variables $tableArray
         */
        $tableArray = null;
        $tableArray = array('country');
        if ($this->getFieldQuery()) {
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
        //  echo json_encode(array(
        //   "success" => false,
        //   "message" => $this->q->realEscapeString($sql)
        //  ));
        //  exit();
        //}
        // end of optional debugger
        $this->q->read($sql);
        if ($this->q->execute == 'fail') {
            echo json_encode(array("success" => false, "message" => $this->q->responce));
            exit();
        }
        $total = $this->q->numberRows();
        if ($this->getOrder() && $this->getSortField()) {
            if ($this->getVendor() == self::MYSQL) {
                $sql .= "   ORDER BY `" . $this->getSortField() . "` " . $this->getOrder() . " ";
            } else if ($this->getVendor() == self::MSSQL) {
                $sql .= "   ORDER BY [" . $this->getSortField() . "] " . $this->getOrder() . " ";
            } else if ($this->getVendor() == self::ORACLE) {
                $sql .= "   ORDER BY " . strtoupper($this->getSortField()) . " " . strtoupper($this->getOrder()) . " ";
            }
        }
        $_SESSION ['sql'] = $sql; // push to session so can make report via excel and pdf
        $_SESSION ['start'] = $this->getStart();
        $_SESSION ['limit'] = $this->getLimit();
        if ($this->getStart() && $this->getLimit()) {
            // only mysql have limit
            if ($this->getVendor() == self::MYSQL) {
                $sql .= " LIMIT  " . $this->getStart() . "," . $this->getLimit() . " ";
            } else if ($this->getVendor() == self::MSSQL) {
                /**
                 * Sql Server and Oracle used row_number
                 * Parameterize Query We don't support
                 */
                $sql ="WITH [countryDerived] AS
                            (
                                SELECT [country].[countryId],
[country].[countrySequence],
[country].[countryCode],
[country].[countryCurrencyCode],
[country].[countryCurrencyCodeDesc],
[country].[countryDesc],
[country].[isDefault],
[country].[isNew],
[country].[isDraft],
[country].[isUpdate],
[country].[isDelete],
[country].[isActive],
[country].[isApproved],
[country].[isReview],
[country].[isPost],
[country].[executeBy],
[country].[executeTime],
[staff].[staffName],
ROW_NUMBER() OVER (ORDER BY [country].[countryId]) AS 'RowNumber'
 
                         
            FROM    [".$this->q->getFinancialDatabase()."].[country]
            JOIN        [".$this->q->getManagementDatabase()."].[staff]
            ON      [country].[executeBy] = [staff].[staffId]
            WHERE " . $this->auditFilter . $tempSql . $tempSql2 . "
                            )
                            SELECT      *
                            FROM        [countryDerived]
                            WHERE       [RowNumber]
                            BETWEEN " . ($this->getStart() + 1) . "
                            AND             " . ($this->getStart() + $this->getLimit()) . " ;";
} else if ($this->getVendor() == self::ORACLE) {
                /**
                 * Oracle using derived table also
                 */
                        $sql = "
                        SELECT *
                        FROM ( SELECT   a.*,
                                                rownum r
                        FROM (
SELECT COUNTRY.COUNTRYID,
 COUNTRY.COUNTRYSEQUENCE,
 COUNTRY.COUNTRYCODE,
 COUNTRY.COUNTRYCURRENCYCODE,
 COUNTRY.COUNTRYCURRENCYCODEDESC,
 COUNTRY.COUNTRYDESC,
 COUNTRY.ISDEFAULT,
 COUNTRY.ISNEW,
 COUNTRY.ISDRAFT,
 COUNTRY.ISUPDATE,
 COUNTRY.ISDELETE,
 COUNTRY.ISACTIVE,
 COUNTRY.ISAPPROVED,
 COUNTRY.ISREVIEW,
 COUNTRY.ISPOST,
 COUNTRY.EXECUTEBY,
 COUNTRY.EXECUTETIME,
STAFF.STAFFNAME
            FROM    COUNTRY
            JOIN        STAFF
            ON      COUNTRY.EXECUTEBY = STAFF.STAFFID
            WHERE       " . $this->auditFilter.  $tempSql . $tempSql2 . "
                                 ) a
                        where rownum <= '" . ($this->getStart() + $this->getLimit()) . "' )
                        where r >=  '" . ($this->getStart() + 1) . "'";} else {
                echo json_encode(array("success" => false, "message" => $this->systemString->getNonSupportedDatabase()));
                exit();
            }
        }
        /*
         *  Only Execute One Query
         */
        if (!($this->model->getCountryId(0, 'single'))) {
            $this->q->read($sql);
            if ($this->q->execute == 'fail') {
                echo json_encode(array("success" => false, "message" => $this->q->responce));
                exit();
            }
        }
        $items = array();
        while (($row = $this->q->fetchAssoc()) == TRUE) {
            $items [] = $row;
        }
        if ($this->model->getCountryId(0, 'single')) {
            $end = microtime(true);
            $time = $end - $start;
            $json_encode = json_encode(array(
                    'success' => true, 
                    'total' => $total, 
                    'message' => $this->systemString->getReadMessage(), 
                    'time' => $time, 
                    'firstRecord' => $this->firstRecord('value'), 
                    'previousRecord' => $this->previousRecord('value', $this->model->getCountryId(0, 'single')), 
                    'nextRecord' => $this->nextRecord('value', $this->model->getCountryId(0, 'single')), 
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
                'success' =>true, 
                'total' => $total, 
                'message' => $this->systemString->getReadMessage(), 
                'time' => $time, 
                'firstRecord' => $this->recordSet->firstRecord('value'), 
                'previousRecord' => $this->recordSet->previousRecord('value', $this->model->getCountryId(0, 'single')), 
                'nextRecord' => $this->recordSet->nextRecord('value', $this->model->getCountryId(0, 'single')), 
                'lastRecord' => $this->recordSet->lastRecord('value'),
            'data' => $items));
            exit();
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
        if ($this->getVendor() == self::MYSQL) { $sql = "
        SELECT  `" . $this->model->getPrimaryKeyName() . "`
        FROM    `".$this->q->getFinancialDatabase()."`.`" . $this->model->getTableName() . "`
        WHERE   `" . $this->model->getPrimaryKeyName() . "` = '" . $this->model->getCountryId(0, 'single') . "' ";
        } else if ($this->getVendor() == self::MSSQL) {
            $sql = "
            SELECT  [" . $this->model->getPrimaryKeyName() . "]
            FROM    [".$this->q->getFinancialDatabase()."].[" . $this->model->getTableName() . "]
            WHERE   [" . $this->model->getPrimaryKeyName() . "] = '" . $this->model->getCountryId(0, 'single') . "' ";
        } else if ($this->getVendor() == self::ORACLE) {
            $sql = "
        SELECT  " . strtoupper($this->model->getPrimaryKeyName()) . "
        FROM    " . strtoupper($this->model->getTableName()) . "
        WHERE   " . strtoupper($this->model->getPrimaryKeyName()) . " = '" . $this->model->getCountryId(0, 'single') . "' ";
        } else if ($this->getVendor() == self::DB2) {
            $sql = "
            SELECT  " . strtoupper($this->model->getPrimaryKeyName()) . "
            FROM    " . strtoupper($this->model->getTableName()) . "
            WHERE   " . strtoupper($this->model->getPrimaryKeyName()) . " = '" . $this->model->getCountryId(0, 'single') . "' ";
        } else if ($this->getVendor() == self::POSTGRESS) {
            $sql = "
            SELECT  " . strtoupper($this->model->getPrimaryKeyName()) . "
            FROM    " . strtoupper($this->model->getTableName()) . "
            WHERE   " . strtoupper($this->model->getPrimaryKeyName()) . " = '" . $this->model->getCountryId(0, 'single') . "' ";
        }
        $result = $this->q->fast($sql);
        $total = $this->q->numberRows($result, $sql);
        if ($total == 0) {
            echo json_encode(array("success" => false, "message" => $this->systemString->getRecordNotFoundMessage()));
            exit();
        } else {
            if ($this->getVendor() == self::MYSQL) {
$sql="UPDATE `".$this->q->getFinancialDatabase()."`.`country` SET 
 `countrySequence` = '".$this->model->getCountrySequence()."',
 `countryCode` = '".$this->model->getCountryCode()."',
 `countryCurrencyCode` = '".$this->model->getCountryCurrencyCode()."',
 `countryCurrencyCodeDesc` = '".$this->model->getCountryCurrencyCodeDesc()."',
 `countryDesc` = '".$this->model->getCountryDesc()."',
 `isDefault` = '".$this->model->getIsDefault('0','single')."',
 `isNew` = '".$this->model->getIsNew('0','single')."',
 `isDraft` = '".$this->model->getIsDraft('0','single')."',
 `isUpdate` = '".$this->model->getIsUpdate('0','single')."',
 `isDelete` = '".$this->model->getIsDelete('0','single')."',
 `isActive` = '".$this->model->getIsActive('0','single')."',
 `isApproved` = '".$this->model->getIsApproved('0','single')."',
 `isReview` = '".$this->model->getIsReview('0','single')."',
 `isPost` = '".$this->model->getIsPost('0','single')."',
 `executeBy` = '".$this->model->getExecuteBy('0','single')."',
 `executeTime` = ".$this->model->getExecuteTime()."
WHERE `countryId`='".$this->model->getCountryId('0','single')."'";
 
} else if ($this->getVendor() == self::MSSQL) {
$sql="UPDATE [".$this->q->getFinancialDatabase()."].[country] SET 
 [countrySequence] = '".$this->model->getCountrySequence()."',
 [countryCode] = '".$this->model->getCountryCode()."',
 [countryCurrencyCode] = '".$this->model->getCountryCurrencyCode()."',
 [countryCurrencyCodeDesc] = '".$this->model->getCountryCurrencyCodeDesc()."',
 [countryDesc] = '".$this->model->getCountryDesc()."',
 [isDefault] = '".$this->model->getIsDefault(0, 'single')."',
 [isNew] = '".$this->model->getIsNew(0, 'single')."',
 [isDraft] = '".$this->model->getIsDraft(0, 'single')."',
 [isUpdate] = '".$this->model->getIsUpdate(0, 'single')."',
 [isDelete] = '".$this->model->getIsDelete(0, 'single')."',
 [isActive] = '".$this->model->getIsActive(0, 'single')."',
 [isApproved] = '".$this->model->getIsApproved(0, 'single')."',
 [isReview] = '".$this->model->getIsReview(0, 'single')."',
 [isPost] = '".$this->model->getIsPost(0, 'single')."',
 [executeBy] = '".$this->model->getExecuteBy(0, 'single')."',
 [executeTime] = ".$this->model->getExecuteTime()."
WHERE [countryId]='".$this->model->getCountryId('0','single')."'";
 
} else if ($this->getVendor() == self::ORACLE) {
$sql="UPDATE `COUNTRY` SET
  COUNTRYSEQUENCE = '".$this->model->getCountrySequence()."',
 COUNTRYCODE = '".$this->model->getCountryCode()."',
 COUNTRYCURRENCYCODE = '".$this->model->getCountryCurrencyCode()."',
 COUNTRYCURRENCYCODEDESC = '".$this->model->getCountryCurrencyCodeDesc()."',
 COUNTRYDESC = '".$this->model->getCountryDesc()."',
 ISDEFAULT = '".$this->model->getIsDefault(0, 'single')."',
 ISNEW = '".$this->model->getIsNew(0, 'single')."',
 ISDRAFT = '".$this->model->getIsDraft(0, 'single')."',
 ISUPDATE = '".$this->model->getIsUpdate(0, 'single')."',
 ISDELETE = '".$this->model->getIsDelete(0, 'single')."',
 ISACTIVE = '".$this->model->getIsActive(0, 'single')."',
 ISAPPROVED = '".$this->model->getIsApproved(0, 'single')."',
 ISREVIEW = '".$this->model->getIsReview(0, 'single')."',
 ISPOST = '".$this->model->getIsPost(0, 'single')."',
 EXECUTEBY = '".$this->model->getExecuteBy(0, 'single')."',
 EXECUTETIME = ".$this->model->getExecuteTime()."
WHERE `COUNTRYID`='".$this->model->getCountryId('0','single')."'";
 
} else if ($this->getVendor() == self::DB2) {
$sql="UPDATE `COUNTRY` SET
  COUNTRYSEQUENCE = '".$this->model->getCountrySequence()."',
 COUNTRYCODE = '".$this->model->getCountryCode()."',
 COUNTRYCURRENCYCODE = '".$this->model->getCountryCurrencyCode()."',
 COUNTRYCURRENCYCODEDESC = '".$this->model->getCountryCurrencyCodeDesc()."',
 COUNTRYDESC = '".$this->model->getCountryDesc()."',
 ISDEFAULT = '".$this->model->getIsDefault(0, 'single')."',
 ISNEW = '".$this->model->getIsNew(0, 'single')."',
 ISDRAFT = '".$this->model->getIsDraft(0, 'single')."',
 ISUPDATE = '".$this->model->getIsUpdate(0, 'single')."',
 ISDELETE = '".$this->model->getIsDelete(0, 'single')."',
 ISACTIVE = '".$this->model->getIsActive(0, 'single')."',
 ISAPPROVED = '".$this->model->getIsApproved(0, 'single')."',
 ISREVIEW = '".$this->model->getIsReview(0, 'single')."',
 ISPOST = '".$this->model->getIsPost(0, 'single')."',
 EXECUTEBY = '".$this->model->getExecuteBy(0, 'single')."',
 EXECUTETIME = ".$this->model->getExecuteTime()."
WHERE `COUNTRYID`='".$this->model->getCountryId('0','single')."'";
 
} else if ($this->getVendor() == self::POSTGRESS) {
$sql="UPDATE `COUNTRY` SET
  COUNTRYSEQUENCE = '".$this->model->getCountrySequence()."',
 COUNTRYCODE = '".$this->model->getCountryCode()."',
 COUNTRYCURRENCYCODE = '".$this->model->getCountryCurrencyCode()."',
 COUNTRYCURRENCYCODEDESC = '".$this->model->getCountryCurrencyCodeDesc()."',
 COUNTRYDESC = '".$this->model->getCountryDesc()."',
 ISDEFAULT = '".$this->model->getIsDefault(0, 'single')."',
 ISNEW = '".$this->model->getIsNew(0, 'single')."',
 ISDRAFT = '".$this->model->getIsDraft(0, 'single')."',
 ISUPDATE = '".$this->model->getIsUpdate(0, 'single')."',
 ISDELETE = '".$this->model->getIsDelete(0, 'single')."',
 ISACTIVE = '".$this->model->getIsActive(0, 'single')."',
 ISAPPROVED = '".$this->model->getIsApproved(0, 'single')."',
 ISREVIEW = '".$this->model->getIsReview(0, 'single')."',
 ISPOST = '".$this->model->getIsPost(0, 'single')."',
 EXECUTEBY = '".$this->model->getExecuteBy(0, 'single')."',
 EXECUTETIME = ".$this->model->getExecuteTime()."
WHERE `COUNTRYID`='".$this->model->getCountryId('0','single')."'";
 
 
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
        array(  "success" =>true,
                    "message" => $this->systemString->getUpdateMessage(),
                    "time"=>$time));
        exit();
    }/* (non-PHPdoc)
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
        SELECT  `" . $this->model->getPrimaryKeyName() . "`
        FROM    `".$this->q->getFinancialDatabase()."`.`" . $this->model->getTableName() . "`
        WHERE   `" . $this->model->getPrimaryKeyName() . "` = '" . $this->model->getCountryId(0, 'single') . "' ";
        } else if ($this->getVendor() == self::MSSQL) {
            $sql = "
            SELECT  [" . $this->model->getPrimaryKeyName() . "]
            FROM    [".$this->q->getFinancialDatabase()."].[" . $this->model->getTableName() . "]
            WHERE   [" . $this->model->getPrimaryKeyName() . "] = '" . $this->model->getCountryId(0, 'single') . "' ";
        } else if ($this->getVendor() == self::ORACLE) {
            $sql = "
        SELECT  " . strtoupper($this->model->getPrimaryKeyName()) . "
        FROM    " . strtoupper($this->model->getTableName()) . "
        WHERE   " . strtoupper($this->model->getPrimaryKeyName()) . " = '" . $this->model->getCountryId(0, 'single') . "' ";
        } else if ($this->getVendor() == self::DB2) {
            $sql = "
            SELECT  " . strtoupper($this->model->getPrimaryKeyName()) . "
            FROM    " . strtoupper($this->model->getTableName()) . "
            WHERE   " . strtoupper($this->model->getPrimaryKeyName()) . " = '" . $this->model->getCountryId(0, 'single') . "' ";
        } else if ($this->getVendor() == self::POSTGRESS) {
            $sql = "
            SELECT  " . strtoupper($this->model->getPrimaryKeyName()) . "
            FROM    " . strtoupper($this->model->getTableName()) . "
            WHERE   " . strtoupper($this->model->getPrimaryKeyName()) . " = '" . $this->model->getCountryId(0, 'single') . "' ";
        }
        $result = $this->q->fast($sql);
        $total = $this->q->numberRows($result, $sql);
        if ($total == 0) {
            echo json_encode(array("success" => false, "message" => $this->systemString->getRecordNotFoundMessage()));
            exit();
        } else {
            if ($this->getVendor() == self::MYSQL) {
    $sql="      UPDATE  `".$this->q->getFinancialDatabase()."`.`country`
 
                    SET     `isDefault`             =   '" . $this->model->getIsDefault(0, 'single') . "',
                            `isNew`                 =   '" . $this->model->getIsNew(0, 'single') . "',
                            `isDraft`                   =   '" . $this->model->getIsDraft(0, 'single') . "',
                            `isUpdate`              =   '" . $this->model->getIsUpdate(0, 'single') . "',
                            `isDelete`                  =   '" . $this->model->getIsDelete(0, 'single') . "',
                            `isActive`                  =   '" . $this->model->getIsActive(0, 'single') . "',
                            `isApproved`            =   '" . $this->model->getIsApproved(0, 'single') . "',
                            `isReview`              =   '" . $this->model->getIsReview(0, 'single') . "',
                            `isPost`                    =   '" . $this->model->getIsPost(0, 'single') . "',
                            `executeBy`             =   '" . $this->model->getExecuteBy() . "',
                            `executeTime`           =   " . $this->model->getExecuteTime() . "
                WHERE   `countryId` =  '" . $this->model->getCountryId(0, 'single') . "'";
} else if ($this->getVendor() == self::MSSQL) {
            $sql="      
                UPDATE  [".$this->q->getFinancialDatabase()."].[country]
                SET             [isDefault]                 =   '" . $this->model->getIsDefault(0, 'single') . "',
                                [isNew]                     =   '" . $this->model->getIsNew(0, 'single') . "',
                                [isDraft]                   =   '" . $this->model->getIsDraft(0, 'single') . "',
                                [isUpdate]                  =   '" . $this->model->getIsUpdate(0, 'single') . "',
                                [isDelete]                  =   '" . $this->model->getIsDelete(0, 'single') . "',
                                [isActive]                  =   '" . $this->model->getIsActive(0, 'single') . "',
                                [isApproved]                =   '" . $this->model->getIsApproved(0, 'single') . "',
                                [isReview]                  =   '" . $this->model->getIsReview(0, 'single') . "',
                                [isPost]                        =   '" . $this->model->getIsPost(0, 'single') . "',
                                [executeBy]             =   '" . $this->model->getExecuteBy() . "',
                                [executeTime]           =   " . $this->model->getExecuteTime() . "
                WHERE       [countryId] =  '" . $this->model->getCountryId(0, 'single') . "'";
} else if ($this->getVendor() == self::ORACLE) {
    $sql=" 
                UPDATE  COUNTRY
                SET     ISDEFAULT       =   '" . $this->model->getIsDefault(0, 'single') . "',
                        ISNEW           =   '" . $this->model->getIsNew(0, 'single') . "',
                        ISDRAFT         =   '" . $this->model->getIsDraft(0, 'single') ."',
                        ISUPDATE        =   '" . $this->model->getIsUpdate(0, 'single') . "',
                        ISDELETE        =   '" . $this->model->getIsDelete(0, 'single') . "',
                        ISACTIVE        =   '" . $this->model->getIsActive(0, 'single') . "',
                        ISAPPROVED      =   '" . $this->model->getIsApproved(0, 'single') ."',
                        ISREVIEW        =   '" .$this->model->getIsReview(0, 'single') . "',
                        ISPOST          =   '" . $this->model->getIsPost(0, 'single') ."',
                        EXECUTEBY       =   '" . $this->model->getExecuteBy() ."',
                        EXECUTETIME     =   " . $this->model->getExecuteTime() . "
                WHERE   `COUNTRY`   =  '" . $this->model->getCountryId(0, 'single') . "'";
} else if ($this->getVendor() == self::DB2) {
    $sql=" 
                UPDATE  COUNTRY
                SET     ISDEFAULT       =   '" . $this->model->getIsDefault(0, 'single') . "',
                        ISNEW           =   '" . $this->model->getIsNew(0, 'single') . "',
                        ISDRAFT         =   '" . $this->model->getIsDraft(0, 'single') ."',
                        ISUPDATE        =   '" . $this->model->getIsUpdate(0, 'single') . "',
                        ISDELETE        =   '" . $this->model->getIsDelete(0, 'single') . "',
                        ISACTIVE        =   '" . $this->model->getIsActive(0, 'single') . "',
                        ISAPPROVED      =   '" . $this->model->getIsApproved(0, 'single') ."',
                        ISREVIEW        =   '" .$this->model->getIsReview(0, 'single') . "',
                        ISPOST          =   '" . $this->model->getIsPost(0, 'single') ."',
                        EXECUTEBY       =   '" . $this->model->getExecuteBy() ."',
                        EXECUTETIME     =   " . $this->model->getExecuteTime() . "
                WHERE   `COUNTRY`   =  '" . $this->model->getCountryId(0, 'single') . "'";
} else if ($this->getVendor() == self::POSTGRESS) {
    $sql=" 
                UPDATE  COUNTRY
                SET     ISDEFAULT       =   '" . $this->model->getIsDefault(0, 'single') . "',
                        ISNEW           =   '" . $this->model->getIsNew(0, 'single') . "',
                        ISDRAFT         =   '" . $this->model->getIsDraft(0, 'single') ."',
                        ISUPDATE        =   '" . $this->model->getIsUpdate(0, 'single') . "',
                        ISDELETE        =   '" . $this->model->getIsDelete(0, 'single') . "',
                        ISACTIVE        =   '" . $this->model->getIsActive(0, 'single') . "',
                        ISAPPROVED      =   '" . $this->model->getIsApproved(0, 'single') ."',
                        ISREVIEW        =   '" .$this->model->getIsReview(0, 'single') . "',
                        ISPOST          =   '" . $this->model->getIsPost(0, 'single') ."',
                        EXECUTEBY       =   '" . $this->model->getExecuteBy() ."',
                        EXECUTETIME     =   " . $this->model->getExecuteTime() . "
                WHERE   `COUNTRY`   =  '" . $this->model->getCountryId(0, 'single') . "'";
 
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
        array(  "success" => true,
                    "message" => $this->systemString->getDeleteMessage(),
                    "time"=>$time));
        exit();
    }/**
     * To Update flag Status
     */
    function updateStatus() {
        header('Content-Type:application/json; charset=utf-8');
        $start = microtime(true);
        if ($this->getVendor() == self::MYSQL) {
 
            $sql = "SET NAMES utf8";
            $this->q->fast($sql);
        }
        $this->q->start();
        $loop = $this->model->getTotal();
        if ($this->getVendor() == self::MYSQL) {
            $sql = "
            UPDATE `".$this->q->getFinancialDatabase()."`.`" . $this->model->getTableName() . "`
            SET";
        } else if ($this->getVendor() == self::MSSQL) {
            $sql = "
            UPDATE  [".$this->q->getFinancialDatabase()."].[" . $this->model->getTableName() . "]
            SET     ";
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
        }/**
         * System Validation Checking
         * @var $access
         */
        $access = array("isDefault", "isNew", "isDraft", "isUpdate", "isDelete", "isActive", "isApproved", "isReview", "isPost");
                $accessClear = array("isDefault", "isNew", "isDraft", "isUpdate",  "isActive", "isApproved", "isReview", "isPost");
         
        foreach ($access as $systemCheck) {
 
            switch ($systemCheck) {
                case 'isDefault' :
                    for ($i = 0; $i < $loop; $i++) {
                        if (strlen($this->model->getIsDefault($i, 'array')) > 0) {
                            if ($this->getVendor() == self::MYSQL) {
                                $sqlLooping .= " `" . $systemCheck . "` = CASE `".$this->q->getFinancialDatabase()."`.`".$this->model->getTableName()."`.`" . $this->model->getPrimaryKeyName() . "`";
                            } else if ($this->getVendor() == self::MSSQL) {
                                $sqlLooping .= "  [" . $systemCheck . "] = CASE [".$this->q->getFinancialDatabase()."].[".$this->model->getTableName()."].[" . $this->model->getPrimaryKeyName() . "]";
                            } else if ($this->getVendor() == self::ORACLE) {
                                $sqlLooping .= "    " . strtoupper($systemCheck) . " = CASE ".$this->q->getFinancialDatabase()."." . strtoupper($this->model->getTableName()).strtoupper($this->model->getPrimaryKeyName()) . " ";
                            } else if ($this->getVendor() == self::DB2) {
                                $sqlLooping .= "    " . strtoupper($systemCheck) . " = CASE ".$this->q->getFinancialDatabase()."." . strtoupper($this->model->getTableName()).strtoupper($this->model->getPrimaryKeyName()) . " ";
                            } else if ($this->getVendor() == self::POSTGRESS) {
                                $sqlLooping .= "    " . strtoupper($systemCheck) . " = CASE ".$this->q->getFinancialDatabase()."." . strtoupper($this->model->getTableName()).strtoupper($this->model->getPrimaryKeyName()) . " ";
                            } else {
                                echo json_encode(array("success" => false, "message" => $this->systemString->getNonSupportedDatabase()));
                                exit();
                            }
                            $sqlLooping .= "
                            WHEN '" . $this->model->getCountryId($i, 'array') . "'
                            THEN '" . $this->model->getIsDefault($i, 'array') . "'";
                            $sqlLooping .= " END,";
                        }
                    }
                    break;
                case 'isNew' :
                    for ($i = 0; $i < $loop; $i++) {
                        if (strlen($this->model->getIsNew($i, 'array')) > 0) {
                            if ($this->getVendor() == self::MYSQL) {
                                $sqlLooping .= " `" . $systemCheck . "` = CASE `".$this->q->getFinancialDatabase()."`.`".$this->model->getTableName()."`.`" . $this->model->getPrimaryKeyName() . "`";
                            } else if ($this->getVendor() == self::MSSQL) {
                                $sqlLooping .= "  [" . $systemCheck . "] = CASE [".$this->q->getFinancialDatabase()."].[".$this->model->getTableName()."].[" . $this->model->getPrimaryKeyName() . "]";
                            } else if ($this->getVendor() == self::ORACLE) {
                                $sqlLooping .= "    " . strtoupper($systemCheck) . " = CASE ".$this->q->getFinancialDatabase()."." . strtoupper($this->model->getTableName()).strtoupper($this->model->getPrimaryKeyName()) . " ";
                            } else if ($this->getVendor() == self::DB2) {
                                $sqlLooping .= "    " . strtoupper($systemCheck) . " = CASE ".$this->q->getFinancialDatabase()."." . strtoupper($this->model->getTableName()).strtoupper($this->model->getPrimaryKeyName()) . " ";
                            } else if ($this->getVendor() == self::POSTGRESS) {
                                $sqlLooping .= "    " . strtoupper($systemCheck) . " = CASE ".$this->q->getFinancialDatabase()."." . strtoupper($this->model->getTableName()).strtoupper($this->model->getPrimaryKeyName()) . " ";
                            } else {
                                echo json_encode(array("success" => false, "message" => $this->systemString->getNonSupportedDatabase()));
                                exit();
                            }
                            $sqlLooping .= "
                            WHEN '" . $this->model->getCountryId($i, 'array') . "'
                            THEN '" . $this->model->getIsNew($i, 'array') . "'";
                            $sqlLooping .= " END,";
                        }
                    }
                    break;
                case 'isDraft' :
                    for ($i = 0; $i < $loop; $i++) {
                        if (strlen($this->model->getIsDraft($i, 'array')) > 0) {
                            if ($this->getVendor() == self::MYSQL) {
                                $sqlLooping .= " `" . $systemCheck . "` = CASE `".$this->q->getFinancialDatabase()."`.`".$this->model->getTableName()."`.`" . $this->model->getPrimaryKeyName() . "`";
                            } else if ($this->getVendor() == self::MSSQL) {
                                $sqlLooping .= "  [" . $systemCheck . "] = CASE [".$this->q->getFinancialDatabase()."].[".$this->model->getTableName()."].[" . $this->model->getPrimaryKeyName() . "]";
                            } else if ($this->getVendor() == self::ORACLE) {
                                $sqlLooping .= "    " . strtoupper($systemCheck) . " = CASE ".$this->q->getFinancialDatabase()."." . strtoupper($this->model->getTableName()).strtoupper($this->model->getPrimaryKeyName()) . " ";
                            } else if ($this->getVendor() == self::DB2) {
                                $sqlLooping .= "    " . strtoupper($systemCheck) . " = CASE ".$this->q->getFinancialDatabase()."." . strtoupper($this->model->getTableName()).strtoupper($this->model->getPrimaryKeyName()) . " ";
                            } else if ($this->getVendor() == self::POSTGRESS) {
                                $sqlLooping .= "    " . strtoupper($systemCheck) . " = CASE ".$this->q->getFinancialDatabase()."." . strtoupper($this->model->getTableName()).strtoupper($this->model->getPrimaryKeyName()) . " ";
                            } else {
                                echo json_encode(array("success" => false, "message" => $this->systemString->getNonSupportedDatabase()));
                                exit();
                            }
                            $sqlLooping .= "
                            WHEN '" . $this->model->getCountryId($i, 'array') . "'
                            THEN '" . $this->model->getIsDraft($i, 'array') . "'";
                            $sqlLooping .= " END,";
                        }
                    }
                    break;
                case 'isUpdate' :
                    for ($i = 0; $i < $loop; $i++) {
                        if (strlen($this->model->getIsUpdate($i, 'array')) > 0) {
                            if ($this->getVendor() == self::MYSQL) {
                                $sqlLooping .= " `" . $systemCheck . "` = CASE `".$this->q->getFinancialDatabase()."`.`".$this->model->getTableName()."`.`" . $this->model->getPrimaryKeyName() . "`";
                            } else if ($this->getVendor() == self::MSSQL) {
                                $sqlLooping .= "  [" . $systemCheck . "] = CASE [".$this->q->getFinancialDatabase()."].[".$this->model->getTableName()."].[" . $this->model->getPrimaryKeyName() . "]";
                            } else if ($this->getVendor() == self::ORACLE) {
                                $sqlLooping .= "    " . strtoupper($systemCheck) . " = CASE ".$this->q->getFinancialDatabase()."." . strtoupper($this->model->getTableName()).strtoupper($this->model->getPrimaryKeyName()) . " ";
                            } else if ($this->getVendor() == self::DB2) {
                                $sqlLooping .= "    " . strtoupper($systemCheck) . " = CASE ".$this->q->getFinancialDatabase()."." . strtoupper($this->model->getTableName()).strtoupper($this->model->getPrimaryKeyName()) . " ";
                            } else if ($this->getVendor() == self::POSTGRESS) {
                                $sqlLooping .= "    " . strtoupper($systemCheck) . " = CASE ".$this->q->getFinancialDatabase()."." . strtoupper($this->model->getTableName()).strtoupper($this->model->getPrimaryKeyName()) . " ";
                            } else {
                                echo json_encode(array("success" => false, "message" => $this->systemString->getNonSupportedDatabase()));
                                exit();
                            }
                            $sqlLooping .= "
                            WHEN '" . $this->model->getCountryId($i, 'array') . "'
                            THEN '" . $this->model->getIsUpdate($i, 'array') . "'";
                            $sqlLooping .= " END,";
                        }
                    }
                    break;
                case 'isDelete' :
                    for ($i = 0; $i < $loop; $i++) {
                        if (strlen($this->model->getIsDelete($i, 'array')) > 0) {
                            if ($this->getVendor() == self::MYSQL) {
                                $sqlLooping .= " `" . $systemCheck . "` = CASE `".$this->q->getFinancialDatabase()."`.`".$this->model->getTableName()."`.`" . $this->model->getPrimaryKeyName() . "`";
                            } else if ($this->getVendor() == self::MSSQL) {
                                $sqlLooping .= "  [" . $systemCheck . "] = CASE [".$this->q->getFinancialDatabase()."].[".$this->model->getTableName()."].[" . $this->model->getPrimaryKeyName() . "]";
                            } else if ($this->getVendor() == self::ORACLE) {
                                $sqlLooping .= "    " . strtoupper($systemCheck) . " = CASE ".$this->q->getFinancialDatabase()."." . strtoupper($this->model->getTableName()).strtoupper($this->model->getPrimaryKeyName()) . " ";
                            } else if ($this->getVendor() == self::DB2) {
                                $sqlLooping .= "    " . strtoupper($systemCheck) . " = CASE ".$this->q->getFinancialDatabase()."." . strtoupper($this->model->getTableName()).strtoupper($this->model->getPrimaryKeyName()) . " ";
                            } else if ($this->getVendor() == self::POSTGRESS) {
                                $sqlLooping .= "    " . strtoupper($systemCheck) . " = CASE ".$this->q->getFinancialDatabase()."." . strtoupper($this->model->getTableName()).strtoupper($this->model->getPrimaryKeyName()) . " ";
                            } else {
                                echo json_encode(array("success" => false, "message" => $this->systemString->getNonSupportedDatabase()));
                                exit();
                            }
                            $sqlLooping .= "
                            WHEN '" . $this->model->getCountryId($i, 'array') . "'
                            THEN '" . $this->model->getIsDelete($i, 'array') . "'";
                            $sqlLooping .= " END,";
                            if(!$this->getIsAdmin()){
                                foreach ($accessClear as $clear){
                                    // update delete status = 1
                                    if ($this->getVendor() == self::MYSQL) {
                                        $sqlLooping .= " `" . $clear . "` = CASE `" . $this->model->getPrimaryKeyName() . "`";
                                    } else if ($this->getVendor() == self::MSSQL) {
                                        $sqlLooping .= "  [" . $clear. "] = CASE [" . $this->model->getPrimaryKeyName() . "]";
                                    } else if ($this->getVendor() == self::ORACLE) {
                                        $sqlLooping .= "    " . $clear . " = CASE " . strtoupper($this->model->getPrimaryKeyName()) . " ";
                                    } else if ($this->getVendor() == self::DB2) {
                                        $sqlLooping .= "    " . $clear . " = CASE " . strtoupper($this->model->getPrimaryKeyName()) . " ";
                                    } else if ($this->getVendor() == self::POSTGRESS) {
                                        $sqlLooping .= "    " .$clear . " = CASE " . strtoupper($this->model->getPrimaryKeyName()) . " ";
                                    } else {
                                        echo json_encode(array("success" => false, "message" => $this->systemString->getNonSupportedDatabase()));
                                        exit();
                                    }
                                    $sqlLooping .= "
                            WHEN '" . $this->model->getCountryId($i, 'array') . "'
                            THEN '0'";
                                    $sqlLooping .= " END,";
                                }
                                     
                            }
                        }
                    }
                    break;
                case 'isActive' :
                    for ($i = 0; $i < $loop; $i++) {
                        if (strlen($this->model->getIsActive($i, 'array')) > 0) {
                            if ($this->getVendor() == self::MYSQL) {
                                $sqlLooping .= " `" . $systemCheck . "` = CASE `".$this->q->getFinancialDatabase()."`.`".$this->model->getTableName()."`.`" . $this->model->getPrimaryKeyName() . "`";
                            } else if ($this->getVendor() == self::MSSQL) {
                                $sqlLooping .= "  [" . $systemCheck . "] = CASE [".$this->q->getFinancialDatabase()."].[".$this->model->getTableName()."].[" . $this->model->getPrimaryKeyName() . "]";
                            } else if ($this->getVendor() == self::ORACLE) {
                                $sqlLooping .= "    " . strtoupper($systemCheck) . " = CASE ".$this->q->getFinancialDatabase()."." . strtoupper($this->model->getTableName()).strtoupper($this->model->getPrimaryKeyName()) . " ";
                            } else if ($this->getVendor() == self::DB2) {
                                $sqlLooping .= "    " . strtoupper($systemCheck) . " = CASE ".$this->q->getFinancialDatabase()."." . strtoupper($this->model->getTableName()).strtoupper($this->model->getPrimaryKeyName()) . " ";
                            } else if ($this->getVendor() == self::POSTGRESS) {
                                $sqlLooping .= "    " . strtoupper($systemCheck) . " = CASE ".$this->q->getFinancialDatabase()."." . strtoupper($this->model->getTableName()).strtoupper($this->model->getPrimaryKeyName()) . " ";
                            } else {
                                echo json_encode(array("success" => false, "message" => $this->systemString->getNonSupportedDatabase()));
                                exit();
                            }
                            $sqlLooping .= "
                            WHEN '" . $this->model->getCountryId($i, 'array') . "'
                            THEN '" . $this->model->getIsActive($i, 'array') . "'";
                            $sqlLooping .= " END,";
                        }
                    }
                    break;
                case 'isApproved' :
                    for ($i = 0; $i < $loop; $i++) {
                        if (strlen($this->model->getIsApproved($i, 'array')) > 0) {
                            if ($this->getVendor() == self::MYSQL) {
                                $sqlLooping .= " `" . $systemCheck . "` = CASE `".$this->q->getFinancialDatabase()."`.`".$this->model->getTableName()."`.`" . $this->model->getPrimaryKeyName() . "`";
                            } else if ($this->getVendor() == self::MSSQL) {
                                $sqlLooping .= "  [" . $systemCheck . "] = CASE [".$this->q->getFinancialDatabase()."].[".$this->model->getTableName()."].[" . $this->model->getPrimaryKeyName() . "]";
                            } else if ($this->getVendor() == self::ORACLE) {
                                $sqlLooping .= "    " . strtoupper($systemCheck) . " = CASE ".$this->q->getFinancialDatabase()."." . strtoupper($this->model->getTableName()).strtoupper($this->model->getPrimaryKeyName()) . " ";
                            } else if ($this->getVendor() == self::DB2) {
                                $sqlLooping .= "    " . strtoupper($systemCheck) . " = CASE ".$this->q->getFinancialDatabase()."." . strtoupper($this->model->getTableName()).strtoupper($this->model->getPrimaryKeyName()) . " ";
                            } else if ($this->getVendor() == self::POSTGRESS) {
                                $sqlLooping .= "    " . strtoupper($systemCheck) . " = CASE ".$this->q->getFinancialDatabase()."." . strtoupper($this->model->getTableName()).strtoupper($this->model->getPrimaryKeyName()) . " ";
                            } else {
                                echo json_encode(array("success" => false, "message" => $this->systemString->getNonSupportedDatabase()));
                                exit();
                            }
                            $sqlLooping .= "
                            WHEN '" . $this->model->getCountryId($i, 'array') . "'
                            THEN '" . $this->model->getIsApproved($i, 'array') . "'";
                            $sqlLooping .= " END,";
                        }
                    }
                    break;
                case 'isReview' :
                    for ($i = 0; $i < $loop; $i++) {
                        if (strlen($this->model->getIsReview($i, 'array')) > 0) {
                            if ($this->getVendor() == self::MYSQL) {
                                $sqlLooping .= " `" . $systemCheck . "` = CASE `".$this->q->getFinancialDatabase()."`.`".$this->model->getTableName()."`.`" . $this->model->getPrimaryKeyName() . "`";
                            } else if ($this->getVendor() == self::MSSQL) {
                                $sqlLooping .= "  [" . $systemCheck . "] = CASE [".$this->q->getFinancialDatabase()."].[".$this->model->getTableName()."].[" . $this->model->getPrimaryKeyName() . "]";
                            } else if ($this->getVendor() == self::ORACLE) {
                                $sqlLooping .= "    " . strtoupper($systemCheck) . " = CASE ".$this->q->getFinancialDatabase()."." . strtoupper($this->model->getTableName()).strtoupper($this->model->getPrimaryKeyName()) . " ";
                            } else if ($this->getVendor() == self::DB2) {
                                $sqlLooping .= "    " . strtoupper($systemCheck) . " = CASE ".$this->q->getFinancialDatabase()."." . strtoupper($this->model->getTableName()).strtoupper($this->model->getPrimaryKeyName()) . " ";
                            } else if ($this->getVendor() == self::POSTGRESS) {
                                $sqlLooping .= "    " . strtoupper($systemCheck) . " = CASE ".$this->q->getFinancialDatabase()."." . strtoupper($this->model->getTableName()).strtoupper($this->model->getPrimaryKeyName()) . " ";
                            } else {
                                echo json_encode(array("success" => false, "message" => $this->systemString->getNonSupportedDatabase()));
                                exit();
                            }
                            $sqlLooping .= "
                            WHEN '" . $this->model->getCountryId($i, 'array') . "'
                            THEN '" . $this->model->getIsReview($i, 'array') . "'";
                            $sqlLooping .= " END,";
                        }
                    }
                    break;
                case 'isPost' :
                    for ($i = 0; $i < $loop; $i++) {
                        if (strlen($this->model->getIsPost($i, 'array')) > 0) {
                            if ($this->getVendor() == self::MYSQL) {
                                $sqlLooping .= " `" . $systemCheck . "` = CASE `".$this->q->getFinancialDatabase()."`.`".$this->model->getTableName()."`.`" . $this->model->getPrimaryKeyName() . "`";
                            } else if ($this->getVendor() == self::MSSQL) {
                                $sqlLooping .= "  [" . $systemCheck . "] = CASE [".$this->q->getFinancialDatabase()."].[".$this->model->getTableName()."].[" . $this->model->getPrimaryKeyName() . "]";
                            } else if ($this->getVendor() == self::ORACLE) {
                                $sqlLooping .= "    " . strtoupper($systemCheck) . " = CASE ".$this->q->getFinancialDatabase()."." . strtoupper($this->model->getTableName()).strtoupper($this->model->getPrimaryKeyName()) . " ";
                            } else if ($this->getVendor() == self::DB2) {
                                $sqlLooping .= "    " . strtoupper($systemCheck) . " = CASE ".$this->q->getFinancialDatabase()."." . strtoupper($this->model->getTableName()).strtoupper($this->model->getPrimaryKeyName()) . " ";
                            } else if ($this->getVendor() == self::POSTGRESS) {
                                $sqlLooping .= "    " . strtoupper($systemCheck) . " = CASE ".$this->q->getFinancialDatabase()."." . strtoupper($this->model->getTableName()).strtoupper($this->model->getPrimaryKeyName()) . " ";
                            } else {
                                echo json_encode(array("success" => false, "message" => $this->systemString->getNonSupportedDatabase()));
                                exit();
                            }
                            $sqlLooping .= "
                                WHEN '" . $this->model->getCountryId($i, 'array') . "'
                                THEN '" . $this->model->getIsPost($i, 'array') . "'";
                            $sqlLooping .= " END,";
                        }
                    }
                    break;
            }
        }$sql .= substr($sqlLooping, 0, - 1);
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
        array(  "success" => true,
                        "message" => $message,
                        "time"=>$time)
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
            SELECT  `referenceNo`
            FROM    `".$this->q->getFinancialDatabase()."`.`country`
            WHERE   `referenceNo`   =   '" . $this->model->getReferenceNo() . "'
            AND     `isActive`              =   1";
        } else if ($this->getVendor() == self::MSSQL) {
            $sql = "
            SELECT  [referenceNo]
            FROM    [".$this->q->getFinancialDatabase()."].[country]
            WHERE   [referenceNo]   =   '" . $this->model->getReferenceNo() . "'
            AND     [isActive]              =   1";
        } else if ($this->getVendor() == self::ORACLE) {
            $sql = "
            SELECT  REFERENCENO
            FROM    COUNTRY
            WHERE   REFERENCENO =   '" . $this->model->getReferenceNo() . "'
            AND     ISACTIVE            =   1";
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
            array(  "success" =>true,
                        "total" => $total,
                        "message" => $this->systemString->getDuplicateMessage(), 
                        "referenceNo" => $row ['referenceNo'],
                        "time"=>$time));
            exit();
        } else {
            $end = microtime(true);
            $time = $end - $start;
            echo json_encode(
            array(  "success" => true,
                        "total" => $total, 
                        "message" => $this->systemString->getNonDuplicateMessage(),
                        "time"=>$time));
            exit();
        }
    }
 
    function firstRecord($value) {
        $this->recordSet->firstRecord($value);
    }
 
    function nextRecord($value, $primaryKeyValue) {
        $this->recordSet->nextRecord($value, $primaryKeyValue);
    }
 
    function previousRecord($value, $primaryKeyValue) {
        $this->recordSet->previousRecord($value, $primaryKeyValue);
    }
 
    function lastRecord($value) {
        $this->recordSet->lastRecord($value);
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
            //  echo print_r($row);
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
        $filename = "country" . rand(0, 10000000) . ".xlsx";
        $path = $_SERVER ['DOCUMENT_ROOT'] . "/" . $this->application . "/basic/document/excel/" . $filename;
        $this->documentTrail->create_trail($this->leafId, $path, $filename);
        $objWriter->save($path);
        $file = fopen($path, 'r');
        if ($file) {
            $end = microtime(true);
            $time = $end - $start;
            echo json_encode(
            array(  "success" => true,
                        "message" => $this->systemString->getFileGenerateMessage(), 
                        "filename" => $filename,
                        "time"=>$time));
            exit();
        } else {
            $end = microtime(true);
            $time = $end - $start;
            echo json_encode(
            array(  "success" => false,
                        "message" => $this->systemString->getFileNotGenerateMessage(),
                        "time"=>$time));
            exit();
        }
    }
 
}
 
$countryObject = new CountryClass ();
/**
 * crud -create,read,update,delete
 * */
if (isset($_POST ['method'])) {
    /*
     *  Initilize Value before load in the loader
     */
    if (isset($_POST ['leafId'])) {
        $countryObject->setLeafId($_POST ['leafId']);
    }
    /*
     * Admin Only
     */
    if (isset($_POST ['isAdmin'])) {
        $countryObject->setIsAdmin($_POST ['isAdmin']);
    }
    /**
     * Database Request
     */
    if (isset($_POST ['databaseRequest'])) {
        $countryObject->setRequestDatabase($_POST ['databaseRequest']);
    }
    /*
     *  Paging
     */
    if (isset($_POST ['start'])) {
        $countryObject->setStart($_POST ['start']);
    }
    if (isset($_POST ['perPage'])) {
        $countryObject->setLimit($_POST ['perPage']);
    }
    /*
     *  Filtering
     */
    if (isset($_POST ['query'])) {
        $countryObject->setFieldQuery($_POST ['query']);
    }
    if (isset($_POST ['filter'])) {
        $countryObject->setGridQuery($_POST ['filter']);
    }
    if (isset($_POST ['character'])) {
        $countryObject->setCharacterQuery($_POST['character']);
    }
    if (isset($_POST ['dateRangeStart'])) {
        $countryObject->setDateRangeStartQuery($_POST['dateRangeStart']);
        //explode the data to get day,month,year
        $start=explode("-",$_POST ['dateRangeStart']);
        $countryObject->setStartDay($start[2]);
        $countryObject->setStartMonth($start[1]);
        $countryObject->setStartYear($start[0]);
    }
    if (isset($_POST ['dateRangeEnd'])) {
        $countryObject->setDateRangeEndQuery($_POST['dateRangeEnd']);
        //explode the data to get day,month,year
        $start=explode("-",$_POST ['dateRangeEnd']);
        $countryObject->setEndDay($start[2]);
        $countryObject->setEndMonth($start[1]);
        $countryObject->setEndYear($start[0]);
    }
    if (isset($_POST ['dateRangeType'])) {
        $countryObject->setDateRangeTypeQuery($_POST['dateRangeType']);
    }
    /*
     * Ordering
     */
    if (isset($_POST ['order'])) {
        $countryObject->setOrder($_POST ['order']);
    }
    if (isset($_POST ['sortField'])) {
        $countryObject->setSortField($_POST ['sortField']);
    }
     
    /*
     *  Load the dynamic value
     */
    $countryObject->execute();
    /*
     *  Crud Operation (Create Read Update Delete/Destory)
     */
    if ($_POST ['method'] == 'create') {
        $countryObject->create();
    }
    if ($_POST ['method'] == 'save') {
        $countryObject->update();
    }
    if ($_POST ['method'] == 'read') {
        $countryObject->read();
    }
    if ($_POST ['method'] == 'delete') {
        $countryObject->delete();
    }
    if ($_POST ['method'] == 'posting') {
    //  $countryObject->posting();
    }
    if ($_POST ['method'] == 'reverse') {
    //  $countryObject->delete();
    }
}
if (isset($_GET ['method'])) {
    /*
     *  Initilize Value before load in the loader
     */
    if (isset($_GET ['leafId'])) {
        $countryObject->setLeafId($_GET ['leafId']);
    }
    /*
     * Admin Only
     */
    if (isset($_GET ['isAdmin'])) {
        $countryObject->setIsAdmin($_GET ['isAdmin']);
    }
    /**
     * Database Request
     */
    if (isset($_GET ['databaseRequest'])) {
        $countryObject->setRequestDatabase($_GET ['databaseRequest']);
    }
    /*
     *  Load the dynamic value
     */
    $countryObject->execute();
    if (isset($_GET ['field'])) {
        if ($_GET ['field'] == 'staffId') {
            $countryObject->staff();
        }
    }
    /*
     * Update Status of The Table. Admin Level Only
     */
    if ($_GET ['method'] == 'updateStatus') {
        $countryObject->updateStatus();
    }
    /*
     *  Checking Any Duplication  Key
     */
    if (isset($_GET ['religionDetailSampleDesc'])) {
        if (strlen($_GET ['religionDetailSampleDesc']) > 0) {
            $countryObject->duplicate();
        }
    }
    if ($_GET ['method'] == 'dataNavigationRequest') {
        if ($_GET ['dataNavigation'] == 'first') {
            $countryObject->firstRecord('json');
        }
        if ($_GET ['dataNavigation'] == 'previous') {
            $countryObject->previousRecord('json', 0);
        }
        if ($_GET ['dataNavigation'] == 'next') {
            $countryObject->nextRecord('json', 0);
        }
        if ($_GET ['dataNavigation'] == 'last') {
            $countryObject->lastRecord('json');
        }
    }
    /*
     * Excel Reporting
     */
    if (isset($_GET ['mode'])) {
        if ($_GET ['mode'] == 'excel') {
            $countryObject->excel();
        }
    }
}
?>