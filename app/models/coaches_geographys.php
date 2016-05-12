<?php
class CoachesGeographys extends AppModel {
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