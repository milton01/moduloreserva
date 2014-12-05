<?php
/**
 * @author Decameron
 * @copyright 2014
 */
?>
<div class="menu">

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

</div>