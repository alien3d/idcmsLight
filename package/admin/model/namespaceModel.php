<?php
/*
 *  00900
 *  SLG - Penyelenggaran
 */
namespace core\Model\SLG;
require_once("default.php");
use \core;
class admin  extends \core\basicModel {
	/*
         * Insert,Create Record statement
         */
        function c() {
	
	}
        /*
         * Read Statement
         */
	function r() {
		echo "im from R admin ";
	}
        /*
         *  Update Statement
         */
	function u() {
		echo "im from U admin ";
	}
        /*
         *  Delete Statement
         */
	function d() {
		echo "im from D admin ";
	}
}
class email extends \core\basicModel  {
	/*
         * Create Statement
         */
        function c() {
		echo "im from c	email ";
	}
        /*
         * Read Statement
         */
	function r() {
		echo "im from R email ";
	}
        /*
         * Update Statement
         */
	function u() {
		echo "im from U email ";
	}
        /*
         *  Delete Statement
         */
	function d() {
		echo "im from D email ";
	}
}
?>