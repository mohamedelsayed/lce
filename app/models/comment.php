<?php
class Comment extends AppModel {
	var $name = 'Comment';
	var $displayField = 'title';
	var $order = array("Comment.created" => "DESC");
	
	//Validation rules
	var $validate = array(
		'name' => array(
	        'rule' => 'notEmpty',
	    	'required' => true,
	        'allowEmpty' => false,
	        'message' => 'please enter your name',
			'on' => 'create'
	    ),
	    'body' => array(
	        'rule' => 'notEmpty',
	    	'required' => true,
	        'allowEmpty' => false,
	        'message' => 'please enter your comment',
			'on' => 'create'
	    ),		 
		 /*,
	    'member_id' => array(
	        'rule' => 'notEmpty',
	    	'required' => true,
	        'allowEmpty' => false,
	        'message' => 'No memeber Id',
			'on' => 'create'
	    )*/
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		/*'Member' => array(
			'className' => 'Member',
			'foreignKey' => 'member_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),*/
		'Article' => array(
			'className' => 'Article',
			'foreignKey' => 'article_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)/*,
		'Advice' => array(
			'className' => 'Advice',
			'foreignKey' => 'advice_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)*/
	);
}
?>