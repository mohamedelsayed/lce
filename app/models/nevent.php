<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
class Nevent extends AppModel {
	var $name = 'Nevent';
	var $displayField = 'title';
	var $validate = array(
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Title cannot be left blank',
			),
		),'duration' => array(
			'notempty' => array(
				'rule' => 'numeric',
				'message' => 'Duration must be Number',
			),
		),'ticket_price' => array(
			'notempty' => array(
				'rule' => 'numeric',
				'message' => 'Ticket Price must be Number',
			),
		)/*,
		'artist_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)/*,
		'cat_type' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'parent_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),*/
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Instructor' => array(
			'className' => 'Instructor',
			'foreignKey' => 'instructor_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	var $hasMany = array(
		/*'Node' => array(
			'className' => 'Node',
			'foreignKey' => 'cat_id',
			'dependent' => false,
			'conditions' => array('Node.approved' => 1),
			'fields' => '',
			'order' => array('Node.weight' => 'ASC', 'Node.id' => 'DESC'),
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)*/
	);
}