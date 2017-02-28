<?php 

    
    require("common.php"); 
     
  
    if(empty($_SESSION['user'])) 
    { 
       
        header("Location: login.php"); 
         
       
        die("Redirecting to login.php"); 
    } 
     
  
?> 

<a href="memberlist.php">List of all Accounts</a><br /> 
<a href="register.php">Add Account</a><br /> 
<a href="logout.php">Logout</a>