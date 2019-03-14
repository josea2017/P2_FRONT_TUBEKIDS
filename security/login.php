<?php 
$title='TubeKids-Login';
require_once '../shared/db.php';
require_once '../shared/header.php';
$email = $_GET["email"] ?? '';


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

 <?php 
 require_once '../shared/footer.php';
  ?>