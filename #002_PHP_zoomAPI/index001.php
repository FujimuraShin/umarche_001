<?php
$curl = curl_init();

curl_setopt_array($curl, array(
	CURLOPT_URL => "https://api.zoom.us/v2/users?status=active&page_size=30&page_number=1",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => array(
		"authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJhdWQiOm51bGwsImlzcyI6IklocVpTeUppVGJlYzJZVC15UDFHbkEiLCJleHAiOjE2MTczNDY4MjYsImlhdCI6MTYxNzM0MTQyNH0.juTTLQ5wirm2zp0uiEOpPk4zQRSgzvlpDu0GWfmbnKs",
		"content-type: application/json"
	),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo "cURL Error #:" . $err;
} else {
	echo $response;
}