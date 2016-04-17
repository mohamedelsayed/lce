<?php
class Article extends AppModel {
	var $name = 'Article';
	var $displayField = 'title';
	
	//Validation rules
	var $validate = array(
	    'title' => array(
	        'rule' => 'notEmpty',
	        'message' => 'Title cannot be left blank'
	    )	    
	);	
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	
	/*var $belongsTo = array(
		'Subject' => array(
			'className' => 'Subject',
			'foreignKey' => 'subject_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);*/
	
	var $hasMany = array(
		/*'Attachment' => array(
			'className' => 'Attachment',
			'foreignKey' => 'article_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),*/
		'Comment' => array(
			'className' => 'Comment',
			'foreignKey' => 'article_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Gal' => array(
			'className' => 'Gal',
			'foreignKey' => 'article_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)/*,
		'Video' => array(
			'className' => 'Video',
			'foreignKey' => 'article_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)*/
	);	
	/*var $hasAndBelongsToMany = array(
		'Member' => array(
			'className' => 'Member',
			'joinTable' => 'favorites',
			'foreignKey' => 'article_id',
			'associationForeignKey' => 'member_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);*/
}
?>