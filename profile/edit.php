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
$title='TubeKids-EditProfile';
$tituloPagina = 'Edit Profile';
require_once '../shared/header.php';
require_once '../shared/menu.php';
require_once '../shared/db.php';
$email_cookie =  $_COOKIE['email'];
$login_token_cookie =  $_COOKIE['login_token'];
$profile = $profile_model->getProfile($email_cookie, $login_token_cookie);
$phone_number = $profile['user']['phone_number'];
//var_dump($profile);
$country_codes = array
  (
  [("C.R"), ("../assets/images/costa_rica.png"), (506)],
  [("MEX"), ("../assets/images/costa_rica.png"), (52)]
  );

  if(isset($_POST['btn_edit'])){
        if($profile_model->verifyAllData($_POST['name'], $_POST['last_name'], $phone_number, $_POST['country_code'], $_POST['birthday'])){
            //echo "bien";
            $profile_model->update_profile($email_cookie, $_POST['name'], $_POST['last_name'], $phone_number, $_POST['country_code'], $_POST['birthday'], $login_token_cookie);
            return header("Location: ./index.php");
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
                  Name: <input type="text" id="name" name="name" autofocus placeholder="Name" value="<?= isset($_POST['name']) ? $_POST['name'] : $profile['user']['name']; ?>"></td>
                </td>
              </tr>
              <tr>
                <td style="text-align: left;">
                  Last name: <input type="text" id="last_name" name="last_name" autofocus placeholder="Last name" value="<?= isset($_POST['last_name']) ? $_POST['last_name'] : $profile['user']['last_name']; ?>"></td>
                </td>
              </tr>
              <tr>
                <td style="text-align: left;">
                  Phone: <input type="text" disabled="disabled" id="phone_number" name="phone_number" autofocus placeholder="Phone number" value="<?= isset($_POST['phone_number']) ? $_POST['phone_number'] : $profile['user']['phone_number']; ?>"></td>
                </td>
              </tr>
              <tr>
                <td>Country code: 
                    <select name="country_code" style="width: 100px; margin-left: 10px;">
                        <?php foreach ($country_codes as $country)
                        {
                        echo "<option value='".$country[2]."'>" . $country[0] . " - " . $country[2] . "</option>";
                        }
                        ?>
                    </select>
                </td>
              </tr>
              <tr>
               <td style="text-align: left;">
                  Bithday: <input type="date" id="birthday" name="birthday" autofocus placeholder="Bithday" value="<?= isset($_POST['birthday']) ? $_POST['birthday'] : $profile['user']['birthday']; ?>"></td>
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