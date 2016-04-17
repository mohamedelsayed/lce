<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.lifecoachingegypt.com
 * @copyright Copyright (c) 2015 Programming by "mohamedelsayed.net"
 */
class BlockedMember extends AppModel {
	var $name = 'BlockedMember';
	//var $displayField = 'title';
	//Validation rules
	var $validate = array(
	    /*'title' => array(
	        'rule' => 'notEmpty',
	        'message' => 'Title cannot be left blank'
	    )/*,
	   	'date_from' => array(
	        'rule' => 'notEmpty',
	        'message' => 'Date From cannot be left blank'
	    ),
	   	'date_to' => array(
	        'rule' => 'notEmpty',
	        'message' => 'Date To cannot be left blank'
	    )*/    	    
	);	
	var $belongsTo = array(		
		'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'member_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'BlockMember' => array(
			'className' => 'Member',
			'foreignKey' => 'blocked_member_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}