<?php
class user
{
    public $FirstName = "";
    public $LastName = "";
    public $Username = "";
    public $Email = "";
    public $PasswordToken = "";
    public $isManager = false;

	function __construct($foundUsername)
	{
		$this->Username = $foundUsername;
	}

    function CheckUsername()
    {
        require "login.php";
        $conn = new mysqli($hn, $un, $pw, $db);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $query  = "SELECT Username FROM users where Username = '$this->Username'";
        $results = $conn->query($query);
        if(mysqli_num_rows($results) == 0){
            $returnResult = true; //no other users with that email
            $conn->close();
            return  $returnResult;
        }
        else {
            $conn->error;
            $returnResult = false; //there is already email in use
        }
        $results->close();
        $conn->close();

        return  $returnResult;
    }
    /*  function DeleteAccount($UserToBeRemoved)
    // {
    //     require 'login.php';
    //     $conn = new mysqli($hn, $un, $pw, $db);
    //     if (!$conn) {
    //         die("Connection failed: " . mysqli_connect_error());
    //     }
    //     $query = "UPDATE `users` SET `AccountStatus`='Removed' WHERE users.Username = '$UserToBeRemoved'";
    //     $result = $conn->query($query);
    //     $conn->close();
    //     if($result)
    //         return "Successfully Deleted";
    //     else 
    //         return "Error Deleting User";
    // }
    */
    function CreateAccount()
	{
        require 'login.php';
        $conn = new mysqli($hn, $un, $pw, $db);
        if (!$conn) {

            die("Connection failed: " . mysqli_connect_error());
        }
        $query = "INSERT INTO `users`
                    (
                        `Username`,
                        `FirstName`,
                        `LastName`,
                        `Email`,
                        `Password`,
                        `isManager`
                    )
                  VALUES (
                      '$this->Username',
                      '$this->FirstName',
                      '$this->LastName',
                      '$this->Email',
                      '$this->PasswordToken',
                      '0')";
        if ($conn->query($query) == True){
            $returnResult = true; //no other users with that name
        }
        else{
            $returnResult = false;
            return $returnResult;
        }
        $conn->close();

		return $returnResult;
    }
    
    function GetInfo($username,$pwtoken){
        require 'login.php';
        $mysqli = new mysqli($hn, $un, $pw, $db);
        if ($mysqli->connect_error) {
            die('Connect Error: ' . $mysqli->connect_error);
        }

        $query = "SELECT *
                    FROM users
                    WHERE Username = '$username' AND
                    Password = '$pwtoken'";

        $result = $mysqli->query($query);
        //echo $result;
        $row = $result->fetch_array(MYSQLI_ASSOC);

        if( $row["Username"] != "" && $row['Password']== $pwtoken)
        {
            $this->FirstName = $row["FirstName"];
            $this->LastName = $row["LastName"];
            $this->Username = $row["Username"];
            $this->Email = $row["Email"];
            $this->PasswordToken = $row["Password"];
            $this->isManager = $row["isManager"];
            $result->close();
            $mysqli->close();
        }
        return $this;
    }
}
?>
