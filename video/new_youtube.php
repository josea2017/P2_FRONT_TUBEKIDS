<script>
if(localStorage.getItem("login_token")){
  console.log(localStorage.getItem("login_token"));
  var string_email_cookie = "email=" + localStorage.getItem("email");
  var string_login_token_cookie = "login_token=" + localStorage.getItem("login_token");
  document.cookie = string_email_cookie;
  document.cookie = string_login_token_cookie;
}else{
  //console.log("No hay datos");
  window.location="../security/login.php";
}
</script>
<?php 
$title='TubeKids-NewYouTubeVideo';
$tituloPagina = 'New YouTube Video';
require_once '../shared/header.php';
require_once '../shared/menu.php';
require_once '../shared/db.php';
//$user_email = $_GET["user_email"] ?? '';
$email_cookie =  $_COOKIE['email'];
$login_token_cookie =  $_COOKIE['login_token'];
echo $email_cookie;
//echo $email_cookie;
if(isset($_POST['btn_new_video'])){
    $resource = $_POST['resource'];
    $all_data = $video_model->verify_all_data($email_cookie, $resource, $_POST['name']);
    //Verificar que todos los datos del formulario esten completos
    if($all_data == true){
        //echo "Todos los datos";
       $response = $video_model->save_youtube_video($email_cookie, $resource, $_POST['name'], $login_token_cookie);
        
        ?>
          <div class="alert alert-success" role="alert">
            Done successfully!
          </div>
          <script>
            window.location="./index.php";
          </script>
        <?php
    }else{
        ?>
          <div class="alert alert-danger" role="alert">
            Wrong, incomplete data!
          </div>
        <?php
    }
}
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
      <td>VIDEO URL: <input type="text" name="resource" autofocus placeholder="Video URL" value="<?= isset($_POST['resource']) ? $_POST['resource'] : ''; ?>"></td>
    </tr>
    <tr>
      <td>NAME: <input type="text" name="name" placeholder="Name" value="<?= isset($_POST['name']) ? $_POST['name'] : ''; ?>"></td>
    </tr>
    <tr>
      <td><button class="btn btn-success" type="submit" name="btn_new_video">Save</button></td>
    </tr>
  </table>
</div>
</form>

 <?php 

 require_once '../shared/footer.php';
  ?>
