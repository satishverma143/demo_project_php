<?php
set_include_path(dirname(__FILE__)."/../");
require_once '../dbconfig/config.php';
require_once '../library/Account.php';

createConnection::connectToDatabase();	
$account=new Account();


if(isset($_REQUEST['input_fname']) && isset($_REQUEST['input_lname'])
   	&& isset($_REQUEST['input_email']) && isset($_REQUEST['input_password']))
{
    $firstName = createConnection::realEscapeString($_REQUEST['input_fname']);
    $lastName = createConnection::realEscapeString($_REQUEST['input_lname']);
    $email = createConnection::realEscapeString($_REQUEST['input_email']);
    $password = createConnection::realEscapeString($_REQUEST['input_password']);
    $response = $account->doRegister($firstName, $lastName, $email, $password);
    //echo $response[0];

    echo json_decode($response);

} 
?>