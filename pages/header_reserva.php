<?php

 /**
 * @author Decameron
 * @copyright 2014
 */

ini_set('error_reporting', 0);
 
require_once("../core/Functions.php");
$object = new Functions();

if(isset($_GET['action']) && $_GET['action'] == 'logout'){
	$object->LogOut();
}

$object->IsLogued();

?>
<title>.:: CODISOLA ::.</title>
<link rel="stylesheet" type="text/css" href="../resources/css/StyleMain.css"/>
<link rel="stylesheet" type="text/css" href="../resources/css/StylePage.css"/>
<link type="text/css" rel="stylesheet" href="../resources/css/jquery-ui.css" />

<script type="text/javascript" src="../resources/js/jquery-1.6.min.js"></script>
<script src="../resources/js/jquery.validationEngine-es.js" type="text/javascript" charset="utf-8"></script>
<script src="../resources/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
 <link rel="stylesheet" href="../resources/css/validationEngine.jquery.css" type="text/css"/>
<script type="text/javascript" src="../resources/js/jquery.maskedinput-1.3.js"></script>
<script type="text/javascript" src="../resources/js/jquery.timers.js"></script>
<script type="text/javascript" src="../resources/js/jquery.highlightFade.js"></script>
<script type="text/javascript" src="../resources/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="../resources/js/jquery.ui.timepicker.js"></script>
<script type="text/javascript" src="../resources/js/jquery.autocomplete.js"></script>
<script type="text/javascript" src="../resources/js/main.js"></script>

<script>
$(document).ready(function(){
	 $("#frmSocio").validationEngine('attach');
	 $("#formSolicitudPrestamo").validationEngine('attach');	 
	  $("#frmSolicitudAhorro").validationEngine('attach');	 
	  $("#datos_usuario").validationEngine('attach');		  
	$('[id*=fecha]').datepicker({
		dateFormat: 'yy-mm-dd',
		showButtonPanel: true,
		changeMonth: true, 
		changeYear: true,
		gotoCurrent: true 
	});
	
	$('#al, #del').datepicker({
		dateFormat: 'yy-mm-dd',
		showButtonPanel: true,
		autoSize: true,
		beforeShow: customRange
	});
	

	
	function customRange(input){ 
		return {
			//minDate: ((input.id == "del")? new Date(2011, 9 - 1, 1) : null),
			minDate: ((input.id == "del")? new Date() : null),
			minDate: ((input.id == "al")? $("#del").datepicker("getDate") : null), 
			maxDate: ((input.id == "del")? $("#al").datepicker("getDate") : null)
		}; 
	}
	
	$('#socio_sexo_m, #socio_sexo_f, #est_civil_id').change(function(){
		if($("#socio_sexo_f").attr('checked') == 1 && $("#est_civil_id").val() == 2){
			$("#tr_hidden").show();
		}else{
			$("#tr_hidden").hide();
		}
	});
	
	$("#socio_dui").mask("99999999-9");
	$("#socio_nit").mask("9999-999999-999-9");
	$("#socio_isss").mask("999999999");
	$("#socio_tel_casa").mask("(999) 9999-9999");
	$("#socio_tel_celular").mask("(999) 9999-9999");
	$("#socio_tel_oficina").mask("(999) 9999-9999");
	
	$("[id*=tel]").mask("9999-9999");
	$("select[id*=doc]").change(function(){
		var obj=$(this).parent().parent().find("[id*='numero']");
		switch(){
			case 'DUI':
				obj.mask("99999999-9");
			break;
			case 'NIT':
				obj.mask("9999-999999-999-9");
			break;
			case 'CEDULA':
				obj.mask("99999999-9");
			break;
		}
		$(this).parent().parent().find("[id*='numero']")
	});

	keyAlloy();
});

function LogOut(){
	window.location = "index.php?action=logout"
}

function AppSelected(app_id, suite_id){
	if(app_id != 1 || suite_id != 1){
		document.getElementById('appa_'+app_id).className  = 'suite_item_selected';
		ChangeSuite(suite_id);
	}
}

function ChangeSuite(suite_id){
	var xxx = document.getElementsByClassName('suite_opened');
	for(var i = 0; i < xxx.length; i++){
		var nombre = xxx[i].id;
		var x = nombre.split('_');
		if(suite_id != x[1]){
			document.getElementById(nombre).className = 'suite_closed';
			document.getElementById('suite_'+x[1]).className='suite_title_closed';
		}
	}
	if(document.getElementById('appsuite_'+suite_id).className == 'suite_closed'){
		document.getElementById('appsuite_'+suite_id).className  = 'suite_opened';
		document.getElementById('suite_'+suite_id).className='suite_title_opened';
	}else if(document.getElementById('appsuite_'+suite_id).className == 'suite_opened'){
		document.getElementById('appsuite_'+suite_id).className  = 'suite_closed';
		document.getElementById('suite_'+suite_id).className='suite_title_closed';
	}
}
</script>
<div id="header-logo" align="center">
    <a href="index.php">
    	<img src="../images/banner1.png" border="0" alt="logo"/>
    </a>
</div>
<div id="header-bot">
    <div id="header-userbar">Usuario: <b><?php echo strtoupper($_SESSION['datos_usuario']['usuario_nombre'].' '.$_SESSION['datos_usuario']['usuario_apellido'])?></b>&nbsp;&nbsp;&nbsp;Conectado desde:<b><?php echo $_SESSION['datos_usuario']['IP']?></b> 
    </div>
    <div id="header-logoutbar">
    	<img id="BtnSalir" alt="Salir" src="../images/shut_down.png" onClick="LogOut()"/>
    </div>
</div>