<!DOCTYPE html>
<html>
<title>PIO Add Doctor</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
    body, h1{font-family: "Montserrat", sans-serif}
</style>


<?php

  
    require("common.php"); 
     
   
    if(!empty($_POST)) 
    { 
        
        if(empty($_POST['username'])) 
        { 
           
            die("Enter a username."); 
        } 
         
        
        if(empty($_POST['password'])) 
        { 
            die("Enter a password."); 
        } 
         
       
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
        { 
            die("Invalid E-Mail Address"); 
        } 
         
      
        $query = " 
            SELECT 
                1 
            FROM users 
            WHERE 
                username = :username 
        "; 
         
       
        $query_params = array( 
            ':username' => $_POST['username'] 
        ); 
         
        try 
        { 
            
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
          
            die("Failed to run query: " . $ex->getMessage()); 
        } 
         
       
        $row = $stmt->fetch(); 
         
      
        if($row) 
        { 
            die("This username is already used"); 
        } 
         
        
        $query = " 
            SELECT 
                1 
            FROM users 
            WHERE 
                email = :email 
        "; 
         
        $query_params = array( 
            ':email' => $_POST['email'] 
        ); 
         
        try 
        { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            die("Failed to run query: " . $ex->getMessage()); 
        } 
         
        $row = $stmt->fetch(); 
         
        if($row) 
        { 
            die("This email address is already registered"); 
        } 
         
       
        $query = " 
            INSERT INTO users ( 
                username, 
                password, 
                salt, 
                email 
            ) VALUES ( 
                :username, 
                :password, 
                :salt, 
                :email 
            ) 
        "; 
         
       
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
         
        $password = hash('sha256', $_POST['password'] . $salt); 
         
      
        for($round = 0; $round < 65536; $round++) 
        { 
            $password = hash('sha256', $password . $salt); 
        } 
         
       
        $query_params = array( 
            ':username' => $_POST['username'], 
            ':password' => $password, 
            ':salt' => $salt, 
            ':email' => $_POST['email'] 
        ); 
         
        try 
        { 
           
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            
            die("Failed to run query: " . $ex->getMessage()); 
        } 
         
       
        header("Location: private.php");
        die("Redirecting to private.php");
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

<div class="w3-main w3-padding-large" style="margin-left:450px">

    <header class="w3-container w3-padding-64 w3-center" id="home">

    </header>

    <h1 class="w3-jumbo"><b>Add Doctor</b></h1>
    <form action="register.php" style="margin-left:10px" method="post">
        Username:<br />
        <input type="text" name="username" value="" />
        <br /><br />
        E-Mail:<br />
        <input type="text" name="email" value="" />
        <br /><br />
        Password:<br />
        <input type="password" name="password" value="" />
        <br /><br />
        <input  class="w3-btn" type="submit" value="Add Doctor" />
    </form>
</div>

</body>
</html>
