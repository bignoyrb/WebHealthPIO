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
<h1>Schedule</h1> 
<table> 
    <tr> 
        <th>Date</th> 
        <th>Time</th> 
        <th>Room</th> 
		<th>Bed</th> 
        <th>Patient</th> 
        <th>Notes</th> 
    </tr> 
    <?php foreach($rows as $row): ?> 
        <tr> 
            <td><?php echo htmlentities($row['date'], ENT_QUOTES, 'UTF-8'); ?></td> 
            <td><?php echo htmlentities($row['time'], ENT_QUOTES, 'UTF-8'); ?></td> 
			<td><?php echo htmlentities($row['room'], ENT_QUOTES, 'UTF-8'); ?></td> 
			<td><?php echo htmlentities($row['bed'], ENT_QUOTES, 'UTF-8'); ?></td> 
			<td><?php echo htmlentities($row['name'], ENT_QUOTES, 'UTF-8'); ?></td> 
			<td><?php echo htmlentities($row['notes'], ENT_QUOTES, 'UTF-8'); ?></td> 
	    </tr> 
        </tr> 
        </tr> 
    <?php endforeach; ?> 
</table> 
