<?php
  require_once("db_connect.php");
  $service_name = $_POST['service_name'];
  $rack_mgmt_num = $_POST['rack_mgmt_num'];
  $type = $_POST['type'];
  $item_mgmt_num;
  if($type == "SERVER"){
        $item_mgmt_num=$_POST['se_mgmt_num'];
  }
  else if($type == "SWITCH"){
        $item_mgmt_num=$_POST['sw_mgmt_num'];
  }
  $index = $_POST['index'];
  $ip = $_POST['ip'];

  $query =  "SELECT standard, slot_size from (SELECT asset_num, mgmt_num, slot_size FROM switch WHERE mgmt_num = :item_mgmt_num1 UNION SELECT asset_num, mgmt_num, slot_size FROM server WHERE mgmt_num = :item_mgmt_num2) AS temp , asset where temp.asset_num = asset.asset_num";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(':item_mgmt_num1', $item_mgmt_num);
  $stmt->bindParam(':item_mgmt_num2', $item_mgmt_num);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_NUM);
  $standard = $result[0];
  $slot_size = $result[1];

  $query = "INSERT INTO rack_info (rack_mgmt_num, mgmt_num, standard, service_name, IP, slot_size, ind) VALUES (:rack_mgmt_num, :item_mgmt_num, :standard, :service_name, :ip, :slot_size, :ind)";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(':rack_mgmt_num', $rack_mgmt_num);
  $stmt->bindParam(':item_mgmt_num', $item_mgmt_num);
  $stmt->bindParam(':standard', $standard);
  $stmt->bindParam(':service_name', $service_name);
  $stmt->bindParam(':ip', $ip);
  $stmt->bindParam(':slot_size', $slot_size);
  $stmt->bindParam(':ind', $index);
  $stmt->execute();
?>

<meta http-equiv='refresh' content='0,url=rack_info.php'>

