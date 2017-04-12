<?php
  require_once('db_connect.php');
	function startsWith($haystack, $needle){
	     $length = strlen($needle);
	     return (substr($haystack, 0, $length) === $needle);
	}
	
	$item_mgmt_num = $_POST['item_mgmt_num'];
	$result="";
	$return="";
	if( startsWith($item_mgmt_num,"R") ){
		$return="R";
		$query = "SELECT spec, location FROM rack WHERE mgmt_num = :item_mgmt_num";
		$stmt=$conn->prepare($query);
		$stmt->bindParam(':item_mgmt_num', $item_mgmt_num);
		$stmt->execute();
		$result=$stmt->fetch(PDO::FETCH_NUM);
		$return .= $result[0]."<br>".$result[1];
	}
	else if( startsWith($item_mgmt_num, "N") ){
		$return="N";
		$query = "SELECT spec FROM switch WHERE mgmt_num = :item_mgmt_num";	
		$stmt=$conn->prepare($query);
		$stmt->bindParam(':item_mgmt_num', $item_mgmt_num);
		$stmt->execute();
		$result=$stmt->fetch(PDO::FETCH_NUM);
		$return .= $result[0];
	}
	else if( startsWith($item_mgmt_num,"S")){
		$return="S";
		$query = "SELECT spec, core FROM server WHERE mgmt_num = :item_mgmt_num";
		$stmt=$conn->prepare($query);
		$stmt->bindParam(':item_mgmt_num', $item_mgmt_num);
		$stmt->execute();
		$result=$stmt->fetch(PDO::FETCH_NUM);
		$return .= $result[0]."<br>".$result[1];
	}
	echo $return;
?>
