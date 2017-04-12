<?php
  require_once('db_connect.php');
  $category = $_REQUEST['category'];
  $asset_num = $_REQUEST['asset_num'];
?>
<html>
  <head>
  </head>
  <body>
  <?php
    if($category=='total'){
      $count = 0;
      $query = "SELECT count(*) FROM server WHERE asset_num=:asset_num";
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':asset_num', $asset_num);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_NUM);
      $count = $count + $result[0];
      $query = "SELECT count(*) FROM rack WHERE asset_num=:asset_num";
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':asset_num', $asset_num);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_NUM);
      $count = $count + $result[0];
      $query = "SELECT count(*) FROM switch WHERE asset_num=:asset_num";
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':asset_num', $asset_num);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_NUM);
      $count = $count + $result[0];
      $query = "SELECT count(*) FROM storage WHERE asset_num=:asset_num";
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':asset_num', $asset_num);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_NUM);
      $count = $count + $result[0];
      if($count > 0) {
	echo '<script>alert("현재 자산 번호로 등록된 자원이 있습니다.\n\n등록된 자원을 모두 삭제한 후 시도해주세요.");</script>';
        print "<meta http-equiv='refresh' content='0;url=total.php'>";
      }else{
        $query = "DELETE FROM total_asset WHERE asset_num=:asset_num";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':asset_num', $asset_num);
        $stmt->execute();
 
        $query = "DELETE FROM asset WHERE asset_num=:asset_num";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':asset_num', $asset_num);
        $stmt->execute();
        print "<meta http-equiv='refresh' content='0;url=total.php'>";
      }

    }else if($category=='server'){
      $mgmt_num = $_REQUEST['mgmt_num'];
      $query = "SELECT count(*) FROM rack_info WHERE mgmt_num = :mgmt_num";
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':mgmt_num', $mgmt_num);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_NUM);

      if($result[0] > 0){
	echo '<script>alert("사용중인 서버입니다. 서비스 해제 후 시도해주세요.");</script>';
        print "<meta http-equiv='refresh' content='0;url=server.php'>";
      }else{
        $query = "DELETE FROM server WHERE mgmt_num=:mgmt_num";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':mgmt_num', $mgmt_num);
        $stmt->execute();

	

        $query = "UPDATE total_asset SET s = s - 1 WHERE asset_num = :asset_num";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":asset_num", $asset_num);
        $stmt->execute();
        print "<meta http-equiv='refresh' content='0;url=server.php'>";
      }
    }else if($category=='switch'){
      $mgmt_num = $_REQUEST['mgmt_num'];
      $query = "SELECT count(*) FROM rack_info WHERE mgmt_num = :mgmt_num";
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':mgmt_num', $mgmt_num);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_NUM);
      if($result[0] > 0){
	echo '<script>alert("사용중인 스위치입니다. 서비스 해제 후 시도해주세요.");</script>';
        print "<meta http-equiv='refresh' content='0;url=switch.php'>";
      }else{
        $query = "DELETE FROM switch WHERE mgmt_num=:mgmt_num";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':mgmt_num', $mgmt_num);
        $stmt->execute();
      
        $query = "UPDATE total_asset SET n = n - 1 WHERE asset_num = :asset_num";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":asset_num", $asset_num);
        $stmt->execute();
        print "<meta http-equiv='refresh' content='0;url=switch.php'>";
      }
    }else if($category=='storage'){
      $mgmt_num = $_REQUEST['mgmt_num'];
      $query = "SELECT count(*) FROM storage_info WHERE mgmt_num = :mgmt_num";
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':mgmt_num', $mgmt_num);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_NUM);
      if($result[0] > 0) {
	echo '<script>alert("사용중인 스토리지입니다. 서비스 해제 후 시도해주세요.");</script>';
        print "<meta http-equiv='refresh' content='0;url=storage.php'>";
      }else{
        $query = "DELETE FROM storage WHERE mgmt_num=:mgmt_num";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':mgmt_num', $mgmt_num);
        $stmt->execute();
      
        $query = "UPDATE total_asset SET d = d - 1 WHERE asset_num = :asset_num";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":asset_num", $asset_num);
        $stmt->execute();
        print "<meta http-equiv='refresh' content='0;url=storage.php'>";
      }
    }else if($category=='rack'){
      $mgmt_num = $_REQUEST['mgmt_num'];
      $query = "SELECT count(*) FROM rack_info WHERE rack_mgmt_num = :mgmt_num";
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':mgmt_num', $mgmt_num);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_NUM);
      if($result[0] > 0){
	echo '<script>alert("랙에 할당된 서버나 스위치가 있습니다. 자원 해제 후 시도해주세요.");</script>';
        print "<meta http-equiv='refresh' content='0;url=rack.php'>";
      }else{
        $query = "DELETE FROM rack WHERE mgmt_num=:mgmt_num";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':mgmt_num', $mgmt_num);
        $stmt->execute();
      
        $query = "UPDATE total_asset SET r = r - 1 WHERE asset_num = :asset_num";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":asset_num", $asset_num);
        $stmt->execute();
        print "<meta http-equiv='refresh' content='0;url=rack.php'>";
      }
    }else if($category=='strg_info'){
      $query = "DELETE FROM storage_info WHERE ind = :ind";
      $stmt = $conn->prepare($query);
      $stmt->bindParam(":ind", $_REQUEST['ind']);
      $stmt->execute();
      print "<meta http-equiv='refresh' content='0;url=strg_info.php'>";
    }else if($category=='rack_info'){
      $query = "DELETE FROM rack_info WHERE mgmt_num = :mgmt_num";
      $stmt = $conn->prepare($query);
      $stmt->bindParam(":mgmt_num", $_REQUEST['mgmt_num']);
      $stmt->execute();

      $query = "UPDATE server SET location = 'NOT ASSIGNED' WHERE mgmt_num =:mgmt_num";
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':mgmt_num',$_REQUEST['mgmt_num']);
      $stmt->execute();
      print "<meta http-equiv='refresh' content='0;url=rack_info.php'>";
    }
  ?>
  </body>
</html> 

