<?php
class AttendEvent extends AppModel {
	var $name = 'AttendEvent';
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
		'Event' => array(
			'className' => 'Event',
			'foreignKey' => 'event_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'member_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}