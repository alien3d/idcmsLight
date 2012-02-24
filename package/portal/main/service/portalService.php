<?php

namespace Core\Portal\Service;

session_start();
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
class PortalServiceClass extends \Core\ConfigClass {
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

        $this->q = new \Core\Database\Mysql\Vendor();

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
            return $returnArray;
        } else {
            $returnArray['success'] = false;
            $returnArray['message'] = $this->systemString->getLoginError();
            $returnArray['start'] = $start;
            return $returnArray;
        }
    }

}

?>