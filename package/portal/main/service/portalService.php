<?php
namespace Core\Portal\Service;
require_once ("/../../../../library/class/classAbstract.php");
require_once ("/../../../../library/class/classSystemString.php");
require_once ("/../../../system/management/model/staffModel.php");
require_once ("/../model/staffWebAcessModel.php");

/**
 * this is main setting files
 * @name IDCMS
 * @version 2
 * @author hafizan
 * @package accordion
 * @link http://www.idcms.org
 * @license http://www.gnu.org/copyleft/lesser.html LGPL
 */
class DefaultClass extends \Core\ConfigClass {

    /**
     * Connection DatabaseObject
     * @var string
     */
    public $q;

    /**
     * @var string
     */
    public $model;

    /**
     * @var string
     */
    public $staffWebAccess;

    /**
     * Class Loader
     */
    public function execute() {
        parent::__construct();
        if($this->getVendor()==self::MYSQL) {
            $this->q = new \Core\Database\Mysql\Vendor();
        } else if ($this->getVendor()==self::MSSQL) {
            $this->q = new \Core\Database\Mssql\Vendor();
        } else if ($this->getVendor() == self::ORACLE) {
            $this->q = new \Core\Database\Oracle\Vendor();
        } else if ($this->getVendor() == self::POSTGRESS){
            $this->q = new \Core\Database\Postgress\Vendor();
        } else if ($this->getVendor() == self ::DB2){
            $this->q = new \Core\Database\Db2\Vendor();                    
        }
        $this->q->vendor = $this->getVendor();
        $this->q->setRequestDatabase($this->q->getCoreDatabase());
        $this->q->connect($this->getConnection(), $this->getUsername(), $this->getDatabase(), $this->getPassword());

        $this->model = new \Core\System\Management\Staff\Model\StaffModel();
        $this->model->setVendor($this->getVendor());
        $this->model->execute();


        $this->staffWebAccess = new \Core\Portal\Model\StaffWebAcessModel();
        $this->staffWebAccess->setVendor($this->getVendor());
        $this->staffWebAccess->execute();

        $this->systemString = new \Core\SystemString\SystemString();
        $this->systemString->setVendor($this->getVendor());
        $this->systemString->setLeafId($this->getLeafId());
        $this->systemString->execute();
    }

    /* (non-PHPdoc)
     * @see config::create()
     */

    public function create() {
        
    }

    /* (non-PHPdoc)
     * @see config::read()
     */

    public function read() {
        
    }

    /* (non-PHPdoc)
     * @see config::update()
     */

    public function update() {
        
    }

    /* (non-PHPdoc)
     * @see config::delete()
     */

    public function delete() {
        
    }

    /* (non-PHPdoc)
     * @see config::excel()
     */

    public function excel() {
        
    }

    public function authentication($username, $password) {
        $returnArray = array();
        $start = microtime(true);
        $this->model->setStaffName($username);
        $this->model->setStaffPassword($password);

        if ($this->getVendor() == self::MYSQL) {
            $sql = "SET NAMES \"utf8\"";
            //		$this->q->fast ( $sql );
        }
        /**
         * Most Vendor don't much implement ansi 92 standard.Sql Statement Prefer Follow  Vendor Database Rule Standard.
         * */
        if ($this->getVendor() == self::MYSQL) {
            $sql = "
			SELECT	`iManagement`.`staff`.`staffId`,
				`iManagement`.`staff`.`staffNo`,
				`iManagement`.`staff`.`staffName`,
				`iManagement`.`staff`.`languageId`,
				`iManagement`.`team`.`teamId`,
				`iManagement`.`team`.`teamDesc`,
				`iManagement`.`team`.`isAdmin`,
                                `iManagement`.`department`.`departmentId`,
                                `iManagement`.`department`.`departmentDesc`					
			FROM 	`iManagement`.`staff`
			JOIN	`iManagement`.`team`
			USING	(`teamId`)
			JOIN	`iManagement`.`department`
			USING	(`departmentId`)
			WHERE   `iManagement`.`staff`.`staffName`			=	'" . $this->model->getStaffName() . "'
			AND     `iManagement`.`staff`.`staffPassword`		=	'" . md5($this->model->getStaffPassword()) . "'
			AND	`iManagement`.`staff`.`isActive`			=	1
			AND	`iManagement`.`team`.`isActive`			=	1
			AND	`iManagement`.`department`.`isActive`		=	1";
        } else if ($this->getVendor() == self::MSSQL) {
            $sql = "
			SELECT	[iManagement].[staff].[staffId],
					[iManagement].[staff].[staffNo],
					[iManagement].[staff].[staffName],
					[iManagement].[staff].[languageId],
					[iManagement].[team].[teamId],
					[iManagement].[team].[teamDesc],
					[iManagement].[team].[isAdmin],
					[iManagement].[department].[departmentId]	
					[iManagement].[department].[departmentDesc]	
			FROM 	[iManagement].[staff]
			JOIN	[iManagement].[team]	
			ON		[iManagement].[staff].[teamId]  			= 	[team].[teamId]
			JOIN	[iManagement].[department]
			ON		[iManagement].[department].[departmentId] = 	[staff].[departmentId]
			WHERE 	[iManagement].[staff].[staffName]			=	'" . $this->model->getStaffName() . "'
			AND		[iManagement].[staff].[staffPassword]		=	'" . md5($this->model->getStaffPassword()) . "'
			AND		[iManagement].[staff].[isActive]			=	1
			AND		[iManagement].[team].[isActive]			=	1
			AND		[iManagement].[department].[isActive]		=	1";
        } else if ($this->getVendor() == self::ORACLE) {
            $sql = "
			SELECT	IMANAGEMENT.STAFF.STAFFID 				AS	\"staffId\",
					IMANAGEMENT.STAFF.STAFFNO 				AS 	\"staffNo\",
					IMANAGEMENT.STAFF.STAFFNAME 			AS 	\"staffName\",
					IMANAGEMENT.STAFF.LANGUAGEID 			AS 	\"languageId\",
					IMANAGEMENT.TEAM.TEAMID 				AS  \"teamId\",
					IMANAGEMENT.TEAM.TEAMDESC 				AS  \"teamDesc\",
					IMANAGEMENT.DEPARTMENT.DEPARTMENTID 	AS 	\"departmentId\",
					IMANAGEMENT.DEPARTMENT.DEPARTMENTDESC	AS 	\"departmentDesc\"	
			FROM 	IMANAGEMENT.STAFF
			JOIN	IMANAGEMENT.TEAM
			ON		IMANAGEMENT.TEAM.TEAMID			= 	STAFF.TEAMID
			JOIN	IMANAGEMENT.DEPARTMENT
			ON		IMANAGEMENT.DEPARTMENT.DEPARTMENTID	= 	STAFF.DEPARTMENTID
			WHERE 	IMANAGEMENT.STAFF.STAFFNAME			=	'" . $this->model->getStaffName() . "'
			AND		IMANAGEMENT.STAFF.STAFFPASSWORD		=	'" . md5($this->model->getStaffPassword()) . "'
			AND		IMANAGEMENT.STAFF.ISACTIVE			=  1
			AND		IMANAGEMENT.TEAM.ISACTIVE 			=  1
			AND		IMANAGEMENT.DEPARTMENT.ISACTIVE	 	=  1";
        } else if ($this->getVendor() == self::DB2) {
            $sql = "
			SELECT	STAFF.STAFFID 			AS	\"staffId\",
			STAFF.STAFFNO 			AS 	\"staffNo\",
			STAFF.STAFFNAME 		AS 	\"staffName\",
			STAFF.LANGUAGEID 		AS 	\"languageId\",
			TEAM.TEAMID 			AS  \"teamId\",
			DEPARTMENT.DEPARTMENTID AS 	\"departmentId\"
			
			FROM 	STAFF
			JOIN	TEAM
			ON		TEAM.TEAMID			= 	STAFF.TEAMID
			JOIN	DEPARTMENT
			ON		DEPARTMENT.DEPARTMENTID	= 	STAFF.DEPARTMENTID
			WHERE 	STAFF.STAFFNAME			=	'" . $this->model->getStaffName() . "'
			AND		STAFF.STAFFPASSWORD		=	'" . md5($this->model->getStaffPassword()) . "'
			AND		STAFF.ISACTIVE			=  1
			AND		TEAM.ISACTIVE 		=  1
			AND		DEPARTMENT.ISACTIVE	 	=  1";
        } else if ($this->getVendor() == self::POSTGRESS) {
            $sql = "
			SELECT	STAFF.STAFFID 			AS	\"staffId\",
			STAFF.STAFFNO 			AS 	\"staffNo\",
			STAFF.STAFFNAME 		AS 	\"staffName\",
			STAFF.LANGUAGEID 		AS 	\"languageId\",
			TEAM.TEAMID 			AS  \"teamId\",
			DEPARTMENT.DEPARTMENTID AS 	\"departmentId\"
			
			FROM 	STAFF
			JOIN	TEAM
			ON		TEAM.TEAMID			= 	STAFF.TEAMID
			JOIN	DEPARTMENT
			ON		DEPARTMENT.DEPARTMENTID	= 	STAFF.DEPARTMENTID
			WHERE 	STAFF.STAFFNAME			=	'" . $this->model->getStaffName() . "'
			AND		STAFF.STAFFPASSWORD		=	'" . md5($this->model->getStaffPassword()) . "'
			AND		STAFF.ISACTIVE			=  1
			AND		TEAM.ISACTIVE 			=  1
			AND		DEPARTMENT.ISACTIVE	 	=  1";
        } else {
            echo json_encode(array("success" => false, "message" => "cannot identify vendor db[" . $this->getVendor() . "]"));
            exit();
        }

        $result = $this->q->fast($sql);
        if ($this->q->execute == 'fail') {
            echo json_encode(array("success" => false, "message" => $this->q->responce));
            exit();
        }

        if ($this->q->numberRows($result) > 0) {

            $row = $this->q->fetchAssoc($result);

            $_SESSION ['staffId'] = $row ['staffId'];
            $_SESSION ['staffNo'] = $row ['staffNo'];
            $_SESSION ['staffName'] = $row ['staffName'];
            $_SESSION ['languageId'] = $row ['languageId'];
            $_SESSION ['teamId'] = $row ['teamId'];
            $_SESSION ['teamDesc'] = $row ['teamDesc'];
            $_SESSION ['isAdmin'] = $row ['isAdmin'];

            $_SESSION ['departmentId'] = $row ['departmentId'];
            $_SESSION ['departmentDesc'] = $row ['departmentDesc'];
            //$_SESSION ['database'] = $_POST ['database'];
            // $_SESSION ['vendor'] = $_POST ['vendor'];

            $this->staffWebAccess->setStaffId($_SESSION ['staffId']);

            // audit Log Time In
            if ($this->getVendor() == self::MYSQL) {
                $sql = "
				INSERT INTO `iManagement`.`staffWebAccess`
						(
							`iManagement`.`staffWebAccess`.`staffId`,
							`iManagement`.`staffWebAccess`.`staffWebAccessLogIn`
						)
				VALUES (
							'" . $this->staffWebAccess->getStaffId() . "',
							'" . $this->staffWebAccess->getStaffWebAccessLogIn() . "'
						)";
            } else if ($this->getVendor() == self::MSSQL) {
                $sql = "
				INSERT INTO [iCore].[staffWebAccess]
						(
							[iCore].[staffWebAccess].[staffId],
							[iCore].[staffWebAccess].[staffWebAccessLogIn]
						)
				VALUES (
							'" . $this->staffWebAccess->getStaffId() . "',
							'" . $this->staffWebAccess->getStaffWebAccessLogIn() . "'
						)";
            } else if ($this->getVendor() == self::ORACLE) {
                $sql = "
				INSERT INTO ICORE.STAFFWEBACCESS
						(
							ICORE.STAFFWEBACCESS.STAFFID,
							ICORE.STAFFWEBACCESS.STAFFWEBACCESSLOGIN
						)
				VALUES (
							'" . $this->staffWebAccess->getStaffId() . "',
							" . $this->staffWebAccess->getStaffWebAccessLogIn() . "
						)";
            } else if ($this->getVendor() == self::DB2) {
                $sql = "
				INSERT INTO ICORE.STAFFWEBACCESS
						(
							ICORE.STAFFWEBACCESS.STAFFID,
							ICORE.STAFFWEBACCESS.STAFFWEBACCESSLOGIN
						)
				VALUES (
							'" . $this->staffWebAceess->getStaffId() . "',
							" . $this->staffWebAceess->getStaffWebAccessLogIn() . "
						)";
            } else if ($this->getVendor() == self::POSTGRESS) {
                $sql = "
				INSERT INTO ICORE.STAFFWEBACCESS
						(
							ICORE.STAFFWEBACCESS.STAFFID,
							ICORE.STAFFWEBACCESS.STAFFWEBACCESSLOGIN
						)
				VALUES (
							'" . $this->staffWebAccess->getStaffId() . "',
							" . $this->staffWebAccess->getStaffWebAccessLogIn() . "
				d		)";
            }
            $this->q->update($sql);

            $returnArray['success'] = true;
            $returnArray['message'] = $this->systemString->getLoginSuccess();
            $returnArray['start'] = $start;
            $returnArray['staffName'] = $_SESSION ['staffName'];
            $returnArray['staffImage'] = '';
            return $returnArray;
        } else {
            $returnArray['success'] = false;
            $returnArray['message'] = $this->systemString->getLoginError();
            $returnArray['start'] = $start;
            return $returnArray;
        }
    }

    /*
     *  return basic setting portlet.
     */

    function setting() {
        return $setting[''];
    }

}

class MenuNavigatonClass extends \Core\ConfigClass {

    /**
     * Connection DatabaseObject
     * @var string
     */
    public $q;

    /**
     * @var string
     */
    public $model;
    public $applicationId;
    public $moduleId;
    public $folderId;
    public $leafId;
    /*
     * Default identification for portal user
     * var $teamId
     */
    private $teamId;

    function __construct() {
        $this->teamId = 7;
    }

    function execute() {
        parent::__construct();

        $this->q = new \Core\Database\Mysql\Vendor();

        $this->q->vendor = $this->getVendor();
        $this->q->setRequestDatabase($this->q->getCoreDatabase());
        $this->q->connect($this->getConnection(), $this->getUsername(), $this->getDatabase(), $this->getPassword());

        $this->model = new \Core\System\Management\Staff\Model\StaffModel();
        $this->model->setVendor($this->getVendor());
        $this->model->execute();

        $this->systemString = new \Core\SystemString\SystemString();
        $this->systemString->setVendor($this->getVendor());
        $this->systemString->setLeafId($this->getLeafId());
        $this->systemString->execute();
    }

    function create() {
        
    }

    function read() {
        
    }

    function update() {
        
    }

    function delete() {
        
    }

    function excel() {
        
    }

    /*
     *  Reroute application. 
     *  @param int id Application Identification or Lead Identification
     *  @param enum ('app','leaf') type Application Or Leaf
     */

    function route($pageId, $pageType) {
        $sql        = null;
        $appendFile = null;
        $error      = 0;
        if (isset($_SESSION['teamId'])) {
            $this->teamId = $_SESSION['teamId'];
        }
      
        switch ($pageType) {
            case 'APP':
                
                if ($this->getVendor() == self::MYSQL) {
                    $sql = "
                    SELECT  `applicationFilename` as `filename`
                    FROM    `application`
                    JOIN    `applicationAccess`
                    USING   (`applicationId`)
                    WHERE   `applicationAccess`.`teamId` ='" . $this->teamId . "'
                    AND     `applicationId` = '".$pageId."'";
                }
                break;
            case 'LEF':
                if ($this->getVendor() == self::MYSQL) {
                    $sql = "
                    SELECT  `leafFilename` as `filename`
                    FROM    `leaf`
                    JOIN    `leafAccess`
                    USING   (`leafId`)
                    WHERE   `leafAccess`.`staffId` ='" . $_SESSION['staffId'] . "'
                    AND     `leafId`               ='".$pageId."'";
                }
                break;
           default:
               $error=1;
        }
        if($error==1) {
            $this->exceptionMessage("Undefine Menu Type");
            return;
        }
        $result = $this->q->fast($sql);
        if ($result) {
            $row = $this->q->fetchArray($result);
            $appendFile = $row['filename'];
            // check if path exist file or not.
            if (is_file(substr($appendFile,1))) {
                require_once($appendFile);
            } else {
                $this->exceptionMessage("The file " . $appendFile . " does not exist");           
            }
        } else {
            $this->exceptionMessage("error :".$sql); //  debugging 
        }
    }

    /*
     * 
     */

    public function application() {
        $data = array();
        if (isset($_SESSION['teamId'])) {
            $this->teamId = $_SESSION['teamId'];
        }
        if ($this->getVendor() == self::MYSQL) {
            $sql = "
            SELECT  `applicationTranslate`.`applicationNative`,
                    `application`.`applicationId`
            FROM    `" . $this->q->getCoreDatabase() . "`.`application` 
            JOIN    `" . $this->q->getCoreDatabase() . "`.`applicationAccess`
            USING   (`applicationId`)
            JOIN    `" . $this->q->getCoreDatabase() . "`.`applicationTranslate`
            USING   (`applicationId`)
            WHERE   1
            AND     `applicationAccess`.`applicationAccessValue`    =   1
            AND     `applicationAccess`.`teamId` =   '" . $this->teamId . "'
            AND     `application`.`isActive`=1";
        }
// debugging 
// $this->exceptionMessageArray($sql); //  debugging
        $result = $this->q->fast($sql);
        if (!$result) {
            $this->exceptionMessageArray($sql); //  debugging 
        }
        while ($row = $this->q->fetchArray($result)) {
            $row['module'] = $this->applicationAndModule($row['applicationId']);
            $data[] = $row;
        }
// $this->exceptionMessageArray($data);
        return $data;
    }

    /**
     *  Navigation Bar.
     *  @param $applicationId  Application Identification 
     */
    public function applicationAndModule($applicationId) {
        $detail = array();
        if (isset($_SESSION['teamId'])) {
            $this->teamId = $_SESSION['teamId'];
        }
        if ($this->getVendor() == self::MYSQL) {
            $sql = "
        SELECT  `" . $this->q->getCoreDatabase() . "`.`moduleTranslate`.`moduleNative`, 
        FROM    `module`
        JOIN    `moduleAccess`
        USING   (`moduleId`)
        JOIN    `moduleTranslate`
        USING   (`moduleId`)
        JOIN    `application` 
        JOIN    `applicationAccess`
        USING   (`applicationId`,`teamId`)
        WHERE   `moduleAccess`.`teamId`                         =   '" . $this->teamId . "'
        AND     `aplicationAccess`.`teamId`                     =   '" . $this->teamId . "'
        AND     `moduleAccess`.`moduleAccessValue`              =   1
        AND     `applicationAccess`.`applicationAccessValue`    =   1
        AND     `application`.`applicationId`                   =   '" . $applicationId . "'";
        } else if ($this->getVendor() == self::MSSQL) {
            $sql = "
        SELECT  * 
        FROM    `application` 
        JOIN    `applicationAccess`
        USING   (`applicationId`)
        WHERE   `teamId`='" . $_SESSION['teamId'] . "'";
        } else if ($this->getVendor() == self::ORACLE) {
            $sql = "
        SELECT  * 
        FROM    `application` 
        JOIN    `applicationAccess`
        USING   (`applicationId`)
        WHERE   `teamId`='" . $_SESSION['teamId'] . "'";
        } else if ($this->getVendor() == self::POSTGRESS) {
            
        } else if ($this->getVendor() == self::DB2) {
            
        }
        $this->q->read($sql);
        while ($row = $this->q->fetchArray()) {
            $detail[] = $row;
        }
        return $detail;
    }

    /**
     *  Generate Folder
     *  @param $folderId Folder Identification
     */
    public function folder($folderId = null) {
        $this->folderId = $folderId;

        $data = array();
        if (isset($_SESSION['teamId'])) {
            $this->teamId = $_SESSION['teamId'];
        }
        if ($this->getVendor() == self::MYSQL) {
            $sql = "
        SELECT  `folderTranslate`.`applicationNative`,
                `folder`.`applicationId`,
                `folder`.`moduleId`,
                `folder`.`folderId`,
                `folder`.`folderPath`,
                `icon`.`iconId`
        FROM    `" . $this->q->getCoreDatabase() . "`.`folder`
        JOIN    `" . $this->q->getCoreDatabase() . "`.`folderAccess`
        USING   (`folderId`)
        WHERE   `folderAccess`.`folderAccessValue`  =   1";
        }

        if (empty($this->folderId)) {
            $sql.=" AND `folder`.`isDefault` =1 ";
        } else {
            $sql.=" AND `folder`.`folderId` = '" . $this->folderId . "'";
        }

        $sql.=" `folderAccess`.`teamId`             =   '" . $this->teamId . "'";

        $result = $this->q->fast($sql);
        while ($row = $this->q->fetchArray($result)) {
            $row['leaf'] = $this->folderAndLeaf($row['applicationId'], $row['moduleId'], $row['folderId']);
            $data[] = $row;
        }
        return $data;
    }

    /**
     * Generate Leaf 
     * @param int $applicationId Application Identification
     * @param int $moduleId  Module Identification
     * @param int $folderId  Folder Identification
     */
    public function folderAndleaf($applicationId = null, $moduleId = null, $folderId = null) {
// construct variable
        $detail = array();
        $this->applicationId = $applicationId;
        $this->moduleId = $moduleId;
        $this->folderId = $folderId;
        if (isset($_SESSION['teamId'])) {
            $this->teamId = $_SESSION['teamId'];
        }

        if ($this->getVendor() == self::MYSQL) {
            $sql = "
        SELECT   `" . $this->q->getCoreDatabase() . "`.`leafTranslate`.`moduleNative`, 
        FROM   `leaf`
        USINg   (`leafId`)
        JOIN    `leafAccess`
        USING   (`leafId`)
        JOIN    `folder`
        USING   (`folderId`) 
        JOIN    `folderAccess`
        USING   (`folderId`)
        JOIN    `folderTranslate`
        USING   (`folderId`)
        WHERE   `folderAccess`.`teamId`                 =   '" . $this->teamId . "'
        AND     `leafAccess`.`staffId`                  =   '" . $_SESSION['staffId'] . "'
        AND     `folderAccess`.`moduleAccessValue`      =   1
        AND     `leafAccess`.`applicationAccessValue`   =   1
        AND     `folder`.`appicationId`                 =   '" . $this->applicationId . "'
        AND     `folder`.`moduleId`                     =   '" . $this->moduleId . "'
        AND     `folder`.`folderId`                     =   '" . $this->folderId . "'";
        } else if ($this->getVendor() == self::MSSQL) {
            $sql = "
        SELECT  * 
        FROM    `application` 
        JOIN    `applicationAccess`
        USING   (`applicationId`)
        WHERE   `teamId`='" . $_SESSION['teamId'] . "'";
        } else if ($this->getVendor() == self::ORACLE) {
            $sql = "
        SELECT  * 
        FROM    `application` 
        JOIN    `applicationAccess`
        USING   (`applicationId`)
        WHERE   `teamId`='" . $_SESSION['teamId'] . "'";
        } else if ($this->getVendor() == self::POSTGRESS) {
            
        } else if ($this->getVendor() == self::DB2) {
            
        }
        $this->q->read($sql);
        while ($row = $this->q->fetchArray()) {
            $detail[] = $row;
        }
        return $detail;
    }

}

class StoryClass extends \Core\ConfigClass {

    /**
     * Connection DatabaseObject
     * @var string
     */
    public $q;

    /**
     * @var string
     */
    public $model;

    function __construct() {
        
    }

    function execute() {
        parent::__construct();

        $this->q = new \Core\Database\Mysql\Vendor();

        $this->q->vendor = $this->getVendor();
        $this->q->setRequestDatabase($this->q->getCoreDatabase());
        $this->q->connect($this->getConnection(), $this->getUsername(), $this->getDatabase(), $this->getPassword());

        $this->model = new \Core\System\Management\Staff\Model\StaffModel();
        $this->model->setVendor($this->getVendor());
        $this->model->execute();



        $this->systemString = new \Core\SystemString\SystemString();
        $this->systemString->setVendor($this->getVendor());
        $this->systemString->setLeafId($this->getLeafId());
        $this->systemString->execute();
    }

    function create() {
        
    }

    function read() {
        
    }

    function update() {
        
    }

    function delete() {
        
    }

    function excel() {
        
    }

    /*
     * 
     */

    function centerCell() {
        return $this->centerDefault();
        // check database want customize mode and curousel mode
    }

    function centerStory() {

        $str.="<div id=\"centerViewport\" class=\"hero-unit\">
                <h1>
                    <img alt=\"Wait Ya.\" height=\"100\" width=\"100\" src=\"./images/Blueticons_Win/PNGs/Devil.png\" width=\"120\">";

        echo $firstHeader = "Welcome.. Core Light";

        $str.="</h1><p>
                  
                    <br>
                <p><a class=\"btn btn-primary btn-large\">Learn more &raquo;</a></p>
            </div>";
        return $str;
    }

    function centerCarousel() {
        
    }

    /*
     * Load the below image
     * @return $str 
     */

    function bottomStory() {
        $data = array();

        if ($this->getVendor() == self::MYSQL) {
            $sql = "
            SELECT * 
            FROM    `portal` 
            WHERE   `portalSynopis`
            AND     `isActive`  =   1
            LIMIT 3";
        } else if ($this->getVendor() == self::MSSQL) {
            
        } else if ($this->getVendor() == self::ORACLE) {
            
        } else if ($this->getVendor() == self::POSTGRESS) {
            
        } else if ($this->getVendor() == self::DB2) {
            
        }
        $result = $this->q->read($sql);
        while ($rowPortalSynopsis = $this->q->fetchArray($result)) {

            $str.="<div class=\"span3 well\"> ";
            if ($rowPortalSynopsis['portalImage']) {
                $data[]['image'] = $rowPortalSynopsis['portalImage'];
                $str.="<span class=\"thumbnail\"><img src=" . $rowPortalSynopsis['portalImage'] . " height=\"100\" width=\"100\"></span>";
            }
            $data[]['title'] = $rowPortalSynopsis['portalTitle'];
            $data[]['description'] = substr(0, 120, $rowPortalSynopsis['title']) . "....";
        }
        return $data;
    }

}

class Portlet extends \Core\ConfigClass {

    /**
     * Connection DatabaseObject
     * @var string
     */
    public $q;

    /**
     * @var string
     */
    public $model;
    public $errorType;

    function __construct() {
        
    }

    function execute() {
        parent::__construct();

        $this->q = new \Core\Database\Mysql\Vendor();

        $this->q->vendor = $this->getVendor();
        $this->q->setRequestDatabase($this->q->getCoreDatabase());
        $this->q->connect($this->getConnection(), $this->getUsername(), $this->getDatabase(), $this->getPassword());

        $this->systemString = new \Core\SystemString\SystemString();
        $this->systemString->setVendor($this->getVendor());
        $this->systemString->setLeafId($this->getLeafId());
        $this->systemString->execute();
    }

    function create() {
        
    }

    function read() {
        
    }

    function update() {
        
    }

    function delete() {
        
    }

    function excel() {
        
    }

    function setting() {
        
    }

    function leftCellImage($errorType = null) {
        $this->q->response = null;
        $this->errorType = $errorType;
        if (empty($this->errorType)) {
            $exception = "html";
        } else {
            $exception = "json";
        }
        $row = array();
        if ($this->getStaffId()) {
            echo $sql = "
        SELECT  `staffAvatar` 
        FROM    `staff` 
        WHERE   `staffId`   =   '" . $this->getStaffId() . "'";
            $result = $this->q->fast($sql);
            if ($this->q->execute == 'fail') {
                // html don't block page execution.
                if ($exception == 'html') {
                    $this->exceptionMessage($this->q->response);
                } else if ($exception == 'json') {
                    echo json_encode(array("success" => false, "message" => $this->q->responce));
                    exit();
                }
            }
            if (($exception)) {
                if ($this->q->numberRows($result) > 0) {
                    $row = $this->q->fetchArray($result);
                    $row['staffAvatar'] = 'Cool.png';

                    return $row['staffAvatar'];
                } else {
                    return $row['emptyAvatar'];
                }
            }
        }
    }

    function leftCellTopFive($errorType = null) {
        $this->q->response = null;
        $this->errorType = $errorType;
        if (empty($this->errorType)) {
            $exception = "html";
        } else {
            $exception = "json";
        }
        $data = array();
        if ($this->getStaffId()) {
            if ($this->getVendor() == self::MYSQL) {
                $sql = "
        SELECT      COUNT(*) AS `Rows` , 
                    `log`.`leafId`,
                    `leafTranslate`.`leafNative`
        FROM        `" . $this->q->getLogDatabase() . "`.`log`
        JOIN        `" . $this->q->getCoreDatabase() . "`.`leaf`
        USING       (`leafId`)
        JOIN       `" . $this->q->getCoreDatabase() . "`. `leafAccess`
        USING       (`leafId`,`staffId`)
        JOIN        `" . $this->q->getCoreDatabase() . "`.`leafTranslate`
        USING       (`leafId`)
        WHERE       `log`.`staffId`='" . $this->getStaffId() . "'
        GROUP BY    `leafId`
        ORDER BY    `Rows` ASC  
        LIMIT       5";
            } else if ($this->getVendor() == self::MSSQL) {
                
            } else if ($this->getVendor() == self::ORACLE) {
                
            } else if ($this->getVendor() == self::POSTGRESS) {
                
            } else if ($this->getVendor() == self::DB2) {
                
            }

            $result = $this->q->fast($sql);
            if ($this->q->execute == 'fail') {
                echo json_encode(array("success" => false, "message" => $this->q->responce));
                exit();
            }
            if ($this->q->numberRows($result) > 0) {
                while ($row = $this->q->fetchArray($result)) {
                    $data['leafId'] = $row['leafId'];
                    $data['leafNative'] = $row['leafNative'];
                }

                return $data;
            }
        }
    }

    function leftCellBookmark($errorType = null) {
        $this->q->response = null;
        $this->errorType = $errorType;
        if (empty($this->errorType)) {
            $exception = "html";
        } else {
            $exception = "json";
        }
        $data = array();
        if ($this->getVendor() == self::MYSQL) {
            $sql = "
        SELECT     
                    `leafUserBookmark`.`leafId`,
                    `leafTranslate`.`leafNative`
        FROM        `" . $this->q->getCoreDatabase() . "`.`leafUserBookmark`
        JOIN        `" . $this->q->getCoreDatabase() . "`.`leaf`
        USING       (`leafId`)
        JOIN        `" . $this->q->getCoreDatabase() . "`.`leafAccess`
        USING       (`leafId`,`staffId`)
        JOIN        `" . $this->q->getCoreDatabase() . "`.`leafTranslate`
        USING       (`leafId`)
        WHERE       `leafAccess`.`staffId`='" . $this->getStaffId() . "'
        
          
        LIMIT       5";
        } else if ($this->getVendor() == self::MSSQL) {
            
        } else if ($this->getVendor() == self::ORACLE) {
            
        } else if ($this->getVendor() == self::POSTGRESS) {
            
        } else if ($this->getVendor() == self::DB2) {
            
        }

        $result = $this->q->fast($sql);
        if ($this->q->execute == 'fail') {
            echo json_encode(array("success" => false, "message" => $this->q->responce));
            exit();
        }

        if ($this->q->numberRows($result) > 0) {
            while ($row = $this->q->fetchArray($result)) {
                $data['leafId'] = $row['leafId'];
                $data['leafNative'] = $row['leafNative'];
            }
        } else {
            $data['leafId'] = 0;
            $data['leafId'] = 'Empty';
        }
        return $data;
    }

}

?>
