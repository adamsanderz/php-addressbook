<?php
	include ("include/dbconnect.php");
	include ("include/format.inc.php");

  ?><title>Test</title><?php
  include ("include/header.inc.php");

/*

function encode_rfc3986($input) {
 	     
  $output = rawurlencode($input);
  $output = str_replace('%7E', '~', $output);  
  return str_replace('+',   ' ', $output);
}

function getHref($consumer_key, $url, $secret, $token = null) {

  $params['oauth_version']          = "1.0";
  $params['oauth_signature_method'] = "HMAC-SHA1";
  $params['oauth_consumer_key']     = $consumer_key;
  if($token != null) {
  	$params['oauth_token']          = $token;
  }
  $params['oauth_timestamp']        = time();
  $params['oauth_nonce']            = rand();
  
  //
  // Build signature from alphabetic sorted params, url & method
  //
  ksort($params); // Wichtig: alphabetische Reihenfolge f�r Signatur
  $enc_params = http_build_query($params);
  $enc_url = "GET&".encode_rfc3986($url)."&".encode_rfc3986($enc_params);

  $signature = base64_encode( hash_hmac ('sha1', $enc_url, $secret, true));

  //
  // Return signed request
  //
  $href = $url."?".$enc_params."&oauth_signature=".urlencode($signature);
  
  return $href;
}

// -------------------------------------------------------------------

  $doodle['key']    = '9xah1eip56s4xl3w94w3d7orj8kc57dn';
  $doodle['secret'] = 'hdhi4monswz3hxbwcyrul1ki8h2k72o2';
  $url = "http://doodle.com/api1/oauth/requesttoken";

  $href = getHref($doodle['key'], $url, $doodle['secret']."&");
  
  echo "<a href='".$href."'>".$href."</a><br><br>";
  
  $curl = curl_init($href);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);    
  $response = curl_exec($curl);

  echo $response."<br>";
  
  parse_str($response,  $out);
  $token        = $out['oauth_token'];
  $token_secret = $out['oauth_token_secret'];
  echo "\n";
  print_r($out);
  
  $url = "http://doodle.com/api1/oauth/accesstoken";
  $href = getHref($doodle['key'], $url, $doodle['secret']."&".$token_secret, $token);
  
  echo "<a href='".$href."'>".$href."</a><br><br>";
  
  $curl = curl_init($href);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);    
  $response = curl_exec($curl);

  echo $response."<br>";

  parse_str($response,  $out);
  $token        = $out['oauth_token'];
  $token_secret = $out['oauth_token_secret'];
  echo "\n";
  print_r($out);

  $url = "http://doodle.com/api1/polls/yux8uhbvb96htt2n";
  $href = getHref($doodle['key'], $url, $doodle['secret']."&".$token_secret, $token);

  echo "<a href='".$href."'>".$href."</a><br><br>";
  
  $curl = curl_init($href);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);    
  $response = curl_exec($curl);

  echo $response."<br>";
 */
/*  
require "OAuth.php";  

$consumer_key = '9xah1eip56s4xl3w94w3d7orj8kc57dn';
$consumer_secret = 'hdhi4monswz3hxbwcyrul1ki8h2k72o2';
$http_method = "GET";
$rest_endpoint = "http://doodle.com/api1/oauth/requesttoken";  
$uri_info_path = "";  
$uri = "doodle.com";  
  
  
// $url = "http://doodle.com/api1/oauth/requesttoken";
  
// $endpoint = "$rest_endpoint/$uri_info_path/". urlencode($uri, "UTF-8");  
$endpoint = "http://doodle.com/api1/oauth/requesttoken";
  
// Establish an OAuth Consumer based on read credentials  
$consumer = new OAuthConsumer($consumer_key, $consumer_secret, NULL);  
  
// Setup OAuth request - Use NULL for OAuthToken parameter  
$request = OAuthRequest::from_consumer_and_token($consumer, NULL, $http_method, $endpoint, NULL);  
  
// Sign the constructed OAuth request using HMAC-SHA1 - Use NULL for OAuthToken parameter  
$request->sign_request(new OAuthSignatureMethod_HMAC_SHA1(), $consumer, NULL);  
  
// Extract OAuth header from OAuth request object and keep it handy in a variable  
$oauth_header = $request->to_header();  

// Initialize a cURL session  
$curl = curl_init($endpoint);

echo "Req:".$request."\n";
echo "End:".$endpoint."<br>"."\n";
echo "Hdr:".$oauth_header."<br>"."\n";

/*  
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);    
curl_setopt($curl, CURLOPT_FAILONERROR, false);    
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);  
  
// Include OAuth Header as part of HTTP headers in the cURL request  
curl_setopt($curl, CURLOPT_HTTPHEADER, array($oauth_header));     
  
// Make OAuth-signed request to the BCWS server and get hold of server response  
$response = curl_exec($curl);
  
if (!$response) {  
  $response = curl_error($curl);    
}  
    
// Close cURL session  
curl_close($curl);    
  
// Process server response  
print($response);  
//*/

echo "Select your date";
?>

<script src="jscalendar/mootools.v1.11.js" type="text/javascript"></script>
<script src="jscalendar/nogray_date_calendar_vs1_min.js" type="text/javascript"></script>

<script language="javascript">
	window.addEvent("domready", function(){
		var today = new Date();
											
		var calender4 = new Calendar("calendar4", null, {visible:true,
														startDay:1,
														numMonths:3,
														multiSelection:true,
														allowWeekendSelection:true,
														startDate:new Date(today),
														endDate:new Date(today.getFullYear()+1, 11, 31),
														idPrefix:'cal4',
														inputType:'none',
														});
	});
</script>
<link href="jscalendar/nogray_calendar_vs1.css" rel="stylesheet" type="text/css" />
<style>
	* {font-family:Arial, Helvetica, sans-serif;
		font-size:9pt;}
		
	/* table list */
	.table_list {border-collapse:collapse;
		border:solid #cccccc 1px;
		width:100%;}
	
	.table_list td {padding:5px;
		border:solid #efefef 1px;}
	
	.table_list th {background:#75b2d1;
		padding:5px;
		color:#ffffff;}
	
	.table_list tr.odd {background:#e1eff5;}
	
	/* calendar styles */
	#calendar1, #calendar2, #calendar3, #calendar4 {border:solid #666666 1px;
		background:#ffffff;
		padding-bottom:5px;
    padding-right:8px;
    }
	
	#calendar4 {width:200px;}
	#calendar4 .ng-cal-header-table {width:200px;}
	#calendar4 .ng-dateOff {background:#81b8c4;
					color:#1e6372;}
</style>		

<table>
	<tr><td width=1% valign=top>
<div id="calendar4"></div>
</td><td valign=top>
<form>
	<label name=title><b>Participants:</b></label><br>
<?php
$participants = $_GET['part'];
$participants = array_filter(explode(';', $participants));

$sql  = "SELECT DISTINCT id, firstname, lastname FROM $base_from_where";
$sql .= "AND (id = '".implode("' OR id = '",  $participants)."')";
$sql .= "order by lastname";
  	
$result = mysql_query($sql);
$resultsnumber = mysql_numrows($result);

$rows = array();
while ($myrow = mysql_fetch_array($result)) {
		 $rows[] = "<a href='view.php?id=".$myrow['id']
		         ."' title='".$myrow['firstname']." ".$myrow['lastname']."' target='details'>"
		         . $myrow['firstname'] //." ".$myrow['lastname']
		         . "</a>";
}
echo implode(" - ", $rows);
?>	
  <br>
	<label name=title><b>Titel:</b></label><br>
	<input size=40 name=title><br>
	<label name=title><b>Description:</b></label><br>
<textarea name=description cols="100" rows="35">
Dear %firstname%,

Please vote for your prefered date:
- %doodle% 

Regards
Olivier
</textarea><br>
	<input type=submit>
</form>
</td></tr>
</table>

<?php  
  include ("include/footer.inc.php");
?>