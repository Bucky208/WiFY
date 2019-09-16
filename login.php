<?php
/*
Template Name: Login pagina
Template Post Type: dashboard
*/

require 'load.php';

get_header();
?>

      <article id="featured">
        <h2>Login</h2>
      </article>                
      <section id="content">
      
         <?php
        //post event login
        if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {         
          //login call
          $data_array = array("email" => $_POST['username'], "password" => $_POST['password'], "domain" => "maximdegroote.be");
          $url = 'https://sso.bluecherry.io/api/sso/account/login/';
          $make_call = callAPI('POST', $url, json_encode($data_array));
          $response = json_decode($make_call, true);

            if(!empty($response["token"])) {
              $_SESSION["token"] = $response["token"];
              
              echo '<script>window.location.replace("https://www.wify.eu/dashboard/");</script>';

            } else {
              $msg = 'Wrong combination.';
            }
        } else if (!empty($_SESSION["token"])) {
            
          echo '<script>window.location.replace("https://www.wify.eu/dashboard/");</script>';

        } 
        if (!empty($_SESSION["token"])) {
          echo '<script>window.location.replace("https://www.wify.eu/dashboard/");</script>';
        } else { ?>
    <h2 style="text-align:center;">Please enter your e-mail and password</h2>
    <?php if(!empty($msg)) { ?><p style="color:red;text-align: center;"><?php echo $msg; ?></p><?php } ?>
        <div id="contact" style="padding: 20px 0;">
        <form role = "form" method = "post">
            <fieldset>
              <p>
                <!--<label style="z-index: 5;" for="username" style="margin-top: 0px;">Username</label>-->
                <input type="text" name="username" id="username" required="" placeholder="Username">
              </p>

              <p>
                <!--<label style="z-index: 5;" for="password" style="margin-top: 0px;">Password</label>-->
                <input type="password" name="password" id="password" required="" placeholder="Password">
              </p>
              <p><button type="submit" name="login">Login</button></p>
              <p><a href="/dashboard/register/"><strong>New? Create your account here</strong></a><a href="/dashboard/password-reset-mail/" style="float: right;">Reset my password</a></p>
            </fieldset>
         </form>
</div>
     <?php } ?>
</section>
<script>
document.getElementById('contact').click();
setTimeout(function(){
  document.getElementById('contact').click();
}, 100); 
</script>
<?php get_footer();  ?>