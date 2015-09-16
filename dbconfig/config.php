<?php
ini_set('display_errors', 'On');
//ob_start("ob_gzhandler");
error_reporting(E_ALL);

// start the session
session_start();

// database connection config
// $dbHost = 'localhost';
// $dbUser = 'root';
// $dbPass = '';
// $dbName = 'db_demo_project';

//Project data
$site_title = 'Demo PHP Project';
$email_id = 'satish.verma143@gmail.com';

// setting up the web root and server root for
// this shopping cart application
$thisFile = str_replace('\\', '/', __FILE__);
$docRoot = $_SERVER['DOCUMENT_ROOT'];

$webRoot  = str_replace(array($docRoot, 'dbconfig/config.php'), '', $thisFile);
$srvRoot  = str_replace('dbconfig/config.php', '', $thisFile);

define('WEB_ROOT', $webRoot);
define('SRV_ROOT', $srvRoot);

// these are the directories where we will store all
// category and product images
define('USER_IMAGE_DIR', 'images/thumbnails/');

// some size limitation for the category
// and product images

// all category image width must not 
// exceed 75 pixels
define('MAX_USER_IMAGE_WIDTH', 180);

// do we need to limit the product image width?
// setting this value to 'true' is recommended
define('LIMIT_USER_WIDTH',     true);

// the width for product thumbnail
define('THUMBNAIL_WIDTH',      180);

if (!get_magic_quotes_gpc()) {
	if (isset($_POST)) {
		foreach ($_POST as $key => $value) {
			$_POST[$key] =  trim(addslashes($value));
		}
	}
	
	if (isset($_GET)) {
		foreach ($_GET as $key => $value) {
			$_GET[$key] = trim(addslashes($value));
		}
	}
}

require_once 'database.php';
require_once 'common.php';

?>