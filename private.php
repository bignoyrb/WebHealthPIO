<?php 

    
    require("common.php"); 
     
  
    if(empty($_SESSION['user'])) 
    { 
       
        header("Location: login.php"); 
         
       
        die("Redirecting to login.php"); 
    } 
     
  
?> 
<?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?>, you can edit the accounts here<br /> 
<a href="memberlist.php">List of all Accounts</a><br /> 
<a href="edit_account.php">Edit Account</a><br /> 
<a href="logout.php">Logout</a>