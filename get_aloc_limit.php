<?php
  require_once("db_connect.php");
  $mgmt_num = substr($_REQUEST['mgmt_num'],1,6);
  $query = "SELECT Vol, aloc_unit, type FROM storage WHERE mgmt_num = :mgmt_num";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(":mgmt_num", $mgmt_num);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_NUM);
  $type = $result[2];
  if($type != "TAPE"){
    $overall = $result[0];
    $aloc_unit = (float)($result[1]/1000);
  
    $query = "SELECT SUM(aloc) FROM storage_info WHERE mgmt_num = :mgmt_num";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":mgmt_num", $mgmt_num);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_NUM);
    $used = $result[0];

    $remain = $overall - $used;
    $aloc = 0;
    $return = "";
    while($aloc < $remain && $aloc_unit > 0 ){
      $return .= "<option>".$aloc."</option>";
      $aloc = $aloc + $aloc_unit;
    }
  }else{
    $aloc = $result[0];
    $return = "<option>".$aloc."</option>";
  }
  echo $return;
?>
