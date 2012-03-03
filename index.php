<?php

namespace Core\Portal\Controller;

require_once './library/class/classAbstract.php';
require_once './package/portal/main/view/portalView.php';
require_once './package/portal/main/service/portalService.php';
require_once './package/system/management/model/staffModel.php';

class PortalControllerClass extends \Core\ConfigClass {

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
    private $portalView;

    function __construct() {
        
    }

    /**
     *  main function
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

        $this->portalView = new \Core\Portal\View\PortalViewClass();


        if ($this->model->getStaffName() && $this->model->getStaffPassword()) {

            // process the  login
            $this->authentication($this->model->getStaffName(), $this->model->getStaffPassword());
            exit();
        } else {

            // index page view.
            $this->portalView->htmlView("portal.php", "portal");
            exit();
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

    public function authentication() {
        header('Content-Type:application/json; charset=utf-8');
        if ($this->getVendor() == self::MYSQL) {
            $sql = "SET NAMES \"utf8\"";
            $this->q->fast($sql);
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


            echo json_encode(array("success" => true, "message" => $this->systemString->getLoginSuccess(), "staffName" => $_SESSION['staffName']));
            exit();
        } else {
            echo json_encode(array("success" => false, "message" => $this->systemString->getLoginError()));
            exit();
        }
    }

    /*
     *  Left Menu Navigation.By default only appear user avatar and the most top 5 visit. 
     *  
     */

    function leftCell($id) {
        $str = $this->leftCellImage();
        if ($id) {
            $str.=$this->leftCellMenu($id);
        }
        $str.=$this->leftCellTopFive();
        return $str;
    }

    function leftCellImage() {
        $sql = "SELECT staffAvatar FROM `staff`";
        $sql = $this->q->fast($sql);
        if ($this->q->execute == 'fail') {
            echo json_encode(array("success" => false, "message" => $this->q->responce));
            exit();
        }
        $row = $this->q->fetchRow($result);
        $row['staffAvatar'] = 'Cool.png';
        $str = "<br> 	
                <a href=\"\" class=\"thumbnail\"><img src=\"images/Blueticons_Win/PNGs/" . $row['staffAvatar'] . "\" alt=\"It's me\" width=\"100\" height=\"100\"></a>
                <hr>";
        return $str;
    }

    function leftCellMenu($applicationId, $moduleId) {
          $str.="<div class=\"sidebar-nav\">
                        <ul class=\"nav nav-list\">";
        if ($this->getVendor() == self::MYSQL) {
            $sqlFolder = "
            SELECT      `folderAccess`.`folderAccessId`,
                        `folderAccess`.`folderAccessValue`,									
                        `folder`.`folderId`,
                        `folder`.`folderPath`,
                        `folderTranslate`.`folderNative`,
                        `team`.`teamId`,
                        `icon`.`iconName`	
            FROM        `".$this->q->getCoreDatabase()."`.`folderAccess`
            JOIN        `".$this->q->getCoreDatabase()."`.`folder`
            USING       (`folderId`)
            JOIN        `".$this->q->getCoreDatabase()."`.`folderTranslate`
            USING       (`folderId`)
            JOIN        `".$this->q->getCoreDatabase()."`.`icon`
            USING       (`iconId`)
            JOIN        `".$this->q->getManagementDatabase()."`.`team`
            USING       (`teamId`)
            WHERE       `folder`.`moduleId`                 =	'" . $moduleId . "'
            AND         `folderAccess`.`teamId`             =	'" . $_SESSION ['teamId'] . "'
            AND         `folderAccess`.`folderAccessValue`  =   1
            AND    	`folderTranslate`.`languageId`      =	'" . $_SESSION ['languageId'] . "'
            AND         `folder`.`applicationId`            =	'" . $applicationId . "'					      
            AND		`team`.`isActive`                   =	1
            AND		`folderTranslate`.`isActive`        =   1
            AND         `folder`.`isActive`                 =	1 		
            ORDER BY    `folder`.`folderSequence`  ";
        } elseif ($this->getVendor() == self::MSSQL) {
            $sqlFolder = "
				      SELECT    [folderAccessId],
				      			[teamId],
				      			[folderAccessValue],
				      			[folderId],
				      			[folderPath],
				      			[folderNative],
				      			[iconName]
				      FROM     	[folderAccess]
				      JOIN      [folder]
				      ON      	[folderAccess].[folderId]=[folder].[folderId]
				      JOIN      [folderTranslate]
				      ON      	[folderTranslate].[folderId]=[folder].[folderId]
				      JOIN      [icon]
				      ON      	[icon].[iconId]=[folder].[iconId]
				      JOIN		[team]
				      ON		[team].[teamId] = [folderAccess].[teamId]
				      WHERE     [moduleId]							=	'" . $moduleId . "'
				      AND       [folderAccess].[teamId]			=	'" . $_SESSION ['teamId'] . "'
				      AND   	[folderAccess].[folderAccessValue]	=   1
				      AND    	[folderTranslate].[languageId]		=	'" . $_SESSION ['languageId'] . "'
				      AND		[team].[isActive]					=	1
				      AND		[folderTranslate].[isActive]		=   1
					  AND		[folder].[isActive`					=	1 	
				      ORDER BY	[folder].[folderSequence]  	";
        } elseif ($this->getVendor() == self::ORACLE) {
            $sqlFolder = "
				      SELECT    FOLDERACCESS.FOLDERACCESSID 	AS	\"folderAccessId\",
				      			FOLDERACCESS.TEAMID 			AS 	\"teamId\",
				      			FOLDERACCESS.FOLDERACCESSVALUE 	AS 	\"folderAccessValue\",
				      			FOLDER.FOLDERID 				AS 	\"folderId\",
				      			FOLDER.FOLDERPATH				AS	\"folderPath\",
				      			FOLDERTRANSLATE.FOLDERNATIVE 	AS 	\"folderNative\",
				      			ICON.ICONNAME 					AS 	\"iconName\"
				      FROM     	FOLDERACCESS
				      JOIN    	FOLDER
				      ON		FOLDERACCESS.FOLDERID			= 	FOLDER.FOLDERID
				      JOIN    	FOLDERTRANSLATE
				      ON		FOLDERTRANSLATE.FOLDERID		= 	FOLDER.FOLDERID
				      LEFT JOIN	ICON
				      ON		ICON.ICONID						= 	FOLDER.ICONID
				      JOIN      TEAM
				      ON		TEAM.TEAMID						= 	FOLDERACCESS.TEAMID
				      WHERE     FOLDER.MODULEID					=	'" . $moduleId . "'
				      AND       FOLDERACCESS.TEAMID				=	'" . $_SESSION ['teamId'] . "'
				      AND     	FOLDERACCESS.FOLDERACCESSVALUE	=  	1
				      AND      	FOLDERTRANSLATE.LANGUAGEID		=	'" . $_SESSION ['languageId'] . "'
				      AND		TEAM.ISACTIVE 					=	1
				      AND		FOLDERTRANSLATE.ISACTIVE`		=   1
					  AND		FOLDER.ISACTIVE					=	1 	
				      ORDER BY  FOLDER.FOLDERSEQUENCE  ";
        }
        $resultFolder = $this->q->fast($sqlFolder);
        $totalFolder = $this->q->numberRows($resultFolder, $sqlFolder);
        $counterFolder = 0;
        if ($totalFolder > 0) {
            while (($rowFolder = $this->q->fetchArray($resultFolder)) == TRUE) {
                $folderNative = $rowFolder ['folderNative'];
                $iconName = $rowFolder ['iconName'];
                $folderId = $rowFolder ['folderId'];
                $folderPath = $rowFolder ['folderPath'];
                $str.="<li class=\"nav-header\" onclick=\"showMeSideBar(".$counterFolder.",".$totalFolder.")\" onmouseover=\"showMeSideBar(".$counterFolder.",".$totalFolder.")\"><img id=\"folder1\" src=\"images/icons/".$iconName.".png\" alt=\"application\">".$folderNative."</li>";
                if ($this->getVendor() == self::MYSQL) {
                    $sqlLeaf = "
                    SELECT   	`leafAccess`.`leafAccessId`,
                                `leafAccess`.`staffId`,
                                `leafAccess`.`leafAccessReadValue`,
                                `leaf`.`leafId`,
                                `leaf`.`leafFilename`,
                                `leafTranslate`.`leafNative`,
                                `icon`.`iconName`
                    FROM    	`".$this->q->getCoreDatabase()."`.`leafAccess`
                    JOIN    	`".$this->q->getCoreDatabase()."`.`leaf`
                    USING       (`leafId`)
                    JOIN    	`".$this->q->getCoreDatabase()."`.`leafTranslate`
                    USING       (`leafId`)
                    JOIN    	`".$this->q->getCoreDatabase()."`.`icon`
                    USING       (`iconId`)
                    WHERE    	`leaf`.`folderId`					=	'" . $folderId . "'
                    AND      	`leaf`.`moduleId`					=	'" . $moduleId . "'
                    AND      	`leafAccess`.`staffId`		=	'" . $_SESSION ['staffId'] . "'
                    AND      	`leafTranslate`.`languageId`	=	'" . $_SESSION ['languageId'] . "'
                    AND		`leaf`.`applicationId`		=	'" . $_SESSION['applicationId'] . "'
                    AND		`leaf`.`isActive`			=	1
                    AND         `leafTranslate`.`isActive`  =   1			          
                    ORDER BY    `leaf`.`leafSequence`  ";

                    //print"<br>".$sqlLeaf."<br>";
                } elseif ($this->getVendor() == self::MSSQL) {
                    $sqlLeaf = "
					          SELECT   	[leafAccessId],
						      			[staffId],
						      			[leafAccessReadValue],
						      			[leafId],
						      			[leafFilename],
						      			[leafNative],
						      			[iconName]
					          FROM    	[leafAccess]
					          JOIN      [leaf]
					          ON      	[leafAccess].[leafId]=[leaf].[leafId]
					          JOIN      [leafTranslate]
					          ON      	[leafTranslate].[leafId]=[leaf].[leafId]
					          JOIN      [icon]
					          ON      	[icon].[iconId]=[leaf].[iconId]
					          WHERE     [folderId]						=	'" . $folderId . "'
					          AND      	[moduleId]						=	'" . $moduleId . "'
					          AND      	[leafAccess].[staffId]			=	'" . $_SESSION ['staffId'] . "'
					          AND      	[leafTranslate].[languageId]	=	'" . $_SESSION ['languageId'] . "'
					          ORDER BY  [leaf].[leafSequence]";
                } elseif ($this->getVendor() == self::ORACLE) {
                    $sqlLeaf = "
					          SELECT  	LEAFACCESS.LEAFACCESSID 		AS 	\"leafAccessId\",
						      			LEAFACCESS.STAFFID 				AS 	\"staffId\",
						      			LEAFACCESS.leafAccessReadValue 	AS	\"leafAccessReadValue\",
						      			LEAF.LEAFID 					AS 	\"leafId\",
						      			LEAF.LEAFFILENAME				AS	\"leafFilename\",
						      			LEAFTRANSLATE.LEAFNATIVE 		AS 	\"leafNative\",
						      			ICON.ICONNAME 					AS	\"iconName\"
					          FROM   	LEAFACCESS
					          JOIN    	LEAF
					          ON		LEAF.LEAFID						= 	LEAFACCESS.LEAFID
					          JOIN      LEAFTRANSLATE
					          ON		LEAFTRANSLATE.LEAFID			= 	LEAF.LEAFID
					          LEFT JOIN ICON
					          ON		ICON.ICONID						= 	LEAF.ICONID
					          JOIN		STAFF	
					          ON		STAFF.STAFFID					=  	LEAFACCESS.STAFFID
					          WHERE     LEAF.FOLDERID					=	'" . $folderId . "'
					          AND		LEAF.MODULEID					=	'" . $moduleId . "'
					          AND      	LEAFACCESS.STAFFID				=	'" . $_SESSION ['staffId'] . "'
					          AND      	LEAFTRANSLATE.LANGUAGEID		=	'" . $_SESSION ['languageId'] . "'
					          AND		LEAFACCESS.leafAccessReadValue 	=	1
					          ORDER BY  LEAF.LEAFSEQUENCE";
                }
                $resultLeaf = $this->q->fast($sqlLeaf);
                $totalLeaf = $this->q->numberRows($resultLeaf, $sqlLeaf);
                $counterLeaf = 0;
                if ($totalLeaf > 0) {
                    $str.="<li  id=\"common1\" class=\"hide\"><ul class=\"nav nav-list\">";
                    while (($rowLeaf = $this->q->fetchArray($resultLeaf)) == TRUE) {
                        $leafNative = $rowLeaf ['leafNative'];
                        $iconName = $rowLeaf ['iconName'];
                        $leafFilename = $rowLeaf ['leafFilename'];
                        $counterLeaf ++;
                        $str.="<li class=\"hide\"> 
                                    <a href=\"#\" onclick=\"routing(".$counterLeaf.",".$totalLeaf.",'".$leafFilename."')\">
                                        <img src=\"images/icons/application-form.png\" alt=\"application\">".$leafNative."</a>
                                        <div id=\"choosenLeaf1\"></div>
                                        <div id=\"choosenLeafWaitingIcon1\"></div></li>";
                    }
                    $str."</li></ul></li>";
                }
            }
        
            $str."</li>";
        }


        
        $str.="</ul></div>";

        return $str;
    }

    function leftCellTopFive() {
        
    }

    function leftCellBookmark() {
        $sql = "SELECT staffAvatar FROM `leafUserBookmark` ";
        $this->q->read($sql);
        if ($this->q->execute == 'fail') {
            echo json_encode(array("success" => false, "message" => $this->q->responce));
            exit();
        }
        $row = $this->q->fetchRow();
    }

    /*
     * 
     */

    function centerCell($id) {
        
    }

}

$x = new PortalControllerClass();
$x->execute();
?>
