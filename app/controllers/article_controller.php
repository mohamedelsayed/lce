<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2014 Programming by "mohamedelsayed.net"
 */
class ArticleController  extends AppController {
	var $name = 'Article';
	var $uses = array('Article');
	function index(){
		$this->redirect($this->referer(BASE_URL));			
	}
	function all($tag = ''){
		$limit = $this->getPagingLimit();
		$page = isset($this->params['named']['page'])?$this->params['named']['page']:$this->paginate['page'];	
		if($tag != ''){
			$conditions = array('Article.approved' => 1, 'Article.tags LIKE' => "%".$tag."%");			
		}else{
			$conditions = array('Article.approved' => 1);
		}					
		$this->paginate['Article'] = array(
    			//'fields'     => array('Article.id', 'Article.title', 'Article.body'),
    			'conditions' => $conditions,
				'order'      => array('Article.date' => 'DESC','Article.id'=>'DESC'),
		    	'limit'      => $limit,
		    	'page'  	 => $page
	    	);
		$this->set('page',$page);
		$this->set('articles', $this->paginate('Article'));
		$this->set('selected','blog');
		$this->set('title_for_layout' , 'Blog');			
	}
	function item($id = ''){
		$limit = $this->getCommentPagingLimit();
		$this->set('commentLimit',$limit);
		$this->Article->updateAll(array('Article.hits'=>'Article.hits+1'), array('Article.id'=>$id));
		$this->loadModel('Article');
		$article = $this->Article->find(
			'first', array(
				'conditions' => array('Article.approved' => 1, 'Article.id' => $id),
			)	  	 	
		);
		$this->set('article',$article);
		$this->set('selected','blog');
		$this->set('title_for_layout' , $article['Article']['title']);	
		//get article comments
    	/*$this->Article->Comment->recursive = -1;
    	$this->paginate = array(
    		'Comment'=>array(
	    		'conditions' => array('Comment.article_id' => $article['Article']['id'], 'Comment.approved' => 1),
				'order'      => array('Comment.created'=>'DESC'),
		    	'limit'      => $limit
    		)
    	);*/	
		if(isset($article['Gal'][0]['image'])){
			$this->set('shareImage',$article['Gal'][0]['image']);
		}	    	
    	// Set data to view
		$this->set(
			array(
				//'comments'		   => $this->paginate('Comment'),
				'metaKeywords'     => $article['Article']['meta_keywords'],
				'metaDescription'  => $article['Article']['meta_description'],
			)
		);	
	}
	//add comment used by ajax
	function addComment(){
		$this->Article->Comment->create();
		if ($this->Article->Comment->save($this->data)) {
			echo __('Your comment has been added successfully, and will be viewed soon after approving.', true);
		} else {
			echo __('Your comment could not be added.', true);
			echo '<br />';
			foreach($this->Article->Comment->validationErrors as $key=>$val){
				echo $val.',<br />';
			}
			echo 'and try again.';
		}
		$this->autoRender = false;
	}
}
?>