
<?php

$host = 'http://localhost:3000';
$url = $host . $_SERVER['REQUEST_URI'];

// init
$ch = curl_init();

// options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, TRUE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

// execute
$response = curl_exec($ch);

// replace header
list( $header, $body ) = explode("\r\n\r\n", $response);
foreach ( explode("\r\n", $header) as $value) {
	header($value);
}

if(curl_exec($ch) === false) {
    print curl_error($ch);
} else {
	print $body;
}

curl_close($ch);

?>
