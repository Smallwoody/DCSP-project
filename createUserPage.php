<!DOCTYPE html>
<html>
<title>Sign Up Page</title>

<meta charset="UTF-8">
<?php require_once 'stylesheets.php' ?>
<style>
table td {
  display: table-cell;
  vertical-align: baseline;
}
</style>
<body>

<!-- Navbar -->
<?php require_once 'navbar.php' ?>

<!-- First Grid -->
<form method="post" action="createUserPage.php">
<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-center">
      <h1>Sign Up<?php $error ?></h1>
      <h5 class="w3-padding-32">
<?php
    $error = $userName = $password = "";
    require_once 'login.php';
    require_once 'User.php';
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(isset($_SESSION['isManager']))
    {
        routeUser();
    }
    $userName = "";
    $newUser = new User($userName);
    $UserNameTaken = 0;
    $isnewUsersSignedup = 0;
    $emptyfield = 0;
    $successfulRun = 0;
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_REQUEST['submit']))
        {
            if($_REQUEST['fname'] != "" && 
            $_REQUEST['lname'] != "" && 
            $_REQUEST['email'] != "" && 
            $_REQUEST['username'] != "" && 
            $_REQUEST['password'] != "")
            {

                $username = sanitizeString($_REQUEST['username']);
                $newUser = new user($username);
                if($newUser->CheckUserName())
                {
                    $newUser->FirstName = sanitizeString($_REQUEST['fname']);
                    $newUser->LastName = sanitizeString($_REQUEST['lname']);
                    $newUser->Email = sanitizeString($_REQUEST['email']);
                    $newUser->PasswordToken = SaltPswd(sanitizeString($_REQUEST['password']));
                    //edit this in the other file
                    $isnewUsersSignedup = $newUser->CreateAccount();
                
                    $_SESSION['FirstName'] = $newUser->FirstName;
                    $_SESSION['LastName'] = $newUser->LastName;
                    $_SESSION['Email'] = $newUser->Email;
                    $_SESSION['pswd_token'] = $newUser->PasswordToken;//$token;
                   
                    if(isset($_SESSION['isManager']))
                    {
                    routeUser();
                    }
                $successfulRun = 1;
                }
                else
                {
                    $UserNameTaken = True;
                }
            }
            else
            {
                $emptyfield = 1;
            }
        }
    }
    function sanitizeString($var)
    {
        $var = stripslashes($var);
        $var = strip_tags($var);
        $var = htmlentities($var);
        return $var;
    }
    function routeUser()
    {
        if(isset($_SESSION['isAdmin'] ))
        {
            header('Location: user_page.php');
            exit();
        }
    }

    function SaltPswd($p)
    {
        $salt1 = "qm&h*";
        $salt2 = "pg!@";
        return hash('ripemd128', "$salt1$p$salt2");
    }
?>
          <table class="w3-table">
                <tr>
                    <td><label>First Name: </label></td>
                    <td><input type="text" name="fname" value="<?php echo $_REQUEST['fname']; ?>"></td>
                </tr>
                <tr>
                    <td><label>Last Name: </label></td>
                    <td><input type="text" name="lname" value="<?php echo $_REQUEST['lname']; ?>"></td>
                </tr>
                <tr>
                    <td><label>User Name: </label></td>
                    <td><input type="text" name="username" value="<?php echo $_REQUEST['username']; ?>"></td>
                </tr>
                <tr>
                    <td><label>Email: </label></td>
                    <td><input type="text" name="email" value="<?php echo $_REQUEST['email']; ?>"></td>
                </tr>
                <tr>
                    <td><label>Password: </label></td>
                    <td><input type="password" name="password"></td>
                </tr>
            </table>
            <p><input class="w3-button w3-blue-grey" type="submit" name="submit" value="Sign Up"></p>
            <div class="w3-container">
                <h5><?php
                        if ($UserNameTaken){
                            echo '<div class="w3-container w3-red">Username taken please try another</div>';
                        }
                        if ($emptyfield){
                            echo '<div class="w3-container w3-red">Please fill out all fields</div>';
                        }

                        if($successfulRun){
                            header('Location: loginPage.php');
                        }
                    ?>
                </h5>
            </div>

        </p></p>
        </p>
    </div>
  </div>
</div>
</form>

<div class="w3-container w3-black w3-center w3-opacity w3-padding-64">
    <h1 class="w3-margin w3-xlarge">Quote of the day:  Live Life</h1>
</div>