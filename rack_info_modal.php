<?php
        require_once("db_connect.php");
?>
<!DOCTYPE html>
<body>
        <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 style="text-align:center;">RACK ASSIGN</h5>
        </div>
        <div class="modal-body">
		<div class="clearfix">
		<div style="float:left">
                <form method="post" action="aloc_rack.php">
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
                                <input type="text" id="ip_input" name="ip" class="form-control" onfocusout="checkIP()" required=""></input>
                        </div>
                        

		</div>
        </form>
	<div style="float:right">
		<p>hello</p>
	</div>
     </div>
	<div align="right">
		<input type="submit" class = "btn btn-default" name="submit" value = "assign"></input>
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
xmlhttp.onreadystatechange=function(){
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("index_selector").innerHTML = xmlhttp.responseText;
        }
};
xmlhttp3.onreadystatechange=function(){
	if(xmlhttp3.readyState==4 && xmlhttp3.status=200){
		document.getElementById("rack_selector").innerHTML = xmlhttp3.responseText;
	}
}

function setRack(){
        rack_mgmt_num = document.getElementById("rack_mgmt_num").value;
}
function setRackItem(){
        isSwitch = document.getElementById("rack_item").selectedIndex;
        if(isSwitch == 0){
                document.getElementById("server_div").style.display="";
                document.getElementById("switch_div").style.display="none";
        }
        else{
                document.getElementById("switch_div").style.display="";
                document.getElementById("server_div").style.display="none";
        }
}
function setItem(){
        if( isSwitch ==0){
                item_mgmt_num = document.getElementById("server_mgmt_num").value;
                setIndex();
        }
        else if(isSwitch ==1) {
                item_mgmt_num = document.getElementById("switch_mgmt_num").value;
                setIndex();
        }
}
function setIndex(){
        xmlhttp.open("POST", "get_rack_index.php", true);
        xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlhttp.send("item_mgmt_num="+item_mgmt_num+"&rack_mgmt_num="+rack_mgmt_num);

	//sdflkjsldkfj


}
function checkIP(){
        var x = document.getElementById("ip_input");
        var re = new RegExp(/^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/)
                if(!re.test(x.value)){
                        window.alert("IP형식을 맞춰주세요. xxx.xxx.xxx.xxx");
                        x.value = "";
                        $(this).unbind('focus');
                }

}
</script>
</body>
