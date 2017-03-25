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



$query = " 
        SELECT 
            name,
			sex,
			height,
			weight,
			healthcard,
			dob
        FROM patient 
        WHERE id = :patid
	  
    ";

$query_params = array(
    ':patid' => $_GET['patientid']
);

try
{

    $stmt = $db->prepare($query);
    $stmt->execute($query_params);
}
catch(PDOException $ex)
{

    die("Failed to run query: " . $ex->getMessage());
}


$rows = $stmt->fetchAll();

?>


<body>
<!-- Sidebar/menu -->

<?php foreach($rows as $row): ?>
<nav class="w3-sidebar w3-bar-block w3-teal w3-collapse w3-top" style="z-index:3;width:250px" id="mySidebar">
    <div class="w3-container w3-display-container w3-padding-8">
        <h3 class="w3-wide w3-text-black"><b><?php echo htmlentities($row['name'], ENT_QUOTES, 'UTF-8'); ?></b></h3>
        <img src="photos/mario-2.png" class="w3-round" alt="patientpic" style="padding:8px;width:60%">
    </div>


    <div class="w3-padding-8  w3-text-black" >
        <a class="w3-bar-item ">Height: <?php echo htmlentities($row['height'], ENT_QUOTES, 'UTF-8'); ?> cm</a>
        <a class="w3-bar-item ">Weight <?php echo htmlentities($row['weight'], ENT_QUOTES, 'UTF-8'); ?> lbs</a>
        <a class="w3-bar-item ">Health Card Number:<br> <?php echo htmlentities($row['healthcard'], ENT_QUOTES, 'UTF-8'); ?></a>
        <a class="w3-bar-item ">DOB: <?php echo htmlentities($row['dob'], ENT_QUOTES, 'UTF-8'); ?></a>
        <a class="w3-bar-item ">Sex: <?php echo htmlentities($row['sex'], ENT_QUOTES, 'UTF-8'); ?></a>

    </div>

    <div class="w3-padding-8 w3-text-black w3-bar-block" >
        <a href="#" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-grey">Medical History</a>
        <a href="#" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-grey">Prescriptions</a>
        <a href="#" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-grey">Referrals</a>
        <a href="#" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-grey">Imaging</a>
        <a href="#" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-grey">Blood Work/Tests</a>
        <a href="#" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-grey">Physician Notes</a>
    </div>

    <div class="w3-padding-8 w3-text-black w3-bar-block" >
        <a href="schedule.php" class="w3-bar-item w3-button w3-hover-grey">Patient Schedule<i class="w3-margin-left fa fa-home w3-large"></i></a>
        <a href="logout.php" class="w3-bar-item w3-button w3-hover-grey">Log Out<i class="w3-margin-left fa fa-sign-out w3-large"></i></a>
    </div>


</nav>

<?php endforeach; ?>

<!-- Top menu on small screens -->
<header class="w3-bar w3-top w3-hide-large w3-black w3-xlarge">
    <div class="w3-bar-item w3-padding-24 w3-wide">Patient name</div>
    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-padding-24 w3-right " onclick="w3_open()"><i class="fa fa-bars"></i></a>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>


<div class="w3-main w3-black" style="margin-left:250px">

    <!-- Push down content on small screens -->
    <div class="w3-hide-large" style="margin-top:83px"></div>

    <!-- Top header -->
    <header class="w3-container w3-xxlarge">
        <p class="w3-left"><?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p class="w3-right" id="date"></p>
    </header>

</div>

<div>
    <form class="w3-container" style="margin-left:250px" action="patient_visit.php" method="post">
        <h2 class=" w3-text-black w3-xlarge">Complaint:</h2>
        <p><b>Patient complaint goes here</b></p>
        <p>
            <label class="w3-text-black"><b>Diagnosis:</b></label>
            <input class="w3-input w3-border" name="diagnosis" type="text"></p>
        <p>
            <label class="w3-text-black"><b>Treatment:</b></label>
            <input class="w3-input w3-border" name="treatment" type="text"></p>
        <p>
            <label class="w3-text-black"><b>Prescription:</b></label>
            <input class="w3-input w3-border" name="prescription" type="text"></p>

        <p>
            <label class="w3-text-black"><b>Referral:</b></label>
            <input class="w3-input w3-border" name="referral" type="text"></p>

        <p>
            <label class="w3-text-black"><b>Follow Up Appointment:</b></label>
            <input class="w3-input w3-border" name="appointment" type="date"></p>

        <p>
            <button class="w3-button w3-black w3-hover-grey w3-xxlarge w3-left">Finish Visit <i class="w3-margin-left fa fa-check w3-xxlarge"></i></button>
        </p>

    </form>


</div>

   
<script>
var d = new Date();
document.getElementById("date").innerHTML = d.toDateString();
</script>





</body>
</html