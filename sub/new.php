<script>
if(localStorage.getItem("two_factor")){
  console.log(localStorage.getItem("login_token"));
  var email_cookie = localStorage.getItem("email");
  var login_token_cookie = localStorage.getItem("login_token");
  console.log(email_cookie); 
  var string_cookie = "email=".concat(email_cookie);
  var string_login_token_cookie = "login_token=".concat(login_token_cookie);
  document.cookie = string_cookie;
  document.cookie = string_login_token_cookie;
  
}else{
  window.location="../security/login.php";
}
</script>
<?php 
$title='TubeKids-New Subaccounts';
$tituloPagina = 'New Subaccounts';
require_once '../shared/header.php';
require_once '../shared/menu.php';
require_once '../shared/db.php';
$email_cookie =  $_COOKIE['email'];
$login_token_cookie =  $_COOKIE['login_token'];

if(isset($_POST['btn_register']))
{
  $verify_all_data = $sub_model->verify_all_data($_POST['full_name'], $_POST['user_name'], $_POST['pin'], $email_cookie);
  if($verify_all_data){
      //echo "Datos completos";
      if($sub_model->verify_user_available($_POST['user_name'])){
        $pin = $_POST['pin'];
        $pinLength = strlen($pin);
        if($pinLength == 6)
        {
          $response = $sub_model->register($_POST['full_name'], $_POST['user_name'], $_POST['pin'], $email_cookie, $login_token_cookie);
          //var_dump($response);
          ?>
          <div class="alert alert-success" role="alert">
            Success!
          </div>
          <?php
          return header("Location: ./index.php");
        }else{
          ?>
          <div class="alert alert-danger" role="alert">
            Wrong, PIN should have six characters!
          </div>
        <?php
        }
    }else{
      ?>
      <div class="alert alert-danger" role="alert">
        Wrong, user name are in use!
      </div>
    <?php

    }
  }else{
    ?>
      <div class="alert alert-danger" role="alert">
        Wrong, incomplete data!
      </div>
    <?php
  }

}
?>



<link rel="stylesheet" type="text/css" href="../assets/css/register_style.css">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="caja_register" style="display: flex; position: absolute; margin-top: 6%; margin-left: 45%;">
    <img src="../assets/images/registro_usuario.png">
  </div>
</nav>

<form method="POST">
  <div class="div_tabla_registro" style="margin-top: 160px;">
    <table class="tabla_registro" cellspacing="0" cellpadding="6">
      <tr>
        <td>Full name: <input type="text" id="full_name" name="full_name" autofocus placeholder="Full name" value="<?= isset($_POST['full_name']) ? $_POST['full_name'] : ''; ?>"></td>
      </tr>
      <tr>
        <td>User name: <input type="text" id="user_name" name="user_name" placeholder="User name" value="<?= isset($_POST['user_name']) ? $_POST['user_name'] : ''; ?>"></td>
      </tr>
      <tr>
        <td>Pin: <input type="password" maxlength="6" id="pin" name="pin" placeholder="PIN" value="<?= isset($_POST['pin']) ? $_POST['pin'] : ''; ?>"></td>
      </tr>
      <tr>
        <td>Father email: <input type="text" disabled="disabled" id="father_email" name="father_email" placeholder="Father email" value="<?= isset($_POST['father_email']) ? $_POST['father_email'] : $email_cookie; ?>"></td>
      </tr>
      <tr>
        <td><button style="width: 180px; margin-left: 90px;" class="btn btn-primary" id="btn_register" name="btn_register" type="submit">Register</button></td>
      </tr>
    </table>
  </div>
</form>

 <?php 
 require_once '../shared/footer.php';