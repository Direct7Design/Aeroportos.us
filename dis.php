<?php
  /* Obtém os campos do formulário */
  $origem = strtoupper($_GET["o"]);
  $destino = strtoupper($_GET["d"]);

  /* Obtém a distância em milhas náuticas (nm) */
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'http://gc.kls2.com/cgi-bin/gc?PATH='.$origem.'-'.$destino.'&PATH-UNITS=nm');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  $var = curl_exec($ch);

  preg_match('/<td align=right nowrap>([0-9]*) nm<\/td>\n<\/tr>\n<\/table>/', $var, $m);

  /* Obtém a distância em quilômetros (km) */
  $chn = curl_init();
  curl_setopt($chn, CURLOPT_URL, 'http://gc.kls2.com/cgi-bin/gc?PATH='.$origem.'-'.$destino.'&PATH-UNITS=km');
  curl_setopt($chn, CURLOPT_RETURNTRANSFER, true);

  $varn = curl_exec($chn);

  /* Em caso de erro, retornar 0h0m como tempo */
  if(!preg_match('/<td align=right nowrap>([0-9]*) km<\/td>\n<\/tr>\n<\/table>/', $varn, $n))
  {
    $n[1] = '0h0m';
  }
  
  /* Funções */
  function to_minutes($float)
  {
    $hours = floor($float); // floor "arredonda" o número.
    $minutes = number_format(($float - $hours) * 60, 0); // number_format tirar todos os decimais dos minutos.

    return $hours . 'h' . $minutes .'m';
  }

  function airline($d) {
    $tairline = $d / 900; // 900 km/h é a velocidade média de uma aeronave de linha aérea, isto é, grande porte.
    return to_minutes($tairline);
  }
  
  function business($d) {
    $tairline = $d / 648; // 648 km/h é a velocidade média de uma aeronave de médio porte.
    return to_minutes($tairline);
  }
  
  function monomotor($d) {
    $tairline = $d / 227; // 227 km/h é a velocidade média de uma aeronave monomotor, isto é, pequeno porte.
    return to_minutes($tairline);
  }
?>