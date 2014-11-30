<?php

 /**
 * @author Codisola
 * @copyright 2012
 */
?>
<style type="text/css" media="all">
@import "../resources/css/StyleMain.css";
</style>
<div id="wrapper">
<?php
	include('header.php');
	include('menu.php');
	$_SESSION['app_id'] = 2;
	include('log.php');

	$action = ($_POST['action'] == '')? 'none': $_POST['action'];
	$perfil_id = ($_POST['perfil_id'] == '')? 0: $_POST['perfil_id'];
	$chk_app = ($_POST['chk_app'] == '')? NULL: $_POST['chk_app'];
	
	if($action == 'none'){
	
		$query = "SELECT perfil_id, perfil_nombre, perfil_estado FROM perfiles ORDER BY perfil_nombre";
		$datos_perfiles = $object->selquery($query);
		
	}elseif($action == 'detalle'){
	
		$query = "SELECT suite_id, suite_nombre FROM suites";
		$suites = $object->selquery($query);
		
		$query = "SELECT app_id, app_nombre, suite_id FROM aplicaciones WHERE app_estado = 1 AND app_id != 1";
		$aplicaciones = $object->selquery($query);
		
		foreach($aplicaciones as $key => $val){
			$apps[$val['suite_id']][$val['app_id']] = $val['app_nombre'];
			$cantidad_apps_suite_total[$val['suite_id']] += 1;
			$cantidad_apps_total += 1;
		}
		
		$query = "SELECT app_id FROM perfiles_aplicaciones WHERE perfil_id = '".$perfil_id."' AND perapp_estado = 1";
		$aplicaciones_usuario = $object->selquery($query);
		
		foreach($aplicaciones_usuario as $key => $val){
			$apps_usr[$val['app_id']] = $val['app_id'];
		}
		
		foreach($suites as $key => $val){
			foreach($apps[$val['suite_id']] as $k => $v){
				if($apps_usr[$k] != ''){
					$cantidad_apps_suite_user[$val['suite_id']] += 1;
					$cantidad_apps_user += 1;
				}
			}
		}
		
		$query = "SELECT perfil_nombre FROM perfiles WHERE perfil_id = '".$perfil_id."'";
		$perfil_nombre = $object->seldato($query);
		
	}elseif($action == 'actualizar'){
	
		$query = "SELECT app_id, perapp_estado FROM perfiles_aplicaciones WHERE perfil_id = '".$perfil_id."'";
		$datos_perfiles = $object->selquery($query);
		
		foreach($datos_perfiles as $key => $val){
			$aplicaciones_actuales[$val['app_id']] = $val['perapp_estado'];
		}
		
		if(count($chk_app) > 0){
			$apps_update_inactivo = array_diff_key($aplicaciones_actuales, $chk_app);
		}else{
			$apps_update_inactivo = $aplicaciones_actuales;
		}
		
		if(count($aplicaciones_actuales) > 0){
			$apps_insert = array_diff_key($chk_app, $aplicaciones_actuales);
		}else{
			$apps_insert = $chk_app;
		}
		
		foreach($aplicaciones_actuales as $key => $val){
			if($val == 'Inactivo'){
				if($chk_app[$key]){
					$apps_update_activo[$key] = $key;
				}
			}
		}
		
		foreach($apps_update_inactivo as $key => $val){
			$query = "UPDATE perfiles_aplicaciones SET perapp_estado = 2 WHERE perfil_id = '".$perfil_id."' AND app_id = '".$key."'";
			$update = $object->updquery($query);
		}
		
		foreach($apps_update_activo as $key => $val){
			$query = "UPDATE perfiles_aplicaciones SET perapp_estado = 1 WHERE perfil_id = '".$perfil_id."' AND app_id = '".$key."'";
			$update = $object->updquery($query);
		}
		
		foreach($apps_insert as $key => $val){
			$query = "INSERT INTO perfiles_aplicaciones (perapp_estado, app_id, perfil_id) VALUES (1, '".$key."', '".$perfil_id."')";
			$insert = $object->insquery($query);
		}
		
		$object->redireccionURL();
	}
	?>
	<script type="text/javascript">
    function chngEstado(){
        var myParams = (chngEstado.arguments);
        var nP = ((parseInt(myParams.length) < 1)?'':myParams[0]);
        var tParams = (Base64.encode(myParams[0] + '::' + myParams[1]).split('=').join('~'));
        $.ajax({
            type:	 	"POST",
            url:	 	"consultas_jquery.php",
            async:		true,
            data:	 	("step=1&params="+tParams),
            success: 	function(datos){
                            alert('Cambio de estado satisfactorio');
                        }
        });
    }
    
    function sndForm(action, perfil_id){
        var form = document.createElement("form");
        form.setAttribute("name", "formulario");
        form.setAttribute("action", "");
        form.setAttribute("method", "post");
        
        var input_action = document.createElement("input");
        input_action.setAttribute("name", "action");
        input_action.setAttribute("type", "hidden");
        input_action.setAttribute("value", action);
        
        var input_perfil_id = document.createElement("input");
        input_perfil_id.setAttribute("name", "perfil_id");
        input_perfil_id.setAttribute("type", "hidden");
        input_perfil_id.setAttribute("value", perfil_id);
        
        form.appendChild(input_action);
        form.appendChild(input_perfil_id);
        
        document.getElementsByTagName("body")[0].appendChild(form);
        document.formulario.submit();
    }
    
    function chk_cambio_app(id, suite_id){
        var estado = true;
        $("input:checkbox[id ^= 'chk_app_" + suite_id + "']").each( function(){
            if(this.checked == false){
                estado = false;
            }
        });
        $("#chk_suite_" + suite_id).attr('checked', estado);
        
        var estado = true;
        $("input:checkbox[id ^= 'chk_suite']").each( function(){
            if(this.checked == false){
                estado = false;
            }
        });
        $("#chk_all").attr('checked', estado);
    }
    
    function chk_cambio_suite(id, suite_id){
        var _status = $('#' + id).is(':checked');
        $("input:checkbox[id ^= 'chk_app_" + suite_id + "']").each( function(){
            this.checked = _status;
        });
        
        var estado = true;
        $("input:checkbox[id ^= 'chk_suite']").each( function(){
            if(this.checked == false){
                estado = false;
            }
        });
        $("#chk_all").attr('checked', estado);
    }
    
    $(document).ready(function(){
        $("#chk_all").click(function() { 
            var _status = this.checked; 
            $("input[type=checkbox]").each(function() { 
                this.checked = _status; 
            }); 
        });
    });
    
    </script>
    <div id="content">
	<!--link rel="stylesheet" href="../resources/css/TableCSS.css" type="text/css" media="all"/-->
        <div class="titulo_reporte">Asignaci&oacute;n de perfiles</div>
        <?php
        $object->permisoApp($permiso_app);
        
        if($action == 'none' && count($datos_perfiles) > 0){
            //$object->getReport($datos_perfiles);
        ?>
        <table id="tabla_reporte">
            <tr>
                <th width="300">Nombre perfil</th>
                <th width="100">Estado</th>
                <th width="50">Acci&oacute;n</th>
            </tr>
            <?php
            foreach($datos_perfiles as $key => $val){
            ?>
            <tr>
                <td width="300"><?php echo $val['perfil_nombre'];?></td>
                <td width="100">
                    <select id="perfil_estado_<?php echo $val['perfil_id']?>" name="perfil_estado_<?php echo $val['perfil_id']?>" class="input_text" onChange="chngEstado(<?php echo $val['perfil_id']?>, this.value);">
                        <?php
                        $estados = $object->getEnumValues('perfiles', 'perfil_estado');
                        foreach($estados as $k => $v){
                        ?>
                        <option value="<?php echo ($k + 1)?>" <?php echo ($val['perfil_estado'] == $v)?'selected':''?>><?php echo $v?></option>
                        <?php
                        }
                        ?>
                    </select>
                </td>
                <td width="50"><span style="cursor:pointer" onClick="sndForm('detalle', <?php echo $val['perfil_id']?>)">ver detalle</span></td>
            </tr>
            <?php
            }
            ?>
        </table>
        <?php
        }elseif($action == 'none'){
        ?>
        <table>
            <tr class="fuente12_rojo">
                <td>No se encontraron perfiles a mostrar</td>
            </tr>
        </table>
        <?php
        }elseif($action == 'detalle'){
        ?>
        <form method="post">
        <table>
            <tr>
                <td colspan="4" class="fuente14b_negro" height="30" valign="top">PERFIL <?php echo strtoupper($perfil_nombre)?></td>
            </tr>
            <tr>
                <td colspan="4" class="fuente12b_negro"><input type="checkbox" name="chk_all" id="chk_all" onchange="chk_all(this.checked)" <?php echo ($cantidad_apps_total == $cantidad_apps_user)? 'checked' : ''?>/> Seleccionar todo</td>
            </tr>
            <?php
            foreach($suites as $key => $val){
            ?>
            <tr>
                <td colspan="4" class="fuente10_negro" height="15">&nbsp;</td>
            </tr>
            <tr class="fuente14b_negro">
                <td colspan="2"><?php echo $val['suite_nombre']?></td>
                <td align="center"><input type="checkbox" name="chk_suite" id="chk_suite_<?php echo $val['suite_id']?>" onchange="chk_cambio_suite(this.id, '<?php echo $val['suite_id']?>')" <?php echo ($cantidad_apps_suite_total[$val['suite_id']] == $cantidad_apps_suite_user[$val['suite_id']])? 'checked': ''?>/></td>
                <td align="center">&nbsp;</td>
            </tr>
            <?php
                foreach($apps[$val['suite_id']] as $k => $v){
                    if($k != 1){
            ?>
            <tr class="fuente12_negro">
                <td>&nbsp;</td>
                <td><?php echo $v?></td>
                <td align="center"><input type="checkbox" name="chk_app[<?php echo $k?>]" id="chk_app_<?php echo $val['suite_id']?>" onchange="chk_cambio_app(this.id, '<?php echo $val['suite_id']?>')" <?php echo ($apps_usr[$k] != '')? 'checked': ''?>/></td>
                <td align="center">&nbsp;</td>
            </tr>
            <?php
                    }
                }
            }
            ?>
            <tr>
                <td colspan="4" align="center" height="50" valign="bottom"><input type="submit" id="submit" name="submit" value="Guardar cambios" class="input_button"/><input type="hidden" id="action" name="action" value="actualizar"/><input type="hidden" id="perfil_id" name="perfil_id" value="<?php echo $perfil_id?>"/></td>
            </tr>
        </table>
        </form>
        <?php
        }
        ?>
	</div>
    <?php
    include('footer.php');
	?>
</div>