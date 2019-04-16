<script>
if(localStorage.getItem("two_factor")){
  console.log(localStorage.getItem("login_token"));
  var string_email_cookie = "email=" + localStorage.getItem("email");
  var login_token_cookie = localStorage.getItem("login_token");
  var string_login_token_cookie = "login_token=".concat(login_token_cookie);
  document.cookie = string_email_cookie;
  document.cookie = string_login_token_cookie;
}else{
  //console.log("No hay datos");
  window.location="../security/login.php";
}
</script>
<?php 
//localStorage.getItem("login_token")
$title='TubeKids-EditVideo';
$tituloPagina = 'Edit Video';
require_once '../shared/header.php';
require_once '../shared/menu.php';
require_once '../shared/db.php';
//$user_email = $_GET["user_email"] ?? '';
$email_cookie =  $_COOKIE['email'];
$login_token_cookie =  $_COOKIE['login_token'];
//echo $email_cookie;
//echo $email_cookie;
$id = $_GET["id"] ?? '';
$name = $_GET["name"] ?? '';
$new_name = $_POST["new_name"] ?? '';
if(isset($_POST["edit"]) && $id != '' && $new_name != ''){

  $response = $video_model->databaseEditVideo($id, $new_name, $login_token_cookie);
  //echo $response;
  $negative_response = '{"status":"Authorization Token not found"}';
  if($response != $negative_response)
  {
  ?>
          <div class="alert alert-success" role="alert">
            Edited successfully!
          </div>
          <script>
            window.location="./index.php";
          </script>
  <?php
  }else{
    ?>
      <div class="alert alert-danger" role="alert">
         Not found!
      </div>
    <?php
  }

}

 ?>

 <link rel="stylesheet" type="text/css" href="../assets/css/style_index_producto.css">
<form method="POST">
<div class="caja_login" style="display: flex; position: absolute; margin-top: -7%; margin-left: 44%;">
  <img src="../assets/images/edit_video.png">
</div>
<div class="div_tabla_crear_producto" style="margin-top: 120px;">
  <table class="tabla_crear_producto" cellspacing="0" cellpadding="6">
    <tr>
      <td>ID: <input type="text" disabled="disabled" name="id" value="<?= isset($_POST['id']) ? $_POST['id'] : $id; ?>"></td>
    </tr>
    <tr>
      <td>NEW NAME: <input type="text" name="new_name" value="<?= isset($_POST['name']) ? $_POST['name'] : $name; ?>"></td>
    </tr>
    <tr>
      <td><button style="width: 175px; margin-left: 90px;" class="btn btn-warning" type="submit" name="edit">Edit</button></td>
    </tr>
    <tr>
      <td><a style="font-size: 16px; width: 175px; margin-left: 90px;"  class="btn btn-primary"  role="button" href="./index.php">Back</button></td>
    </tr>
  </table>
</div>
</form>

 <?php 
 require_once '../shared/footer.php';
  ?>