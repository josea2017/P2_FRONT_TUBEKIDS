<?php

namespace Models{
class Register
  {
    function __construct(){

    }

    public function verify_all_data($name, $last_name, $email, $phone_number, $country_code, $birthday, $password, $confirm_password)
    {
      if($name != '' && $last_name != '' && $email != '' && $phone_number != '' && $country_code != '' && $birthday != '' && $password != '' && $confirm_password != ''){
        return true;
      }else{
        return false;
      }

    }

    public function verify_both_passwords($password, $confirm_password)
    {
      if($password == $confirm_password){
        return true;
      }else{
        return false;
      }
    }

    public function verify_age($birthday){
      $age_result = 0;
      $age_result = floor((time() - strtotime($birthday)) / 31556926);
      if($age_result >= 18){
        return true;
      }else{
        return false;
      }

    }

    public function verify_email_available($email){
      $available = false;
      $user_array = array(
        'email'      => $email
      );
      $body = '{"email":' .'"'. $email . '"' . '}';

      $url = "http://localhost:8000/api/findUserPerEmail";    
      $content = json_encode($user_array);

      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_HEADER, false);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_HTTPHEADER,
              array("Content-type: application/json"));
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
      curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
      $json_response = curl_exec($curl);
      $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
      /*
      if ( $status != 201 ) {
          $available = false;
          die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
      }*/
      curl_close($curl);
      $response = json_decode($json_response, true);
      if($response == null){
        $available = true;
      }else{
        $available = false;
      }
      return $available;
    }



    public function register($name, $last_name, $email, $phone_number, $country_code, $birthday, $password, $confirm_password){

      $user_array = array(
        'name'      => $name,
        'last_name'    => $last_name,
        'email'      => $email,
        'phone_number'       => $phone_number,
        'country_code' => $country_code,
        'birthday'      => $birthday . " 13:00:00",
        'password'      => $password,
        'password_confirmation'      => $confirm_password
      );
      //echo $country_code;
/*
      $options = array(
          'http' => array(
          'method'  => 'POST',
          'content' => json_encode($user_array),
          'header'=>  "Content-Type: application/json\r\n" .
                      "Accept: application/json\r\n"
          )
      );
      $url = "http://localhost:8000/api/register";
      $context  = stream_context_create($options);
      $result = file_get_contents($url, false, $context);
      $response = json_decode($result);
      return $response;
      */
     

      $url = "http://localhost:8000/api/register";    
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

      if ( $status != 201 ) {
          die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
      }


      curl_close($curl);

      $response = json_decode($json_response, true);
      return $response;


    }

    public function create_user_video_folder($email){
      $user_array = array(
        'email'      => $email
      );

      $url = "http://localhost:8000/api/register/folder";    
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

      if ( $status != 201 ) {
          die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
      }


      curl_close($curl);

      $response = json_decode($json_response, true);
      return $response;

    }

    

  }
}