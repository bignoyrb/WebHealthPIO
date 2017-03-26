
<?php

require("common.php");


if(empty($_SESSION['user']))
{

    header("Location: login.php");


    die("Redirecting to login.php");
}
header("Location: schedule.php");


$query = " 
        SELECT 
			patientid,
			doctorid,
			date,
			time,
			notes
        FROM scheduledvisit 
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
foreach ($rows[0] as $key => $value) {
	eval( "$$key = \"$value\";");
}


$query = " 
        INSERT INTO visit (patientid,doctorid,date,time,notes,diagnoses,treatment)
		VALUES (:pid,:did,:date,:time,:notes,:diagnoses,:treatment)
    ";

$query_params = array(
    ':pid' => $patientid,
	':did' => $doctorid,
	':date' => $date,
	':time' => $time,
	':notes' => $notes,
	':diagnoses' => htmlspecialchars($_POST['diagnosis']),
	':treatment' => htmlspecialchars($_POST['treatment'])
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

if(htmlspecialchars($_POST['prescription'])!="") {

	$query = " 
			INSERT INTO perscription (drugname,dose,patientid,doctorid,date)
			VALUES (:drug,:dose,:pid,:did,:date)
		";

	$query_params = array(
		':drug' => htmlspecialchars($_POST['prescription']),
		':dose' => htmlspecialchars($_POST['dosage']),
		':pid' => $patientid,
		':did' => $doctorid,
		':date' => $date
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
}


if(htmlspecialchars($_POST['appointment'])!="") {

	$query = " 
			INSERT INTO scheduledvisit (patientid,doctorid,date,time,room,bed,notes)
			VALUES (:pid,:did,:date,:time,:room,:bed,:notes)
		";

	$query_params = array(
		':date' => htmlspecialchars($_POST['appointment']),
		':pid' => $patientid,
		':did' => $doctorid,
		':time' => htmlspecialchars($_POST['time']),
		':room' => "",
		':bed' => "",
		':notes' => htmlspecialchars($_POST['fnotes']),
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
}

$query = " 
        DELETE
        FROM scheduledvisit 
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
die();
?>
<html>
<body>

</body>
</html>
