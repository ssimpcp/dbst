<?php
  require_once('db_connect.php');
?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
  </head>
  <body>
  <?php
    $query = "INSERT INTO asset (asset_num, reg_date, asset_name, standard, price, assembler, service_life) VALUES (:asset_num, :reg_date, :asset_name, :standard, :price, :assembler, :service_life)";
    $asset_num = $_POST['asset_num'];
    $reg_date = $_POST['reg_date'];
    $asset_name = $_POST['asset_name'];
    $standard = $_POST['standard'];
    $price = $_POST['price'];
    $assembler = $_POST['assembler'];
    $service_life = $_POST['service_life'];
    
    $stmt=$conn->prepare($query);
    
    $stmt->bindParam(':asset_num', $asset_num);
    $stmt->bindParam(':reg_date', $reg_date);
    $stmt->bindParam(':asset_name', $asset_name);
    $stmt->bindParam(':standard', $standard);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':assembler', $assembler);
    $stmt->bindParam(':service_life', $service_life);
    $stmt->execute();
    
    $query = "INSERT INTO total_asset (asset_num, s, n, d, r, un_s, un_n, un_d, un_r) VALUES (:asset_num, :s, :n, :d, :r, :un_s, :un_n, :un_d, :un_r)";

    $s = $_POST['s'];
    $n = $_POST['n'];
    $d = $_POST['d'];
    $r = $_POST['r'];

    $stmt=$conn->prepare($query);
    
    $stmt->bindParam(':asset_num', $asset_num);
    $stmt->bindParam(':s', $s);
    $stmt->bindParam(':n', $n);
    $stmt->bindParam(':d', $d);
    $stmt->bindParam(':r', $r);
    $stmt->bindParam(':un_s', $s);
    $stmt->bindParam(':un_n', $n);
    $stmt->bindParam(':un_d', $d);
    $stmt->bindParam(':un_r', $r);
    $stmt->execute();
  ?>
  </body>
</html>
<meta http-equiv='refresh' content='0;url=total.php'>
