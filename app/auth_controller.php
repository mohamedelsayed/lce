<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.karimfrancis.com/
 * @copyright Copyright (c) 2014 Programming by "mohamedelsayed.net"
 */
class AuthController extends AppController{
	
	//var $uses = null;	
	var $helpers = array('Html', 'Form', 'Javascript', 'Fck', 'Ajax', 'Session', 'XmlExcel','Farbtastic');
	
	//Check Authentication.
	protected function isAuthentic(){
		if($this->Session->check('userInfo')){
			//check if data in session (userInfo) existing in database.
			if($this->inDataBase()){
				//write settings in session and return
				if(!$this->Session->check('Setting'))
					$this->setSettings();
				return true;
			}else{
				$this->Session->destroy();
				return false;
			}
		}else
			return false;
	}
		
	//Check that session user in database.
	protected function inDataBase (){
		$this->loadModel('User');
		$this->User->recursive = -1;
		return $this->User->find('count', 
							  	  array('conditions' =>
								   	   array('username' => $this->Session->read('userInfo.User.username'),
								   	 	     'password' => $this->Session->read('userInfo.User.password'))));
	}
		
	//Add routes to routes.php file
	protected function addRoutes($newRoutes=null){
    	if(!$newRoutes)
    		return;
		$file = APP.'/config/routes.php';
		$backupFile = APP.'/config/routesBackup.php';
    	$currentRoutes = file_get_contents($file);//Get current routes
    	file_put_contents($backupFile, $currentRoutes);//Save backup
    	file_put_contents($file, $newRoutes.$currentRoutes);//Add new routes (in front)
		return;
    }
    
	//Export xml file for selectd model.
    function export($modelName = null, $conditions = array()) {
        $this->$modelName->recursive = -1;
        $data = $this->$modelName->find('all', array('conditions'=>$conditions));
        App::import('Helper', 'XmlExcel');
        $xmlExcel = new XmlExcelHelper();
        $xmlExcel->generate($data, $modelName);
        $this->autoRender = false;
        $this->layout = 'ajax';
	}
	 
	function beforeFilter(){
		// Check Authentication 
		if(!$this->isAuthentic() && ($this->action != 'login') && ($this->action != 'forgot')){
			$this->Session->setFlash(__('UnAuthorized access attempt! Please Login first.', true),true);
			$this->redirect(array('controller' => 'me-admin', 'action' => 'login'));
			//$this->redirect(array('controller' => 'news', 'action' => 'display', 'home'));
		}
		//$titleLabel = "Title (to make it on two line use ". htmlentities("<br />")." ) ";
		$titleLabel = "Title";
		$this->set("titleLabel",$titleLabel);
		$this->loadModel('Setting');
		$settings = $this->Setting->read(null, 1);
		$this->set("minYearValue",$settings['Setting']['minimum_year']);
		$this->set("maxYearValue",$settings['Setting']['maximum_year']);
		$this->set('settings', $settings['Setting']);
		$this->setAllArticlesTags();
	}
	
	function beforeRender(){
		// To view the content in another layout instead of the default layout :
		if($this->layout != 'ajax')
			$this->layout = 'backend/main';
	}
}