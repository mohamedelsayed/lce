<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
class Event extends AppModel {
	var $name = 'Event';
	var $displayField = 'title';
	//Validation rules
	var $validate = array(
	    'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Title cannot be left blank',
			),
		)/*,'duration' => array(
			'numeric' => array(
				'rule' => 'numeric',
				'message' => 'Duration must be Number',
			),
		)*/,'ticket_price' => array(
			'numeric' => array(
				'rule' => 'numeric',
				'message' => 'Ticket Price must be Number',
			),
		),'agenda_word_file' => array(
			'rule' => array('url'),
			'message' => 'Please supply a valid url.',
			'allowEmpty' => true,
		),'agenda_word_file' => array(
			'rule' => array('url'),
			'message' => 'Please supply a valid url.',
			'allowEmpty' => true,
		),'minutes_of_meeting_file' => array(
			'rule' => array('url'),
			'message' => 'Please supply a valid url.',
			'allowEmpty' => true,
		),'p_and_l_sheet' => array(
			'rule' => array('url'),
			'message' => 'Please supply a valid url.',
			'allowEmpty' => true,
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
	//The Associations below have been created with all possible keys, those that are not needed can be removed	
	/*var $hasMany = array(
		'Gal' => array(
			'className' => 'Gal',
			'foreignKey' => 'event_id',
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
		'Video' => array(
			'className' => 'Video',
			'foreignKey' => 'event_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);*/
	/*var $belongsTo = array(
		'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'member_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);*/
	var $hasMany = array(
		'EventInstructor' => array(
			'className' => 'EventInstructor',
			'foreignKey' => 'event_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => array(),
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Gal' => array(
			'className' => 'Gal',
			'foreignKey' => 'event_id',
			'dependent' => true,
			'conditions' => array('Gal.url <>' => ''),
			'fields' => '',
			'order' => array('Gal.position' => 'ASC', 'Gal.id' => 'DESC'),
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
	);
	var $hasAndBelongsToMany = array(
		'Instructor' => array(
			'className' => 'Instructor',
			'joinTable' => 'events_instructors',
			'foreignKey' => 'event_id',
			'associationForeignKey' => 'instructor_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);	
}