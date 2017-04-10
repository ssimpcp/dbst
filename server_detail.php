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
      <h1>ADD - SERVER</h1> 
    </div>
    	
<div class="well bs-component">  
<form method="post" enctype="multipart/form-data" action="add_detail.php">
                 
  <fieldset>
  <table>
                  <tbody><tr>
                    <th>
		      <label for="asset_num_list">자산번호</label>
		   </th>
                   <td>
		      <select onclick="setMaxNum()" class="form-control" id="asset_num_list" name="asset_num_list">
		      	<option>자산 선택</option>
		      <?php
		      	$query = "SELECT asset.asset_num FROM asset, total_asset WHERE asset.asset_num = total_asset.asset_num AND total_asset.un_s > 0";
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
                      <label for="assign_num">할당 갯수</label>
                    </th>
                    <td colspan="2">
                      <select class="form-control" id="assign_num" name="assign_num">
                        <option>할당량 선택</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <th>현재위치</th>
                    <td colspan="2"><input class="form-control" type="text" name="location" required=""></td>
                  </tr>
                  <tr>
                    <th>관리스펙</th>
                    <td colspan="2"><input class="form-control" type="text" name="spec" required=""></td>                    
                  </tr>
                  <tr>
                    <th>코어</th>
                    <td colspan="2"><input class="form-control" type="text" name="core" required=""></td>
                  </tr>
		  <tr>
		    <th>사이즈</th>
		    <td colspan="2"><input class="form-control"  type="text" name="physical_size" required=""></td>
		  </tr>
			<input type="hidden" name="category" value="server">
<tr><td align="right" colspan="3"><input type="submit" class="btn btn-default submit form-control" name="submit" value="등록"></td>
                  </tr>
  
  
                    
                 </tbody></table>
	</form>
</div>
<script>
	function setMaxNum() {
		var x = document.getElementById("asset_num_list").selected;
		var index = document.getElementById("asset_num_list").value;
		if(x) {
			document.getElementById("assign_num").innerHTML = "<option>수량 선택</option>";
		}else{
			if(window.ActiveXOjbect) {
				var xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}else{
				var xmlhttp = new XMLHttpRequest();
			}
			xmlhttp.onreadystatechange = function() {
				if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					document.getElementById("assign_num").innerHTML = xmlhttp.responseText;
				}
			}
			xmlhttp.open("POST", "get_un.php?timeStamp=" + new Date().getTime(), true);
			xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xmlhttp.send("category=server&asset_num="+index);
		}
	}
</script>

</body></html>

