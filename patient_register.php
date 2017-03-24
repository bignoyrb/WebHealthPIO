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
        
        if(empty($_POST['name']))
        {
            die("Enter a name.");
        } 
         
        
        if(empty($_POST['sex']))
        { 
            die("Enter a sex.");
        } 
         

       
        $query = " 
            INSERT INTO patient ( 
                name, 
                sex, 
                height, 
                weight,
                healthcard,
                dob
            ) VALUES ( 
                :name, 
                :sex, 
                :height, 
                :weight,
                :healthcard,
                :dob
            ) 
        ";
       
        $query_params = array( 
            ':name' => $_POST['name'],
            ':sex' => $_POST['sex'],
            ':height' => $_POST['height'],
            ':weight' => $_POST['weight'],
            ':healthcard' => $_POST['healthcard'],
            ':dob' => $_POST['dob']
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

    <h1 class="w3-jumbo"><b>Add Patient</b></h1>
    <form action="patient_register.php" style="margin-left:10px" method="post">
        Name:<br />
        <input type="text" name="name" value="" />
        <br /><br />
        Sex:<br />
        <input type="text" name="sex" value="" />
        <br /><br />
        Height:<br />
        <input type="number" name="height" value="" />
        <br /><br />
        Weight:<br />
        <input type="number" name="weight" value="" />
        <br /><br />
        Health Card Number:<br />
        <input type="text" name="healthcard" value="" />
        <br /><br />
        Date of Birth:<br />
        <input type="date" name="dob" value="" />
        <br /><br />
        <input  class="w3-btn" type="submit" value="Add Patient" />
    </form>
</div>

</body>
</html>
