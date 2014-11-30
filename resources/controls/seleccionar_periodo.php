<?php
$listado_periodos = $object->getPeriodos($formato, $idioma);
?>
<select name="<?php echo $name?>" id="<?php echo $id?>" <?php echo $events?>>
    <?php
	foreach($listado_periodos as $key => $val){
	?>
	<option value="<?php echo $key?>" <?php echo ($selected == $key)? 'selected':''?>><?php echo $val?></option>
	<?php
	}
	?>
</select>