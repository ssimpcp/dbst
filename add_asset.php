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
u
    <!-- jS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://www.w3schools.com/lib/w3data.js"></script>
  </head>
  <body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
	<div w3-include-html="navbar.html"></div>
                        <script>
                                w3IncludeHTML();
                        </script>
	<div class="container-name"><h1> ADD - ASSET</h1></div>
	<div class = "well">
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
	<fieldset>
    <form method="post" enctype="multipart/form-data" action="reg_asset.php">
                 <table class="input-table" style="width:70%">
                  <tbody><tr>
                    <th>자산번호</th>
                    <td colspan="2"><input class="form-control" type="text" name="asset_num" value = "<?php echo $new_id; ?>" required="" readonly></td>
                  </tr>
                  <tr>
                    <th>취득일</th>
                    <td colspan="2"><input class="form-control" type="text" name="reg_date" value = "<?php echo date("Y-m-d");?>" required="" readonly></td>
                  </tr>
                  <tr>
                    <th>자산명</th>
                    <td colspan="2"><input class="form-control" type="text" name="asset_name" required=""></td>
                  </tr>
                  <tr>
                    <th>규격</th>
                    <td colspan="2"><input class="form-control" type="text" name="standard" required=""></td>
                  </tr>
                  <tr>
                    <th>취득원가</th>
                    <td colspan="2"><input class="form-control" type="text" name="price" required=""></td>
                    
                  </tr>
                  <tr>
                    <th>구입처</th>
                    <td colspan="2"><input class="form-control" type="text" name="assembler" required=""></td>
                  </tr>
                  <tr>
                    <th>내용연수</th>
                    <td colspan="2"><input class="form-control" type="text" name="service_life" required=""></td>
                  </tr>
  		  <tr>
                    <th>S</th>
                    <td colspan="2"><input class="form-control" type="text" name="s" required=""></td>
 		  </tr>
                  <tr>
                    </tr><tr>
                    <th>N</th>
                    <td colspan="2"><input class="form-control" type="text" name="n" required=""></td>
 		  </tr>
  		  <tr>
                    <th>D</th>
                    <td colspan="2"><input class="form-control" type="text" name="d" required=""></td>
 		  </tr>
  		  <tr>
                    <th>R</th>
                    <td colspan="2"><input class="form-control" type="text" name="r" required=""></td>
 		  </tr>
                    <tr><td align="right" colspan="3"><input type="submit" class="btn btn-default submit form-control" name="submit" value="등록"></td>
                  </tr>
                 </tbody></table>
               </form>
	</fieldset>
</div>
</div>
  </body>
</html>
