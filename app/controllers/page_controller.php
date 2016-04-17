<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2014 Programming by "mohamedelsayed.net"
 */
class PageController  extends AppController {
	var $name = 'Page';
	var $uses = null;
	var $components = array('Email');
	
	function index(){
		$this->redirect(array('controller'=>'/'));
	}

	function view($cat_id){
		if($cat_id == 2){
			$this->redirect(array('action'=>'show/'.$cat_id));			
		}				
		$this->loadModel('Cat');
		$cat = $this->Cat->find(
			'first', array(
				'conditions' => array('Cat.approved' => 1, 'Cat.id' => $cat_id),
				'order' => array('Cat.weight' => 'ASC','Cat.id'=>'DESC')
			)	  	 	
		);		
		$this->set('cat' , $cat);
		//$cleanedtitle = $this->cleanTitle($cat['Cat']['title']);
		$this->set('selected', 'page'.$cat['Cat']['id']);
		//$this->set('cleanedtitle' , $cleanedtitle);
		$this->set('title_for_layout' , $cat['Cat']['title']);
		$this->loadModel('Node');
		$nodes = $this->Node->find(
			'all', array(
				'conditions' => array('Node.approved' => 1,'Node.cat_id' => $cat_id),
				'order' => array('Node.weight' => 'ASC','Node.id'=>'DESC')
			)	  	 	
		);
		$this->set('nodes' , $nodes);
		$this->set(
			array(
				'metaKeywords'     => $cat['Cat']['meta_keywords'],
				'metaDescription'  => $cat['Cat']['meta_description'],
			)
		);	
		foreach ($nodes as $key => $node) {
			if($node['Node']['id'] == 6){
				$this->loadModel('Testimonial');
				$testimonials = $this->Testimonial->find(
					'all', array(
						'conditions' => array('Testimonial.approved' => 1),
						'order' => array('Testimonial.weight' => 'ASC', 'Testimonial.created' => 'ASC','Testimonial.id'=>'DESC')
					)	  	 	
				);
				$this->set('testimonials' , $testimonials);
			}
			if($node['Node']['id'] == 3 || $node['Node']['id'] == 2){
				$type = 0;
				if($node['Node']['id'] == 2){
					$type = 1;
				}
				$this->loadModel('TeamMember');
				$teamMembers = $this->TeamMember->find(
					'all', array(
						'conditions' => array('TeamMember.approved' => 1, 'TeamMember.type' => $type),
						'order' => array('TeamMember.weight' => 'ASC', 'TeamMember.created' => 'ASC','TeamMember.id'=>'DESC')
					)	  	 	
				);
				if($node['Node']['id'] == 2){
					$this->set('teamMembers2' , $teamMembers);
				}
				if($node['Node']['id'] == 3){
					$this->set('teamMembers3' , $teamMembers);
					$teamMembersCommunity = $this->TeamMember->find(
						'all', array(
							'conditions' => array('TeamMember.approved' => 1, 'TeamMember.type' => 2),
							'order' => array('TeamMember.weight' => 'ASC', 'TeamMember.created' => 'ASC','TeamMember.id'=>'DESC')
						)	  	 	
					);
					$this->set('teamMembersCommunity' , $teamMembersCommunity);
				}
			}			
		}			
	}
	function show($cat_id = 2){
		$this->loadModel('Cat');
		$cat = $this->Cat->find(
			'first', array(
				'conditions' => array('Cat.approved' => 1, 'Cat.id' => $cat_id),
				'order' => array('Cat.weight' => 'ASC','Cat.id'=>'DESC')
			)	  	 	
		);		
		$this->set('cat' , $cat);
		$this->set('selected', 'page'.$cat['Cat']['id']);
		$this->set('title_for_layout' , $cat['Cat']['title']);
		$all_cats = $this->Cat->find(
			'all', array(
				'conditions' => array('Cat.approved' => 1, 'Cat.parent_id' => $cat_id),
				'order' => array('Cat.weight' => 'ASC','Cat.id'=>'DESC')
			)	  	 	
		);		
		$this->set('all_cats' , $all_cats);
		$this->loadModel('Node');
		$all_nodes = array();
		foreach ($all_cats as $key => $all_cat) {
			$all_nodes[$all_cat['Cat']['id']] = $this->Node->find(
				'all', array(
					'conditions' => array('Node.approved' => 1,'Node.cat_id' => $all_cat['Cat']['id']),
					'order' => array('Node.weight' => 'ASC','Node.id'=>'DESC')
				)	  	 	
			);
						
		}		
		$this->set('all_nodes' , $all_nodes);
		$this->set(
			array(
				'metaKeywords'     => $cat['Cat']['meta_keywords'],
				'metaDescription'  => $cat['Cat']['meta_description'],
			)
		);	
	}	
}
?>