<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>
<?php use_stylesheet('formularios')?>
<?php use_stylesheet('edicion_datos')?>
<!-- El orden importa -->
<?php use_javascript('/sfJqueryReloadedPlugin/js/jquery-1.3.2.min.js') ?>
<?php use_javascript('/sfJqueryReloadedPlugin/js/plugins/jquery-ui-1.7.2.custom.min') ?>
<?php use_stylesheet('/sfJqueryReloadedPlugin/css/ui-lightness/jquery-ui-1.7.2.custom.css') ?>

<form id="dialog" action="<?php echo url_for('mensaje/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
	
<table>
    
	<?php
	// muestra el formulario 
	echo $form
	?>
	<tr>
	    <td>&nbsp;</td>
		<td>
		    <input type="submit" value="Enviar" />
	        <?php echo link_to('Cancelar', $sf_request->getReferer()) ?>
	    </td>
    </tr>
</table>

</form>