<?php
	require_once('db_connect.php');

	session_cache_limiter('');
	session_start();

	//receive ID, PW
	$id = $_SESSION['id'];
	$pw = $_POST['loginPASS'];

	//get token from database to check the input pw
	$query = "SELECT token FROM user WHERE user_id = :id && user_pw = :pw";
	$stmt = $conn->prepare($query);
	$stmt->bindParam(':id', $id);
	$stmt->bindParam(':pw', $pw);
	$stmt->execute();
	$getTOKEN = $stmt->fetch(PDO::FETCH_NUM);

	//if token exist,
	if($_SESSION['token'] == $getTOKEN[0]) {
		header('Location: ./login_edit.php');
	}
	else {
		echo "<script>window.alert(\"잘못된 비밀번호를 입력하였습니다.\"); location.href=\"login_identify.php\";</script>";
	}
?>




