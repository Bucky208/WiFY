<?php
/*
Template Name: Reset pagina
Template Post Type: dashboard
*/
require 'load.php';
require 'mustlogin.php';

get_header(); ?>
  <article id="featured">
  <h2>Reset</h2>
  </article>                
  <section id="content">
<div class="customform" style="padding: 20px 0;">
	<fieldset>
<?php
if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {     
  if (!empty($_SESSION["token"])) {
    /* if logged in, session, decode token again for user ID and name*/
    $token = JWT::decode($_SESSION["token"], null, false);
    $email = $token->email;

    if(isset($_GET['email'])){ $email = $_GET['email']; }

  //login call
  $data_array = array("email" => $email, "password" => $_POST['password'], "domain" => "wify.eu");
  $url = 'https://sso.bluecherry.io/api/sso/account/login/';
  $make_call = callAPI('POST', $url, json_encode($data_array));
  $response = json_decode($make_call, true);

    if(!empty($response["token"])) {

      	if (isset($email) && isset($_POST['uuid'])) {
		 if($_POST['rpword'] !=$_POST['pword']){
			 $msg = "Please write password and retype password same";
			 return;
			}
		 // CAll API for Reset PASSWORD---------
		  $data_array = array("domain" => "wify.eu", "email"=>$email, "uuid"=>$_POST['uuid'],
		  "password"=>$_POST['pword'],"repeatPassword" => $_POST['rpword']);
		  $url = 'https://sso.bluecherry.io/api/sso/account/setpassword/';
		  $make_call = callAPI('POST', $url, json_encode($data_array));
		  $response = json_decode($make_call, true);
		  $msg = "Password Reset Successful";
		  
		}


    } else {
      $msg = 'Wrong password.';
    }
  }
		
}
		
  
 ?>

<div>
<!--			<h1 style='text-align:center'>Password&nbsp;Reset</h1>-->
	    <?php if(!empty($msg)) { ?><p style="color:red;text-align: center;"><?php echo $msg; ?></p><?php } ?>

			<form action='' method='POST' align=center>
				<h6 style='text-align:center'>Your password must be at least 8 characters in length and contain an uppercase and lower case letter, at least one number and one special character (i.e. !, $, #, *).</h6>
					<div class="row">
					<?php if(isset($_GET['uuid'])){ ?>
						<div class='col-4'>
							<label>Email&nbsp;ID</label>
							<input type=email name='email' value='<?php if(isset($_GET['email'])){ echo $_GET['email'];}?>' class="form-control" required />
						</div>
					
					<input type=text name='uuid' value='<?php if(isset($_GET['uuid'])){ echo $_GET['uuid'];}?>' style='display:none' />
					<?php } else { ?>
						<div class='col-4'>
							<label>Old password</label>
							<input type=password name='password' class="form-control" required />
						</div>
						<?php }
						?>
						<div class='col-4'>
							<label>New password</label>
							<input type=password name='pword' class="form-control" required />
						</div>
		
						<div class='col-4'>
							<label>Retype new oassword</label>
							<input type=password name='rpword' class="form-control" required />
						</div>
				

					<div class='col-6'>
						<p style="text-align:left;"><a href="/dashboard/" class='btn btn-warning' style="margin-top: 9px;">Cancel / Go back</a></p>
					</div>

					<div class='col-6'>
						<input type=submit name='submit' class='btn btn-success' value="Change password" />
					</div>
						
					</div>
					
			</form>
		</div>

<?php


?>
	</fieldset>
	  </div>
</section>
<?php get_footer();  ?>