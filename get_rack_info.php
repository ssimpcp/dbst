<?php
require_once('db_connect.php');

$rack_mgmt_num = ($_POST['rack_mgmt_num']);
$return="<tbody>
                <tr>
                        <th>AS</th>
                        <th>IP</th>
                        <th>Mgmt_num</th>
                        <th>Spec</th>
                        <th>Service</th>
			<th></th>
                </tr>";

$query = "SELECT mgmt_num, standard, service_name, IP, slot_size, ind FROM rack_info WHERE rack_mgmt_num = :rack_mgmt_num ORDER BY ind";

$stmt = $conn->prepare($query);
$stmt->bindParam(":rack_mgmt_num", $rack_mgmt_num);
$stmt->execute();

$i = 1;

$result = $stmt->fetch(PDO::FETCH_NUM);

while($i < 43) {
        if(($i == $result[5])&& $result[5]){
                $height = (int)($result[4]) * 15;
                $return .= "<tr style='height:".$height."px;'>";
                $return .= "<td>OK</td>";
                $return .= "<td>".$result[3]."</td>";
                $return .= "<td>".$result[0]."</td>";
                $return .= "<td>".$result[1]."</td>";
                $return .= "<td>".$result[2]."</td>";
		$return .= '<td><a type="button" class="btn btn-default btn-xs" onclick="deleteConfirm(\''.$result[0].'\')">delete</a></td>';
                $return .= "</tr>";
                $i = $i + $result[4];
                $result = $stmt->fetch(PDO::FETCH_NUM);
        }else{
                $return .= "<tr>";
                $return .= "<td colspan='6'>ASSIGN AVAILABLE</td>";
                $return .= "</tr>";
                $i++;
        }
}
$return .="</tbody>";

echo $return;
?>
