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
$title='TubeKids-Subaccounts';
$tituloPagina = 'Subaccounts';
require_once '../shared/header.php';
require_once '../shared/menu.php';
require_once '../shared/db.php';
$email_cookie =  $_COOKIE['email'];
$login_token_cookie =  $_COOKIE['login_token'];
$subs_list = null;
$subs_list = $sub_model->get_all_subs($email_cookie, $login_token_cookie);
//var_dump($subs_list);

 ?>
 <link rel="stylesheet" type="text/css" href="../assets/css/style_index_producto.css">

<form method="POST">
  <table class="table table-hover text-center" style="text-align: center; margin-top: 0%;" border="1">
    <thead class="table_head">
        <tr>
          <th style="text-align: left;" colspan="6">SUBACCOUNTS MANAGEMENT</th>
        </tr>
        <tr>
          <th>ID</th>
          <th>FULL NAME</th>
          <th>USER NAME</th>
          <th>PIN</th>
          <th>FATHER ACCOUNT</th>
          <th>
            <a class="btn btn-success" name="new_sub" href="./new.php">Add Subaccount</a>
          </th>
        </tr>
        
    </thead>
        <?php
          //Subs list
       if(!empty($subs_list))
       {
          $maxSubs = sizeof($subs_list);
          //echo $txtSearch;
          for ($i=0; $i < $maxSubs; $i++) {
            //md5($str)
              echo "<tr>";
              echo "<td>" . $subs_list[$i]['id'] . "</td>";
              echo "<td>" . $subs_list[$i]['full_name'] . "</td>";
              echo "<td>" . $subs_list[$i]['user_name'] . "</td>";
              echo "<td>" . md5($subs_list[$i]['pin']) . "</td>";
              echo "<td>" . $subs_list[$i]['father_email'] . "</td>";
              echo "<td>" .
                " <a style='font-size: 16px;' class='btn btn-danger' role='button' href='./delete.php?id=" . $subs_list[$i]['id'] ."'>Delete</a>".
                  " <a style='font-size: 16px; width: 70px;' class='btn btn-warning' role='button' href='./edit.php?id=". $subs_list[$i]['id'] ."'>Edit</a>".
                "</td>";
              echo "</tr>";
             
          }

       }

      
         ?>
  </table>
</form>


 <?php
 require_once '../shared/footer.php';
  ?>