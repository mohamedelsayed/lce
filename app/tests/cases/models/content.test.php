<?php
/* Content Test cases generated on: 2011-01-26 19:01:55 : 1296061915*/
App::import('Model', 'Content');

class ContentTestCase extends CakeTestCase {
	var $fixtures = array('app.content');

	function startTest() {
		$this->Content =& ClassRegistry::init('Content');
	}

	function endTest() {
		unset($this->Content);
		ClassRegistry::flush();
	}

}
?>