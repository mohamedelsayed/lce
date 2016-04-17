<?php
class Attachment extends AppModel {
	var $name = 'Attachment';
	var $displayField = 'title';
	
	//Validation rules
	var $validate = array(
	    'file' => array(
	        'rule' => 'notEmpty',
	        'message' => 'File cannot be left blank.'
	    )
	);
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Node' => array(
			'className' => 'Node',
			'foreignKey' => 'node_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);	
}
?>