<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
class Post extends AppModel {
	var $name = 'Post';
	var $displayField = 'title';
	var $validate = array(
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Title cannot be left blank',			
			),
		),
	    'category_id' => array(
	        'rule' => array('comparison', '>', 0),
	        'allowEmpty' => false,
	        'message' => 'Category cannot be left blank'
	    ),		 
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(	
		'Category' => array(
			'className' => 'Category',
			'foreignKey' => 'category_id',
			'conditions' => array('Category.approved' => 1),
			'fields' => '',
			'order' => array('Category.weight' => 'ASC', 'Category.id' => 'DESC'),
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
		),
		'Attachment' => array(
			'className' => 'Attachment',
			'foreignKey' => 'post_id',
			'dependent' => false,
			'conditions' => array(),
			'fields' => '',
			'order' => array('Attachment.id' => 'DESC'),
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
}