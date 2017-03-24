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
     
  
    $submitted_username = ''; 
     

        if(!empty($_POST)) 
    { 
        $query = " 
            SELECT 
                username, 
                password,
                salt
            FROM users 
            WHERE 
                username = :username 
        "; 
         
        $query_params = array( 
            ':username' => $_POST['username'] 
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
         
        $login_ok = false; 
         
       $row = $stmt->fetch(); 
        if($row) 
        { 
          $check_password = hash('sha256', $_POST['password'] . $row['salt']); 
            for($round = 0; $round < 65536; $round++) 
            { 
                $check_password = hash('sha256', $check_password . $row['salt']); 
            } 
             
            if($check_password === $row['password']) 
            { 
               $login_ok = true; 
            } 
			echo $check_password;
        } 
         
        if($login_ok) 
        { 
			$rand_string = md5(rand());
            $query = " 
				UPDATE 
					users 
				SET 
					authtoken = '";
					
			$query .= $rand_string;
			$query .=	"'
				WHERE 
					username = :username 
			"; 
			try 
			{ 
				$stmt = $db->prepare($query); 
				$result = $stmt->execute($query_params); 
			} 
			catch(PDOException $ex) 
			{ 
				die("Failed to run query: " . $ex->getMessage()); 
			} 
			$query = " 
				SELECT 
					username, 
					email,
					authtoken
				FROM users 
				WHERE 
					username = :username 
			"; 
			try 
			{ 
				$stmt = $db->prepare($query); 
				$result = $stmt->execute($query_params); 
			} 
			catch(PDOException $ex) 
			{ 
				die("Failed to run query: " . $ex->getMessage()); 
			} 
			
			$row = $stmt->fetch();
			
			$_SESSION['user'] = $row; 
            if(strcmp($_SESSION['user']['username'],'admin')==0){
				header("Location: private.php"); 
				die("Redirecting to: private.php"); 
			} else{
				header("Location: schedule.php"); 
				die("Redirecting to: schedule.php"); 
			}
		} 
        else 
        { 
          print("Login Failed."); 
             
          $submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8'); 
        } 
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

            <h1 class="w3-jumbo"><b>Login</b></h1>
            <form action="login.php" style="margin-left:10px" method="post">
                <b>Username</b><br />
                <input type="text" name="username" value="<?php echo $submitted_username; ?>" /> 
                <br /><br /> 
                <b>Password<b><br /> 
                <input type="password" name="password" value="" /> 
                <br /><br/>
                <input class="w3-btn" type="submit" value="Login" /> 
            </form> 
    </div>        

    </body>
</html>


