<!DOCTYPE html>
<html>
<title>Member List</title>
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
            id, 
            username, 
            email 
        FROM users 
    "; 
     
    try 
    { 
       
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } 
    catch(PDOException $ex) 
    { 
      
        die("Failed to run query: " . $ex->getMessage()); 
    } 
         
  
    $rows = $stmt->fetchAll(); 
?> 
<h1>Memberlist</h1> 
<table class="w3-table-all">
    <tr class="w3-teal"> 
        <th>ID</th> 
        <th>Username</th> 
        <th>E-Mail Address</th> 
    </tr> 
    <?php foreach($rows as $row): ?> 
        <tr> 
            <td class="w3-hover-teal"><?php echo $row['id']; ?></td> <!-- htmlentities is not needed here because $row['id'] is always an integer --> 
            <td class="w3-hover-teal"><?php echo htmlentities($row['username'], ENT_QUOTES, 'UTF-8'); ?></td> 
            <td class="w3-hover-teal"><?php echo htmlentities($row['email'], ENT_QUOTES, 'UTF-8'); ?></td> 
        </tr> 
        </tr> 
        </tr> 
    <?php endforeach; ?> 
</table> 
<a href="private.php">Go Back</a><br />

