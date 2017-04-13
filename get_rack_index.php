<?php
require_once("db_connect.php");
        $item_mgmt_num = $_POST["item_mgmt_num"];
        $query = "SELECT mgmt_num, slot_size FROM server WHERE mgmt_num = :item_mgmt_num1 Union SELECT mgmt_num, slot_size from switch where mgmt_num = :item_mgmt_num2";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':item_mgmt_num1',$item_mgmt_num);
        $stmt->bindParam(':item_mgmt_num2',$item_mgmt_num);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_NUM);
        $slot_size = $result[1];

        $rack_mgmt_num = $_POST["rack_mgmt_num"];
        $query = "SELECT count(*) from rack_info where rack_mgmt_num = :rack_mgmt_num";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':rack_mgmt_num', $rack_mgmt_num);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_NUM);
        $i = $result[0];
        $boolArray = array(1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1);
        $query = "SELECT ind, slot_size from rack_info where rack_mgmt_num = :rack_mgmt_num ORDER BY ind DESC";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':rack_mgmt_num', $rack_mgmt_num);
        $stmt->execute();
        $index=0;
        for($j=0;$j<$i;$j++){
                $result= $stmt->fetch(PDO::FETCH_NUM);
                $index=$result[0];
                $size=$result[1];
                for($k=($index-1);($k<($index+$size-1));$k++){
                        $boolArray[$k] = 0;
                }
        }
        $result="";
        for($n=0;$n<(43-($slot_size));$n++){
                $temp=0;
                for($l=0;$l<$slot_size;$l++){
                        $temp = $boolArray[$n+$l]+$temp;
                }
                if($temp == $slot_size){
                      $result .= "<option>".($n+1)."</option>";
                }
        }
        echo $result;
?>

