<?php
  require_once("db_connect.php");
  $service_name = $_REQUEST['service_name'];
?>
<html>
<head>
</head>
<body>
<?php
  $assigned = 0;
  $query = "SELECT count(*) FROM rack_info WHERE service_name = :service_name";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(":service_name", $service_name);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_NUM);
  $assigned = $assigned + $result[0];

  $query = "SELECT count(*) FROM storage_info WHERE service_name = :service_name";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(":service_name", $service_name);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_NUM);
  $assigned = $assigned + $result[0];
  if($assigned > 0){
    echo '<script>alert("이 서비스에 할당된 자원이 있습니다.\n\n자원 할당 해제 후 다시 시도해주세요.");</script>';
    print "<meta http-equiv='refresh' content='0;index.php'>";
  }else{
    $query = "DELETE FROM service WHERE service_name = :service_name";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":service_name", $service_name);
    $stmt->execute();
    print "<meta http-equiv='refresh' content='0;index.php'>";
  }
?>
</body>
</html>
