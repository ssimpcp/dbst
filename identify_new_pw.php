<?php
	require_once('db_connect.php');

	session_cache_limiter('');
	session_start();

	//receive ID, PW
	$token = $_SESSION['token'];
	$newPW = $_POST['newPASS'];
	$again = $_POST['newPASS_again'];

	if($newPW == $again){
		//update new password in db
		$query = "UPDATE user SET user_pw=:newPW WHERE token=:token";
		$stmt = $conn->prepare($query);
		$stmt->bindParam(':newPW', $newPW);
		$stmt->bindParam(':token', $token);
		$stmt->execute();

		echo "<script type=\"text/javascript\"> window.alert(\"비밀번호가 성공적으로 바뀌었습니다.\");location.href=\"login.php\";</script>";
		session_destroy();
		}
	else {
		echo "<script type=\"text/javascript\"> window.alert(\"비밀번호가 같지 않습니다.\");location.href=\"login_edit.php\";</script>";
	}
?>

