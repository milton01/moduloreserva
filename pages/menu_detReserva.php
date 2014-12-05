<?php
/**
 * @author Decameron
 * @copyright 2014
 */

session_start();
?>
<div class="menu"> 
    
    <div class="suite_title_closed" id="suite_">
        Detalle Reserva
    </div>
        
    <div id="appsuite_1" class="suite_opened">
        <br>
        <div id="app_" >
            <p class="fuente12_rojo">Fecha Entrada:</p>
            <p class="fuente12b_negro"><?php echo $_SESSION['fecha_desde'] ?></p>
            <p class="fuente12_rojo">Fecha Salida:</p>
            <p class="fuente12b_negro"><?php echo $_SESSION['fecha_hasta'] ?></p>
            <p class="fuente12_rojo">Numero de Personas:</p>
            <p class="fuente12b_negro"><?php echo $_SESSION['cantidad_personas'] ?></p>
            <p class="fuente12_rojo">Valor del Plan:</p>
            <p class="fuente12b_negro">$<?php echo $precio ?></p>
        </div>
    
        <div id="app_">
            <a href=""  class="suite_item"     id="appa_">
                <img class="imagen1" src="../images/public/regresi.gif"  border="0" alt="logo"/>
            </a>
        </div>
    </div>  
</div>