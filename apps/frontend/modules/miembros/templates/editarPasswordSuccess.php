<?php include_stylesheets_for_form($form) ?>
<?php use_stylesheet('password_editar')?>
<?php use_stylesheet('formularios')?>
<?php include_javascripts_for_form($form) ?>


<div id="contenedor_formulario_pass">

<h2>Cambia tu password</h2>

<br></br>
<form action="<?php echo url_for('miembros/guardarPassword') ?>" method=post>
          
	<table>
      
		<?php echo $form  ?>
      
      	<tr>
      	    <td>&nbsp</td>
      		<td>
      			<input id="boton_guardar" type="submit" value="Guardar" />		
      		</td>
      		
      	</tr>
    </table>

      
</form>

<p class="edicion_ok">
	<?php
	if ($sf_user->hasFlash('cambio_pass_ok')){
		
		echo $sf_user->getFlash('cambio_pass_ok');
	}
	?>
</p>

</div>