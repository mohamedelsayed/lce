<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @copyright Copyright (c) 2016 Programming by "mohamedelsayed.net"
 */
class Slideshow extends AppModel {
	var $name = 'Slideshow';
	var $validate = array(
		'link' => array(
			'rule' => array('url'),
			'message' => 'Please supply a valid url.',
			'allowEmpty' => true,
		),
		'image' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Image cannot be left blank.',
			),
		)
	);
}