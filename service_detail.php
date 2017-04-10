<?php
  require_once("db_connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
</head>
<body>
  <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal">&times;</button>	   <h5 style="text-align:center;">SERVICE REGISTER</h5>
  </div>
  <div class="modal-body">
      <h5 style="text-align:center">ADD - SERVICE</h5><br>
    <div class = "container-fluid">
      <form method="POST" enctype="multipart/form-data" action="add_detail.php">
        <table>
          <tbody>
            <tr>
              <td>Service Name</td>
              <td><input type="text" name="service_name" required=""> </td>
            </tr>
            <tr>
              <td>Service Info</td>
              <td><input type="text" name="service_info"></td>
            </tr>
            <tr>
              <td colspan="2">
                <input type="hidden" name="category" value="service">
              </td>
            </tr>
          </tbody>
        </table>
        <input type="submit" class="btn btn-default submit" name="submit" value="등록">
      </form>
    </div>
  </body>
</html>

