<?php
	session_cache_limiter('');
	session_start();
  $dbid="sim";
  $dbpw="qwer1234";
  $dbname="DBST4";
  $host="dbst4.cdgsqsen8j0k.ap-northeast-2.rds.amazonaws.com";
  try{
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $dbid, $dbpw, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(Exception $e) {
    echo $e->getMessage();
  }
?>


