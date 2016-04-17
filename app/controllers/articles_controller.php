<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2014 Programming by "mohamedelsayed.net"
 */
require_once '../auth_controller.php';
class ArticlesController extends AuthController {

	var $name = 'Articles';
	var $uses = array('Article');
	//use upload component
	var $components = array('Upload');
	var $tags_label = "Tags <span style='color:red'>Use comma , as a seperator</span>";
	var $image_label = "Image <span style='color:red'>It must be at least width 618px.</span>";

	function index() {
		$this->Article->recursive = 0;
		$this->paginate = array(
			//'conditions' => array($conditions),
			'order' => array('Article.date'=> 'DESC', 'Article.id' => 'DESC'),
    	);
		$this->set('articles', $this->paginate());		
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid article', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('article', $this->Article->read(null, $id));
	}

	function add() {
			
		if (!empty($this->data)) {
			//upload image and then add it to Gal.
			$this->data['Gal'][0]['image']=$this->Upload->uploadImage($this->data['Gal'][0]['image']);
			if($this->data['Gal'][0]['image']=='')unset($this->data['Gal']);
			
			//upload image and video file then add them to Videos.
			//$this->data['Video'][0]['image']=$this->Upload->uploadImage($this->data['Video'][0]['image']);
			//$this->Upload->fileTypes = 'flv';//set file types.
			//$this->data['Video'][0]['file']=$this->Upload->uploadFile($this->data['Video'][0]['file']);
			///if($this->data['Video'][0]['file']=='' && $this->data['Video'][0]['url']=='')unset($this->data['Video']);
			
			//save data
			$this->Article->create();
			if ($this->Article->saveAll($this->data, array('validate'=>'first'))) {
				//Add routes
				//$this->Article->Subject->id = $this->data['Article']['subject_id'];
				//$this->addRoutes($this->createRoutes($this->Article->id, Inflector::slug(strtolower($this->data['Article']['title']), '-'), Inflector::slug(strtolower($this->Article->Subject->field('title')), '-')));
				$this->Session->setFlash(__('The article has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The article could not be saved. Please, try again.', true));
			}
		}
		//$subjects = $this->Article->Subject->find('list');
		//$this->set(compact('subjects'));
		$this->set('tags_label',$this->tags_label);
		$this->set('image_label',$this->image_label);
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid article', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			//upload image and then add it to Gal.
			$this->data['Gal'][0]['image']=$this->Upload->uploadImage($this->data['Gal'][0]['image']);
			if($this->data['Gal'][0]['image']=='')unset($this->data['Gal']);
			
			//upload image and video file then add them to Videos.
			/*$this->data['Video'][0]['image']=$this->Upload->uploadImage($this->data['Video'][0]['image']);
			$this->Upload->fileTypes = 'flv';//set file types.
			$this->data['Video'][0]['file']=$this->Upload->uploadFile($this->data['Video'][0]['file']);
			if($this->data['Video'][0]['file']=='' && $this->data['Video'][0]['url']=='')unset($this->data['Video']);*/
			
			//save data
			if ($this->Article->saveAll($this->data, array('validate' => 'first'))) {
				//Add routes
				//$this->Article->Subject->id = $this->data['Article']['subject_id'];
				//$this->addRoutes($this->createRoutes($this->Article->id, Inflector::slug(strtolower($this->data['Article']['title']), '-'), Inflector::slug(strtolower($this->Article->Subject->field('title')), '-')));
				$this->Session->setFlash(__('The article has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The article could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Article->read(null, $id);
		}
		//$subjects = $this->Article->Subject->find('list');
		//$this->set(compact('subjects'));
		$this->set('tags_label',$this->tags_label);
		$this->set('image_label',$this->image_label);
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for article', true));
			$this->redirect(array('action'=>'index'));
		}
		//set id.
		$this->Article->id = $id;
		
		//set the component var filesToDelete with an array of files should be deleted.
		$relatedImgs    = $this->Article->Gal->find('list', array('fields'=>'Gal.image' ,'conditions' => array('article_id' => $id)));
		//$relatedVids    = $this->Article->Video->find('list', array('fields'=>'Video.file' ,'conditions' => array('article_id' => $id)));
		//$relatedThumb   = $this->Article->Video->find('list', array('fields'=>'Video.image' ,'conditions' => array('article_id' => $id)));					  	 					   
		$this->Upload->filesToDelete = array_merge($relatedImgs);
		
		//delete
		if ($this->Article->delete($id)) {
			$this->Upload->deleteFile(); //delete old files.
			$this->Session->setFlash(__('Article deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Article was not deleted', true));
		$this->redirect(array('action'=>'index'));
	}
	/*private function createRoutes($id=null, $title=null, $subject=null){
    	if($id && $title && $subject)
			return "<?php Router::connect('/tips-ideas/$subject/$title', array('controller' => 'news', 'action' => 'details', '$id'));?>\n";
    	return null;
    }*/
    function autoComplete($filedName) {
    	$this->Article->recursive = -1;
	    $this->set('articles', $this->Article->find('all', array(
	    	'conditions' => array(
	    		"Article.$filedName LIKE" => '%'
	    	),
	    	'fields' => 'DISTINCT '.$filedName
	    )));
		$all_tags = array();
		$this->loadModel('Article');
		$articles = $this->Article->find(
			'all', array(
				'fields'     => array('Article.id', 'Article.tags'),
				'conditions' => array('Article.approved' => 1),
				'order' => array('Article.date' => 'DESC','Article.id'=>'DESC')
			)	  	 	
		);
		foreach ($articles as $key => $article) {
			$tags = explode(",", $article['Article']['tags']);
			foreach ($tags as $key => $tag) {
				$tag = trim($tag);
				if(!in_array($tag, $all_tags)){
					$all_tags[] = $tag;
				}
			}		
		}	
		$this->set('all_tags',$all_tags);	
	    //$this->set('filedName', $filedName);
	    $this->layout = 'ajax';
    }
}
?>