<?php
        require_once("db_connect.php");
?>
<!DOCTYPE html>
<head>
	<style>
	.info-label-div{
		display:block;
		margin-left : 20px;
	}
	.info-label-container{
		margin-top:100px;
		display:none;
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
                <h5 style="text-align:center;">RACK ASSIGN</h5>
        </div>
        <div class="modal-body">
		<div class="clearfix" style="padding:20px">
	                <form style="display:inline-block" method="post" action="aloc_rack.php">
        	                <div class = "form-group">
	                                <label>SERVICE 선택</label>
	                                <select id = "service_selector" class = "form-control" name = "service_name" required="">
	                                        <?php
	                                                $query = "SELECT service_name FROM service WHERE service_name <> 'FREE'";
	                                                $stmt=$conn->prepare($query);
	                                                $stmt->execute();
	                                                while($list=$stmt->fetch(PDO::FETCH_NUM)){
	                                                        $service .= "<option>".$list[0]."</option>";
	                                                }
	                                                print $service;
	                                        ?>
	                                </select>
        	                </div>
                	        <div class = "form-group">
	                                <label>RACK 선택</label>
	                                <select onclick="setRack()" id="rack_mgmt_num" class="form-control" name = "rack_mgmt_num"  required="">
	                                        <?php
	                                                $query = "SELECT mgmt_num from rack";
	                                                $stmt=$conn->prepare($query);
	                                                $stmt->execute();
	                                                $server="";
	                                                $server_slot="";
	                                                while($list = $stmt->fetch(PDO::FETCH_NUM)){
	                                                        $server .= "<option>".$list[0]."</option>";
	                                                }
	                                                print $server;
	                                        ?>
	                                </select>
				</div>
	                        <div class="form-group">
	                                <label>SERVER/SWITCH</label>
	                                <select onclick = "setRackItem()" id="rack_item" name="type" class="form-control" required="">
	                                        <option>SERVER</option>
	                                        <option>SWITCH</option>
	                                </select>
	                        </div>
	                        <div id="server_div" class="form-group" style="display:none">
	                                <label>서버관리번호</label>
	                                <select id="server_mgmt_num" class = "form-control" name="se_mgmt_num"  onclick = "setItem()">
	                                        <?php
	                                                $query = "SELECT mgmt_num, slot_size from server where server.mgmt_num NOT IN(SELECT mgmt_num from server natural join rack_info)";
	                                                $stmt=$conn->prepare($query);
	                                                $stmt->execute();
	                                                $server="";
	                                                while($list = $stmt->fetch(PDO::FETCH_NUM)){
	                                                        $server .= "<option>".$list[0]."</option>";
	                                                }
	                                                print $server;
	                                        ?>
	                                </select>
	                        </div>
	                        <div id="switch_div" class="form-group" style="display:none">
	                                <label>스위치관리번호</label>
	                                <select id="switch_mgmt_num" class="form-control" name="sw_mgmt_num" onclick = "setItem()">
	                                        <?php
	                                                $query = "SELECT mgmt_num, slot_size from switch where switch.mgmt_num NOT IN(SELECT mgmt_num from switch natural join rack_info)";
	                                                $stmt=$conn->prepare($query);
	                                                $stmt->execute();
	                                                $switch = "";
	                                                while($list = $stmt->fetch(PDO::FETCH_NUM)){
	                                                        $switch .= "<option>".$list[0]."</option>";
	                                                }
	                                                print $switch;
	                                        ?>
	                                </select>
	                        </div>
        	                <div class="form-group">
	                                <label>index</label>
	                                <select id = "index_selector" name="index" class="form-control" required="">
	                                </select>
	                        </div>
	                        <div class="form-group">
	                                <label class="control-label" for="usage">IP</label>
	                                <input type="text" id="ip_input" name="ip" class="form-control" onfocusout="checkIP()"required=""></input>
	                        </div>
				<input id="submit_button" style="display:none" type="submit" class="btn btn-default" name="submit" value="assign"></input>
			</form>

	                        
	
			<div class=" info-label-div-container" style="display:inline-block">
				
				<div id="rack_info" class="info-label-container">	
					<h5>Rack Information</h5>
					<div class="info-label-div" >
						<span class="label label-info info-label">spec</span>
						<p id = "rack_spec"></p>
					</div>
					<div class="info-label-div" > 
						<span class="label label-warning info-label">location</span>
						<p id = "rack_location"></p>
					</div>
				</div>
	
				<div id="item_info" class="info-label-container">
					<h5>Item Information</h5>
					<div class="info-label-div">
						<span class="label label-info info-label">spec</span>
						<p id="item_spec"></p>
	
					</div>
					<div id="server_core_div" style="display:none" class="info-label-div" >
						<span class="label label-warning info-label">core</span>
						<p id="server_core"></p>
					</div>
				</div>
			</div>
			<div align="right">
				<button onclick="submitProp()" class = "btn btn-default" >assign</input>
			</div>
		</div>
	</div>
	
<script>
var rack_mgmt_num;
var isSwitch;
var item_mgmt_num;
var xmlhttp;
if(window.ActiveXObject){
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	xmlhttp3 = new ActiveXObject("Microsoft.XMLHTTP");
}else{
        xmlhttp = new XMLHttpRequest();
	xmlhttp3 = new XMLHttpRequest();
}

function setRack(){
        rack_mgmt_num = document.getElementById("rack_mgmt_num").value;
	getRackSpec();
	document.getElementById("rack_info").style.display="inline";
}

function getItemSpec(){
	xmlhttp.open("POST", "get_item.php", true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send("item_mgmt_num="+item_mgmt_num);
}
function getRackSpec(){
	xmlhttp.open("POST", "get_item.php", true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send("item_mgmt_num="+rack_mgmt_num);

}
$(function(){
	$(window).keydown(function(event){
		if(event.keyCode==13){
			event.preventDefault();
			return false;
		}
	});
});

function submitProp(){
	if(window.event.keycode==13){
		event.preventDefault();
		return false;
	}
	else	{
		document.getElementById("submit_button").click();
	}
}

xmlhttp.onreadystatechange=function(){
	if(xmlhttp.readyState == 4 &&xmlhttp.status==200){
		var temp=xmlhttp.responseText;
		temp = trim(temp);
		if(temp.startsWith("R")){
			var result=temp.split("<br>");
			document.getElementById("rack_spec").innerHTML=result[0].substring(1);
 			document.getElementById("rack_location").innerHTML=result[1];
		}
		else if(temp.startsWith("S")){
			var result=temp.split("<br>");
			document.getElementById("item_spec").innerHTML=result[0].substring(1);
			document.getElementById("server_core").innerHTML=result[1];
		}
		else if (temp.startsWith("N")){
			document.getElementById("item_spec").innerHTML=temp.substring(1);
		}
	}
}

xmlhttp3.onreadystatechange=function(){
	if(xmlhttp3.readyState==4&&xmlhttp3.status==200){
		document.getElementById("index_selector").innerHTML=xmlhttp3.responseText;
	}
}

function setRackItem(){
        isSwitch = document.getElementById("rack_item").selectedIndex;
        if(isSwitch == 0){
                document.getElementById("server_div").style.display="";
                document.getElementById("switch_div").style.display="none";
		document.getElementById("server_core_div").style.display="";
		document.getElementById("item_info").style.display="block";
        }
        else{
                document.getElementById("switch_div").style.display="";
                document.getElementById("server_div").style.display="none";
		document.getElementById("server_core_div").style.display="none";
		document.getElementById("item_info").style.display="block";
        }
}
function setItem(){
        if( isSwitch ==0){
                item_mgmt_num = document.getElementById("server_mgmt_num").value;
                setIndex();
		getItemSpec();
        }
        else if(isSwitch ==1) {
                item_mgmt_num = document.getElementById("switch_mgmt_num").value;
                setIndex();
		getItemSpec();
        }
}
function setIndex(){
        xmlhttp3.open("POST", "get_rack_index.php", true);
        xmlhttp3.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp3.send("item_mgmt_num="+item_mgmt_num+"&rack_mgmt_num="+rack_mgmt_num);
}
function checkIP(){
        var x = document.getElementById("ip_input");
        var re = new RegExp(/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/)
                if(!re.test(x.value)&&re){
			x.value="";
                        $(this).unbind('focus');
                        window.alert("IP형식을 맞춰주세요. xxx.xxx.xxx.xxx");
                }

}
function trim(str){ 
  return str.replace(/(^\s*)|(\s*$)/gi, ""); 
}
</script>
</body>
