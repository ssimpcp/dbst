<?php
  require_once('db_connect.php');
?>
<html>
        <head>
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
        <script>
                var rack_mgmt_num = "SELECT RACK!"
        </script>
        <style>
                .container-fluid{
                        padding: 10px 100px;
                        width : 80%;
                        float : left;
                }
                .container-sidebar{
                        padding : 5px;
                        width : 20%;
                        float : right;
                }
                h4{
                        text-align:center!important;
                }
        </style>
</head>

<body >
        <div id="about" class="container-name">
                <h1> RACK INFO </h1>
        </div>

        <div w3-include-html="navbar.html"></div>
                <script>
                        w3IncludeHTML();
        </script>

        <div class="add-button-right">
        <a type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#AssignModal" href="rack_info_modal.php">ASSIGN</a>
</div>


        <div class ="clearfix">
                <div id="about" class="container-fluid">
                        <h4 id="rack_name"><script>document.write(rack_mgmt_num)</script></h4>
                        <table id = "rack_info_table" class="table table-hover">
                        </table>
                </div>
                <div id="choose_rack" class = "container-sidebar">
                        <ul id="rack_list">
                        <?php
                          $query = "SELECT mgmt_num FROM rack ORDER BY mgmt_num";
                          $stmt = $conn->prepare($query);
                          $stmt->execute();
                          while($result = $stmt->fetch(PDO::FETCH_NUM)){
                            print "<li>".$result[0]."</li>";
                          }
                        ?>
                        </ul>
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

        <script>
	var lock;
        var rack_list = document.getElementById('rack_list');
	var xmlhttp2;
        if(window.ActiveXOjbect) {
                xmlhttp2 = new ActiveXObject("Microsoft.XMLHTTP");
        }else{
                xmlhttp2 = new XMLHttpRequest();
        }
        xmlhttp2.onreadystatechange = function() {
                if(xmlhttp2.readyState == 4 && xmlhttp2.status == 200) {
                        document.getElementById('rack_info_table').innerHTML = xmlhttp2.responseText;
                        document.getElementById('rack_name').innerHTML = rack_mgmt_num;
                }
        };
        rack_list.onclick = function(event) {
		lock=false;
                var target = getEventTarget(event);
                rack_mgmt_num = target.innerHTML;
		target.color="blue";
                if( rack_mgmt_num.length < 10){
                        xmlhttp2.open("POST", "get_rack_info.php", true);
                        xmlhttp2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                        xmlhttp2.send("rack_mgmt_num="+rack_mgmt_num);
                }
        };
	rack_list.onmouseover = function(event){
		var list = rack_list;
		var ulist = getEventTarget(event);
		if((list != ulist)&&(lock != false)){
			var target = getEventTarget(event);
			rack_mgmt_num = target.innerHTML;
			if( rack_mgmt_num.length < 10){
				xmlhttp2.open("POST", "get_rack_info.php", true);
				xmlhttp2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xmlhttp2.send("rack_mgmt_num="+rack_mgmt_num);
			}	
		}
	}
	function deleteConfirm(x){
	var r = confirm("삭제하시겠습니까?");
	if(r == true) {
	location.replace("del_asset.php?category=rack_info&mgmt_num="+x);
		}
	}
        function getEventTarget(e) {
                e = e || window.event;
                return e.target || e.srcElement;
        }
</script>
</body>
