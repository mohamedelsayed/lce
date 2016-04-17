<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.lifecoachingegypt.com
 * @copyright Copyright (c) 2015 Programming by "mohamedelsayed.net"
 */
class MainController  extends AppController {
	var $name = null;
	var $uses = null;		
	function getContent($id) {
		$this->loadModel('Content');
		return $this->Content->read(null, $id);
	}
	function getContents() {
		$this->loadModel('Content');
		return $this->Content->find('all', array('order'=>array('id'=>'ASC')));
	}	
	//Update video hits used by ajax
	function updateVideoHits($videoId=null){
		//increase video hits filed
		if($videoId){
			$this->loadModel('Video');
			$this->Video->updateAll(array('Video.hits'=>'Video.hits+1'), array('Video.id'=>$videoId));
		}
		$this->autoRender = false;
	}	
	//Update Audio hits used by ajax
	function updateAudioHits($audioId=null){
		//increase video hits filed
		if($audioId){
			$this->loadModel('Audio');
			$this->Audio->updateAll(array('Audio.hits'=>'Audio.hits+1'), array('Audio.id'=>$audioId));
		}
		$this->autoRender = false;
	}	
	//get field
	function getField($model=null, $filed=null, $id=null, $conditions=null){
		$this->loadModel($model);
		if($id)
			$this->$model->id = $id;
		elseif($conditions)
			$conditions = array($conditions);	
		return $this->$model->field($filed, $conditions);
	}	
	//Get album
	function getAlbum(){
		$this->loadModel('Album');		
		//get home album
	    $this->Album->recursive = 1;
	    return $this->Album->find(
			'first', 
			array(
				'fields'     => array('Album.id'),
				'order'=>array('Album.id'=>'DESC')
	  	 	)
	  	);
	}
	//Get Faqs
	function getFaqs(){
		$this->loadModel('Faq');		
		//get home album
	    $this->Faq->recursive = 1;
	    return $this->Faq->find(
			'all', 
			array(
				//'fields'     => array('Faq.id'),
				'order'=>array('Faq.id'=>'DESC'),
				'limit'=> 6
	  	 	)
	  	);
	}
}