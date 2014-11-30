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
	$_SESSION['app_id'] = 1;
	include('log.php');
    ?>
    <div id="content">
        Contenido
    </div>
    <?php
	include('footer.php');
	?>
</div>