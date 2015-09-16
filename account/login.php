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
    $result=$account->doLogin($email, $password, $remember);


	header('Content-Type: application/json');
    if($result["status"]==true)
    {
    	$arrayName = array('status'=>$result["status"],'name' => $result["name"],'email' => $result["email"]);
    	echo json_encode($arrayName);
    }
    else
    {
    	echo json_encode(array('status'=>$result["status"], 'error' => $result["error"]));
    }
    //echo json_encode($result);
    
     //    $json = json_encode($result);
	 //    $parsed_json = json_decode($json, true);
	 //    if($parsed_json['status'])
	 //    {
		// 	echo $parsed_json['name'].", ".$parsed_json['email'].", ".$parsed_json['status'].", ".$parsed_json['id']; 
		// }
		// else
		// {
		// 	echo $parsed_json['status'].", ".$parsed_json['error']; 
		// }
} 
?>
