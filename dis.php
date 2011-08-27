<?php
  /* Obt�m os campos do formul�rio */
  $origem = strtoupper($_GET["o"]);
  $destino = strtoupper($_GET["d"]);

  /* Obt�m a dist�ncia em milhas n�uticas (nm) */
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'http://gc.kls2.com/cgi-bin/gc?PATH='.$origem.'-'.$destino.'&PATH-UNITS=nm');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $var = curl_exec($ch);

  preg_match('/<td align=right nowrap>([0-9]*) nm<\/td>\n<\/tr>\n<\/table>/', $var, $m);

  /* Obt�m a dist�ncia em quil�metros (km) */
  $chn = curl_init();
  curl_setopt($chn, CURLOPT_URL, 'http://gc.kls2.com/cgi-bin/gc?PATH='.$origem.'-'.$destino.'&PATH-UNITS=km');
  curl_setopt($chn, CURLOPT_RETURNTRANSFER, true);

  $varn = curl_exec($chn);

  /* Em caso de erro, retornar 0h0m como tempo */
  if(!preg_match('/<td align=right nowrap>([0-9]*) km<\/td>\n<\/tr>\n<\/table>/', $varn, $n))
  {
    $n[1] = '0h0m';
  }
  
  /* Fun��es */
  function to_minutes($float)
  {
    $hours = floor($float); // floor "arredonda" o n�mero.
    $minutes = number_format(($float - $hours) * 60, 0); // number_format tirar todos os decimais dos minutos.

    return $hours . 'h' . $minutes .'m';
  }

  function airline($d) {
    $tairline = $d / 900; // 900 km/h � a velocidade m�dia de uma aeronave de linha a�rea, isto �, grande porte.
    return to_minutes($tairline);
  }
  
  function business($d) {
    $tairline = $d / 648; // 648 km/h � a velocidade m�dia de uma aeronave de m�dio porte.
    return to_minutes($tairline);
  }
  
  function monomotor($d) {
    $tairline = $d / 227; // 227 km/h � a velocidade m�dia de uma aeronave monomotor, isto �, pequeno porte.
    return to_minutes($tairline);
  }
?>