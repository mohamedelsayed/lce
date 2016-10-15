<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
class Library extends AppModel {
	var $name = 'Library';
	var $displayField = 'title';
	var $validate = array(
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Title cannot be left blank.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),'google_drive_url' => array(
			'rule' => array('url'),
			'message' => 'Please supply a valid url.',
			'allowEmpty' => true,
		),'youtube_url' => array(
			'rule' => array('url'),
			'message' => 'Please supply a valid url.',
			'allowEmpty' => true,
		)
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(	
	);
	var $hasMany = array(
	);
}