<?php
class ForumComment extends AppModel {
	var $name = 'ForumComment';
	//var $displayField = 'title';
	var $order = array("ForumComment.created" => "DESC");	
	//Validation rules
	var $validate = array(
		'comment' => array(
	        'rule' => 'notEmpty',
	    	'required' => true,
	        'allowEmpty' => false,
	        'message' => 'please enter your comment',
			'on' => 'create'
	    ),
	    'member_id' => array(
	        'rule' => 'notEmpty',
	    	'required' => true,
	        'allowEmpty' => false,
	        'message' => 'No memeber Id',
			'on' => 'create'
	    )
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'member_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'post_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}