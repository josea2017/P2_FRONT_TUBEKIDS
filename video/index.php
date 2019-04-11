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
$login_token_cookie =  $_COOKIE['login_token'];
//echo $login_token_cookie;
//echo $email_cookie;
$response = null;
$responseYouTube = null;
$response = $video_model->load_videos_from_server($email_cookie, $login_token_cookie);
$responseYouTube = $video_model->load_youtube_videos($email_cookie, $login_token_cookie);
//var_dump($responseYouTube);
if($response != null){
//var_dump($response);
$array_videos = array();
$array_videos = $response;
$max = sizeof($response);
$databaseVideosDetail = $video_model->databaseVideosDetail($email_cookie, $login_token_cookie);
//echo $max;
//$name= $value['file']['name'];
//echo $_FILES['name'];
//echo "<td>" . "prueba" . "</td>";
}
if(isset($_POST['delete'])){
 echo "Hola";
}

 ?>
 <link rel="stylesheet" type="text/css" href="../assets/css/style_index_producto.css">

 

<form method="POST">
  <table class="table table-hover text-center" style="text-align: center; margin-top: 0%;" border="1">
    <thead class="table_head">
        <tr>
          <th style="text-align: left;" colspan="3">PLAYLIST</th>
        </tr>
        <tr>
          <th>RESOURCE</th>
          <th>NAME</th>
          <th><a class="btn btn-success" name="producto_nuevo" href="../video/new.php">Add Own</a>
              <a class="btn btn-success" name="producto_nuevo" href="../video/new_youtube.php">Add YouTube</a>
          </th>
        </tr>
        
    </thead>
        <?php
        //Own videos
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
                 " <a style='font-size: 13px;' class='btn btn-danger' role='button' href='./delete.php?id=" . $databaseVideosDetail[$i]['id'] . 
                 "&name= " . $databaseVideosDetail[$i]['name'] . "'>Delete</a>".
                "</td>";
              echo "</tr>";
              /*
" <a style='font-size: 13px;' class='btn btn-danger' role='button' href='./eliminar.php?id_producto=" . $lista_productos[$i]['id_producto'] . "&nombre= " 
. $lista_productos[$i]['nombre'] . "&descripcion= " . $lista_productos[$i]['descripcion'] . "&stock= " . $lista_productos[$i]['stock'] . "&precio= " . $lista_productos[$i]['precio'] . "'>Eliminar</a>"              
" <a style='font-size: 13px;' class='btn btn-primary' role='button' href=''>Edit</a>".              
*/
          }
       }
       //YouTube Videos
       if(!empty($responseYouTube))
       {
          $maxTube = sizeof($responseYouTube);
          for ($i=0; $i < $maxTube; $i++) {
              $url = $responseYouTube[$i]['resource'];
              preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
              $id = $matches[1];
              $width = '320px';
              $height = '240px';
              echo "<tr>";
              echo "<td>";
              echo "<iframe id='ytplayer' type='text/html' width='320px' height='240px'".
                  "src='https://www.youtube.com/embed/" . $id . "?rel=0&showinfo=0&color=white&iv_load_policy=3" . "'" .
                  "frameborder='0' allowfullscreen>" .
                  "</iframe>" . 
                    "</td>";
              echo "<td>" . $responseYouTube[$i]['name'] . "</td>";
              echo "<td>" .
                " <a style='font-size: 13px;' class='btn btn-danger' role='button' href='./delete_youtube.php?id=". $responseYouTube[$i]['id'] .
                  "&name= " . $responseYouTube[$i]['name'] . "'>Delete</a>".
                  " <a style='font-size: 13px;' class='btn btn-warning' role='button' href='./edit_youtube.php?id=". $responseYouTube[$i]['id'] .
                  "&name= " . $responseYouTube[$i]['name'] . "'>Edit</a>".
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