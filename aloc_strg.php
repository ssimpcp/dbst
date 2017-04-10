<?php
  require_once("db_connect.php");

  $tmp_mgmt = $_POST['mgmt_num'];
  $mgmt_num = substr($tmp_mgmt,1,6);

  $service_name = $_POST['service_name'];
  $usage = $_POST['usage'];
  $aloc_size = $_POST['aloc_size'];
?>
<html>
<body>
<?php
  $query = "INSERT INTO storage_info (mgmt_num, aloc, service_name, `usage`) VALUES (:mgmt_num, :aloc, :service_name, :usage)";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(":mgmt_num", $mgmt_num);
  $stmt->bindParam(":aloc", $aloc_size);
  $stmt->bindParam(":service_name", $service_name);
  $stmt->bindParam(":usage", $usage);
  $stmt->execute();
?>
</body>
</html>
<meta http-equiv='refresh' content='0,url=strg_info.php'>

