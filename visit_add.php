<!DOCTYPE html>
<html>
<title>PIO Schedule Visit</title>
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
        
        if(empty($_POST['doctorid']))
        {
            die("Enter a doctor.");
        } 
         
        
        if(empty($_POST['patientid']))
        { 
            die("Enter a patient.");
        } 
         

       
        $query = " 
            INSERT INTO scheduledvisit ( 
                patientid, 
                doctorid, 
                date, 
                time,
				room,
				bed,
                notes
            ) VALUES ( 
                :patientid, 
                :doctorid, 
                :date, 
                :time,
				:room,
                :bed,
                :notes
            ) 
        ";
       if($_POST['doctorid']==="Dillon Small") $did=1;
	   else $did = $_POST['doctorid'];
	   if($_POST['patientid']==="Bryon Reynolds") $pid=5;
	   else $did = $_POST['patientid'];
	   
       $query_params = array( 
            ':patientid' => $pid,
            ':doctorid' => $did,
            ':date' => $_POST['date'],
            ':time' => $_POST['time'],
			':room' => $_POST['room'],
            ':bed' => $_POST['bed'],
            ':notes' => $_POST['notes']
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

    <h1 class="w3-jumbo"><b>Schedule Visit</b></h1>
    <form action="visit_add.php" style="margin-left:10px" method="post">
        Patient:<br />
        <input type="text" name="patientid" value="" />
        <br /><br />
        Doctor:<br />
        <input type="text" name="doctorid" value="" />
        <br /><br />
        Date:<br />
        <input type="date" name="date" value="" />
        <br /><br />
        Time:<br />
        <input type="time" name="time" value="" />
        <br /><br />
        Room:<br />
        <input type="text" name="room" value="" />
        <br /><br />
        Bed:<br />
        <input type="text" name="bed" value="" />
		<br /><br />
        Notes:<br />
        <input type="text" name="notes" value="" />
        <br /><br />
        <input  class="w3-btn" type="submit" value="Schedule Visit" />
    </form>
</div>

</body>
</html>
