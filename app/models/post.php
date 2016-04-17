<?php
class Post extends AppModel {
	var $name = 'Post';
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
		),
	    'category_id' => array(
	        'rule' => array('comparison', '>', 0),
	        'allowEmpty' => false,
	        'message' => 'Category cannot be left blank'
	    ),
		 /*,
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
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'member_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	var $hasMany = array(
		'ForumComment' => array(
			'className' => 'ForumComment',
			'foreignKey' => 'post_id',
			'dependent' => false,
			'conditions' => array(),
			'fields' => '',
			'order' => array('ForumComment.id' => 'DESC'),
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)/*,
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
		)*/
	);
}