<?php
  require_once('db_connect.php');
?>
<!DOCTYPE html>
<html lang="en"><head>
    <title>Database Management System</title>	
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <!-- CSS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link href="../css/index.css" rel="stylesheet">
    <!-- jS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://www.w3schools.com/lib/w3data.js"></script>
  </head>
  <body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
	<div w3-include-html="navbar.html"></div>
                        <script>
                                w3IncludeHTML();
                        </script>
	<div class = "container-name">
                <h1> ASSET - SERVER </h1>
        </div>

    <div align="center">
	<div class="add-button-right">
	<a href="server_detail.php" class="btn btn-primary btn-lg">ADD</a>
	</div>
      <table class="table table-hover" style="width:85%">
              <thead>
	  <tr>
	    <th>자산번호</th>
	    <th>관리번호</th>
	    <th>취득일</th>
	    <th>현재 위치</th>
	    <th>관리스펙</th>
	    <th>코어</th>
	    <th>자산명</th>
            <th>규격</th>
            <th>내용연수</th>
	  </tr>
	</thead>
	<tbody>
	<?php
	  $query = "SELECT server.asset_num, mgmt_num, reg_date, location, spec, core, asset_name, standard, service_life FROM asset, server where asset.asset_num = server.asset_num";
	  $stmt = $conn->prepare($query);
	  $stmt->execute();
	  $today = date("Y-m-d");
	  while( $result = $stmt->fetch(PDO::FETCH_NUM) ) {
	    $end = date("Y-m-d",strtotime($result[2]."+$result[8]year"));
	    if(strtotime($today) > strtotime($end)) {
		print '<tr class="danger"><td>';
	    }
	    else {    
		print '<tr><td>';
	    }
	      print $result[0];
	    print '</td><td>';
	      print $result[1];
	    print '</td><td>';
	      print $result[2];
	    print '</td><td>';
	      print $result[3];
	    print '</td><td>';
	      print $result[4];
	    print '</td><td>';
	      print $result[5];
	    print '</td><td>';
	      print $result[6];
	    print '</td><td>';
	      print $result[7];
	    print '</td><td>';
	      print $result[8]."년";
	    print '</td><td>';
	      print '<a type="botton" class="btn btn-default" onclick="deleteConfirm(\''.$result[0].'\',\''.$result[1].'\')">delete</a>';
	    print '</td></tr>';
	  }
	?>
	</tbody>
      </table>
    </div>
  <script>
  function deleteConfirm(x, y){
    var r = confirm("삭제하시겠습니까?");
    if(r == true) {
      location.replace("del_asset.php?category=server&asset_num=" + x + "&mgmt_num=" + y);
    }
  }
  </script>
  </body>
</html>

