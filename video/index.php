<script>
if(localStorage.getItem("login_token")){
  console.log(localStorage.getItem("login_token"));
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
$videos_list = $video_model->videos_list();
$path = __DIR__ . '/../videos/';
//var_dump($videos_list[0]);
$_FILES = $videos_list[0];
$prueba = "prueba.mp4";
/*echo $_FILES['name'];
echo $_FILES['size'];
echo $_FILES['tmp_name'];
echo $_FILES['type'];*/
/*
<video width="320" height="240" controls>
          <source src="/P2_FRONT_TUBEKIDS/videos/prueba.mp4" type="video/mp4">
          Your browser does not support the video tag.
        </video>
        ///"<source src='/P2_FRONT_TUBEKIDS/videos/prueba.mp4'  type='video/mp4'>"
*/

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

            $max = sizeof($videos_list);
            if(!empty($videos_list))
            {
    	        for ($i=0; $i < $max; $i++) {
                  echo "<tr>";
                  echo "<td>";
                  echo "<video width='320' height='240' controls>".
                          "<source src='/P2_FRONT_TUBEKIDS/videos/" . $videos_list[$i]['name'] . "'". "type='video/mp4'>" .
                        "</video>" . 
                        "</td>";
                  echo "<td>" . $videos_list[$i]['name'] . "</td>";
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