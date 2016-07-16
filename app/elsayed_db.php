<?php
/**
 * @author Author "Mohamed Elsayed"  
 * @author Author Email "me@mohamedelsayed.net"
 * @link http://www.lifecoachingegypt.net
 * @copyright Copyright (c) 2016 Programming by "http://www.mohamedelsayed.net"
 */
$http_host = $_SERVER['HTTP_HOST'];
$db_host = 'localhost';
$database = 'lce';
$username = 'root';
$password = 'root';
$http_string = "http://";
$show_payment_button = 1;
if (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') {
    $http_string = "https://";
}
$base_url = $http_string . $http_host;
if (strpos($http_host, '.mohamedelsayed.net') !== FALSE) {
	$database = 'elsayed_lce';
	$username = 'elsayed_lce';
    $password = 'xPBNZvrd8u8z';
}
if (strpos($http_host, 'lifecoachingegypt.com') !== FALSE) {
    $database = 'lifecoj0_lifecoa_chingwebsite';
	$username = 'lifecoj0_chidbus';
    $password = 'L0gmeuIn0W3';
	$show_payment_button = 0;
}elseif (strpos($http_host, 'localhost') !== FALSE) {
	$base_url = $http_string . $http_host . '/myworkspace/lce';
    if (PHP_OS == 'Linux') {
    } else {
        $password = '';
    }
}
define('DB_HOST', $db_host);
define('DB_NAME', $database);
define('DB_USERNAME', $username);
define('DB_PASSWORD', $password);
define('BASE_URL', $base_url);
define('SHOW_PAYMENT_BUTTON', $show_payment_button);
define('STMP_TIMEOUT', 60);
/*define('STMP_USERNAME', 'lce@mohamedelsayed.net');
define('STMP_PASSWORD', 'DDVwD0tMlDEO');
define('STMP_SERVER', 'mail.mohamedelsayed.net');
define('STMP_PORT', 26);*/
define('STMP_USERNAME', 'lce.mail.site@gmail.com');
define('STMP_PASSWORD', 'DDVwD0tMlDEO');
define('STMP_SERVER', 'smtp.gmail.com');
define('STMP_PORT', 465);
