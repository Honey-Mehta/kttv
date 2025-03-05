<?php
class Pmc_db_model{


	function __construct() {
				

	}


	public function api_request($Post_data)
	{
		$url = 'http://103.36.71.126/paramedical/api';
		$fields_string ='';
		//url-ify the data for the POST
		foreach($Post_data as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');

		///open connection
		$ch = curl_init();
		///set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL, $url);

		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
		curl_setopt($ch,CURLOPT_TIMEOUT,10);

		curl_setopt($ch, CURLOPT_POST, sizeof($Post_data));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		///execute post
		$res = curl_exec($ch);
		//$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		return $res;
	}


} //end class
?>
	
