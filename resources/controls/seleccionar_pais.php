<?php
$listado_paises = $object->selquery("SELECT pais_codpais, pais_nombre FROM paises ORDER BY pais_nombre");
?>

<select name="<?php echo $name?>" id="<?php echo $id?>" <?php echo $events?>>
    <?php
	if($oall == 1){
	?>
	<option value="%" <?php echo ($selected == '%')? 'selected':''?>>Todos</option>
	<?php
	}
	foreach($listado_paises as $key => $val){
		if($id == 'codpais'){
			$index = $val['pais_codpais'];
		}elseif($id == 'pais'){
			$index = $val['pais_nombre'];
		}
	?>
	<option value="<?php echo $index?>" <?php echo ($selected == $index)? 'selected':''?>><?php echo utf8_encode($val['pais_nombre'])?></option>
	<?php
	}
	?>
</select>