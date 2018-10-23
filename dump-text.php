ok - dump file
<?php
// Dumps received JSON data as text in received_json.txt
	$headers = getallheaders();
	// Check authorization
	if ($headers["Authorization"] == "mysecret") {
		// Pass incoming JSON content to the string $json_str
		$json_str = file_get_contents('php://input');
		

		$file = fopen("received_json.txt","w");
		fwrite($file, $json_str);
		fclose($file);
	}
?>
