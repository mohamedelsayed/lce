<?php
class CoachesSpecializations extends AppModel {
	var $name = 'CoachSpecialization';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Coach' => array(
			'className' => 'Coach',
			'foreignKey' => 'coach_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Specialization' => array(
			'className' => 'Specialization',
			'foreignKey' => 'specialization_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}