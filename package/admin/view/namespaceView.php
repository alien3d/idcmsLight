<?php
namespace Core\Basic\View\;
require_once("core.php");
use \Core;
class ReligionSample  extends \Core\BasicView {
        public $model;
	function indexView($model) {
		echo "<html>";
                echo "<head>";
                /*
                 *  All CSS must put in the header
                 */
                $this->bootstrapCSS();
                echo "</head>";
                echo "<body> <div class=\"container\">";
                echo "Bootstrap + php namespace.. jab  adodb.
                    <span class=\"label success\">New</span><br>";
                $this->model= $model;
                $this->model->r();
                echo "  </div></body>";
                /*
                 *  All javascript include add at below
                 */
                $this->bootstrapJS();
                echo"    </html>";
                
        }
}
class ReligionSampleDetail extends \Core\BasicView {
        public $model;
	function indexView($model) {
		$this->model= $model;
                $this->model->r();
                
	}
}
?>