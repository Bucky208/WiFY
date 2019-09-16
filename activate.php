<?php
/*
Template Name: Activate pagina
Template Post Type: dashboard
*/
require 'load.php';

get_header(); ?>
  <article id="featured">
  <h2>Activate</h2>
  </article>                
  <section id="content">

<?php

if (isset($_GET['email']) && isset($_GET['uuid'])) {
		 // CAll API for ACTIVATE ACCOUNT---------
		  $data_array = array("domain" => "wify.eu", "email"=>$_GET['email'], "uuid"=>$_GET['uuid']);
		  $url = 'https://sso.bluecherry.io/api/sso/account/activate/'.$_GET['email'].'/'.$_GET['uuid'];
		  $make_call = callAPI('POST', $url, json_encode($data_array));
		  $response = json_decode($make_call, true);
		  echo "Activation Successful";
		  print_r($response);
}
else{		  
	echo "Activation failed";
}

?>
</section>
<?php get_footer();  ?>