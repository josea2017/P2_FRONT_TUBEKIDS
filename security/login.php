<?php 
$title='TubeKids-Login';
require_once '../shared/db.php';
require_once '../shared/header.php';
$email = $_GET["email"] ?? '';

if(isset($_POST['btn_login'])){
$verify_all_data = $login_model->verify_all_data($_POST['email'], $_POST['password']);
//Verificamos que tenemos todos los datos completos
if($verify_all_data == true){
  $login_user_token = $login_model->login_user_token($_POST['email'], $_POST['password']);
  //echo $login_user_token;
  //echo $login_user_token['token'];
  //Verificamos que tenemos un token de acceso
  if($login_user_token != false){
    //echo $login_user_token['token'];
    //$token = $login_user_token['token'];
    ?>
      <script>
        localStorage.setItem('login_token', '<?php echo $login_user_token['token']; ?>');
        localStorage.setItem('email', '<?php echo $_POST['email']; ?>');
        window.location="../home/index.php";
      </script>
    <?php
  }else{
    ?>
      <script>
        localStorage.removeItem('login_token');
      </script>
      <div class="alert alert-danger" role="alert">
          Wrong, incorrect login data!
      </div>
    <?php
  }
}else{
    ?>
      <script>
        localStorage.removeItem('login_token');
      </script>
      <div class="alert alert-danger" role="alert">
          Wrong, incomplete data!
      </div>
    <?php
  }
}
?>



<link rel="stylesheet" type="text/css" href="../assets/css/register_style.css">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a id="titulo_registro_eshop" class="navbar-brand" href="#">Login</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="caja_register" style="display: flex; position: absolute; margin-top: 13%; margin-left: 42%;">
    <img src="../assets/images/login_usuario.png">
  </div>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <?php
	        $menu = [
	          'Register' => './register.php',
            'Welcome' => '../index.php'
	        ];
        ?>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <?php 
            foreach ($menu as $key => $value) {
            	echo "<li class='nav-item'>
                      	<a id='link_registro_login' class='nav-link' href='$value'>$key</a>
                      </li>";
            }
        ?>
    </ul>
  </div>
</nav>

<form method="POST">
  <div class="div_tabla_registro" style="margin-top: 23%; margin-left: 40%;">
    <table class="tabla_registro" cellspacing="0" cellpadding="6">
      <tr>
        <td>Email: <input type="text" id="email" name="email" placeholder="Email" value="<?= isset($_POST['email']) ? $_POST['password'] : $email; ?>"></td>
      </tr>
      <tr>
      <tr>
        <td>Password: <input type="password" id="password" name="password" placeholder="Password" value="<?= isset($_POST['password']) ? $_POST['password'] : ''; ?>"></td>
      </tr>
      <tr>
        <td><button style="width: 100%; margin-left: 5%;" class="btn btn-primary" id="btn_login" name="btn_login" type="submit">Login</button></td>
      </tr>
    </table>
  </div>
</form>

<script>
    var token = localStorage.getItem('login_token');
    document.write(token);
</script>

 <?php 
 require_once '../shared/footer.php';
  ?>