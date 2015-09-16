<?php
//require_once('mail.php');
/*
	Check if a session user id exist or not. If not set redirect
	to login page. If the user session id exist and there's found
	$_GET['logout'] in the query string logout the user
*/
function checkUser()
{
	// if the session id is not set, redirect to login page
	if (!isset($_SESSION['hlbank_user'])) {
		header('Location: login.php');//. WEB_ROOT . 'login.php');
		exit;
	}
	// the user want to logout
	if (isset($_GET['logout'])) {
		doLogout();
	}
}


function next_tx_no() {
	$sql = "SELECT tx_no FROM tbl_transaction ORDER BY id DESC LIMIT 1";
	$result = dbQuery($sql);
	extract(dbFetchAssoc($result));
	$tx_num		= (int)substr($tx_no, 2);
	$next_id 	= $tx_num+1; // increment by One
	return 'TX'.$next_id;
}

function str_number($str) {
	$number = '';
	$number = str_replace('$', '', $str);
	$number = str_replace(',', '', $number);
	return doubleval($number);
}

function doPinValidation() {
	$errorMessage = '';
	
	$pin = $_SESSION['hlbank_tmp']['pin'];
	$ipPin = $_POST['accpin'];
	
	if($pin == $ipPin) {
		$_SESSION['hlbank_user'] = $_SESSION['hlbank_tmp'];
		unset($_SESSION['hlbank_tmp']);
		header('Location: index.php');
		exit;
	}
	else {
		$errorMessage = 'Invalid pin numbers, please try again.';
	}
	return $errorMessage;
} 
/*
	
*/
function doLogin()
{
	$errorMessage = '';
	
	$accno 	= (int)$_POST['accno'];
	$pwd 	= $_POST['pass'];
	
	$sql = "SELECT u.fname, u.lname, u.email, u.is_active, u.pics, u.phone,
			a.acc_no, a.user_id, a.pin, a.type, a.status,
			ad.address, ad.city, ad.state, ad.zipcode
			FROM tbl_users u, tbl_accounts a, tbl_address ad
			WHERE a.acc_no = $accno AND u.pwd = PASSWORD('$pwd')
			AND u.id = a.user_id AND ad.user_id = u.id AND u.is_active != 'FALSE'";
	$result = dbQuery($sql);
	
	if (dbNumRows($result) == 1) {
		$row = dbFetchAssoc($result);
		$_SESSION['hlbank_tmp'] = $row;
		$_SESSION['hlbank_user_name'] =	strtoupper( $row['fname'].' '.$row['lname']);
		header('Location: pin.php');
		exit;
	}
	else {
		$errorMessage = 'Your account number or password incorrect or Account is not Active.';
	}
	return $errorMessage;
}


/*
	Logout a user
*/
function doLogout()
{
	if (isset($_SESSION['hlbank_user'])) {
		unset($_SESSION['hlbank_user']);
		//session_unregister('hlbank_user');
	}
	header('Location: login.php');
	exit;
}


function doRegister()
{
	$first_name 	= $_POST['input_fname'];
	$last_name 	= $_POST['input_lname'];
	$pwd 	= $_POST['input_password'];
	$email 	= $_POST['input_email'];
	
	$errorMessage = '';	
	createConnection::connectToDatabase();	
	
	$sql = "SELECT email FROM tbl_login WHERE email = '$email'";
	$result = createConnection::dbQuery($sql);
	if(createConnection::dbNumRows($result)==1)
	{
		$errorMessage = 'Username is already exist, please try another email.';
		return $errorMessage;
	}
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
		
	header('Location: thankyou.php');
	exit;	
}

// Complete Profile of User
function doCompleteProfile()
{
	$fname 	= $_POST['input_fname'];
	$lname 	= $_POST['input_lname'];
	$pwd 	= $_POST['input_username'];
	$pwd 	= $_POST['input_password'];
	$email 	= $_POST['input_email'];
	$phone 	= $_POST['phone'];
	$dob 	= $_POST['dob'];
	
	$gender = $_POST['gender'];
	$add 	= $_POST['address'];
	$city 	= $_POST['city'];
	$state 	= $_POST['state'];
	$zip	= (int)$_POST['zipcode'];
	
//	$accno 	= (int)$_POST['accno'];
	$type 	= $_POST['acctype'];
	$pin	= (int)$_POST['pin'];
	
	$errorMessage = '';
	
	$sql = "SELECT fname FROM tbl_users WHERE fname = '$fname'";
	$result = dbQuery($sql);
	if (dbNumRows($result) == 1) {
		$errorMessage = 'Username is already exist, please try another name.';
		return $errorMessage;
	}
	
	//first check if account number is already register or not...
	$accno = rand(9999999999, 99999999999);
	$accno = strlen($accno) != 10 ? substr($accno, 0, 10) : $accno;
	/*
	$sql = "SELECT acc_no FROM tbl_accounts WHERE acc_no = $accno";
	$result = dbQuery($sql);
	if (dbNumRows($result) == 1) {
		$errorMessage = 'Account number is already register.';
		return $errorMessage;
	}
	*/
	
	$images = uploadProductImage('pic', SRV_ROOT . 'images/thumbnails/');
	$thumbnail = $images['thumbnail'];
	$insert_id = 0; 
	$sql = "INSERT INTO tbl_users (fname, lname, pwd, email, phone, gender, is_active, utype, pics, bdate)
			VALUES ('$fname', '$lname', PASSWORD('$pwd'), '$email', '$phone', '$gender', 'FALSE', 'USER', '$thumbnail', NOW())";	
	dbQuery($sql);
	$insert_id = dbInsertId();
	
	//now create a user address. 
	$sql = "INSERT INTO tbl_address (user_id, address, city, state, zipcode, country) 
			VALUES ($insert_id, '$add', '$city', '$state', $zip, 'Bangladesh')";
	dbQuery($sql);
	
	//and now create a account table entry...
	$sql = "INSERT INTO tbl_accounts (user_id, acc_no, type, balance, pin, status, bdate) 
			VALUES ($insert_id, $accno, '$type', 0, $pin, 'INACTIVE', NOW())";
	dbQuery($sql);
	
	//now send email
	//email it now.	
	$subject = "Account Registration";
	$to = $email;
	$msg_body = "Dear Customer,<br/><br/>
	This is to inform you that your Account # $accno is register successfully with BAMS and currently in Inactive state. We will soon contact you once it get activate.<br/><br/>In case you need any further clarification for the same, please do get in touch with your Home Branch.<br/><br/>
	Regards,<br/>Admin, BAMS";
	
	$mail_data = array('to' => $to, 'sub' => $subject, 'msg' => 'register', 'body' => $msg_body);
	//send_email($mail_data);
		
	header('Location: aregister.php');
	exit;
	
}

/*
	Create a thumbnail of $srcFile and save it to $destFile.
	The thumbnail will be $width pixels.
*/
function createThumbnail($srcFile, $destFile, $width, $quality = 75)
{
	$thumbnail = '';
	
	if (file_exists($srcFile)  && isset($destFile))
	{
		$size        = getimagesize($srcFile);
		$w           = number_format($width, 0, ',', '');
		$h           = number_format(($size[1] / $size[0]) * $width, 0, ',', '');
		
		$thumbnail =  copyImage($srcFile, $destFile, $w, $h, $quality);
	}
	
	// return the thumbnail file name on success or blank on fail
	return basename($thumbnail);
}

/*
	Copy an image to a destination file. The destination
	image size will be $w X $h pixels
*/
function copyImage($srcFile, $destFile, $w, $h, $quality = 75)
{
    $tmpSrc     = pathinfo(strtolower($srcFile));
    $tmpDest    = pathinfo(strtolower($destFile));
    $size       = getimagesize($srcFile);

    if ($tmpDest['extension'] == "gif" || $tmpDest['extension'] == "jpg")
    {
       $destFile  = substr_replace($destFile, 'jpg', -3);
       $dest      = imagecreatetruecolor($w, $h);
       imageantialias($dest, TRUE);
    } elseif ($tmpDest['extension'] == "png") {
       $dest = imagecreatetruecolor($w, $h);
       imageantialias($dest, TRUE);
    } else {
      return false;
    }

    switch($size[2])
    {
       case 1:       //GIF
           $src = imagecreatefromgif($srcFile);
           break;
       case 2:       //JPEG
           $src = imagecreatefromjpeg($srcFile);
           break;
       case 3:       //PNG
           $src = imagecreatefrompng($srcFile);
           break;
       default:
           return false;
           break;
    }

    imagecopyresampled($dest, $src, 0, 0, 0, 0, $w, $h, $size[0], $size[1]);

    switch($size[2])
    {
       case 1:
       case 2:
           imagejpeg($dest,$destFile, $quality);
           break;
       case 3:
           imagepng($dest,$destFile);
    }
    return $destFile;

}

/*
	Create the paging links
*/
function getPagingNav($sql, $pageNum, $rowsPerPage, $queryString = '')
{
	$result  = mysql_query($sql) or die('Error, query failed. ' . mysql_error());
	$row     = mysql_fetch_array($result, MYSQL_ASSOC);
	$numrows = $row['numrows'];
	
	// how many pages we have when using paging?
	$maxPage = ceil($numrows/$rowsPerPage);
	
	$self = $_SERVER['PHP_SELF'];
	
	// creating 'previous' and 'next' link
	// plus 'first page' and 'last page' link
	
	// print 'previous' link only if we're not
	// on page one
	if ($pageNum > 1)
	{
		$page = $pageNum - 1;
		$prev = " <a href=\"$self?page=$page{$queryString}\">[Prev]</a> ";
	
		$first = " <a href=\"$self?page=1{$queryString}\">[First Page]</a> ";
	}
	else
	{
		$prev  = ' [Prev] ';       // we're on page one, don't enable 'previous' link
		$first = ' [First Page] '; // nor 'first page' link
	}
	
	// print 'next' link only if we're not
	// on the last page
	if ($pageNum < $maxPage)
	{
		$page = $pageNum + 1;
		$next = " <a href=\"$self?page=$page{$queryString}\">[Next]</a> ";
	
		$last = " <a href=\"$self?page=$maxPage{$queryString}{$queryString}\">[Last Page]</a> ";
	}
	else
	{
		$next = ' [Next] ';      // we're on the last page, don't enable 'next' link
		$last = ' [Last Page] '; // nor 'last page' link
	}
	
	// return the page navigation link
	return $first . $prev . " Showing page <strong>$pageNum</strong> of <strong>$maxPage</strong> pages " . $next . $last; 
}


/*
	Upload an image and return the uploaded image name 
*/
function uploadProductImage($inputName, $uploadDir)
{
	$image     = $_FILES[$inputName];
	$imagePath = '';
	$thumbnailPath = '';
	
	// if a file is given
	if (trim($image['tmp_name']) != '') {
		$ext = substr(strrchr($image['name'], "."), 1); //$extensions[$image['type']];

		// generate a random new file name to avoid name conflict
		$imagePath = md5(rand() * time()) . ".$ext";
		
		list($width, $height, $type, $attr) = getimagesize($image['tmp_name']); 

		// make sure the image width does not exceed the
		// maximum allowed width
		
		if (LIMIT_USER_WIDTH && $width > MAX_USER_IMAGE_WIDTH) {
			$result    = createThumbnail($image['tmp_name'], $uploadDir . $imagePath, MAX_USER_IMAGE_WIDTH);
			$imagePath = $result;
		} else {
			$result = move_uploaded_file($image['tmp_name'], $uploadDir . $imagePath);
		}	
		
		if ($result) {
			// create thumbnail
			$thumbnailPath =  md5(rand() * time()) . ".$ext";
			$result = createThumbnail($uploadDir . $imagePath, $uploadDir . $thumbnailPath, THUMBNAIL_WIDTH);
			
			// create thumbnail failed, delete the image
			if (!$result) {
				unlink($uploadDir . $imagePath);
				$imagePath = $thumbnailPath = '';
			} else {
				$thumbnailPath = $result;
			}	
		} else {
			// the product cannot be upload / resized
			$imagePath = $thumbnailPath = '';
		}
		
	}
	
	return array('image' => $imagePath, 'thumbnail' => $thumbnailPath);
}

?>