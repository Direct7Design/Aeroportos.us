<?php
require("dis.php");
?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Aeroportos.us - <?php if(!empty($origem)) { echo 'Dist&acirc;ncia entre '.$origem.' e '.$destino.''; } else { echo 'Dist&acirc;ncia entre aeroportos'; } ?></title>
	<link rel="icon" type="image/png" href="/images/icon.png" />
	<link rel="stylesheet" type="text/css" href="/css/reset.min.css" />
	<link rel="stylesheet" type="text/css" href="/css/style.min.css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script type="text/javascript" src="/js/jquery.tipTip.minified.js"></script>
	<link rel="stylesheet" type="text/css" media="screen, print" href="/css/tipTip.css" />
	<!--[if lt IE 8]>
	<style type="text/css">
	#submit {
		position: relative;
		top: 8px; }
	</style>
	<![endif]-->
	<style type="text/css">
	#container{font-size: 215%;margin-top:1%;padding:5px;text-align:center;}
	</style>
	<script type="text/javascript">
	function toggleLayer( whichLayer )
	{
	var elem, vis;
	if( document.getElementById )
	elem = document.getElementById( whichLayer );
	else if( document.all )
	elem = document.all[whichLayer];
	else if( document.layers )
	elem = document.layers[whichLayer];
	vis = elem.style;
	if(vis.display==''&&elem.offsetWidth!=undefined&&elem.offsetHeight!=undefined)
	vis.display = (elem.offsetWidth!=0&&elem.offsetHeight!=0)?'block':'none';
	vis.display = (vis.display==''||vis.display=='block')?'none':'block';
	}
	</script>
</head>
<body>
<div id="container">
<form method="get">
		<p><input type="text" id="input" name="o" maxlength="4" value="Origem" onblur="if(this.value == '') { this.value = 'Origem'; }" onfocus="if(this.value == 'Origem') { this.value = ''; }" />&nbsp;
		<input type="text" id="input2" name="d" value="Destino" maxlength="4" onblur="if(this.value == '') { this.value = 'Destino'; }" onfocus="if(this.value == 'Destino') { this.value = ''; }" />&nbsp;
		<input type="submit" id="submit" value="Calcular" /></p>
	</form>
<?php
if (airline($n[1]) == "0h0m")
{
	echo "<div id=\"error\">Um erro ocorreu. &Eacute; poss&iacute;vel que os aeroportos informados n&atilde;o estejam em nosso banco de dados ou voc&ecirc; inseriu o mesmo aeroporto em origem e destino.</div>";
} else {
	echo "	<div id=\"footer\">
		<p>".$origem." e ".$destino." est&atilde;o separados por ".$m[0]." ou ".$n[0]."</p>
		<p><img src=\"http://67.218.108.68/map?P=".$origem."-".$destino."&amp;MS=bm&amp;MR=60&amp;MX=440x210&amp;PM=*\" alt=\"\" /></p>
		<p>Tempo m&eacute;dio de voo<br />
			<table id=\"tempo\">
    		<tr>
    			<td><img class=\"tiptip\" src=\"/images/airline.png\" title=\"Velocidade m&eacute;dia de 900 km/h ou 485 n&oacute;s\" /><br />"; echo airline($n[1]); echo "</td>
    			<td><img class=\"tiptip\" src=\"/images/business.png\" title=\"Velocidade m&eacute;dia de 648 km/h ou 349 n&oacute;s\" /><br />"; echo business($n[1]); echo "</td>
    			<td><img class=\"tiptip\" src=\"/images/monomotor.png\" title=\"Velocidade m&eacute;dia de 227 km/h ou 122 n&oacute;s\" /><br />"; echo monomotor($n[1]); echo "</td>
	    	</tr>
	    </table>
	</div>";
}
?>
</div>
</body>
</html>