<?php
  require_once("db_connect.php");
  $mgmt_num = $_POST['mgmt_num'];
  $service_name = $_POST['service_name'];
  $usage = $_POST['usage'];
  if($_POST['aloc_size']){
  	$aloc_size = $_POST['aloc_size'];
  }
  else {
  	$aloc_size = $_POST['input_aloc_nas'];
  }
  $query = "INSERT INTO storage_info (mgmt_num, aloc, service_name, `usage`) VALUES (:mgmt_num, :aloc, :service_name, :usage)";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(":mgmt_num", $mgmt_num);
  $stmt->bindParam(":aloc", $aloc_size);
  $stmt->bindParam(":service_name", $service_name);
  $stmt->bindParam(":usage", $usage);
  $stmt->execute();

  echo "<meta http-equiv='refresh' content='0,url=strg_info.php'>";

?>
