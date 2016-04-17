<?php /**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.mohamedelsayed.net/
 * @copyright Copyright (c) 2015 Programming by "mohamedelsayed.net"
 */
class Member extends AppModel {
	var $name = 'Member';
	var $displayField = 'fullname';	
	//Validation rules
	var $validate = array(
	    'fullname' => array(
	        'rule' => 'notEmpty',
	        'message' => 'Full Name cannot be left blank'
	    ),	    
	    'email' => array(
	    	'emailRule-1' => array(
		        'rule' => array('email', true),
				'allowEmpty' => true,	    
		        'message' => 'Please enter a valid email address.'
	        ),
	        'emailRule-2' => array(
	            'rule' => 'isUnique',  
	            'message' => 'This email has already been taken.'
	        ) 
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
    	) 	    
	);	
	var $hasMany = array(
		'BlockedMembers' => array(
			'className' => 'BlockedMember',
			'foreignKey' => 'member_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
	 );
}