


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
            if(strcmp($_SESSION['user']['username'],'dasmall')==0){
				header("Location: private.php"); 
				die("Redirecting to: private.php"); 
			} else{
				header("Location: private.php"); 
				die("Redirecting to: private.php"); 
			}
		} 
        else 
        { 
          print("Login Failed."); 
             
          $submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8'); 
        } 
    } 
  
?> 
<h1>Test Login</h1> 
<form action="login.php" method="post"> 
    Username:
    <input type="text" name="username" value="<?php echo $submitted_username; ?>" /> 
    <br /><br /> 
    Password:
    <input type="password" name="password" value="" /> 
    <br /><br /> 
    <input type="submit" value="Login" /> 
</form> 
<a href="register.php">Register</a>

