<? session_start();?>
<?php
  require_once('db_connect.php');
?>
<!DOCTYPE html>
<html lang="en">
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
  </style>

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
    <link href="../navbar.css" rel = "stylesheet" type="text/css">
    <!-- jS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://www.w3schools.com/lib/w3data.js"></script>
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
  	    <form class="navbar-form navbar-left" role="search">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
              </div>
              <button type="submit" class="btn btn-default">SEARCH</button>
		<label>관리자님</label>
            </form>
          </ul>
        </div>
      </div>
    </nav>
    <div class="jumbotron text-center">
      <h1>Database Team Project</h1> 
    </div>

    </div>
    <div align="center">
	<div class="text-right">
	<a href="add_asset.php" class="btn btn-default">ADD</a>
	</div>
      <table style="width:95%">
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
          $query = "SELECT asset.asset_num, reg_date,  asset_name, standard, price, assembler, service_life, s, n, d, r  FROM asset, total_asset where asset.asset_num = total_asset.asset_num";
          $stmt = $conn->prepare($query);
          $stmt->execute();
          while( $result = $stmt->fetch(PDO::FETCH_NUM) ) {
            print '<tr><td>';
              print $result[0];
            print '</td><td>';
              print $result[1];
            print '</td><td>';
              print $result[2];
            print '</td><td>';
              print $result[3];
            print '</td><td>';
              print $result[4];
            print '</td><td>';
              print $result[5];
            print '</td><td>';
              print $result[6];
            print '</td><td>';
              print $result[7];
            print '</td><td>';
              print $result[8];
            print '</td><td>';
              print $result[9];
            print '</td><td>';
              print $result[10];
            print '</td><td>';
              print '<a type="button" class="btn btn-default" href="del_asset.php?asset_num='.$result[0].'">delete</a>';
            print '</td></tr>';
          }
        ?>
	</tbody>
      </table>
    </div>
    <script>
    $(document).ready(function(){
      // Add smooth scrolling to all links in navbar + footer link
      $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
          // Prevent default anchor click behavior
          event.preventDefault();

          // Store hash
          var hash = this.hash;

          // Using jQuery's animate() method to add smooth page scroll
          // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
          $('html, body').animate({
            scrollTop: $(hash).offset().top
          }, 900, function(){
   
            // Add hash (#) to URL when done scrolling (default click behavior)
            window.location.hash = hash;
          });
        } // End if
      });
      $(window).scroll(function() {
        $(".slideanim").each(function(){
          var pos = $(this).offset().top;

          var winTop = $(window).scrollTop();
          if (pos < winTop + 600) {
            $(this).addClass("slide");
          }
        });
      });
    })
    </script>		
  </body>
</html>



