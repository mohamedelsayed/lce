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
$payment_merchant_id = 'Test290510EGP';
$payment_access_code = 'B972DDBB';
$payment_hash_secret = 'C0DF9A7B3819968807A9D4E48D0E65C6';
if (strpos($http_host, '.mohamedelsayed.net') !== FALSE) {
	$database = 'elsayed_lce';
	$username = 'elsayed_lce';
    $password = 'xPBNZvrd8u8z';
}
if (strpos($http_host, 'lifecoachingegypt.com') !== FALSE) {
    $database = 'lifecoj0_lifecoa_chingwebsite';
	$username = 'lifecoj0_chidbus';
    $password = 'L0gmeuIn0W3';
	$show_payment_button = 1;
	$payment_merchant_id = '529760';
	$payment_access_code = '4730221D';
	$payment_hash_secret = 'FB4DD9A7E8DB59C6C1E9AF929287C591';
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
define('STMP_TIMEOUT', 30);
define('STMP_USERNAME', 'noreply@lifecoachingegypt.com');
define('STMP_PASSWORD', 'e9!pf_}i]ex~');
define('STMP_SERVER', 'mail.lifecoachingegypt.com');
define('STMP_PORT', 26);
define('SMTPSECURE', FALSE);
define('SEND_STMP', FALSE);
define('PAYMENT_MERCHANT_ID', $payment_merchant_id);
define('PAYMENT_ACCESS_CODE', $payment_access_code);
define('PAYMENT_HASH_SECRET', $payment_hash_secret);