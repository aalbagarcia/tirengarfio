<?php use_helper('I18N') ?>
<?php use_stylesheet('gente') ?>
<?php use_stylesheet('formularios') ?>



<div id="lista_y_filtro">

	<?php 
		  include_partial('global/lista_miembros', array(
	                                       'lista_miembros' => $pager->getResults(),
	                                       'id_amigos' => $id_amigos,
	                                       'id_miembros_solicitud_amistad' => $id_miembros_solicitud_amistad,
		  			                       'pager' => $pager
	      ));
	?>

<div id="filtro">

    <div id="cabecera_filtro">Filtro</div>

     <div id="cuerpo_filtro">
     
     
		<!-- llevaremos el filtro a la accion "filtrar" -->
		<?php echo form_tag('miembros/index') ?>

				<?php echo $filtro?>
				
				<input type="submit" value="<?php echo __('Filtrar') ?>" />

		</form>

	</div>

</div> 

</div>