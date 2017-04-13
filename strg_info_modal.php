<?php
  require_once("db_connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <style>
        .info-label-div{
                display:block;
                margin-left : 20px;
        }
        .info-label-container{
                margin-top:20px;
        }
        .info-label-div-container{
                margin-left:50px;
                display:inline-block;
                vertical-align: top;
        }
        .info-label-div-container h5{
                font-size:18px;
        }
        .info-label-div p{
                padding : 5px;
                font-size: 15px!important;
        }

        </style>
</head>
<body>
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h5 style="text-align:center;">STORAGE ASSIGN</h5>
  </div>
  <div class="modal-body">
        <div class="clearfix" style="padding:20px">
    <form style="display:inline-block" method ="post" action="aloc_strg.php">
      <div class="form-group">
        <label class="control-label" for="mgmt_num">STORAGE번호</label>
        <select onclick="setRack()" id="rack_mgmt_num" name="mgmt_num" class="form-control" required="">
        <?php
          $query = "SELECT mgmt_num FROM storage ORDER BY mgmt_num";
          $stmt = $conn->prepare($query);
          $stmt->execute();
          while($list = $stmt->fetch(PDO::FETCH_NUM)){
            print "<option>".$list[0]."</option>";
          }
        ?>
        </select>
        </div>
      <div class="form-group">
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
        <select id="aloc_size" name="aloc_size" class="form-control"></select>
        <input onfocusout = "nasLimit()" name = "input_aloc_nas" id = "input_aloc_nas" class="form-control" style="display:none" for="input_aloc_nas" required="">          </input>
      </div>
      <div align="right">
        <input id="submit_button" style="display:none" type="submit" class="btn btn-default" name="submit" value="assign"></input>
      </div>
    </form>

        <div class=" info-label-div-container" style="display:inline-block">
                <div id="rack_info" class="info-label-container">
                        <h5>Storage Information</h5>
                        <div class="info-label-div" >
                                <span class="label label-info info-label">name</span>
                                <p id = "spec"></p>
                        </div>
                        <div class="info-label-div" >
                                <span class="label label-warning info-label">spec</span>
                                <p id = "disk_spec"></p>
                        </div>
                        <div class="info-label-div" >
                                <span class="label label-primary info-label">type</span>
                                <p id = "type"></p>
                        </div>
                        <div class="info-label-div" >
                                <span class="label label-danger info-label">aloc_unit</span>
                                <p id = "aloc_unit"></p>
                        </div>
                </div>
        </div>
        <div align="right">
                <button onclick="submitProp()" class = "btn btn-default" >assign</input>
        </div>
</div>
</div>

  <script>
        var xmlhttp;
        var naslimit;
        if(window.ActiveXObject){
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        else {
                xmlhttp=new XMLHttpRequest("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
          if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		var temp = xmlhttp.responseText;
		temp=trim(temp);
		temp=temp.split("<br>");
                document.getElementById("spec").innerHTML = temp[0];
                document.getElementById("disk_spec").innerHTML =temp[1];
                document.getElementById("type").innerHTML = temp[2];
                document.getElementById("aloc_unit").innerHTML = temp[3];
                if(temp[2] != "NAS"){
                        document.getElementById("input_aloc_nas").value = '0';
                        document.getElementById("input_aloc_nas").disabled=true;
                        document.getElementById("input_aloc_nas").style.display = "none";
                        document.getElementById("aloc_size").style.display = "";
                        document.getElementById("aloc_size").innerHTML = temp[4];
                }
                else {
                        document.getElementById("aloc_size").style.display = "none";
                        document.getElementById("input_aloc_nas").disabled=false;
                        document.getElementById("input_aloc_nas").style.display = "";
			document.getElementById("aloc_size").value = 0;
                        naslimit=temp[4];
                        }
                }

        }

        function setRack(){
                var mgmt_num =  document.getElementById("rack_mgmt_num").value;
                xmlhttp.open("POST", "get_aloc_limit.php?timeStamp=" + new Date().getTime(), true);
                xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xmlhttp.send("mgmt_num="+mgmt_num);

        }

        function nasLimit(){
                var input_nas = document.getElementById("input_aloc_nas").value;
                if(Number(input_nas) >Number( naslimit)){
                        document.getElementById("input_aloc_nas").value="";
                        window.alert("최대 할당량을 초과하였습니다.");
                        $(this).unbind('focus');
                }
        }
        function submitProp(){
                document.getElementById("submit_button").click();
        }
	function trim(str){ 
		return str.replace(/(^\s*)|(\s*$)/gi, ""); 
	}
	$(function() {
		$(window).keydown(function (event) {
			if(event.keyCode==13) {
				event.preventDefault();
				return false;
			}
		});
	});
   </script>
</body>
</html>
