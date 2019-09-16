<?php
/*
Template Name: Register pagina
Template Post Type: dashboard
*/
require 'load.php';

get_header(); ?>
  <article id="featured">
  <h2>Register</h2>
  </article>                
  <section id="content">

	  <div class="customform" style="padding: 20px 0;">
	<fieldset>
		
<?php

if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['mob_no']) && isset($_POST['email']) 
	&& isset($_POST['pword']) && isset($_POST['rpword']) && isset($_POST['locale'])) {
         print_r($_POST);
		 if($_POST['rpword'] !=$_POST['pword']){
			 echo "Please write password and retype password same";
			 return;
			}
		  echo "<br><br>";
		 // CAll API for registration---------
		  $data_array = array("domain" => "wify.eu", "locale"=>$_POST['locale'], 
		  "email" => $_POST['email'],"mobile" => $_POST['mob_no'], "title" => $_POST['title'], 
		  "firstname" => $_POST['fname'], "lastname" => $_POST['lname'], "password" => $_POST['pword'], "repeatPassword" => $_POST['rpword']);
		  $url = 'https://sso.bluecherry.io/api/sso/account/register';
		  $make_call = callAPI('POST', $url, json_encode($data_array));
		  $response = json_decode($make_call, true);
		  print_r($response);
		 
		 
		 echo "<br><br>";
		 /* if logged in, session, decode token again for user ID and name*/
		 if(!empty($_SESSION['token']))
		 {
			$token = JWT::decode($_SESSION["token"], null, false);
			$_SESSION["naam"] = $token->accountFirstname;

			/* get user list by calling api with user ID*/
			$get_data = callAPI('GET', 'https://user.bluecherry.io/api/user/'.$token->accountId.'/devices', false);
			$response = json_decode($get_data, true);
			$devices = $response["devices"];          
			print_r($response); 
		 }
}
else
{ ?>

<div>
			<form action='' method='POST'>
					
					<div class="row">
						<div class='col-3'>
							<label>Title</label>
							<select name='title' class='form-control'>
								<option value='1'>Mr.</option>
								<option value='2'>Ms.</option>
							</select>
						</div>
					
						<div class='col-4'>
							<label>First&nbsp;Name</label>
							<input type=text name='fname' class="form-control" required />
						</div>
					
						<div class='col-5'>
							<label>Last&nbsp;Name</label>
							<input type=text name='lname' class="form-control" required />
						</div>
					
						<div class='col-4'>
							<label>Mobile&nbsp;Number</label>
							<input type=text name='mob_no' class="form-control" required />
						</div>
					
						<div class='col-8'>
							<label>Email&nbsp;Address</label>
							<input type=email name='email' class="form-control" required />
						</div>
					
						<div class='col-4'>
							<label>Password</label>
							<input type=password name='pword' class="form-control" required />
						</div>
					
						<div class='col-4'>
							<label>Retype&nbsp;Password</label>
							<input type=password name='rpword' class="form-control" required />
						</div>
					
						<div class='col-4'>
							<label>Land</label>
							<select name='locale' class='form-control'>
								<option value="ps-AF">Afghanistan - پښتو</option><option value="uz-AF">Afghanistan - Oʻzbek</option><option value="tk-AF">Afghanistan - Türkmen</option><option value="sv-AX">Åland Islands - svenska</option><option value="sq-AL">Albania - Shqip</option><option value="ar-DZ">Algeria - العربية</option><option value="en-AS">American Samoa - English</option><option value="sm-AS">American Samoa - gagana fa'a Samoa</option><option value="ca-AD">Andorra - català</option><option value="pt-AO">Angola - Português</option><option value="en-AI">Anguilla - English</option><option value="en-AQ">Antarctica - English</option><option value="ru-AQ">Antarctica - Русский</option><option value="en-AG">Antigua and Barbuda - English</option><option value="es-AR">Argentina - Español</option><option value="gn-AR">Argentina - Avañe'ẽ</option><option value="hy-AM">Armenia - Հայերեն</option><option value="ru-AM">Armenia - Русский</option><option value="nl-AW">Aruba - Nederlands</option><option value="pa-AW">Aruba - ਪੰਜਾਬੀ</option><option value="en-AU">Australia - English</option><option value="de-AT">Austria - Deutsch</option><option value="az-AZ">Azerbaijan - azərbaycan dili</option><option value="en-BS">Bahamas - English</option><option value="ar-BH">Bahrain - العربية</option><option value="bn-BD">Bangladesh - বাংলা</option><option value="en-BB">Barbados - English</option><option value="be-BY">Belarus - беларуская мова</option><option value="ru-BY">Belarus - Русский</option><option value="nl-BE">Belgium - Nederlands</option><option value="fr-BE">Belgium - français</option><option value="de-BE">Belgium - Deutsch</option><option value="en-BZ">Belize - English</option><option value="es-BZ">Belize - Español</option><option value="fr-BJ">Benin - français</option><option value="en-BM">Bermuda - English</option><option value="dz-BT">Bhutan - རྫོང་ཁ</option><option value="es-BO">Bolivia (Plurinational State of) - Español</option><option value="ay-BO">Bolivia (Plurinational State of) - aymar aru</option><option value="qu-BO">Bolivia (Plurinational State of) - Runa Simi</option><option value="nl-BQ">Bonaire, Sint Eustatius and Saba - Nederlands</option><option value="bs-BA">Bosnia and Herzegovina - bosanski jezik</option><option value="hr-BA">Bosnia and Herzegovina - hrvatski jezik</option><option value="sr-BA">Bosnia and Herzegovina - српски језик</option><option value="en-BW">Botswana - English</option><option value="tn-BW">Botswana - Setswana</option><option value="no-BV">Bouvet Island - Norsk</option><option value="nb-BV">Bouvet Island - Norsk bokmål</option><option value="nn-BV">Bouvet Island - Norsk nynorsk</option><option value="pt-BR">Brazil - Português</option><option value="en-IO">British Indian Ocean Territory - English</option><option value="en-UM">United States Minor Outlying Islands - English</option><option value="en-VG">Virgin Islands (British) - English</option><option value="en-VI">Virgin Islands (U.S.) - English</option><option value="ms-BN">Brunei Darussalam - bahasa Melayu</option><option value="bg-BG">Bulgaria - български език</option><option value="fr-BF">Burkina Faso - français</option><option value="ff-BF">Burkina Faso - Fulfulde</option><option value="fr-BI">Burundi - français</option><option value="rn-BI">Burundi - Ikirundi</option><option value="km-KH">Cambodia - ខ្មែរ</option><option value="en-CM">Cameroon - English</option><option value="fr-CM">Cameroon - français</option><option value="en-CA">Canada - English</option><option value="fr-CA">Canada - français</option><option value="pt-CV">Cabo Verde - Português</option><option value="en-KY">Cayman Islands - English</option><option value="fr-CF">Central African Republic - français</option><option value="sg-CF">Central African Republic - yângâ tî sängö</option><option value="fr-TD">Chad - français</option><option value="ar-TD">Chad - العربية</option><option value="es-CL">Chile - Español</option><option value="zh-CN">China - 中文 (Zhōngwén)</option><option value="en-CX">Christmas Island - English</option><option value="en-CC">Cocos (Keeling) Islands - English</option><option value="es-CO">Colombia - Español</option><option value="ar-KM">Comoros - العربية</option><option value="fr-KM">Comoros - français</option><option value="fr-CG">Congo - français</option><option value="ln-CG">Congo - Lingála</option><option value="fr-CD">Congo (Democratic Republic of the) - français</option><option value="ln-CD">Congo (Democratic Republic of the) - Lingála</option><option value="kg-CD">Congo (Democratic Republic of the) - Kikongo</option><option value="sw-CD">Congo (Democratic Republic of the) - Kiswahili</option><option value="lu-CD">Congo (Democratic Republic of the) - Tshiluba</option><option value="en-CK">Cook Islands - English</option><option value="es-CR">Costa Rica - Español</option><option value="hr-HR">Croatia - hrvatski jezik</option><option value="es-CU">Cuba - Español</option><option value="nl-CW">Curaçao - Nederlands</option><option value="pa-CW">Curaçao - ਪੰਜਾਬੀ</option><option value="en-CW">Curaçao - English</option><option value="el-CY">Cyprus - ελληνικά</option><option value="tr-CY">Cyprus - Türkçe</option><option value="hy-CY">Cyprus - Հայերեն</option><option value="cs-CZ">Czech Republic - čeština</option><option value="sk-CZ">Czech Republic - slovenčina</option><option value="da-DK">Denmark - dansk</option><option value="fr-DJ">Djibouti - français</option><option value="ar-DJ">Djibouti - العربية</option><option value="en-DM">Dominica - English</option><option value="es-DO">Dominican Republic - Español</option><option value="es-EC">Ecuador - Español</option><option value="ar-EG">Egypt - العربية</option><option value="es-SV">El Salvador - Español</option><option value="es-GQ">Equatorial Guinea - Español</option><option value="fr-GQ">Equatorial Guinea - français</option><option value="ti-ER">Eritrea - ትግርኛ</option><option value="ar-ER">Eritrea - العربية</option><option value="en-ER">Eritrea - English</option><option value="et-EE">Estonia - eesti</option><option value="am-ET">Ethiopia - አማርኛ</option><option value="en-FK">Falkland Islands (Malvinas) - English</option><option value="fo-FO">Faroe Islands - føroyskt</option><option value="en-FJ">Fiji - English</option><option value="fj-FJ">Fiji - vosa Vakaviti</option><option value="hi-FJ">Fiji - हिन्दी</option><option value="ur-FJ">Fiji - اردو</option><option value="fi-FI">Finland - suomi</option><option value="sv-FI">Finland - svenska</option><option value="fr-FR">France - français</option><option value="fr-GF">French Guiana - français</option><option value="fr-PF">French Polynesia - français</option><option value="fr-TF">French Southern Territories - français</option><option value="fr-GA">Gabon - français</option><option value="en-GM">Gambia - English</option><option value="ka-GE">Georgia - ქართული</option><option value="de-DE">Germany - Deutsch</option><option value="en-GH">Ghana - English</option><option value="en-GI">Gibraltar - English</option><option value="el-GR">Greece - ελληνικά</option><option value="kl-GL">Greenland - kalaallisut</option><option value="en-GD">Grenada - English</option><option value="fr-GP">Guadeloupe - français</option><option value="en-GU">Guam - English</option><option value="ch-GU">Guam - Chamoru</option><option value="es-GU">Guam - Español</option><option value="es-GT">Guatemala - Español</option><option value="en-GG">Guernsey - English</option><option value="fr-GG">Guernsey - français</option><option value="fr-GN">Guinea - français</option><option value="ff-GN">Guinea - Fulfulde</option><option value="pt-GW">Guinea-Bissau - Português</option><option value="en-GY">Guyana - English</option><option value="fr-HT">Haiti - français</option><option value="ht-HT">Haiti - Kreyòl ayisyen</option><option value="en-HM">Heard Island and McDonald Islands - English</option><option value="la-VA">Holy See - latine</option><option value="it-VA">Holy See - Italiano</option><option value="fr-VA">Holy See - français</option><option value="de-VA">Holy See - Deutsch</option><option value="es-HN">Honduras - Español</option><option value="en-HK">Hong Kong - English</option><option value="zh-HK">Hong Kong - 中文 (Zhōngwén)</option><option value="hu-HU">Hungary - magyar</option><option value="is-IS">Iceland - Íslenska</option><option value="hi-IN">India - हिन्दी</option><option value="en-IN">India - English</option><option value="id-ID">Indonesia - Bahasa Indonesia</option><option value="fr-CI">Côte d'Ivoire - français</option><option value="fa-IR">Iran (Islamic Republic of) - فارسی</option><option value="ar-IQ">Iraq - العربية</option><option value="ku-IQ">Iraq - Kurdî</option><option value="ga-IE">Ireland - Gaeilge</option><option value="en-IE">Ireland - English</option><option value="en-IM">Isle of Man - English</option><option value="gv-IM">Isle of Man - Gaelg</option><option value="he-IL">Israel - עברית</option><option value="ar-IL">Israel - العربية</option><option value="it-IT">Italy - Italiano</option><option value="en-JM">Jamaica - English</option><option value="ja-JP">Japan - 日本語 (にほんご)</option><option value="en-JE">Jersey - English</option><option value="fr-JE">Jersey - français</option><option value="ar-JO">Jordan - العربية</option><option value="kk-KZ">Kazakhstan - қазақ тілі</option><option value="ru-KZ">Kazakhstan - Русский</option><option value="en-KE">Kenya - English</option><option value="sw-KE">Kenya - Kiswahili</option><option value="en-KI">Kiribati - English</option><option value="ar-KW">Kuwait - العربية</option><option value="ky-KG">Kyrgyzstan - Кыргызча</option><option value="ru-KG">Kyrgyzstan - Русский</option><option value="lo-LA">Lao People's Democratic Republic - ພາສາລາວ</option><option value="lv-LV">Latvia - latviešu valoda</option><option value="ar-LB">Lebanon - العربية</option><option value="fr-LB">Lebanon - français</option><option value="en-LS">Lesotho - English</option><option value="st-LS">Lesotho - Sesotho</option><option value="en-LR">Liberia - English</option><option value="ar-LY">Libya - العربية</option><option value="de-LI">Liechtenstein - Deutsch</option><option value="lt-LT">Lithuania - lietuvių kalba</option><option value="fr-LU">Luxembourg - français</option><option value="de-LU">Luxembourg - Deutsch</option><option value="lb-LU">Luxembourg - Lëtzebuergesch</option><option value="zh-MO">Macao - 中文 (Zhōngwén)</option><option value="pt-MO">Macao - Português</option><option value="mk-MK">Macedonia (the former Yugoslav Republic of) - македонски јазик</option><option value="fr-MG">Madagascar - français</option><option value="mg-MG">Madagascar - fiteny malagasy</option><option value="en-MW">Malawi - English</option><option value="ny-MW">Malawi - chiCheŵa</option><option value="MY">Malaysia - بهاس مليسيا</option><option value="dv-MV">Maldives - ދިވެހި</option><option value="fr-ML">Mali - français</option><option value="mt-MT">Malta - Malti</option><option value="en-MT">Malta - English</option><option value="en-MH">Marshall Islands - English</option><option value="mh-MH">Marshall Islands - Kajin M̧ajeļ</option><option value="fr-MQ">Martinique - français</option><option value="ar-MR">Mauritania - العربية</option><option value="en-MU">Mauritius - English</option><option value="fr-YT">Mayotte - français</option><option value="es-MX">Mexico - Español</option><option value="en-FM">Micronesia (Federated States of) - English</option><option value="ro-MD">Moldova (Republic of) - Română</option><option value="fr-MC">Monaco - français</option><option value="mn-MN">Mongolia - Монгол хэл</option><option value="sr-ME">Montenegro - српски језик</option><option value="bs-ME">Montenegro - bosanski jezik</option><option value="sq-ME">Montenegro - Shqip</option><option value="hr-ME">Montenegro - hrvatski jezik</option><option value="en-MS">Montserrat - English</option><option value="ar-MA">Morocco - العربية</option><option value="pt-MZ">Mozambique - Português</option><option value="my-MM">Myanmar - ဗမာစာ</option><option value="en-NA">Namibia - English</option><option value="af-NA">Namibia - Afrikaans</option><option value="en-NR">Nauru - English</option><option value="na-NR">Nauru - Dorerin Naoero</option><option value="ne-NP">Nepal - नेपाली</option><option value="nl-NL">Netherlands - Nederlands</option><option value="fr-NC">New Caledonia - français</option><option value="en-NZ">New Zealand - English</option><option value="mi-NZ">New Zealand - te reo Māori</option><option value="es-NI">Nicaragua - Español</option><option value="fr-NE">Niger - français</option><option value="en-NG">Nigeria - English</option><option value="en-NU">Niue - English</option><option value="en-NF">Norfolk Island - English</option><option value="ko-KP">Korea (Democratic People's Republic of) - 한국어</option><option value="en-MP">Northern Mariana Islands - English</option><option value="ch-MP">Northern Mariana Islands - Chamoru</option><option value="no-NO">Norway - Norsk</option><option value="nb-NO">Norway - Norsk bokmål</option><option value="nn-NO">Norway - Norsk nynorsk</option><option value="ar-OM">Oman - العربية</option><option value="en-PK">Pakistan - English</option><option value="ur-PK">Pakistan - اردو</option><option value="en-PW">Palau - English</option><option value="ar-PS">Palestine, State of - العربية</option><option value="es-PA">Panama - Español</option><option value="en-PG">Papua New Guinea - English</option><option value="es-PY">Paraguay - Español</option><option value="gn-PY">Paraguay - Avañe'ẽ</option><option value="es-PE">Peru - Español</option><option value="en-PH">Philippines - English</option><option value="en-PN">Pitcairn - English</option><option value="pl-PL">Poland - język polski</option><option value="pt-PT">Portugal - Português</option><option value="es-PR">Puerto Rico - Español</option><option value="en-PR">Puerto Rico - English</option><option value="ar-QA">Qatar - العربية</option><option value="sq-XK">Republic of Kosovo - Shqip</option><option value="sr-XK">Republic of Kosovo - српски језик</option><option value="fr-RE">Réunion - français</option><option value="ro-RO">Romania - Română</option><option value="ru-RU">Russian Federation - Русский</option><option value="rw-RW">Rwanda - Ikinyarwanda</option><option value="en-RW">Rwanda - English</option><option value="fr-RW">Rwanda - français</option><option value="fr-BL">Saint Barthélemy - français</option><option value="en-SH">Saint Helena, Ascension and Tristan da Cunha - English</option><option value="en-KN">Saint Kitts and Nevis - English</option><option value="en-LC">Saint Lucia - English</option><option value="en-MF">Saint Martin (French part) - English</option><option value="fr-MF">Saint Martin (French part) - français</option><option value="nl-MF">Saint Martin (French part) - Nederlands</option><option value="fr-PM">Saint Pierre and Miquelon - français</option><option value="en-VC">Saint Vincent and the Grenadines - English</option><option value="sm-WS">Samoa - gagana fa'a Samoa</option><option value="en-WS">Samoa - English</option><option value="it-SM">San Marino - Italiano</option><option value="pt-ST">Sao Tome and Principe - Português</option><option value="ar-SA">Saudi Arabia - العربية</option><option value="fr-SN">Senegal - français</option><option value="sr-RS">Serbia - српски језик</option><option value="fr-SC">Seychelles - français</option><option value="en-SC">Seychelles - English</option><option value="en-SL">Sierra Leone - English</option><option value="en-SG">Singapore - English</option><option value="ms-SG">Singapore - bahasa Melayu</option><option value="ta-SG">Singapore - தமிழ்</option><option value="zh-SG">Singapore - 中文 (Zhōngwén)</option><option value="nl-SX">Sint Maarten (Dutch part) - Nederlands</option><option value="en-SX">Sint Maarten (Dutch part) - English</option><option value="sk-SK">Slovakia - slovenčina</option><option value="sl-SI">Slovenia - slovenski jezik</option><option value="en-SB">Solomon Islands - English</option><option value="so-SO">Somalia - Soomaaliga</option><option value="ar-SO">Somalia - العربية</option><option value="af-ZA">South Africa - Afrikaans</option><option value="en-ZA">South Africa - English</option><option value="nr-ZA">South Africa - isiNdebele</option><option value="st-ZA">South Africa - Sesotho</option><option value="ss-ZA">South Africa - SiSwati</option><option value="tn-ZA">South Africa - Setswana</option><option value="ts-ZA">South Africa - Xitsonga</option><option value="ve-ZA">South Africa - Tshivenḓa</option><option value="xh-ZA">South Africa - isiXhosa</option><option value="zu-ZA">South Africa - isiZulu</option><option value="en-GS">South Georgia and the South Sandwich Islands - English</option><option value="ko-KR">Korea (Republic of) - 한국어</option><option value="en-SS">South Sudan - English</option><option value="es-ES">Spain - Español</option><option value="si-LK">Sri Lanka - සිංහල</option><option value="ta-LK">Sri Lanka - தமிழ்</option><option value="ar-SD">Sudan - العربية</option><option value="en-SD">Sudan - English</option><option value="nl-SR">Suriname - Nederlands</option><option value="no-SJ">Svalbard and Jan Mayen - Norsk</option><option value="en-SZ">Swaziland - English</option><option value="ss-SZ">Swaziland - SiSwati</option><option value="sv-SE">Sweden - svenska</option><option value="de-CH">Switzerland - Deutsch</option><option value="fr-CH">Switzerland - français</option><option value="it-CH">Switzerland - Italiano</option><option value="ar-SY">Syrian Arab Republic - العربية</option><option value="zh-TW">Taiwan - 中文 (Zhōngwén)</option><option value="tg-TJ">Tajikistan - тоҷикӣ</option><option value="ru-TJ">Tajikistan - Русский</option><option value="sw-TZ">Tanzania, United Republic of - Kiswahili</option><option value="en-TZ">Tanzania, United Republic of - English</option><option value="th-TH">Thailand - ไทย</option><option value="pt-TL">Timor-Leste - Português</option><option value="fr-TG">Togo - français</option><option value="en-TK">Tokelau - English</option><option value="en-TO">Tonga - English</option><option value="to-TO">Tonga - faka Tonga</option><option value="en-TT">Trinidad and Tobago - English</option><option value="ar-TN">Tunisia - العربية</option><option value="tr-TR">Turkey - Türkçe</option><option value="tk-TM">Turkmenistan - Türkmen</option><option value="ru-TM">Turkmenistan - Русский</option><option value="en-TC">Turks and Caicos Islands - English</option><option value="en-TV">Tuvalu - English</option><option value="en-UG">Uganda - English</option><option value="sw-UG">Uganda - Kiswahili</option><option value="uk-UA">Ukraine - Українська</option><option value="ar-AE">United Arab Emirates - العربية</option><option value="en-GB">United Kingdom of Great Britain and Northern Ireland - English</option><option value="en-US">United States of America - English</option><option value="es-UY">Uruguay - Español</option><option value="uz-UZ">Uzbekistan - Oʻzbek</option><option value="ru-UZ">Uzbekistan - Русский</option><option value="bi-VU">Vanuatu - Bislama</option><option value="en-VU">Vanuatu - English</option><option value="fr-VU">Vanuatu - français</option><option value="es-VE">Venezuela (Bolivarian Republic of) - Español</option><option value="vi-VN">Viet Nam - Tiếng Việt</option><option value="fr-WF">Wallis and Futuna - français</option><option value="es-EH">Western Sahara - Español</option><option value="ar-YE">Yemen - العربية</option><option value="en-ZM">Zambia - English</option><option value="en-ZW">Zimbabwe - English</option><option value="sn-ZW">Zimbabwe - chiShona</option><option value="nd-ZW">Zimbabwe - isiNdebele</option></select>
						</div>
					
						<div class='col-6'>
						<p><a href="/dashboard/login/" class='btn btn-warning' style="margin-top: 9px;">Cancel / Go back</a></p>
					</div>

					<div class='col-6'>
						<input type=submit name='submit' class='btn btn-success' value="Create account" />
					</div>
					</div>
					
			</form>
	</div>
				</fieldset>
				</div>

<?php

}
?>
</section>
<?php get_footer();  ?>