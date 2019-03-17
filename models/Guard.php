<?php

namespace Models{
class Guard
  {
    function __construct(){

    }

    public function verify_token()
    {
      //** */$token = "";
      //$token = "<script language=javascript>document.write(localStorage.getItem('login_token'));</script>";
      //*** */$token = "<script language=javascript>document.write(localStorage.getItem('login_token'));</script>";
      //return var_dump($token);
      //return var_dump($token);
      //var token = localStorage.getItem('login_token');
      //document.write(token);
      /*if ("<script>localStorage.getItem('login_token') === null</script>") {
        //return var_dump("vacio");
        return false;
      }*/
      /*$local_storage = "<script>document.write(localStorage.getItem('login_token'));</script>";
      //return var_dump($local_storage);
      $size = trim($local_storage);;
      return $size;*/
      $valor = "<script>document.write(localStorage.getItem('login_token'));</script>";
      return $valor;
      
  
      
    }

  }
}