<?php
/*
Template Name: Add device pagina
Template Post Type: dashboard
*/
require 'load.php';
require 'mustlogin.php';

get_header(); ?>
  <article id="featured">
  <h2>Add device</h2>
  </article>                
  <section id="content">
<div class="customform" style="padding: 20px 0;">
	<fieldset>
<?php

if (isset($_POST['access_id'])) {
         //print_r($_POST);
     // CAll API for registration---------
      $data_array = array("domain" => "maximdegroote.be", "access_id"=>$_POST['access_id']);
      $url = 'https://user.bluecherry.io/api/user/device/claim';
      $make_call = callAPI('POST', $url, json_encode($data_array));
      $response = json_decode($make_call, true);
      //print_r($response);
		$msg = "Device activated";
     if(!empty($response["err"])) {
      $msg = "Wrong code";
     }
     
    
}
 ?>

<div>
	<?php if(!empty($msg)) { ?><p style="color:red;text-align: center;"><?php echo $msg; ?></p><?php } ?>
      <h1 style='text-align:center'>Claim a new deivce</h1>
      <form action='' method='POST'>
          
          <div class="row">
            <div class='col-12'>
              <label>Code</label>
              <input type=text name='access_id' class="form-control" required />
            </div>
      
          
          
          
          			<div class='col-6'>
						<p><a href="/dashboard/" class='btn btn-warning' style="margin-top: 9px;">Cancel / Go back</a></p>
					</div>

					<div class='col-6'>
						<input type=submit name='submit' class='btn btn-success' value="Activate" />
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