<?php /**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.mohamedelsayed.net/
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
require_once '../authfront_controller.php';
class LibrariesController extends AuthfrontController {
	var $name = 'Libraries';
	var $uses = array('Library');
	//use upload component.
	var $components = array('Upload');
	function index() {		
		$type1 = isset($this->params['named']['type1'])?$this->params['named']['type1']:0;	
		$this->set('type1', $type1);
		$this->check_isAdmin_isSuperAdmin();
		$this->Library->recursive = 0;
		$order = array('Library.updated' => 'DESC', 'Library.created' => 'DESC', 'Library.id' => 'DESC');		
		$this->paginate = array(
			'conditions' => array('Library.type1' => $type1),
			'order' => $order,
    	);
		$this->set('libraries', $this->paginate());
		$this->set('title_for_layout' , 'Libraries');			
	}
	function view($id = null) {
		$this->check_isAdmin_isSuperAdmin();
		if (!$id) {
			$this->Session->setFlash(__('Invalid Library', true));
			$this->redirect(array('action' => 'index'));
		}
		$library = $this->Library->read(null, $id);
		$this->set('library', $library);	
		$type1 = $library['Library']['type1'];
		$this->set('type1', $type1);	
		$files_div = '';
		if($library['Library']['file'] != ''){
			$files_div .= $this->draw_file_box($id, $library['Library']['file'], 0);
        }
        $this->set('files_div', $files_div);
	}
	function add() {		
		$type1 = isset($this->params['named']['type1'])?$this->params['named']['type1']:0;
		$this->set('type1', $type1);
		$this->check_isAdmin_isSuperAdmin();
		if (!empty($this->data)) {
			$fileTypes = $this->get_library_allowed_file_types($type1);			
			$this->Upload->fileTypes = $fileTypes;
			$this->data['Library']['file'] = $this->Upload->uploadFile($this->data['Library']['file']);
			//upload image
			//$this->data['Library']['image']=$this->Upload->uploadImage($this->data['Library']['image']);
			$this->Library->create();
			/*if($this->data['Library']['parent_id'] == null){
				$this->data['Library']['parent_id'] = 0;				
			}*/
			if ($this->Library->saveAll($this->data)) {
				$this->Session->setFlash(__('The Library has been saved', true));
				$this->redirect(array('action' => 'index/type1:'.$this->data['Library']['type1']));
			} else {
				$this->Session->setFlash(__('The Library could not be saved. Please, try again.', true));
			}
		}
		//$artists = $this->Library->Artist->find('list');
		//$parents = $this->Library->ParentLibrary->find('list');
		//$this->set(compact('parents'));
	}
	function edit($id = null) {
		$library = $this->Library->read(null, $id);
		$type1 = $library['Library']['type1'];
		$this->check_isAdmin_isSuperAdmin();
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Library', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$this->Library->id = $id;
			$fileTypes = $this->get_library_allowed_file_types($type1);			
			$this->Upload->fileTypes = $fileTypes;
			if($this->data['Library']['file']['name']){
				$this->data['Library']['file'] = $this->Upload->uploadFile($this->data['Library']['file']);
			}else{
				unset($this->data['Library']['file']);				
			}
			/*if($this->data['Library']['image']['name']){
				$this->Upload->filesToDelete = array($this->Library->field('image'));
				$this->data['Library']['image']=$this->Upload->uploadImage($this->data['Library']['image']);
			}else
				unset($this->data['Library']['image']);*/
			if ($this->Library->saveAll($this->data)) {
				$this->Session->setFlash(__('The Library has been saved', true));
				$this->redirect(array('action' => 'index/type1:'.$this->data['Library']['type1']));
			} else {
				$this->Session->setFlash(__('The Library could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $library;			
		}		
		$this->set('type1', $type1);
		$files_div = '';
		if($library['Library']['file'] != ''){
			$files_div .= $this->draw_file_box($id, $library['Library']['file'], 1);
        }
        $this->set('files_div', $files_div);
	}
	function delete($id = null) {
		$this->check_isAdmin_isSuperAdmin();
		/*$forbidden_ids = array(1,2,3);
		if(in_array($id, $forbidden_ids)){
			$this->Session->setFlash(__('You cannot delete this Libraryegory!', true));
			$this->redirect(array('action'=>'index'));
		}*/
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Library', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->data = $this->Library->read(null, $id);
		if ($this->Library->delete($id)) {
			$this->Session->setFlash(__('Library deleted', true));
			$this->redirect(array('action'=> 'index/type1:'.$this->data['Library']['type1']));
		}
		$this->Session->setFlash(__('Library was not deleted', true));
		$this->redirect(array('action' => 'index'));		
	}
	function admin_all(){
		$this->check_isAdmin_isSuperAdmin();
	}
	function get_library_allowed_file_types($type1 = 0){
		$fileTypes = 'zip,rar,pdf,doc,docx,flv,mp3,xls,xlsx,ppt,pptx,jpeg,jpg,gif,png,mp4';
		if($type1 == 0){
			$fileTypes = 'pdf,doc,docx,mp3,xls,xlsx,ppt,pptx,jpeg,jpg,png,mp4';
		}elseif($type1 == 1){
			$fileTypes = 'pdf,doc,docx,xls,xlsx,ppt,pptx';
		}elseif($type1 == 2){
			$fileTypes = 'mp4';
		}elseif($type1 == 3){
			$fileTypes = 'jpeg,jpg,png';
		}elseif($type1 == 4){
			$fileTypes = 'pdf,mp4';
		}
		return $fileTypes;		
	}
	public function draw_file_box($id = 0, $path = '', $delete = 1){
		$path_exploded = explode('.', $path);
		$file_ext = end($path_exploded);
		$path_exploded2 = explode('/', $path);
		$filename = end($path_exploded2);
		$removebtn = '<div data-file-id="{{file_id}}"  class="removeuploadfilebtn last" path="'.$path.'">X</div>';
		//$file_class = $file_ext+'-file';
		//$file_link = BASE_URL.$path;
		$file_class = $file_ext.'-file';
		$file_link = BASE_URL."/app/webroot/files/upload/".$path;
		$tpl = '<div class="common-file-post '.$file_class.'" data-file-id="{{file_id}}">
		<a target="_blank" href="'.$file_link.'" >'.$filename."</a>";
		if($delete == 1){
			$tpl .= $removebtn;
		}
		$tpl .= ''.
		'</div>';     
        $html = '';        
        if($path != ''){
            if($id == 0){
                $id = $this->generateRandomString();                
            }
            $html = str_replace(array('{{file_id}}', '{{file_path}}'), 
                                array($id, $path), $tpl);
        }
        return $html;
    }
	function deleteFile($id = 0){
		$this->check_isAdmin_isSuperAdmin();		
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Library', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->data = $this->Library->read(null, $id);
		$this->data['Library']['file'] = '';
		if ($this->Library->save($this->data)) {
			$this->Session->setFlash(__('File deleted', true));
			$this->redirect(array('action'=> 'edit/'.$id));
		}
		$this->Session->setFlash(__('File was not deleted', true));
		$this->redirect(array('action'=> 'edit/'.$id));			
	}
	function all(){
		$this->set('title_for_layout', 'Library');
		$this->set('selected', 'library_page');		
	}
	function listing(){
		$forum_libraries_types1 = $this->forum_libraries_types1;
		$this->set('selected', 'library_page');		
		$type1 = isset($this->params['named']['type1'])?$this->params['named']['type1']:0;	
		$this->set('title_for_layout', 'Library');
		$title = '';
		if(isset($forum_libraries_types1[$type1])){
			$title = $forum_libraries_types1[$type1];
			$this->set('title_for_layout', $title);
			$this->set('page_title', $title);
		}
		if($type1 == 0){
			$this->render('all_modules');				
		}elseif($type1 == 3){
			$libraries = $this->get_libraries($type1);
			$this->set('libraries', $libraries);
			$this->render('all_albums');				
		}else{				
			$libraries = $this->get_libraries($type1);
			$this->set('libraries', $libraries);	
			$this->set('hide_section_title', 1);					
			if($type1 == 3){
				$this->set('is_photo_gallery', 1);				
			}
			$this->render('items');
		}
	}
	function module(){
		$forum_modules_types = $this->forum_modules_types;
		$id = isset($this->params['named']['id'])?$this->params['named']['id']:0;	
		$this->set('selected', 'library_page');	
		if(isset($forum_modules_types[$id])){
			$module_name = $forum_modules_types[$id];
			$this->set('title_for_layout', $module_name);
			$this->set('page_title', $module_name);			
		}		
		$libraries = $this->get_libraries(0, $id);
		$this->set('libraries', $libraries);
		$this->render('items');
	}
	function album(){
		$id = isset($this->params['named']['id'])?$this->params['named']['id']:0;	
		$this->set('selected', 'library_page');			
		$library = $this->Library->read(null, $id);
		$this->set('library', $library);
		$title = $library['Library']['title'];
		$this->set('title_for_layout', $title);
		$this->set('page_title', $title);		
	}
	function get_libraries($type1 = 0, $module = 0){
		$conditions = array();
		$conditions['Library.approved'] = 1;
		$conditions['Library.module'] = $module;
		$conditions['Library.type1'] = $type1;
		$libraries = $this->Library->find(
			'all', array(
				'conditions' => $conditions,
				'order' => array('Library.weight' => 'ASC', 'Library.updated' => 'DESC', 'Library.id'=>'DESC')
			)	  	 	
		);
		return $libraries;		
	}
}