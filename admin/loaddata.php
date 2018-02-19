<?php
	if(isset($_GET['water_mon'])){
		header('Content-Type: text/event-stream');
		header('Cache-Control: no-cache');
		echo "data: Ok";
	}
?>


<?php
include_once "db.php";
$url = "https://api.thingspeak.com/channels/386329/feeds.json?results=2";

// Get cURL resource
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $url,
    CURLOPT_USERAGENT => 'AquaVert Bot'
));

// Send the request & save response to $resp
$resp = json_decode(curl_exec($curl), 1);

$des = $resp['channel'];
//getting fields
$fields = array();

foreach($des as $key=>$value){	
	if(strpos($key, 'field') !== false){
		$fields[$key] = $value;
	}
}
//Get actual data
$data = $resp['feeds'];

//System ID
$device_id =  $resp['feeds'][0][array_keys($fields, 'DeviceID')[0]];
unset($fields[array_keys($fields, 'DeviceID')[0]]);

//Getting last kept record
$ldate = last_record($device_id);

//Constructing queries
$records = array();
for($n=0; $n<count($data); $n++){

	$temp = $data[$n];
	$time = str_ireplace("Z", "", str_ireplace("T", " ", $temp['created_at']));	


	//Checking if the this time is greater than the previous
	if($time>$ldate){
		foreach ($fields as $key => $value) {
			if($value == "temperature")
				$temp[$key] = $temp[$key]-273.15;
			$dataQuery = "INSERT INTO data(`time`,`DeviceID`, `entry_id`, `type`, `value`) VALUES (\"$time\", \"$device_id\", ' ', ";
			$dataQuery.="\"$value\", \"$temp[$key]\")";
			echo($dataQuery."<br />");
			$query = mysqli_query($conn, $dataQuery) or die("Error Updating: ".mysqli_error($conn));
			$dataQuery = "";
		}
	}else{
		echo "Not new data<br />";
	}
	
}

// Close request to clear up some resources
curl_close($curl);

function last_record($device_id){
	global $conn;
	$query = mysqli_query($conn, "SELECT * FROM data WHERE DeviceID = \"$device_id\" ORDER BY time DESC LIMIT 1") or die(mysqli_error($conn));
	if(mysqli_num_rows($query)){
		$data = mysqli_fetch_assoc($query);
		return $data['time'];
	}else{
		return false;
	}
}
?>