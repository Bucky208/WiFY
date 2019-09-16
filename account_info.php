<?php
/*
Template Name: Account info pagina
Template Post Type: dashboard
*/
require 'load.php';
require 'mustlogin.php';

get_header(); ?>
  <article id="featured">
  <h2><?php the_title(); ?></h2>
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
		 
	  
	  
	  
	  #Update============
if(isset($_POST['title']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['mobile'])
	&& isset($_POST['email']) && isset($_POST['locale']))
	{
			
			$data_array = array("domain" => "maximdegroote.be", "firstname"=>$_POST['firstname'],
			"lastname"=>$_POST['lastname'],"mobile"=>$_POST['mobile'],"email"=>$_POST['email'],
			"locale"=>$_POST['locale'],"address1"=>$_POST['address1'],"address2"=>$_POST['address2'],
			"type"=>$_POST['type'],"vat"=>$_POST['vat'],"device_groups" =>$response['device_groups'],
			"devices" =>$response['devices'],"title"=>$_POST['title']);
			/* backup data and reset groups

			$data_array = array("email"=>"maxim_d_g@hotmail.com",
								"firstname"=>"Maxim2",
								"lastname"=>"De Groote",
								"locale"=>"en-US",
								"mobile"=>"32479313445",
								"title"=>1,
								"devices"=>Array(0),
								"device_groups"=>Array(0),
								"address1"=>"fdssfs",
								"address2"=>"fsdfsdfds",
								"vat"=>"44654",
								"country"=>"Belgium",
								"type"=>"",
								"companyName"=>"MDG");
								print_r($data_array);
								*/
				
		  /* get user list by calling api with user ID*/
		  $url = "https://user.bluecherry.io/api/user/account/".$token->accountId;
          $get_data = callAPI('PUT', $url, json_encode($data_array));
          $response1 = json_decode($get_data, true);
		  echo "<h6 style='text-align:center;color:green'>Account Info Updated</h6>";
	}

	
		/* get user list by calling api with user ID*/
		$url = "https://user.bluecherry.io/api/user/account/".$token->accountId;
        $get_data = callAPI('GET', $url, false);
        $response = json_decode($get_data, true);	  
		 //print_r($response);
		  
		$title_option = array('-','Mr.','Ms.');
		$locale_option = array('UK','USA','Belgium');
		$locale_option_val = array('GB','US','BE');
		$type_option = array('Company','Private');
		$options='';
		$options1='';
		$options2='';
		for($i=1;$i<count($title_option);$i++)
		{
			$options .=($i==$response['title']) ? "<option value=".$i." selected>".$title_option[$i]."</option>" : "<option value=".$i.">".$title_option[$i]."</option>" ;
		}
		for($i=0;$i<count($locale_option);$i++)
		{
			$options1 .=($locale_option_val[$i]==$response['locale']) ? "<option value=".$locale_option_val[$i]." selected>".$locale_option[$i]."</option>" : "<option value=".$locale_option_val[$i].">".$locale_option[$i]."</option>" ;
		}
		for($i=0;$i<count($type_option);$i++)
		{
			$options2 .=($type_option[$i]==$response['type']) ? "<option value=".$type_option[$i]." selected>".$type_option[$i]."</option>" : "<option value=".$type_option[$i].">".$type_option[$i]."</option>" ;
		}	  
?>
		<!--<h1 style='text-align:center'>Account Details</h1>-->
		<form action='' method='POST'>
				<div class="row">
					<div class='col-2'>
						<label>Title</label>
						<select name='title' class='form-control'>
						<?php echo $options; ?>
						</select>
					</div>
				
					<div class='col-3'>
						<label>First name</label>
						<input type=text name='firstname' value='<?php echo $response['firstname']; ?>' class="form-control" required />
					</div>
				
					<div class='col-4'>
						<label>Last name</label>
						<input type=text name='lastname' value='<?php echo $response['lastname'] ?>' class="form-control" required />
					</div>
		
					<div class='col-3'>
						<label>Your mobile phone number</label>
						<input type=text name='mobile' value='<?php echo $response['mobile'] ?>' class="form-control" required />
					</div>
				
					<div class='col-6'>
						<label>Your email address</label>
						<input type=email name='email' value='<?php echo $response['email'] ?>' class="form-control" required />
					</div>
				
					<div class='col-3'>
						<label>Country</label>
						
						<select class="browser-default select form-control" name="locale">
							<option value="AT" <?php if($response['locale'] == "AT") echo "selected"; ?>>AT-Oostenrijk</option>
							<option value="BE" <?php if($response['locale'] == "BE") echo "selected"; ?>>BE-Belgie</option>
							<option value="BG" <?php if($response['locale'] == "BG") echo "selected"; ?>>BG-Bulgarije</option>
							<option value="CY" <?php if($response['locale'] == "CY") echo "selected"; ?>>CY-Cyprus</option>
							<option value="CZ" <?php if($response['locale'] == "CZ") echo "selected"; ?>>CZ-Tsjechie</option>
							<option value="DE" <?php if($response['locale'] == "DE") echo "selected"; ?>>DE-Duitsland</option>
							<option value="DK" <?php if($response['locale'] == "DK") echo "selected"; ?>>DK-Denemarken</option>
							<option value="EE" <?php if($response['locale'] == "EE") echo "selected"; ?>>EE-Estland</option>
							<option value="EL" <?php if($response['locale'] == "EL") echo "selected"; ?>>EL-Griekenland</option>
							<option value="ES" <?php if($response['locale'] == "ES") echo "selected"; ?>>ES-Spanje</option>
							<option value="EU" <?php if($response['locale'] == "EU") echo "selected"; ?>>EU-VoeS Number</option>
							<option value="FI" <?php if($response['locale'] == "FI") echo "selected"; ?>>FI-Finland</option>
							<option value="FR" <?php if($response['locale'] == "FR") echo "selected"; ?>>FR-Frankrijk</option>
							<option value="GB" <?php if($response['locale'] == "GB") echo "selected"; ?>>GB-Verenigd Koninkrijk</option>
							<option value="HR" <?php if($response['locale'] == "HR") echo "selected"; ?>>HR-Kroatie</option>
							<option value="HU" <?php if($response['locale'] == "HU") echo "selected"; ?>>HU-Hongarije</option>
							<option value="IE" <?php if($response['locale'] == "IE") echo "selected"; ?>>IE-Ierland</option>
							<option value="IT" <?php if($response['locale'] == "IT") echo "selected"; ?>>IT - Italy</option>
							<option value="LT" <?php if($response['locale'] == "LT") echo "selected"; ?>>LT-Litouwen</option>
							<option value="LU" <?php if($response['locale'] == "LU") echo "selected"; ?>>LU-Luxemburg</option>
							<option value="LV" <?php if($response['locale'] == "LV") echo "selected"; ?>>LV-Letland</option>
							<option value="MT" <?php if($response['locale'] == "MT") echo "selected"; ?>>MT-Malta</option>
							<option value="NL" <?php if($response['locale'] == "NL") echo "selected"; ?>>NL-Nederland</option>
							<option value="PL" <?php if($response['locale'] == "PL") echo "selected"; ?>>PL-Poland</option>
							<option value="PT" <?php if($response['locale'] == "PT") echo "selected"; ?>>PT-Portugal</option>
							<option value="RO" <?php if($response['locale'] == "RO") echo "selected"; ?>>RO-Roemenie</option>
							<option value="SE" <?php if($response['locale'] == "SE") echo "selected"; ?>>SE-Zweden</option>
							<option value="SI" <?php if($response['locale'] == "SI") echo "selected"; ?>>SI-Slovenie</option>
							<option value="SK" <?php if($response['locale'] == "SK") echo "selected"; ?>>SK-Slowakije</option>
						</select>
						
					</div>
				
					<div class='col-3'>
						<label>Type</label>
						<select name='type' class='form-control'>
							<?php echo $options2; ?>
						</select>
					</div>
				
					<div class='col-4'>
						<label>Address line 1</label>
						<input type=text name='address1' value='<?php echo $response['address1'] ?>' class="form-control" required />
					</div>
				
					<div class='col-4'>
						<label>Address line 2</label>
						<input type=text name='address2' value='<?php echo $response['address2'] ?>' class="form-control" />
					</div>
				
					<div class='col-4'>
						<label>VAT number</label>
						<input type=text name='vat' value='<?php echo $response['vat'] ?>' class="form-control" required />
					</div>

					<div class='col-6'>
						<p><a href="/dashboard/" class='btn btn-warning' style="margin-top: 9px;">Cancel / Go back</a></p>
					</div>

					<div class='col-6'>
						<input type=submit name='submit' class='btn btn-success' value="Save information" />
					</div>
				</div>
				
				
				
				
			</fieldset>
		</form>
</div>
<?php	   
         
         
}
else
{
	
	echo "<a href='index.php'>Login</a>";
}	
?>
</section>
<?php get_footer();  ?>