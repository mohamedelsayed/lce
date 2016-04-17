<?php
class User extends AppModel {
	var $name = 'User';
	var $displayField = 'name';
	
	//Validation rules
	var $validate = array(
	    'name' => array(
	        'rule' => 'notEmpty',
	        'message' => 'Name cannot be left blank'
	    ),	    
	    'email' => array(
	        'rule' => array('email', true),
			'allowEmpty' => true,	    
	        'message' => 'Please enter a valid email address.'
	    ),
	    'username' => array(
	        'usernameRule-1' => array(
	            'rule' => 'alphaNumeric',
		        'required' => true,
		        'allowEmpty' => false,	    		  
	            'message' => 'Only alphabets and numbers allowed',
	            'last' => true
	         ),
	        'usernameRule-2' => array(
	            'rule' => 'isUnique',  
	            'message' => 'This username has already been taken.'
	        )  
	    ),
    	'password' => array( 
        	'rule' => 'notEmpty',
        	'message' => 'Password cannot be left blank'
    	)/*,
	   	'group_id' => array(
	        'rule' => array('comparison', '>', 0),
	        'allowEmpty' => false,
    		'required' => true,
	        'message' => 'Group cannot be left blank',
	        'on'=>'create'
	    )*/	    	    
	);
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	/*var $belongsTo = array(
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);*/
}
?>