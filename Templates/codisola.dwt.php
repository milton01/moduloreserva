<!-- TemplateBeginEditable name="head" -->
<?php

 /**
 * @author Codisola
 * @copyright 2012
 */

?>
<!-- TemplateEndEditable -->
<div id="wrapper">
	<!-- TemplateBeginEditable name="includes" -->
  	<?php
	include('header.php');
    include('menu.php');
	$_SESSION['app_id'] = 1;
	include('log.php');
    ?>
	<!-- TemplateEndEditable -->
  	<div id="content">
    <!-- TemplateBeginEditable name="Content" -->
        Contenido
  	<!-- TemplateEndEditable -->
    </div>
    <?php
	include('footer.php');
	?>
</div>