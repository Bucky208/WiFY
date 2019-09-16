<?php
/*
Template Name: Add group pagina
Template Post Type: dashboard
*/
require 'load.php';
require 'mustlogin.php';


get_header(); ?>
  <article id="featured">
  <h2>Add group</h2>
  </article>                
  <section id="content">

<?php

if (isset($_POST)) {
	if (isset($_POST['name'])) {
			// print_r($_POST);
			 // CAll API for registration---------

	  	if (!empty($_SESSION["token"])) {
	  		$token = JWT::decode($_SESSION["token"], null, false);

	  		/* get group list by calling api with user ID*/
		    $get_data = callAPI('GET', 'https://user.bluecherry.io/api/user/'.$token->accountId.'/devices', false);
		    $response = json_decode($get_data, true);
		    $devices = $response["device_groups"]; 

		    $newgroups = array();
		    $latestid = 0;
		    for($i=0;$i<count($devices);$i++) {
		    	if(isset($devices[$i]['parent_id'])) {
			    	if($devices[$i]['parent_id'] == '-1') {
			    		$latestid = $devices[$i]['id'];
			    		array_push($newgroups, $devices[$i]);
			    	}
			    }
		    }

		    $newid = $latestid + 1;
		    
		    $addnewgroup = array("name" => $_POST['name'], "parent_id" => -1, "id" => $newid);
		    array_push($newgroups, $addnewgroup);

			  $data_array = array("device_groups" => $newgroups);
			  $url = 'https://user.bluecherry.io/api/user/'.$token->accountId.'/devicegroups';
			  

			  $make_call = callAPI('PUT', $url, json_encode($data_array));
			  $response = json_decode($make_call, true);
			  
			  echo "<h6 style='text-align:center;color:green'>Group added</h6>";
		}
	}		 
}
	

?>

	  <?php /* global $wp;
$email = $wp->query_vars['email']; echo $email; */ ?>
<div>
			<form action='' method='POST' class="customform">
					<div class="row">
						<div class='col-12'>
							<label>Group name</label>
							<input type='text' name='name' class="form-control" required />
						</div>
		
						<div class='col-6'>
						<p><a href="/dashboard/" class='btn btn-warning' style="margin-top: 9px;">Cancel / Go back</a></p>
					</div>

					<div class='col-6'>
						<input type=submit name='submit' class='btn btn-success' value="Add group" />
					</div>
					</div>
					
					
					
					
			</form>
		</div>

<?php
?>
</section>
<?php get_footer();  ?>