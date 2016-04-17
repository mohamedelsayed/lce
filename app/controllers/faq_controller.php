<?php
class FaqController  extends AppController {
	var $name = 'Faq';
	var $uses = array('Faq');
	
	function index(){
		$faqs = $this->Faq->find(
			'all', array(
				'conditions' => array('Faq.approved' => 1),
				'order' => array('Faq.weight' => 'ASC','Faq.id'=>'DESC')
			)	  	 	
		);
		$this->set('faqs' , $faqs);
		$this->set('selected','faqs');
		$this->set('title_for_layout' , 'FAQS');		
	}
}
?>