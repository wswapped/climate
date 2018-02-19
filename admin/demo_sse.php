<?php
	header('Content-Type: text/event-stream');
	header('Cache-Control: no-cache');
	$ok = implode(array_keys($_GET), '');
	var_dump($ok);
	$time = date('r');
	echo "data: The server time is: {$time} {$ok} and go\n\n";
	flush();
?>