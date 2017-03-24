<!DOCTYPE html>
<html>
<title>Patient Visit</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
    body, h1,h2,h3{font-family: "Montserrat", sans-serif}

</style>

<?php

    
    require("common.php"); 
     
  
    if(empty($_SESSION['user'])) 
    { 
       
        header("Location: login.php"); 
         
       
        die("Redirecting to login.php"); 
    } 
     
  
?>

<body>

<nav class="w3-sidebar w3-bar-block w3-teal  w3-top" style="z-index:3;width:450px" id="mySidebar">
    <div class="w3-container w3-display-container w3-padding-13">
        <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
        <h3 class="w3-wide w3-xxxlarge w3-text-black"><b>Patient<br>Information<br>Organizer</b></h3>
        <img src="logo.png" class="w3-round" alt="logo" style="padding:32px;width:100%">
    </div>
</nav>

<!-- Top menu on small screens -->
<header class="w3-bar w3-top w3-hide-large w3-black w3-xlarge">
    <div class="w3-bar-item w3-padding-24 w3-wide">Patient name</div>
    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding-24 w3-right " onclick="w3_open()"><i class="fa fa-bars"></i></a>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>


<div class="w3-main w3-padding-large" style="margin-left:450px">

    <header class="w3-container w3-padding-64 w3-center" id="home">

    </header>

    <h1 class="w3-jumbo"><b>Administration Tools</b></h1>

    <div class="w3-padding-8 w3-text-black w3-bar-block" >
        <a href="register.php" class="w3-bar-item w3-button w3-black w3-hover-grey">Add Doctor</a><br>
        <a href="patient_register.php"  class="w3-bar-item w3-button w3-black w3-hover-grey">Add Patient</a><br>
        <a href="#"  class="w3-bar-item w3-button w3-black w3-hover-grey">Add Visit</a><br>
        <a href="logout.php" class="w3-bar-item w3-button w3-black w3-hover-grey">Logout</a>
    </div>

</div>


</body>
</html



<a href="memberlist.php">List of all Accounts</a><br /> 
<a href="edit_account.php">Edit Account</a><br /> 
<a href="logout.php">Logout</a>