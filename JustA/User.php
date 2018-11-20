<?php
class user
{
    public $FirstName = "";
    public $LastName = "";
    public $UserName = "";
    public $Email = "";
    public $Phone = "";
    public $PasswordToken = "";
    public $isManager = false;
    public $CardInfo = "";
    public $BillingAddr = "";

	function __construct($foundUserName)
	{
		$this->UserName = $foundUserName;
	}

    function CheckUserName()
    {
        require "login.php";
        $conn = new mysqli($hn, $un, $pw, $db);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $query  = "SELECT UserName FROM users where UserName = '$this->UserName'";
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
    // function DeleteAccount($UserToBeRemoved)
    // {
    //     require 'login.php';
    //     $conn = new mysqli($hn, $un, $pw, $db);
    //     if (!$conn) {
    //         die("Connection failed: " . mysqli_connect_error());
    //     }
    //     $query = "UPDATE `Users` SET `AccountStatus`='Removed' WHERE Users.UserName = '$UserToBeRemoved'";
    //     $result = $conn->query($query);
    //     $conn->close();
    //     if($result)
    //         return "Successfully Deleted";
    //     else 
    //         return "Error Deleting User";
    // }
    function CreateAccount()
	{
        require 'login.php';
        $conn = new mysqli($hn, $un, $pw, $db);
        if (!$conn) {

            die("Connection failed: " . mysqli_connect_error());
        }
        $query = "INSERT INTO `Users`
                    (
                        `FirstName`,
                        `LastName`,
                        `Email`,
                        `Phone`,
                        `Password`
                        `CardInfo`,
                        `BillingAddr`
                    )
                  VALUES (
                      '$this->FirstName',
                      '$this->LastName',
                      '$this->UserName',
                      '$this->Email',
                      '$this->Phone',
                      '$this->PasswordToken',
                      '$this->CardToken',
                      '$this->BillingAddr'
                        )";
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

        $query = "select *
                    from Users
                    where UserName = '$username' and
                    Password = '$pwtoken'";

        $result = $mysqli->query($query);
        //echo $result;
        $row = $result->fetch_array(MYSQLI_ASSOC);

        if( $row["UserName"] != "" && $row['Password']== $pwtoken)
        {
            $this->FirstName = $row["FirstName"];
            $this->LastName = $row["LastName"];
            $this->UserName = $row["UserName"];
            $this->Email = $row["Email"];
            $this->Phone = $row["Phone"];
            $this->PasswordToken = $row["Password"];
            $this->isManager = $row["isManager"];
            $result->close();
            $mysqli->close();
        }
        return $this;
    }
}
?>
