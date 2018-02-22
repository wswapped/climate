<?php
require('../db.php');
// header("Content-Type: text/plain");
session_start(); //For web testing only


//For browser-based testing
if(isset($_GET['ses'])){
	session_destroy();
	session_start();
	session_regenerate_id();
}

//Initialising
$response = "";
$tdata = array();

$conn = $db;
$req = array_merge($_POST, $_GET); //Keeping get and post for testing and productin handling concurently
$sessionId   = $req["sessionId"]?? session_id();
$serviceCode = $req["serviceCode"]??"*801#";
$phoneNumber = $req["phoneNumber"];
$text        = $req["text"];
//IN USSD phone number is always sent
//CLEAN and sanitize PHONE
$phoneNumber  = preg_replace( '/[^0-9]/', '', $phoneNumber );
$phoneNumber  = substr($phoneNumber, -10);

	//Handling further requests
	$requests = explode("*", $text);
	$nrequests = count($requests); //Number of requests
	$temp = array('');

	$ntemp = array_search("#", $requests);
	$ntemp = is_int($ntemp)?$ntemp:0;

	// if($ntemp){
	// 	for($n=$ntemp; ($n<$nrequests && $ntemp>0); $n++){
	// 		if(($n+1)!=$nrequests){
	// 			$temp[]=$requests[$n+1];
	// 		}
	// 	}
	// 	$requests = $temp;
	// 	$nrequests = count($requests);	
	// }

	//If last request is hash, then user should go back to home
	if(isset($requests[$nrequests-1]) && ($requests[$nrequests-1] == "#")){
		$text="#";
	}

	//Application logic
	if(empty($text) || $text == "#" || $text == "1*#"){
		//First request
		$response .="CON Ikaze ku iteganyagihe n'ubuhinzi!\n1. Iteganyagihe\n2. Imirima yanjye\n3. Gutanga amakuru\n# Exit\n";
	}else{
		//Level1 requests
		if(is_numeric($requests[0])){
			//Handling first menu
			$fmenu = $requests[0];
			if($fmenu == 1){

				if($nrequests == 1){
					//Checking for groups a user is in
					$t = rand(19,25);
					$response.="Uyu munsi hari ubushyuhe bwa $t - ubushyuhe buringaniye, nta mvura iragwa\nreba iteganyagihe ry'\n1.Icyumweru cyose\n2. Ukwezi kose\n3. Igihembwe cy'ihinga\n0. Gusubira inyuma";
				}else{
					echo "Turacyari kubikoraho, uzabona amakuru vuba";
					//Further requests were issued
					// $smenu = $requests[1];

					// if($nrequests == 2){

					// 	//Checking if user belongs
					// 	$groups = usergroups($phoneNumber);

					// 	if(count($groups)>0){
					// 		//Here the user belongs in a group
					// 		//Here going to handle first request, going to check if sent text is among the groups shown

					// 		//checking chose group's and it's menu
					// 		$tdata = gettempdata($sessionId, 'groups');
					// 		$tdata = json_decode($tdata, true);

					// 		if(is_array($tdata)){
					// 			if(!empty($tdata[$smenu])){
					// 				//User chose correct group
					// 				$groupid = $tdata[$smenu];
					// 				$groupname = groupname($groupid);
					// 				$response.="CON Ikaze muri $groupname\n";
					// 				$response.="1. Tanga umusanzu\n2. Bikuza\n3. Abanyamuryango\n4. Amakuru ya gurupe\n# Ahabanza";
					// 			}else if($smenu == 0){
					// 				//Joining a group
					// 				$response.="CON Mushyiremo umubare uranga gurupe\nComing soon";
					// 			}else{
					// 				$response.="Ibyo mwahisemo sibyo\n# Gutangira";
					// 			}

					// 		}else{
					// 			//No data stored or invalid JSON
					// 		}

					// 	}else{
					// 		//The user is new and might have put the group code
					// 		//Checking if group exists
					// 		$groupname = is_group($smenu);
					// 		if($groupname){
					// 			//The group requested to join exists
					// 			$response.="CON Mwasabye kwinjira muri gurupe '$groupname'\n";
					// 			$response.="Turacyari gutunganya ubu buryo\n";
					// 		}
					// 	}

							
					// }else{
					// 	//Group was chose or group code was input
					// 	$tmenu = $requests[2]; //Third menu choice

					// 	$tdata = json_decode(gettempdata($sessionId, 'groups'), true);
					// 	$groupid = $tdata[$smenu];
					// 	$groupname = is_group($groupid);

					// 	if($nrequests == 3){
					// 		$groups = usergroups($phoneNumber);

					// 		//Group chose earlier
					// 		$groupId = json_decode(gettempdata($sessionId, 'groups'), true)[$requests[1]];
					// 		$groupname = is_group($groupId);

					// 		if(!empty($groups)){
					// 			//User chose from the group menu
					// 			if($tmenu == 1){
					// 				//gutanga umusanzu
					// 				$response.="CON $groupname\nShyiramo amafaranga(FRW) ushaka kwitanga\n";
					// 			}else if($tmenu == 2){
					// 				//Kubikuza
					// 				$response.="CON $groupname\nShyiramo amafaranga(FRW) ushaka kubikuza\n";
					// 			}elseif ($tmenu == 3) {
					// 				# members
					// 				$members = groupmembers($groupId);																		
					// 				$response.="CON $groupname\nUrutonde rw'abanyamuryango\n";
					// 				$n=0;
					// 				$tdata = array(); //To keep temparary dta
					// 				foreach ($members as $memberid => $membername) {
					// 					$n++;
					// 					$response.="$n. $membername\n";
					// 					$tdata[$n]= $memberid;
					// 				}
					// 				$response.="#. Ahabanza\n";
					// 				keeptempdata($sessionId, $tdata, '$groupname members');

					// 			}elseif ( $tmenu == 4) {
					// 				// group info
					// 				$api_call = api(array('action'=>'listGroups', 'memberId'=>$userId));

					// 				$groupdata=0; //init
					// 				$groups_data = json_decode($api_call, true);
					// 				foreach ($groups_data as $key => $value) {
					// 					if($value['groupId'] == $groupId){
					// 						$groupdata = $value;
					// 						break;
					// 					}
					// 				}

					// 				//Group admins
					// 				$query = mysqli_query($conn, "SELECT COALESCE(memberName, memberPhone) as admin FROM members WHERE memberType = \"Group treasurer\" AND groupId = \"$groupId\"") or die("END Error: ".mysqli_error($conn));
					// 				$admins = array();
					// 				while ($temp = mysqli_fetch_assoc($query)) {
					// 					$admins[] = $temp['admin']; 
					// 				}
					// 				$admins = implode($admins, ', ');
					// 				$response.="CON Ibyerekeye gurupe '$groupname'\n";
					// 				$groupinfo = groupinfo($groupId);									
					// 				$response.="Amafaranga ifite:".number_format($groupdata['groupBalance'])."FRW\n";
					// 				$response.="Ayo ishaka kugeraho: ".number_format($groupinfo['targetAmount'])."FRW\n";
					// 				$response.="Yatangiye: ".date("d-m-Y", strtotime($groupinfo['createdDate']))."\n";
					// 				// $response.="Itangizwa: \n";
					// 				$response.="Iyobowe: $admins\n";
					// 				$response.="#.Ahabanza\n";

					// 			}else{
					// 				//Wrong choice
					// 				$response.="CON Mwashyizemo ibitari byo.\n#.Ahabanza\n";
					// 			}
					// 		}
					// 	}else{
					// 		$fomenu = $requests[3]; //Fourth menu item

					// 		if($nrequests ==4){

					// 			if($tmenu == 1){
					// 				//Kwizigama
					// 				if(is_numeric($fomenu) && $fomenu>=100 && $fomenu<=2000000){
					// 					$contmoney = $fomenu;
					// 					$api_call = contribute(array('action'=>'contribute', 'memberId'=>$userId, 'groupId'=>$groupid, 'amount'=>$contmoney, 'pushnumber'=>$phoneNumber, 'senderBank'=>senderbank($phoneNumber)));

					// 					if($api_call === false){
					// 						$response .= "END Twagize ikibazo k'ihuzanzira\nMwongere mukanya\nNetwork failed!\n";
					// 					}
					// 					else if($api_call=='failed' || $api_call == 'pending'){
					// 						$response = "END $userName gutanga umusanzu wa ".number_format($contmoney)."FRW muri '$groupname' ntibyashobotse.\nMurebe ko mufite amafaranga ahagije kuri konti ya mobile money\n";											
					// 					}else{
					// 						$response .= "END $userName ugiye gutanga umusanzu wa ".number_format($contmoney)."FRW muri '$groupname'\n";
					// 					}
					// 				}else if($fomenu<100 || $fomenu>2000000){
					// 					$response .="END Mushyiremo amafaranga(FRW) ahagije ari hagati ya RWF 100 kugeza kuri FRW 2 000 000 yo kwitanga"; 
					// 				}else{
					// 					$response.="END Shyiramo umubare w'amafaranga(FRW) ushaka gutanga, wishyiramo amagambo\n";
					// 				}
					// 			}else if ($tmenu == 2) {
					// 				# Kubikuza
					// 				if(is_numeric($fomenu) && $fomenu>=100 && $fomenu<=2000000){
					// 					$contmoney = $fomenu;
										
					// 					$api_call = withdraw(array('groupId'=>$groupid, 'memberId'=>$userId, 'amount'=>$contmoney,  'withdrawAccount'=>$phoneNumber, 'withdrawBank'=>senderbank($phoneNumber), 'action'=>'withdrawrequest' ));
										
					// 					$response.="END $api_call\n";
					// 				}else if($fomenu<100 || $fomenu<2000000){}else{
					// 					$response.="CON Mushobora kubikuza amafaranga(FRW) ari hagati ya 100 na 2 000 000 gusa\n";
					// 				}

					// 			}
					// 		}
					// 	}
						
					// }
					
				}
				
			}else if($fmenu == 2){

				$groups = usergroups($phoneNumber);

				$conts = $withs = 0;

				$response.="CON Amakuru ajyanye n'imirima yanyu\nHitamo umurima";
				
				$response.="Umaze kwitanga: ".number_format($conts)."Rwf\n";
				$response.="Umaze kubikuza: ".number_format($withs)."Rwf\n";
				$response.="#. Ahabanza\n";
			}
			else if($fmenu == 3){
				//konti
				$response.="END Uplus igufasha gukusanya no kugenzura amafaranga 
		mu bimina n'amagurupe kuburyo bworoshe kandi bunoze\nKu bindi bisobanuro sura www.uplus.rw\n";
			}



		}else{
			//Invalid requests
			$response = "END Mwashyizemo ibitari byo\nMusubiremo kandi muhitemo ibiribyo";
		}
	}
	function keeptempdata($session_id, $data, $type){
		global $conn;
		$data = json_encode($data);
		$data = mysqli_real_escape_string($conn, $data);
		$sql = "INSERT INTO ussdtempdata(session_id, data, type) VALUES(\"$session_id\", \"$data\", \"$type\")";
		$query = mysqli_query($conn, $sql) or die("OK Error: Can't log data: ".mysqli_error($conn));
		if($query)
			return true;
		else return false;
	}

	function groupmembers($groupid){
		//Return names, ids of group members
		global $conn;
		$query = mysqli_query($conn, "SELECT memberId as id, COALESCE(memberName, memberPhone) as name FROM members WHERE groupId = \"$groupid\"") or die("CON Error getting group members ".mysqli_error($conn));

		$groups = array();
		while ($temp = mysqli_fetch_assoc($query)) {
			$groups[$temp['id']] = $temp['name'];
		}
		return $groups;
	}

	function gettempdata($session_id, $type){
		//return tempdta
		global $conn;
		$query = mysqli_query($conn, "SELECT data FROM ussdtempdata WHERE session_id = \"$session_id\" AND type= \"$type\" ORDER BY time DESC LIMIT 1 ") or die("END Error: can't get temp data ".mysqli_error($conn));
		if(mysqli_num_rows($query)>0){
			$data = mysqli_fetch_assoc($query);
			return $data['data'];
		}else return false;
	}
	function groupname($groupid){
		//Function to check if group with $groupid exists
		global $conn;
		$query = mysqli_query($conn, "SELECT groupName FROM groups WHERE id = \"$groupid\"") or die("CON cn lookup group ".mysqli_error($conn));
		if(mysqli_num_rows($query)){
			$data = mysqli_fetch_assoc($query);
			return $data['groupName'];
		}else return false;
	}
	function groupinfo($groupid){
		global $conn;
		//Return info for display in about group's section
		$query = mysqli_query($conn, "SELECT targetAmount, COALESCE(adminName, adminPhone) as admin, createdDate FROM groups WHERE id =\"$groupid\" LIMIT 1") or die("CON Error".mysqli_error($conn));
		return mysqli_fetch_assoc($query);
	}
	function usergroups($userdata, $type='memberPhone'){
		//FUnction to check the groups a user with $userdata of column $type belongs in
		global $conn;
		$sql = "SELECT * FROM members WHERE $type = \"$userdata\"";
		$query = mysqli_query($conn, $sql) or die("END Error Checking groups u belong in\n".mysqli_error($conn));


		//Looping through all groups and putting them in $groups array
		$groups = array();
		while ($temp = mysqli_fetch_assoc($query)) {
			$groups[$temp['groupId']] = $temp['groupName'];
		}

		return $groups;
	}
	function is_group($groupid){
		//Function to check if group with $groupid exists
		global $conn;
		$query = mysqli_query($conn, "SELECT groupName FROM groups WHERE id = \"$groupid\"") or die("CON cn lookup group ".mysqli_error($conn));
		if(mysqli_num_rows($query)){
			$data = mysqli_fetch_assoc($query);
			return $data['groupName'];
		}else return false;
	}


	function api($data){
		//Function to query the API with action and specify $data as required per $action
		//FOr example if action is contribute, then $data will be memberId, groupId, amount, pushnumber, senderBank as keys of arrays and values
		$url = 'https://uplus.rw/api/';

		//Add all data
		$options = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($data)
			)
		);

		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);

		if ($result === FALSE) 
		{ 
			return "Network error";
		}
		else
		{
			return $result;			
		}
		
	}

	// function api($data){
	// 	//Using curl
	// 	$curl = curl_init();

	// 	curl_setopt_array($curl, array(
	// 	    CURLOPT_RETURNTRANSFER => 1,
	// 	    CURLOPT_URL => 'http://uplus.rw/api',
	// 	    CURLOPT_USERAGENT => 'USSD',
	// 	    CURLOPT_POST => 1,
	// 	    CURLOPT_POSTFIELDS => $data
	// 	));

	// 	$resp = curl_exec($curl);

	// 	if($resp){
	// 		return $resp;
	// 	}else{
	// 		die("END Error:". curl_error($curl)." of ". curl_error($curl));
	// 	}

	// 	curl_close($curl);

	// 	return $resp;
	// }

	function contribute($data){
		$result = api($data);

		$result = json_decode($result, true)[0];

		$status = $result['status'];
		
		if($status == true)
		{
			return true;
			//tell him that everything is fine
			//end the comunication he is going to interact with momo with a request of a pin from momo directly
		}
		else
		{
			return false;
			//Tell him that he doesn't have enough money on his momo and end it
		}
	}
	function withdraw($data){
		$result = api($data);
		return $result;
	}
	function senderbank($phoneNumber){
		$phoneNumber  = preg_replace( '/[^0-9]/', '', $phoneNumber );
		$phoneNumber  = substr($phoneNumber, -8);
		if($phoneNumber[0] == 8)
			return 1;
	}
	echo "$response";
?>
