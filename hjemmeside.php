<html>
	<head>
		<title>Er LED-en på?</title>
	</head>
	<body>
		<h1>Er LED-en på?</h1>
		<p> Siste status: <br>
			<?php 
				$lines = file('datalog.txt');
				$last_line = $lines[count($lines)-1];
				echo $last_line;
			?>
		</p>
	</body>
</html>