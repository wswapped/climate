<?php
$data = $_GET['action'];
include_once "db.php";
$url = "http://192.168.177.90/";

// Get cURL resource
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $url."".$data,
    CURLOPT_USERAGENT => 'AquaVert Bot'
));

$resp = json_decode(curl_exec($curl), 1);
echo "$resp";
?>