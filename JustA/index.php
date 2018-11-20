<!DOCTYPE html>
<html>
<title>Landing Page</title>
<meta charset="UTF-8">
<?php require_once 'stylesheets.php' ?>
<style>
    body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
    .w3-bar,h1,button {font-family: "Montserrat", sans-serif}
    .fa-anchor,.fa-coffee {font-size:200px}
</style>
<body>

<!---Nav bar---->
<?php require_once 'navbar.php' ?>

<!---- body --->
<div class="w3-row-padding w3-light-grey w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-third w3-center">
      <i class="fa fa-coffee w3-padding-64 w3-text-blue-grey w3-margin-right"></i>
    </div>

    <div class="w3-twothird">
      <h1>About Us</h1>
      <h5 class="w3-padding-32">Just A Pothole! Services will be an ecommerce site that will support the sale of services for pothole repair and related road work. </h5>

      <p class="w3-text-grey">The website will display geographical locations inside the United States where services are offered. 
      Customers will be able to choose from a list of packages, individual services, or browse keyword searches to find specific repair work. </p>
    </div>
  </div>
</div>
<!---- footer ---->
<footer class="w3-container w3-black w3-padding-64 w3-center w3-opacity">  
  <div class="w3-xlarge w3-padding-32">
    <h1 class="w3-margin w3-xlarge">Quote of the day: live life</h1>
 </div>
 <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer>
<div class="w3-container w3-black w3-center w3-opacity w3-padding-64">
   
</div>
</body>
</html>