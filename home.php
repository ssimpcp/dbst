<?php
	session_start();
	if(!isset($_SESSION['token'])){
		echo "<meta http-equiv='refresh' content='0;url=login.php'>";
		exit;
	}
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
    <style>
                th{
                        text-align : center;
                }
                td{
                        text-align : right;
                }
                body {
                        font: 400 15px Lato, sans-serif;
                        line-height: 1.8;
                        color: #818181;
                }
                h1{ <!--jumbotron-->
                        font-size: 40px;
                        margin-top: 30px;
                        text-transform: uppercase;
                        color: #303030;
                        font-weight: 600;
                        text-align : center;
                }
                h2 { <!--fluid-name-->
                        font-size: 30px;
						margin-top: 30px;
                        text-transform: uppercase;
                        color: #303030;
                        font-weight: 600;
                        margin-bottom: 30px;
						text-align : center;
                }
                .jumbotron {
			margin-top: 50px;
                        background-color: #f4511e;
                        color: #fff;
                        padding: 100px 25px;
                        font-family: Montserrat, sans-serif;
                }
                .container-name{
                        padding: 10px 25px 10px 25px;
                        width : 100%;
                }
                .container-fluid {
                        padding : 10px 100px;
                        width : 100%;
                }
                .container-footer{
                                width : 100px;
                                margin: 0 auto;
                }
                .col-sm-8{
                        width : 100%;
                }
        </style>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
      
        <div class="jumbotron text-center">
                <h1>Database Team Project</h1>
        </div>
		
		<div w3-include-html="navbar.html"></div>
			<script>
				w3IncludeHTML();
			</script>

        <div id="about" class="container-name">
                <h1>SERVICE RESOURCES <script> currentDate();</script></h1><br>
        </div>

        <!-- Container (table section) -->
        <div id="about" class="container-fluid">A
                <div class="row">
                        <div class="col-sm-8">
                                <table class="table table-striped table-hover ">
                                       <thead>
                                                <tr>
                                                        <th>SERVICE</th>
                                                        <th>CPU(Cores)</th>
                                                        <th>SAN(TB)</th>
                                                        <th>NAS(TB)</th>
                                                        <th>DISK_TOTAL</th>
                                                        <th>TAPE(TB)</th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                                <tr>
                                                        <td>Alice</td>
                                                        <td>Column content</td>
                                                        <td>Column content</td>
                                                        <td>Column content</td>
                                                        <td>Column content</td>
                                                        <td>Column content</td>
                                                </tr>
                                        </tbody>
                                </table>
            </div>
                </div>
        </div>           
</body>
</html>


