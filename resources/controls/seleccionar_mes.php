<?php
$formato = ($formato == '')? 'completo': $formato;
$idioma = ($idioma == '')? 'es': $idioma;
$listado_meses = $object->getMeses($formato, $idioma);
?>
<select name="<?php echo $name?>" id="<?php echo $id?>" <?php echo $events?>>
    <?php
	if($oall == 1){
	?>
	<option value="%" <?php echo ($selected == '%')? 'selected':''?>>Todos</option>
	<?php
	}
	foreach($listado_meses as $key => $val){
	?>
	<option value="<?php echo $key?>" <?php echo ($selected == $key)? 'selected':''?>><?php echo $val?></option>
	<?php
	}
	?>
</select>