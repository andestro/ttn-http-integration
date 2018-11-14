<html>
	<head>
		<title>Historikk</title>
		<style>
		#nicetable {
		    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		    border-collapse: collapse;
		    width: 80%;
		}

		#nicetable td, #nicetable th {
		    border: 1px solid #ddd;
		    padding: 8px;
		}

		#nicetable tr:nth-child(even){background-color: #f2f2f2;}

		#nicetable tr:hover {background-color: #ddd;}

		#nicetable th {
		    padding-top: 12px;
		    padding-bottom: 12px;
		    text-align: left;
		    background-color: #4CAF50;
		    color: white;
		}
		</style>

		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php
			// I denne PHP-blokken vil vi lese de 10 siste linjene 
			// fra datalog.txt-fila vår.
			$filename = 'datalog_backup.txt';
			$numlines = 10;
			// Siden PHP-scriptet vårt kjører på folk.ntnu.no-serveren
			// (som er en Linux-server) kan vi benytte Linux-kommandoen
			// "tail" som kan hente ut de siste linjene av en fil.
			// Den brukes for eksempel slik "tail -10 datalog.txt"
			// for å hente ut de 10 siste linjene i fila datalog.txt
			// Vi kjører Linux-kommandoer ved å skrive benytte oss av shell_exec()
			$text = shell_exec('tail -'.$numlines.' '.$filename);
			
			// Nå vil vi dele opp teksten fra de 10 siste linjene til 
			// individuelle linjer i en liste
			$lines = explode(PHP_EOL ,$text)

		
		?> 
	</head>
	<body>
		<h2>Litt bakgrunn</h2>
		<p>
			Slik ser variabelen $text ut før vi bryter den opp: <br>
			<?php echo $text; ?>
		</p>
		<p>
			Dette er første linje i lista $lines (altså $lines[0]): <br>
			 <?php echo $lines[0]; ?>
		</p>	

		<h1>De ti siste verdiene</h1>
		<table id="nicetable">
			<tr>
				<th>Tid  </th><th>Status</th><th>Gateway</th>
			</tr>
			<?php 
				// I denne PHP-snutten går vi gjennom hver linje og legger til en tabellrad
				foreach($lines as $single_line){
					echo "<tr>";
					$values = str_getcsv($single_line); // Bryt opp til hver enkelt verdi

					foreach($values as $single_value){
						echo "<td>".$single_value."</td>";
					}
					echo "</tr>";
				}
				echo  count($lines);
			?>
		</table>
	</body>
</html>