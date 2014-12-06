<?php

 /**
 * @author 
 * @copyright 
 */
 
require_once("Connection.php");

class Functions extends Connection{
	
	function login_user($usuario, $clave){
			$query_datos = "SELECT username FROM decameron_employees WHERE username = '".addslashes($usuario)."' AND password = '".md5($clave)."'";
			$datos = $this->selquery($query_datos);
			if(count($datos) > 0){
				$_SESSION['datos_usuario'] = $datos[0];
				$_SESSION['datos_usuario']['IP'] = $_SERVER['REMOTE_ADDR'];
				$_SESSION['fecha_log'] = mktime(date('H'), date('i')+30, date('s'), date('n'), date('j'), date('Y'));
				$_SESSION['islog'] = true;
				echo "<script>window.location = '../pages/index.php'</script>";
			}else{
				echo "<script>window.location = '../login.php?bad=0'</script>";
				}
	}
	
	function IsLogued(){
		$fecha_actual = mktime(date('H'), date('i'), date('s'), date('n'), date('j'), date('Y'));
		if($fecha_actual <= $_SESSION['fecha_log']){
			$fecha_log = true;
		}else{
			$fecha_log = false;
		}
		if($fecha_log == true){
			if(isset($_SESSION['islog']) && $_SESSION['islog'] == true){
				$_SESSION['fecha_log'] = mktime(date('H'), date('i')+30, date('s'), date('n'), date('j'), date('Y'));
				return true;
			}else{
				$this->LogOut();
				return false;
			}
		}else{
			$this->LogOut();
			return false;
		}
	}
	
	function LogOut(){
		session_destroy();
		session_unset();
		?>
		<script>window.location = '../index.php';</script>
		<?php
		die();
	}
	
	function send_email($to, $subject, $from, $from_mask ,$archive, $html){
		$boundary1=rand(0,9)."-".rand(10000000000,9999999999)."-".rand(10000000000,9999999999)."=:".rand(10000,99999);
		$boundary2=rand(0,9)."-".rand(10000000000,9999999999)."-".rand(10000000000,9999999999)."=:".rand(10000,99999);
				
		$header = "From: ".$from_mask." <".$from.">\nReply-To: ".$from."\nMIME-Version: 1.0\nContent-Type: multipart/alternative;\n\tboundary=\"".$boundary1."\"";
	
		$body =	"\nThis is a multi-part message in MIME format.\n\n--".$boundary1."\nContent-Type: text/plain;\n\tcharset=\"UTF-8\"\nContent-Transfer-Encoding: 8bit\n\n".$archive."\n--".$boundary1."\nContent-Type: text/html;\n\tcharset=\"UTF-8\"\nContent-Transfer-Encoding:  8bit\n\n".$html."\n\n--".$boundary1."--";
		$ok = mail($to, $subject, $body, $header, "-r ".$from);
		return $ok;
	}
	
	function getReport($arreglo, $totales = NULL){
		require('../resources/controls/table_report.php');
	}
	
	function getEnumValues ($table, $column){
		$query = "SHOW COLUMNS FROM ".$table." LIKE '".$column."'";
		$rs = $this->query($query) or die($this->error_mysql($query, $this->error, $this->errno));
		$rows=array();
		$row = $rs->fetch_array();
		$rs->free();
		preg_match_all("/(?:(?!:[\(\,])')(.+?)(?:'(?:[\)\,]))/",$row[1],$enums);
		return ($enums[1]);
	}
	
	function getMeses($formato = 'completo', $idioma = 'es'){
		if($formato == 'completo'){
			if($idioma == 'es'){
				$meses = array(
					'01' => 'Enero',
					'02' => 'Febrero',
					'03' => 'Marzo',
					'04' => 'Abril',
					'05' => 'Mayo',
					'06' => 'Junio',
					'07' => 'Julio',
					'08' => 'Agosto',
					'09' => 'Septiembre',
					'10' => 'Octubre',
					'11' => 'Noviembre',
					'12' => 'Diciembre'
				);
			}elseif($idioma == 'en'){
				$meses = array(
					'01' => 'January',
					'02' => 'February',
					'03' => 'March',
					'04' => 'April',
					'05' => 'May',
					'06' => 'June',
					'07' => 'July',
					'08' => 'August',
					'09' => 'September',
					'10' => 'October',
					'11' => 'November',
					'12' => 'December'
				);
			}
		}elseif($formato == 'abreviado'){
			if($idioma == 'es'){
				$meses = array(
					'01' => 'Ene',
					'02' => 'Feb',
					'03' => 'Mar',
					'04' => 'Abr',
					'05' => 'May',
					'06' => 'Jun',
					'07' => 'Jul',
					'08' => 'Ago',
					'09' => 'Sep',
					'10' => 'Oct',
					'11' => 'Nov',
					'12' => 'Dic'
				);
			}elseif($idioma == 'en'){
				$meses = array(
					'01' => 'Jan',
					'02' => 'Feb',
					'03' => 'Mar',
					'04' => 'Apr',
					'05' => 'May',
					'06' => 'Jun',
					'07' => 'Jul',
					'08' => 'Aug',
					'09' => 'Sep',
					'10' => 'Oct',
					'11' => 'Nov',
					'12' => 'Dec'
				);
			}
		}
		return $meses;
	}
	
	function getPeriodos(){
		$inicio = 2011;
		for($i = $inicio; $i <= date('Y'); $i++){
			$years[$i] = $i;
		}
		return $years;
	}
	
	function getPaises(){
		$datos_paises = $this->selquery("SELECT pais_nombre, codigo FROM paises ORDER BY pais_nombre");
		foreach($datos_paises as $key => $val){
			$paises[$val['codigo']] = $val['pais_nombre'];
		}
		return $paises;
	}
	
	function redireccionURL($url = ''){
		if($url == ''){
			$http_referer = explode('/', $_SERVER['HTTP_REFERER']);
			$c_http = count($http_referer);
			$url = $http_referer[($c_http - 1)];
		}
		echo '<script>location.href="'.$url.'";</script>';
	}
	
	function permisoApp($permiso_app){
		if($permiso_app == false){
		?>
		<table>
			<tr class="fuente12_rojo">
				<td>No tiene permisos para ver esta aplicaci&oacute;n, comun&iacute;quese con el administrador del sistema</td>
			</tr>
		</table>
		<?php
			die();
		}
	}
}

?>