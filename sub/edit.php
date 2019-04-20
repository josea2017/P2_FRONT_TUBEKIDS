<script>
if(localStorage.getItem("two_factor")){
  console.log(localStorage.getItem("login_token"));
  var email_cookie = localStorage.getItem("email");
  var login_token_cookie = localStorage.getItem("login_token");
  console.log(email_cookie); 
  //var res = str1.concat(str2);
  var string_cookie = "email=".concat(email_cookie);
  var string_login_token_cookie = "login_token=".concat(login_token_cookie);
  //document.cookie = "cookiename=cookievalue"
  document.cookie = string_cookie;
  document.cookie = string_login_token_cookie;
  //setcookie("TestCookie", $value);
  
}else{
  window.location="../security/login.php";
}
</script>
<?php 
//if(localStorage.getItem("login_token"))
$title='TubeKids-Edit Subaccounts';
$tituloPagina = 'Edit Subaccounts';
require_once '../shared/header.php';
require_once '../shared/menu.php';
require_once '../shared/db.php';
$email_cookie =  $_COOKIE['email'];
$login_token_cookie =  $_COOKIE['login_token'];
$id = $_GET["id"] ?? '';
$sub = $sub_model->getSub($id, $login_token_cookie);
$full_name = $sub['full_name'] ?? '';
$user_name = $sub['user_name'] ?? '';
$pin = $sub['pin'] ?? '';


  if(isset($_POST['btn_edit'])){
    $verify_all_data = $sub_model->verify_all_data($_POST['full_name'], $_POST['user_name'], $_POST['pin'], $email_cookie);
    if($verify_all_data){
        //echo "Datos completos";
        if($sub_model->verify_user_available($_POST['user_name'])){
            $pin = $_POST['pin'];
            $pinLength = strlen($pin);
            if($pinLength == 6)
            {
              $response = $sub_model->editSub($id, $_POST['full_name'], $_POST['user_name'], $_POST['pin'], $login_token_cookie);
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

 <link rel="stylesheet" type="text/css" href="../assets/css/style_index_producto.css">
 <div class="profile_box" style="display: flex; position: absolute; margin-top: 0.5%; margin-left: 30%;">

    <div class="row">
      <form action="#" method="POST">
        <div class="col-sm-8">
          <div class="card" style="width: 22rem;">
              <div class="card-body">
                <h4 class="card-title">
                  <?php
                    echo "User name:  " . $sub['user_name'];
                  ?>
                </h4>
              </div>
          </div>
        </div>
       
        <div class="col-sm-12">
          <div class="card" style="width: 22rem; height: 15rem;">
              <img class="card-img-top" src="../assets/images/profile.png" alt="Card image cap">
          </div>
        </div>
        <div class="col-sm-8">
          <div class="card" style="width: 22rem;">
          <table class="table table-hover text-center" style="text-align: center; margin-top: 0%;" border="1">
          <thead class="table_head">
              <tr>
                <td style="text-align: left;">
                  Id: <input type="text" disabled="disabled" id="id" name="id" value="<?= isset($_POST['id']) ? $_POST['id'] : $id; ?>"></td>
                </td>
              </tr>
              <tr>
                <td style="text-align: left;">
                  Full name: <input type="text" id="full_name" name="full_name" autofocus placeholder="Full name" value="<?= isset($_POST['full_name']) ? $_POST['full_name'] : $full_name; ?>"></td>
                </td>
              </tr>
              <tr>
                <td style="text-align: left;">
                  User name: <input type="text" id="user_name" name="user_name" placeholder="User name" value="<?= isset($_POST['user_name']) ? $_POST['user_name'] : $user_name; ?>">
                </td>
              </tr>
              <tr>
                <td style="text-align: left;">
                  Pin: <input type="password" maxlength="6" id="pin" name="pin" placeholder="PIN" value="<?= isset($_POST['pin']) ? $_POST['pin'] : $pin; ?>">
                </td>
              </tr>
              <tr>
                <td style="text-align: left;">
                  Father email: <input type="text" disabled="disabled" id="father_email" name="father_email" placeholder="Father email" value="<?= isset($_POST['father_email']) ? $_POST['father_email'] : $email_cookie; ?>">
                </td>
              </tr>
              <tr>
                <td>
                  <button style="width: 100px;" class="btn btn-warning" id="btn_edit" name="btn_edit" type="submit">Edit</button>
                  <?php
                   echo "<a style='font-size: 16px; width: 100px;' class='btn btn-primary' role='button' href='./index.php'>Back</a>";
                   ?>
                </td>
              </tr>
          </thead>
          </table>
          </div>
        </div>
      </form>
    </div>

 </div>


 <?php
 require_once '../shared/footer.php';
  ?>