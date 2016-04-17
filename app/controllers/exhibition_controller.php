<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2013 Programming by "mohamedelsayed.net"
 */
class ExhibitionController  extends AppController {
	var $name = 'Exhibition';

	var $uses = array('Cat','Node','Artist');
	
	var $cats_order = array('Cat.date'=>'ASC', 'Cat.id'=>'DESC', 'Cat.title'=>'ASC');
	var $artists_order = array('Artist.id'=>'ASC', 'Artist.name'=>'ASC');
	var $nodes_order = array(/*'Node.date'=>'ASC', 'Node.id'=>'DESC',*/ 'Node.title'=>'ASC');
	var $children_limit = 1000;

	function index($id = null){
		$artist_id = 1;
		$this->set('selected','exhibition');		
		$this->Artist->recursive = 0;
		$artist = $this->Artist->find(
					'first', array(
						'conditions' => array('Artist.id' => $artist_id),
					)	  	 	
				);
		$this->set('artist',$artist);		
		$this->Cat->recursive = 1;
		$this->Node->recursive = 1;
		$nodes_conditions = array();
		$nodes_conditions['Node.approved'] = 1;
		$nodes_conditions['Node.artist_id'] = $artist_id;
		//$nodes_order = array('Node.id'=>'DESC', 'Node.title'=>'ASC');
		$nodes_limit = $this->getPagingLimit();
		if($id == null){
			$all_cats_conditions = array(
	            'OR' => array(
	                array('Cat.parent_id' => 0),
	                array('Cat.parent_id' => null)
	            ),array('Cat.artist_id' => $artist_id)
	        );
			//$allorder = array('Cat.id'=>'ASC', 'Cat.title'=>'ASC');
			$allCats = $this->Cat->find(
						'all', array(
							'conditions' => $all_cats_conditions,
							'order' => $this->cats_order
						)	  	 	
					);
			if(!empty($allCats)){
				$id = $allCats[0]['Cat']['id'];
			}
		}
		if($id != 'all' && $id != null){
					
			$cat = $this->Cat->find(
						'first', array(
							'conditions' => array('Cat.id' => $id),
						)	  	 	
					);
			$this->set('cat',$cat);				
			$nodes_conditions['Node.cat_id'] = $id;
			$this->Cat->recursive = 0;
			$parents = $this->getAllParents($id);
			if(empty($parents))
			$this->set('left_selected',$id);
			else{
				$parent = $this->getTopParent($id);
				$this->set('left_selected',$parent);
			}
			$parentsLink = $this->getAllParentsLinks($id,'exhibition','index');			
			$this->Cat->recursive = 1;
			if(!empty($cat['ChildCat'])){				
				$conditions = array();
				$conditions['Cat.parent_id'] = $id;
				//$order = array('Cat.id'=>'DESC', 'Cat.title'=>'ASC');
				$this->paginate['Cat'] = array(
		    			//'fields'     => array('Cat.id', 'Cat.title', 'Cat.body'),
		    			'conditions' => $conditions,
						'order'      => $this->cats_order,
				    	'limit'      => 20
			    	);
				$this->set('cats', $this->paginate('Cat'));
			}else{
				$page = isset($this->params['named']['page'])?$this->params['named']['page']:$this->paginate['page'];				
				$this->paginate['Node'] = array(
		    			//'fields'     => array('Node.id', 'Node.title', 'Node.body'),
		    			'conditions' => $nodes_conditions,
						'order'      => $this->nodes_order,
				    	'limit'      => $nodes_limit,
				    	'page'  	 => $page
			    	);
				$this->set('page',$page);
				$this->set('nodes', $this->paginate('Node'));
			}
			$this->set('metaKeywords', $cat['Cat']['meta_keywords']);
			$this->set('metaDescription', $cat['Cat']['meta_description']);
			$this->set('title_for_layout' , $cat['Cat']['title']);
			$tree = array($artist['Artist']['name']);
			$tree = array_merge($tree, $parents);
			array_push($tree,$cat['Cat']['title']);
			$this->set('tree' , $tree);
			$treeLink = array('exhibition');
			$treeLink = array_merge($treeLink, $parentsLink);
			array_push($treeLink,'');
			$this->set('treeLink' , $treeLink);
		}else{
			$this->set('metaKeywords', $artist['Artist']['meta_keywords']);
			$this->set('metaDescription', $artist['Artist']['meta_description']);
			$this->set('title_for_layout' , $artist['Artist']['name']);
			$this->set('tree' , array($artist['Artist']['name'],'All'));
			$this->set('treeLink' , array('exhibition',''));
			//$nodes_conditions['Cat.cat_type'] = 0;
			$page = isset($this->params['named']['page'])?$this->params['named']['page']:$this->paginate['page'];
			$this->paginate['Node'] = array(
	    			//'fields'     => array('Node.id', 'Node.title', 'Node.body'),
	    			'conditions' => $nodes_conditions,
					'order'      => $this->nodes_order,
			    	'limit'      => $nodes_limit,
			    	'page'  	 => $page
		    	);
			$this->set('page',$page);
			$this->set('nodes', $this->paginate('Node'));
		}
		//if($id == 'all' || (isset($cat) && $cat['Cat']['cat_type'] == 0)){
			//$order = array('Cat.id'=>'DESC', 'Cat.title'=>'ASC');
			$left_cats_children_conditions['Cat.parent_id'] = $id;
			$left_cats_children_ex = $this->Cat->find(
						'all', 
						array(
							'conditions' => $left_cats_children_conditions,
							'order' => $this->cats_order,
							'limit' => 5
						)	  	 	
					);
			//$left_cats_children_ex = array();
			if(empty($left_cats_children_ex)){
				$left_cats_children_conditions['Cat.parent_id'] = $cat['Cat']['parent_id'];
				$left_cats_children_ex = $this->Cat->find(
							'all', 
							array(
								'conditions' => $left_cats_children_conditions,
								'order' => $this->cats_order,
								'limit' => $this->children_limit
							)	  	 	
						);				
			}
			$this->set('left_cats_children_ex',$left_cats_children_ex);
		//}	
		$left_cats_conditions = array(
            'OR' => array(
                array('Cat.parent_id' => 0),
                array('Cat.parent_id' => null)
            ),array('Cat.artist_id' => $artist_id)
        );
		//$order = array('Cat.id'=>'ASC', 'Cat.title'=>'ASC');
		$left_cats = $this->Cat->find(
					'all', 
					array(
						'conditions' => $left_cats_conditions,
						'order' => $this->cats_order,
						'limit' => 10
					)	  	 	
				);
		$this->set('left_cats',$left_cats);		
		$this->render('categories');		
	}
	function events(){
		$this->set('selected','exhibition');
		$this->set('left_selected','events');
		$artist_id = 1;
		$this->Artist->recursive = 0;
		$artist = $this->Artist->find(
					'first', array(
						'conditions' => array('Artist.id' => $artist_id),
					)	  	 	
				);
		$this->set('artist',$artist);
		$this->Cat->recursive = 0;
		$left_cats_conditions = array(
            'OR' => array(
                array('Cat.parent_id' => 0),
                array('Cat.parent_id' => null)
            ),array('Cat.artist_id' => $artist_id)
        );
		//$order = array('Cat.id'=>'ASC', 'Cat.title'=>'ASC');
		$left_cats = $this->Cat->find(
					'all', 
					array(
						'conditions' => $left_cats_conditions,
						'order' => $this->cats_order,
						'limit' => 10
					)	  	 	
				);
		$this->set('left_cats',$left_cats);
		$this->loadModel('Event');
		$conditions = array();
		$conditions['Event.approved'] = 1;
		$order = array('Event.id'=>'DESC', 'Event.title'=>'ASC');
		$this->paginate['Event'] = array(
    			//'fields'     => array('Cat.id', 'Cat.title', 'Cat.body'),
    			'conditions' => $conditions,
				'order'      => $order,
		    	'limit'      => 20
	    	);
		$this->set('events', $this->paginate('Event'));
		$this->loadModel('Content');
		$event = $this->Content->read(null, 3);
		$this->set('content_event',$event);
		$this->set('metaKeywords', $artist['Artist']['meta_keywords']);
		$this->set('metaDescription', $artist['Artist']['meta_description']);
		$this->set('title_for_layout' ,$event['Content']['title']);
		$this->set('tree' , array($artist['Artist']['name'],$event['Content']['title']));
		$this->set('treeLink' , array('exhibition',''));
		$this->render('categories');
	}
}
?>