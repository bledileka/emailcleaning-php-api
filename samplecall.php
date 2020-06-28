<?php
/*
 * Sample call - Make sure to whitelist your servers ip address on your account in order to have proper responses
 */

use \Emailcleaningclub\Verification\Apicall;

require 'vendor/autoload.php';
/* initialize the class with main configs */

$Start = new Apicall("90C5626330E03D5C1799DF270AF7A114528B6F40");

/* sample call to check/verify an email address */
$payload = [
	"check" => "basic", // basic|advanced - if not provided "basic" check type is used.
	"email" => "john@smith.com" // email address
];
$results = $Start->_call($payload);
print_r($results);
?>