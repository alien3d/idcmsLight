<?php

$str.="<?php  namespace Core\\" . ucwords($data[0]['package']) . "\\" . ucwords($data[0]['module']) . "\\" . ucwords($data[0]['tableName']) . "\Model;\n";

$str.="require_once (\"../../../../library/class/classValidation.php\"); \n";

$str.="/** \n";
$str.="* this is " . $data[0]['tableName'] . " model file.This is to ensure strict setting enable for all variable enter to database \n";
$str.=" * \n";
$str.=" * @name IDCMS.\n";
$str.=" * @version 2\n";
$str.=" * @author hafizan\n";
$str.=" * @package " . ucwords($data[0]['package']) . " \n";
$str.=" * @subpackage " . ucwords($data[0]['module']) . " \n";
$str.=" * @link http://www.idcms.org\n";
$str.=" * @license http://www.gnu.org/copyleft/lesser.html LGPL\n";
$str.=" */\n";
$str.="class " . ucfirst($data[0]['tableName']) . "Model extends \Core\Validation\ValidationClass { \n";

$total = 0;
$total = count($data);
for ($i = 0; $i < $total; $i++) {

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
			$str.="
		\n
		/**\n
		* @var ".$data[$i]['formType']." \n
		*/\n
		private \$".$data[$i]['columnName']."; \n ";
		}
}		
$str.=" /* (non-PHPdoc)\n";
$str.="	 * @see ValidationClass::execute()\n";
$str.="	 */\n";
$str.="	public function execute() {\n";
$str.="		/*\n";
$str.="		 *  Basic Information Table\n";
$str.="		 */\n";
$str.="		\$this->setTableName('" . $data[0]['tableName'] . "');\n";
$str.="		\$this->setPrimaryKeyName('" . $data[0]['tableName'] . "');\n";
$str.="		\$this->setMasterForeignKeyName('" . $data[0]['tableName'] . "Id');\n";
$str.="		//\$this->setFilterCharacter('" . $data[0]['tableName'] . "Desc');\n";
$str.="		\$this->setFilterDate('" . $data[0]['tableName'] . "Date');\n";
$str.="		/**\n";
$str.="		 * All the $_POST enviroment.\n";
$str.="		 */ \n";



$str.="		/**\n";
$str.="		 * All the \$_GET enviroment.\n";
$str.="		 */\n";
$str.="		if (isset(\$_GET ['" . $data[0]['tableName'] . "Id'])) {\n";
$str.="			\$this->setTotal(count(\$_GET ['" . $data[0]['tableName'] . "Id']));\n";
$str.="		}\n";

$str.="		if (isset(\$_GET ['isDefault'])) {\n";
$str.="			if (is_array(\$_GET ['isDefault'])) {\n";
$str.="				\$this->isDefault = array();\n";
$str.="			}\n";
$str.="		}\n";
$str.="		if (isset(\$_GET ['isNew'])) {\n";
$str.="			if (is_array(\$_GET ['isNew'])) {\n";
$str.="				\$this->isNew = array();\n";
$str.="			}\n";
$str.="		}\n";
$str.="		if (isset(\$_GET ['isDraft'])) {\n";
$str.="			if (is_array(\$_GET ['isDraft'])) {\n";
$str.="				\$this->isDraft = array();\n";
$str.="			}\n";
$str.="		}\n";
$str.="		if (isset(\$_GET ['isUpdate'])) {\n";
$str.="			if (is_array(\$_GET ['isUpdate'])) {\n";
$str.="				\$this->isUpdate = array();\n";
$str.="			}\n";
$str.="		}\n";
$str.="		if (isset(\$_GET ['isDelete'])) {\n";
$str.="			if (is_array(\$_GET ['isDelete'])) {\n";
$str.="				\$this->isDelete = array();\n";
$str.="			}\n";
$str.="		}\n";
$str.="		if (isset(\$_GET ['isActive'])) {\n";
$str.="			if (is_array(\$_GET ['isActive'])) {\n";
$str.="				\$this->isActive = array();\n";
$str.="			}\n";
$str.="		}\n";
$str.="		if (isset(\$_GET ['isApproved'])) {\n";
$str.="			if (is_array(\$_GET ['isApproved'])) {\n";
$str.="				\$this->isApproved = array();\n";
$str.="			}\n";
$str.="		}\n";
$str.="		if (isset(\$_GET ['isReview'])) {\n";
$str.="			if (is_array(\$_GET ['isReview'])) {\n";
$str.="				\$this->isReview = array();\n";
$str.="			}\n";
$str.="		}\n";
$str.="		if (isset(\$_GET ['isPost'])) {\n";
$str.="			if (is_array(\$_GET ['isPost'])) {\n";
$str.="				\$this->isPost = array();\n";
$str.="			}\n";
$str.="		}\n";
$str.="		\$primaryKeyAll = '';\n";
$str.="		for (\$i = 0; \$i < \$this->getTotal(); \$i++) {\n";
$str.="			if (isset(\$_GET ['" . $data[0]['tableName'] . "Id'])) {\n";
//$str.="				\$this->set".ucfirst(".$data[0]['tableName']."Id)(\$this->strict(\$_GET ['".$data[0]['tableName']."Id'] [\$i], 'numeric'), \$i, 'array');\n";
$str.="			}\n";

$str.="			if (isset(\$_GET ['isDefault'])) {\n";
$str.="				if (\$_GET ['isDefault'] [\$i] == 'true') {\n";
$str.="					\$this->setIsDefault(1, \$i, 'array');\n";
$str.="				} else if (\$_GET ['isDefault'] [\$i] == 'false') {\n";
$str.="					\$this->setIsDefault(0, \$i, 'array');\n";
$str.="				}\n";
$str.="			}\n";
$str.="			if (isset(\$_GET ['isNew'])) {\n";
$str.="				if (\$_GET ['isNew'] [\$i] == 'true') {\n";
$str.="					\$this->setIsNew(1, \$i, 'array');\n";
$str.="				} else if (\$_GET ['isNew'] [\$i] == 'false') {\n";
$str.="					\$this->setIsNew(0, \$i, 'array');\n";
$str.="				}\n";
$str.="			}\n";
$str.="			if (isset(\$_GET ['isDraft'])) {\n";
$str.="				if (\$_GET ['isDraft'] [\$i] == 'true') {\n";
$str.="					\$this->setIsDraft(1, \$i, 'array');\n";
$str.="				} else if (\$_GET ['isDraft'] [\$i] == 'false') {\n";
$str.="					\$this->setIsDraft(0, \$i, 'array');\n";
$str.="				}\n";
$str.="			}\n";
$str.="			if (isset(\$_GET ['isUpdate'])) {\n";
$str.="				if (\$_GET ['isUpdate'] [\$i] == 'true') {\n";
$str.="					\$this->setIsUpdate(1, \$i, 'array');\n";
$str.="				} if (\$_GET ['isUpdate'] [\$i] == 'false') {\n";
$str.="					\$this->setIsUpdate(0, \$i, 'array');\n";
$str.="				}\n";
$str.="			}\n";
$str.="			if (isset(\$_GET ['isDelete'])) {\n";
$str.="				if (\$_GET ['isDelete'] [\$i] == 'true') {\n";
$str.="					\$this->setIsDelete(1, \$i, 'array');\n";
$str.="				} else if (\$_GET ['isDelete'] [\$i] == 'false') {\n";
$str.="					\$this->setIsDelete(0, \$i, 'array');\n";
$str.="				}\n";
$str.="			}\n";
$str.="			if (isset(\$_GET ['isActive'])) {\n";
$str.="				if (\$_GET ['isActive'] [\$i] == 'true') {\n";
$str.="					\$this->setIsActive(1, \$i, 'array');\n";
$str.="				} else if (\$_GET ['isActive'] [\$i] == 'false') {\n";
$str.="					\$this->setIsActive(0, \$i, 'array');\n";
$str.="				}\n";
$str.="			}\n";
$str.="			if (isset(\$_GET ['isApproved'])) {\n";
$str.="				if (\$_GET ['isApproved'] [\$i] == 'true') {\n";
$str.="					\$this->setIsApproved(1, \$i, 'array');\n";
$str.="				} else if (\$_GET ['isApproved'] [\$i] == 'false') {\n";
$str.="					\$this->setIsApproved(0, \$i, 'array');\n";
$str.="				} \n";
$str.="			} \n";
$str.="			if (isset(\$_GET ['isReview'])) {\n";
$str.="				if (\$_GET ['isReview'] [\$i] == 'true') {\n";
$str.="					\$this->setIsReview(1, \$i, 'array');\n";
$str.="				} else if (\$_GET ['isReview'] [\$i] == 'false') {\n";
$str.="					\$this->setIsReview(0, \$i, 'array');\n";
$str.="				}\n";
$str.="			}\n";
$str.="			if (isset(\$_GET ['isPost'])) {\n";
$str.="				if (\$_GET ['isPost'] [\$i] == 'true') {\n";
$str.="					\$this->setIsPost(1, \$i, 'array');\n";
$str.="				} else if (\$_GET ['isPost'] [\$i] == 'false') {\n";
$str.="					\$this->setIsPost(0, \$i, 'array');\n";
$str.="				}\n";
$str.="			}\n";
$str.="			\$primaryKeyAll .= \$this->get" . ucfirst($data[0]['tableName'] . "Id") . "(\$i, 'array') . \",\";\n";
$str.="		}\n";
$str.="		\$this->setPrimaryKeyAll((substr(\$primaryKeyAll, 0, - 1)));\n";
$str.="		/**\n";
$str.="		 * All the \$_SESSION enviroment.\n";
$str.="		 */\n";
$str.="		if (isset(\$_SESSION ['staffId'])) {\n";
$str.="			\$this->setExecuteBy(\$_SESSION ['staffId']);\n";
$str.="		}\n";
$str.="		/**\n";
$str.="		 * TimeStamp Value.\n";
$str.="		 */\n";
$str.="		if (\$this->getVendor() == self::MYSQL) {\n";
$str.="			\$this->setExecuteTime(\"'\" . date(\"Y-m-d H:i:s\") . \"'\");\n";
$str.="		} else if (\$this->getVendor() == self::MSSQL) {\n";
$str.="			\$this->setExecuteTime(\"'\" . date(\"Y-m-d H:i:s.u\") . \"'\");\n";
$str.="		} else if (\$this->getVendor() == self::ORACLE) {\n";
$str.="			\$this->setExecuteTime(\"to_date('\" . date(\"Y-m-d H:i:s\") . \"','YYYY-MM-DD HH24:MI:SS')\");\n";
$str.="		}\n";
$str.="	}\n";


$str.=" /* (non-PHPdoc)\n";
$str.="	 * @see ValidationClass::create()\n";
$str.="	 */ \n";

$str.="	public function create() {\n";
$str.="		\$this->setIsDefault(0, 0, 'single');\n";
$str.="		\$this->setIsNew(1, 0, 'single');\n";
$str.="		\$this->setIsDraft(0, 0, 'single');\n";
$str.="		\$this->setIsUpdate(0, 0, 'single');\n";
$str.="		\$this->setIsActive(1, 0, 'single');\n";
$str.="		\$this->setIsDelete(0, 0, 'single');\n";
$str.="		\$this->setIsApproved(0, 0, 'single');\n";
$str.="		\$this->setIsReview(0, 0, 'single');\n";
$str.="		\$this->setIsPost(0, 0, 'single');\n";
$str.="	} \n";

$str.="	/* (non-PHPdoc)\n";
$str.="	 * @see ValidationClass::update()\n";
$str.="	 */\n";

$str.="	public function update() {\n";
$str.="		\$this->setIsDefault(0, 0, 'single');\n";
$str.="		\$this->setIsNew(0, 0, 'single');\n";
$str.="		\$this->setIsDraft(0, 0, 'single');\n";
$str.="		\$this->setIsUpdate(1, '', 'single');\n";
$str.="		\$this->setIsActive(1, 0, 'single');\n";
$str.="		\$this->setIsDelete(0, 0, 'single');\n";
$str.="		\$this->setIsApproved(0, 0, 'single');\n";
$str.="		\$this->setIsReview(0, 0, 'single');\n";
$str.="		\$this->setIsPost(0, 0, 'single');\n";
$str.="	}\n";

$str.="	/* (non-PHPdoc) \n";
$str.="	 * @see ValidationClass::delete()\n";
$str.="	 */\n";

$str.="	public function delete() {\n";
$str.="		\$this->setIsDefault(0, 0, 'single');\n";
$str.="		\$this->setIsNew(0, 0, 'single');\n";
$str.="		\$this->setIsDraft(0, 0, 'single');\n";
$str.="		\$this->setIsUpdate(0, 0, 'single');\n";
$str.="		\$this->setIsActive(0, '', 'single');\n";
$str.="		\$this->setIsDelete(1, '', 'single');\n";
$str.="		\$this->setIsApproved(0, 0, 'single');\n";
$str.="		\$this->setIsReview(0, 0, 'single');\n";
$str.="		\$this->setIsPost(0, 0, 'single');\n";
$str.="	} \n";

$str.="	/* (non-PHPdoc)\n";
$str.="	 * @see ValidationClass::draft()\n";
$str.="	 */\n";

$str.="	public function draft() {\n";
$str.="		\$this->setIsDefault(0, 0, 'single');\n";
$str.="		\$this->setIsNew(1, 0, 'single');\n";
$str.="		\$this->setIsDraft(1, 0, 'single');\n";
$str.="		\$this->setIsUpdate(0, 0, 'single');\n";
$str.="		\$this->setIsActive(0, 0, 'single');\n";
$str.="		\$this->setIsDelete(0, 0, 'single');\n";
$str.="		\$this->setIsApproved(0, 0, 'single');\n";
$str.="		\$this->setIsReview(0, 0, 'single');\n";
$str.="		\$this->setIsPost(0, 0, 'single');\n";
$str.="	}\n";

$str.="	/* (non-PHPdoc)\n";
$str.="	 * @see ValidationClass::approved()\n";
$str.="	 */\n";

$str.="	public function approved() {\n";
$str.="		\$this->setIsDefault(0, 0, 'single');\n";
$str.="		\$this->setIsNew(1, 0, 'single');\n";
$str.="		\$this->setIsDraft(0, 0, 'single');\n";
$str.="		\$this->setIsUpdate(0, 0, 'single');\n";
$str.="		\$this->setIsActive(0, 0, 'single');\n";
$str.="		\$this->setIsDelete(0, 0, 'single');\n";
$str.="		\$this->setIsApproved(1, 0, 'single');\n";
$str.="		\$this->setIsReview(0, 0, 'single');\n";
$str.="		\$this->setIsPost(0, 0, 'single');\n";
$str.="	}\n";

$str.="	/* (non-PHPdoc)\n";
$str.="	 * @see ValidationClass::review()\n";
$str.="	 */\n";

$str.="public function review() { \n";
$str.="		\$this->setIsDefault(0, 0, 'single');\n";
$str.="		\$this->setIsNew(1, 0, 'single');\n";
$str.="		\$this->setIsDraft(0, 0, 'single');\n";
$str.="		\$this->setIsUpdate(0, 0, 'single');\n";
$str.="		\$this->setIsActive(0, 0, 'single');\n";
$str.="		\$this->setIsDelete(0, 0, 'single');\n";
$str.="		\$this->setIsApproved(0, 0, 'single');\n";
$str.="		\$this->setIsReview(1, 0, 'single');\n";
$str.="		\$this->setIsPost(0, 0, 'single');\n";
$str.="	} \n";

$str.="	/* (non-PHPdoc)\n";
$str.="	 * @see ValidationClass::post()\n";
$str.="	 */\n";

$str.="	public function post() {\n";
$str.="		\$this->setIsDefault(0, 0, 'single');\n";
$str.="		\$this->setIsNew(1, 0, 'single');\n";
$str.="		\$this->setIsDraft(0, 0, 'single');\n";
$str.="		\$this->setIsUpdate(0, 0, 'single');\n";
$str.="		\$this->setIsActive(0, 0, 'single');\n";
$str.="		\$this->setIsDelete(0, 0, 'single');\n";
$str.="		\$this->setIsApproved(1, 0, 'single');\n";
$str.="		\$this->setIsReview(0, 0, 'single');\n";
$str.="		\$this->setIsPost(1, 0, 'single');\n";
$str.="	}\n";
$total = count($data);
for ($i = 0; $i < $total; $i++) {
    if ($data[$i]['columnName'] == $data[0]['tableName'] . "Id") {
        $str.="     /** \n";
        $str.="     * Set ".$data[0]['tableName']." Identification  Value \n";
        $str.="     * @param int|array \$value \n";
        $str.="     * @param array[int]int \$key List Of Primary Key. \n";
        $str.="     * @param array[int]string \$type  List Of Type.0 As 'single' 1 As 'array' \n";
        $str.="     **/ \n";
        $str.="    public function set" . ucfirst($data[$i]['columnName']) . "(\$value, \$key, \$type) { \n";
        $str.="        if (\$type == 'single') { \n";
        $str.="           \$this->" . $data[$i]['columnName'] . " = \$value;\n";
        $str.="        } else if (\$type == 'array') {\n";
        $str.="            \$this->" . $data[$i]['columnName'] . "[\$key] = \$value;\n";
        $str.="        } else {\n";
        $str.="            echo json_encode(array(\"success\" => false, \"message\" => \"Cannot Identifiy Type String Or Array:set" . $data[$i]['columnName'] . "?\"));\n";
        $str.="            exit(); \n";
        $str.="        }\n";
        $str.="    }\n";

        $str.="    /**\n";
        $str.="     * Return ".$data[0]['tableName']." Identification  Value\n";
        $str.="     * @param array[int]int \$key List Of Primary Key.\n";
        $str.="     * @param array[int]string \$type  List Of Type.0 As 'single' 1 As 'array'\n";
        $str.="     * @return bool|array\n";
        $str.="     **/\n";
        $str.="    public function get" . ucfirst($data[$i]['columnName']) . "(\$key, \$type) {\n";
        $str.="        if (\$type == 'single') {\n";
        $str.="            return \$this->" . $data[$i]['columnName'] . ";\n";
        $str.="        } else if (\$type == 'array') {\n";
        $str.="            return \$this->" . $data[$i]['columnName'] . " [\$key];\n";
        $str.="        } else {\n";
        $str.="            echo json_encode(array(\"success\" => false, \"message\" => \"Cannot Identifiy Type String Or Array:get" . $data[$i]['columnName'] . " ?\"));\n";
        $str.="            exit();\n";
        $str.="        }\n";
		$str.="	}\n";
    } else if ($data[$i]['columnName'] != 'isDefault' &&
            $data[$i]['columnName'] != 'isNew' &&
            $data[$i]['columnName'] != 'isDraft' &&
            $data[$i]['columnName'] != 'isUpdate' &&
            $data[$i]['columnName'] != 'isDelete' &&
            $data[$i]['columnName'] != 'isActive' &&
            $data[$i]['columnName'] != 'isApproved' &&
            $data[$i]['columnName'] != 'isReview' &&
            $data[$i]['columnName'] != 'isPost' &&
            $data[$i]['columnName'] != 'isSeperated' &&
            $data[$i]['columnName'] != 'isConsolidation' &&
            $data[$i]['columnName'] != 'isReconciled' &&
            $data[$i]['columnName'] != 'executeBy' &&
            $data[$i]['columnName'] != 'executeTime' &&
            $data[$i]['columnName'] != $data[0]['tableName'] . "Id") {

        $str.="	/**\n";
        $str.="	 * To Return " . $data[$i]['columnName'] . " \n";
        $str.="	 * @return \$" . $data[$i]['columnName'] . "\n";
        $str.="	 */ \n";
        $str.="	public function get" . ucfirst($data[$i]['columnName']) . "()\n";
        $str.="	{\n";
        $str.="	    return \$this->" . $data[$i]['columnName'] . ";\n";
        $str.="	}\n";

        $str.="	/**\n";
        $str.="	 * To Set " . $data[$i]['columnName'] . " \n";
        $str.="	 * @param " . $data[$i]['formType'] . " \$" . $data[$i]['columnName'] . "\n";
        $str.="	 **/\n";
        $str.="	public function set" . ucfirst($data[$i]['columnName']) . "(\$" . $data[$i]['columnName'] . ")\n";
        $str.="	{\n";
        $str.="	    \$this->" . $data[$i]['columnName'] . " = \$" . $data[$i]['columnName'] . ";\n";
        $str.="	} \n";
    }
}
$str.="}\n";
$str.="?>";
?>