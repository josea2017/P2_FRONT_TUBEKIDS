<script>
if(localStorage.getItem("login_token")){

  var email_cookie = localStorage.getItem("email");
  var login_token_cookie = localStorage.getItem("login_token");
  var string_cookie = "email=".concat(email_cookie);
  var string_login_token_cookie = "login_token=".concat(login_token_cookie);
  document.cookie = string_cookie;
  document.cookie = string_login_token_cookie;  

}else{
  //console.log("No hay datos");
  window.location="./login.php";
}
</script>

<?php 
$title='TubeKids-2FA';
require_once '../shared/db.php';
require_once '../shared/header.php';
$email_cookie =  $_COOKIE['email'];
/*
<script>
if(localStorage.getItem("login_token")){

  var email_cookie = localStorage.getItem("email");
  var login_token_cookie = localStorage.getItem("login_token");
  var string_cookie = "email=".concat(email_cookie);
  var string_login_token_cookie = "login_token=".concat(login_token_cookie);
  document.cookie = string_cookie;
  document.cookie = string_login_token_cookie;  

}else{
  //console.log("No hay datos");
  window.location="../security/login.php";
}
</script>
*/
if(isset($_POST['btn_authy'])){
    if($_POST['authy_token'] != ''){
        //echo "Bien";
        //true or false
        $authy_token_access = $register_model->verifyAuthyToken($email_cookie, $_POST['authy_token']);
        //var_dump($authy_token_access);
        //var_dump($authy_token_access);
        if($authy_token_access == "true"){
            //echo "Autorizado";
            //var_dump($authy_token_access);
            ?>
            <script>
              localStorage.setItem('two_factor', 'autorizado');
              window.location="../home/index.php";
            </script>
          <?php
        }else{
        ?>
            <div class="alert alert-danger" role="alert">
                Wrong, Unauthorized!
            </div>
        <?php
        }
    }else{
    ?>
        <div class="alert alert-danger" role="alert">
            Wrong, Token not provided!
        </div>
    <?php
    }
}

?>

<link rel="stylesheet" type="text/css" href="../assets/css/register_style.css">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a id="titulo_registro_eshop" class="navbar-brand" href="#">TubeKids 2FA</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="caja_register" style="display: flex; position: absolute; margin-top: 14%; margin-left: 41%;">
    <img src="../assets/images/authy_token.png">
  </div>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
           
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <?php 
                    echo "<li class='nav-item'>
                            <a id='link_registro_login' class='nav-link' href='#'>" . "Authy token" ."</a>
                        </li>";
            ?>
        </ul>
  </div>
</nav>

<form method="POST">
  <div class="div_tabla_registro" style="margin-top: 24%; margin-left: 40%;">
    <table class="tabla_registro" cellspacing="0" cellpadding="6">
      <tr>
        <td>Authy Token: <input type="password" id="authy_token" name="authy_token" placeholder="Authy token" value="<?= isset($_POST['authy_token']) ? $_POST['authy_token'] : ''; ?>"></td>
      </tr>
      <tr>
        <td><button style="width: 100%; margin-left: 5%;" class="btn btn-primary" id="btn_authy" name="btn_authy" type="submit">Go</button></td>
      </tr>
    </table>
  </div>
</form>

 <?php 
 require_once '../shared/footer.php';
  ?>