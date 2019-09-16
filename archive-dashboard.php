<?php


require 'load.php';

if (!empty($_SESSION["token"])) {
  if (!empty($_GET["device"])) {

    /* post data for redirect */
    $data_array = array("access_id" => $_GET["device"]);
    $url = 'https://user.bluecherry.io/api/user/device/login';
    $make_call = callAPI('POST', $url, json_encode($data_array));
    $response = json_decode($make_call, true);
    setcookie("bc-token", $_SESSION["token"]);
    header('Location: https://'.$_GET["device"].'.platform.bluecherry.io/');
    exit();
  }
}

get_header();
?>

  <article id="featured">
  <h2>Dashboard</h2>
  </article>                
  <section id="content">

  <?php

  $msg = '';
  $http_status = 0;

  //post event logout
  if (isset($_POST['logout'])) {
    callAPI('POST', 'https://sso.bluecherry.io/api/sso/account/logout/', false);
    unset($_SESSION["token"]);
    unset($_SESSION["naam"]);
  }

  if (!empty($_SESSION["token"])) {
    /* if logged in, session, decode token again for user ID and name*/
    $token = JWT::decode($_SESSION["token"], null, false);
    $_SESSION["naam"] = $token->accountFirstname;

    /* get user list by calling api with user ID*/
    $get_data = callAPI('GET', 'https://user.bluecherry.io/api/user/'.$token->accountId.'/devices', false);
    $response = json_decode($get_data, true);
    $devices = $response["devices"]; 
    $_SESSION["naam"] = $token->accountFirstname;

  }
  ?>

    <?php if(!empty($_SESSION["token"])) {
    
      require 'menu.php';

      /* device loop */
      if(!empty($devices)) {
        echo '<h6>Welcome '.$_SESSION["naam"].'. Please click on one of the red squares below to visit the device dashboard.</h6>';
        echo '<div style="padding: 0;"><div class="row">';

        for($i=0;$i<count($response['device_groups']);$i++) {
          if(isset($response['device_groups'][$i]['group_id'])) {
            echo "<div class='col-12'><h3 style='text-align:center'><a href='/dashboard/group-details/?group_name=".$response['device_groups'][$i]['name']."&group_id=".$response['device_groups'][$i]['group_id']."'>".$response['device_groups'][$i]['name']."</a></h3></div>";

            foreach($response["devices"] as $device) {
              if($device["group_id"] == $response['device_groups'][$i]['group_id']) {
                echo '<div class="col-12-sm col-3 wifydevice"><a target="_blank" href="?device='.$device["access_id"].'"><img src="/wp-content/uploads/2019/04/160.png" alt="WiFY 160" /><div>'.$device["type_id_name"];
                if($device["dev_state"]) {
                  echo ' <span style=" color: #2aff26; font-size: 24px; line-height: 16px;">&bull;</span>';
                } else {
                  echo ' <span style="color:#ff5e00;font-size: 24px; line-height: 16px;">&bull;</span>';
                }
                echo '<br />'.$device["serialno"].'</div></a></div>'; ?>
                      
              <?php
              }
            }
          } else {
            echo "<div class='col-12'><h3 style='text-align:center'><a href='/dashboard/group-details/?group_id=".$response['device_groups'][$i]['id']."'>".$response['device_groups'][$i]['name']."</a></h3></div>";

            foreach($response["devices"] as $device) {
              if($device["group_id"] ==  $response['device_groups'][$i]['id']) {
                echo '<div class="col-12-sm col-3 wifydevice"><a target="_blank" href="?device='.$device["access_id"].'"><img src="/wp-content/uploads/2019/04/160.png" alt="WiFY 160" /><div>'.$device["name"];
                if($device["dev_state"]) {
                  echo ' <span style=" color: #2aff26; font-size: 24px; line-height: 16px;">&bull;</span>';
                } else {
                  echo ' <span style="color:#ff5e00;font-size: 24px; line-height: 16px;">&bull;</span>';
                }
                echo '<br />'.$device["serialno"].'</div></a></div>'; ?>
                      
              <?php
              }
            }
          }
        }
      } else {
        echo '<h2>My dashboard</h2>';
        require 'menu.php';
        echo '<p>Wecome'.$_SESSION["naam"].', no devices linked to your account.</p>';
      }

      ?>
      <div class="col-12">
        <form role = "form" method = "post">
          <button type = "submit" name = "logout" style="float: none;">Logout</button>
        </form>
      </div>
      </div>
    <?php
    } else { 
      echo '<script>window.location.replace("https://www.wify.eu/dashboard/login/");</script>';
    } ?>
</section>

<?php get_footer();  ?>