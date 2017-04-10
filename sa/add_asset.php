<?php
  require_once('db_connect.php');
?>
<!DOCTYPE html>
<html lang="en">
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
    <!-- jS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
            </form>
          </ul>
        </div>
      </div>
    </nav>
    <div class="jumbotron text-center">
      <h1>Database Team Project</h1> 
    </div>
    <?php
      $query = "SELECT max(asset_num) FROM asset";
      $stmt = $conn->prepare($query);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_NUM);
      $last_id = (string)$result[0];
      if(strcmp(substr($last_id, 0, 4), date("Y"))){
	$new_id = (string)date("Y")."000001";
      }else{
	$new_id = $result[0] + 1;
      }	
    ?>
    <form method="post" enctype="multipart/form-data" action="reg_asset.php">
                 <table style="width:70%">
                  <tbody><tr>
                    <th>자산번호</th>
                    <td colspan="2"><input type="text" name="asset_num" value = "<?php echo $new_id; ?>" required=""></td>
                  </tr>
                  <tr>
                    <th>취득일</th>
                    <td colspan="2"><input type="date" name="reg_date" required=""></td>
                  </tr>
                  <tr>
                    <th>자산명</th>
                    <td colspan="2"><input type="text" name="asset_name" required=""></td>
                  </tr>
                  <tr>
                    <th>규격</th>
                    <td colspan="2"><input type="text" name="standard" required=""></td>
                  </tr>
                  <tr>
                    <th>취득원가</th>
                    <td colspan="2"><input type="text" name="price" required=""></td>
                    
                  </tr>
                  <tr>
                    <th>구입처</th>
                    <td colspan="2"><input type="text" name="assembler" required=""></td>
                  </tr>
                  <tr>
                    <th>내용연수</th>
                    <td colspan="2"><input type="text" name="service_life" required=""></td>
                  </tr>
  		  <tr>
                    <th>S</th>
                    <td colspan="2"><input type="text" name="s" required=""></td>
 		  </tr>
                  <tr>
                    </tr><tr>
                    <th>N</th>
                    <td colspan="2"><input type="text" name="n" required=""></td>
 		  </tr>
  		  <tr>
                    <th>D</th>
                    <td colspan="2"><input type="text" name="d" required=""></td>
 		  </tr>
  		  <tr>
                    <th>R</th>
                    <td colspan="2"><input type="text" name="r" required=""></td>
 		  </tr>
                    <tr><td align="right" colspan="3"><input type="submit" class="btn btn-default submit" name="submit" value="등록"></td>
                  </tr>
                 </tbody></table>
               </form>

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

