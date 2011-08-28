<?php
require('dis.php');

mysql_connect('localhost', 'aeroportos', 'aeroportos') or die(mysql_error());
mysql_select_db('aeroportos') or die(mysql_error());

$a = mysql_query('SELECT `IATA` FROM `aeroportos` ORDER BY RAND() LIMIT 1');
$aa = mysql_fetch_array($a);

$b = mysql_query('SELECT `IATA` FROM `aeroportos` ORDER BY RAND() LIMIT 1');
$bb = mysql_fetch_array($b);

if($a == $b) {
	$a = mysql_query('SELECT `IATA` FROM `aeroportos` ORDER BY RAND() LIMIT 1');
	$aa = mysql_fetch_array($a);

	$b = mysql_query('SELECT `IATA` FROM `aeroportos` ORDER BY RAND() LIMIT 1');
	$bb = mysql_fetch_array($b);
}
?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Aeroportos.us - Dist&acirc;ncia entre aeroportos</title>
	<link rel="icon" type="image/png" href="/images/icon.png" />
	<link rel="stylesheet" type="text/css" href="/css/reset.min.css" />
	<link rel="stylesheet" type="text/css" href="/css/style.min.css" />
	<!--[if lt IE 8]>
	<style type="text/css">
	#submit {
		position: relative;
		top: 8px; }
	</style>
	<![endif]-->
</head>
<body>
<div id="container">
	<form method="get" action="q">
		<p><input type="text" id="input" name="o" maxlength="4" value="Origem" onblur="if(this.value == '') { this.value = 'Origem'; }" onfocus="if(this.value == 'Origem') { this.value = ''; }" />&nbsp;
		<input type="text" id="input2" name="d" value="Destino" maxlength="4" onblur="if(this.value == '') { this.value = 'Destino'; }" onfocus="if(this.value == 'Destino') { this.value = ''; }" />&nbsp;
		<input type="submit" id="submit" value="Calcular" /></p>
	</form>
	<div id="footer">
		<p>Informe o <a href="http://pt.wikipedia.org/wiki/C%C3%B3digo_aeroportu%C3%A1rio_ICAO" target="_blank">ICAO</a> ou <a href="http://pt.wikipedia.org/wiki/C%C3%B3digo_aeroportu%C3%A1rio_IATA" target="_blank">IATA</a> dos aeroportos de origem e destino.<br />Aeroportos aleat&oacute;rios: de <a href="/q?o=<?php echo $aa["IATA"]; ?>&d=<?php echo $bb["IATA"]; ?>"><?php echo $aa["IATA"]; ?> para <?php echo $bb["IATA"]; ?></a>.</p>
	</div>
	<div id="credits">
		<p>Criado por <a href="http://www.pedrofelipe.com.br" target="_blank">Pedro Felipe</a> e dispon&iacute;vel gratuitamente no <a href="https://github.com/PedroFelipe/Aeroportos.us" target="_blank">GitHub</a>.
	</div>
</body>
</html>