<?php 
class generator {
	private $targetDatabase;
	private $targetTable;
	private $targetGridType;
	private $output;
	public function __construct() {
	}
	public function showCode() {
		$sqlDescribe     ="
		DESCRIBE `".$this->getTargetDatabase()."`.`".$this->getTargetTable()."`";
		$resultFieldTable  = mysql_query($sqlFieldTable);
		while($rowFieldTable = mysql_fetch_array($resultFieldTable)) {
			$columnName=$rowFieldTable['Field'];
			$mystring=$rowFieldTable['Type'];
			
			$key  = $rowFieldTable['Key'];
			
			$infoColumn[]['columnName']
			$infoColumn[]['Type']=$rowFieldTable['Type'];
			$infoColumn[]['Key']=$rowFieldTable['Key'];
			$infoColumn[]['foreignKey']=$this->getInfoTableColumn($columnName);
			
			$findme='varchar';
			$pos = strpos($rowFieldTable['Type'], $findme);
			if ($pos !== false) {
			
				$infoColumn[]['formType']="Text";
				$infoColumn[]['jsonType']="string";
			
			}
			$findme='text';
			$pos = strpos($rowFieldTable['Type'], $findme);
			if ($pos !== false) {
				$infoColumn[]['formType']="Text";
				$infoColumn[]['jsonType']="string";
			}
			$findme='int';
			$pos = strpos($rowFieldTable['Type'], $findme);
			if ($pos !== false) {
				$infoColumn[]['formType']="Number";
				$infoColumn[]['jsonType']="int";
			}
			$findme='date';
			$pos = strpos($rowFieldTable['Type'], $findme);
			if ($pos !== false) {
				$infoColumn[]['formType']="Date";
				$infoColumn[]['jsonType']="date";
				$infoColumn[]['dateType']="Y-m-d";
			
			}
			$findme='datetime';
			$pos = strpos($rowFieldTable['Type'], $findme);
			if ($pos !== false) {
				$infoColumn[]['formType']="Date";
				$infoColumn[]['jsonType']="date";
				$infoColumn[]['dateType']="Y-m-d H:i:s";
			
			}
			$findme='tiny';
			$pos = strpos($rowFieldTable['Type'], $findme);
			if ($pos !== false) {
				$infoColumn[]['formType']="Number";
				$infoColumn[]['jsonType']="boolean";
		
			}

			$findme='double';
			$pos = strpos($rowFieldTable['Type'], $findme);
			if ($pos !== false) {
				$infoColumn[]['formType']="Text";
				$infoColumn[]['jsonType']="float";
			}
			
		}
		switch($this->targetOutput()) { 
			case 'html':
				$this->generateHtml($infoColumn);
			break;
			case 'javascript':
				$this->generateJavascript($infoColumn);
			break;
			case 'controller':
				$this->generateController($infoColumn);
			break;
			case 'model':
				$this->generateModel($infoColumn);
			break;
			default:
				echo "Please Identify output type";
			} 	
		} 		
	}
	private function getInfoTableColumn($columnName) {
		$sql="
		SELECT	table_schema, 
				table_name, 
				column_name, 
				referenced_table_schema, 
				referenced_table_name, 
				referenced_column_name
		FROM 	information_schema.KEY_COLUMN_USAGE
		WHERE 	table_schema='".$targetDb."'
		AND 	table_name = '".$targetTable."'
		AND  	column_name ='".$columnName."'		";

		$resultForeignKey = mysql_query($sql) or die(mysql_error());
		$rowForeignKey  = mysql_fetch_array($resultForeignKey);
		if($rowForeignKey['referenced_table_schema'] != null  && $rowForeignKey['referenced_table_name'] != null && $rowForeignKey ['referenced_column_name'] != null) {
				$foreignKey=1;
			} else {
				$foreignKey=0;
			}
		return $foreignKey;	
	} 
	private function generateHtml($infoColumn) {
		include ("html2.php");
		return $str;
	} 
	private function generateJavascript($infoColumn) {
	
		include("javascript2.php");
		return $str;
	} 
	private function generateController($infoColumn) {
		include("controller2.php");
	}
	private function generateModel($infoColumn) {
		include("model2.php");
	} 
	/**
	 * Return Target Database
	 * return string $targetDatabase
	 */
	public getTargetDatabase() { 
		return $this->targetDatabase;
	} 
	/**
	 * Set Target Database
	 * param string $value
	 */
	public setTargetDatabase($value) {
		$this->targetDatabase = $value;
	}
    /**
	 * Return Target Table
	 * return string $targetTable
	 */
	public getTargetTable() { 
		return $this->targetTable;
	} 
	/**
	 * Set Target Table
	 * param string $value
	 */
	public setTargetTable($value) {
		$this->targetTable = $value;
	}
    /**
	 * Return Target Grid Type
	 * return string $targetTable
	 */
	public getTargetGridType() { 
		return $this->targetGridType;
	} 
	/**
	 * Set Target Grid Type
	 * param string $value
	 */
	public setTargetGridType($value) {
		$this->targetGridType = $value;
	}
	 /**
	 * Return Target Output
	 * return string $output
	 */
	public getOutput() { 
		return $this->targetOutput;
	} 
	/**
	 * Set Target Output
	 * param string $value
	 */
	public setOutput($value) {
		$this->targetOutput = $value;
	}  	
}
$generator = new generator();
$generator->view();
$generator->execute();
$generator->showCode();
?> 
