<!DOCTYPE html>
<html>
<title>PIO Login</title>
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
<h1>Patient Schedule</h1> 
<table class="w3-table-all">
    <thead>
    <tr class="w3-teal">
        <th>Date</th> 
        <th>Time</th> 
        <th>Room</th> 
		<th>Bed</th> 
        <th>Patient</th> 
        <th>Notes</th> 
    </tr> 
    </thead>
    <?php foreach($rows as $row): ?> 
        <tr> 
            <td class="w3-hover-teal"><?php echo htmlentities($row['date'], ENT_QUOTES, 'UTF-8'); ?></td> 
            <td class="w3-hover-teal"><?php echo htmlentities($row['time'], ENT_QUOTES, 'UTF-8'); ?></td> 
			<td class="w3-hover-teal"><?php echo htmlentities($row['room'], ENT_QUOTES, 'UTF-8'); ?></td> 
			<td class="w3-hover-teal"><?php echo htmlentities($row['bed'], ENT_QUOTES, 'UTF-8'); ?></td> 
			<td class="w3-hover-teal"><?php echo htmlentities($row['name'], ENT_QUOTES, 'UTF-8'); ?></td> 
			<td class="w3-hover-teal"><?php echo htmlentities($row['notes'], ENT_QUOTES, 'UTF-8'); ?></td> 
	    </tr> 
        </tr> 
        </tr> 
    <?php endforeach; ?> 
</table> 
</body>
</html