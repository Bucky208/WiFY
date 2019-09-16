<?php
/*
Template Name: Reset mail pagina
Template Post Type: dashboard
*/
require 'load.php';

get_header(); ?>
  <article id="featured">
  <h2>Password reset</h2>
  </article>                
  <section id="content">

<?php

if (isset($_POST)) {
	if (isset($_POST['email'])) {
			// print_r($_POST);
			 // CAll API for registration---------
			  $data_array = array("domain" => "wify.eu", "email"=>$_POST['email']);
			  $url = 'https://sso.bluecherry.io/api/sso/account/reset/';
			  $make_call = callAPI('POST', $url, json_encode($data_array));
			  $response = json_decode($make_call, true);
			  // print_r($response);
			  $msg = "<h6 style='text-align:center;color:green'>Reset mail send</h6>";
	}		 
}
?>

	  <?php /* global $wp;
$email = $wp->query_vars['email']; echo $email; */ ?>
<div>
	<?php if(!empty($msg)) { ?><p style="color:red;text-align: center;"><?php echo $msg; ?></p><?php } ?>
			<h6 style='text-align:center'>Choose a new password for your WiFY.eu account by entering your email address in the form. If the email address is correct you will receive an email with the link to reset your password.</h6>
			<form action='' method='POST' class="customform">
					<div class="row">
						<div class='col-12'>
							<label>E-mail address</label>
							<input type='email' name='email' class="form-control" required />
						</div>
		
						<div class='col-6'>
						<p><a href="/dashboard/login/" class='btn btn-warning' style="margin-top: 9px;">Cancel / Go back</a></p>
					</div>

					<div class='col-6'>
						<input type=submit name='submit' class='btn btn-success' value="Send reset mail" />
					</div>
					</div>
					
					
					
					
			</form>
		</div>

<?php
?>
</section>
<?php get_footer();  ?>