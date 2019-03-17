<?php

namespace Models{
class Login
  {
    function __construct(){

    }

    public function verify_all_data($email, $password)
    {
      if($email != '' && $password != ''){
        return true;
      }else{
        return false;
      }

    }

    public function login_user_token($email, $password){
      $return_token = true;
      $user_array = array(
        'email'      => $email,
        'password'      => $password
      );

      $url = "http://localhost:8000/api/login";    
      $content = json_encode($user_array);

      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_HEADER, false);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_HTTPHEADER,
              array("Content-type: application/json"));
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

      $json_response = curl_exec($curl);

      $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
      /*
      if ( $status != 201 ) {
          die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
      }*/
      curl_close($curl);
      //$response = json_decode($json_response, true);
      //return $response;
      $response = json_decode($json_response, true);
      $string = implode("|",$response);
      //return var_dump($response);
      ///$string = var_dump($response);
      if($string == "")
      {
        return false;
      }else{
        return $response;
      }
      
      /*if($response == null){
        $return_token = false;
        return $return_token;
      }else{
        return $response;
      }*/

    }
  }
}