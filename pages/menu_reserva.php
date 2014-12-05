<?php
/**
 * @author Decameron
 * @copyright 2014
 */

//$query =
//        "SELECT s.suite_id, s.suite_nombre, a.app_id, a.app_nombre, a.app_url, a.app_descripcion, 
//         a.suite_id FROM suites s INNER JOIN aplicaciones a ON a.suite_id = s.suite_id 
//         INNER JOIN perfiles_aplicaciones pa ON pa.app_id = a.app_id INNER JOIN usuarios ru 
//         ON ru.perfil_id = pa.perfil_id WHERE a.app_estado = 1 AND pa.perapp_estado = 1 
//         AND ru.usuario_id = '" . $_SESSION['datos_usuario']['usuario_id'] . "' 
//             ORDER BY a.app_nombre";
//
//$aplicaciones = $object->selquery($query); 
//
//foreach ($aplicaciones as $key => $val) {
//    $apps[$val['suite_id']][$val['app_id']]['app_nombre'] = $val['app_nombre'];
//    $apps[$val['suite_id']][$val['app_id']]['app_url'] = $val['app_url'];
//    $apps[$val['suite_id']][$val['app_id']]['app_descripcion'] = $val['app_descripcion'];
//    $suites[$val['suite_id']] = $val['suite_nombre'];
//}
?>
<div class="menu">
    
    <div class="suite_title_closed" id="suite_">
        publicidad
    </div>
    
    <div id="appsuite_1" class="suite_opened">

          <div id="app_" >
              <a href="" class="suite_item" id="appa_">
                <img width="210px" src="../images/public/hoteleria-hoteles-recreacion-turismo-14131-MLM20084155343_042014-Y.jpg" border="0" alt="logo"/>
              </a>
          </div>
        
          <div id="app_">
              <a href="" class="suite_item" id="appa_">
                <img width="210px" src="../images/public/hotel-aloft-bogota-decameron.jpg" border="0" alt="logo"/>
              </a>
          </div>
    </div>
        
    
</div>