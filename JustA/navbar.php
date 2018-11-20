<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<?php
//session_start();
if(isset($_SESSION['username']))
{
echo <<<_end
<div class="w3-top">
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
 <a href="" class="w3-bar-item w3-button w3-padding-large">Purchase Services</a>
    <a href="loginPage.php" class="w3-bar-item w3-button w3-padding-large">Login/Create Account</a>
    <a href="" class="w3-bar-item w3-button w3-padding-large">Contact Us</a>
    <a href="" class="w3-bar-item w3-button w3-padding-large">More Information</a>
<a class="w3-center">JustA</a>
_end;
    if($_SESSION['isAdmin']){
        echo '<a href="admin_page.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="Admin Page"><i class="material-icons">settings</i></a>';
    }
  echo <<<_end
  <a href="logout.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="LogOut"><i class="fa fa-remove"></i></a>
 </div>
</div>

<!-- Navbar on small screens -->
<div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Store</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Messages</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Account Settings</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">My Profile</a>
</div>
_end;
}

else {
  $currentPage = basename($_SERVER['PHP_SELF']);
  if($currentPage == "createUserPage.php")
  {
    $homeColor = "w3-hide-small w3-hover-white";
    $loginColor = "w3-hide-small w3-hover-white";
    $signUpColor = "w3-white";
  }
  else if($currentPage == "loginPage.php")
      {
          $homeColor = "w3-hide-small w3-hover-white";
          $loginColor = "w3-white";
          $signUpColor = "w3-hide-small w3-hover-white";
      }
      else
      {
          $homeColor = "w3-white";
          $loginColor = "w3-hide-small w3-hover-white";
          $signUpColor = "w3-hide-small w3-hover-white";
      }
    echo <<< _end
<div class="w3-top">
  <div class="w3-bar w3-blue-grey w3-card w3-right-align w3-large">
    <!-- <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-grey" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a> -->
    <a href="index.php" class="w3-bar-item w3-button w3-padding-large"><i class="fa fa-home"></i></a>
    <a href="" class="w3-bar-item w3-button w3-padding-large">Purchase Services</a>
    <a href="loginPage.php" class="w3-bar-item w3-button w3-padding-large">Login/Create Account</a>
    <a href="" class="w3-bar-item w3-button w3-padding-large">Contact Us</a>
    <a href="" class="w3-bar-item w3-button w3-padding-large">More Information</a>
  </div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
  </div>
</div>
_end;
}
?>
