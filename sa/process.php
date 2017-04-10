<? session_start(); ?>
<?php
	$member_id = "user";
	$member_password="password";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Database Management System</title>
  <meta http-equiv="Content-Type" content = "text/html"; charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edfe">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap -->
  <link href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <!-- CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
  <!-- js -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  body {
      font: 400 15px Lato, sans-serif;
      line-height: 1.8;
      color: #818181;
  }
  h2 {
      font-size: 24px;
      text-transform: uppercase;
      color: #303030;
      font-weight: 600;
      margin-bottom: 30px;
  }
  h4 {
      font-size: 19px;
      line-height: 1.375em;
      color: #303030;
      font-weight: 400;
      margin-bottom: 30px;
  }  
  .jumbotron {
      background-color: #f4511e;
      color: #fff;
      padding: 100px 25px;
      font-family: Montserrat, sans-serif;
  }
  .container-fluid {
      padding: 60px 50px;
  }
  .bg-grey {
      background-color: #f6f6f6;
  }
  .logo-small {
      color: #f4511e;
      font-size: 50px;
  }
  .logo {
      color: #f4511e;
      font-size: 200px;
  }
  .thumbnail {
      padding: 0 0 15px 0;
      border: none;
      border-radius: 0;
  }
  .thumbnail img {
      width: 100%;
      height: 100%;
      margin-bottom: 10px;
  }
  .carousel-control.right, .carousel-control.left {
      background-image: none;
      color: #f4511e;
  }
  .carousel-indicators li {
      border-color: #f4511e;
  }
  .carousel-indicators li.active {
      background-color: #f4511e;
  }
  .item h4 {
      font-size: 19px;
      line-height: 1.375em;
      font-weight: 400;
      font-style: italic;
      margin: 70px 0;
  }
  .item span {
      font-style: normal;
  }
  .panel {
      border: 1px solid #f4511e; 
      border-radius:0 !important;
      transition: box-shadow 0.5s;
  }
  .panel:hover {
      box-shadow: 5px 0px 40px rgba(0,0,0, .2);
  }
  .panel-footer .btn:hover {
      border: 1px solid #f4511e;
      background-color: #fff !important;
      color: #f4511e;
  }
  .panel-heading {
      color: #fff !important;
      background-color: #f4511e !important;
      padding: 25px;
      border-bottom: 1px solid transparent;
      border-top-left-radius: 0px;
      border-top-right-radius: 0px;
      border-bottom-left-radius: 0px;
      border-bottom-right-radius: 0px;
  }
  .panel-footer {
      background-color: white !important;
  }
  .panel-footer h3 {
      font-size: 32px;
  }
  .panel-footer h4 {
      color: #aaa;
      font-size: 14px;
  }
  .panel-footer .btn {
      margin: 15px 0;
      background-color: #f4511e;
      color: #fff;
  }
  .navbar {
      margin-bottom: 0;
      background-color: #f4511e;
      z-index: 9999;
      border: 0;
      font-size: 12px !important;
      line-height: 1.42857143 !important;
      letter-spacing: 4px;
      border-radius: 0;
      font-family: Montserrat, sans-serif;
  }
  .navbar li a, .navbar .navbar-brand {
      color: #fff !important;
  }
  .navbar-nav li a:hover, .navbar-nav li.active a {
      color: #f4511e !important;
      background-color: #fff !important;
  }
  .navbar-default .navbar-toggle {
      border-color: transparent;
      color: #fff !important;
  }
  footer .glyphicon {
      font-size: 20px;
      margin-bottom: 20px;
      color: #f4511e;
  }
  .slideanim {visibility:hidden;}
  .slide {
      animation-name: slide;
      -webkit-animation-name: slide;
      animation-duration: 1s;
      -webkit-animation-duration: 1s;
      visibility: visible;
  }
  @keyframes slide {
    0% {
      opacity: 0;
      transform: translateY(70%);
    } 
    100% {
      opacity: 1;
      transform: translateY(0%);
    }
  }
  @-webkit-keyframes slide {
    0% {
      opacity: 0;
      -webkit-transform: translateY(70%);
    } 
    100% {
      opacity: 1;
      -webkit-transform: translateY(0%);
    }
  }
  @media screen and (max-width: 768px) {
    .col-sm-4 {
      text-align: center;
      margin: 25px 0;
    }
    .btn-lg {
        width: 100%;
        margin-bottom: 35px;
    }
  }
  @media screen and (max-width: 480px) {
    .logo {
        font-size: 150px;
    }
  }
   label{
      font-size: 10px;
      text-transform: uppercase;
      color: #303030;
      font-weight: 600;
      margin-bottom: 30px;
   }
  </style>
</head>
  <body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
            <span class="icon-bar"></span>                        
	  </button>
	  <a class="navbar-brand" href="index.php">DBST4</a>
	</div>
	<div class="collapse navbar-collapse" id="myNavbar">
	  <ul class="nav navbar-nav navbar-right">
	    <li><a href="index.php">HOME</a></li>
	    <li class="dropdown">
	      <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">ASSET<span class="caret"></span></a>
	      <ul class="dropdown-menu dropdown-menu-left">
		<li><a href="total.php">TOTAL</a></li>
		<li class="divider"></li>
		<li><a href="server.php">SERVER</a></li>
		<li><a href="switch.php">SWITCH</a></li>
		<li><a href="storage.php">STORAGE</a></li>
		<li><a href="rack.php">RACK</a></li>
	      </ul>
            </li>
            <li><a href="#portfolio">RACK INFO</a></li>
            <li><a href="#pricing">STORAGE INFO</a></li>
            <li><a href="#contact">SEARCH</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="jumbotron text-center">
      <h1>Database Team Project</h1> 
    </div>
<php>
		<!-- ID가 전달되었는지 검사 -->
		<? if (!isset($_POST["member_id"])) { ?>
		<p style="text-align: center;">ID가 입력되지 않았습니다.</p>
		<p style="text-align: center;"><a href="login.php">로그인하기</a></p>

		<!-- 암호가 전달되었는지 검사 -->
		<? } else if (!isset($_POST["member_password"])) { ?>
		<p style="text-align: center;">암호가 입력되지 않았습니다.</p>
		<p style="text-align: center;"><a href="login.php">로그인하기</a></p>

		<!-- ID와 암호가 전달되었다면 -->
		<? } else { ?>
			<!-- ID 잘못 입력 시 -->
			<? if(strcmp($_POST["member_id"], $member_id) != 0) { ?>
			<p style="text-align: center;">ID가 일치하지 않습니다.</p>
			<p style="text-align: center;"><a href="login.php">다시 로그인하기</a></p>
			<!-- 암호 잘못 입력 시 -->
			<? } else if (strcmp($_POST["member_password"], $member_password) != 0) { ?>
			<p style="text-align: center;">암호가 일치하지 않습니다.</p>
			<p style="text-align: center;"><a href="login.php">다시 로그인하기</a></p>
			<!-- 로그인 성공 -->
			<? } else { ?>
				<? $_SESSION["member_id"] = $_POST["member_id"]; ?>
				<? $_SESSION["member_password"] = $_POST["member_password"] ?>
			<p style="text-align: center;">로그인 성공</p>
			<p style="text-align: center;"><a href="membership.php">회원 페이지</a></p>
			<? } ?>
		<? } ?>
</php>
</body>
</html>

