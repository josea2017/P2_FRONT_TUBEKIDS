<script>
if(localStorage.getItem("login_token")){
  console.log(localStorage.getItem("login_token"));
  var email_cookie = localStorage.getItem("email");
  console.log(email_cookie); 
}else{
  //console.log("No hay datos");
  window.location="../security/login.php";
}
</script>

<?php 
$title='TubeKids-Home';
$tituloPagina = 'Home';
require_once '../shared/header.php';
require_once '../shared/menu.php';
//require_once '../seguridad/verificar_session.php';(token)
require_once '../shared/db.php';
$token = "";
//$token = $guard_model->verify_token();
//echo $token; 
 ?>


<div class="row">
  <form action="#" method="POST">
    <div class="col-sm-3">
      <div class="card" style="width: 18rem;">
          <div class="card-body">
            <h5 class="card-title">
              <script>
                  if(localStorage.getItem("email")){
                    document.write(localStorage.getItem("email"));
                  }
              </script>
            </h5>
          </div>
          <img class="card-img-top" src="../assets/images/enjoying.jpg" alt="Card image cap">
      </div>
    </div>
    <div class="col-sm-3">
      <div class="card" style="width: 18rem;">
          <img class="card-img-top" src="../assets/images/security.jpg" alt="Card image cap">
      </div>
    </div>
    <div class="col-sm-3">
      <div class="card" style="width: 18rem;">
          <img class="card-img-top" src="../assets/images/share.jpg" alt="Card image cap">
      </div>
    </div>
    <div class="col-sm-3">
      <div class="card" style="width: 18rem;">
          <img class="card-img-top" src="../assets/images/multimedia.jpg" alt="Card image cap">
      </div>
    </div>
    <div class="col-sm-3">
      <div class="card" style="width: 18rem;">
          <img class="card-img-top" src="../assets/images/learn.jpg" alt="Card image cap">
      </div>
    </div>
  </form>
  <div class="col-sm-8">
      <div class="card">
        <ul class="list-group list-group-flush">
          <li class="list-group-item" style="text-align: center;"><h4>TUBEKIDS</h4></li>
        </ul>
        <table class="table" style="text-align: center; margin-top: 0%;">
            <thead>
            </thead>
            <tbody>
              <tr>
                <th style="text-align: left;">YOUTUBE VIDEOS</th>
              </tr>
              <tr>
                <td><img src="../assets/images/youtube_reference.png" width="700" height="400" alt=""></td>
              </tr>
              <tr>
                <th style="text-align: left;">UPLOAD OWN VIDEOS</th>
              </tr>
              <tr>
                <td><img src="../assets/images/making_video.png" width="700" height="400" alt=""></td>
              </tr>
            </tbody>
          </table>
      </div> 
  </div>
</div>

 <?php
 require_once '../shared/footer.php';
  ?>