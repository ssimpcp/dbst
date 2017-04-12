<?php
	require_once('db_connect.php');

	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Database Management System</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
	<link href="../css/index.css" rel = "stylesheet" type="text/css">
	<!-- jS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../dbst4.js"></script>
	<script src="https://www.w3schools.com/lib/w3data.js"></script>
    
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
      
        <div class="jumbotron text-center">
                <h1>Database Team Project</h1>
        </div>
		
		<div w3-include-html="navbar.html"></div>
			<script>
				w3IncludeHTML();
			</script>
   	<div class="jumbotrom text-center">
      	<form method="post" action="process_pw.php">	
		<label><br/><br/><br/>PW : <input type="password" name="loginPASS" />&nbsp; &nbsp;</label>
        <input class="btn btn-primary btn-lg" style="padding:2px; width:60px; height:30px; font-size: 13px" type="submit" value="OK"/>
      </form>
     </div>
</body>
</html>
