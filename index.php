
<?php

$host = 'http://localhost:3000';
$url = $host . $_SERVER['REQUEST_URI'];

// init
$ch = curl_init();

// options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, TRUE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);


// request headers
$request_headers = [];
foreach ( getallheaders() as $key => $value) {
	$request_headers[] = "$key: $value";
}
curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);


// execute
$response = curl_exec($ch);

// response headers
list( $header, $body ) = explode("\r\n\r\n", $response, 2);
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
