<?php
class Queue extends AppModel {
	var $name = 'Queue';
	//var $displayField = 'subject';
	
	//Validation rules
	/*var $validate = array(
		'subject' => array(
	        'rule' => 'notEmpty',
	        'message' => 'Subject cannot be left blank.'
	    ),	
	    'body' => array(
	        'rule' => 'notEmpty',
	        'message' => 'Body cannot be left blank.'
	    ),
	    'from_email' => array(
	        'rule' => array('email', true),
			'allowEmpty' => false,	    
	        'message' => 'Please enter a valid Email address.'
		    
		),	    
	);*/
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(		
		'Newsletter' => array(
			'className' => 'Newsletter',
			'foreignKey' => 'newsletter_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>