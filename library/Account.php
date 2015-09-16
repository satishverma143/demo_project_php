<?php
class Account
{
    function doLogin($email,$password,$remeber){
        $result  = array();
        $errorMessage = '';
        $demo=array();
        createConnection::connectToDatabase();
        //$sql = "SELECT * FROM tbl_login WHERE email = '$email' and password = PASSWORD('$password') and is_active=true";
        $sql="SELECT tl.id, tl.email, tl.password, tl.is_active, tu.first_name, tu.last_name, tu.login_id
				FROM tbl_login tl
				INNER JOIN tbl_users tu
				ON tl.id=tu.login_id WHERE tl.email = '$email' and tl.password = PASSWORD('$password') and tl.is_active=true";
        $result = createConnection::dbQuery($sql);
        if(createConnection::dbNumRows($result)==1){
        	while($row = createConnection::dbFetchAssoc($result))
        	{
        		$id=$row["id"];
                $email=$row["email"];
                $pass=$row["password"];
                $name=$row["first_name"]." ".$row["last_name"];
				$demo = array('status'=>true, 'id'=> $id,'email' => $email, 'name'=>$name );
            }
            return $demo;//print_r($demo);
        }else{
        	//echo 'Your account number or password incorrect or Account is not Active.';
        	return array('status'=>false, 'error'=>'Your account number or password incorrect or Account is not Active.');
        }
    }
	function doRegister($firstName,$lastName,$emailid,$pass)
	{
		$first_name = $firstName;//$_POST['input_fname'];
		$last_name 	= $lastName;// $_POST['input_lname'];
		$pwd 	= $pass;//$_POST['input_password'];
		$email 	= $emailid;//$_POST['input_email'];
		
		$errorMessage = '';	
		createConnection::connectToDatabase();	
		
		$sql = "SELECT email FROM tbl_login WHERE email = '$email'";
		$result = createConnection::dbQuery($sql);
		if(createConnection::dbNumRows($result)==1)
		{
			$errorMessage = 'Username is already exist, please try another email.';
			return false;//$errorMessage;
		}
		else
		{
			$insert_id = 0; 
			//Insert values in Login Table
			$sql = "INSERT INTO tbl_login (email, password, is_active, added_date, role)
					VALUES ('$email', PASSWORD('$pwd'), true, now(), 'USER')";	
			createConnection::dbQuery($sql);
			$insert_id = createConnection::dbInsertId();

			//Insert values in Users Table
			$sql = "INSERT INTO tbl_users (login_id, first_name, last_name, added_date)
			 		VALUES ('$insert_id','$first_name','$last_name', now())";	
			createConnection::dbQuery($sql);

			//Insert values in Address Table
			$sql = "INSERT INTO tbl_address (user_id) 
			 		VALUES ($insert_id)";
			createConnection::dbQuery($sql);

			//now send email
			//email it now.	
			$subject = "Account Registration";
			$to = $email;
			$msg_body = "Dear Customer,<br/><br/>
			This is to inform you that your Account # $email is register successfully with Demo Project and currently in Inactive state. We will soon contact you once it get activate.<br/><br/>In case you need any further clarification for the same, please do get in touch with your Home Branch.<br/><br/>
			Regards,<br/>Admin, Demo Project";
			
			$mail_data = array('to' => $to, 'sub' => $subject, 'msg' => 'register', 'body' => $msg_body);
			//send_email($mail_data);
				
			//header('Location: ../thankyou.php');
			//exit;	
			return true;
		}
	}
}
?>