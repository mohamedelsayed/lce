<?php
class Subscriber extends AppModel {
	var $name = 'Subscriber';
	var $displayField = 'name';
	
	//Validation rules
	var $validate = array(
		'email' => array(
	    	'emailRule-1' => array(
		        'rule' => array('email', true),
				'allowEmpty' => false,	    
		        'message' => 'Please enter a valid Email address.'
		    ),
	        'emailRule-2' => array(
	            'rule' => 'isUnique',  
	            'message' => 'This Email has already been taken.'
	        )  
		)	    
	);
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	/*var $belongsTo = array(		
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);*/
}
?>