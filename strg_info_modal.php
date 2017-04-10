<?php
  require_once("db_connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
</head>
<body>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h5 style="text-align:center;">STORAGE ASSIGN</h5>
  </div>
  <div class="modal-body">
    <form method ="post" action="aloc_strg.php">
      <div>
        <label class="control-label" for="mgmt_num">제품명</label>
        <select onclick="setAloc()" id="mgmt_num" name="mgmt_num" class="form-control" required="">
        <?php
          $query = "SELECT * FROM storage ORDER BY mgmt_num";
          $stmt = $conn->prepare($query);
          $stmt->execute();
          while($list = $stmt->fetch(PDO::FETCH_NUM)){
            print "<option>[".$list[1]."] ".$list[4]."</option>";
          }
        ?>
        </select>
        </div>
      <div>
        <label class="control-label" for="service_name">서비스</label>
        <select id="service_name" name="service_name" class="form-control" required="">
        <option>서비스 선택</option>
        <?php
	  $query = "SELECT service_name FROM service WHERE service_name <> 'FREE'";
	  $stmt = $conn->prepare($query);
	  $stmt->execute();
	  while($list = $stmt->fetch(PDO::FETCH_NUM)){
	    print "<option>".$list[0]."</option>";
	  }
	?>
        </select>
      </div>
      <div class="form-group">
        <label class="control-label" for="usage">용도</label>
        <input type="text" id="usage" name="usage" class="form-control" required="">
      </div>
      <div class="form-gruop">
        <label class="control-label" for="aloc_size">할당</label>
        <!--<input type="text" id="aloc_size" name="aloc_size" class=form-control" required="">TB-->
        <select id="aloc_size" name="aloc_size" class="form-control">

	</select>
      </div>
      <div align="right">
        <input type="submit" class="btn btn-default" name="submit" value="assign"></input>
      </div>
    </form>
  </div>

  <script>
  function setAloc() {
    var x = document.getElementById("mgmt_num").selected;
    var index = document.getElementById("mgmt_num").value;
    if(x) {
      document.getElementById("aloc_size").innerHTML = "<option>할당량 선택</option>";
    }else{
      if(window.ActiveXObject){
        var xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }else{
        var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
          if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	    document.getElementById("aloc_size").innerHTML = xmlhttp.responseText;
	  }
	}
	xmlhttp.open("POST", "get_aloc_limit.php?timeStamp=" + new Date().getTime(), true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.send("mgmt_num="+index);
      }  
    }
  }
  </script>
</body>
</html>
