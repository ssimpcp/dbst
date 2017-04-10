<?php
	require_once('db_connect.php');	

	session_cache_limiter('');
	session_start();

	//receive ID, PW
	$id = $_POST['loginID'];
	$pw = $_POST['loginPASS'];

	//get id from database to check the input id
	$query = "SELECT user_id, user_pw FROM user WHERE user_id = :id";
	$stmt = $conn->prepare($query);
	$stmt->bindParam(':id', $id);
	$stmt->execute();
	$getID = $stmt->fetch(PDO::FETCH_NUM);
	
	//if ID exist,
	if($getID[0]) {

		// if ID and PW are correct,
		if($pw == $getID[1]) {
			$key = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789^/';
			for($i=0;$i<=63;$i++)
				$token = $key[rand(0,63)];

			// update token in db
			$query = "UPDATE user SET token=:token WHERE user_id=:id";
			$stmt = $conn->prepare($query);
			$stmt->bindParam(':token', $token);
			$stmt->bindParam(':id', $id);
			$stmt->execute();

			// save the token in session
			$_SESSION['token'] = $token;
			header('Location: ./home.php');
		}
		else {
			echo("
				<script> window.alert('Password error.') </script> ");
			header('Location: ./login.php');
		}
	}
	else {
		echo("
			<script> window.alert('ID isn't registered or exist.') </script> ");
		header('Location: ./login.php');
	}
?>




