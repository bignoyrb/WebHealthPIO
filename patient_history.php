<!DOCTYPE html>
<html>
<title>PIO Patient History</title>
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
			diagnoses, 
			treatment,
			notes,
			patient.name,
			users.username
        FROM visit 
		INNER JOIN patient ON visit.patientid = patient.id
		INNER JOIN users ON visit.doctorid = users.id
		WHERE visit.patientid =:pid 
    "; 
    $query_params = array( 

         ':pid' => $_GET['pid']
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
    <p class="w3-left">Patient History </p>
    <p class="w3-button w3-black w3-hover-grey w3-xlarge w3-right" onclick="goBack()">Back <i class="w3-margin-left fa fa-arrow-left w3-xlarge"></i></p>
</header>

<?php foreach($rows as $row): ?>
    <div class="w3-padding-16 w3-text-black w3-bar-block w3-large" >
        <a href="#" class="w3-bar-item w3-button w3-teal w3-hover-grey">Doctor: <?php echo htmlentities($row['username'], ENT_QUOTES, 'UTF-8'); ?><br>
            Date: <?php echo htmlentities($row['date'], ENT_QUOTES, 'UTF-8'); ?><br>
            Diagnoses: <?php echo htmlentities($row['diagnoses'], ENT_QUOTES, 'UTF-8'); ?><br>
            Treatment: <?php echo htmlentities($row['treatment'], ENT_QUOTES, 'UTF-8'); ?><br>
            Notes: <?php echo htmlentities($row['notes'], ENT_QUOTES, 'UTF-8'); ?></a>
    </div>
<?php endforeach; ?>

<script>
    function goBack() {
        window.history.back();
    }
</script>


</body>
</html