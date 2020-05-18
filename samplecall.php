<?php
require_once 'vendor/autoload.php';
/* initialize the class with main configs */

$Start = new \Cleanlist\Verification\Apicall (
	[
		"api_key" => "90C5626330E03D5C1799DF270AF7A114528B6F40", // set your api key
		"api_url" => "http://api.clean.loc/"
	]
);

/* sample call to check/verify an email address */
$payload = [
	"check" => "basic", // basic|advanced - if not provided is defaulted on basic
	"email" => "john@smith.com" // email address
];

$results = $Start->_call($payload);
print_r($results);

?>