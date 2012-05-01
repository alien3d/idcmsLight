<?php
if($_GET['targetFolder']) {
	$targetFolder=addslashes($_GET['targetFolder']);
} else {
	$targetFolder='iFinancial';
}

if($_GET['targetDb']) {
	$targetDb=addslashes($_GET['targetDb']);
} else{
	$targetDb="ifinancial";
}
if($_GET['targetDb']) {

	$targetDb  = addslashes($_GET['targetDb']);


	switch($targetDb){
		case 'iFinancial':
			$targetDbObject="\".\$this->q->getFinancialDatabase().\"";
			break;
		case 'imanagement':
			$targetDbObject="\".\$this->q->getManagementDatabase().\"";
			break;
		case 'icore':
			$targetDbObject="\".\$this->q->getCoreDatabase().\"";
			break;
		case 'icalendar':
			$targetDbObject="\".\$this->q->getCalendarDatabase().\"";
			break;
		case 'ilog':
			$targetDbObject="\".\$this->q->getLogDatabase().\"";
			break;
		default:
			$targetDbObject="Please define in code the object required";
	}

} else {
	$targetDb  ='financial';
	$targetDbObject="\".\$this->q->getFinancialDatabase().\"";
}
$targetDbManagementObject="\".\$this->q->getManagementDatabase().\"";

if($_GET['targetTable']){
	$targetTable=addslashes($_GET['targetTable']);
} else {
	$targetTable ='country';
}
$targetTableId = $targetTable."Id";
if($_GET['targetMasterTableId']) {
	$targetMasterTable=addslashes($_GET['targetMasterTableId']);
} else {
	$targetMasterTable='businessPartnerId'; // parent primary key
}
if($_GET['targetGridType']) {
	$targetGridType = addslashes($_GET['targetGridType']);
} else {
	$targetGridType="first"; // first -normal table ,second -edit in grid table
}

mysql_connect("localhost","root","123456");

mysql_select_db($targetDb);
if($_GET['targetDb'] && $_GET['targetTable'] && $_GET['type']) {
	mysql_query("SET autocommit=0");


	$resultTable= mysql_query($sqlTable);
	$sqlFieldTable     ="describe `".$targetDb."`.`".$targetTable."`";

	$resultFieldTable  = mysql_query($sqlFieldTable);
	while($rowFieldTable = mysql_fetch_array($resultFieldTable)) {
		$columnName=$rowFieldTable['Field'];
		$columnNameArray[]=$columnName;
		$mystring=$rowFieldTable['Type'];
		$key  = $rowFieldTable['Key'];

		// kita start isi model kat sini standard  create read update delete lallalala
		
		// end disini..


		$sql="
		SELECT table_schema, table_name, column_name, referenced_table_schema, referenced_table_name, referenced_column_name
FROM information_schema.KEY_COLUMN_USAGE
WHERE 
table_schema='".$targetDb."'
AND table_name = '".$targetTable."'
AND  column_name ='".$columnName."'		";

		$resultForeignKey = mysql_query($sql) or die(mysql_error());
		$rowForeignKey  = mysql_fetch_array($resultForeignKey);
		if($rowForeignKey['referenced_table_schema'] != null  && $rowForeignKey['referenced_table_name'] != null && $rowForeignKey['referenced_column_name'] != null) {

			$foreignKey='yes';
		} else {
			$foreignKey='no';
		}
		$findme='varchar';
		$pos = strpos($mystring, $findme);
		if ($pos !== false) {
			$formType="Text";
			$jsonType='string';
		}
		$findme='text';
		$pos = strpos($mystring, $findme);
		if ($pos !== false) {
			$formType="Text";
			$jsonType='string';
		}
		$findme='int';
		$pos = strpos($mystring, $findme);
		if ($pos !== false) {
			$formType="Number";
			$jsonType='int';
		}
		$findme='date';
		$pos = strpos($mystring, $findme);
		if ($pos !== false) {
			$formType="Date";
			$dateType='Y-m-d';
			$jsonType='date';
		}
		$findme='datetime';
		$pos = strpos($mystring, $findme);
		if ($pos !== false) {
			$formType="Date";
			$dateType='Y-m-d H:i:s';
			$jsonType='date';
		}
		$findme='tiny';
		$pos = strpos($mystring, $findme);
		if ($pos !== false) {
			$formType="Number";
			$jsonType='boolean';
		}

		$findme='double';
		$pos = strpos($mystring, $findme);
		if ($pos !== false) {
			$formType="Text";
			$jsonType='float';
		}
		$str.="{
			key :'".$key."',
			foreignKey : '".$foreignKey."',
			name : '".$columnName."',
			type : '".$jsonType."'";
		if($jsonType=='date') {
			$str.=",dateFormat : '".$dateType."'";
		}
		$str.="},";
		
	if($columnName=='executeBy') {
				$str5.="{
					type : 'list',
					dataIndex : '".$columnName."',
					column : '".$columnName."',
					table : '".$targetTable."',
					database : '".$targetDb."',
					labelField : 'staffName',
					store : staffByStore,
					phpMode : true
				},";
			} else if ($foreignKey=='yes') {
				$str5.="
				{
					type : 'list',
					dataIndex : '".$columnName."',
					column : '".$columnName."',
					table : '".$targetTable."',
					database : '".$targetDb."',
					labelField : '".str_replace("Id","",$columnName)."Desc',
					store : ".str_replace("Id","",$columnName)."Store,
					phpMode : true
				},	
				";
			}	else {
			
				$str5.="
				{
					type : '".$jsonType."',
					dataIndex : '".$columnName."',
					column : '".$columnName."',
					table : '".$targetTable."',
					database : '".$targetDb."'
				},";
			}

		$str2.=$columnName.",";
		if($columnName !='isDefault' &&
		$columnName !='isNew' &&
		$columnName !='isDraft'&&
		$columnName !='isUpdate'&&
		$columnName !='isDelete'&&
		$columnName !='isActive'&&
		$columnName !='isApproved'&&
		$columnName !='isReview'&&
		$columnName !='isPost'&&
		$columnName !='executeBy'&&
		$columnName !='executeTime') {
			$mainModelInside.="
		\n
		/**
		* @var ".$jsonType."
		*/
		private \$".$columnName."; ";
		}

		if($columnName=='executeBy') {
			$str4.="
						{
						dataIndex : 'executeBy',
						header : executeByLabel,
						sortable : true,
						hidden : false,
						renderer : function(value, metaData, record, rowIndex,
								colIndex, store) {
							return record.data.staffName;
						}
					},
					";
		} else if ($columnName=='executeTime') {
			$str4.="{
						dataIndex : 'executeTime',
						header : executeTimeLabel,
						sortable : true,
						hidden : false,
						renderer : function(value, metaData, record, rowIndex,
								colIndex, store) {
							return Ext.util.Format.date(value, 'd-m-Y H:i:s');
						}
					},";
		} else if ($foreignKey=='yes') {
			if($targetGridType=='first') {
				$str4.="
						{
						dataIndex : '".$columnName."',
						header : ".str_replace("Id","",$columnName)."DescLabel,
						sortable : true,
						hidden : false,
						renderer : function(value, metaData, record, rowIndex,
								colIndex, store) {
							return record.data.".str_replace("Id","",$columnName)."Desc;
						}
					},
					";
			} else {
				if($columnName !=$targetMasterTable){
					$str4.="{
								dataIndex : '".$columnName."',
							header : ".str_replace("Id","",$columnName)."DescLabel,
								width : 200,
								sortable : true,
								editor : ".$columnName.",
								renderer : Ext.util.Format.comboRenderer(".$columnName."),
								hidden : false,
								jsonType:'".$jsonType."'
							},";
				}
			}

		} else if($jsonType=='float'){
			$str4.="{
									dataIndex : '".$columnName."',
									header : ".$columnName."Label,
									width : 75,
									sortable : true,
									summaryType : 'sum',
									renderer : function(value) {
										return ' RM ' + Ext.util.Format.number(value, '0,0.00');
									},
									editor : {
										xtype : 'textfield',
										labelAlign : 'left',
										fieldLabel : ".$columnName."Label,
										hiddenName : '".$columnName."',
										name : '".$columnName."',
										id : '".$columnName."',

										blankText : blankTextLabel,
										decimalPrecision : 2,
										vtype : 'dollar',
										anchor : '95%',
										listeners : {
											blur : function() {
												var value = Ext.getCmp('".$columnName."').getValue();
												value = value.replace(\",\", \"\"); 
												value = Ext.util.Format.usMoney(value);
												value = value.replace(\" \", \"\"); 
												Ext.getCmp('".$columnName."').setValue(value);
											}
										}
									}
								},";
		} else if ($jsonType=='boolean') {
			if($_GET['targetGridType']=='first' || $_GET['targetGridType'] !='second') {
				$str4.=$columnName."Grid,"; // checkbox is outside
			} else {
				$str4.=$columnName."GridDetail,"; // checkbox is outside
			}
		}else {
			if($columnName != $targetTableId) {
				$str4.="{
									dataIndex : '".$columnName."',
									header : ".$columnName."Label,
									sortable : true,
									hidden : false
								},";
			}
		}
		if($foreignKey=='no' && ($key=='MUL' || $key=='')) {
			if($columnName !='isDefault' &&
			$columnName !='isNew' &&
			$columnName !='isDraft'&&
			$columnName !='isUpdate'&&
			$columnName !='isDelete'&&
			$columnName !='isActive'&&
			$columnName !='isApproved'&&
			$columnName !='isReview'&&
			$columnName !='isPost'&&
			$columnName !='executeBy'&&
			$columnName !='executeTime') {

				if($jsonType=='float') {
					$executeDalam.="\nif (isset(\$_POST ['".$columnName."'])) {
						\$this->set".ucfirst($columnName)."(\$this->strict(\$_POST ['".$columnName."'], '".$jsonType."'));
					}\n";
					if($_GET['targetGridType']=='first') { 
					$formItem.="\nvar ".$columnName." = new Ext.form.".$formType."Field({
							labelAlign : 'left',
						fieldLabel : ".$columnName."Label + '<span style=\'color: red;\'>*</span>',
						hiddenName : '".$columnName."',
						name : '".$columnName."',
						id : '".$columnName."',
						allowBlank : false,
						blankText : blankTextLabel,
						style : {
							textTransform : 'uppercase'
						},
						anchor : '40%',
						decimalPrecision: 2,
						vtype: 'dollar',
						listeners: {
							blur: function() {
								var value = Ext.getCmp('".$columnName."').getValue();
								value = value.replace(\",\", \"\"); 
								value = value.replace(\" \", \"\"); 					
								Ext.getCmp('".$columnName."').setValue(value);
							}
						}
					}); ";
					}

				} else{
					$executeDalam.="\nif (isset(\$_POST ['".$columnName."'])) {
						\$this->set".ucfirst($columnName)."(\$this->strict(\$_POST ['".$columnName."'], '".$jsonType."'));
					}\n";
					if($formType=='Date') {
						$formItem.="\nvar ".$columnName." = new Ext.form.".$formType."Field({
						labelAlign : 'left',
						fieldLabel : ".$columnName."Label + '<span style=\'color: red;\'>*</span>',
						hiddenName : '".$columnName."',
						name : '".$columnName."',
						id : '".$columnName."',
						allowBlank : false,
						blankText : blankTextLabel,
						style : {
							textTransform : 'uppercase'
						},
						anchor : '40%',
						format		: 	systemSettingDateFormat,
						dateConfig	:	{
								altFormats	: 'Y-m-d'
						}
						});";
					} else { 
					$formItem.="\nvar ".$columnName." = new Ext.form.".$formType."Field({
						labelAlign : 'left',
						fieldLabel : ".$columnName."Label + '<span style=\'color: red;\'>*</span>',
						hiddenName : '".$columnName."',
						name : '".$columnName."',
						id : '".$columnName."',
						allowBlank : false,
						blankText : blankTextLabel,
						style : {
							textTransform : 'uppercase'
						},
						anchor : '40%'
					});";
					}
				}
			}

			



		}  else if ($key=='PRI') {
			$executeDalam.="\nif (isset(\$_POST ['".$columnName."'])) {
				\$this->set".ucfirst($columnName)."(\$this->strict(\$_POST ['".$columnName."'], 'numeric'), 0, 'single');
			}\n";

			$formItem.="\nvar ".$columnName."  =  new Ext.form.Hidden({
			name : '".$columnName."',
			id : '".$columnName."'
			});\n";


			
			$model ="/**
	 * Set ".$targetTable." Identification  Value
	 * @param int|array \$value
	 * @param array[int]int \$key List Of Primary Key.
	 * @param array[int]string \$type  List Of Type.0 As 'single' 1 As 'array'
	 */
	public function set".ucfirst($columnName)." (\$value, \$key, \$type) {
		if (\$type == 'single') {
			\$this->".($columnName)." = \$value;
		} else if (\$type == 'array') {
			\$this->".($columnName)." [\$key] = \$value;
		} else {
			echo json_encode(array(\"success\" => false, \"message\" => \"Cannot Identifiy Type String Or Array:set".ucfirst($columnName)." ?\"));
			exit();
		}
	}

	/**
	 * Return ".$targetTable." Identification  Value
	 * @param array[int]int \$key List Of Primary Key.
	 * @param array[int]string \$type  List Of Type.0 As 'single' 1 As 'array'
	 * @return bool|array
	 */
	public function get".ucfirst($columnName)."(\$key, \$type) {
		if (\$type == 'single') {
			return \$this->".($columnName).";
		} else if (\$type == 'array') {
			return \$this->".($columnName)." [\$key];
		} else {
			echo json_encode(array(\"success\" => false, \"message\" => \"Cannot Identifiy Type String Or Array:get".ucfirst($columnName)." ?\"));
			exit();
		}
	}";


		}else {
			$executeDalam.="if (isset(\$_POST ['".$columnName."'])) {
						\$this->set".ucfirst($columnName)."(\$this->strict(\$_POST ['".$columnName."'], '".$jsonType."'));
					}\n";
			// asume foreign key  only used combo box
			if($columnName !=$targetMasterTable && $targetGridType!='first'){
				$formItem.="var ".$columnName."  = new Ext.ux.form.ComboBoxMatch({
					
						labelAlign: 'left',
						fieldLabel: ".$columnName."Label,
						name: '".$columnName."Id',
						hiddenName: '".$columnName."',
						valueField: '".$columnName."',
						hiddenId: '".$columnName."_fake',
						id: '".$columnName."',
						displayField: '".str_replace("Id","",$columnName)."Desc',
						typeAhead: false,
						triggerAction: 'all',
						store: ".str_replace("Id","",$columnName)."Store,
						anchor: '95%',
						selectOnFocus: true,
						mode: 'local',
						allowBlank: false,
						blankText: blankTextLabel,
						createValueMatcher: function(value) {
							value = String(value).replace(/\s*/g, '');
							if (Ext.isEmpty(value, false)) {
								return new RegExp('^');
							}
							value = Ext.escapeRe(value.split('').join('\\s*')).replace(/\\\\s\\\*/g, '\\s*');
							return new RegExp('\\b(' + value + ')', 'i');
						}
					});";
			}
			if($targetGridType=='first'){
				$formItem.="var ".$columnName."  = new Ext.ux.form.ComboBoxMatch({
				
						labelAlign: 'left',
						fieldLabel: ".$columnName."Label,
						name: '".$columnName."Id',
						hiddenName: '".$columnName."',
						valueField: '".$columnName."',
						hiddenId: '".$columnName."_fake',
						id: '".$columnName."',
						displayField: '".str_replace("Id","",$columnName)."Desc',
						typeAhead: false,
						triggerAction: 'all',
						store: ".str_replace("Id","",$columnName)."Store,
						anchor: '95%',
						selectOnFocus: true,
						mode: 'local',
						allowBlank: false,
						blankText: blankTextLabel,
						createValueMatcher: function(value) {
							value = String(value).replace(/\s*/g, '');
							if (Ext.isEmpty(value, false)) {
								return new RegExp('^');
							}
							value = Ext.escapeRe(value.split('').join('\\s*')).replace(/\\\\s\\\*/g, '\\s*');
							return new RegExp('\\b(' + value + ')', 'i');
						}
					});";
			}

			




		}

	}


	



	$str5=substr($str5,0,-1);


	$gridFilterJs.="var ".$targetTable."Filters = new Ext.ux.grid.GridFilters(
					{
						encode : false,
						local : false,
						filters : [";
	$gridFilterJs.=$str5;
	$gridFilterJs.="]});";

	$str4=(substr($str4,0,-1));

	$columnModelJs.="var ".$targetTable."ColumnModel = [
					new Ext.grid.RowNumberer(),";
	$columnModelJs.=$str4;
	$columnModelJs.="];";




	$filterItem=array('isDefault','isNew','isDraft','isUpdate','isDelete','isActive','isApproved','isReview','isPost','executeBy','executeTime');
	foreach ($filterItem as $item) {
		$str2= str_replace($item.",",'',$str2);
	}
	$str2.=(substr($str2,0,-1));
	// start insert statement

	$mysqlInsertStatement.="
		\$sql=\"INSERT INTO `".$targetDbObject."`.`".$targetTable."` ( \n";
	foreach($columnNameArray as $columnNameMysql) {
		$mysqlInsertStatementAField.="	`".$columnNameMysql."`,\n";
	}
	$mysqlInsertStatementField.= (substr($mysqlInsertStatementAField,0,-2));
	$mysqlInsertStatement.=$mysqlInsertStatementField;
	$mysqlInsertStatement.="\n) VALUES ( \n";
	$i=0;
	foreach($columnNameArray as $columnNameMysql) {
		$i++;
		if($i==1){
			$mysqlInsertStatementInsideValue.="null,\n";
		}else if ($columnNameMysql=='executeTime'){
			$mysqlInsertStatementInsideValue.=" \".\$this->model->get".ucFirst($columnNameMysql)."().\",\n";
		}else if($columnNameMysql !='isDefault' &&
		$columnNameMysql !='isNew' &&
		$columnNameMysql !='isDraft'&&
		$columnNameMysql !='isUpdate'&&
		$columnNameMysql !='isDelete'&&
		$columnNameMysql !='isActive'&&
		$columnNameMysql !='isApproved'&&
		$columnNameMysql !='isReview'&&
		$columnNameMysql !='isPost'&&
		$columnNameMysql !='isSeperated'&&
		$columnNameMysql !='isConsolidation') {
			$mysqlInsertStatementInsideValue.=" '\".\$this->model->get".ucFirst($columnNameMysql)."().\"',\n";
		}  else {
			$mysqlInsertStatementInsideValue.=" '\".\$this->model->get".ucFirst($columnNameMysql)."(0, 'single').\"',\n";
		}
	}
	$mysqlInsertStatementValue.=(substr($mysqlInsertStatementInsideValue,0,-2));
	$mysqlInsertStatement.=$mysqlInsertStatementValue;
	$mysqlInsertStatement.="\n );\";\n";

	$mssqlInsertStatement.="
		\$sql=\"INSERT INTO [".$targetDbObject."].[".$targetTable."] (\n";
	foreach($columnNameArray as $columnNameMysql) {
		$mssqlInsertStatementAField.="	[".$columnNameMysql."],\n";
	}
	$mssqlInsertStatementField.= (substr($mssqlInsertStatementAField,0,-2));
	$mssqlInsertStatement.=$mssqlInsertStatementField;
	$mssqlInsertStatement.="\n) VALUES ( \n";
	$i=0;
	foreach($columnNameArray as $columnNameMysql) {
		$i++;
		if($i==1){
			$mssqlInsertStatementInsideValue.="null,\n";
		}else if ($columnNameMysql=='executeTime'){
			$mssqlInsertStatementInsideValue.=" \".\$this->model->get".ucFirst($columnNameMysql)."().\",\n";
		}else if($columnNameMysql !='isDefault' &&
		$columnNameMysql !='isNew' &&
		$columnNameMysql !='isDraft'&&
		$columnNameMysql !='isUpdate'&&
		$columnNameMysql !='isDelete'&&
		$columnNameMysql !='isActive'&&
		$columnNameMysql !='isApproved'&&
		$columnNameMysql !='isReview'&&
		$columnNameMysql !='isPost'&&
		$columnNameMysql !='isSeperated'&&
		$columnNameMysql !='isConsolidation') {
			$mssqlInsertStatementInsideValue.=" '\".\$this->model->get".ucFirst($columnNameMysql)."().\"',\n";
		}  else {
			$mssqlInsertStatementInsideValue.=" '\".\$this->model->get".ucFirst($columnNameMysql)."(0, 'single').\"',\n";
		}
	}
	$mssqlInsertStatementValue.=(substr($mssqlInsertStatementInsideValue,0,-2));
	$mssqlInsertStatement.=$mssqlInsertStatementValue;
	$mssqlInsertStatement.="\n );\";\n";

	$oracleInsertStatement.="
		\$sql=\"INSERT INTO 	".strtoupper($targetTable)." ( \n";
	foreach($columnNameArray as $columnNameMysql) {
		$oracleInsertStatementAField.="	".strtoupper($columnNameMysql).",\n";
	}
	$oracleInsertStatementField.= (substr($oracleInsertStatementAField,0,-2));
	$oracleInsertStatement.=$oracleInsertStatementField;
	$oracleInsertStatement.="\n) VALUES ( \n";
	$i=0;
	foreach($columnNameArray as $columnNameMysql) {
		$i++;
		if($i==1){
			$oracleInsertStatementInsideValue.="null,\n";
		}else if ($columnNameMysql=='executeTime'){
			$oracleInsertStatementInsideValue.=" \".\$this->model->get".ucFirst($columnNameMysql)."().\",\n";
		}else if($columnNameMysql !='isDefault' &&
		$columnNameMysql !='isNew' &&
		$columnNameMysql !='isDraft'&&
		$columnNameMysql !='isUpdate'&&
		$columnNameMysql !='isDelete'&&
		$columnNameMysql !='isActive'&&
		$columnNameMysql !='isApproved'&&
		$columnNameMysql !='isReview'&&
		$columnNameMysql !='isPost'&&
		$columnNameMysql !='isSeperated'&&
		$columnNameMysql !='isConsolidation') {
			$oracleInsertStatementInsideValue.=" '\".\$this->model->get".ucFirst($columnNameMysql)."().\"',\n";
		}  else {
			$oracleInsertStatementInsideValue.=" '\".\$this->model->get".ucFirst($columnNameMysql)."(0, 'single').\"',\n";
		}
	}
	$oracleInsertStatementValue.=(substr($oracleInsertStatementInsideValue,0,-2));
	$oracleInsertStatement.=$oracleInsertStatementValue;
	$oracleInsertStatement.="\n );\";\n";


	// end  create statement
	// start update statement

	$mysqlUpdateStatement="\n\$sql=\"UPDATE `".$targetDbObject."`.`".$targetTable."` SET \n";
	$i=0;
	foreach($columnNameArray as $columnNameMysql) {
		$i++;
		if($i !=1 ) { 
		if($columnNameMysql !='isDefault' &&
		$columnNameMysql !='isNew' &&
		$columnNameMysql !='isDraft'&&
		$columnNameMysql !='isUpdate'&&
		$columnNameMysql !='isDelete'&&
		$columnNameMysql !='isActive'&&
		$columnNameMysql !='isApproved'&&
		$columnNameMysql !='isReview'&&
		$columnNameMysql !='isPost'&&
		$columnNameMysql !='isSeperated'&&
		$columnNameMysql !='isConsolidation'&&
		$columnNameMysql !='isReconciled'&&
		$columnNameMysql !='executeBy' &&
		$columnNameMysql !='executeTime') {
			$mysqlUpdateStatementInsideValue.=" `".$columnNameMysql."` = '\".\$this->model->get".ucFirst($columnNameMysql)."().\"',\n";
		} else if ($columnNameMysql =='executeTime') {
			$mysqlUpdateStatementInsideValue.=" `".$columnNameMysql."` = \".\$this->model->get".ucFirst($columnNameMysql)."().\",\n";
		} else {
						$mysqlUpdateStatementInsideValue.=" `".$columnNameMysql."` = '\".\$this->model->get".ucFirst($columnNameMysql)."('0','single').\"',\n";

		}
		}
	}
	$mysqlUpdateStatementValue.=(substr($mysqlUpdateStatementInsideValue,0,-2));
	$mysqlUpdateStatement.=$mysqlUpdateStatementValue;
	$mysqlUpdateStatement.=" \nWHERE `".($targetTableId)."`='\".\$this->model->get".ucfirst($targetTable)."Id('0','single').\"'\";\n\n";

	$mssqlUpdateStatement="\n\$sql=\"UPDATE [".$targetDbObject."].[".$targetTable."] SET \n";
	$i=0;
	foreach($columnNameArray as $columnNameMysql) {
		$i++;
		if($i !=1 ) { 
		if($columnNameMysql !='isDefault' &&
		$columnNameMysql !='isNew' &&
		$columnNameMysql !='isDraft'&&
		$columnNameMysql !='isUpdate'&&
		$columnNameMysql !='isDelete'&&
		$columnNameMysql !='isActive'&&
		$columnNameMysql !='isApproved'&&
		$columnNameMysql !='isReview'&&
		$columnNameMysql !='isPost'&&
		$columnNameMysql !='isSeperated'&&
		$columnNameMysql !='isConsolidation'&&
		$columnNameMysql !='isReconciled'&&
		$columnNameMysql !='executeBy' &&
		$columnNameMysql !='executeTime') {
			$mssqlUpdateStatementInsideValue.=" [".$columnNameMysql."] = '\".\$this->model->get".ucFirst($columnNameMysql)."().\"',\n";
		} else if ($columnNameMysql =='executeTime') {
			$mssqlUpdateStatementInsideValue.=" [".$columnNameMysql."] = \".\$this->model->get".ucFirst($columnNameMysql)."().\",\n";
		}else {
			$mssqlUpdateStatementInsideValue.=" [".$columnNameMysql."] = '\".\$this->model->get".ucFirst($columnNameMysql)."(0, 'single').\"',\n";
		}
		}
	}
	$mssqlUpdateStatementValue.=(substr($mssqlUpdateStatementInsideValue,0,-2));
	$mssqlUpdateStatement.=$mssqlUpdateStatementValue;
	$mssqlUpdateStatement.=" \nWHERE [".($targetTableId)."]='\".\$this->model->get".ucfirst($targetTable)."Id('0','single').\"'\";\n\n";


	$oracleUpdateStatement="\n\$sql=\"UPDATE `".strtoupper($targetTable)."` SET\n ";
	$i=0;
	foreach($columnNameArray as $columnNameMysql) {
		$i++;
		if($i !=1 ) { 
		if($columnNameMysql !='isDefault' &&
		$columnNameMysql !='isNew' &&
		$columnNameMysql !='isDraft'&&
		$columnNameMysql !='isUpdate'&&
		$columnNameMysql !='isDelete'&&
		$columnNameMysql !='isActive'&&
		$columnNameMysql !='isApproved'&&
		$columnNameMysql !='isReview'&&
		$columnNameMysql !='isPost'&&
		$columnNameMysql !='isSeperated'&&
		$columnNameMysql !='isConsolidation'&&
		$columnNameMysql !='isReconciled'&&
		$columnNameMysql !='executeBy' &&
		$columnNameMysql !='executeTime') {
			$oracleUpdateStatementInsideValue.=" ".strtoupper($columnNameMysql)." = '\".\$this->model->get".ucFirst($columnNameMysql)."().\"',\n";
		} else if ($columnNameMysql =='executeTime'){
			$oracleUpdateStatementInsideValue.=" ".strtoupper($columnNameMysql)." = \".\$this->model->get".ucFirst($columnNameMysql)."().\",\n";
		}else {
			$oracleUpdateStatementInsideValue.=" ".strtoupper($columnNameMysql)." = '\".\$this->model->get".ucFirst($columnNameMysql)."(0, 'single').\"',\n";
		}
		}
	}
	$oracleUpdateStatementValue.=(substr($oracleUpdateStatementInsideValue,0,-2));
	$oracleUpdateStatement.=$oracleUpdateStatementValue;
	$oracleUpdateStatement.=" \nWHERE `".strtoupper($targetTableId)."`='\".\$this->model->get".ucfirst($targetTable)."Id('0','single').\"'\";\n\n";




	// start delete statement

	$mysqlDeleteStatement = "
	\$sql=\"  	UPDATE 	`".$targetDbObject."`.`".$targetTable."`\n
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
				WHERE 	`".$targetTableId."`	=  '\" . \$this->model->get".ucfirst($targetTable)."Id(0, 'single') . \"'\";\n";

	$mssqlDeleteStatement = "
			\$sql=\"   	
				UPDATE 	[".$targetDbObject."].[".$targetTable."]
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
				WHERE 		[".$targetTableId."]	=  '\" . \$this->model->get".ucfirst($targetTable)."Id(0, 'single') . \"'\";\n";

	$oracleDeleteStatement = "
	\$sql=\" 
				UPDATE 	".strtoupper($targetTable)."
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
				WHERE 	`".strtoupper($targetTable)."`	=  '\" . \$this->model->get".ucfirst($targetTable)."Id(0, 'single') . \"'\";\n";

	// end delete statement
	// start reade statement

	$mysqlReadStatement.="\n\$sql = \"SELECT";
	foreach($columnNameArray as $columnNameMysql) {
		$mysqlReadInsideStatement.="`".$targetTable."`.`".$columnNameMysql."`,\n";
	}
	$mysqlReadStatement.=$mysqlReadInsideStatement;

	$mysqlReadStatement.="`staff`.`staffName`
			FROM 	`".$targetDbObject."`.`".$targetTable."`
			JOIN	`".$targetDbManagementObject."`.`staff`
			ON		`".$targetTable."`.`executeBy` = `staff`.`staffId`
			WHERE 		\" . \$this->auditFilter; \n";

	$mssqlReadStatement.="\n\$sql = \"SELECT ";
	$mssqlReadPagingStatement="
				\$sql =\"WITH [".$targetTable."Derived] AS
							(
								SELECT ";
	foreach($columnNameArray as $columnNameMysql) {
		$mssqlReadInsideStatement.="[".$targetTable."].[".$columnNameMysql."],\n";
		$mssqlReadInsidePagingStatement.="[".$targetTable."].[".$columnNameMysql."],\n";
	}
	$mssqlReadInsidePagingStatement.="[staff].[staffName],\n";
	$mssqlReadInsidePagingStatement.="ROW_NUMBER() OVER (ORDER BY [".$targetTable."].[".$targetTableId."]) AS 'RowNumber'\n";
	$mssqlReadStatement.=$mssqlReadInsideStatement;

	$mssqlReadPagingStatement.=$mssqlReadInsidePagingStatement;
	$mssqlReadStatement.="[staff].[staffName]
			FROM 	[".$targetDbObject."].[".$targetTable."]
			JOIN		[".$targetDbManagementObject."].[staff]
			ON		[".$targetTable."].[executeBy] = [staff].[staffId]
			WHERE 		\" . \$this->auditFilter; \n";
	$mssqlReadPagingStatement.="
						
			FROM 	[".$targetDbObject."].[".$targetTable."]
			JOIN		[".$targetDbManagementObject."].[staff]
			ON		[".$targetTable."].[executeBy] = [staff].[staffId]
			WHERE \" . \$this->auditFilter . \$tempSql . \$tempSql2 . \"
							)
							SELECT		*
							FROM 		[".$targetTable."Derived]
							WHERE 		[RowNumber]
							BETWEEN	\" . (\$this->getStart() + 1) . \"
							AND 			\" . (\$this->getStart() + \$this->getLimit()) . \" ;\";\n";

	$oracleReadStatement.="\n\$sql = \"SELECT";
	$oracleReadPagingStatement.="
						\$sql = \"
						SELECT *
						FROM ( SELECT	a.*,
												rownum r
						FROM (";
	foreach($columnNameArray as $columnNameMysql) {
		$oracleReadInsideStatement.=" ".strtoupper($targetTable).".".strtoupper($columnNameMysql).",\n";
	}
	$oracleReadStatement.=$oracleReadInsideStatement;

	$oracleReadStatement.="STAFF.STAFFNAME
			FROM 	".strtoupper($targetTable)."
			JOIN		STAFF
			ON		".strtoupper($targetTable).".EXECUTEBY = STAFF.STAFFID
			WHERE 		\" . \$this->auditFilter; \n";
	$oracleReadPagingCopyStatement = str_replace('$sql = "','',$oracleReadStatement);
	$oracleReadPagingCopyStatement = str_replace(';','.',$oracleReadPagingCopyStatement);
	$oracleReadPagingStatement.=substr($oracleReadPagingCopyStatement,0,-2);
	$oracleReadPagingStatement.="  \$tempSql . \$tempSql2 . \"
								 ) a
						where rownum <= '\" . (\$this->getStart() + \$this->getLimit()) . \"' )
						where r >=  '\" . (\$this->getStart() + 1) . \"'\";";

	// end readStatement
	if($targetGridType=='first') {
		$gridPanel.=
			"\nvar ".$targetTable."FlagArray = ['isDefault', 'isNew', 'isDraft', 'isUpdate', 'isDelete', 'isActive', 'isApproved', 'isReview', 'isPost'];
	\nvar ".$targetTable."Grid = new Ext.grid.GridPanel({
			name : '".$targetTable."Grid',
			id : '".$targetTable."Grid',
			border : false,
			store : ".$targetTable."Store,
			autoHeight : false,
			height : 400,
			columns : ".$targetTable."ColumnModel,
			plugins : [".$targetTable."Filters],
			selModel : new Ext.grid.RowSelectionModel({
				singleSelect : true
			}),
			viewConfig : {
				emptyText : emptyRowLabel
			},
			iconCls : 'application_view_detail',
			listeners : {
				'rowclick' : function (object, rowIndex, e) {
					var record = ".$targetTable."Store.getAt(rowIndex);
					formPanel.getForm().reset();
					formPanel.form.load({
						url : '../controller/".$targetTable."Controller.php',
						method : 'POST',
						waitTitle : systemLabel,
						waitMsg : waitMessageLabel,
						params : {
							method : 'read',
							mode : 'update',
							".$targetTable."Id : record.data.".$targetTable."Id,
							leafId : leafId,
							isAdmin : isAdmin
						},
						success : function (form, action) {
							viewPort.items.get(1).expand();
						},
						failure : function (form, action) {
							Ext.MessageBox.alert(systemErrorLabel, action.result.message);
						}
					});
					
					Ext.getCmp('newButton').disable();
					Ext.getCmp('saveButton').enable();
					Ext.getCmp('deleteButton').enable();
				}
			},
			tbar : {
				items : [{
					xtype:'button',
					text: ' ',
					tooltip:excelToolbarLabel,
					iconCls : 'page_excel',
					id : 'page_excel',
					
					handler : function () {
						Ext.Ajax.request({
							url : '../controller/".$targetTable."Controller.php',
							method : 'GET',
							params : {
								method : 'report',
								mode : 'excel',
								limit : perPage,
								leafId : leafId
							},
							success : function (response, options) {
								jsonResponse = Ext.decode(response.responseText);
								if (jsonResponse.success == true) {
									window.open('../document/excel/' + jsonResponse.filename);
								} else {
									Ext.MessageBox.alert(successLabel, jsonResponse.message);
								}
							},
							failure : function (response, options) {
								Ext.MessageBox.alert(systemErrorLabel, escape(response.status) + ':' + escape(response.statusText));
							}
						});
					}
				},'-',{
					xtype:'button',
					text : '',
					tooltip:addToolbarLabel,
					iconCls : 'add',
					id : 'pageCreate',
					
					handler : function (button,e) {
						viewPort.items.get(1).expand();
					}},'-',{
						xtype:'button',
						text:' ',
						tooltip:CheckAllLabel,
						iconCls : 'row-check-sprite-check',
						listeners : {
							'click' : function (button, e) {
								".$targetTable."Store.each(function (record, fn, scope) {
									for (var access in ".$targetTable."FlagArray) {
										record.set(".$targetTable."FlagArray[access], true);
									}
								});
							}
						}
					}, '-',{
						text:' ',
						tooltip:ClearAllLabel,
						xtype : 'button',
						iconCls : 'row-check-sprite-uncheck',
						listeners : {
							'click' : function (button, e) {
								".$targetTable."Store.each(function (record, fn, scope) {
									for (var access in ".$targetTable."FlagArray) {
										record.set(".$targetTable."FlagArray[access], false);
									}
								});
							}
						}
					},'-', {
						xtype : 'button',
						tooltip : saveButtonLabel,
						iconCls : 'bullet_disk',
						listeners : {
							'click' : function (button, e) {
								var url = '../controller/".$targetTable."Controller.php?';
								var sub_url = '';
								var modified = ".$targetTable."Store.getModifiedRecords();
								for (var i = 0; i < modified.length; i++) {
									var dataChanges = modified[i].getChanges();
									sub_url = sub_url + '&".$targetTable."Id[]=' + modified[i].get('".$targetTable."Id');
									if (isAdmin == 1) {
										if (dataChanges.isDefault == true || dataChanges.isDefault == false) {
											sub_url = sub_url + '&isDefault[]=' + modified[i].get('isDefault');
										}
										if (dataChanges.isDraft == true || dataChanges.isDraft == false) {
											sub_url = sub_url + '&isDraft[]=' + modified[i].get('isDraft');
										}
										if (dataChanges.isNew == true || dataChanges.isNew == false) {
											sub_url = sub_url + '&isNew[]=' + modified[i].get('isNew');
										}
										if (dataChanges.isUpdate == true || dataChanges.isUpdate == false) {
											sub_url = sub_url + '&isUpdate[]=' + modified[i].get('isUpdate');
										}
									}
									if (dataChanges.isDelete == true || dataChanges.isDelete == false) {
										sub_url = sub_url + '&isDelete[]=' + modified[i].get('isDelete');
									}
									if (isAdmin == 1) {
										if (dataChanges.isActive == true || dataChanges.isActive == false) {
											ssub_url = sub_url + '&isActive[]=' + modified[i].get('isActive');
										}
										if (dataChanges.isApproved == true || dataChanges.isApproved == false) {
											sub_url = sub_url + '&isApproved[]=' + modified[i].get('isApproved');
										}
										if (dataChanges.isReview == true || dataChanges.isReview == false) {
											sub_url = sub_url + '&isReview[]=' + modified[i].get('isReview');
										}
										if (dataChanges.isPost == true || dataChanges.isPost == false) {
											sub_url = sub_url + '&isPost[]=' + modified[i].get('isPost');
										}
									}
								}
								url = url + sub_url;
								Ext.Ajax.request({
									url : url,
									method : 'GET',
									params : {
										leafId : leafId,
										isAdmin : isAdmin,
										method : 'updateStatus'
									},
									success : function (response, options) {
										jsonResponse = Ext.decode(response.responseText);
										if (jsonResponse.success == true) {
											Ext.MessageBox.alert(systemLabel, jsonResponse.message);
											businessPartnerStore.reload();
										} else if (jsonResponse.success == false) {
											Ext.MessageBox.alert(systemErrorLabel, jsonResponse.message);
										}
									},
									failure : function (response, options) {
										Ext.MessageBox.alert(systemErrorLabel, escape(response.status) + ':' + escape(response.statusText));
									}
								});
							}
						}
					},'-',";
		if($_GET['targetFilterType']=='first'){
			$a = range('A','Z');
			//$a = range(1,12);
			foreach($a as $z) {
				$gridPanel.="{ xtype:'button', text:'".$z."', handler: function (button,e) {
						
								".$targetTable."Store
													.reload({
														params : {
															leafId : leafId,
															start : 0,
															limit : perPage,
															character : '".$z."'
														}
													});
							
							} 
						},'-',";
			}
		} else  if ($targetFilter=='date') {
			
		}


		$gridPanel.="'->', new Ext.ux.form.SearchField({
					store : ".$targetTable."Store,
					width : 200
				})]
			},
			bbar : new Ext.PagingToolbar({
				store : ".$targetTable."Store,
				pageSize : perPage,
				plugins : [".$targetTable."Filters]
			})
		});
	var gridPanel = new Ext.Panel({
			title : leafNative,
			iconCls : 'application_view_detail',
			layout : 'fit',		
			items : [".$targetTable."Grid]
		});";
	} else {

		$gridPanel.="\nvar ".$targetTable."FlagArray = ['isDefault', 'isNew', 'isDraft', 'isUpdate', 'isDelete', 'isActive', 'isApproved', 'isReview', 'isPost'];
    var ".$targetTable."Grid = new Ext.grid.GridPanel({";
		if($_GET['targetGridType'] !='second') {
			$gridPanel.=" region:'center',";
		}
     $gridPanel.="   name: '".$targetTable."Grid',
        id: '".$targetTable."Grid',
        border: false,
        store: ".$targetTable."Store,
        height: 250,
        autoScroll: true,
        columns: ".$targetTable."ColumnModel,
        viewConfig: {
            autoFill: true,
            forceFit: true,
			emptyRow : emptyRowLabel
        },
        layout: 'fit',
        disabled: ";
		if($_GET['targetGridType']=='second') { 
			$gridPanel.="true";
		} else {
			$gridPanel.="false";
		}		
		 $gridPanel.=", 
		 plugins: [".$targetTable."Editor],
        tbar: {
            items: [{
                xtype: 'button',
                iconCls: 'add',
                id: 'add_record',
                name: 'add_record',
                text: newButtonLabel,
                handler: function () {\n";
		$gridPanel.="\nvar newRecord = new ".$targetTable."Entity({\n";
		foreach($columnNameArray as $columnNameMysql) {

			$gridPanelInsideValue.="  ".$columnNameMysql.": '',\n";

		}
		$gridPanel.=substr($gridPanelInsideValue,0,-2);

		$gridPanel.="\n});
                    ".$targetTable."Editor.stopEditing();
                    ".$targetTable."Store.insert(0, newRecord);
                    ".$targetTable."Grid.getSelectionModel().getSelections();
                    ".$targetTable."Editor.startEditing(0);
                }
            }, {
                xtype: 'button',
                text: CheckAllLabel,
                iconCls: 'row-check-sprite-check',
                listeners: {
                    'click': function (button, e) {
                        ".$targetTable."Store.each(function (record,fn,scope) {
                            for (var access in ".$targetTable."FlagArray) {
                                record.set(".$targetTable."FlagArray[access], true);
                            }
                        });
                    }
                }
            }, {
                text: ClearAllLabel,
                iconCls: 'row-check-sprite-uncheck',
                listeners: {
                    'click': function (button, e) {
                        ".$targetTable."Store.each(function (record,fn,scope) {
                            for (var access in ".$targetTable."FlagArray) {
                                record.set(".$targetTable."FlagArray[access], false);
                            }
                        });
                    }
                }
            }, {
                xtype: 'button',
                text: saveButtonLabel,
                iconCls: 'bullet_disk',
                listeners: {
                    'click': function (button, e) {
                        var url = '../controller/".$targetTable."Controller.php?';
                        var sub_url = '';
                        var modified = ".$targetTable."Store.getModifiedRecords();
                        for (var i = 0; i < modified.length; i++) {
                            var dataChanges = modified[i].getChanges();
                            sub_url = sub_url + '&".$targetTable."Id[]=' + modified[i].get('".$targetTable."Id');
                            if (isAdmin == 1) {
                                if (dataChanges.isDefault == true || dataChanges.isDefault == false) {
                                    sub_url = sub_url + '&isDefault[]=' +modified[i].get('isDefault');
                                }
                                if (dataChanges.isDraft == true || dataChanges.isDraft == false) {
                                    sub_url = sub_url + '&isDraft[]=' +modified[i].get('isDraft');
                                }
                                if (dataChanges.isNew == true || dataChanges.isNew == false) {
                                    sub_url = sub_url + '&isNew[]=' +modified[i].get('isNew');
                                }
                                if (dataChanges.isUpdate == true || dataChanges.isUpdate == false) {
                                    sub_url = sub_url + '&isUpdate[]=' +modified[i].get('isUpdate');
                                }
                            }
                            if (dataChanges.isDelete == true || dataChanges.isDelete == false) {
                                sub_url = sub_url + '&isDelete[]=' +modified[i].get('isDelete');
                            }
                            if (isAdmin == 1) {
                                if (dataChanges.isActive == true || dataChanges.isActive == false) {
                                    ssub_url = sub_url + '&isActive[]=' +modified[i].get('isActive');
                                }
                                if (dataChanges.isApproved == true || dataChanges.isApproved == false) {
                                    sub_url = sub_url + '&isApproved[]=' +modified[i].get('isApproved');
                                }
                                if (dataChanges.isReview == true || dataChanges.isReview == false) {
                                    sub_url = sub_url + '&isReview[]=' +modified[i].get('isReview');
                                }
                                if (dataChanges.isPost == true || dataChanges.isPost == false) {
                                    sub_url = sub_url + '&isPost[]=' +modified[i].get('isPost');
                                }
                            }
                        }
                        url = url + sub_url;
                        Ext.Ajax.request({
                            url: url,
                            method: 'GET',
                            params: {
                                leafId: leafId,
                                isAdmin: isAdmin,
                                method: 'updateStatus'
                            },
                            success: function (response, options) {
                                jsonResponse = Ext.decode(response.responseText);
                                if (jsonResponse.success == true) {
                                    Ext.MessageBox.alert(systemLabel, jsonResponse.message);
                                    			".$targetTable."Store.reload({ ";
									if($_GET['targetGridType']=='second') { 
										$gridPanel.="params :{
											".$targetMasterTableId." : Ext.getCmp('".$targetMasterTableId."').getValue()
										}";
									}
									
								 $gridPanel.=" }); 
								 
                                } else if (jsonResponse.success == false) {
                                    Ext.MessageBox.alert(systemErrorLabel, jsonResponse.message);
                                }
                            },
                            failure: function (response, options) {
                                Ext.MessageBox.alert(systemErrorLabel, escape(response.status) + ':' + escape(response.statusText));
                            }
                        }); 
                    }
                }
            }]
        },
        bbar: new Ext.PagingToolbar({
            store: ".$targetTable."Store,
            pageSize: perPage
        }),
        view: new Ext.ux.grid.BufferView({
            rowHeight: 34,
            scrollDelay: false
        })
    });";
	}









	if($_GET['targetGridType']=='first') {
		
		$systemCheckBox="
	var isDefaultGrid = new Ext.ux.grid.CheckColumn({
        header: isDefaultLabel,
        dataIndex: 'isDefault',
        hidden: isDefaultHidden
    });
    var isNewGrid = new Ext.ux.grid.CheckColumn({
        header: 'New',
        dataIndex: 'isNew',
        hidden: isNewHidden
    });
    var isDraftGrid = new Ext.ux.grid.CheckColumn({
        header: isDraftLabel,
        dataIndex: 'isDraft',
        hidden: isDraftHidden
    });
    var isUpdateGrid = new Ext.ux.grid.CheckColumn({
        header: isUpdateLabel,
        dataIndex: 'isUpdate',
        hidden: isUpdateHidden
    });
    var isDeleteGrid = new Ext.ux.grid.CheckColumn({
        header: isDeleteLabel,
        dataIndex: 'isDelete'
    });
    var isActiveGrid = new Ext.ux.grid.CheckColumn({
        header: isActiveLabel,
        dataIndex: 'isActive',
        hidden: isActiveHidden
    });
    var isApprovedGrid = new Ext.ux.grid.CheckColumn({
        header: isApprovedLabel,
        dataIndex: 'isApproved',
        hidden: isApprovedHidden
    });
    var isReviewGrid = new Ext.ux.grid.CheckColumn({
        header: isReviewLabel,
        dataIndex: 'isReview',
        hidden: isReviewHidden
    });
    var isPostGrid = new Ext.ux.grid.CheckColumn({
        header: 'Post',
        dataIndex: 'isPost',
        hidden: isPostHidden
    });
    
	";
	}  else {

		$systemCheckBox="
			
    var isDefaultGridDetail = new Ext.ux.grid.CheckColumn({
        header: isDefaultLabel,
        dataIndex: 'isDefault',
        hidden: isDefaultHidden
    });
    var isNewGridDetail = new Ext.ux.grid.CheckColumn({
        header: isNewLabel,
        dataIndex: 'isNew',
        hidden: isNewHidden
    });
    var isDraftGridDetail = new Ext.ux.grid.CheckColumn({
        header: isDraftLabel,
        dataIndex: 'isDraft',
        hidden: isDraftHidden
    });
    var isUpdateGridDetail = new Ext.ux.grid.CheckColumn({
        header: isUpdateLabel,
        dataIndex: 'isUpdate',
        hidden: isUpdateHidden
    });
    var isDeleteGridDetail = new Ext.ux.grid.CheckColumn({
        header: isDeleteLabel,
        dataIndex: 'isDelete'
    });
    var isActiveGridDetail = new Ext.ux.grid.CheckColumn({
        header: isActiveLabel,
        dataIndex: 'isActive',
        hidden: isActiveHidden
    });
    var isApprovedGridDetail = new Ext.ux.grid.CheckColumn({
        header: isApprovedLabel,
        dataIndex: 'isApproved',
        hidden: isApprovedHidden
    });
    var isReviewGridDetail = new Ext.ux.grid.CheckColumn({
        header: isReviewLabel,
        dataIndex: 'isReview',
        hidden: isReviewHidden
    });
    var isPostGridDetail = new Ext.ux.grid.CheckColumn({
        header: isPostLabel,
        dataIndex: 'isPost',
        hidden: isPostHidden
    });
		";

		$jsonWriter="var ".$targetTable."Editor = new Ext.ux.grid.RowEditor({
        saveText: saveButtonLabel,
        cancelText: cancelButtonLabel,
        listeners: {
            cancelEdit: function (rowEditor, changes, record, rowIndex) {
               
				".$targetTable."Store.reload({ ";
									if($_GET['targetGridType']=='second') { 
										$jsonWriter.="params :{
											".$targetMasterTableId." : Ext.getCmp('".$targetMasterTableId."').getValue()
										}";
									}
									
								 $jsonWriter.=" }); 
            },
            afteredit: function (rowEditor, changes, record, rowIndex) {
                this.save = true;
                var record = this.grid.getStore().getAt(rowIndex);
				if (parseInt(record.get('".$targetTable."Id')) == 'NaN') {
                    method = 'create';
                } else if (record.get('".$targetTable."Id') == '') {
                    method = 'create';
                } else if (record.get('".$targetTable."Id') == undefined) {
                    method = 'create';
                } else if (parseInt(record.get('".$targetTable."Id')) > 0) {
                    method = 'save';
                } else {
                    method = 'create';
                }
                Ext.Ajax.request({
                    url: '../controller/".$targetTable."Controller.php',
                    method: 'POST',
                    params: {
                        leafId: leafId,
                        isAdmin: isAdmin,
                        method: method,\n";

		foreach($columnNameArray as $columnNameMysql) {
			if($columnNameMysql !='isDefault' &&
			$columnNameMysql !='isNew' &&
			$columnNameMysql !='isDraft'&&
			$columnNameMysql !='isUpdate'&&
			$columnNameMysql !='isDelete'&&
			$columnNameMysql !='isActive'&&
			$columnNameMysql !='isApproved'&&
			$columnNameMysql !='isReview'&&
			$columnNameMysql !='isPost'&&
			$columnNameMysql !='isSeperated'&&
			$columnNameMysql !='isConsolidation'&&
			$columnNameMysql !='isReconciled' &&
			$columnNameMysql !='executeBy'&&
			$columnNameMysql !='executeTime' &&
			$columnNameMysql !=$targetTableId) {
		$jsonWriterInsideValue.="  ".$columnNameMysql.": Ext.getCmp('". $columnNameMysql."').getValue(),\n";
		
			} else if ($columnNameMysql == $targetTableId) {
					$jsonWriterInsideValue.="  ".$columnNameMysql.": record.get('". $columnNameMysql."')\n,";
			}		
		}
			$jsonWriter.=substr($jsonWriterInsideValue,0,-2);

			$jsonWriter.="},
                    success: function (response, options) {
                        jsonResponse = Ext.decode(response.responseText);
                        if (jsonResponse.success == false) {
                            Ext.MessageBox.alert(systemLabel, jsonResponse.message);
                        } else {
							".$targetTable."Store.reload({ ";
									if($_GET['targetGridType']=='second') { 
										$jsonWriter.="params :{
											".$targetMasterTableId." : Ext.getCmp('".$targetMasterTableId."').getValue()
										}";
									}
									
								 $jsonWriter.=" }); 
								  
						}
                    },
                    failure: function (response, options) {
                        Ext.MessageBox.alert(systemErrorLabel, escape(response.status) + \":\" + response.statusText);
                    }
                });
            }
        }
    });";
	}




	include("javascript.php");// file
	include("model.php");// file
	include("controller.php");// file
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Hello SyntaxHighlighter</title>
<script type="text/javascript" src="scripts/shCore.js"></script>
<script type="text/javascript" src="scripts/shBrushJScript.js"></script>
<script type="text/javascript" src="scripts/shBrushPhp.js"></script>
<link type="text/css" rel="stylesheet" href="styles/shCoreDefault.css" />
<script type="text/javascript">SyntaxHighlighter.all();</script>
</head>

<body style="background: white; font-family: Helvetica">
	<script language="javascript">
function db(value){
location.href ='<?php echo basename($_SERVER['PHP_SELF']); ?>?targetDb='+value;
}
function check(value) { 
	if(value=='javascript') { 
		document.getElementById('targetGridType').disabled=false;
	} else { 
		document.getElementById('targetGridType').disabled=true;
	}
}
</script>
	<form action="<?php echo basename($_SERVER['PHP_SELF']); ?>" method="get">
		<table>


			<tr>
				<td>Target Db</td>
				<td><select name="targetDb" id="targetDb" onChange=db(this.value)>
				<?php
				$sql="show databases;";
				$result = mysql_query($sql) or die(mysql_error());
				while ($row = mysql_fetch_array($result)) { ?>

						<option value="<?php echo $row['Database']; ?>"
						<?php if($_GET['targetDb']==$row['Database']) { echo "selected"; } ?>>
							<?php echo $row['Database']; ?>
						</option>
						<?php }?>
				</select>
				</td>
			</tr>
			<tr>
				<td>Target Table</td>
				<td><select name="targetTable">
				<?php if($_GET['targetDb']) {
					$sql="show tables in ".strtolower($_GET['targetDb']).";";
					$result = mysql_query($sql) or die(mysql_error());
					while ($row = mysql_fetch_array($result)) { ?> ?>
						<option
							value="<?php echo $row['Tables_in_'.strtolower($_GET['targetDb'])]; ?>"
							<?php if(strtolower($_GET['targetTable'])==strtolower($row['Tables_in_'.strtolower($_GET['targetDb'])])) { ?>
							selected <?php } ?>>
							<?php echo $row['Tables_in_'.strtolower($_GET['targetDb'])]; ?>
						</option>
						<?php }}  ?>

				</select>
				</td>
			</tr>
			<tr>
				<td>Target Master Table</td>
				<td><select name="targetMasterTableId">
				<?php if($_GET['targetDb']) {
					$sql="show tables in ".strtolower($_GET['targetDb']).";";
					$result = mysql_query($sql) or die(mysql_error());
					while ($row = mysql_fetch_array($result)) { ?> ?>
						<option
							value="<?php echo $row['Tables_in_'.strtolower($_GET['targetDb'])]; ?>"
							<?php if(strtolower($_GET['targetMasterTableId'])==strtolower($row['Tables_in_'.strtolower($_GET['targetDb'])])) { ?>
							selected <?php } ?>>
							<?php echo $row['Tables_in_'.strtolower($_GET['targetDb'])]; ?>
						</option>
						<?php }} ?>
				</select>
				</td>
			</tr>
			<tr>
				<td>Source Type</td>
				<td><select name="type" id="type" onChange=check(this.value)>
						<option value="javascript"
						<?php if($_GET['type']=='javascript') { ?> selected <?php } ?>>Javascript
							Code</option>
						<option value="model" <?php if($_GET['type']=='model') { ?>
							selected <?php } ?>>Model Entity</option>
						<option value="controller"
						<?php if($_GET['type']=='controller') { ?> selected <?php } ?>>Controller
							Or Service</option>
				</select></td>
			</tr>
			<tr>
				<td>Target Form Type</td>
				<td><select name="targetGridType" id="targetGridType">
						<option value="first"
						<?php if($_GET['targetGridType']=='first') { ?> selected
						<?php } ?>>Form Only</option>
						<option value="second"
						<?php if($_GET['targetGridType']=='second') { ?> selected
						<?php } ?>>Grid Only(Detail)</option>
						<option value="third"
						<?php if($_GET['targetGridType']=='third') { ?> selected
						<?php } ?>>Viewport + Grid Only</option>
				</select>
				</td>
			</tr>
			<tr>
				<td>Target Filter Type</td>
				<td><select name="targetFilterType" id="targetFilterType">
						<option value="first"
						<?php if($_GET['targetFilterType']=='first') { ?> selected
						<?php } ?>>Character</option>
						<option value="second"
						<?php if($_GET['targetFilterType']=='second') { ?> selected
						<?php } ?>>Date</option>
				</select>
				</td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" name="submit" text="submit">
				
				</td>
			</tr>
		</table>
	</form>
	<?php if($_GET['type']=='javascript') { ?>
	<?php 
	/** ?>
	<a name="copyJsonStore"></a>
	<h1>Copy To Json Store</h1>
	<pre class="brush: js;">
	<?php echo (substr($str,0,-1)); ?>
</pre>
	<a name="copyGridFilter"></a>
	<h1>Copy To GridFilter</h1>
	<pre class="brush: js;">
	<?php echo $str5; ?>
</pre>
	<a name="copyColumnModel"></a>
	<h1>Copy To ColumnModel</h1>
	<pre class="brush: js;">
	<?php echo $str4; ?>
</pre>
	<a name="copyFormItem"></a>
	<h1>Copy To Form Item</h1>
	<pre class="brush: js;">
	<?php echo $str2; ?>
</pre>
<?php } ?>
	<a name="jsonRequest"></a>
	<h1>Request,Reader,JsonStore</h1>
	<pre class="brush: js;">
<?php echo $jsonStoreString; ?>
</pre>
	<a name="gridFilter"></a>
	<h1>GridFilter</h1>
	<pre class="brush: js;">
<?php echo $gridFilterJs; ?>
</pre>
	<a name="columnModel"></a>
	<h1>ColumnModel</h1>
	<pre class="brush: js;">
<?php echo $columnModelJs; ?>
</pre>
	<a name="gridPanel"></a>
	<h1>GridPanel</h1>
	<pre class="brush: js;">
<?php echo $gridPanel; ?>
</pre>
	<a name="copyFormItem"></a>
	<h1>Copy To Form Item</h1>
	<pre class="brush: js;">
<?php echo $formItem; ?>
</pre>
	<a name="systemValidation"></a>
	<h1>System Validation</h1>
	<pre class="brush: js;">
<?php echo $systemValidation; ?>
</pre>
	<a name="formPanel"></a>
	<h1>Form Panel</h1>
	<pre class="brush: js;">
<?php echo $formPanel; ?>
</pre>
***/ ?>
	<a name="fulljs"></a>
	<h1>Full Javascript</h1>
	<pre class="brush: js;">

<?php
if($_GET['targetGridType']=='first') {
	echo $firstCodeJs.$jsonStoreString.$gridFilterJs.$systemCheckBox.$columnModelJs.$gridPanel.$formItem.$systemValidation.$formPanel. $lastCodejs;
} else  if($_GET['targetGridType']=='second'){
	echo $jsonStoreString.$gridFilterJs.$formItem.$systemCheckBox.$comboRenderer.$columnModelJs.$jsonWriter.$entity.$gridPanel;

}  else {
	echo $firstCodeJs.$jsonStoreString.$gridFilterJs.$formItem.$systemCheckBox.$comboRenderer.$columnModelJs.$jsonWriter.$entity.$gridPanel. $lastCodejs;

}?>
</pre>
<?php } ?>

<?php if ($_GET['type']=='controller') { ?>


	<a name="updateStatus"></a>
	<h1>Full Statement</h1>
	<pre class="brush: php;">
<?php echo $controller; ?>
</pre>
<?php } ?>
<?php if ($_GET['type']=='model') { ?>
	<h1>haha Statement</h1>
	<pre class="brush: php;">
<?php echo $mainModel.$mainModelInside.$execute.$crud.$model.$getterSetter." \n} "; ?>
</pre>
<?php } ?>

</html>
