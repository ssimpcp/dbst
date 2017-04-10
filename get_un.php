<?php
  require_once('db_connect.php');
  $asset_num = $_REQUEST['asset_num'];
  $category = $_REQUEST['category'];
  
  $return = "";
  $count = 0;
  if($category=="rack"){
    $query = "SELECT un_r FROM total_asset WHERE asset_num = :asset_num";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':asset_num', $asset_num);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_NUM);
    $un_r = $result[0];
    while($count <= $un_r ){
      $return.="<option>".$count."</option>";
      $count++;
    }
  }else if($category=="server"){
    $query = "SELECT un_s FROM total_asset WHERE asset_num = :asset_num";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':asset_num', $asset_num);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_NUM);
    $un_s = $result[0];
    while($count <= $un_s ){
      $return.="<option>".$count."</option>";
      $count++;
    }
  }else if($category=="switch"){
    $query = "SELECT un_n FROM total_asset WHERE asset_num = :asset_num";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':asset_num', $asset_num);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_NUM);
    $un_n = $result[0];
    while($count <= $un_n ){
      $return.="<option>".$count."</option>";
      $count++;
    }
  }else if($category=="storage"){
    $query = "SELECT un_d FROM total_asset WHERE asset_num = :asset_num";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':asset_num', $asset_num);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_NUM);
    $un_d = $result[0];
    while($count <= $un_d ){
      $return.="<option>".$count."</option>";
      $count++;
    }
  }else{

  }
  echo $return;
?>
