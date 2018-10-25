<html>
	<head>
		<title>Er LED-en på?</title>
		<style>
		/* Alt som står inni denne <style>-taggen er bare for å få sida til å se litt finere ut */
			body, html {
				height: 100%;
				margin: 0;
				font-family: Arial, Helvetica, sans-serif;
			}
			h1, h2, h3 {
				text-align: center;	
				margin-top: 20px;
			}
			h2, h3 {
				margin: 0;
				font-weight: normal;
			}
			h2 {
				font-size: 75px;
			}
			h3 {
				font-size: 20px;
			}
			.status{
				color: white;
				width: 50%;
				padding: 20px;
				background:#fff;
				margin: auto;
				box-shadow:0 2px 6px rgba(0, 0, 0, 0.2), 0 2px 4px rgba(0, 0, 0, 0.24); 
			}
			.bg-on {
				background-color: rgb(130, 189, 63);
			}
			.bg-off {
				background-color: rgb(204, 0, 0);
			}
			.clarification {
				margin-top: 20px;
				font-size: 12px; 
			}
			.gateways {
				font-size: 10px;
				max-width: 50%; 
				margin: auto; 
				margin-top: 4vw;
			}
		</style>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php
			// I denne PHP-blokken vil vi lese fra datalog.txt-fila vår.
			// Vi vil prosessere dataen litt og lage noen variabler som
			// vi bruker senere i HTML-koden.
			$lines = file('datalog.txt');	// åpne datalog.txt og put innholdet i $lines
			$last_line = $lines[count($lines)-1];	// finn den siste linja
			$data = str_getcsv($last_line);	// del opp den siste linja i hver kolonne (kommaseparert)

			$rawtime = $data[0];	// Første kolonne er tidspunktet
			$status = trim($data[1]);	// Andre kolonne er LED-statusen. 
			// Funksjonen trim() fjerner de ytterste mellomrom fra teksten vår. 
			// Her er dette nødvendig for at PHP skal kjenne igjen at " " er false.
			$gateways = trim($data[2]);	// Tredje kolonne er gateway-tilkoblingene

			// Ettersom tidsformatet vi får inn i variabelen $rawtime (fra $data[0]) er litt merkelig vil vi formatere det mer fornuftig slik at vi kan jobbe lettere med det. Dette ser kanskje litt gresk ut, og det kan ofte bli slik når man jobber med ulike tidsformat. Her gjelder det å klippe og lime ut fra de eksemplene man ser på nettet, og så kommer det med erfaring.
			date_default_timezone_set('Europe/Oslo');
			$timeinseconds = strtotime(substr($rawtime,0,-2).'Z');
			$updatetime = date("Y-m-d H:i:s", $timeinseconds); 
			
			// Regn ut forskjellen mellom nåværende 
			$timediff = time()-$timeinseconds;;
		?> 
	</head>
	<body>
		<h1>Er LED-en på?</h1>
		<div class="status <?php echo ($status ? "bg-on" : "bg-off"); ?>" >
			<!-- 
				PHP-snutten ovenfor er plassert inne i <div>-elementet sin class="". Den spytter ut stilklassen "bg-on" eller "bg-off" avhengig av variabelen $status. 
				Dette gjør at vi får en grønn eller rød bakgrunn, ettersom det er slik vi har definert disse stilklassene. 
			-->
			<h3> Akkurat nå er LED-en</h3>
			<h2>
			 <?php 
			 	echo ($status ? "PÅ" : "AV"); 
			 ?>
			</h2>
			<div class="clarification">
				Det vil si, ikke <i>akkurat</i> nå, men sist vi fikk en oppdatert pakke. 
				Forrige pakke ble sendt <?php echo $updatetime; ?>.
				Nå er tidspunktet <?php echo date("Y-m-d H:i:s"); ?>, det vil si at statusen er <?php echo $timediff;  ?> sekunder utdatert. 
			</div>
		</div>
		<p class="gateways">
			Gatewayen(e) vi er koblet til er <?php echo $gateways; ?>.
		</p>

	</body>
</html>