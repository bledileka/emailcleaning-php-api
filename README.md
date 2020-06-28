![EmailCleaning.Club](https://emailcleaning.club/wp-content/uploads/2020/06/cropped-logo.fw_-2-2.png)

[EmailCleaning.Club](https://emailcleaning.club)
# emailcleaning-php-api
Simple cURL rest API calls to EmailCleaning.club endpoints. This script will make an email verification request.

Make sure to whitelist your servers IP address on your API key settings. If not, you wont be able to get any results.

Installation:

**Via composer:**

`composer require emailcleaningclub/cleanlist-php-api`

Sample call:

```php
<?php
/*
 * Sample call - Make sure to whitelist your servers ip address on your account in order to have proper responses
 */

require_once 'vendor/autoload.php';
/* initialize the class with main configs */

$Start = new \Emailcleaningclub\Verification\Apicall ("90C5626330E03D5C1799DF270AF7A114528B6F40");

/* sample call to check/verify an email address */
$payload = [
	"check" => "basic", // basic|advanced - if not provided "basic" check type is used.
	"email" => "john@smith.com" // email address
];
$results = $Start->_call($payload);
print_r($results);
?>
```

**Sample http cURL call:**

`
curl "https://api.emailcleaning.club/api/v1/?api_key={your_api_key}&email={email_address}&check={basic|advanced}"
`
