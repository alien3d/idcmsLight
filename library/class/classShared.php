<?php

namespace Core\shared;
require_once("classAbstract.php");
class SharedClass extends \Core\ConfigClass {

    /**
     * Database connection object
     * @var string $this->q
     */
    private $q;

    function __construct() {
        
    }

// end basic access database
    public function execute() {
        parent::__construct();
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
        $this->q->connect($this->getConnection(), $this->getUsername(), $this->getDatabase(), $this->getPassword());
    }

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

    /**
     *
     * @return array
     */
    function getSystemFormat() {
        if ($this->q->vendor == self::MYSQL) {
            /*             * *
             * set global output UTF8
             */
            $sql = "SET NAMES \"utf8\"";
            $this->q->fast($sql);
        }
        /**
         *  Basic System Information ,Date and  Currency Format
         */
        if ($this->q->vendor == self::MYSQL) {
            $sql = "
	SELECT `systemSettingDateFormat`,
		   `systemSettingTimeFormat`,
		   `systemSettingNumberFormat`,
		   `countryId`,
		   `systemSettingCurrencyFormat`
	FROM   `systemSetting`	";
        } else if ($this->q->vendor == self::MSSQL) {
            $sql = "
	SELECT [systemSettingDateFormat],
		   [systemSettingTimeFormat],
		   [systemSettingNumberFormat],
		   [countryId],
		   [systemSettingCurrencyFormat]
	FROM   [systemSetting]	";
        } else if ($this->q->vendor == self::ORACLE) {
            $sql = "
	SELECT SYSTEMSETTINGDATEFORMAT,
		   SYSTEMSETTINGTIMEFORMAT,
		   SYSTEMSETTINGNUMBERFORMAT,
		   COUNTRYID,
		   SYSTEMSETTINGCURRENCYFORMAT
	FROM   SYSTEMSETTING	";
        } else if ($this->q->vendor == self::DB2) {
            $sql = "
	SELECT SYSTEMSETTINGDATEFORMAT,
		   SYSTEMSETTINGTIMEFORMAT,
		   SYSTEMSETTINGNUMBERFORMAT,
		   COUNTRYID,
		   SYSTEMSETTINGCURRENCYFORMAT
	FROM   SYSTEMSETTING	";
        } else if ($this->q->vendor == self::POSTGRESS) {
            $sql = "
	SELECT SYSTEMSETTINGDATEFORMAT,
		   SYSTEMSETTINGTIMEFORMAT,
		   SYSTEMSETTINGNUMBERFORMAT,
		   COUNTRYID,
		   SYSTEMSETTINGCURRENCYFORMAT
	FROM   SYSTEMSETTING	";
        }

        $result = $this->q->fast($sql);
        if ($result) {
            $row = $this->q->fetchAssoc($result);
            return $row;
        }
    }

    /**
     *
     * @return array
     */
    function getLeafTranslation() {
//dummy initilization
        $data = array();
        if ($this->q->vendor == self::MYSQL) {
// future
				$sql = "
                SELECT 			`tableMapping`.`tableMappingColumnName`,
                                 `tableMappingTranslate`.`tableMappingNative`
                FROM 			`tableMapping`
                JOIN			`tableMappingTranslate`
                USING			(`tableMappingId`)
                WHERE 			`tableMappingTranslate`.`languageId`	=	'" . $_SESSION ['languageId'] . "'
				AND				`tableMappingName`						= 	'".$this->getCurrentTable()."'
				AND				`databaseName`							= 	'".$this->getCurrentDatabase()."'";
        } else if ($this->q->vendor == self::MSSQL) {
            $sql = "
                SELECT 			[tableMapping].[tableMappingColumnName],
                                [tableMappingTranslate].[tableMappingNative]
                FROM 			[tableMapping]
                JOIN			[tableMappingTranslate]
                USING			[tableMapping].[tableMappingId]	=	[tableMappingTranslate].[tableMappingId]
                WHERE 			[tableMapping].[languageId]		=	'" . $_SESSION ['languageId'] . "'
				AND				[tableMappingName]				= 	'".$this->getCurrentTable()."'
				AND				[databaseName]					= 	'".$this->getCurrentDatabase()."'";
        } else if ($this->q->vendor == self::ORACLE) {
            $sql = "
                SELECT DISTINCT TABLEMAPPING.TABLEMAPPINGCOLUMNNAME 			AS 	\"tableMappingColumnName\",
                                TABLEMAPPINGTRANSLATE.TABLEMAPPINGNATIVELABEL	AS	\"tableMappingNative\"
                FROM 			TABLEMAPPING
                JOIN			TABLEMAPPINGTRANSLATE
                USING			(TABLEMAPPINGID)
                WHERE 			TABLEMAPPING.LANGUAGEID	=	'" . $_SESSION ['languageId'] . "'
				AND				TABLEMAPPINGNAME		= '".$this->getCurrentTable()."'
				AND				DATABASENAME			= '".$this->getCurrentDatabase()."'";
        } else if ($this->q->vendor == self::DB2) {
            $sql = "
                SELECT DISTINCT TABLEMAPPING.TABLEMAPPINGCOLUMNNAME 			AS 	\"tableMappingColumnName\",
                                TABLEMAPPINGTRANSLATE.TABLEMAPPINGNATIVELABEL	AS	\"tableMappingNative\"
                FROM 			TABLEMAPPING
                JOIN			TABLEMAPPINGTRANSLATE
                USING			(TABLEMAPPINGID)
                WHERE 			TABLEMAPPING.LANGUAGEID	=	'" . $_SESSION ['languageId'] . "'
				AND				TABLEMAPPINGNAME		= 	'".$this->getCurrentTable()."'
				AND				DATABASENAME			= 	'".$this->getCurrentDatabase()."'";
        } else if ($this->q->vendor == self::POSTGRESS) {
            $sql = "
                SELECT DISTINCT TABLEMAPPING.TABLEMAPPINGCOLUMNNAME 			AS 	\"tableMappingColumnName\",
                                TABLEMAPPINGTRANSLATE.TABLEMAPPINGNATIVELABEL	AS	\"tableMappingNative\"
                FROM 			TABLEMAPPING
                JOIN			TABLEMAPPINGTRANSLATE
                USING			(TABLEMAPPINGID)
                WHERE 			TABLEMAPPING.LANGUAGEID	=	'" . $_SESSION ['languageId'] . "'
				AND				TABLEMAPPINGNAME		= 	'".$this->getCurrentTable()."'
				AND				DATABASENAME			= 	'".$this->getCurrentDatabase()."'";
        }

        $result = $this->q->fast($sql);

		if($result) { 
			while (($row = $this->q->fetchAssoc($result)) == TRUE) {
				$data[$row ['tableMappingColumnName'] . "Label"] = $row ['tableMappingNative'];
			}
		}
	
        return $data;
    }

    /**
     *
     * @return array
     */
    function getForeignkeyTranslation() {
        $data = array();


        if ($this->q->vendor == self::MYSQL) {
// future
            $sql = "
                SELECT 			`tableMappingForeignKey`.`tableMappingForeignKeyName`,
                                 `tableMappingForeignKeyTranslate`.`tableMappingForeignKeyNative`
                FROM 			`tableMappingForeignKey`
                JOIN			`tableMappingForeignKeyTranslate`
                USING			(`tableMappingForeignKeyId`)
                WHERE 			`tableMappingForeignKeyTranslate`.`languageId`='" . $_SESSION ['languageId'] . "'";
        } else if ($this->q->vendor == self::MSSQL) {
            $sql = "
                SELECT 			[tableMapping].[tableMappingColumnName],
                                [tableMappingTranslate].[tableMappingNative]
                FROM 			[tableMapping]
                JOIN			[tableMappingTranslate]
                USING			[tableMapping].[tableMappingId]=[tableMappingTranslate].[tableMappingId]
                WHERE 			[tableMapping].[languageId]='" . $_SESSION ['languageId'] . "'";
        } else if ($this->q->vendor == self::ORACLE) {
            $sql = "
                SELECT DISTINCT TABLEMAPPING.TABLEMAPPINGCOLUMNNAME 			AS 	\"tableMappingColumnName\",
                                TABLEMAPPINGTRANSLATE.TABLEMAPPINGNATIVELABEL	AS	\"tableMappingNative\"
                FROM 			TABLEMAPPING
                JOIN			TABLEMAPPINGTRANSLATE
                USING			(TABLEMAPPINGID)
                WHERE 			TABLEMAPPING.LANGUAGEID='" . $_SESSION ['languageId'] . "'";
        } else if ($this->q->vendor == self::DB2) {
            
        } else if ($this->q->vendor == self::POSTGRESS) {
            
        }

        $result = $this->q->fast($sql);

        while (($row = $this->q->fetchAssoc($result)) == TRUE) {       
			$data[$row ['tableMappingForeignKeyName'] . "Label"] = $row ['tableMappingForeignKeyNative'];
        }


        return $data;
    }

    /**
     *
     * @return array
     */
    function getDefaultTranslation() {
        $data = array();
        if ($this->q->vendor == self::MYSQL) {
            $sql = "
                SELECT	*
                FROM 	`defaultLabel`
                JOIN 	`defaultLabelTranslate`
                USING 	(`defaultLabelId`)
                WHERE 	`defaultLabelTranslate`.`languageId`	=	'" . $_SESSION ['languageId'] . "'";
        } else if ($this->q->vendor == self::MSSQL) {
            $sql = "
                SELECT	*
                FROM 	[defaultLabel]
                JOIN 	[defaultLabelTranslate]
                ON      [defaultLabel] .[defaultLabelId]=  [defaultLabelTranslate] .[defaultLabelId]
                WHERE 	[defaultLabelTranslate].[languageId]	=	'" . $_SESSION ['languageId'] . "'";
        } else if ($this->q->vendor == self::ORACLE) {
            $sql = "
                SELECT	DEFAULTLABEL.DEFAULTLABEL 				AS \"defaultLabel\",
                        DEFAULTLABELTRANSLATE.DEFAULTLABELTEXT 	AS \"defaultLabelText\"
                FROM 	DEFAULTLABEL
                JOIN 	DEFAULTLABELTRANSLATE
                ON		DEFAULTLABEL.DEFAULTLABELID 			= 	DEFAULTLABELTRANSLATE.DEFAULTLABELID
                WHERE 	DEFAULTLABELTRANSLATE.LANGUAGEID		=	'" . $_SESSION ['languageId'] . "'";
        } else if ($this->q->vendor == self::DB2) {
            
        } else if ($this->q->vendor == self::POSTGRESS) {
            
        }
        $result = $this->q->fast($sql);
        while ($row = $this->q->fetchAssoc($result)) {
			$data[$row ['defaultLabel']] = $row ['defaultLabelNative'];
        }
        return $data;
    }

    /**
     *
     * @return array 
     */
    public function getButtonTranslation() {
// for temporary use english first
        $button = array();
        $button['isAuditLabel'] = 'Audit';
		$button['isPostLabel'] = 'Post';
		$button['isDefaultLabel'] = 'Default Value';
		$button['isResetLabel'] = 'Reset';
        $button['isNewLabel'][0] = 'New';
        $button['isNewLabel'][1] = 'New &AMP; Continue';
        $button['isNewLabel'][2] = 'New &AMP; Update ';
        $button['isNewLabel'][3] = 'New &AMP; Continue &AMP; Print ';
        $button['isNewLabel'][4] = 'New &AMP; Update &AMP; Print ';
        $button['isNewLabel'][5] = 'New &AMP; Listing ';
        $button['isDraftLabel'] = 'Draft';
        $button['isUpdateLabel'][0] = 'Update';
        $button['isUpdateLabel'][1] = 'Update';
        $button['isUpdateLabel'][2] = 'Update &AMP; Print ';
        $button['isUpdateLabel'][3] = 'Update &AMP; Listing';
        $button['isDeleteLabel'] = 'Delete';
        $button['isActive'] = 'Active';
        $button['isApprovedLabel'] = 'Approved';
        $button['auditButtonLabel'] = 'Audit';
        return $button;
    }

    public function getLeafAccess() {

        if ($this->q->vendor == self::MYSQL) {
            $sql = "	SELECT	*
        FROM	`leaf`
        JOIN	`leafAccess`
        USING 	(`leafId`)
        JOIN 	`leafTranslate`
        USING	(`leafId`)
        WHERE  	`leaf`.`leafFilename`			=	'" . basename($_SERVER ['PHP_SELF']) . "'
        AND  	`leafAccess`.`staffId`			=	'" . $_SESSION ['staffId'] . "'
        AND		`leafTranslate`.`languageId`	=	'" . $_SESSION ['languageId'] . "'";
        } else if ($this->q->vendor == self::MSSQL) {
            $sql = "	
        SELECT	*
        FROM	[leaf]
        JOIN	[leafAccess]
        ON 		[leaf].[leafId]					= 	[leafAccess].[leafId]
        JOIN 	[leafTranslate]
        ON		[leafAccess].[leafId]			=	[leafTranslate].[leafId]
        AND 	[leafTranslate].[leafId]		= 	[leaf].[leafId]
        WHERE  	[leaf].[leafFilename]			=	'" . basename($_SERVER ['PHP_SELF']) . "'
        AND  	[leafAccess].[staffId]			=	'" . $_SESSION ['staffId'] . "'
        AND		[leafTranslate].[languageId]	=	'" . $_SESSION ['languageId'] . "'";
        } else if ($this->q->vendor == self::ORACLE) {

            $sql = "	SELECT	LEAF.LEAFID 						AS  \"leafId\",
                        LEAFTRANSLATE.LEAFNATIVE 		AS	\"leafNative\"
        FROM	LEAF
        JOIN	LEAFACCESS
        ON		LEAF.LEAFID 				= 	LEAFACCESS.LEAFID
        JOIN 	LEAFTRANSLATE
        ON		LEAF.LEAFID 				= 	LEAFTRANSLATE.LEAFID
        WHERE  	LEAF.LEAFFILENAME			=	'" . basename($_SERVER ['PHP_SELF']) . "'
        AND  	LEAFACCESS.STAFFID			=	'" . $_SESSION ['staffId'] . "'
        AND		LEAFTRANSLATE.LANGUAGEID	=	'" . $_SESSION ['languageId'] . "'";
        } else if ($this->q->vendor == self::DB2) {
            $sql = "	SELECT	LEAF.LEAFID 						AS  \"leafId\",
                        LEAFTRANSLATE.LEAFNATIVE 		AS	\"leafNative\"
        FROM	LEAF
        JOIN	LEAFACCESS
        ON		LEAF.LEAFID 				= 	LEAFACCESS.LEAFID
        JOIN 	LEAFTRANSLATE
        ON		LEAF.LEAFID 				= 	LEAFTRANSLATE.LEAFID
        WHERE  	LEAF.LEAFFILENAME			=	'" . basename($_SERVER ['PHP_SELF']) . "'
        AND  	LEAFACCESS.STAFFID			=	'" . $_SESSION ['staffId'] . "'
        AND		LEAFTRANSLATE.LANGUAGEID	=	'" . $_SESSION ['languageId'] . "'";
        } else if ($this->q->vendor == self::POSTGRESS) {
            $sql = "	SELECT	LEAF.LEAFID 						AS  \"leafId\",
                        LEAFTRANSLATE.LEAFNATIVE 		AS	\"leafNative\"
        FROM	LEAF
        JOIN	LEAFACCESS
        ON		LEAF.LEAFID 				= 	LEAFACCESS.LEAFID
        JOIN 	LEAFTRANSLATE
        ON		LEAF.LEAFID 				= 	LEAFTRANSLATE.LEAFID
        WHERE  	LEAF.LEAFFILENAME			=	'" . basename($_SERVER ['PHP_SELF']) . "'
        AND  	LEAFACCESS.STAFFID			=	'" . $_SESSION ['staffId'] . "'
        AND		LEAFTRANSLATE.LANGUAGEID	=	'" . $_SESSION ['languageId'] . "'";
        }

        $result = $this->q->fast($sql);
        if ($result) {
            $row = $this->q->fetchAssoc($result);
            return $row;
        }
    }

    /**
     *
     * @return array 
     */
    public function getAdminAccess() {
        $data = array();
        if ($this->q->vendor == self::MYSQL) {
            $sql = "
                        SELECT	`role`.`isAdmin`
                        FROM 	`staff`
                        JOIN	`role`
                        USING	(`roleId`)
                        WHERE 	`staff`.`staffId`	=	'" . $_SESSION ['staffId'] . "'
                        AND		`role`.`roleId`		=	'" . $_SESSION ['roleId'] . "'
                        AND		`staff`.`isActive`	=	1
                        AND		`role`.`isActive`	=	1";
        } else if ($this->q->vendor == self::MSSQL) {
            $sql = "
                        SELECT	[role].[isAdmin]
                        FROM 	[staff]
                        JOIN	[role]
                        ON		[staff].[roleId]  	= 	[role].[roleId]
                        WHERE 	[staff].[staffId]	=	'" . $_SESSION ['staffId'] . "'
                        AND		[role].[roleId]		=	'" . $_SESSION ['roleId'] . "'
                        AND		[staff].[isActive]	=	1
                        AND		[role].[isActive]	=	1";
        } else if ($this->q->vendor == self::ORACLE) {
            $sql = "
                        SELECT	ROLE.ISADMIN AS \"isAdmin\"
                        FROM 	STAFF
                        JOIN	ROLE
                        ON		ROLE.roleId		= 	STAFF.roleId
                        WHERE 	STAFF.STAFFID	=	'" . $_SESSION ['staffId'] . "'
                        AND		ROLE.roleId		=	'" . $_SESSION ['roleId'] . "'
                        AND		STAFF.ISACTIVE	=	1
                        AND		ROLE.ISACTIVE	=	1";
        } else if ($this->q->vendor == self::DB2) {
            $sql = "
                        SELECT	ROLE.ISADMIN AS \"isAdmin\"
                        FROM 	STAFF
                        JOIN	ROLE
                        ON		ROLE.roleId		= 	STAFF.roleId
                        WHERE 	STAFF.STAFFID	=	'" . $_SESSION ['staffId'] . "'
                        AND		ROLE.roleId		=	'" . $_SESSION ['roleId'] . "'
                        AND		STAFF.ISACTIVE	=	1
                        AND		ROLE.ISACTIVE	=	1";
        } else if ($this->q->vendor == self::POSTGRESS) {
            $sql = "
                        SELECT	ROLE.ISADMIN AS \"isAdmin\"
                        FROM 	STAFF
                        JOIN	ROLE
                        ON		ROLE.roleId		= 	STAFF.roleId
                        WHERE 	STAFF.STAFFID	=	'" . $_SESSION ['staffId'] . "'
                        AND		ROLE.roleId		=	'" . $_SESSION ['roleId'] . "'
                        AND		STAFF.ISACTIVE	=	1
                        AND		ROLE.ISACTIVE	=	1";
        } else {
            echo json_encode(array("success" => false, "message" => "cannot identify vendor db[" . $this->q->vendor . "]"));
            exit();
        }

//echo $sql;
        $resultAdmin = $this->q->fast($sql);

        if ($this->q->numberRows($resultAdmin) > 0) {
            $rowAdmin = $this->q->fetchAssoc($resultAdmin);
            if ($row['isAdmin'] == 1) {
                $data['isDefaultHidden'] = false;
                $data['isNewHidden'] = false;
                $data['isDraftHidden'] = false;
                $data['isUpdateHidden'] = false;
                $data['isDeleteHidden'] = false;
                $data['isActiveHidden'] = false;
                $data['isApprovedHidden'] = false;
                $data['isReviewHidden'] = false;
                $data['isPostHidden'] = false;
                $data['auditButtonLabelDisabled'] = false;
            } else {
                $data['isDefaultHidden'] = true;
                $data['isNewHidden'] = true;
                $data['isDraftHidden'] = true;
                $data['isUpdateHidden'] = true;
                $data['isDeleteHidden'] = true;
                $data['isActiveHidden'] = true;
                $data['isApprovedHidden'] = true;
                $data['isReviewHidden'] = true;
                $data['isPostHidden'] = true;
                $data['auditButtonLabelDisabled'] = true;
            }
            return $data;
        }
    }

}

?>
