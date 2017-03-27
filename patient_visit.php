<!DOCTYPE html>
<html>
<title>Patient Visit</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="jquery-3.2.0.min.js"></script>
<script src="jquery.easy-autocomplete.min.js"></script>
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
body, h1,h2,h3{font-family: "Montserrat", sans-serif}

</style>
<script>
var all = [];
function getauto(id) {
		$.getJSON("http://mapi-us.iterar.co/api/autocomplete?query="+id+"&format=json&callback=?",
		function(data) {
			console.log(data.suggestions);
			all = all.concat(data.suggestions);
			var uniqueNames = [];
			$.each(all, function(i, el){
				if($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
			});
			all = uniqueNames;
			console.log(all);
			var options = {
			  data: all,


			  list: {	
				match: {
				  enabled: true
				}
			  },

			  theme: "square"
			};
			
			console.log(options);

			
			
			$("#scrip").easyAutocomplete(options); 
			$('#scrip').focus();
		}); 
}
</script>
<?php

require("common.php");


if(empty($_SESSION['user']))
{

    header("Location: login.php");


    die("Redirecting to login.php");
}



$query = " 
        SELECT 
            notes,
            room,
            bed,
            patient.name,
			patient.sex,
			patient.height,
			patient.weight,
			patient.healthcard,
			patient.dob,
			patient.id
        FROM scheduledvisit 
		INNER JOIN patient ON scheduledvisit.patientid = patient.id
        WHERE scheduledvisit.id = :id
	  
    ";

$query_params = array(
    ':id' => $_GET['id']

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
        <a href="patient_history.php?pid=<?php echo htmlentities($row['id'], ENT_QUOTES, 'UTF-8'); ?>"  class="w3-bar-item w3-button w3-hover-grey">Medical History</a>
        <a href="perscription.php?pid=<?php echo htmlentities($row['id'], ENT_QUOTES, 'UTF-8'); ?>"  class="w3-bar-item w3-button w3-hover-grey">Prescriptions</a>
        <a href="referral.php?pid=<?php echo htmlentities($row['id'], ENT_QUOTES, 'UTF-8'); ?>"  class="w3-bar-item w3-button w3-hover-grey">Referrals</a>
        <a href="image.php?pid=<?php echo htmlentities($row['id'], ENT_QUOTES, 'UTF-8'); ?>" class="w3-bar-item w3-button w3-hover-grey">Imaging</a>
        <a href="test.php?pid=<?php echo htmlentities($row['id'], ENT_QUOTES, 'UTF-8'); ?>" class="w3-bar-item w3-button w3-hover-grey">Blood Work/Tests</a>
    </div>

    <div class="w3-padding-16 w3-text-black w3-bar-block" >
        <a href="schedule.php" class="w3-bar-item w3-button w3-hover-grey">Patient Schedule<i class="w3-margin-left fa fa-home w3-large"></i></a>
        <a href="logout.php" class="w3-bar-item w3-button w3-hover-grey">Log Out<i class="w3-margin-left fa fa-sign-out w3-large"></i></a>
    </div>


</nav>



<div class="w3-main w3-black" style="margin-left:250px">

    <!-- Push down content on small screens -->
    <div class="w3-hide-large" style="margin-top:83px"></div>

    <!-- Top header -->
    <header class="w3-container w3-xlarge">
        <p class="w3-left ">Dr. <?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p class="w3-right " id="date"></p>

    </header>
    <header class="w3-container w3-large">

        <p class="w3-left ">Room: <?php echo htmlentities($row['room'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p class="w3-right">Bed: <?php echo htmlentities($row['bed'], ENT_QUOTES, 'UTF-8'); ?></p>
    </header>

</div>

<div>

	<form class="w3-container" style="margin-left:250px" action="patient_visit_finish.php?id=<?php echo $_GET['id'] ?>" method="post">
        <h2 class=" w3-text-black w3-large">Complaint:<br> <?php echo htmlentities($row['notes'], ENT_QUOTES, 'UTF-8'); ?></h2>
		<p>
            <label class="w3-text-black"><b>Diagnosis:</b></label>
            <input class="w3-input w3-border" name="diagnosis" type="text"></p>
        <p>
            <label class="w3-text-black"><b>Treatment:</b></label>
            <input class="w3-input w3-border" name="treatment" type="text"></p>
        <p>
            <label class="w3-text-black"><b>Prescription:</b></label>
            <input class="w3-input w3-border" id="scrip" name="prescription" type="text" oninput="getauto(this.value);"></p>
		<p>	
			<label class="w3-text-black"><b>Dosage per Day:</b></label>
            <select class="w3-select w3-border" name="dosage" type="text">
                <option value="" disabled selected>Choose your option</option>
                <option value="1X Day">1X Day</option>
                <option value="2X Day">2X Day</option>
                <option value="3X Day">3X Day</option>
                <option value="4X Day">4X Day</option>
                <option value="5X Day">5X Day</option>
            </select>
          </p>

        <p>
            <label class="w3-text-black"><b>Referral:</b></label>
            <input class="w3-input w3-border" name="referral" type="text"></p>
		<p>
            <label class="w3-text-black"><b>Referral Type:</b></label>
            <input class="w3-input w3-border" name="referraltype" type="text"></p>
		<p>
            <label class="w3-text-black"><b>Referral Notes:</b></label>
            <input class="w3-input w3-border" name="referralnotes" type="text"></p>
        <p>
            <label class="w3-text-black"><b>Follow Up Appointment:</b></label>
            <input class="w3-input w3-border" name="appointment" type="date"></p>
        
		<p>
            <label class="w3-text-black"><b>Follow Up Time (Preferred):</b></label>
            <input class="w3-input w3-border" name="time" type="time"></p>
		<p>
            <label class="w3-text-black"><b>Notes for Follow Up:</b></label>
            <input class="w3-input w3-border" name="fnotes" type="test"></p>
        <p>
            <button class="w3-button w3-black w3-hover-grey w3-large w3-left">Finish Visit <i class="w3-margin-left fa fa-check w3-xlarge"></i></button>
        </p>


    </form>
    <?php endforeach; ?>

</div>

<script>
    var d = new Date();
    document.getElementById("date").innerHTML = d.toDateString();
</script>


</body>
</html