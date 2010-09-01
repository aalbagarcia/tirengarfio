<?php include_stylesheets_for_form($form) ?>
<?php use_stylesheet('formularios')?>
<?php use_stylesheet('perfil_editar')?>
<?php include_javascripts_for_form($form) ?>

<div id="contenedor_formulario_edicion_perfil">

<p id="enlace_edicion_pass">

	<?php echo link_to('Cambia tu password',
                       'miembros/editarPassword?id='.$sf_user->getGuardUser()->getId(),
	                   array('id' => 'enlace_editar_password')               
	); ?>
</p>	

<h2>Edita tu perfil</h2>

<br></br>

<form action="<?php echo url_for('miembros/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
	
	<table>

		<?php echo $form?>

		<tr>
			<td>&nbsp</td>
			<td>
				<input type="submit" value="Save" />
			</td>
		</tr>
	</table>


</form>

<p class="edicion_ok">
	<?php
	if ($sf_user->hasFlash('edicion_perfil_ok')){
		
		echo $sf_user->getFlash('edicion_perfil_ok');
	}
	?>
</p>

</div>