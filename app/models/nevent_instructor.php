<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
class NeventInstructor extends AppModel {
	var $useTable = 'nevents_instructors';
	var $name = 'NeventInstructor';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Nevent' => array(
			'className' => 'Nevent',
			'foreignKey' => 'event_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Instructor' => array(
			'className' => 'Instructor',
			'foreignKey' => 'instructor_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}