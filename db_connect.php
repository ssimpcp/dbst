<?php
	session_cache_expire(2);
	session_start();
	if($_SESSION['token']==NULL){
		echo "<meta http-equiv='refresh' content='0; url=login.php'>";
		exit;
	}
	ini_set("session.cookie_lifetime", 3);
	ini_set("session.cache_expire", 3);
	ini_set("session.gc_maxlifetime", 3);

  $dbid="sim";
  $dbpw="qwer1234";
  $dbname="DBST4";
  $host="dbst4.cdgsqsen8j0k.ap-northeast-2.rds.amazonaws.com";
  try{
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $dbid, $dbpw, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $q = "INSERT INTO user_log (user_id, page) VALUES (:user_id, :page)";
    $st = $conn->prepare($q);
    $st->bindParam(":user_id", $_SESSION['id']);
    $url = "http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]; 
    $st->bindParam(":page", $url);
    $st->execute();
  } catch(Exception $e) {
    echo $e->getMessage();
  }
?>
