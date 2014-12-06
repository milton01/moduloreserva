<?php
include("core/Functions.php");
include('class.leds.php');

/**
 * Forma de correr
 * php verificador.php
 */

$maxTime = 10;

$leds = new Leds();
$object = new Functions();

while (true) {
	$items = $newItems = array();
	$items = json_decode(file_get_contents("mod_leds.json"),true);
	print(".");

	if(is_array($items) && count($items)>0){
		foreach ($items as $item) {
			$diff = strtotime(date('Y-m-d H:i:s')) - $item[1];
			print($diff);
			if($diff > $maxTime){
				$code = $leds->getRoom($item[0]);
				if($code!="") apagarLed($code);
			}else{
				$newItems[] = array((int)$item[0],(int)$item[1]);
			}
		}
		guardarData(json_encode($newItems));
	}

	sleep(1);
}


function apagarLed($code){
	$f = fopen('/dev/ttyACM0', 'w');
	fwrite($f, $code);
	fclose($f);
	$upd = "UPDATE decameron_habitacion SET estado = 1 WHERE id_habitacion";
	$object->updquery($upd);
}

function guardarData($data){
	$myfile = fopen("mod_leds.json", "w");

    fwrite($myfile, $data);
    fclose($myfile);
}

?>