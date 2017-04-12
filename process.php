<?php
	require_once('db_connect_login.php');	

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

			// save the id and token in session
			$_SESSION['id'] = $id;
			$_SESSION['token'] = $token;
			header('Location: ./index.php');
		}
		else {
			echo "<script>window.alert(\"잘못된 비밀번호를 입력하였습니다.\"); location.href=\"login.php\";</script>";
		}
	}
	else {
		echo "<script type=\"text/javascript\"> window.alert(\"등록되지 않은 ID입니다.\");location.href=\"login.php\";</script>";
	}
	
?>

