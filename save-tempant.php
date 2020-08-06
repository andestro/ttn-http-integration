ok	- save file
<?php
// Decodes received JSON and dumps selected fields to datalog.txt
	$headers = getallheaders();
	if ($headers["Authorization"] == "mysecret") {
		$json_str = file_get_contents('php://input');
		$json_obj = json_decode($json_str, true);

		// load selected data fields into PHP array
		// look at the JSON file from the previous example to know decide fields to access
		$mydata = array(
			'temp' => $json_obj['payload_fields']['temperature'],
			'count' => $json_obj['payload_fields']['count'],
                        'val' => $json_obj['payload_fields']['value'],
			'time' => $json_obj['metadata']['time'],
			// Add your variables here, remember to also change hjemmeside-tempant.
		);

		// write the data fields to a log file (in text format)
		// in principle, anything you want can be done with the data, 
		// e.g. saving it in a database
		$file = fopen("datalog_tempant.txt","a"); // NB! "a" appends to the file, "w" overwrites the file
		fwrite($file, 
			$mydata['time'].' '.
			$mydata['temp'].' '.
                        $mydata['val'].' '.
			$mydata['count'].' '
// Add your variables in an array here.

		);
		foreach ($mydata['gateways'] as $gateway) { //loop through each gateway 
			fwrite($file, $gateway['gtw_id'].' ');
		}
		fwrite($file, PHP_EOL); // end of line
		fclose($file);
	}
?>
