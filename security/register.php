<?php 
$title='TubeKids-Register';
require_once '../shared/db.php';
require_once '../shared/header.php';
//$nombre_nuevo = $_POST['nombre_nuevo'] ?? '';
if(isset($_POST['btn_register'])){
    $value_verify_all_data = $register_model->verify_all_data($_POST['name'], $_POST['last_name'], $_POST['email'], $_POST['phone_number'], $_POST['country_code'], $_POST['birthday'], $_POST['password'], $_POST['confirm_password']);
    //Validar que todos los campos del formulario se encuentren completos
    if($value_verify_all_data == true){
      $value_verify_both_passwords = $register_model->verify_both_passwords($_POST['password'], $_POST['confirm_password']);
      //Validar que las contraseñas son iguales
      if($value_verify_both_passwords == true){
        $age_verify = $register_model->verify_age($_POST['birthday']);
        //Validar que el registro sea por parte de persona mayor de edad
        if($age_verify == true){
          $email_available = $register_model->verify_email_available($_POST['email']);
          //Validar que el email(username) se encuentra disponible
          if($email_available == true){
            //Si todo se encuentra bien, estamos listos para registrar un usuario nuevo
            $response = $register_model->register($_POST['name'], $_POST['last_name'], $_POST['email'], $_POST['phone_number'], $_POST['country_code'], $_POST['birthday'], $_POST['password'], $_POST['confirm_password']);
            //var_dump($response);
             return header("Location: ./login.php?email=" . $_POST['email']);
          }else{
              ?>
                <div class="alert alert-danger" role="alert">
                  Wrong, email is not available!
                </div>
              <?php
          }
        }else{
          //Mansaje de error en el caso que la persona no sea mayor de edad
          ?>
            <div class="alert alert-danger" role="alert">
              Wrong, age not allowed!
            </div>
          <?php
        }

      }else{
        //Mensaje de error en el caso que las contraseñas sean diferentes
        ?>
          <div class="alert alert-danger" role="alert">
            Wrong, passwords are differents!
          </div>
        <?php
      } 

    }else{
      //Mensaje de error en el caso que los datos no se encuentren completos
      ?>
        <div class="alert alert-danger" role="alert">
          Wrong, incomplete data!
        </div>
      <?php
    }

  }//Fin accion presionar botón registrar
?>



<link rel="stylesheet" type="text/css" href="../assets/css/register_style.css">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a id="titulo_registro_eshop" class="navbar-brand" href="#">Register</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="caja_register" style="display: flex; position: absolute; margin-top: 6%; margin-left: 49%;">
    <img src="../assets/images/registro_usuario.png">
  </div>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
        <?php
	        $menu = [
	          'Login' => './login.php',
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
  <div class="div_tabla_registro" style="margin-top: 110px;">
    <table class="tabla_registro" cellspacing="0" cellpadding="6">
      <tr>
        <td>Name: <input type="text" id="name" name="name" autofocus placeholder="Name" value="<?= isset($_POST['name']) ? $_POST['name'] : ''; ?>"></td>
      </tr>
      <tr>
        <td>Last name: <input type="text" id="last_name" name="last_name" placeholder="Last name" value="<?= isset($_POST['last_name']) ? $_POST['last_name'] : ''; ?>"></td>
      </tr>
      <tr>
        <td>Email: <input type="text" id="email" name="email" placeholder="Email" value="<?= isset($_POST['email']) ? $_POST['email'] : ''; ?>"></td>
      </tr>
      <tr>
        <td>Phone: <input type="text" id="phone_number" name="phone_number" placeholder="Phone number" value="<?= isset($_POST['phone_number']) ? $_POST['phone_number'] : ''; ?>"></td>
      </tr>
      <tr>
        <td>Country code: <input type="text" id="country_code" name="country_code" placeholder="Country code" value="<?= isset($_POST['country_code']) ? $_POST['country_code'] : ''; ?>"></td>
      </tr>
      <tr>
        <td>Birthday: <input type="date" id="birthday" name="birthday" placeholder="Birthday" value="<?= isset($_POST['birthday']) ? $_POST['birthday'] : ''; ?>"></td>
      </tr>
      <tr>
        <td>Password: <input type="password" id="password" name="password" placeholder="Password" value="<?= isset($_POST['password']) ? $_POST['password'] : ''; ?>"></td>
      </tr>
       <tr>
        <td>Confirm password: <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm password" value="<?= isset($_POST['confirm_password']) ? $_POST['confirm_password'] : ''; ?>"></td>
      </tr>
      <tr>
        <td><button class="btn btn-primary" id="btn_register" name="btn_register" type="submit">Sign up</button></td>
      </tr>
    </table>
  </div>
</form>

 <?php 
 require_once '../shared/footer.php';
  ?>