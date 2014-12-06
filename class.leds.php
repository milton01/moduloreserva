<?php 


class Leds {

	public function getRoom($id,$state){
		// 0 disponible
		// 1 no disponible
		// 2 mantenimiento
		$data = array(
			"1"=>array("a","b","c"),
			"2"=>array("d","e","f"),
			"3"=>array("g","h","i"),
			"4"=>array("j","k","l"),
			"5"=>array("m","n","o"),
			"6"=>array("p","q","r"),
			"7"=>array("s","t","u"),
			"8"=>array("v","w","x"),
			"9"=>array("y","z","1")
		);
		return $data[$id][$state];
	}


	
}



?>