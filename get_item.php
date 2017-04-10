<?php
  require_once('db_connect.php');
	$type = $_POST['type'];
	$item_mgmt_num = $_POST['item_mgmt_num'];
	$result;
	$return="";
	if( $type == "rack" ){
		$query = "SELECT spec, location FROM rack WHERE :item_mgmt_num";
		$stmt=$conn->prepare($query);
		$stmt->bindParam(':item_mgmt_num', $item_mgmt_num);
		$stmt->execute();
		$result=$stmt->fetch(PDO::FETCH_NUM);
		$return .= $result[0]."<br>".$result[1];
	}
	else if( $type == "switch" ){
		$query = "SELECT spec FROM switch WHERE :item_mgmt_num";	
		$stmt=$conn->prepare($query);
		$stmt->bindParam(':item_mgmt_num', $item_mgmt_num);
		$stmt->execute();
		$result=$stmt->fetch(PDO::FETCH_NUM);
		$return .= $result[0];
	}
	else if( $type == "server"){
		$query = "SELECT spec, core FROM server WHERE :item_mgmt_num";
		$stmt=$conn->prepare($query);
		$stmt->bindParam(':item_mgmt_num', $item_mgmt_num);
		$stmt->execute();
		$result=$stmt->fetch(PDO::FETCH_NUM);
		$return .= $result[0]."<br>".$result[1];	
	}
	echo $result;
?>
