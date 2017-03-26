<!DOCTYPE html>
<html>
<title>PIO Image</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
body, h1{font-family: "Montserrat", sans-serif}

</style>



<header class="w3-container w3-black w3-xlarge">
    <p class="w3-left w3-xlarge">Test Image </p>
    <p class="w3-button w3-black w3-hover-grey w3-xlarge w3-right" onclick="goBack()">Back <i class="w3-margin-left fa fa-arrow-left w3-xlarge"></i></p>
</header>


<img src="<?php echo $_GET['url']; ?>"  >

<script>
    function goBack() {
        window.history.back();
    }
</script>

</body>
</html