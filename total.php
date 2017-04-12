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

    <div class="container-name">
      <h1>ASSET - TOTAL</h1> 
    </div>
    <div align="center">
	<div class="add-button-right">
	<a href="add_asset.php" class="btn btn-primary btn-lg">ADD</a>
	</div>
      <table class="table table-hover"  style="width:95%">
              <thead>
	  <tr>
	    <th>자산번호</th>
	    <th>취득일</th>
	    <th>자산명</th>
	    <th>규격</th>
	    <th>취득원가</th>
	    <th>구입처</th>
	    <th>내용연수</th>
	    <th>S</th>
	    <th>N</th>
	    <th>D</th>
	    <th>R</th>
	  </tr>
	</thead>
	<tbody>
	<?php
	  if(!$_REQUEST['page']) $page = 1;
	  else $page = $_REQUEST['page'];
	  
	  $page_list = 30;
	  $block_set = 10;
	  
	  $query = "SELECT count(*) FROM asset";
	  $stmt = $conn->prepare($query);
	  $stmt->execute();
	  $result = $stmt->fetch(PDO::FETCH_NUM);
	  $total = $result[0];
	  
	  $total_page = ceil($total/$page_list);
	  $total_block = ceil($total_page/$block_set);
	  
	  $block = ceil($page/$block_set);
	  
	  $limit_idx = ($page-1)*$page_list;
	   
          $query = "SELECT asset.asset_num, reg_date,  asset_name, standard, price, assembler, service_life, s, n, d, r  FROM asset, total_asset where asset.asset_num = total_asset.asset_num LIMIT $limit_idx, $page_list";
          $stmt = $conn->prepare($query);
          $stmt->execute();
          $today = date("Y-m-d");
	  $result = $stmt->fetch(PDO::FETCH_NUM);
	  while( $count < $page_list ) {
	   if($result[0] == NULL) break;
      	   $end = date("Y-m-d",strtotime($result[1]."+$result[6]year"));
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
              print number_format( $result[4])."원";
            print '</td><td>';
              print $result[5];
            print '</td><td>';
              print $result[6]."년";
            print '</td><td>';
              print $result[7];
            print '</td><td>';
              print $result[8];
            print '</td><td>';
              print $result[9];
            print '</td><td>';
              print $result[10];
            print '</td><td>';
              print '<a type="button" class="btn btn-default" href="del_asset.php?category=total&asset_num='.$result[0].'">delete</a>';
            print '</td></tr>';
	    $result = $stmt->fetch(PDO::FETCH_NUM);
	    $count++;
          }
	  $first_page = (($block-1)*$block_set)+1;
	  $last_page = min($total_page, $block*$block_set);
	  $prev_page = $page-1;
	  $next_page = $page+1;
	  $prev_block = $block-1;
	  $next_block = $block+1;
	  $prev_block_page = $prev_block*$block_set;
	  $next_block_page = $next_block*$block_set-($block_set-1);

	  $parameter = $page-1;
        ?>
	</tbody>
      </table>
      <div><ul class="pagination">
      <?php
        echo ($page >= 2) ? "<li><a href=$_SERVER[PHP_SLEF]?page=$parameter>prev </a></li>" : "";
	for($i=$first_page;$i<=$last_page;$i++){
	  if($page == $i) print "<li><a href=$_SERVER[PHP_SELF]?page=$i> <U>$i</U> </a></li>";
	  else print "<li><a href=$_SERVER[PHP_SELF]?page=$i> $i </a></li>";
	}
	$parameter = $page+1;
	echo ($page*$page_list >= $total ) ? "" : "<li><a href=$_SERVER[PHP_SLEF]?page=$parameter>next</a></li>";
      ?>
      </ul></div>
    </div>
  </body>
</html>

