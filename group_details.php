<?php
/*
Template Name: Group details pagina
Template Post Type: dashboard
*/
require 'load.php';
require 'mustlogin.php';

get_header(); ?>
  <article id="featured">
  <h2>Group details</h2>
  </article>                
  <section id="content">
<div class="customform" style="padding: 20px 0;">
	<fieldset>
<?php

if (!empty($_SESSION["token"])) {
	  $token = JWT::decode($_SESSION["token"], null, false);
	  
	   /* get user list by calling api with user ID*/
		  $url = "https://user.bluecherry.io/api/user/account/".$token->accountId;
          $get_data = callAPI('GET', $url, false);
          $response = json_decode($get_data, true);
	
$group_name='';

if(isset($_POST['submit1']) && isset($_GET['group_id']))
{
	
	$group_id = $_POST['group_id'];
	$url = "https://user.bluecherry.io/api/user/group/".$group_id;
	$data = array("group_id"=>$_GET['group_id'],"name"=>$_POST['group_name']);
	$get_data = callAPI('PUT', $url, json_encode($data));
	$response = json_decode($get_data, true);
}	
if(isset($_POST['submit2']) && isset($_GET['group_id']))
{
	echo "coming..";
	$group_id = $_POST['group_id'];
	$url = "https://user.bluecherry.io/api/user/group/".$group_id;
	$get_data = callAPI('DELETE', $url, false);
	$response = json_decode($get_data, true);
	print_r($response);
}	
if(isset($_POST['submit_device']) && isset($_GET['group_id']))
{
	
	$group_id = $_GET['group_id'];
	$device_name = $_POST['device_name'];
	$serialno = $_POST['serialno'];
	$url = "https://user.bluecherry.io/api/user/group/".$serialno."/devices";
	$data = array("group_id"=>$_GET['group_id'],"name"=>$_POST['device_name']);
	$get_data = callAPI('PUT', $url, json_encode($data));
	$response = json_decode($get_data, true);
}	
	  
	  
	$devices = array();
	
if(isset($_GET['group_id']))
	{
		$group_id = $_GET['group_id'];
		  /* get user list by calling api with user ID*/
		  $url = "https://user.bluecherry.io/api/user/group/".$group_id;
          $get_data = callAPI('GET', $url, false);
          $response1 = json_decode($get_data, true);
		  // print_r($response1);
		  
		  if(isset($response1['group']['group_id']))
		  {
			$group_id = $response1['group']['group_id'];  
		  }
		  elseif(isset($response1['group']['id']))
		  {
			$group_id = $response1['group']['id'];
			  $group_name = $response1['group']['name'];
			  $devices = $response1['devices'];
		  }
	}
		  
  
?>

		
				<div class="row">
					<div class='col-12'>
					
						<h1 style='text-align:center'>Group Details</h1>
						<form action='/dashboard/group-details/?group_id=<?php echo $group_id;?>' method='POST'>
								<input type=text name='group_id' value='<?php echo $group_id?>' style='display:none'/>
								<div class='row'>
									<div class='col-8'>
										<label>Group&nbsp;Name&nbsp;</label>
									
										<input type='text' name='group_name' value='<?php echo $group_name;?>' class='form-control'>
									</div>

									<div class='col-4'>
										<?php if(isset($response1['group']['id'])){?>
											<input type=submit name='submit2' value='Delete' class='btn btn-danger' />
										<?php }?>
									</div>

									 <div class='col-6'>
										<p><a href="/dashboard/" class='btn btn-warning' style="margin-top: 9px;">Cancel / Go back</a></p>
									</div>

									<div class='col-6'>
										<input type=submit name='submit1' class='btn btn-success' value="Update" />
										
									</div>

									
								</div>
						</form>
						
					</div>
					<div class='col-12'>
					
						
								<h1 style='text-align:center'>Device Details</h1>
								<?php 
									for($i=0;$i<count($devices);$i++){?>
									<form action='/dashboard/group-details/?group_id=<?php echo $group_id;?>' method='POST'>
										<div class='row'>
											<input type='text' name='count' value=<?php echo $i;?> style='display:none' />
											<input type='text' name='serialno' value=<?php echo $devices[$i]['serialno'];?> style='display:none' />
											<div class='col-8'>
												<label>Device&nbsp;Name&nbsp;</label>
												<input type='text' name='device_name' value=<?php echo $devices[$i]['name'] ?> class='form-control'>
											</div>
											<div class='col-4'>
												<input type=submit name='submit_device' value='Update' class='btn btn-success' />
											</div>
										</div>
								  </form>
								<?php }?>
						
				</div>
			</div>
				
				
				
				
		

<?php	   
         
         
}
else
{
	
	echo "<a href='index.php'>Login</a>";
}	
?>
</fieldset>
</div>
</section>
<?php get_footer();  ?>