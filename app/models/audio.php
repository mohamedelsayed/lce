<?php
class Audio extends AppModel {
	var $name = 'Audio';
	var $displayField = 'title';
	
	//Validation rules
	var $validate = array(
		'title' => array(
	        'rule' => 'notEmpty',
	        'message' => 'Title cannot be left blank.'
	    )
	);
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Album' => array(
			'className' => 'Album',
			'foreignKey' => 'album_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)	
	);
}
?>