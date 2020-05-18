<?php
/*
 * Simple interface to make api calls to cleanlist api endpoints.
 */
namespace Cleanlist\Verification;

class Apicall
{
	public function __construct($configs)
	{

		if (isset($configs["api_key"]) && $configs["api_key"] != "") {
			$this->apiKEY = trim(strip_tags($configs["api_key"]));
		} else {
			/* no api key ?*/
			die('Please set an api key!');
		}

		if (isset($configs["api_url"]) && $configs["api_url"] != "") {
			$this->apiURL = trim(strip_tags($configs["api_url"]));
		} else {
			/* no api key ?*/
			die('Please set an Url!');
		}

	}

	public function _call($options)
	{
		return $this->_curlGet($options);
	}

	public function _curlGet($options = NULL)
	{
		if (isset($options) && is_array($options)) {
			$str = "";
			foreach ($options as $name => $value) {
				$str .= '&' . $name . "=" . $this->urlencodeAPI($value);
			}
			$url = $this->apiURL . "?api_key=" . $this->apiKEY . $str;
		} else {
			die("Parameters missing ?");
		}

		$ch = curl_init();
		$ua = "PHP Curl Request";
		if (isset($_SERVER["HTTP_USER_AGENT"])) {
			$ua = $_SERVER["HTTP_USER_AGENT"];
		}

		$headers = array('Content-Type: application/json',
			'X-Api-Key: ' . $this->apiKEY,
			"User-Agent: " . $ua,
		);

		$options = array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HEADER => false,
			CURLOPT_HTTPHEADER => $headers,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_AUTOREFERER => true,
			CURLOPT_CONNECTTIMEOUT => 120,
			CURLOPT_TIMEOUT => 120,
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => 0
		);

		curl_setopt_array($ch, $options);
		$result = curl_exec($ch);

		if ($errno = curl_errno($ch)) {
			$error_message = curl_strerror($errno);
			echo "FATAL --> cURL error: ({$errno}): {$error_message}\n\n";
		}

		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		if ($httpCode == 0) {
			echo "cURL call failed!";
		} else {
			return json_decode($result, true);
		}

	}

	function urlencodeAPI($string)
	{
		if (!is_array($string)) {
			$str = urlencode($string);
			$str = str_replace("%28", "(", $str);
			$str = str_replace("%29", ")", $str);
			$str = str_replace("%3D", "=", $str);
			$str = str_replace("%2C", ",", $str);
			$str = str_replace("%21", "!", $str);
			$str = str_replace("+", "%20", $str);
			return $str;
		} else {
			$return = "";
			if (isset($string[0])) {
				foreach ($string[0] as $a => $str) {
					$str = urlencode($str);
					$str = str_replace("%28", "(", $str);
					$str = str_replace("%29", ")", $str);
					$str = str_replace("%3D", "=", $str);
					$str = str_replace("%2C", ",", $str);
					$str = str_replace("%21", "!", $str);
					$str = str_replace("+", "%20", $str);
					$return .= '&' . $a . "=" . $str;
				}
			}
			return $return;
		}
	}

}