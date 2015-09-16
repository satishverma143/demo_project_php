<?php
require_once './dbconfig/config.php';
require_once './library/functions.php';

checkUser();

$content = 'view/summary.php';
$pageTitle = 'Demo Project';
$script = array();

require_once 'include/template.php';

//Test for my commit.
?>