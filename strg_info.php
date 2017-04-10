<?php
  require_once('db_connect.php');
  $query = "SELECT type, sum(aloc) FROM storage as A, storage_info as B WHERE A.mgmt_num=B.mgmt_num GROUP BY type";
  $stmt = $conn->prepare($query);
  $stmt->execute();
  $used_nas = 0;
  $used_san = 0;
  $used_tape = 0;
  while($result = $stmt->fetch(PDO::FETCH_NUM)){
    if($result[0] == "SAN"){
      $used_san = round($result[1],0);
    }else if($result[0] == "NAS"){
      $used_nas = round($result[1],0);
    }else if($result[0] == "TAPE"){
      $used_tape = round($result[1],0);
    }
  }
  $query = "SELECT type, sum(Vol) FROM storage GROUP BY type";
  $stmt = $conn->prepare($query);
  $stmt->execute();
  $total_nas = 0;
  $total_san = 0;
  $total_tape = 0;
  while($result = $stmt->fetch(PDO::FETCH_NUM)){
    if($result[0] == "SAN"){
      $total_san = round($result[1],0);
    }else if($result[0] == "NAS"){
      $total_nas = round($result[1],0);
    }else if($result[0] == "TAPE"){
      $total_tape = round($result[1],0);
    }
  }
  $unused_nas = $total_nas - $used_nas;
  $unused_san = $total_san - $used_san;
  $unused_tape = $total_tape - $used_tape;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Database Management System</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- CSS -->
		<!-- Bootstrap -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
		<link href="../css/index.css" rel = "stylesheet" type="text/css">
		<link rel='stylesheet' href='Nwagon.css' type='text/css'>
		<!-- jS -->
		<script src='Nwagon.js'></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="https://www.w3schools.com/lib/w3data.js"></script>
		<style>
			div{padding:0px; height: auto;}
			.hgroup{padding:20px;background-color:#e9e9e9;}
			.hgroup h1{font-family:Tahoma;}
			.hgroup p{margin:10px 0;font-size:10px;}
			#donut_chart{
				display:inline;
				text-align : center;
			}
		</style>
</head>

	<body id="myPage">
		<div w3-include-html="navbar.html"></div>
		<script>
			w3IncludeHTML();
		</script>
		
		<div id="about" class="container-name">
			<h1>STORAGE INFO</h1><br>
		</div>

<div id="donut_chart" class="container-fluid">
<h4><strong> Storage Usage </strong></h4>
<div id="chart_d"></div>
<script>
var options = {
	'dataset': {
title: 'total storage piechart',
       values:[<?=$used_nas?>, <?=$unused_nas?>, <?=$used_san?>, <?=$unused_san?>, <?=$used_tape?>, <?=$unused_tape?>],
       colorset: ['#2BC8C9', '#2BC899', '#FF8C00', '#FF8C50', '#DC143C', '#DC120A'],
       fields: ['NAS: <?=$used_nas?>', 'NAS(not): <?=$unused_nas?>', 'SAN: <?=$used_san?>','SAN(not): <?=$unused_san?>', 'TAPE: <?=$used_tape?>', 'Tape(not): <?=$unused_tape?>'] 
	},
	'donut_width' : 40, 
	'core_circle_radius':60,
	'chartDiv': 'chart_d',
	'chartType': 'donut',
	'chartSize': {width:450, height:200}
};
Nwagon.chart(options);

function deleteConfirm(x){
	r = confirm("삭제하시겠습니까?");
	if(r == true){
		location.replace("del_asset.php?category=strg_info&ind="+x);
	}
}
</script>
</div>


<!-- Container (table section) -->
<div id="about" class="container-fluid">
<div class="row">
<div class="col-sm-8">
<div class="add-button-right">
  <a class="btn btn-primary btn-lg" data-toggle="modal" data-target="#AssignModal" href="strg_info_modal.php">ASSIGN</a>
</div>
<table class="table table-striped table-hover ">
<thead>
<tr>
<th>Name</th>
<th>Reg_date</th>
<th>Disk_spec</th>
<th>Type</th>
<th>Aloc_u_size(GB)</th>
<th>Vol(TB)</th>
<th>Aloc_size(TB)</th>
<th>Service</th>
<th>Usage</th>
<th>Usable</th>
</tr>
</thead>
<tbody>
<?php

$query = "SELECT * FROM storage";
$stmt = $conn->prepare($query);
$stmt->execute();
$query2 = "SELECT count(*) FROM storage_info WHERE mgmt_num = :mgmt_num";
$query3 = "SELECT * FROM storage_info WHERE mgmt_num = :mgmt_num";


while($result = $stmt->fetch(PDO::FETCH_NUM)){
$stmt2 = $conn->prepare($query2);
$stmt2->bindParam(":mgmt_num", $result[1]);
$stmt2->execute();
$result2 = $stmt2->fetch(PDO::FETCH_NUM);
$rowspan = $result2[0];

$stmt2 = $conn->prepare($query3);
$stmt2->bindParam(":mgmt_num", $result[1]);
$stmt2->execute();
$result2 = $stmt2->fetch(PDO::FETCH_NUM);
print "<tr>";
print "<td rowspan='".$rowspan."'>".$result[4]."</td>";
print "<td rowspan='".$rowspan."'>".$result[2]."</td>";
print "<td rowspan='".$rowspan."'>".$result[5]."</td>";
print "<td rowspan='".$rowspan."'>".$result[6]."</td>";
print "<td rowspan='".$rowspan."'>".$result[7]."</td>";
print "<td rowspan='".$rowspan."'>".$result[8]."</td>";

if($rowspan > 0){
  for($i = 0; $i < $rowspan; $i++){
    if($i > 0){
      print "<tr>";
    }
    print "<td>".$result2[2]."</td>";
    print "<td>".$result2[3]."</td>";
    print "<td>".$result2[4]."</td>";
    print '<td><a type="button" class="btn btn-default btn-sm" onclick="deleteConfirm(\''.$result2[0].'\')">delete</a></td>';
    print "</tr>";
    $result2 = $stmt2->fetch(PDO::FETCH_NUM);
  }
}else{
  print "<td colspan='4'></td>";
  print "</tr>";
}
}
?>
</tbody>
</table>
</div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="AssignModal" role="dialog">
  <div class="modal-dialog">
  <!-- Modal Content-->
  <div class="modal-content">
  </div>
  <!-- /Modal Content-->
  </div>
</div>
<!-- /Modal -->       
</body>
</html>
