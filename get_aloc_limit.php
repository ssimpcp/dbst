<?php
  require_once("db_connect.php");
  $mgmt_num = $_REQUEST['mgmt_num'];
  $query = "SELECT spec, disk_spec, Vol, aloc_unit, type FROM storage WHERE mgmt_num = :mgmt_num";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(":mgmt_num", $mgmt_num);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_NUM);

        $spec = $result[0];
        $disk_spec = $result[1];
        $Vol = $result[2];
        $aloc_unit = $result[3];
        $type = $result[4];
        $delimeter = "<br>";
        $cons = "";
        $aloc_unit = (float)($result[3]/1000);
        $query = "SELECT SUM(aloc) FROM storage_info WHERE mgmt_num = :mgmt_num";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":mgmt_num", $mgmt_num);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_NUM);
        $used = $result[0];
        $cons;
        $cons .= $spec."<br>".$disk_spec."<br>".$type."<br>";
        if($type == "SAN"){
                $remain = $Vol - $used;
                $aloc = 0;
                $cons .= $aloc_unit."<br>";
                while($aloc < $remain && $aloc_unit > 0 ){
                        $cons .= "<option>".$aloc."</option>";
                        $aloc = $aloc + $aloc_unit;
                }
        }
        else if($type== "NAS" ){
                $temp = ($Vol-$used);
                $cons .= "FREE(Max : ".$temp.")<br>";
                $cons .= $temp;
        }
        else
        {
                if(!$used) $used=0;
                $aloc = ($Vol-$used);

                $cons .= "<option>".$aloc."</option>"."<br>";
                $cons .= "<option>".$aloc."</option>";
        }
        echo $cons;
?>
