<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
class CoachGeography extends AppModel {
	var $useTable = 'coaches_geographys';
	var $name = 'CoachGeography';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Coach' => array(
			'className' => 'Coach',
			'foreignKey' => 'coach_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Geography' => array(
			'className' => 'Geography',
			'foreignKey' => 'geography_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}