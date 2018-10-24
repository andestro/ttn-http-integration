<html>
	<head>
		<title>Er LED-en på?</title>
	</head>
	<body>
		<h1>Er LED-en på?</h1>
		<p> Siste status: <br>
			<?php 
				$lines = file('datalog.txt');	// Open datalog.txt and put it in an array variable
				$last_line = $lines[count($lines)-1];	// Access the last line of the $lines array
				echo $last_line;	// echo (a.k.a. print) the last line
			?>
		</p>
	</body>
</html>