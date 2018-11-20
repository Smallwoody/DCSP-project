<?php
$error = $userName = $password = "";
require_once 'login.php';
//require_once 'User.php';
session_start();
if(isset($_SESSION['isAdmin']))
{
    routeUser();
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']))
{
    if(isset($_POST['username'])) $username = sanitizeString($_POST['username']);
    if(isset($_POST['password'])) $password = sanitizeString($_POST['password']);

    $token = SaltPswd($password);
    $mysqli = new mysqli($hn, $un, $pw, $db);
    if ($mysqli->connect_error) {
        die('Connect Error: ' . $mysqli->connect_error);
    }

   $query = "SELECT *
           from Users
           where UserName = '$username' and
           Password = '$token'";
    //echo $query;
    $result = $mysqli->query($query);
    //echo $result;
    $user = $result->fetch_array(MYSQLI_ASSOC);
    $result->close();
    $mysqli->close();

     if($user != "" && $user['Password']== $token)
     {
         //session_start();
         $_SESSION['username'] = $username;
         $_SESSION['userID'] = $user['UserID'];
         $_SESSION['pswd_token'] = $user['Password'];//$token;
         $_SESSION['FirstName'] = $user['FirstName'];
         $_SESSION['LastName'] = $user['LastName'];
         $_SESSION['isManager'] = $user['isManager'];
         $_SESSION['card_token'] = $user['CardInfo'];
         $_SESSION['billingAddr'] = $user['BillingAddr'];
         $user_class = new user($username);
         $user_class->GetInfo($username,$user['Password']);
         routeUser();
     }
     else
     {
         $error = "The username / password combination is not correct.";
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
    //session_start();
    if(isset($_SESSION['isManager'] ))
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

<!DOCTYPE html>
<html>
<title>Login Page</title>
<meta charset="UTF-8">
<?php require_once 'stylesheets.php' ?>
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
.w3-bar,h1,button {font-family: "Montserrat", sans-serif}
.fa-heartbeat,.fa-coffee {font-size:200px}
</style>
<body>

<!-- Navbar -->
<?php require_once 'navbar.php' ?>

<!-- First Grid -->
<form method="post" action="loginPage.php">
<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content w3-center">
    <!-- <div class="w3-twothird"> -->
      <h1>Log In</h1>
      <h5 class="w3-padding-32">

          <p><label>Username: </label>
            <input type="text" name="username" value=<?php $username ?>> <br></p>
            <p><label>Password: </label>
            <input type="password" name="password" value=<?php $password ?>> <br></p>

            <p><input type="submit" value="Log in"></p>

        </h5>
		<span style="color:red"><?php echo $error ?></span>
      <p class="w3-text-grey"><p style="font-style:italic">
            Placeholder for "forgot password" link<br><br>
            <a href="createUserPage.php" class="w3-button w3-grey w3-padding-large">Create Account</a>
        </p></p>
        <!-- <div class="w3-container">
            <h5><?php
                    // if ($error != ""){
                    //     //echo '<div class="w3-container w3-red">Please fill out all fields</div>';
                    //     echo '<div class="w3-container w3-red">'+$error+'</div>';
                    // }
                ?>
            </h5>
        </div> -->
    <!-- </div> -->
  </div>
</div>
</form>

<div class="w3-container w3-black w3-center w3-opacity w3-padding-64">
    <h1 class="w3-margin w3-xlarge">Quote of the day:  Live Life</h1>
</div>


<script>
// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>
</body>
</html>
