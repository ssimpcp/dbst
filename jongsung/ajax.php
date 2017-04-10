<?php
  require_once("../db_connect.php");
  $rack_item = $_REQUEST('rack_item');
  $return = "";
  if($rack_item=="SERVER"){
    $query = "SELECT mgmt_num FROM server as A WHERE A.mgmt_num NOT IN (SELECT mgmt_num FROM server NATURAL JOIN rack_info";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    while($result = $stmt->fetch(PDO::FETCH_NUM)){
      $return .= "<option>".$result[0]."</option>";
    }
  }else if($rack_item=="SWITCH"{
    $query = "SELECT mgmt_num FROM switch as A WHERE A.mgmt_num NOT IN (SELECT mgmt_num FROM switch NATURAL JOIN rack_info";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    while($result = $stmt->fetch(PDO::FETCH_NUM)){
      $return .= "<option>".$result[0]."</option>";
    }
  }
  echo $return;
?>

