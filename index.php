<?php

$url = "https://api.thecatapi.com/v1/images/search";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, "my_password");
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

$output = curl_exec($ch);
$retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$info = curl_getinfo($ch);
curl_close($ch);

$object = json_decode( $output );

$total_results = $object->total_results;
$array = json_decode( $output, true );
$total_results = $array['total_results'];
echo $total_results;