<script>
if(localStorage.getItem("login_token")){
  console.log(localStorage.getItem("login_token"));
  var string_email_cookie = "email=" + localStorage.getItem("email");
  document.cookie = string_email_cookie;
}else{
  //console.log("No hay datos");
  window.location="../security/login.php";
}
</script>
<?php 
$title='TubeKids-NewVideo';
$tituloPagina = 'New Video';
require_once '../shared/header.php';
require_once '../shared/menu.php';
require_once '../shared/db.php';
$user_email = $_GET["user_email"] ?? '';
$email_cookie =  $_COOKIE['email'];
//echo $email_cookie;
 ?>
 <link rel="stylesheet" type="text/css" href="../assets/css/style_index_producto.css">


<form method="POST" enctype="multipart/form-data">
<div class="caja_login" style="display: flex; position: absolute; margin-top: -7%; margin-left: 47%;">
  <img src="../assets/images/new_video.png">
</div>
<div class="div_tabla_crear_producto" style="margin-top: 120px;">
  <table class="tabla_crear_producto" cellspacing="0" cellpadding="6">
    <tr>
      <td>USER EMAIL: <input type="text" disabled="disabled" name="user_email" autofocus placeholder="User email" value="<?= isset($_POST['user_email']) ? $_POST['user_email'] : $email_cookie; ?>"></td>
    </tr>
    <tr>
      <td>VIDEO: <div style="display: inline-flex; position: absolute; margin-left: 42px;"><input type="file" name="resource"></div></td>
    </tr>
    <tr>
      <td>NAME: <input type="text" name="name" placeholder="name" value="<?= isset($_POST['name']) ? $_POST['name'] : ''; ?>"></td>
    </tr>
    <tr>
      <td><button class="btn btn-success" type="submit" name="btn_new_video">Save</button></td>
    </tr>
  </table>
</div>
</form>

 <?php 
 /*
 <select name="cars">
    <option value="volvo">Volvo</option>
    <option value="saab">Saab</option>
    <option value="fiat">Fiat</option>
    <option value="audi">Audi</option>
  </select>
  */
 require_once '../shared/footer.php';
  ?>
