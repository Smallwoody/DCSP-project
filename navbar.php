<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<?php
//session_start();
if(isset($_SESSION['username']))
{
echo <<<_end
<div class="w3-top">
  <div class="w3-bar w3-theme-d2 w3-card w3-right-align w3-large">
    <a href="index.php" class="w3-bar-item w3-button w3-padding-large"><i class="fa fa-home"></i></a>
    <a href="" class="w3-bar-item w3-button w3-padding-large">Purchase Services</a>
    <a href="loginPage.php" class="w3-bar-item w3-button w3-padding-large">Login/Create Account</a>
    <a href="contactus.php" class="w3-bar-item w3-button w3-padding-large">Contact Us</a>

_end;
    if($_SESSION['isAdmin']){
        echo '<a href="admin_page.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="Admin Page"><i class="material-icons">settings</i></a>';
    }
  echo <<<_end
  <a href="logout.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="LogOut"><i class="fa fa-remove"></i></a>
 </div>
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
  <div class="w3-bar w3-theme-d2 w3-card w3-right-align w3-large">
    <a href="index.php" class="w3-bar-item w3-button w3-padding-large"><i class="fa fa-home"></i></a>
    <a href="" class="w3-bar-item w3-button w3-padding-large">Purchase Services</a>
    <a href="loginPage.php" class="w3-bar-item w3-button w3-padding-large">Login/Create Account</a>
    <a href="contactus.php" class="w3-bar-item w3-button w3-padding-large">Contact Us</a>
  </div>
</div>
_end;
}
?>
