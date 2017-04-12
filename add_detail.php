<?php
  require_once('db_connect.php');
  
  $category = $_POST['category'];

  if($category=="server") {
    $query = "SELECT max(mgmt_num) FROM server";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_NUM);
    $last_index = $result[0];
    if(substr($last_index, 1, 2)==substr((string)date('Y'), 2, 2)){
      $int_index = (int)(substr($last_index,1,5));
      $int_index = $int_index + 1;
      $mgmt_num = "S".$int_index;
    }else{
      $int_index = (int)(substr((string)date('Y'), 2, 2))*1000 + 1;
      $mgmt_num = "S".$int_index;
    }
    $query = "INSERT INTO server (asset_num, mgmt_num, location, spec, core, slot_size) VALUES (:asset_num, :mgmt_num, :location, :spec, :core, :slot_size)";
    
    $asset_num = $_POST['asset_num_list'];
    $location = "NOT ASSIGNED";
    $spec = $_POST['spec'];
    $assign_num = $_POST['assign_num'];
    $core = $_POST['core'];
    $slot_size = $_POST['slot_size'];
    
    for($i = 0; $i < $assign_num; $i++) {
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':asset_num', $asset_num);
      $stmt->bindParam(':mgmt_num', $mgmt_num);
      $stmt->bindParam(':location', $location);
      $stmt->bindParam(':spec', $spec);
      $stmt->bindParam(':core', $core);
      $stmt->bindParam(':slot_size', $slot_size);
      $stmt->execute();

      $int_index++;
      $mgmt_num="S".$int_index;
    }
    $query = "UPDATE total_asset SET un_s = un_s - :assign_num WHERE asset_num = :asset_num";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':assign_num', $assign_num);
    $stmt->bindParam(':asset_num', $asset_num);
    $stmt->execute();

    echo "<meta http-equiv='refresh' content='0;url=server.php'>"; 
  } else if($category=="switch") {
    $query = "SELECT max(mgmt_num) FROM switch";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_NUM);
    $last_index = $result[0];
    
    if(substr($last_index, 1, 2)==substr((string)date('Y'), 2, 2)){
      $int_index = (int)(substr($last_index,1,5));
      $int_index = $int_index + 1;
      $mgmt_num = "N".$int_index;
    }else{
      $int_index = (int)(substr((string)date('Y'), 2, 2))*1000 + 1;
      $mgmt_num = "N".$int_index;
    }
    $query = "INSERT INTO switch (asset_num, mgmt_num, location, spec, slot_size) VALUES (:asset_num, :mgmt_num, :location, :spec, :slot_size)";

    $asset_num = $_POST['asset_num_list'];
    $location = "NOT ASSIGNED";
    $spec = $_POST['spec'];
    $assign_num = $_POST['assign_num'];
    $slot_size = $_POST['physical_size'];
    
    for($i = 0; $i < $assign_num; $i++) {
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':asset_num', $asset_num);
      $stmt->bindParam(':mgmt_num', $mgmt_num);
      $stmt->bindParam(':location', $location);
      $stmt->bindParam(':spec', $spec);
      $stmt->bindParam(':slot_size', $slot_size);
      $stmt->execute();

      $int_index++;
      $mgmt_num="N".$int_index;
    }
    $query = "UPDATE total_asset SET un_n = un_n - :assign_num WHERE asset_num = :asset_num";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':assign_num', $assign_num);
    $stmt->bindParam(':asset_num', $asset_num);
    $stmt->execute();

    echo "<meta http-equiv='refresh' content='0;url=switch.php'>";
  } else if($category=="storage") {
    $query = "SELECT max(mgmt_num) FROM storage";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_NUM);
    $last_index = $result[0];
    
    if(substr($last_index, 1, 2)==substr((string)date('Y'), 2, 2)){
      $int_index = (int)(substr($last_index,1,5));
      $int_index = $int_index + 1;
      $mgmt_num = "D".$int_index;
    }else{
      $int_index = (int)(substr((string)date('Y'), 2, 2))*1000 + 1;
      $mgmt_num = "D".$int_index;
    }
    
    $asset_num = $_POST['asset_num_list'];
    $location = $_POST['location'];
    $spec = $_POST['spec'];
    
    $query = "SELECT reg_date FROM asset WHERE asset_num = :asset_num";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':asset_num', $asset_num);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_NUM);
    $reg_date = $result[0];

    $query = "INSERT INTO storage (asset_num, mgmt_num, reg_date, location, spec, disk_spec, type, aloc_unit, Vol) VALUES (:asset_num, :mgmt_num, :reg_date, :location, :spec, :disk_spec, :type, :aloc_unit, :Vol)";    
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':asset_num', $asset_num);
    $stmt->bindParam(':mgmt_num', $mgmt_num);
    $stmt->bindParam(':reg_date', $reg_date);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':spec', $spec);
    $stmt->bindParam(':disk_spec', $_POST['disk_spec']);
    $stmt->bindParam(':type', $_POST['type']);
    $stmt->bindParam(':aloc_unit', $_POST['assignment_unit']);
    $stmt->bindParam(':Vol', $_POST['vol']);
    $stmt->execute();

    $query = "UPDATE total_asset SET un_d = un_d - 1 WHERE asset_num = :asset_num";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':asset_num', $asset_num);
    $stmt->execute();

    echo "<meta http-equiv='refresh' content='0;url=storage.php'>";
  } else if($category=="rack") {
    $query = "SELECT max(mgmt_num) FROM rack";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_NUM);
    $last_index = $result[0];
    
    if(substr($last_index, 1, 2)==substr((string)date('Y'), 2, 2)){
      $int_index = (int)(substr($last_index,1,5));
      $int_index = $int_index + 1;
      $mgmt_num = "R".$int_index;
    }else{
      $int_index = (int)(substr((string)date('Y'), 2, 2))*1000 + 1;
      $mgmt_num = "R".$int_index;
    }
    $query = "INSERT INTO rack (asset_num, mgmt_num, location, spec) VALUES (:asset_num, :mgmt_num, :location, :spec)";

    $asset_num = $_POST['asset_num_list'];
    $location = $_POST['location'];
    $spec = $_POST['spec'];
    $assign_num = $_POST['assign_num'];
    $slot_size = $_POST['physical_size'];
    
    for($i = 0; $i < $assign_num; $i++) {
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':asset_num', $asset_num);
      $stmt->bindParam(':mgmt_num', $mgmt_num);
      $stmt->bindParam(':location', $location);
      $stmt->bindParam(':spec', $spec);
      $stmt->execute();

      $inside_query = "INSERT INTO rack_assign (mgmt_num, slot_size) VALUES (:mgmt_num, :slot_size)";
      $stmt = $conn->prepare($inside_query);
      $stmt->bindParam(':mgmt_num', $mgmt_num);
      $stmt->bindParam(':slot_size', $slot_size);
      $stmt->execute();

      $int_index++;
      $mgmt_num="R".$int_index;
    }
    $query = "UPDATE total_asset SET un_r = un_r - :assign_num WHERE asset_num = :asset_num";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':assign_num', $assign_num);
    $stmt->bindParam(':asset_num', $asset_num);
    $stmt->execute();
    echo "<meta http-equiv='refresh' content='0;url=rack.php'>";
  } else if($category == "service") {
	$query = "INSERT INTO service (service_name, service_info) VALUES (:service_name, :service_info)";
	$service_name = $_POST['service_name'];
	$service_info = $_POST['service_info'];
	$stmt = $conn->prepare($query);
	$stmt->bindParam(':service_name', $service_name);
	$stmt->bindParam(':service_info', $service_info);
	$stmt->execute();
	echo "<meta http-equiv='refresh' content='0;url=index.php'>";
  }    
?>
