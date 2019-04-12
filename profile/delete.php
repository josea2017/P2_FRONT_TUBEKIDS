<script>
if(localStorage.getItem("login_token")){
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
$title='TubeKids-DeleteProfile';
$tituloPagina = 'Delete Profile';
require_once '../shared/header.php';
require_once '../shared/menu.php';
require_once '../shared/db.php';
$email_cookie =  $_COOKIE['email'];
$login_token_cookie =  $_COOKIE['login_token'];
if(isset($_POST['btn_delete'])){
    //echo "hola";
    $profile_model->deleteProfile($email_cookie, $login_token_cookie);
    ?>
        <div class="alert alert-success" role="alert">
          Done successfully!
        </div>
        <script>
           window.location="../security/logout.php";
       </script>
    <?php
}

 ?>

 <link rel="stylesheet" type="text/css" href="../assets/css/style_index_producto.css">
 <div class="profile_box" style="display: flex; position: absolute; margin-top: 0.5%; margin-left: 30%;">

    <div class="row">
      <form action="#" method="POST">
        <div class="col-sm-8">
          <div class="card" style="width: 18rem;">
              <div class="card-body">
                <h4 class="card-title">
                  <script>
                      if(localStorage.getItem("email")){
                        document.write(localStorage.getItem("email"));
                      }
                  </script>
                </h4>
              </div>
          </div>
        </div>
       
        <div class="col-sm-8">
          <div class="card" style="width: 18rem; height: 15rem;">
              <img class="card-img-top" src="../assets/images/profile.png" alt="Card image cap">
          </div>
        </div>
        <div class="col-sm-8">
          <div class="card" style="width: 18rem;">
          <table class="table table-hover text-center" style="text-align: center; margin-top: 0%;" border="1">
          <thead class="table_head">
              <tr>
                <td style="text-align: left;">
                  Really you want to delete the account?
                </td>
              </tr>
              <tr>
                <td>
                   <button style="width: 100px;" class="btn btn-danger" id="btn_delete" name="btn_delete" type="submit">Delete</button>
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