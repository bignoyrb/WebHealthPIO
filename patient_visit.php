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


<body>
<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-bar-block w3-teal w3-collapse w3-top" style="z-index:3;width:250px" id="mySidebar">
    <div class="w3-container w3-display-container w3-padding-13">
        <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright"></i>
        <h3 class="w3-wide w3-text-black"><b>Patient<br>Name</b></h3>
        <img src="photos/mario-2.png" class="w3-round" alt="patientpic" style="padding:8px;width:80%">
    </div>

    <div class="w3-padding-13  w3-text-black" >
        <a class="w3-bar-item ">Height: 5'0"</a>
        <a class="w3-bar-item ">Weight 193 lbs</a>
        <a class="w3-bar-item ">Health Card Number:<br> 123 456 789</a>
        <a class="w3-bar-item ">DOB: 09/12/1981</a>
        <a class="w3-bar-item ">Blood Preasure: 200/80</a>
        <div class="w3-dropdown-hover">
            <button class="w3-button">Other Conditions: <i class="fa fa-caret-down"></i></button>
            <div class="w3-dropdown-content w3-bar-block">
                <a class="w3-bar-item w3-button">Condition 1</a>
                <a class="w3-bar-item w3-button">Condition 2</a>
            </div>
        </div>
    </div>

    <div class="w3-padding-16 w3-text-black w3-bar-block" >
        <a href="#" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-grey">Medical History</a>
        <a href="#" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-grey">Perscriptions</a>
        <a href="#" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-grey">Referrals</a>
        <a href="#" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-grey">Imaging</a>
        <a href="#" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-grey">Blood Work/Tests</a>
        <a href="#" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-grey">Physican Notes</a>
    </div>

    
</nav>

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
        <p class="w3-left">Dr. Name</p>
        <p class="w3-right" id="date"></p>
    </header>

</div>

<div>
    <form class="w3-container" style="margin-left:250px" action="/action_page.php">
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
            <input class="w3-input w3-border" name="appointment" type="text"></p>

        <p>
            <button class="w3-button w3-black w3-hover-grey w3-xxlarge w3-left">Finish Visit <i class="w3-margin-left fa fa-check w3-xxlarge"></i></button>
            <a href="schedule.php" class="w3-button w3-black w3-hover-grey w3-xxlarge w3-right">Home<i class="w3-margin-left fa fa-home w3-xxlarge"></i></a></p>
    </form>

    
   

</div>

   
<script>
var d = new Date();
document.getElementById("date").innerHTML = d.toDateString();
</script>


</body>
</html