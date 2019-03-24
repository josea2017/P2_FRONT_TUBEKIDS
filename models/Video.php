<?php

namespace Models{
class Video
  {
    function __construct(){

    }

    public function verify_all_data($user_email, $resource, $name)
    {
      if($user_email != "" && $resource != "" && $name != ""){
          return true;
      }else{
          return false;
      }
      
    }

    public function save_video($user_email, $resource, $name, $video){
      $video_array = array(
        'user_email'      => $user_email,
        'resource'    => $resource,
        'name'      => $name,
        'video'    => $video
      );

      $url = "http://localhost:8000/api/video";    
      $content = json_encode($video_array);

      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_HEADER, false);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_HTTPHEADER,
              array("Content-type: application/json"));
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

      $json_response = curl_exec($curl);

      $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

      if ( $status != 201 ) {
          die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
      }
      curl_close($curl);
      $response = json_decode($json_response, true);
      return $response;

    }

    public function videos_list(){
      // Array en el que obtendremos los resultados
      $array_videos = array();

      // Agregamos la barra invertida al final en caso de que no exista
      //if(substr($directorio, -1) != "/") $directorio .= "/";
      $path = __DIR__ . '/../videos/';

      // Creamos un puntero al directorio y obtenemos el listado de archivos
      $dir = @dir($path) or die("getFileList: Error abriendo el directorio $path para leerlo");
      while(($archivo = $dir->read()) !== false) {
          // Obviamos los archivos ocultos
          if($archivo[0] == ".") continue;
          /*if(is_dir($path . $archivo)) {
             // var_dump($archivo[0]);
          }*/ else if (is_readable($path . $archivo)) {
              //echo "No encontrado";
               $array_videos[] = array(
                "name" => basename($path . $archivo),
                "size" => filesize($path . $archivo),
                "tmp_name"   => tempnam($path . $archivo, 'tmp_name'),
                "type"     => end(explode(".", $path . $archivo)),
              );
          }
      }
      //var_dump($array_videos);
      $dir->close();
      return $array_videos;
    }



  }
}