<?php

class generator {

    /**
     * Target Database
     * @var string 
     */
    private $targetDatabase;

    /**
     * Target table structure
     * @var string 
     */
    private $targetTable;

    /**
     * To Target output  grid type either by character or date filtering
     * @var string 
     */
    private $targetGridType;

    /**
     * To target output source code generator either it was html ,javascript,controller or model
     * @var string 
     */
    private $targetOutput;
    /**
     * To target Package
     * @var string 
     */
    private $targetPackage;
     /**
     * To target Module
     * @var string 
     */
    private $targetModule;
    /**
     * To return information about column
     * @var array 
     */
    private $infoColumnArray;
    
    public $packageAndModule;

    /**
     * 
     */

    const DEFAULTDATABASE = 'icore';

    /**
     * Constructor function
     */
    public function __construct() {
        mysql_connect("localhost", "root", "123456");
        
        $package=array();
$package[]='document';
$package[]='financial';
$package[]='sample';
$package[]='portal';
$package[]='problem';
$package[]='system';
$package['document'][]='document';
$package['document'][]='numbering';

$package['financial'][]='accountPayable';
$package['financial'][]='accountReceivable';
$package['financial'][]='businessPartner';
$package['financial'][]='cashbook';
$package['financial'][]='fixasset';
$package['financial'][]='generalLedger';
$package['financial'][]='humanResource';
$package['financial'][]='payroll';
$package['financial'][]='project';

$package['market'][]='midnightMarket';

$package['portal'][]='main';

$package['system'][]='common';
$package['system'][]='management';
$package['system'][]='security';
$package['system'][]='translation';
    $this->packageAndModule = $package;
    }

    /**
     * main function 
     */
    public function execute() {

        if ($this->getTargetDatabase()) {
            mysql_select_db($this->getTargetDatabase());
        } else {
            $this->setTargetDatabase(self::DEFAULTDATABASE);
            mysql_select_db(self::DEFAULTDATABASE);
        }
        $this->showCode();
    }

    function htmlForm() {
        // @todo  future using bootstrap style.. 
        ?>
        <script language="javascript">
            function db(value){
                location.href ='<?php echo basename($_SERVER['PHP_SELF']); ?>?targetDatabase='+value;
            }
            function changePackage(){
                targetDatabase= $("#targetDatabase").val();
                targetTable= $("#targetDatabase").val();
                targetTableId= $("#targetDatabase").val();
                targetPackage= $("#targetPackage").val();
                targetModule= $("#module").val();
                targetOutput= $("#targetOutput").val()
                targetGridType= $("#targetGridType").val();
                targetFilterType= $("#targetFilterType").val();
                url ='<?php echo basename($_SERVER['PHP_SELF']); ?>';
                if(targetDatabase){
                    url = url+"?targetDatabase="+targetDatabase;
                }
                if(targetTable){
                    url = url+"&targetTable="+targetTable;
                }
                if(targetTableId){
                    url = url+"&targetTableId="+targetTableId;
                }
                if(targetPackage){
                    url = url+"&targetPackage="+targetPackage;
                }
                if(targetModule){
                    url = url+"&targetModule="+targetModule;
                }
                if(targetOutput){
                    url = url+"&targetOutput="+targetOutput;
                }
                if(targetGridType){
                    url = url+"&targetGridType="+targetGridType;
                }
                if(targetFilterType){
                    url = url+"&targetFilterType="+targetFilterType;
                }
                location.href =url;
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
                    <td><select name="targetDatabase" id="targetDatabase" onChange=db(this.value)>
                            <?php
                            $sql = "show databases;";
                            $result = mysql_query($sql) or die(mysql_error());
                            while ($row = mysql_fetch_array($result)) {
                                ?>

                                <option value="<?php echo $row['Database']; ?>"
                                <?php
                                if (isset($_GET['targetDatabase'])) {
                                    if ($_GET['targetDatabase'] == $row['Database']) {
                                        echo "selected";
                                    }
                                }
                                ?>>
                                            <?php echo $row['Database']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Target Table</td>
                    <td><select name="targetTable" id="targetTable">
                            <?php
                            if (isset($_GET['targetDatabase'])) {
                                $sql = "show tables in " . strtolower($_GET['targetDatabase']) . ";";
                                $result = mysql_query($sql) or die(mysql_error());
                                while ($row = mysql_fetch_array($result)) {
                                    ?>
                                    <option value="<?php echo $row['Tables_in_' . strtolower($_GET['targetDatabase'])]; ?>"
                                    <?php
                                    if (isset($_GET['targetTable'])) {
                                        if (strtolower($_GET['targetTable']) == strtolower($row['Tables_in_' . strtolower($_GET['targetDatabase'])])) {
                                            echo "selected";
                                        }
                                    }
                                    ?>><?php echo $row['Tables_in_' . strtolower($_GET['targetDatabase'])]; ?></option>
                                            <?php
                                        }
                                    }
                                    ?></select>
                    </td>
                </tr>
                <tr>
                    <td>Target Master Table</td>
                    <td><select name="targetMasterTableId">
                            <?php
                            if (isset($_GET['targetDatabase'])) {
                                $sql = "show tables in " . strtolower($_GET['targetDatabase']) . ";";
                                $result = mysql_query($sql) or die(mysql_error());
                                while ($row = mysql_fetch_array($result)) {
                                    ?> ?>
                                    <option
                                        value="<?php echo $row['Tables_in_' . strtolower($_GET['targetDatabase'])]; ?>"
                                        <?php
                                        if (isset($_GET['targetMasterTableId'])) {
                                            if (strtolower($_GET['targetMasterTableId']) == strtolower($row['Tables_in_' . strtolower($_GET['targetDatabase'])])) {
                                                echo "selected";
                                            }
                                        }
                                        ?>><?php echo $row['Tables_in_' . strtolower($_GET['targetDatabase'])]; ?></option>
                                        <?php
                                    }
                                }
                                ?></select>
                    </td>
                </tr>
                <tr>
                    <td>Target Package</td>
                    <td><select name="targetPackage" id="targetPackage" onChange=changePackage()>
                            <option value="">Please Choose Package</option>
                            <?php for($i=0;$i<count($this->packageAndModule);$i++) { ?>
                            <option value="<?php if(isset($this->packageAndModule[$i])) { echo $this->packageAndModule[$i]; } ?>" 
                            <?php if(isset($_GET['targetPackage'])) { 
                                        if ($_GET['targetPackage']==$this->packageAndModule[$i]) { echo "selected"; } } ?>>
                            <?php if(isset($this->packageAndModule[$i])) { echo $this->packageAndModule[$i]; } ?></option>
                            <?php } ?>
                        </select></td>
                </tr>
                <tr>
                    <td>Target Module</td>
                    <td><?php if (isset($_GET['targetPackage'])) { ?><select name="targetModule" id="targetModule">
                            <option value="">Please Choose Package</option>
                            <?php for($i=0;$i<count($this->packageAndModule[$_GET['targetPackage']]);$i++) { ?>
                            <option value="<?php echo $this->packageAndModule[$_GET['targetPackage']][$i]; ?>" <?php if ($_GET['targetPackage']==$this->packageAndModule[$_GET['targetPackage']][$i]) { echo "selected"; } ?>><?php echo $this->packageAndModule[$_GET['targetPackage']][$i]; ?></option>
                            <?php } ?>
                        </select>
                    <?php } else { ?>
                        Please choose drop down package first.
                    <?php } ?></td>
                </tr>
                <tr>
                    <td>Source Type</td>
                    <td><select name="targetOutput" id="targetOutput" onChange=check(this.value)>
                            <option value="">Please Choose</option>
                            <option value="html"
                            <?php
                            if (isset($_GET['targetOutput'])) {
                                if ($_GET['targetOutput'] == 'html') {
                                    echo "selected";
                                }
                            }
                            ?>>Html Code</option>
                            <option value="javascript"
                            <?php
                            if (isset($_GET['targetOutput'])) {
                                if ($_GET['targetOutput'] == 'javascript') {
                                    echo "selected";
                                }
                            }
                            ?>>Javascript Code</option>
                            <option value="model" <?php
                            if (isset($_GET['targetOutput'])) {
                                if ($_GET['targetOutput'] == 'model') {
                                    echo "selected";
                                }
                            }
                            ?>>Model Entity</option>
                            <option value="controller"
                            <?php
                            if (isset($_GET['targetOutput'])) {
                                if ($_GET['targetOutput'] == 'controller') {
                                    ?> selected <?php
                        }
                    }
                            ?>>Controller</option>
                        </select></td>
                </tr>
                <tr>
                    <td>Target Form Type</td>
                    <td><select name="targetGridType" id="targetGridType">
                            <option value="first"
                            <?php
                            if (isset($_GET['targetGridType'])) {
                                if ($_GET['targetGridType'] == 'first') {
                                    echo "selected";
                                }
                            }
                            ?>>Form Only</option>
                            <option value="second"
                            <?php
                            if (isset($_GET['targetGridType'])) {
                                if ($_GET['targetGridType'] == 'second') {
                                    echo "selected";
                                }
                            }
                            ?>>Grid Only(Detail)</option>
                            <option value="third"
                            <?php
                            if (isset($_GET['targetGridType'])) {
                                if ($_GET['targetGridType'] == 'third') {
                                    echo "selected";
                                }
                            }
                            ?>>Viewport + Grid Only</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Target Filter Type</td>
                    <td><select name="targetFilterType" id="targetFilterType">
                            <option value="first"
                            <?php
                            if (isset($_GET['targetFilterType'])) {
                                if ($_GET['targetFilterType'] == 'first') {
                                    echo "selected";
                                }
                            }
                            ?>>Character</option>
                            <option value="second"
                            <?php
                            if (isset($_GET['targetFilterType'])) {
                                if ($_GET['targetFilterType'] == 'second') {
                                    echo "selected";
                                }
                            }
                            ?>>Date</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" name="submit" text="submit"></td>
                    <td><input type="reset" name="reset" text="reset"></td>
                </tr>
            </table>
        </form>
        <?php
    }

    /**
     * Output source code 
     */
    public function showCode() {
        
        // initilize value
        $infoColumn = array();
        if ($this->getTargetTable()) {
            $sqlDescribe = "
            DESCRIBE `" . $this->getTargetDatabase() . "`.`" . $this->getTargetTable() . "`";
            $resultFieldTable = mysql_query($sqlDescribe);
            $i=0;
            while ($rowFieldTable = mysql_fetch_array($resultFieldTable)) {
                $infoColumn[$i]['tableName'] =  $this->getTargetTable();
                $infoColumn[$i]['package'] =  $this->getTargetPackage();
                $infoColumn[$i]['module'] =  $this->getTargetModule();
                $infoColumn[$i]['columnName'] = $rowFieldTable['Field'];
                $infoColumn[$i]['Type'] = $rowFieldTable['Type'];
                $infoColumn[$i]['Key'] = $rowFieldTable['Key'];
                $infoColumn[$i]['foreignKey'] = $this->getInfoTableColumn($rowFieldTable['Field']);

                $findme = 'varchar';
                $pos = strpos($rowFieldTable['Type'], $findme);
                if ($pos !== false) {

                    $infoColumn[$i]['formType'] = "text";
                }
                $findme = 'text';
                $pos = strpos($rowFieldTable['Type'], $findme);
                if ($pos !== false) {
                    $infoColumn[$i]['formType'] = "text";
                }
                $findme = 'int';
                $pos = strpos($rowFieldTable['Type'], $findme);
                if ($pos !== false) {
                    $infoColumn[$i]['formType'] = "int";
                }
                $findme = 'date';
                $pos = strpos($rowFieldTable['Type'], $findme);
                if ($pos !== false) {
                    $infoColumn[$i]['formType'] = "date";
                }
                $findme = 'datetime';
                $pos = strpos($rowFieldTable['Type'], $findme);
                if ($pos !== false) {
                    $infoColumn[$i]['formType'] = "datetime";
                }
                $findme = 'tiny';
                $pos = strpos($rowFieldTable['Type'], $findme);
                if ($pos !== false) {
                    $infoColumn[$i]['formType'] = "tiny";
                }

                $findme = 'double';
                $pos = strpos($rowFieldTable['Type'], $findme);
                if ($pos !== false) {
                    $infoColumn[$i]['formType'] = "double";
                }
                $i++;
            }
            $this->setInfoColumnArray($infoColumn);
            switch ($this->getTargetOutput()) {
                case 'html':
                    echo htmlspecialchars($this->generateHtml());
                    
                    break;
                case 'javascript':
                    echo htmlspecialchars($this->generateJavascript());
                    break;
                case 'controller':
                    echo htmlspecialchars($this->generateController());
                    break;
                case 'model':
                    echo htmlspecialchars($this->generateModel());
                    break;
                default:
                    echo "Please Identify output type";
            }
        }
    }
   /**
    * Bring information column either it was foreign key or not
    * @param string $columnName
    * @return int 
    */
    private function getInfoTableColumn($columnName) {
        
        $sql = "
		SELECT	table_schema, 
			table_name, 
			column_name, 
			referenced_table_schema, 
			referenced_table_name, 
			referenced_column_name
		FROM 	information_schema.KEY_COLUMN_USAGE
		WHERE 	table_schema='" . $this->getTargetDatabase() . "'
		AND 	table_name = '" . $this->getTargetTable() . "'
		AND  	column_name ='" . $columnName . "'		";

        $resultForeignKey = mysql_query($sql) or die(mysql_error());
        $rowForeignKey = mysql_fetch_array($resultForeignKey);
        if ($rowForeignKey['referenced_table_schema'] != null && $rowForeignKey['referenced_table_name'] != null && $rowForeignKey ['referenced_column_name'] != null) {
            $foreignKey = 1;
        } else {
            $foreignKey = 0;
        }
        return $foreignKey;
    }

    /**
     * Generate html Content
     * @return string
     */
    private function generateHtml() {
        // initilize dumy value
        $str = null;
        $data = null;
        $data = $this->getInfoColumnArray();
        include ("html2.php");
        return $str;
    }

    /**
     * Generate Javascript Content
     * @return string 
     */
    private function generateJavascript() {
        // initilize dumy value
        $str = null;
        $data = null;
        $data = $this->getInfoColumnArray();
        include("javascript2.php");
        return $str;
    }

    /**
     * Generate Controller Content
     * @return string
     */
    private function generateController() {
        // initilize dumy value
        $str = null;
        $data = null;
        $data = $this->getInfoColumnArray();
        include("controller2.php");
        return $str;
    }

    /**
     * Generate Model Content
     * @return string 
     */
    private function generateModel() {
        // initilize dumy value
        $str = null;
        $data = null;
        $data = $this->getInfoColumnArray();
        include("model2.php");
        return $str;
    }

    /**
     * Return Target Database
     * return string $targetDatabase
     */
    public function getTargetDatabase() {
        return $this->targetDatabase;
    }

    /**
     * Set Target Database
     * param string $value
     */
    public function setTargetDatabase($value) {
        $this->targetDatabase = $value;
    }

    /**
     * Return Target Table
     * return string $targetTable
     */
    public function getTargetTable() {
        return $this->targetTable;
    }

    /**
     * Set Target Table
     * param string $value
     */
    public function setTargetTable($value) {
        $this->targetTable = $value;
    }

    /**
     * Return Target Grid Type
     * return string $targetTable
     */
    public function getTargetGridType() {
        return $this->targetGridType;
    }

    /**
     * Set Target Grid Type
     * param string $value
     */
    public function setTargetGridType($value) {
        $this->targetGridType = $value;
    }

    /**
     * Return Target Output
     * return string $output
     */
    public function getTargetOutput() {
        return $this->targetOutput;
    }

    /**
     * Set Target Output
     * param string $value
     */
    public function setTargetOutput($value) {
        $this->targetOutput = $value;
    }
     /**
     * Return Target Package
     * return string $output
     */
    public function getTargetPackage() {
        return $this->targetPackage;
    }

    /**
     * Set Target Package
     * param string $value
     */
    public function setTargetPackage($value) {
        $this->targetPackage = $value;
    }
     /**
     * Return Target Module
     * return string $output
     */
    public function getTargetModule() {
        return $this->targetModule;
    }

    /**
     * Set Target Module
     * param string $value
     */
    public function setTargetModule($value) {
        $this->targetModule = $value;
    }
    /**
     * Return Target Output
     * return string $output
     */
    public function getInfoColumnArray() {
        return $this->infoColumnArray;
    }

    /**
     * Set Target Output
     * param string $value
     */
    public function setInfoColumnArray($value) {
        $this->infoColumnArray = $value;
    }

}

$generator = new generator();

if (isset($_GET['targetDatabase']) && strlen($_GET['targetDatabase']) > 0) {
    $generator->setTargetDatabase($_GET['targetDatabase']);
}
if (isset($_GET['targetTable']) && strlen($_GET['targetTable']) > 0) {
    $generator->setTargetTable($_GET['targetTable']);
}
if (isset($_GET['targetGridType']) && strlen($_GET['targetGridType']) > 0) {
    $generator->setTargetGridType($_GET['targetDatabase']);
}
if (isset($_GET['targetOutput']) && strlen($_GET['targetOutput']) > 0) {
    $generator->setTargetOutput($_GET['targetOutput']);
}
if (isset($_GET['targetPackage']) && strlen($_GET['targetPackage']) > 0) {
    $generator->setTargetPackage($_GET['targetPackage']);
}
if (isset($_GET['targetModule']) && strlen($_GET['targetModule']) > 0) {
    $generator->setTargetModule($_GET['targetModule']);
}




?> 
<html>
    <head>
        <title>Core Generator Code</title>
              



        <!-- Le fav and touch icons -->
        <link rel="shortcut icon" href="../images/favicon.ico">

     <link href="../library/jquerytools/skin1.css" rel="stylesheet">
        <link href="../library/twitter2/docs/assets/css/bootstrap.css" rel="stylesheet">

    </head>
      <link rel="stylesheet" title="Default" href="styles/default.css">
  <link rel="alternate stylesheet" title="Dark" href="styles/dark.css">
  <link rel="alternate stylesheet" title="FAR" href="styles/far.css">
  <link rel="alternate stylesheet" title="IDEA" href="styles/idea.css">
  <link rel="alternate stylesheet" title="Sunburst" href="styles/sunburst.css">
  <link rel="alternate stylesheet" title="Zenburn" href="styles/zenburn.css">
  <link rel="alternate stylesheet" title="Visual Studio" href="styles/vs.css">
  <link rel="alternate stylesheet" title="Ascetic" href="styles/ascetic.css">
  <link rel="alternate stylesheet" title="Magula" href="styles/magula.css">
  <link rel="alternate stylesheet" title="GitHub" href="styles/github.css">
  <link rel="alternate stylesheet" title="Google Code" href="styles/googlecode.css">
  <link rel="alternate stylesheet" title="Brown Paper" href="styles/brown_paper.css">
  <link rel="alternate stylesheet" title="School Book" href="styles/school_book.css">
  <link rel="alternate stylesheet" title="IR Black" href="styles/ir_black.css">
  <link rel="alternate stylesheet" title="Solarized - Dark" href="styles/solarized_dark.css">
  <link rel="alternate stylesheet" title="Solarized - Light" href="styles/solarized_light.css">
  <link rel="alternate stylesheet" title="Arta" href="styles/arta.css">
  <link rel="alternate stylesheet" title="Monokai" href="styles/monokai.css">


  <style>
    body {
      font: small Arial, sans-serif;
    }
    h2 {
      font: bold 100% Arial, sans-serif;
      margin-top: 2em;
      margin-bottom: 0.5em;
    }
    table {
      width: 100%; padding: 0; border-collapse: collapse;
    }
    th {
      width: 12em;
      padding: 0; margin: 0;
    }
    td {
      padding-bottom: 1em;
    }
    td, th {
      vertical-align: top;
      text-align: left;
    }
    pre {
      margin: 0; font-size: medium;
    }
    #switch {
      overflow: auto; width: 57em;
      list-style: none;
      padding: 0; margin: 0;
    }
    #switch li {
      float: left; width: 10em;
      padding: 0.1em; margin: 0.1em 1em 0.1em 0;
      background: #EEE;
      cursor: pointer;
    }
    #switch li.current {
      background: #CCC;
      font-weight: bold;
    }
    .test {
      color: #888;
      font-weight: normal;
      margin: 2em 0 0 0;
    }
    .test var {
      font-style: normal;
    }
    .passed {
      color: green;
    }
    .failed {
      color: red;
    }
    .code {
      font: medium monospace;
    }
    .code .keyword {
      font-weight: bold;
    }
  </style>

  <script src="highlight.pack.js"></script>
  <script>
  hljs.tabReplace = '    ';
  hljs.initHighlightingOnLoad();
  </script>

  <script>
  // Stylesheet switcher © Vladimir Epifanov <voldmar@voldmar.ru>
  (function(container_id) {
      if (window.addEventListener) {
          var attach = function(el, ev, handler) {
              el.addEventListener(ev, handler, false);
          }
      } else if (window.attachEvent) {
          var attach = function(el, ev, handler) {
              el.attachEvent('on' + ev, handler);
          }
      } else {
          var attach = function(el, ev, handler) {
              ev['on' + ev] = handler;
          }
      }


      attach(window, 'load', function() {
          var current = null;

          var info = {};
          var links = document.getElementsByTagName('link');
          var ul = document.createElement('ul')

          for (var i = 0; (link = links[i]); i++) {
              if (link.getAttribute('rel').indexOf('style') != -1
                  && link.title) {

                  var title = link.title;

                  info[title] = {
                  'link': link,
                  'li': document.createElement('li')
                  }

                  ul.appendChild(info[title].li)
                  info[title].li.title = title;

                  info[title].link.disabled = true;

                  info[title].li.appendChild(document.createTextNode(title));
                  attach(info[title].li, 'click', (function (el) {
                      return function() {
                          current.li.className = '';
                          current.link.disabled = true;
                          current = el;
                          current.li.className = 'current';
                          current.link.disabled = false;
                      }})(info[title]));
              }
          }

          current = info['Default']
          current.li.className = 'current';
          current.link.disabled = false;

          ul.id = 'switch';
          container = document.getElementById(container_id);
          container.appendChild(ul);
      });

  })('styleswitcher');
  </script>
 
 
    <body>
        <div class="container"><br>
            <div class="alert alert-info">
                I Core generator Code Welcome.
            </div>
            <br><div class="well">
                <h2>Filtering Form</h2>
                <?php $generator->htmlForm(); ?></div>
            <br>
            <div id="styleswitcher">
  <h2>Styles</h2>
</div>
            
            <br>
            <div class="php">
            <pre class="php"><code>
                <?php $generator->execute(); ?>
</code>
            </pre></div>
                
            <footer>
                <p>© IDCMS 2012</p>
            </footer>
            <!-- Le javascript
      ================================================== -->
            <!-- Placed at the end of the document so the pages load faster -->
            <script src="../library/jquery/jquery-1.7.1.js"></script>
    


            <script src="../library/global.js"></script>
            <script src="../library/twitter2/js/bootstrap-alert.js"></script>
            <script src="../library/twitter2/js/bootstrap-button.js"></script>
            <script src="../library/twitter2/js/bootstrap-carousel.js"></script>
            <script src="../library/twitter2/js/bootstrap-collapse.js"></script>
            <script src="../library/twitter2/js/bootstrap-dropdown.js"></script>
            <script src="../library/twitter2/js/bootstrap-modal.js"></script>
            <script src="../library/twitter2/js/bootstrap-scrollspy.js"></script>
            <script src="../library/twitter2/js/bootstrap-tab.js"></script>
            <script src="../library/twitter2/js/bootstrap-tooltip.js"></script>
            <script src="../library/twitter2/js/bootstrap-transition.js"></script>
            <script src="../library/twitter2/js/bootstrap-typeahead.js"></script>
            <script src="../library/jquerytools/jquery.tools.min.js"></script>
   
        </div>
    </body>    
</html>    