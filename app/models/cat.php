<?php
class Cat extends AppModel {
	var $name = 'Cat';
	var $displayField = 'title';
	var $validate = array(
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Title cannot be left blank',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
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
		/*'Artist' => array(
			'className' => 'Artist',
			'foreignKey' => 'artist_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),*/
		'ParentCat' => array(
			'className' => 'Cat',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	var $hasMany = array(
		'ChildCat' => array(
			'className' => 'Cat',
			'foreignKey' => 'parent_id',
			'dependent' => false,
			'conditions' => array('ChildCat.approved' => 1),
			'fields' => '',
			'order' => array('ChildCat.weight' => 'ASC', 'ChildCat.id' => 'DESC'),
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Node' => array(
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
		)
	);
}