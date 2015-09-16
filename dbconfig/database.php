<?php
// define('DB_SERVER','localhost');
// define('DB_USER','root');
// define('DB_PASS' ,'');
// define('DB_NAME', 'demo_project_db');

/**
* Create DB Connection
*/
class createConnection
{
	private static $host="localhost";
    private static $username="root";    // specify the sever details for mysql
    private static $password="";
    private static $database="demo_project_db";
    private static $myconn;
		
	public static function connectToDatabase() // create a function for connect database
    {
        $conn= new mysqli(self::$host, self::$username, self::$password, self::$database);

        if ($conn->connect_error) {
		  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
		}
		else{			
			self::$myconn = $conn;
            //echo "Connection established";
		}
        return self::$myconn;
    }

    public static function closeConnection() // close the connection
    {
        mysqli_close(self::$myconn);
        //echo "Connection closed";
    }

    public static function dbQuery($sql)
	{
		$result = self::$myconn->query($sql);//mysql_query($sql) or die(mysql_error());
		if($result === false) {
		    trigger_error('Wrong SQL: ' . $sql . ' Error: ' . self::$myconn->error, E_USER_ERROR);
		}
		return $result;	
	}

	public static function dbNumRows($result)
	{
		return $result->num_rows;// mysql_num_rows($result);
	}

	public static function dbInsertId()
	{
		return self::$myconn->insert_id;//mysql_insert_id();
	}

	public static function realEscapeString($input)
	{
		return self::$myconn->real_escape_string($input);
	}

	public static function dbFetchAssoc($result)
	{
		return $result->fetch_assoc();//mysql_fetch_assoc($result);
	}
	public static function dbFetchArray($result, $resultType = MYSQL_NUM) {
		return mysqli_fetch_array($result, $resultType);
	}

}
	

	// function dbAffectedRows()
	// {
	// 	global $dbConn;
	// 	return $dbConn->affected_rows;//mysql_affected_rows($dbConn);
	// }

	// function dbFetchArray($result, $resultType = MYSQL_NUM) {
	// 	return mysqli_fetch_array($result, $resultType);
	// }

	// function dbFetchAssoc($result)
	// {
	// 	return $result->fetch_assoc();//mysql_fetch_assoc($result);
	// }

	// function dbFetchRow($result) 
	// {
	// 	return $result->fetch_row();//mysql_fetch_row($result);
	// }

	// function dbFreeResult($result)
	// {
	// 	return mysqli_free_result($result);
	// }

	// function dbNumRows($result)
	// {
	// 	return $result->num_rows;// mysql_num_rows($result);
	// }

	// function dbSelect($dbName)
	// {
	// 	return $dbConn->select_db($dbName);//mysql_select_db($dbName);
	// }

	// function dbInsertId()
	// {
	// 	return $dbConn->insert_id;//mysql_insert_id();
	// }
?>