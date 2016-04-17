<?php
class Album extends AppModel {
	var $name = 'Album';
	var $displayField = 'title';
	
	//Validation rules
	var $validate = array(
	    'title' => array(
	        'rule' => 'notEmpty',
	        'message' => 'Title cannot be left blank'
	    ),
	    /*'section_id' => array(
	        'rule' => array('comparison', '>', 0),
	    	'required' => true,
	        'allowEmpty' => false,
	        'message' => 'Section cannot be left blank'
	    ),
	    'issue_id' => array(
	        'rule' => array('comparison', '>', 0),
	    	'required' => true,
	        'allowEmpty' => false,
	        'message' => 'Issue cannot be left blank'
	    ),*/   	    
	);
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	/*var $belongsTo = array(
		'Issue' => array(
			'className' => 'Issue',
			'foreignKey' => 'issue_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Section' => array(
			'className' => 'Section',
			'foreignKey' => 'section_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);*/

	var $hasMany = array(
		/*'Gal' => array(
			'className' => 'Gal',
			'foreignKey' => 'album_id',
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
		'Video' => array(
			'className' => 'Video',
			'foreignKey' => 'album_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => array('Video.id'=>'DESC'),
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Audio' => array(
			'className' => 'Audio',
			'foreignKey' => 'album_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => array('Audio.id'=>'DESC'),
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
?>