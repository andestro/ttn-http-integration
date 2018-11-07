<html>
	<head>
		<title>Temperatur og antall?</title>
	</head>
	<body>
		<h1>Siste data fra The Things Uno</h1>
		<p> Siste status: <br>
			<?php 
				$lines = file('datalog_tempant.txt');	// Open datalog_tempant.txt and put it in an array variable
				$last_line = $lines[count($lines)-1];	// Access the last line of the $lines array
				$line_split = explode(" ", $last_line); // Split the string into time, temperature and count
				echo "Time: $line_split[0] Temperature: $line_split[1] Count: $line_split[2]";	// echo (a.k.a. print) the last line
			?>
		</p>
	</body>
</html>