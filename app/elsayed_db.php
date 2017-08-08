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
if ($dir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '\/')) {
	$base_path = $dir;
	$base_url .= $base_path;
}
$base_url = str_replace('/app/webroot', '', $base_url);
$payment_merchant_id = 'Test290510EGP';
$payment_access_code = 'B972DDBB';
$payment_hash_secret = 'C0DF9A7B3819968807A9D4E48D0E65C6';
if (strpos($http_host, 'localhost') !== FALSE) {
    if (PHP_OS == 'Linux') {
    } else {
        $password = '';
    }
}
$default_image = $base_url.'/img/forum/default_image.jpg';
define('DB_HOST', $db_host);
define('DB_NAME', $database);
define('DB_USERNAME', $username);
define('DB_PASSWORD', $password);
define('BASE_URL', $base_url);
define('SHOW_PAYMENT_BUTTON', $show_payment_button);
define('STMP_TIMEOUT', 30);
define('DEFAULT_IMAGE', $default_image);
define('STMP_USERNAME', 'noreply@lifecoachingegypt.com');
define('STMP_PASSWORD', 'e9!pf_}i]ex~');
define('STMP_SERVER', 'mail.lifecoachingegypt.com');
define('STMP_PORT', 26);
define('SMTPSECURE', FALSE);
define('SEND_STMP', FALSE);
define('PAYMENT_MERCHANT_ID', $payment_merchant_id);
define('PAYMENT_ACCESS_CODE', $payment_access_code);
define('PAYMENT_HASH_SECRET', $payment_hash_secret);
ini_set('memory_limit', '1024M'); // or you could use 1G
require_once 'functions.php';