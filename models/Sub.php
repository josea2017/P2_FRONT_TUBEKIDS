<?php

namespace Models{
class Sub
  {
    function __construct(){

    }

    public function verify_all_data($full_name, $user_name, $pin, $father_email)
    {
      if($full_name != '' && $user_name != '' && $pin != '' && $father_email != ''){
        return true;
      }else{
        return false;
      }

    }


    public function register($full_name, $user_name, $pin, $father_email, $user_token){

      $user_array = array(
        'full_name'      => $full_name,
        'user_name'    => $user_name,
        'pin'      => $pin,
        'father_email'       => $father_email
      );

      $url = "http://localhost:8000/api/sub";    
      $content = json_encode($user_array);

      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_HEADER, false);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_HTTPHEADER,
              array("Content-type: application/json", "Authorization: Bearer " . $user_token));
              //array("Content-type: application/json", "Authorization: Bearer " . $login_token));
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
      $json_response = curl_exec($curl);
      $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
      curl_close($curl);
      $response = json_decode($json_response, true);
      return $response;
    }

    public function get_all_subs($father_email, $user_token){
      $user_array = array(
        'father_email'      => $father_email
      );
      $body = '{"father_email":' .'"'. $father_email . '"' . '}';
      $url = "http://localhost:8000/api/getSubs";    
      $content = json_encode($user_array);

      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_HEADER, false);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_HTTPHEADER,
              array("Content-type: application/json", "Authorization: Bearer " . $user_token));
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
      curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
      $json_response = curl_exec($curl);
      $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
      curl_close($curl);
      $json_response = json_decode($json_response, true);
      return $json_response;
    }

    public function getSub($id, $user_token){
      $user_array = array(
        'id'      => $id
      );
      $body = '{"id":' .'"'. $id . '"' . '}';
      $url = "http://localhost:8000/api/searchSub";    
      $content = json_encode($user_array);

      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_HEADER, false);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_HTTPHEADER,
              array("Content-type: application/json", "Authorization: Bearer " . $user_token));
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
      curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
      $json_response = curl_exec($curl);
      $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
      curl_close($curl);
      $json_response = json_decode($json_response, true);
      return $json_response;
    }

    public function editSub($id, $full_name, $user_name, $pin, $user_token){

      $body = '{"id":' .'"'. $id . '"' . ',"full_name":' . '"' . $full_name . '"' . ',"user_name":' . '"' . $user_name . '"'
        . ',"pin":' . '"' . $pin . '"' . '}';
      $url = "http://localhost:8000/api/editSub";    

      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_HEADER, false);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_HTTPHEADER,
              array("Content-type: application/json", "Authorization: Bearer " . $user_token));
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PATCH');
      curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
      $json_response = curl_exec($curl);
      $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
      curl_close($curl);
      //$json_response = json_decode($json_response, true);
      return $json_response;
    }

    public function deleteSub($id, $user_token){

      $body = '{"id":' .'"'. $id . '"' . '}';
      $url = "http://localhost:8000/api/deleteSub";       
      $curl = curl_init($url);

      curl_setopt($curl, CURLOPT_HEADER, false);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_HTTPHEADER,
              array("Content-type: application/json", "Authorization: Bearer " . $user_token));
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
      curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
      $json_response = curl_exec($curl);
      $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
      curl_close($curl);
      //$json_response = json_decode($json_response, true);
      return $json_response;
      
    }

    public function verify_user_available($user_name){
      $available = false;
      $body = '{"user_name":' .'"'. $user_name . '"' . '}';

      $url = "http://localhost:8000/api/findSubPerUserName";    

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


    

  }
}