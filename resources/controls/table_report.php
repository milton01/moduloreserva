<?php
ini_set('error_reporting', 0);

foreach($totales as $key => $val){
	foreach($arreglo[0] as $k => $v){
		if($k == $val){
			$total_x[$k] = true;
		}
	}
}

if(count($arreglo) > 0){
?>
<table id="tabla_reporte">
	<?php
    foreach($arreglo[0] as $key => $val){
	?>
   	<th><?php echo ucwords(str_replace('_', ' ', $key))?></th>
    <?php
    }
	foreach($arreglo as $key => $val){
	?>
	<tr>
		<?php
		foreach($val as $k => $v){
			if($total_x[$k]){
				$total[$k] += $v;
			}
			if(is_numeric($v)){
				$align = 'right';
			}else{
				$align = 'left';
			}
		?>
    	<td align="<?php echo $align?>"><?php echo utf8_encode($v)?></td>
    	<?php
		}?>
	</tr>
	<?php
	}
	if(count($totales) > 0){
	?>
	<tr class="totales_tabla">
		<?php
		foreach($arreglo[0] as $key => $val){
			if(is_numeric($total[$key])){
				$align = 'right';
			}else{
				$align = 'left';
			}
		?>
    	<td align="<?php echo $align?>"><?php echo ($total[$key] != '')? $total[$key]: '&nbsp;'?></td>
    	<?php
		}
		?>
    </tr>
    <?php
	}
	?>
</table>
<?php
}else{
?>
<table>
	<tr class="fuente12_rojo">
   	  <td>Debe realizar una b&uacute;squeda</td>
    </tr>
</table>
<?php
}
?>