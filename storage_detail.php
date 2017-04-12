<?php
	require_once("db_connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
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
<body>

    <div w3-include-html="navbar.html"></div>
                <script>
                        w3IncludeHTML();
                </script>

    <div class="container-name">
      <h1>ADD - STORAGE</h1> 
    </div>
<div class="well">
<fieldset>
   <form method="post" enctype="multipart/form-data" action="add_detail.php">
                 
  
  <table style>
                  <tbody><tr>
                    <th>
		      <label for="asset_num_list">자산번호</label>
		   </th>
                   <td>
		      <select class="form-control" id="asset_num_list" name="asset_num_list">
		      	<option>자산 선택</option>
		      <?php
		      	$query = "SELECT asset.asset_num FROM asset, total_asset WHERE asset.asset_num = total_asset.asset_num AND total_asset.un_d > 0";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			while($result = $stmt->fetch(PDO::FETCH_NUM)) {
				print '<option>'.$result[0].'</option>';
			}
		      ?>
		      </select>
		   </td>
                  </tr>
		  <tr>
                    <th>
                      <label for="assign_num">형식</label>
                    </th>
                    <td colspan="2">
                      <select onchange="toggleAloc()" class="form-control" id="type" name="type">
                        <option>SAN</option>
			<option>NAS</option>
			<option>TAPE</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <th>위치</th>
                    <td colspan="2">
		      <select class="form-control" id="location" name="type">
		        <?php
			$query = "SELECT room FROM location";
			$stmt = $conn->prepare($query);
			$stmt->execute();
			while($result = $stmt->fetch(PDO::FETCH_NUM)){
			  print "<option>".$result[0]."</option>";
			}
			?>
		      </select>
		    </td>
                  </tr>
                  <tr>
                    <th>관리스펙</th>
                    <td colspan="2"><input  class="form-control"  type="text" name="spec" required=""></td>                    
                  </tr>
                  <tr>
                    <th>디스크 사양</th>
                    <td colspan="2"><input  class="form-control"  type="text" name="disk_spec" required=""></td>
                  </tr>
		  <tr id="aloc_unit_line">
		    <th>할당단위크기(GB)</th>
		    <td colspan="2"><input  class="form-control"  type="text" id="aloc_unit" name="aloc_unit"></td>
		  </tr>
		  <tr>
		    <th>VOL(TB)</th>
		    <td colspan="2"><input  class="form-control"  type="text" name="vol"></td>
		  </tr>
			<input type="hidden" name="category" value="storage">
<tr><td align="right" colspan="3"><input type="submit" class="btn btn-default submit form-control" name="submit" value="등록"></td>
                  </tr>
                 </tbody></table>
               </form>
		</fieldset>
	</div>
	<script>
	function toggleAloc(){
		var x = document.getElementById("type").value;
		debugger;
		if(x == "TAPE"){
			document.getElementById("aloc_unit_line").style.display = "none";
		}else{
			document.getElementById("aloc_unit_line").style.display = "";
		}
	}
	</script>

</body></html>

