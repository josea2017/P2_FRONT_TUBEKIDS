<script>
if(localStorage.getItem("login_token")){
  console.log(localStorage.getItem("login_token"));
  var email_cookie = localStorage.getItem("email");
  console.log(email_cookie); 
  //var res = str1.concat(str2);
  var string_cookie = "email=".concat(email_cookie);
  //document.cookie = "cookiename=cookievalue"
  document.cookie = string_cookie;
  //setcookie("TestCookie", $value);
  
}else{
  //console.log("No hay datos");
  window.location="../security/login.php";
}
</script>
<?php 
$title='TubeKids-Video';
$tituloPagina = 'Video';
require_once '../shared/header.php';
require_once '../shared/menu.php';
require_once '../shared/db.php';
$email_cookie =  $_COOKIE['email'];
//echo $email_cookie;
$response = null;
$response = $video_model->load_videos_from_server($email_cookie);
if($response != null){
//var_dump($response);
$array_videos = array();
$array_videos = $response;
$max = sizeof($response);
$databaseVideosDetail = $video_model->databaseVideosDetail($email_cookie);
//echo $max;
//$name= $value['file']['name'];
//echo $_FILES['name'];
//echo "<td>" . "prueba" . "</td>";
}

 ?>
 <link rel="stylesheet" type="text/css" href="../assets/css/style_index_producto.css">

<form>
  <table class="table table-hover text-center" style="text-align: center; margin-top: 0%;" border="1">
    <thead class="table_head">
        <tr>
          <th style="text-align: left;" colspan="3">PLAYLIST</th>
        </tr>
        <tr>
          <th>RESOURCE</th>
          <th>NAME</th>
          <th><a class="btn btn-success" name="producto_nuevo" href="../video/new.php">Add new</a></th>
        </tr>
        
    </thead>
        <?php
        
        if(!empty($array_videos))
        {
          for ($i=0; $i < $max; $i++) {
              echo "<tr>";
              echo "<td>";
              echo "<video width='320' height='240' controls>".
                   "<source src='data:video/mp4;base64," . base64_encode($array_videos[$i]) . "'". "type='video/mp4'>" .
                   "</video>" . 
                    "</td>";
              echo "<td>" . $databaseVideosDetail[$i]['name'] . "</td>";
              echo "<td>" .
                 " <a style='font-size: 13px;' class='btn btn-primary' role='button' href=''>Editar</a>".
                 
                 " <a style='font-size: 13px;' class='btn btn-danger' role='button' href=''>Eliminar</a>".
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