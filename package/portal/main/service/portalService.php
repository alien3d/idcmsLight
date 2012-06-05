<?php
namespace Core\Portal\Service;
if(!isset($_SESSION)) {
	session_start();
}
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
    	header('Content-Type:application/json; charset=utf-8');
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
			SELECT	`staff`.`staffId`,
				`staff`.`staffNo`,
				`staff`.`staffName`,
				`staff`.`languageId`,
				`role`.`roleId`,
				`role`.`roleDesc`,
                                `role`.`isAdmin`,
                                `department`.`departmentId`,
                                `department`.`departmentDesc`					
			FROM 	`iManagement`.`staff`
			JOIN	`iManagement`.`role`
			USING	(`roleId`)
			JOIN	`iManagement`.`department`
			USING	(`departmentId`)
			WHERE   `staff`.`staffName`	=   '" . $this->model->getStaffName() . "'
			AND     `staff`.`staffPassword`	=   '" . md5($this->model->getStaffPassword()) . "'
			AND	`staff`.`isActive`	=   1
			AND	`role`.`isActive`	=   1
			AND	`department`.`isActive` =   1";
        } else if ($this->getVendor() == self::MSSQL) {
            $sql = "
			SELECT	[iManagement].[staff].[staffId],
					[iManagement].[staff].[staffNo],
					[iManagement].[staff].[staffName],
					[iManagement].[staff].[languageId],
					[iManagement].[role].[roleId],
					[iManagement].[role].[roleDesc],
					[iManagement].[role].[isAdmin],
					[iManagement].[department].[departmentId]	
					[iManagement].[department].[departmentDesc]	
			FROM 	[iManagement].[staff]
			JOIN	[iManagement].[role]	
			ON		[iManagement].[staff].[roleId]  			= 	[role].[roleId]
			JOIN	[iManagement].[department]
			ON		[iManagement].[department].[departmentId] = 	[staff].[departmentId]
			WHERE 	[iManagement].[staff].[staffName]			=	'" . $this->model->getStaffName() . "'
			AND		[iManagement].[staff].[staffPassword]		=	'" . md5($this->model->getStaffPassword()) . "'
			AND		[iManagement].[staff].[isActive]			=	1
			AND		[iManagement].[role].[isActive]			=	1
			AND		[iManagement].[department].[isActive]		=	1";
        } else if ($this->getVendor() == self::ORACLE) {
            $sql = "
			SELECT	IMANAGEMENT.STAFF.STAFFID 				AS	\"staffId\",
					IMANAGEMENT.STAFF.STAFFNO 				AS 	\"staffNo\",
					IMANAGEMENT.STAFF.STAFFNAME 			AS 	\"staffName\",
					IMANAGEMENT.STAFF.LANGUAGEID 			AS 	\"languageId\",
					IMANAGEMENT.ROLE.ROLEID 				AS  \"roleId\",
					IMANAGEMENT.ROLE.ROLEDESC 				AS  \"roleDesc\",
					IMANAGEMENT.DEPARTMENT.DEPARTMENTID 	AS 	\"departmentId\",
					IMANAGEMENT.DEPARTMENT.DEPARTMENTDESC	AS 	\"departmentDesc\"	
			FROM 	IMANAGEMENT.STAFF
			JOIN	IMANAGEMENT.ROLE
			ON		IMANAGEMENT.ROLE.ROLEID			= 	STAFF.ROLEID
			JOIN	IMANAGEMENT.DEPARTMENT
			ON		IMANAGEMENT.DEPARTMENT.DEPARTMENTID	= 	STAFF.DEPARTMENTID
			WHERE 	IMANAGEMENT.STAFF.STAFFNAME			=	'" . $this->model->getStaffName() . "'
			AND		IMANAGEMENT.STAFF.STAFFPASSWORD		=	'" . md5($this->model->getStaffPassword()) . "'
			AND		IMANAGEMENT.STAFF.ISACTIVE			=  1
			AND		IMANAGEMENT.ROLE.ISACTIVE 			=  1
			AND		IMANAGEMENT.DEPARTMENT.ISACTIVE	 	=  1";
        } else if ($this->getVendor() == self::DB2) {
            $sql = "
			SELECT	STAFF.STAFFID 			AS	\"staffId\",
			STAFF.STAFFNO 			AS 	\"staffNo\",
			STAFF.STAFFNAME 		AS 	\"staffName\",
			STAFF.LANGUAGEID 		AS 	\"languageId\",
			ROLE.ROLEID 			AS  \"roleId\",
			DEPARTMENT.DEPARTMENTID AS 	\"departmentId\"
			
			FROM 	STAFF
			JOIN	ROLE
			ON		ROLE.ROLEID			= 	STAFF.ROLEID
			JOIN	DEPARTMENT
			ON		DEPARTMENT.DEPARTMENTID	= 	STAFF.DEPARTMENTID
			WHERE 	STAFF.STAFFNAME			=	'" . $this->model->getStaffName() . "'
			AND		STAFF.STAFFPASSWORD		=	'" . md5($this->model->getStaffPassword()) . "'
			AND		STAFF.ISACTIVE			=  1
			AND		ROLE.ISACTIVE 		=  1
			AND		DEPARTMENT.ISACTIVE	 	=  1";
        } else if ($this->getVendor() == self::POSTGRESS) {
            $sql = "
			SELECT	STAFF.STAFFID 			AS	\"staffId\",
			STAFF.STAFFNO 			AS 	\"staffNo\",
			STAFF.STAFFNAME 		AS 	\"staffName\",
			STAFF.LANGUAGEID 		AS 	\"languageId\",
			ROLE.ROLEID 			AS  \"roleId\",
			DEPARTMENT.DEPARTMENTID AS 	\"departmentId\"
			
			FROM 	STAFF
			JOIN	ROLE
			ON		ROLE.ROLEID			= 	STAFF.ROLEID
			JOIN	DEPARTMENT
			ON		DEPARTMENT.DEPARTMENTID	= 	STAFF.DEPARTMENTID
			WHERE 	STAFF.STAFFNAME			=	'" . $this->model->getStaffName() . "'
			AND		STAFF.STAFFPASSWORD		=	'" . md5($this->model->getStaffPassword()) . "'
			AND		STAFF.ISACTIVE			=  1
			AND		ROLE.ISACTIVE 			=  1
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
            $_SESSION ['roleId'] = $row ['roleId'];
            $_SESSION ['roleDesc'] = $row ['roleDesc'];
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
						)";
            }
            $this->q->update($sql);

            $returnArray['success'] = true;
            $returnArray['message'] = $this->systemString->getLoginSuccess();
            $returnArray['start'] = $start;
            $returnArray['staffName'] = $_SESSION ['staffName'];
            $returnArray['staffImage'] = '';
            echo json_encode($returnArray);
        } else {
            $returnArray['success'] = false;
            $returnArray['message'] = $this->systemString->getLoginError();
            $returnArray['start'] = $start;
            echo json_encode($returnArray);

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
     * var $roleId
     */
    private $roleId;

    function __construct() {
        // default for portal visitor
        $this->roleId = 7; 
        $this->staffId=9; 
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
        
         if (isset($_SESSION['roleId'])) {
            $this->roleId = $_SESSION['roleId'];
        }
        if (isset($_SESSION['staffId'])) {
            $this->staffId = $_SESSION['staffId'];
        }
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

    /**
     *  Reroute application. 
     *  @param int id Application Identification or Lead Identification
     *  @param enum ('app','leaf') type Application Or Leaf
     **/

    function route($pageId, $pageType) {
        $sql        = null;
        $appendFile = null;
        $error      = 0;
       

      
        switch ($pageType) {
            case 'application':
                
                if ($this->getVendor() == self::MYSQL) {
                    $sql = "
                    SELECT  `applicationFilename` as `filename`
                    FROM    `application`
                    JOIN    `applicationAccess`
                    USING   (`applicationId`)
                    WHERE   `applicationAccess`.`roleId`    =   '" . $this->roleId . "'
                    AND     `applicationId`                 =   '".$pageId."'
                    AND     `application`.`isActive`    =    1       ";
                }
                break;
           case 'module':
                
                if ($this->getVendor() == self::MYSQL) {
                    $sql = "
                    SELECT  `moduleFilename` as `filename`
                    FROM    `module`
                    JOIN    `moduleAccess`
                    USING   (`moduleId`)
                    WHERE   `moduleAccess`.`roleId` =   '" . $this->roleId . "'
                    AND     `moduleId`              =   '".$pageId."'
                    AND     `module`.`isActive`     =    1       ";
                }
                break;
                
             case 'folder':
                
                if ($this->getVendor() == self::MYSQL) {
                    $sql = "
                    SELECT  `folderFilename` as `filename`
                    FROM    `folder`
                    JOIN    `folderAccess`
                    USING   (`folderId`)
                    WHERE   `folderAccess`.`roleId` =   '" . $this->roleId . "'
                    AND     `folderId`              =   '".$pageId."'
                    AND     `folder`.`isActive`     =    1      ";
                }
                break;   
            case 'leaf':
                if ($this->getVendor() == self::MYSQL) {
                    $sql = "
                    SELECT  concat(`folder`.`folderPath`,`leaf`.`leafFilename`) as `filename`
                    FROM    `leaf`
                    JOIN    `leafAccess`
                    USING   (`leafId`)
                    JOIN    `folder`
                    USING   (`folderId`)
                    WHERE   `leafAccess`.`staffId` =    '" . $_SESSION['staffId'] . "'
                    AND     `leafId`               =    '".$pageId."'
                    AND     `leaf`.`isActive`      =    1
                    AND     `folder`.`isActive`    =    1   ";
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
        if (isset($_SESSION['roleId'])) {
            $this->roleId = $_SESSION['roleId'];
        }
        if ($this->getVendor() == self::MYSQL) {
            $sql = "
            SELECT  `applicationTranslate`.`applicationNative`,
                    `application`.`applicationId`,
                    `application`.`isSingle`
            FROM    `" . $this->q->getCoreDatabase() . "`.`application` 
            JOIN    `" . $this->q->getCoreDatabase() . "`.`applicationAccess`
            USING   (`applicationId`)
            JOIN    `" . $this->q->getCoreDatabase() . "`.`applicationTranslate`
            USING   (`applicationId`)
            WHERE   1
            AND     `applicationAccess`.`applicationAccessValue`    =   1
            AND     `applicationAccess`.`roleId` =   '" . $this->roleId . "'
            AND     `application`.`isActive`=1
            ORDER BY `application`.`applicationSequence`";
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
        if (isset($_SESSION['roleId'])) {
            $this->roleId = $_SESSION['roleId'];
        }
        if ($this->getVendor() == self::MYSQL) {
           $sql = "
        SELECT  `moduleTranslate`.`moduleNative`,
        	`module`.`moduleId`,
                `module`.`isSingle`
        FROM     `" . $this->q->getCoreDatabase() . "`.`module`
        JOIN     `" . $this->q->getCoreDatabase() . "`.`moduleAccess`
        USING   (`moduleId`)
        JOIN    `" . $this->q->getCoreDatabase() . "`. `moduleTranslate`
        USING   (`moduleId`)
        JOIN    `" . $this->q->getCoreDatabase() . "`. `application` 
        USING	(`applicationId`)
        JOIN     `" . $this->q->getCoreDatabase() . "`.`applicationAccess`
        USING   (`applicationId`)
        WHERE   `moduleAccess`.`roleId`                         =   '" . $this->roleId . "'
        AND     `applicationAccess`.`roleId`                     =   '" . $this->roleId . "'
        AND     `moduleAccess`.`moduleAccessValue`              =   1
        AND     `applicationAccess`.`applicationAccessValue`    =   1
        AND     `application`.`applicationId`                   =   '" . $applicationId . "'
        AND     `application`.`isActive`=1
        AND     `module`.`isActive`=1
        ORDER BY `application`.`applicationSequence`,
                 `module`.`moduleSequence` ";
        } else if ($this->getVendor() == self::MSSQL) {
            $sql = "
        SELECT  * 
        FROM    `application` 
        JOIN    `applicationAccess`
        USING   (`applicationId`)
        WHERE   `roleId`='" . $_SESSION['roleId'] . "'";
        } else if ($this->getVendor() == self::ORACLE) {
            $sql = "
        SELECT  * 
        FROM    `application` 
        JOIN    `applicationAccess`
        USING   (`applicationId`)
        WHERE   `roleId`='" . $_SESSION['roleId'] . "'";
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
     *  @param numeric $applicaitionId Folder Identification
     *  @param numeric $moduleId Module Identification
     */
    public function folder($applicationId = null,$moduleId=null) {
    

        $data = array();
        if (isset($_SESSION['roleId'])) {
            $this->roleId = $_SESSION['roleId'];
        }
        if ($this->getVendor() == self::MYSQL) {
           $sql = "
        SELECT  `folderTranslate`.`folderNative`,
                `folder`.`applicationId`,
                `folder`.`moduleId`,
                `folder`.`folderId`,
                `folder`.`folderPath`,
                `folder`.`isSingle`,
                `icon`.`iconId`,
                `icon`.`iconName`
        FROM    `" . $this->q->getCoreDatabase() . "`.`folder`
        JOIN    `" . $this->q->getCoreDatabase() . "`.`folderAccess`
        USING   (`folderId`)
        JOIN    `" . $this->q->getCoreDatabase() . "`.`folderTranslate`
        USING   (`folderId`)
        LEFT JOIN    `" . $this->q->getCoreDatabase() . "`.`icon`
        USING   (`iconId`)
        WHERE   `folderAccess`.`folderAccessValue`  =   1
        AND     `folder`.`applicationId`            =   '".$applicationId."'
        AND     `folder`.`moduleId`                 =   '".$moduleId."'
        AND     `folderAccess`.`roleId`             =   '" . $this->roleId . "'
        AND     `folder`.`isActive`=1
        ORDER BY `folder`.`folderSequence`";
        }




        $result = $this->q->fast($sql);
        if($this->q->execute == 'fail') {
            $this->exceptionMessage($this->q->responce);
        }
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
        if (isset($_SESSION['roleId'])) {
            $this->roleId = $_SESSION['roleId'];
        }

        if ($this->getVendor() == self::MYSQL) {
           $sql = "
        SELECT  *
        FROM   `" . $this->q->getCoreDatabase() . "`.`leaf`
        JOIN    `" . $this->q->getCoreDatabase() . "`.`leafAccess`
        USING   (`leafId`)
        JOIN    `" . $this->q->getCoreDatabase() . "`.`leafTranslate`
        USING   (`leafId`)
        WHERE   `leafAccess`.`staffId`                  =   '" . $_SESSION['staffId'] . "'
        AND     `leafAccess`.`leafAccessReadValue`           =   1
        AND     `leaf`.`applicationId`                 =   '" . $this->applicationId . "'
        AND     `leaf`.`moduleId`                     =   '" . $this->moduleId . "'
        AND     `leaf`.`folderId`                     =   '" . $this->folderId . "'
        AND     `leaf`.`isActive`=1
        ORDER BY `leaf`.`leafSequence`";
        } else if ($this->getVendor() == self::MSSQL) {
            $sql = "
        SELECT  * 
        FROM    `application` 
        JOIN    `applicationAccess`
        USING   (`applicationId`)
        WHERE   `roleId`='" . $_SESSION['roleId'] . "'";
        } else if ($this->getVendor() == self::ORACLE) {
            $sql = "
        SELECT  * 
        FROM    `application` 
        JOIN    `applicationAccess`
        USING   (`applicationId`)
        WHERE   `roleId`='" . $_SESSION['roleId'] . "'";
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
            $sql = "
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
                  //  $row['staffAvatar'] = 'Cool.png';

                  //  return $row['staffAvatar'];
                } else {
                  //  return 'evil.gif';
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
