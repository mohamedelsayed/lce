<?php
class Content extends AppModel {
	var $name = 'Content';
	var $displayField = 'title';
	var $hasMany = array(
		'Gal' => array(
			'className' => 'Gal',
			'foreignKey' => 'content_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => array('Gal.position' => 'ASC', 'Gal.id' => 'DESC'),
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Video' => array(
			'className' => 'Video',
			'foreignKey' => 'content_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
}
?>