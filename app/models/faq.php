<?php
class Faq extends AppModel {
	var $name = 'Faq';
	var $displayField = 'title';
	
	//Validation rules
	var $validate = array(
		'question' => array(
	        'rule' => 'notEmpty',
	        'message' => 'Question cannot be left blank'
	    ),
	    'answer' => array(
	        'rule' => 'notEmpty',
	        'message' => 'Answer cannot be left blank'
	    ),
	);
	
}
?>