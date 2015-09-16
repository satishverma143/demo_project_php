<?php
set_include_path(dirname(__FILE__)."/../");
require_once '../dbconfig/config.php';
require_once '../library/Account.php';

createConnection::connectToDatabase();	
$account=new Account();


if(isset($_REQUEST['email']) && isset($_REQUEST['password'])&& isset($_REQUEST['remember']))
{
    $email = createConnection::realEscapeString($_REQUEST['email']);
    $password = createConnection::realEscapeString($_REQUEST['password']);
    $remember = $_REQUEST['remember'];
    $account->doLogin($email, $password,$remember);


    header('Content-Type: application/json');
    echo json_encode($response);
} 
?>
