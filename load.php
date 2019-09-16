<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('jwt_helper.php');

session_start();

/* function to call api */
function callAPI($method, $url, $data){
   $curl = curl_init();

   switch ($method){
      case "POST":
         curl_setopt($curl, CURLOPT_POST, 1);
         if (!empty($data))
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         break;
      case "PUT":
         curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
         if (!empty($data))
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);                              
         break;
       case "DELETE":
         curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
         if (!empty($data))
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);                              
         break;
      default:
         if (!empty($data))
            $url = sprintf("%s?%s", $url, http_build_query($data));
   }

   // OPTIES:
   curl_setopt($curl, CURLOPT_URL, $url);
   curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json'
   ));

   if(!empty($_SESSION["token"])) {
    curl_setopt($curl, CURLOPT_COOKIE, 'device_token='.$_SESSION["token"].'; bc-token='.$_SESSION["token"]);
   }
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

   // UITVOEREN:
   $result = curl_exec($curl);
   if(!$result){die("Connection Failure");}
   curl_close($curl);
   return $result;
}

?>