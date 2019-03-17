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

    public function save_video($user_email, $resource, $name){
      $video_array = array(
        'user_email'      => $user_email,
        'resource'    => $resource,
        'name'      => $name
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

  }
}