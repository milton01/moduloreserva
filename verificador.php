<?php

/**
 * Forma de correr
 * php verificador.php
 */

$maxTime = 10;

while (true) {
	$items = $newItems = array();
	$items = json_decode(file_get_contents("mod_leds.json"),true);
	print(".");

	if(is_array($items) && count($items)>0){
		foreach ($items as $item) {
			$diff = strtotime(date('Y-m-d H:i:s')) - $item[1];
			print($diff);
			if($diff > $maxTime){
				apagarLed($item[0]);
			}else{
				$newItems[] = array((int)$item[0],(int)$item[1]);
			}
		}
		guardarData(json_encode($newItems));
	}

	sleep(1);
}


function apagarLed($id){
	$f = fopen('/dev/ttyACM0', 'w');
	fwrite($f, "O");
	fclose($f);
}

function guardarData($data){
	$myfile = fopen("mod_leds.json", "w");

    fwrite($myfile, $data);
    fclose($myfile);
}

?>