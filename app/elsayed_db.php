<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.mohamedelsayed.net
 * @copyright Copyright (c) 2015 Programming by "http://www.mohamedelsayed.net"
 */
$http_host = $_SERVER['HTTP_HOST'];
$db_host = 'localhost';
$database = 'lce';
$username = 'root';
$password = 'root';
if (strpos($http_host, '.mohamedelsayed.net') !== FALSE) {
	$database = 'elsayed_lce';
	$username = 'elsayed_lce';
    $password = 'xPBNZvrd8u8z';
}
if (strpos($http_host, 'lifecoachingegypt.com') !== FALSE) {
    $database = 'lce';
}elseif (strpos($http_host, 'localhost') !== FALSE) {
    if (PHP_OS == 'Linux') {
    } else {
        $password = '';
    }
}
define('DB_HOST', $db_host);
define('DB_NAME', $database);
define('DB_USERNAME', $username);
define('DB_PASSWORD', $password);