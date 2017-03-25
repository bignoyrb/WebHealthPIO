<!DOCTYPE html>
<html>
<title>PIO Patient Schedule</title>
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
     
        
    if(empty($_SESSION['user'])) 
    { 
       
        header("Location: login.php"); 
         
      
        die("Redirecting to login.php"); 
    } 
     
  
    $query = " 
        SELECT 
            date,
			time,
			room,
			bed,
			notes,
			patient.id,
			patient.name
        FROM scheduledvisit 
		INNER JOIN patient ON scheduledvisit.patientid = patient.id
		INNER JOIN users ON scheduledvisit.doctorid = users.id
		WHERE users.username = :username
    "; 
    $query_params = array( 
           ':username' => $_SESSION['user']['username']
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

<header class="w3-container w3-black w3-xlarge">
    <p class="w3-left">Patient Schedule: <?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?> </p>
    <p class="w3-right" id="date"></p>
</header>

<?php foreach($rows as $row): ?>
    <div class="w3-padding-16 w3-text-black w3-bar-block w3-large" >
        <a href="patient_visit.php?patientid=<?php echo htmlentities($row['id'], ENT_QUOTES, 'UTF-8'); ?>"  class="w3-bar-item w3-button w3-teal w3-hover-grey">Name: <?php echo htmlentities($row['name'], ENT_QUOTES, 'UTF-8'); ?><br>
            Date: <?php echo htmlentities($row['date'], ENT_QUOTES, 'UTF-8'); ?><br>
            Time: <?php echo htmlentities($row['time'], ENT_QUOTES, 'UTF-8'); ?><br>
            Room: <?php echo htmlentities($row['room'], ENT_QUOTES, 'UTF-8'); ?><br>
            Bed: <?php echo htmlentities($row['bed'], ENT_QUOTES, 'UTF-8'); ?><br>
            Complaint: <?php echo htmlentities($row['notes'], ENT_QUOTES, 'UTF-8'); ?></a>
    </div>
<?php endforeach; ?>

<script>
    var d = new Date();
    document.getElementById("date").innerHTML = d.toDateString();
</script>


</body>
</html