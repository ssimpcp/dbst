<?php
  require_once('db_connect.php');
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
	<!-- jS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../dbst4.js"></script>
	<script src="https://www.w3schools.com/lib/w3data.js"></script>
    
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
      
        <div class="jumbotron text-center col-md-12 col-sm-12 col-xs-12">
                <h1>Database Team Project</h1>
        </div>
		
		<div w3-include-html="navbar.html"></div>
			<script>
				w3IncludeHTML();
			</script>
	
        <div id="about" class="container-name col-md-12 col-sm-12 col-xs-12">
                <h1>SERVICE RESOURCES <script> currentDate();</script></h1><br>
        </div>
	<div class="add-button-right">
	  <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#CreateService" href="service_detail.php">Register</button>
	</div>
        <!-- Container (table section) -->
        <div id="about" class="container-fluid">
                <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                                <table class="table table-striped table-hover ">
                                        <thead>
                                                <tr>
                                                        <th colspan="2">SERVICE</th>
                                                        <th>CPU(Cores)</th>
                                                        <th>SAN(TB)</th>
                                                        <th>NAS(TB)</th>
                                                        <th>DISK_TOTAL</th>
                                                        <th>TAPE(TB)</th>
                                                </tr>
                                        </thead>
                                        <tbody>
					<?php
					  $query = "SELECT service_name FROM service ORDER BY service_name";
					  $stmt = $conn->prepare($query);
					  $stmt->execute();
					  while($result = $stmt->fetch(PDO::FETCH_NUM)){
					    if($result[0] != "FREE"){
					      print '<tr>';
					      print '<td rowspan="2">'.$result[0].'</td>';
					      print '<td>Service</td>';
					      $query = "SELECT SUM(core) FROM server as A, rack_info as B WHERE A.mgmt_num = B.mgmt_num AND service_name = :service_name";
					      $stmt2 = $conn->prepare($query);
					      $stmt2->bindParam(":service_name", $result[0]);
					      $stmt2->execute();
					      $result2 = $stmt2->fetch(PDO::FETCH_NUM);
					      print '<td>'.$result2[0].'</td>';
					      $query = "SELECT type, sum(aloc) FROM storage_info as A, storage as B WHERE A.mgmt_num = B.mgmt_num AND service_name = :service_name GROUP BY type ORDER BY type";
					      $stmt2 = $conn->prepare($query);
					      $stmt2->bindParam(":service_name", $result[0]);
					      $stmt2->execute();
					      $used_san = 0;
					      $used_nas = 0;
					      $used_disk = 0;
					      $used_tape = 0;
					      while($result2 = $stmt2->fetch(PDO::FETCH_NUM)){
						if($result2[0] == "SAN"){
						  $used_san = $result2[1];
						}else if($result2[0] == "NAS"){
						  $used_nas = $result2[1];
						}else if($result2[0] == "TAPE"){
						  $used_tape = $result2[1];
						}
					      }
					      $used_disk = $used_san + $used_nas;
					      print '<td>'.round($used_san,2).'</td>';
					      print '<td>'.round($used_nas,2).'</td>';
					      print '<td>'.round($used_disk,2).'</td>';
					      print '<td>'.round($used_tape,2).'</td>';
					      print '</tr>';
					    
					      $san_vol = 0;
					      $nas_vol = 0;
					      $tape_vol = 0;

					      $query = "SELECT type, sum(Vol) FROM storage as A, storage_info as B  WHERE A.mgmt_num = B.mgmt_num AND service_name = :service_name GROUP By type ORDER BY type";
					      $stmt2 = $conn->prepare($query);
					      $stmt2->bindParam(":service_name", $result[0]);
					      $stmt2->execute();
					    
					      while($result2 = $stmt2->fetch(PDO::FETCH_NUM)){
					        if($result2[0] == "SAN"){
					          $san_vol = $result2[1];
					        }else if($result2[0] == "NAS"){
					          $nas_vol = $result2[1];
					        }else if($result2[0] == "TAPE"){
					          $tape_vol = $result2[1];
					        }
					      }
					      $not_san = $san_vol - $used_san;
					      $not_nas = $nas_vol - $used_nas;
					      $not_disk = $not_san + $not_nas;
					      print '<tr>';
					      print '<td>Not</td>';
					      print '<td>-</td>';
					      print '<td>'.round($not_san,2).'</td>';
					      print '<td>'.round($not_nas,2).'</td>';
					      print '<td>'.round($not_disk,2).'</td>';
					      print '<td>-</td>';
					      print '</tr>';
					    }else{
					      print '<tr>';
					      print '<td>'.$result[0].'</td>';
					      print '<td>Not</td>';
					      $query = "SELECT sum(core) FROM server WHERE server.mgmt_num NOT IN (SELECT mgmt_num FROM server NATURAL JOIN rack_info)";
					      $stmt2 = $conn->prepare($query);
					      $stmt2->execute();
					      $result2 = $stmt2->fetch(PDO::FETCH_NUM);
					      print '<td>'.$result2[0].'</td>';
					      $total_san = 0;
					      $total_nas = 0;
					      $total_tape = 0;
					      $query = "SELECT type, sum(Vol) FROM storage GROUP BY type";
					      $stmt2 = $conn->prepare($query);
					      $stmt2->execute();
					      while($result2 = $stmt2->fetch(PDO::FETCH_NUM)){
					        if($result2[0] == "SAN"){
					          $total_san = $result2[1];
					        }else if($result2[0] == "NAS"){
					          $total_nas = $result2[1];
					        }else if($result2[0] == "TAPE"){
					          $total_tape = $result2[1];
					        }
					      }
					      $used_nas = 0;
					      $used_san = 0;
					      $used_tape = 0;
					      $query = "SELECT type, sum(aloc) FROM storage as A, storage_info as B WHERE A.mgmt_num = B.mgmt_num GROUP BY type";
					      $stmt2 = $conn->prepare($query);
					      $stmt2->execute();
					      while($result2 = $stmt2->fetch(PDO::FETCH_NUM)){
					        if($result2[0] == "SAN"){
					          $used_san = $result2[1];
					        }else if($result2[0] == "NAS"){
					          $used_nas = $result2[1];
					        }else if($result2[0] == "TAPE"){
					          $used_tape = $result2[1];
					    	}
					      }
					      $unused_san = round($total_san - $used_san, 2);
					      $unused_nas = round($total_nas - $used_nas, 2);
					      $unused_tape = round($total_tape - $used_tape, 2);
					      $unused_disk = $unused_san + $unused_nas;
					      print '<td>'.$unused_san.'</td>';
					      print '<td>'.$unused_nas.'</td>';
					      print '<td>'.$unused_disk.'</td>';
					      print '<td>'.$unused_tape.'</td>';
					      print '</tr>';
					    }
					  }
					?>
                                        </tbody>
                                </table>
            </div>
                </div>
        </div>
<!-- Modal -->
<div class="modal fade" id="CreateService" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    </div>
  </div>
<!-- /Modal -->           
</body>
</html>
