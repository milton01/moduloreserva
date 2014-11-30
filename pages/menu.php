<?php
/**
 * @author Codisola
 * @copyright 2012
 */
$query =
        "SELECT s.suite_id, s.suite_nombre, a.app_id, a.app_nombre, a.app_url, a.app_descripcion, 
         a.suite_id FROM suites s INNER JOIN aplicaciones a ON a.suite_id = s.suite_id 
         INNER JOIN perfiles_aplicaciones pa ON pa.app_id = a.app_id INNER JOIN usuarios ru 
         ON ru.perfil_id = pa.perfil_id WHERE a.app_estado = 1 AND pa.perapp_estado = 1 
         AND ru.usuario_id = '" . $_SESSION['datos_usuario']['usuario_id'] . "' 
             ORDER BY a.app_nombre";

$aplicaciones = $object->selquery($query);

foreach ($aplicaciones as $key => $val) {
    $apps[$val['suite_id']][$val['app_id']]['app_nombre'] = $val['app_nombre'];
    $apps[$val['suite_id']][$val['app_id']]['app_url'] = $val['app_url'];
    $apps[$val['suite_id']][$val['app_id']]['app_descripcion'] = $val['app_descripcion'];
    $suites[$val['suite_id']] = $val['suite_nombre'];
}
?>
<div class="menu">
    <?php
    foreach ($suites as $key => $val) {
        ?>
        <div class="suite_title_closed" id="suite_<?php echo $key ?>" 
             onClick="ChangeSuite(<?php echo $key ?>)"><?php echo $val ?></div>
        <div id="appsuite_<?php echo $key ?>" class="suite_closed">
            <?php
            foreach ($apps[$key] as $k => $v) {
                ?>
                <div id="app_<?php echo $k ?>"><a href="<?php echo $v['app_url'] ?>" 
                                             class="suite_item"     id="appa_<?php echo $k ?>"><?php echo $v['app_nombre'] ?>
                    </a></div>
                <?php
            }
            ?>
        </div>
        <?php
    }
    ?>
</div>