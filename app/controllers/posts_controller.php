<?php /**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.mohamedelsayed.net/
 * @copyright Copyright (c) 2015 Programming by "mohamedelsayed.net"
 */
require_once '../authfront_controller.php';
class PostsController extends AuthfrontController {
	var $name = 'Posts';
	var $uses = array('Post');
	//var $components = array('Upload');
	function index() {
		$this->Post->recursive = 0;
		if($this->isSuperAdmin() || $this->isAdmin()){
			if(isset($this->data['Post']['title'])){
				$this->paginate = array(
				'conditions' => array('Post.title LIKE' => "%".$this->data['Post']['title']."%"),
	    		);
			}
			$this->set('posts', $this->paginate());
		}else{
			$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
			$this->redirect(array('controller' => 'forum', 'action' => 'index'));	
		}
	}
	function view($id = null) {
		$limit = $this->pagingLimit;
		$isAdmin = 0;
		if($this->isSuperAdmin() || $this->isAdmin()){
			$isAdmin = 1;
		}
		$this->set('isAdmin', $isAdmin);	
		if (!$id) {
			$this->Session->setFlash(__('Invalid Post', true));
			$this->redirect(array('action' => 'index'));
		}
		$post = $this->Post->read(null, $id);
		$this->set('post', $post);
		if(!($post['Post']['approved'] == 1 || $isAdmin == 1)){
			$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
			$this->redirect(array('controller' => 'forum', 'action' => 'index'));	
		}
		$this->Post->ForumComment->recursive = -1;		
    	$this->paginate = array(
    		'ForumComment'=>array(
	    		'conditions' => array('ForumComment.post_id' => $post['Post']['id'], 'ForumComment.approved' => 1),
				'order'      => array('ForumComment.created'=>'DESC','ForumComment.id'=>'DESC'),
		    	'limit'      => $limit
    		)
    	);
		$this->set(
			array(
				'comments'		   => $this->paginate('ForumComment'),
				'limit'			   => $limit
			)
		);	
	}
	function add() {
		$isAdmin = 0;
		if($this->isSuperAdmin() || $this->isAdmin()){
			$isAdmin = 1;
		}
		$this->set('isAdmin', $isAdmin);			
		if (!empty($this->data)) {
			$this->Post->create();
			if($this->data['Post']['category_id'] == null){
				$this->data['Post']['category_id'] = 0;				
			}
			if ($this->Post->save($this->data)) {
				$this->send_email_notification($this->Post->id, 0, $this->data['Post']['title'], 0);
				$this->Session->setFlash(__('The Post has been saved', true));
				if($isAdmin == 1){
					$this->redirect(array('action' => 'index'));
				}else{
					$this->redirect(array('action' => 'all'));					
				}
			} else {
				$this->Session->setFlash(__('The Post could not be saved. Please, try again.', true));
			}
		}
		$categories = $this->Post->Category->find('list');
		$this->set(compact('categories'));
	}
	function edit($id = null) {
		$isAdmin = 0;
		if($this->isSuperAdmin() || $this->isAdmin()){
			$isAdmin = 1;
		}
		$this->set('isAdmin', $isAdmin);		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Post', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$this->Post->id = $id;
			if ($this->Post->save($this->data)) {
				$this->Session->setFlash(__('The Post has been saved', true));
				if($isAdmin == 1){
					$this->redirect(array('action' => 'index'));
				}else{
					$this->redirect(array('action' => 'all'));					
				}
			} else {
				$this->Session->setFlash(__('The Post could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Post->read(null, $id);
			if(!($this->isSuperAdmin() || $this->isAdmin())){
				if($this->data['Post']['member_id'] != $this->Cookie->read('userInfoFront.id')){
					$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
					$this->redirect(array('controller' => 'forum', 'action' => 'index'));	
				}					
			}
		}
		$categories = $this->Post->Category->find('list');
		$this->set(compact('categories'));
	}
	function delete($id = null) {
		if($this->isSuperAdmin() || $this->isAdmin()){
			if (!$id) {
				$this->Session->setFlash(__('Invalid id for Post', true));
				$this->redirect(array('action'=>'index'));
			}
			$this->Post->id = $id;
			$this->Upload->filesToDelete = array($this->Post->field('image'), $this->Post->field('video'), $this->Post->field('attachement'));		
			if ($this->Post->delete($id)) {
				$this->Upload->deleteFile();
				$this->Session->setFlash(__('Post deleted', true));
				$this->redirect(array('action'=>'index'));
			}
			$this->Session->setFlash(__('Post was not deleted', true));
			$this->redirect(array('action' => 'index'));
		}else{
			$this->Session->setFlash(__($this->you_are_not_authorized, true), true);
			$this->redirect(array('controller' => 'forum', 'action' => 'index'));	
		}
	}
	function all(){
		$limit = $this->pagingLimit;
		$page = isset($this->params['named']['page'])?$this->params['named']['page']:$this->paginate['page'];	
		$conditions = array('Post.approved' => 1);					
		$this->paginate['Post'] = array(
    			//'fields'     => array('Post.id', 'Post.title', 'Post.body'),
    			'conditions' => $conditions,
				'order'      => array('Post.updated' => 'DESC','Post.id'=>'DESC'),
		    	'limit'      => $limit,
		    	'page'  	 => $page
	    	);
		$this->set('page',$page);
		$this->set('posts', $this->paginate('Post'));		
	}
	function addComment(){
		$this->Post->ForumComment->create();
		if ($this->Post->ForumComment->save($this->data)) {			
			//echo __('Your comment has been added successfully, and will be viewed soon after approving.', true);
			//echo __('Your comment has been added successfully.', true);
			$comment = $this->Post->ForumComment->read(null, $this->Post->ForumComment->id);
			$this->send_email_notification($this->Post->ForumComment->id, 2, '', $comment['ForumComment']['post_id']);				
			$data['html'] = $this->draw_comment($comment);
			$data['status'] = 'success';
			echo json_encode($data);
		} else {
			$html = 'Your comment could not be added.';
			$html .= '<br />';
			foreach($this->Post->ForumComment->validationErrors as $key=>$val){
				$html .= $val.',<br />';
			}
			$html .= 'and try again.';
			$data['html'] = $html;
			$data['status'] = 'error';
			echo json_encode($data);
		}
		$this->autoRender = false;
	}
	function list_comments(){
		$page = $_POST['page'];
		$limit = $_POST['limit'];
		$postid = $_POST['postid'];
		//$this->Post->ForumComment->recursive = -1;		
    	$this->paginate = array(
    		'ForumComment'=>array(
	    		'conditions' => array('ForumComment.post_id' => $postid, 'ForumComment.approved' => 1),
				'order'      => array('ForumComment.created'=>'DESC','ForumComment.id'=>'DESC'),
		    	'limit'      => $limit,
		    	'page'  	 => $page
    		)
    	);
		$comments = $this->paginate('ForumComment');
		$data = '';
		if(!empty($comments)){
			foreach($comments as $comment){
				$data .= $this->draw_comment($comment);
			}
		}	
		echo $data;		
		$this->autoRender = false;			
	}
	function draw_comment($comment){
		$comment_li = '';
		if(!empty($comment)){
			$view = new View($this, false);
			$img_src = BASE_URL.DS.'img'.DS.'forum'.DS.'default_user_thumbnail.png';
			$comment_body = preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i", "<div class=\"lcevideo\"><iframe width=\"300\" height=\"250\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe></div>", $comment['ForumComment']['comment']);
			$comment_body = nl2br($comment_body);
			$comment_body = str_replace('<br/>', ' <br/> ', $comment_body);
			$comment_body =  preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a href="$1" target="_blank">$1</a>', $comment_body);
			if($comment['Member']['image'] != ''){
				$img_src = BASE_URL.DS.'img'.DS.'upload'.DS.$comment['Member']['image'];
			}
			$comment_li .= '<li class="comment">
							<div class="commentauthor">
								<div class="comment_author_image">
									<img src="'.$img_src.'" alt="'.$comment['Member']['fullname'].'"/>
								</div>
								<div class="commentauthordata">
									<div class="commentauthorname"><a href="'.BASE_URL.'/members/view/'.$comment['Member']['id'].'">'.$comment['Member']['fullname'].'</a></div>
									<div class="commentauthorblock">'.$view->element('forum/block_member', array('other_member_id' => $comment['Member']['id'], 'other_member_fullname' => $comment['Member']['fullname'])).'</div>
								</div>
							</div>';							
			$comment_li .= '<div class="commentotheritem"><div class="com_date">'.date('F d, Y, g:i a', strtotime($comment['ForumComment']['created'])).'</div>
					<div class="com_body">'.$comment_body.'</div>';
			$comment['ForumComment']['image'] = trim($comment['ForumComment']['image']);
			if($comment['ForumComment']['image'] != ''){
				$comment_li .= '<div class="comment_image_new">
						<img src="'.BASE_URL.'/img/upload/'.$comment['ForumComment']['image'].'" alt=""/>
						</div>';
			}
			if($comment['ForumComment']['video'] != ''){
				
				$comment_li .= $view->element('forum/video_player_view', array('video' => $comment['ForumComment']['video'], 'width'=>300, 'height'=>250));
			}
			if($comment['ForumComment']['attachement'] != ''){
				$file_name_exploded = explode('.', $comment['ForumComment']['attachement']);
		        $file_ext = $file_name_exploded[count($file_name_exploded) - 1];
		        $file_link = BASE_URL.DS.'files'.DS.'upload'.DS.$comment['ForumComment']['attachement'];
		        $comment_li .= '<div class="'.$file_ext . '-file'.'">
		        		<a target="_blank" href="'.$file_link.'">'.$comment['ForumComment']['attachement'].'</a>
		        		</div>';
			}
			$comment_li .= $view->element('forum/agreements', array('item_id' => $comment['ForumComment']['id'], 'item_type' => 1));
			$comment_li .= '</div></li>';
		}
		return $comment_li;
	}
	function list_posts(){
		$page = $_POST['page'];
		$limit = $_POST['limit'];
		$title = trim($_POST['title']);
		$category_id = $_POST['category_id'];
		//$this->Post->recursive = -1;
		$conditions = array();
		$conditions['Post.approved'] = 1;
		if($category_id != 0){
			$conditions['Post.category_id'] = $category_id;			
		}
		if($title != ''){
			$conditions['Post.title LIKE '] = '%'.$title.'%';			
		}
    	$this->paginate = array(
    		'Post'=>array(
	    		'conditions' => $conditions,
				'order'      => array('Post.created'=>'DESC','Post.id'=>'DESC'),
		    	'limit'      => $limit,
		    	'page'  	 => $page
    		)
    	);
		$posts = $this->paginate('Post');
		$count = $this->Post->find('count', array(
	    		'conditions' => $conditions,
    		)
    	);
		$page_count = ceil($count / $limit);	
		$data = '';
		if(!empty($posts)){
			$i = 0;
			foreach($posts as $post){
				$class = null;
				if ($i++ % 2 == 0) {
					$class = 'altrow';
				}
				$data .= $this->draw_post($post, $class);
			}
		}
		$data .= '<script type="text/javascript">
					$(document).ready(function() {
						jQuery(\'#loadmorepost\').attr("pagecount", "'.$page_count.'");
					});
				</script>';	
		echo $data;		
		$this->autoRender = false;			
	}
	function draw_post($post, $class){
		$post_li = '';
		if(!empty($post)){
			$post_id = $post['Post']['id'];
			$last_comment_date = $this->get_post_last_comment_date($post_id);
			$last_comment_date_text = '';
			if(isset($last_comment_date['ForumComment']['created'])){
				//$last_comment_date_text = 'Last comment at ';
				$last_comment_date_text = date('M d, Y, g:i a', strtotime($last_comment_date['ForumComment']['created']));				
			}
			$post_link = BASE_URL.'/posts/view/'.$post_id;
			$post_li .= '<li class="post '.$class.'">';
			$post_li .= '<div class="post_title"><a href="'.$post_link.'">'.$post['Post']['title'].'</a></div>
						<div class="post_category">'.$post['Category']['title'].'</div>
						<div class="post_date">'.date('M d, Y, g:i a', strtotime($post['Post']['created'])).'</div>
						<div class="post_author">'.$post['Member']['fullname'].'</div>
						<div class="post_last_comment_date">'.$last_comment_date_text.'</div>';
			$post_li .= '</li>';
		}
		return $post_li;
	}
	function get_post_last_comment_date($post_id = 0){
		$comment = array();
		if($post_id != 0){
			$this->loadModel('ForumComment');		
			$comment = $this->ForumComment->find(
					'first', array(
						'conditions' => array('ForumComment.post_id' => $post_id, 'ForumComment.approved' => 1),
						'order'      => array('ForumComment.created'=>'DESC','ForumComment.id'=>'DESC'),
					)	  	 	
				);
		}
		return $comment;		
	}
}