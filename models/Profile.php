<?php

namespace Models{
class Profile
  {
    function __construct(){

    }

    public function getProfile($email, $login_token)
    {
      $user_array = array(
        'email'      => $email
      );
      $body = '{"email":' .'"'. $email . '"' . '}';
      $url = "http://localhost:8000/api/user";    
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

    public function verifyAllData($name, $last_name, $phone_number, $country_code, $birthday){
      if($name != '' && $last_name != '' && $phone_number != '' && $country_code != '' && $birthday != ''){
        return true;
      }else{
        return false;
      }

    }

    public function update_profile($email, $name, $last_name, $phone_number, $country_code, $birthday, $login_token){
      
      $user_array = array(
        'email'      => $email,
        'name'      => $name,
        'last_name'    => $last_name,
        'phone_number'      => $phone_number,
        'country_code'       => $country_code,
        'birthday'      => $birthday . " 13:00:00"
      );

      $body = '{"email":' .'"'. $email . '"' . ',"name":' . '"' . $name . '"' . ',"last_name":' . '"' . $last_name . '"'
        . ',"phone_number":' . '"' . $phone_number . '"' . ',"country_code":' . '"' . $country_code . '"' . ',"birthday":' . '"' . $birthday . '"' .'}';
      $url = "http://localhost:8000/api/profileEdit";    
      $content = json_encode($user_array);
      $curl = curl_init($url);

      curl_setopt($curl, CURLOPT_HEADER, false);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_HTTPHEADER,
              array("Content-type: application/json", "Authorization: Bearer " . $login_token));
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PATCH');
      curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
      $json_response = curl_exec($curl);
      $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
      curl_close($curl);
      //$json_response = json_decode($json_response, true);
      return $json_response;
    }

    public function deleteProfile($email, $login_token){
      $user_array = array(
        'email'      => $email,
      );
      $body = '{"email":' .'"'. $email . '"' . '}';
      $url = "http://localhost:8000/api/profileDelete";    
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


    

  }
}