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

    public function save_video($user_email, $resource, $name, $video, $login_token){
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
              array("Content-type: application/json", "Authorization: Bearer " . $login_token));
              //array("Content-type: application/json", "Authorization: Bearer " . $login_token));
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
//curl -H 'Accept: application/json' -H "Authorization: Bearer 
//${TOKEN}" https://{hostname}/api/myresource
    public function load_videos_from_server($email, $login_token){
      $available = false;
      $user_array = array(
        'email'      => $email
      );
      $body = '{"email":' .'"'. $email . '"' . '}';
      ////////////////*********Videos count **********////////////////////
      $url = "http://localhost:8000/api/countVideos";    
      $content = json_encode($user_array);

      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_HEADER, false);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_HTTPHEADER,
              array("Content-type: application/json", "Authorization: Bearer " . $login_token));
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
      curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
      $json_response_count = curl_exec($curl);
      $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
      curl_close($curl);
      $json_response_count = json_decode($json_response_count, true);
      //echo $json_response_count;
      /////////*********Videos return *//////////////////
      $array_videos = array();
      for($i = 0; $i < $json_response_count; $i++)
      {
      $user_array = array(
        'email'      => $email,
        'index'      => $i, 
      );
      $body = '{"email":' .'"'. $email . '"' . ',"index":' . '"' . $i . '"' . '}';

      $url = "http://localhost:8000/api/loadIndexVideo";    
      $content = json_encode($user_array);

      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_HEADER, false);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_HTTPHEADER,
              //**array("Content-type: application/json"));
              array("Content-type: application/json", "Authorization: Bearer " . $login_token));
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
      curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
      $json_response_video = curl_exec($curl);
      //echo $json_response_video;
      $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
      curl_close($curl);
      /*
      echo "<video width='320' height='240' controls>".
          "<source src='data:video/mp4;base64," . base64_encode($json_response_video) . "'". "type='video/mp4'>" .
          "</video>";*/
        array_push($array_videos, $json_response_video);

      }
      return $array_videos;

   
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
              $upload_extension =  explode(".", $path . $archivo);
              $upload_extension = end($upload_extension);
               $array_videos[] = array(
                "name" => basename($path . $archivo),
                "size" => filesize($path . $archivo),
                "tmp_name"   => tempnam($path."/tmp", 'tmp_name'),
                "type"     => $upload_extension,
              );
          }
      }
      //"type"     => end(explode(".", $path . $archivo)),
      //var_dump($array_videos);
      $dir->close();
      return $array_videos;
    }


    public function databaseVideosDetail($email, $login_token){

      $user_array = array(
        'email'      => $email
      );
      $body = '{"email":' .'"'. $email . '"' . '}';
      $url = "http://localhost:8000/api/databaseVideosDetail";    
      $content = json_encode($user_array);

      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_HEADER, false);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_HTTPHEADER,
              array("Content-type: application/json", "Authorization: Bearer " . $login_token));
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
      curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
      $json_response = curl_exec($curl);
      $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
      curl_close($curl);
      $json_response = json_decode($json_response, true);
      return $json_response;
    }

    public function databaseDeleteVideo($id, $email, $login_token){
      //$body = '{"email":' .'"'. $email . '"' . ',"index":' . '"' . $i . '"' . '}';
      $user_array = array(
        'id'      => $id,
        'email'   => $email,
      );
      $body = '{"id":' .'"'. $id . '"' . ',"email":' . '"' . $email . '"' . '}';
      $url = "http://localhost:8000/api/databaseDeleteVideo";    
      $content = json_encode($user_array);
      $curl = curl_init($url);

      curl_setopt($curl, CURLOPT_HEADER, false);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_HTTPHEADER,
              array("Content-type: application/json", "Authorization: Bearer " . $login_token));
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
      curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
      $json_response = curl_exec($curl);
      $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
      curl_close($curl);
      //$json_response = json_decode($json_response, true);
      return $json_response;


    }


    public function save_youtube_video($user_email, $resource, $name, $login_token){
      $video_array = array(
        'user_email'      => $user_email,
        'resource'    => $resource,
        'name'      => $name
      );

      $url = "http://localhost:8000/api/tubes";    
      $content = json_encode($video_array);

      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_HEADER, false);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_HTTPHEADER,
              array("Content-type: application/json", "Authorization: Bearer " . $login_token));
              //array("Content-type: application/json", "Authorization: Bearer " . $login_token));
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

    public function load_youtube_videos($user_email, $login_token){
      $video_array = array(
        'user_email'      => $user_email
      );

      $url = "http://localhost:8000/api/tubes";    
      $content = json_encode($video_array);

      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_HEADER, false);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_HTTPHEADER,
              array("Content-type: application/json", "Authorization: Bearer " . $login_token));
              //array("Content-type: application/json", "Authorization: Bearer " . $login_token));
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
      curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

      $json_response = curl_exec($curl);

      $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
      /*
      if ( $status != 201 ) {
          die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
      }*/
      curl_close($curl);
      $response = json_decode($json_response, true);
      return $response;
     // curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
     // curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
    }



  }
}